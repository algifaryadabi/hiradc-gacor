<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\Seksi;
use App\Models\BusinessProcess;
use Illuminate\Support\Str;

class UnitProbisSeeder extends Seeder
{
    public function run()
    {
        $probisList = BusinessProcess::all();
        $units = Unit::all();
        $seksis = Seksi::all();

        // 1. Map Units
        foreach ($units as $unit) {
            $matchedProbis = null;
            foreach ($probisList as $probis) {
                // Check if Unit Name contains Probis Code (e.g. 'SHE')
                if (stripos($unit->nama_unit, $probis->kode_probis) !== false) {
                    $matchedProbis = $probis;
                    break;
                }
                // Check if Unit Name contains Probis Name parts (e.g. 'Audit')
                // Split probis name into words, check if significant words exist in unit name
                $words = explode(' ', $probis->nama_probis);
                $matches = 0;
                $significantWords = 0;
                foreach ($words as $word) {
                    if (strlen($word) > 3 && strtolower($word) != 'and') {
                        $significantWords++;
                        if (stripos($unit->nama_unit, $word) !== false) {
                            $matches++;
                        }
                    }
                }

                if ($significantWords > 0 && $matches >= $significantWords * 0.7) { // 70% match
                    $matchedProbis = $probis;
                    break;
                }
            }

            if ($matchedProbis) {
                $unit->update(['id_probis' => $matchedProbis->id]);
                $this->command->info("Mapped Unit: {$unit->nama_unit} -> {$matchedProbis->kode_probis}");
            }
        }

        // 2. Map Seksis
        foreach ($seksis as $seksi) {
            $matchedProbis = null;
            foreach ($probisList as $probis) {
                if (stripos($seksi->nama_seksi, $probis->kode_probis) !== false) {
                    $matchedProbis = $probis;
                    break;
                }
                // Check keywords
                $words = explode(' ', $probis->nama_probis);
                $matches = 0;
                $significantWords = 0;
                foreach ($words as $word) {
                    if (strlen($word) > 3 && strtolower($word) != 'and') {
                        $significantWords++;
                        if (stripos($seksi->nama_seksi, $word) !== false) {
                            $matches++;
                        }
                    }
                }
                if ($significantWords > 0 && $matches >= $significantWords * 0.7) {
                    $matchedProbis = $probis;
                    break;
                }
            }

            if ($matchedProbis) {
                $seksi->update(['id_probis' => $matchedProbis->id]);
                $this->command->info("Mapped Seksi: {$seksi->nama_seksi} -> {$matchedProbis->kode_probis}");
            }
        }
    }
}
