<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direktorat;
use App\Models\Departemen;
use App\Models\Unit;
use App\Models\Seksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Get filter parameters
            $search = $request->input('search');
            $unitFilter = $request->input('unit_filter');

            // Build query with relationships
            $query = User::with(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan']);

            // Apply search filter
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                        ->orWhere('email_user', 'like', "%{$search}%")
                        ->orWhere('nama_user', 'like', "%{$search}%");
                });
            }

            // Apply unit filter
            if ($unitFilter) {
                $query->where('id_unit', $unitFilter);
            }

            // Apply department filter
            if ($request->filled('dept_filter')) {
                $query->where('id_dept', $request->input('dept_filter'));
            }

            // Apply jabatan filter
            if ($request->filled('jabatan_filter')) {
                // Check if filtering by role_jabatan ID (integer)
                $jabatanId = $request->input('jabatan_filter');
                $query->where('role_jabatan', $jabatanId);
            }

            // If AJAX request, return JSON
            if ($request->ajax() || $request->wantsJson()) {
                $users = $query->get();
                \Log::info('UserManagement AJAX Request', [
                    'total_users' => $users->count(),
                    'search' => $search,
                    'unit_filter' => $unitFilter,
                    'sample_user' => $users->first() ? $users->first()->toArray() : null
                ]);
                return response()->json($users);
            }

            // Otherwise, return view with paginated data
            $users = $query->paginate(10)->withQueryString();
            $direktorats = \App\Models\Direktorat::all();
            $departemens = Departemen::all();
            $units = Unit::all();
            $seksis = Seksi::all();
            $roleJabatans = \App\Models\RoleJabatan::all();
            $roleUsers = DB::table('role_user')->get();

            \Log::info('UserManagement Page Load', [
                'total_users' => $users->total(),
                'is_ajax' => $request->ajax(),
                'wants_json' => $request->wantsJson()
            ]);
        } catch (\Exception $e) {
            \Log::error('UserManagement Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Fallback if tables don't exist
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([]);
            }

            $users = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
            $direktorats = collect([]);
            $departemens = collect([]);
            $units = collect([]);
            $seksis = collect([]);
            $roleJabatans = collect([]);
            $roleUsers = collect([]);
        }

        return view('admin.users.index', compact('users', 'direktorats', 'departemens', 'units', 'seksis', 'roleJabatans', 'roleUsers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'email_user' => 'required|email|unique:users,email_user',
            // 'password' => 'required|min:6', // Password default handling below
            'role_user' => 'required',
            'id_direktorat' => 'nullable|exists:direktorat,id_direktorat',
            'id_dept' => 'nullable|exists:departemen,id_dept',
            'id_unit' => 'nullable|exists:unit,id_unit',
            'id_seksi' => 'nullable|exists:seksi,id_seksi',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->except('password');
        // Default password assignment
        $data['password'] = Hash::make('123456'); // Default password
        $data['user_aktif'] = $request->input('user_aktif', 1);

        // Fix: Auto-fill nama_user from username if not provided (to satisfy DB constraint)
        if (!isset($data['nama_user']) || empty($data['nama_user'])) {
            $data['nama_user'] = $request->username;
        }

        // Fix: Set default for role_jabatan if not provided
        if (!isset($data['role_jabatan']) || empty($data['role_jabatan'])) {
            $data['role_jabatan'] = null; // or set a default ID if needed
        }

        // Fix: Convert role_user string to integer if needed
        if (isset($data['role_user']) && !is_numeric($data['role_user'])) {
            $roleMap = [
                'admin' => 1,
                'user' => 2,
                'approver' => 3,
                'unit_pengelola' => 4,
                'kepala_departemen' => 5,
            ];
            $data['role_user'] = $roleMap[$data['role_user']] ?? 2; // default to 'user' (2)
        }

        // Fix: Convert empty strings to null for foreign key columns (except role_jabatan)
        $nullableFields = ['id_direktorat', 'id_dept', 'id_unit', 'id_seksi'];
        foreach ($nullableFields as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        // Fix: role_jabatan tidak boleh null atau empty, set default jika tidak valid
        if (!isset($data['role_jabatan']) || $data['role_jabatan'] === '' || $data['role_jabatan'] === null || $data['role_jabatan'] === 'null') {
            $data['role_jabatan'] = 6; // Default: Associate
        } else {
            // Konversi ke integer jika string
            $data['role_jabatan'] = (int) $data['role_jabatan'];
        }

        // Validasi: Cek apakah sudah ada PIC di unit ini
        if (isset($data['can_create_documents']) && $data['can_create_documents'] == 1) {
            if (isset($data['id_unit']) && $data['id_unit']) {
                $existingPIC = User::where('id_unit', $data['id_unit'])
                    ->where('can_create_documents', 1)
                    ->first();

                if ($existingPIC) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Unit ini sudah memiliki PIC: {$existingPIC->nama_user}. Hanya 1 PIC per unit yang diizinkan."
                    ], 422);
                }
            }
        }

        $user = User::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil ditambahkan',
            'user' => $user->load(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,' . $id . ',id_user',
            'email_user' => 'required|email|unique:users,email_user,' . $id . ',id_user',
            'role_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $data = $request->except(['password']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if (!isset($data['nama_user']) || empty($data['nama_user'])) {
            // Keep existing nama_user if not changing, or set to username if empty
            // Actually upgrade usually has name, but if we don't send it, it might not be in $data except().
            // If we don't send it, $data won't have it, so update() won't touch it.
            // But if we want to ensure it has a value if explicitly set to null (unlikely with except), we can leave it.
            // However, let's play safe: if it IS in data but empty, fill it.
            if (array_key_exists('nama_user', $data) && empty($data['nama_user'])) {
                $data['nama_user'] = $request->username;
            }
        }

        // Fix: Convert role_user string to integer if needed
        if (isset($data['role_user']) && !is_numeric($data['role_user'])) {
            $roleMap = [
                'admin' => 1,
                'user' => 2,
                'approver' => 3,
                'unit_pengelola' => 4,
                'kepala_departemen' => 5,
            ];
            $data['role_user'] = $roleMap[$data['role_user']] ?? 2;
        }

        // Fix: Convert empty strings to null for foreign key columns (except role_jabatan)
        $nullableFields = ['id_direktorat', 'id_dept', 'id_unit', 'id_seksi'];
        foreach ($nullableFields as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }

        // Fix: role_jabatan tidak boleh null atau empty, set default jika tidak valid
        if (!isset($data['role_jabatan']) || $data['role_jabatan'] === '' || $data['role_jabatan'] === null || $data['role_jabatan'] === 'null') {
            $data['role_jabatan'] = 6; // Default: Associate
        } else {
            // Konversi ke integer jika string
            $data['role_jabatan'] = (int) $data['role_jabatan'];
        }

        // Validasi: Cek apakah sudah ada PIC di unit ini (exclude user yang sedang di-edit)
        if (isset($data['can_create_documents']) && $data['can_create_documents'] == 1) {
            if (isset($data['id_unit']) && $data['id_unit']) {
                $existingPIC = User::where('id_unit', $data['id_unit'])
                    ->where('can_create_documents', 1)
                    ->where('id_user', '!=', $id)
                    ->first();

                if ($existingPIC) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Unit ini sudah memiliki PIC: {$existingPIC->nama_user}. Hanya 1 PIC per unit yang diizinkan."
                    ], 422);
                }
            }
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil diupdate',
            'user' => $user->load(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])
        ]);
    }

    public function updatePIC(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $canCreate = $request->input('can_create_documents', 0);

        // Jika set PIC = Ya, validasi duplikat
        if ($canCreate == 1 && $user->id_unit) {
            $existingPIC = User::where('id_unit', $user->id_unit)
                ->where('can_create_documents', 1)
                ->where('id_user', '!=', $id)
                ->first();

            if ($existingPIC) {
                $unitName = $user->unit ? $user->unit->nama_unit : 'Unit ini';
                return response()->json([
                    'status' => 'error',
                    'message' => "{$unitName} sudah memiliki PIC: {$existingPIC->nama_user}. Hanya 1 PIC per unit yang diizinkan."
                ], 422);
            }
        }

        $user->can_create_documents = $canCreate;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => $canCreate == 1 ? 'User ditandai sebagai PIC' : 'Penandaan PIC dihapus',
            'user' => $user->load(['direktorat', 'departemen', 'unit', 'seksi', 'roleJabatan'])
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus'
        ]);
    }

    // API Helper Routes for Cascade Dropdowns
    public function getDepartemen($id_direktorat)
    {
        $departemens = Departemen::where('id_direktorat', $id_direktorat)->get();
        return response()->json($departemens);
    }

    public function getUnit($id_dept)
    {
        $units = Unit::where('id_dept', $id_dept)->get();
        return response()->json($units);
    }

    public function getSeksi($id_unit)
    {
        $seksis = Seksi::where('id_unit', $id_unit)->get();
        return response()->json($seksis);
    }
}
