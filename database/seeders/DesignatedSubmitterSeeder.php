<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Unit;

class DesignatedSubmitterSeeder extends Seeder
{
    public function run()
    {
        $units = Unit::all();
        $roleIds = [6, 5, 4]; // Prioritize Associate, then Supervisor, then Manager

        foreach ($units as $unit) {
            $assigned = false;
            foreach ($roleIds as $roleId) {
                // Find a user in this unit with this role
                $user = User::where('id_unit', $unit->id_unit)
                    ->where('id_role_jabatan', $roleId)
                    ->where('status_aktif', 1) // Ensure active
                    ->first();

                if ($user) {
                    $user->update(['can_submit_document' => true]);
                    $this->command->info("Assigned submitter for Unit {$unit->nama_unit}: {$user->nama_user} (Role ID: {$roleId})");
                    $assigned = true;
                    break;
                }
            }

            if (!$assigned) {
                $this->command->warn("No eligible user (Role 4, 5, 6) found for Unit {$unit->nama_unit}");
            }
        }

        // Also ensure specific known test user gets it if missed
        /*
        $testUser = User::where('username', 'ABD.RAHMAN3140')->first();
        if ($testUser) {
             $testUser->update(['can_submit_document' => true]);
        }
        */
    }
}
