<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessProcess;
use Illuminate\Http\Request;

class BusinessProcessController extends Controller
{
    /**
     * Get business processes filtered by user's unit
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Fetch business processes for user's unit
        $processes = BusinessProcess::query()
            ->select('id', 'nama_probis as name', 'kode_probis as code')
            ->orderBy('nama_probis')
            ->get();

        return response()->json($processes);
    }
}
