<?php

namespace App\Exports;

use App\Models\Document;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PmkProgramExport implements FromView, WithTitle, WithStyles, WithColumnWidths, WithEvents, WithDrawings
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function drawings()
    {
        $logoPath = public_path('images/logo-semen-padang.png');
        if (file_exists($logoPath)) {
            $drawing = new Drawing();
            $drawing->setName('Logo Semen Padang');
            $drawing->setDescription('Logo PT Semen Padang');
            $drawing->setPath($logoPath);
            $drawing->setHeight(80);
            $drawing->setCoordinates('I6'); // Centered around column I
            $drawing->setOffsetX(-40); // Slightly shift left to center

            return $drawing;
        }
        return [];
    }

    public function view(): View
    {
        $pmkProgram = $this->document->pmkProgram;

        // Fetch latest revision note
        $latestRevision = null;
        if (!empty($pmkProgram->uraian_revisi)) {
            $latestRevision = $pmkProgram->uraian_revisi;
        } else {
            $lastApproval = $this->document->approvals()->whereIn('action', ['resubmitted', 'pmk_resubmit'])->latest()->first();
            if ($lastApproval) {
                $latestRevision = $lastApproval->catatan;
            }
        }

        // === Signatory Logic ===
        // 1. Kepala Unit
        $kaUnit = $pmkProgram->approvedByUnit;
        if (!$kaUnit && $this->document->id_unit) {
            $kaUnit = \App\Models\User::where('id_unit', $this->document->id_unit)
                ->where('role_jabatan', 3) // Kepala Unit
                ->where('user_aktif', 1)
                ->first();
        }

        // 2. Kepala Departemen
        $kaDept = $pmkProgram->approvedByDept;
        if (!$kaDept && $this->document->id_dept) {
            $kaDept = \App\Models\User::where('id_dept', $this->document->id_dept)
                ->where('role_jabatan', 2) // Kepala Departemen
                ->where('user_aktif', 1)
                ->first();
        }

        // 3. Direktur
        $direktur = $pmkProgram->approvedByDireksi;
        if (!$direktur && $this->document->id_direktorat) {
            $direktur = \App\Models\User::where('id_direktorat', $this->document->id_direktorat)
                ->where('role_jabatan', 1) // Direktur
                ->where('user_aktif', 1)
                ->first();
        }

        return view('documents.export_pmk_excel', [
            'document' => $this->document,
            'pmkProgram' => $pmkProgram,
            'latestRevision' => $latestRevision,
            'kaUnit' => $kaUnit,
            'kaDept' => $kaDept,
            'direktur' => $direktur
        ]);
    }

    public function title(): string
    {
        $unitName = $this->document->unit ? $this->document->unit->nama_unit : 'Unit';

        // Remove invalid characters for Excel sheet names: \ / ? * [ ] :
        $cleanName = str_replace(['\\', '/', '?', '*', '[', ']', ':'], '', $unitName);

        // Prefix
        $title = 'PMK ' . $cleanName;

        // Strict limit to 31 characters
        return mb_substr($title, 0, 31);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 45,  // Uraian Kegiatan (Wider)
            'C' => 15,  // PIC
            'D' => 15,  // Pelaksana
            // E-P Target Columns (Auto or fixed small)
            'E' => 5,
            'F' => 5,
            'G' => 5,
            'H' => 5,
            'I' => 5,
            'J' => 5,
            'K' => 5,
            'L' => 5,
            'M' => 5,
            'N' => 5,
            'O' => 5,
            'P' => 5,
            'Q' => 20,  // Anggaran
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Default font
            1 => ['font' => ['name' => 'Arial', 'size' => 11]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1. Text Wrap & Alignment for Content
                $sheet->getStyle('B')->getAlignment()->setWrapText(true);
                $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E:P')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('Q')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);

                // 2. Vertical Align Middle for ease of reading
                $sheet->getStyle('A:Q')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            },
        ];
    }
}
