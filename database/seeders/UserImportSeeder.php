<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('db_users.csv');

        if (!file_exists($csvFile)) {
            $this->command->error("File not found: $csvFile");
            return;
        }

        // Disable Foreign Key Checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        $this->command->info('Users table truncated.');

        $handle = fopen($csvFile, "r");
        if ($handle === false) {
            $this->command->error("Failed to open file: $csvFile");
            DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Re-enable if fail
            return;
        }

        // Get Header
        $header = fgetcsv($handle, 1000, ";");
        // Verify header or just assume order based on inspection:
        // id_user;username;nama_user;email_user;id_direktorat;id_dept;id_unit;id_seksi;role_jabatan;password;foto_user;role_user;user_aktif

        $batchSize = 500;
        $batch = [];
        $count = 0;
        $total = 0;

        $now = now();
        // Default password hash for efficiency if many are same? 
        // No, salt differs. But 'semenpadang 1' is common.
        // To speed up, we can pre-hash 'semenpadang 1' but Laravel's Hash::make uses bcrypt/argon2 which has random salt. 
        // So we must hash individually or accept same hash (insecure but fast for bulk import of identical passwords).
        // For security, individual hash is better. But 1200 is small enough to just do it.

        $seenUsernames = [];

        while (($data = fgetcsv($handle, 2000, ";")) !== false) {
            // Skip empty rows
            if (count($data) < 4)
                continue;

            // Map keys
            $username = $data[1];

            // Check for duplicate username in CSV
            if (in_array($username, $seenUsernames)) {
                $this->command->warn("Skipping duplicate username: $username");
                continue;
            }
            $seenUsernames[] = $username;

            $row = [
                'id_user' => $data[0],
                'username' => $username,
                'nama_user' => $data[2],
                'email_user' => $data[3],
                'id_direktorat' => $data[4] === '' ? null : $data[4],
                'id_dept' => $data[5] === '' ? null : $data[5],
                'id_unit' => $data[6] === '' ? null : $data[6],
                'id_seksi' => $data[7] === '' ? null : $data[7],
                'role_jabatan' => $data[8] === '' ? null : $data[8],
                'password' => Hash::make($data[9] ?: 'semenpadang 1'),
                'foto_user' => $data[10] === '' ? null : $data[10],
                'role_user' => $data[11] === '' ? null : $data[11],
                'user_aktif' => $data[12] === '' ? 1 : $data[12],
                'created_at' => $now,
                'updated_at' => $now,
            ];

            // Also set id_role_jabatan/id_role_user as duplicates if desired, but schema said 'role_jabatan' is foreign key?
            // Checking User model: belongsTo RoleJabatan with 'role_jabatan' foreign key. So 'role_jabatan' column is correct.
            // Model fillable has 'id_role_jabatan', let's check migration/schema if possible?
            // Assuming CSV column 'role_jabatan' connects to FK.

            $batch[] = $row;
            $count++;
            $total++;

            if ($total % 50 == 0) {
                $this->command->info("Processed $total records...");
            }

            if ($count >= $batchSize) {
                DB::table('users')->insert($batch);
                $this->command->info("Inserted batch of $batchSize. Total: $total");
                $batch = [];
                $count = 0;
            }
        }

        // Insert remaining
        if (!empty($batch)) {
            DB::table('users')->insert($batch);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        fclose($handle);
        $this->command->info("User import completed. Total records: $total");
    }
}
