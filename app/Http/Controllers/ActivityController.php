<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Receive heartbeat from client
     */
    public function heartbeat(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['success' => false]);

        $action = $request->input('action'); // 'create', 'edit', 'view'
        $docId = $request->input('doc_id');

        // 1. Update Unit Activity Cache
        $unitKey = 'activity_unit_' . $user->id_unit;
        $unitActivity = Cache::get($unitKey, []);

        // Add/Update current user entry
        $unitActivity[$user->id_user] = [
            'user_name' => $user->nama_user,
            'action' => $action,
            'doc_id' => $docId,
            'timestamp' => now()->timestamp
        ];

        // Clean up stale entries (older than 30s)
        foreach ($unitActivity as $uid => $data) {
            if (now()->timestamp - $data['timestamp'] > 30) {
                unset($unitActivity[$uid]);
            }
        }

        Cache::put($unitKey, $unitActivity, 60); // TTL 60s

        // 2. Handle Document Lock (if editing)
        $lockData = null;
        if ($action === 'edit' && $docId) {
            $lockKey = 'edit_lock_doc_' . $docId;
            $currentLock = Cache::get($lockKey);

            // If locked by someone else (and active < 30s ago)
            if ($currentLock && $currentLock['user_id'] != $user->id_user && (now()->timestamp - $currentLock['timestamp'] < 30)) {
                $lockData = [
                    'locked' => true,
                    'by' => $currentLock['user_name']
                ];
            } else {
                // Acquire/Refresh lock
                Cache::put($lockKey, [
                    'user_id' => $user->id_user,
                    'user_name' => $user->nama_user,
                    'timestamp' => now()->timestamp
                ], 60);
            }
        }

        return response()->json([
            'success' => true,
            'lock' => $lockData
        ]);
    }

    /**
     * Get active users in the unit
     */
    public function getUnitActivity()
    {
        $user = Auth::user();
        if (!$user) return response()->json([]);

        $unitKey = 'activity_unit_' . $user->id_unit;
        $activities = Cache::get($unitKey);
        
        // If nothing in cache, return empty array immediately
        if (!$activities || !is_array($activities)) {
            return response()->json([]);
        }
        
        $activeUsers = [];
        $currentTimestamp = now()->timestamp;

        foreach ($activities as $uid => $data) {
            // Filter out self and stale entries (older than 30s)
            if ($uid != $user->id_user && ($currentTimestamp - $data['timestamp'] < 30)) {
                $docTitle = '';
                $docStatus = '';
                if (isset($data['doc_id']) && $data['doc_id']) {
                   $doc = \App\Models\Document::find($data['doc_id']);
                   if($doc) {
                       $docTitle = $doc->judul_dokumen; 
                       $docStatus = $doc->status; // or getStatusLabelAttribute() if available model accessor
                   }
                }
                
                $activeUsers[] = [
                    'name' => $data['user_name'],
                    'action' => $data['action'] ?? 'viewing', 
                    'doc_id' => $data['doc_id'] ?? null,
                    'doc_title' => $docTitle,
                    'doc_status' => $docStatus
                ];
            }
        }

        return response()->json($activeUsers);
    }
}
