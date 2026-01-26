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

class DocumentDetailExport implements FromView, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function view(): View
    {
        return view('documents.export_detail_excel', [
            'document' => $this->document
        ]);
    }

    public function title(): string
    {
        return 'HIRADC ' . $this->document->id;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Proses
            'C' => 25,  // Kegiatan
            'D' => 15,  // Lokasi
            'E' => 15,  // Kondisi
            'F' => 35,  // Bahaya (Deserves space)
            'G' => 20,  // Dampak
            'H' => 12,  // Risiko Awal
            'I' => 30,  // Pengendalian Existing
            'J' => 5,   // P
            'K' => 5,   // C
            'L' => 8,   // Score
            'M' => 10,  // Level
            'N' => 20,  // Peraturan
            'O' => 30,  // Pengendalian Lanjut
            'P' => 5,   // Res P
            'Q' => 5,   // Res C
            'R' => 8,   // Res Score
            'S' => 10,  // Res Level
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the entire sheet
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // 1. Global Font and Alignment
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
                $sheet->getParent()->getDefaultStyle()->getFont()->setSize(10);
                
                $lastRow = $sheet->getHighestRow();
                $lastColumn = 'S';
                $range = "A1:{$lastColumn}{$lastRow}";

                // 2. Alignment: Vertical Top, Horizontal Left (Wrap text enabled)
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $sheet->getStyle($range)->getAlignment()->setWrapText(true);

                // 3. Header Styling (Rows 8 and 9 contain the table headers)
                // Note: Header rows might differ based on metadata size. 
                // Based on blade:
                // Row 1-3: Titles
                // Row 4-6: Metadata
                // Row 7: Spacer
                // Row 8-9: Table Headers
                
                $headerRange = "A8:S9";
                $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle($headerRange)->getFont()->setBold(true);
                $sheet->getStyle($headerRange)->getFill()
                      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                      ->getStartColor()->setARGB('E0E0E0E0'); // Light Gray

                // 4. Center align specific small columns (Risk matrix values)
                // J, K, L, M (Risk)
                // P, Q, R, S (Residual)
                $centerColumns = ['A', 'J', 'K', 'L', 'M', 'P', 'Q', 'R', 'S'];
                foreach ($centerColumns as $col) {
                    $sheet->getStyle("{$col}8:{$col}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // 5. Borders for the Data Table (Starting from Row 8)
                $tableRange = "A8:{$lastColumn}{$lastRow}";
                $sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                
                // 6. Title Styling adjustments
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);
                
                // 7. Metadata styling (Row 4-6)
                $sheet->getStyle('A4:C6')->getFont()->setBold(true); // Labels Left
                $sheet->getStyle('K4:M6')->getFont()->setBold(true); // Labels Right
            },
        ];
    }
}
