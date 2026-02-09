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
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PmkProgramExport implements FromView, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function view(): View
    {
        $pmkProgram = $this->document->pmkProgram;
        return view('documents.export_pmk_excel', [
            'document' => $this->document,
            'pmkProgram' => $pmkProgram
        ]);
    }

    public function title(): string
    {
        $unitName = $this->document->unit ? $this->document->unit->nama_unit : 'Unit';
        return 'PMK_' . substr($unitName, 0, 20);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 35,  // Uraian Kegiatan
            'C' => 15,  // PIC
            'D' => 6,   // Target 1
            'E' => 6,   // Target 2
            'F' => 6,   // Target 3
            'G' => 6,   // Target 4
            'H' => 6,   // Target 5
            'I' => 6,   // Target 6
            'J' => 6,   // Target 7
            'K' => 6,   // Target 8
            'L' => 6,   // Target 9
            'M' => 6,   // Target 10
            'N' => 6,   // Target 11
            'O' => 6,   // Target 12
            'P' => 15,  // Anggaran
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Apply borders to all cells
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ]);
                
                // Auto-size columns
                foreach(range('A', $highestColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(false);
                }
            },
        ];
    }
}
