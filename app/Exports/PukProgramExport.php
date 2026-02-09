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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PukProgramExport implements FromView, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function view(): View
    {
        $pukProgram = $this->document->pukProgram;
        return view('documents.export_puk_excel', [
            'document' => $this->document,
            'pukProgram' => $pukProgram
        ]);
    }

    public function title(): string
    {
        $unitName = $this->document->unit ? $this->document->unit->nama_unit : 'Unit';
        return 'PUK ' . substr($unitName, 0, 20);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 35,  // Uraian Kegiatan
            'C' => 15,  // Koordinator
            'D' => 15,  // Pelaksana
            'E' => 6,   // Target Bulan 1
            'F' => 6,   // Target Bulan 2
            'G' => 6,   // Target Bulan 3
            'H' => 6,   // Target Bulan 4
            'I' => 6,   // Target Bulan 5
            'J' => 6,   // Target Bulan 6
            'K' => 6,   // Target Bulan 7
            'L' => 6,   // Target Bulan 8
            'M' => 6,   // Target Bulan 9
            'N' => 6,   // Target Bulan 10
            'O' => 6,   // Target Bulan 11
            'P' => 6,   // Target Bulan 12
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the entire sheet
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // 1. Global Font
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
                $sheet->getParent()->getDefaultStyle()->getFont()->setSize(10);
                
                $lastRow = $sheet->getHighestRow();
                $lastColumn = 'P';
                $range = "A1:{$lastColumn}{$lastRow}";

                // 2. Alignment: Vertical Top, Horizontal Left (Wrap text enabled)
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $sheet->getStyle($range)->getAlignment()->setWrapText(true);

                // 3. Borders for all cells
                $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // 4. Center align for specific columns
                $centerColumns = ['A', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P'];
                foreach ($centerColumns as $col) {
                    $sheet->getStyle("{$col}1:{$col}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // 5. Bold and background for headers (adjust based on actual row structure)
                // Assuming cover page ends around row 10, and table headers start later
                // This will be refined based on the actual view template
            },
        ];
    }
}
