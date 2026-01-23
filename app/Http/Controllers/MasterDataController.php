<?php

namespace App\Http\Controllers;

use App\Models\Direktorat;
use App\Models\Departemen;
use App\Models\Unit;
use App\Models\Seksi;
use App\Models\User;
use App\Models\BusinessProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterDataController extends Controller
{
    /**
     * Display master data management page
     */
    public function index()
    {
        $direktorats = Direktorat::orderBy('nama_direktorat')->get();
        $departemens = Departemen::with('direktorat')->orderBy('nama_dept')->get();
        $units = Unit::with('departemen.direktorat', 'probis')->orderBy('nama_unit')->get();
        $seksis = Seksi::with('unit.departemen.direktorat')->orderBy('nama_seksi')->get();
        $probis = BusinessProcess::orderBy('kode_probis')->get();

        return view('admin.master_data', compact('direktorats', 'departemens', 'units', 'seksis', 'probis'));
    }

    // ==================== DIREKTORAT ====================
    
    public function storeDirektorat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_direktorat' => 'required|string|max:255|unique:direktorat,nama_direktorat',
            'status_aktif' => 'boolean'
        ], [
            'nama_direktorat.required' => 'Nama direktorat wajib diisi',
            'nama_direktorat.unique' => 'Nama direktorat sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $direktorat = Direktorat::create([
            'nama_direktorat' => $request->nama_direktorat,
            'status_aktif' => $request->status_aktif ?? 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Direktorat berhasil ditambahkan',
            'data' => $direktorat
        ]);
    }

    public function updateDirektorat(Request $request, $id)
    {
        $direktorat = Direktorat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_direktorat' => 'required|string|max:255|unique:direktorat,nama_direktorat,' . $id . ',id_direktorat',
            'status_aktif' => 'boolean'
        ], [
            'nama_direktorat.required' => 'Nama direktorat wajib diisi',
            'nama_direktorat.unique' => 'Nama direktorat sudah ada',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $direktorat->update([
            'nama_direktorat' => $request->nama_direktorat,
            'status_aktif' => $request->status_aktif ?? 1
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Direktorat berhasil diperbarui',
            'data' => $direktorat
        ]);
    }

    public function destroyDirektorat($id)
    {
        $direktorat = Direktorat::findOrFail($id);
        
        // Check if direktorat has related departemens
        $departemenCount = Departemen::where('id_direktorat', $id)->count();
        if ($departemenCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus direktorat karena masih memiliki {$departemenCount} departemen terkait"
            ], 400);
        }

        $direktorat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Direktorat berhasil dihapus'
        ]);
    }

    // ==================== DEPARTEMEN ====================
    
    public function storeDepartemen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_direktorat' => 'required|exists:direktorat,id_direktorat',
            'nama_dept' => 'required|string|max:255'
        ], [
            'id_direktorat.required' => 'Direktorat wajib dipilih',
            'id_direktorat.exists' => 'Direktorat tidak valid',
            'nama_dept.required' => 'Nama departemen wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within direktorat
        $exists = Departemen::where('id_direktorat', $request->id_direktorat)
            ->where('nama_dept', $request->nama_dept)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_dept' => ['Nama departemen sudah ada dalam direktorat ini']]
            ], 422);
        }

        $departemen = Departemen::create([
            'id_direktorat' => $request->id_direktorat,
            'nama_dept' => $request->nama_dept
        ]);

        $departemen->load('direktorat');

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil ditambahkan',
            'data' => $departemen
        ]);
    }

    public function updateDepartemen(Request $request, $id)
    {
        $departemen = Departemen::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_direktorat' => 'required|exists:direktorat,id_direktorat',
            'nama_dept' => 'required|string|max:255'
        ], [
            'id_direktorat.required' => 'Direktorat wajib dipilih',
            'id_direktorat.exists' => 'Direktorat tidak valid',
            'nama_dept.required' => 'Nama departemen wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within direktorat (excluding current record)
        $exists = Departemen::where('id_direktorat', $request->id_direktorat)
            ->where('nama_dept', $request->nama_dept)
            ->where('id_dept', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_dept' => ['Nama departemen sudah ada dalam direktorat ini']]
            ], 422);
        }

        $departemen->update([
            'id_direktorat' => $request->id_direktorat,
            'nama_dept' => $request->nama_dept
        ]);

        $departemen->load('direktorat');

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil diperbarui',
            'data' => $departemen
        ]);
    }

    public function destroyDepartemen($id)
    {
        $departemen = Departemen::findOrFail($id);
        
        // Check if departemen has related units
        $unitCount = Unit::where('id_dept', $id)->count();
        if ($unitCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus departemen karena masih memiliki {$unitCount} unit kerja terkait"
            ], 400);
        }

        $departemen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Departemen berhasil dihapus'
        ]);
    }

    // ==================== UNIT ====================
    
    public function storeUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_dept' => 'required|exists:departemen,id_dept',
            'nama_unit' => 'required|string|max:255',
            'id_probis' => 'nullable|exists:business_processes,id'
        ], [
            'id_dept.required' => 'Departemen wajib dipilih',
            'id_dept.exists' => 'Departemen tidak valid',
            'nama_unit.required' => 'Nama unit wajib diisi',
            'id_probis.exists' => 'Probis tidak valid'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within departemen
        $exists = Unit::where('id_dept', $request->id_dept)
            ->where('nama_unit', $request->nama_unit)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_unit' => ['Nama unit sudah ada dalam departemen ini']]
            ], 422);
        }

        $unit = Unit::create([
            'id_dept' => $request->id_dept,
            'nama_unit' => $request->nama_unit,
            'id_probis' => $request->id_probis
        ]);

        $unit->load('departemen.direktorat', 'probis');

        return response()->json([
            'success' => true,
            'message' => 'Unit kerja berhasil ditambahkan',
            'data' => $unit
        ]);
    }

    public function updateUnit(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_dept' => 'required|exists:departemen,id_dept',
            'nama_unit' => 'required|string|max:255',
            'id_probis' => 'nullable|exists:business_processes,id'
        ], [
            'id_dept.required' => 'Departemen wajib dipilih',
            'id_dept.exists' => 'Departemen tidak valid',
            'nama_unit.required' => 'Nama unit wajib diisi',
            'id_probis.exists' => 'Probis tidak valid'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within departemen (excluding current record)
        $exists = Unit::where('id_dept', $request->id_dept)
            ->where('nama_unit', $request->nama_unit)
            ->where('id_unit', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_unit' => ['Nama unit sudah ada dalam departemen ini']]
            ], 422);
        }

        $unit->update([
            'id_dept' => $request->id_dept,
            'nama_unit' => $request->nama_unit,
            'id_probis' => $request->id_probis
        ]);

        $unit->load('departemen.direktorat', 'probis');

        return response()->json([
            'success' => true,
            'message' => 'Unit kerja berhasil diperbarui',
            'data' => $unit
        ]);
    }

    public function destroyUnit($id)
    {
        $unit = Unit::findOrFail($id);
        
        // Check if unit has related seksis
        $seksiCount = Seksi::where('id_unit', $id)->count();
        if ($seksiCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus unit karena masih memiliki {$seksiCount} seksi terkait"
            ], 400);
        }

        // Check if unit has related users
        $userCount = User::where('id_unit', $id)->count();
        if ($userCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus unit karena masih memiliki {$userCount} user terkait"
            ], 400);
        }

        $unit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Unit kerja berhasil dihapus'
        ]);
    }

    // ==================== SEKSI ====================
    
    public function storeSeksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_unit' => 'required|exists:unit,id_unit',
            'nama_seksi' => 'required|string|max:255'
        ], [
            'id_unit.required' => 'Unit wajib dipilih',
            'id_unit.exists' => 'Unit tidak valid',
            'nama_seksi.required' => 'Nama seksi wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within unit
        $exists = Seksi::where('id_unit', $request->id_unit)
            ->where('nama_seksi', $request->nama_seksi)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_seksi' => ['Nama seksi sudah ada dalam unit ini']]
            ], 422);
        }

        $seksi = Seksi::create([
            'id_unit' => $request->id_unit,
            'nama_seksi' => $request->nama_seksi
        ]);

        $seksi->load('unit.departemen.direktorat');

        return response()->json([
            'success' => true,
            'message' => 'Seksi berhasil ditambahkan',
            'data' => $seksi
        ]);
    }

    public function updateSeksi(Request $request, $id)
    {
        $seksi = Seksi::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_unit' => 'required|exists:unit,id_unit',
            'nama_seksi' => 'required|string|max:255'
        ], [
            'id_unit.required' => 'Unit wajib dipilih',
            'id_unit.exists' => 'Unit tidak valid',
            'nama_seksi.required' => 'Nama seksi wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Check unique within unit (excluding current record)
        $exists = Seksi::where('id_unit', $request->id_unit)
            ->where('nama_seksi', $request->nama_seksi)
            ->where('id_seksi', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'errors' => ['nama_seksi' => ['Nama seksi sudah ada dalam unit ini']]
            ], 422);
        }

        $seksi->update([
            'id_unit' => $request->id_unit,
            'nama_seksi' => $request->nama_seksi
        ]);

        $seksi->load('unit.departemen.direktorat');

        return response()->json([
            'success' => true,
            'message' => 'Seksi berhasil diperbarui',
            'data' => $seksi
        ]);
    }

    public function destroySeksi($id)
    {
        $seksi = Seksi::findOrFail($id);
        
        // Check if seksi has related users
        $userCount = User::where('id_seksi', $id)->count();
        if ($userCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus seksi karena masih memiliki {$userCount} user terkait"
            ], 400);
        }

        $seksi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Seksi berhasil dihapus'
        ]);
    }

    // ==================== PROBIS (BUSINESS PROCESS) ====================

    public function storeProbis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_probis' => 'required|string|max:10|unique:business_processes,kode_probis',
            'nama_probis' => 'required|string|max:255'
        ], [
            'kode_probis.required' => 'Kode probis wajib diisi',
            'kode_probis.unique' => 'Kode probis sudah ada',
            'nama_probis.required' => 'Nama proses bisnis wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $probis = BusinessProcess::create([
            'kode_probis' => $request->kode_probis,
            'nama_probis' => $request->nama_probis
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Probis berhasil ditambahkan',
            'data' => $probis
        ]);
    }

    public function updateProbis(Request $request, $id)
    {
        $probis = BusinessProcess::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_probis' => 'required|string|max:10|unique:business_processes,kode_probis,' . $id,
            'nama_probis' => 'required|string|max:255'
        ], [
            'kode_probis.required' => 'Kode probis wajib diisi',
            'kode_probis.unique' => 'Kode probis sudah ada',
            'nama_probis.required' => 'Nama proses bisnis wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $probis->update([
            'kode_probis' => $request->kode_probis,
            'nama_probis' => $request->nama_probis
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Probis berhasil diperbarui',
            'data' => $probis
        ]);
    }

    public function destroyProbis($id)
    {
        $probis = BusinessProcess::findOrFail($id);
        
        // Check if probis is used in any unit (using id_probis column in unit table)
        // Note: unit table uses id_probis which refers to business_processes.id
        $unitCount = Unit::where('id_probis', $id)->count();
        if ($unitCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus Probis karena masih digunakan oleh {$unitCount} unit kerja"
            ], 400);
        }

        // Check relationship with seksi if exists
        $seksiCount = Seksi::where('id_probis', $id)->count();
        if ($seksiCount > 0) {
             return response()->json([
                'success' => false,
                'message' => "Tidak dapat menghapus Probis karena masih digunakan oleh {$seksiCount} seksi"
            ], 400);
        }

        $probis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Probis berhasil dihapus'
        ]);
    }
}
