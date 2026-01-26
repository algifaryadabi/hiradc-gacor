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
            'B' => 20,  // Proses/Kegiatan (Kol 2)
            'C' => 20,  // Lokasi (Kol 3)
            'D' => 12,  // Kategori (Kol 4)
            'E' => 12,  // Kondisi (Kol 5)
            'F' => 25,  // Potensi Bahaya (Kol 6)
            'G' => 25,  // Aspek Lingkungan (Kol 7)
            'H' => 25,  // Ancaman Keamanan (Kol 8)
            'I' => 20,  // Risiko K3 (Kol 9)
            'J' => 20,  // Dampak Lingkungan (Kol 9)
            'K' => 20,  // Celah Keamanan (Kol 9)
            'L' => 30,  // Hirarki Pengendalian (Kol 10)
            'M' => 30,  // Pengendalian Existing (Kol 11)
            'N' => 5,   // L (Kol 12)
            'O' => 5,   // S (Kol 13)
            'P' => 10,  // Level (Kol 14)
            'Q' => 25,  // Regulasi (Kol 15)
            'R' => 15,  // Aspek Penting (Kol 16)
            'S' => 25,  // Peluang & Risiko (Kol 17)
            'T' => 10,  // Toleransi (Kol 18)
            'U' => 30,  // Pengendalian Lanjut (Kol 19)
            'V' => 5,   // L Lanjut (Kol 20)
            'W' => 5,   // S Lanjut (Kol 21)
            'X' => 10,  // Level Lanjut (Kol 22)
            'Y' => 5,   // Res L
            'Z' => 5,   // Res S
            'AA' => 10, // Res Level
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
                $lastColumn = 'AA'; // Updated last column to AA (27 cols)
                $range = "A1:{$lastColumn}{$lastRow}";

                // 2. Alignment: Vertical Top, Horizontal Left (Wrap text enabled)
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $sheet->getStyle($range)->getAlignment()->setWrapText(true);

                // 3. Header Styling (Rows 9 and 10 contain the table headers now)
                // Row 1-3: Titles
                // Row 4-7: Metadata (inc. Mines Business)
                // Row 8: Spacer
                // Row 9-10: Table Headers
                
                $headerRange = "A9:{$lastColumn}10";
                $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle($headerRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle($headerRange)->getFont()->setBold(true);
                $sheet->getStyle($headerRange)->getFill()
                      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                      ->getStartColor()->setARGB('E0E0E0E0'); // Light Gray

                // 4. Center align specific small columns (Risk matrix values, Levels, No, etc.)
                $centerColumns = [
                    'A', // No
                    'D', // Kategori
                    'E', // Kondisi
                    'N', 'O', 'P', // Risk Initial (L, S, Level)
                    'R', // Aspek Penting - wait, actually Aspek Penting might be text? Let's check typical content. Blade says text. Keep 'T' (Toleransi) instead.
                    'T', // Toleransi
                    'V', 'W', 'X', // Risk Lanjut
                    'Y', 'Z', 'AA' // Residual
                ];
                
                foreach ($centerColumns as $col) {
                    $sheet->getStyle("{$col}9:{$col}{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // 5. Borders for the Data Table (Starting from Row 9)
                $tableRange = "A9:{$lastColumn}{$lastRow}";
                $sheet->getStyle($tableRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // 6. Distinct Separator for Header (Thick bottom border on Row 10)
                $sheet->getStyle("A10:{$lastColumn}10")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_MEDIUM);
                
                // 7. Title Styling adjustments
                $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
                $sheet->getStyle('A2')->getFont()->setSize(12)->setBold(true);
                
                // 8. Metadata styling (Row 4-7)
                $sheet->getStyle('A4:C7')->getFont()->setBold(true); // Labels Left
                $sheet->getStyle('K4:M6')->getFont()->setBold(true); // Labels Right
            },
        ];
    }
}
