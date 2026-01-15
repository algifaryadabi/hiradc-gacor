<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seksi;

class CorrectiveSeksiProbisSeeder extends Seeder
{
    public function run()
    {
        // Probis IDs ref:
        // 22: PRD (Production)
        // 23: PRO (Procurement)
        // 17: MKT (Marketing/Sales)
        // 18: MTC (Maintenance)
        // 9: GAS (Security/GA)
        // 16: LGL (Legal)
        // 5: COM (Communication)
        // 1: AUD (Audit)
        // 26: SHE (Safety)
        // 8: FNC (Finance)
        // 11: HCM (Human Capital)
        // 24: QCA (Quality)
        // 7: DIT (Distribution)

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
            'Mech' => 18, // Mechanical -> Maintenance usually
            'Elins' => 18, // Electrical Instrument -> Maintenance
            'Workshop' => 18,
            'Production' => 22,
            'Operation' => 22, // Operation often falls under Production scope
            'Mining' => 22,
            'Clinker' => 22,
            'Cement' => 22,
            'Packing' => 22,
            'Procurement' => 23,
            'Purchase' => 23,
            'Inventory' => 23,
            'Warehouse' => 23, // Warehouse -> Inventory/Procurement
            'Quality' => 24,
            'QA' => 24, // Quality Assurance
            'QC' => 24, // Quality Control
            'Health' => 26,
            'Safety' => 26,
            'SHE' => 26,
            'Environment' => 26,
            'Logist' => 7, // Logistic -> Distribution
            'Transport' => 7,
            'Human' => 11,
            'People' => 11,
            'Personnel' => 11,
            'Talent' => 11,
            'Fabrication' => 18, // Often Maint/Support
            'Planning' => 22, // Production Planning often PRD, but can be others. Default matching.
        ];

        $seksis = Seksi::all();

        foreach ($seksis as $seksi) {
            $name = $seksi->nama_seksi;
            $matchedId = null;

            // Prioritize specific overrides
            if (stripos($name, 'Sales') !== false) {
                $matchedId = 17;
            } elseif (stripos($name, 'Maint') !== false || stripos($name, 'Mech') !== false || stripos($name, 'Elins') !== false) {
                $matchedId = 18;
            } elseif (stripos($name, 'Operation') !== false || stripos($name, 'Prod') !== false) {
                $matchedId = 22;
            } elseif (stripos($name, 'Warehouse') !== false) {
                $matchedId = 23;
            } else {
                foreach ($map as $keyword => $id) {
                    if (stripos($name, $keyword) !== false) {
                        $matchedId = $id;
                        break;
                    }
                }
            }

            if ($matchedId) {
                $seksi->update(['id_probis' => $matchedId]);
                $this->command->info("Mapped Seksi: {$name} -> ID {$matchedId}");
            }
        }
    }
}
