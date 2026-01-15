<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class CorrectiveUnitProbisSeeder extends Seeder
{
    public function run()
    {
        // Manual Mapping based on Unit Name keywords and corrected IDs
        // Probis IDs ref:
        // 22: PRD (Production)
        // 23: PRO (Procurement)
        // 17: MKT (Marketing)
        // 18: MTC (Maintenance)
        // 9: GAS (Security/GA)
        // 16: LGL (Legal)
        // 5: COM (Communication)
        // 1: AUD (Audit)
        // 26: SHE (Safety)
        // 7: DIT (Distribution)
        // 8: FNC (Finance)
        // 11: HCM (Human Capital)
        // 24: QCA (Quality)

        $map = [
            'Audit' => 1,
            'Communication' => 5,
            'CSR' => 6,
            'Accounting' => 8,
            'Finance' => 8,
            'Financial' => 8,
            'Security' => 9,
            'General Affair' => 9,
            'Legal' => 16,
            'Marketing' => 17,
            'Sales' => 17,
            'Maintenance' => 18,
            'Maint' => 18,
            'Mech' => 18, // Mech Maint
            'Elins' => 18, // Elins Maint
            'Production' => 22,
            'Prod' => 22, // Fix 'Prod' mapping to PRD, not PRO
            'Mining' => 22, // Assuming Mining is Production
            'Clinker' => 22,
            'Cement' => 22,
            'Packing' => 22, // Packing Plant -> Production? Or Distribution? Usually Production in this context.
            'Procurement' => 23,
            'Purchase' => 23,
            'Inventory' => 23,
            'Quality' => 24,
            'Health' => 26,
            'Safety' => 26,
            'SHE' => 26,
            'Logist' => 7, // Logistic -> Distribution
            'Wareh' => 23, // Warehouse -> Procurement/Inventory
            'Human' => 11,
            'People' => 11,
            'Learn' => 11, // Learning
            'Project' => 4, // COE? Or PMT? Project Management is 4.
        ];

        $units = Unit::all();

        foreach ($units as $unit) {
            $name = $unit->nama_unit;
            $matchedId = null;

            // Prioritize specific overrides if needed
            if (stripos($name, 'Non Cement Incubation') !== false) {
                $matchedId = 2; // BDV?
            }

            if (!$matchedId) {
                foreach ($map as $keyword => $id) {
                    if (stripos($name, $keyword) !== false) {
                        $matchedId = $id;
                        // Don't break immediately if we want longest match, but keyword order matters
                        // For now break on first match from our ordered map? 
                        // Actually 'Prod' is in 'Production', so we mapped both to 22.
                        break;
                    }
                }
            }

            if ($matchedId) {
                // Special check to avoid overwriting correct things if we are unsure?
                // But we know 'Prod' mapped to 23 (PRO) was wrong.

                // If it was mapped to 23 (Procurement) but has 'Prod' in name, force update to 22
                if ($unit->id_probis == 23 && stripos($name, 'Prod') !== false && stripos($name, 'Procure') === false) {
                    $unit->update(['id_probis' => 22]);
                    $this->command->info("Corrected {$name} to PRD (22)");
                }
                // Fill if null
                elseif (is_null($unit->id_probis)) {
                    $unit->update(['id_probis' => $matchedId]);
                    $this->command->info("Filled {$name} to ID {$matchedId}");
                }
            }
        }
    }
}
