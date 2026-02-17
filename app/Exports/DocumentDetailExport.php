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
        // Fetch latest revision note
        $latestRevision = null;
        $lastApproval = $this->document->approvals()->whereIn('action', ['resubmitted', 'puk_resubmit', 'pmk_resubmit'])->latest()->first();
        if ($lastApproval) {
            $latestRevision = $lastApproval->catatan;
        }

        // Fetch revision histories for export
        try {
            $histories = $this->document->histories()
                ->with(['archivedBy'])
                ->orderBy('revision_number', 'desc')
                ->get();
        } catch (\Exception $e) {
            $histories = collect([]);
        }

        return view('documents.export_detail_excel', [
            'document' => $this->document,
            'latestRevision' => $latestRevision,
            'histories' => $histories
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
            'B' => 40,  // Proses/Kegiatan (Merged)
            'C' => 20,  // Lokasi
            'D' => 12,  // Kategori
            'E' => 12,  // Kondisi
            'F' => 25,  // Potensi Bahaya
            'G' => 25,  // Aspek Lingkungan
            'H' => 25,  // Ancaman Keamanan
            'I' => 20,  // Risiko/Dampak/Celah
            'J' => 30,  // Hirarki Pengendalian
            'K' => 30,  // Pengendalian Existing
            'L' => 5,   // L
            'M' => 5,   // S
            'N' => 10,  // Level
            'O' => 25,  // Regulasi
            'P' => 15,  // Aspek Penting
            'Q' => 25,  // Peluang & Risiko
            'R' => 10,  // Toleransi
            'S' => 30,  // Pengendalian Lanjut
            'T' => 5,   // L Lanjut
            'U' => 5,   // S Lanjut
            'V' => 10,  // Level Lanjut
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
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1. Global Font and Alignment
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
                $sheet->getParent()->getDefaultStyle()->getFont()->setSize(10);

                $lastRow = $sheet->getHighestRow();
                $lastColumn = 'V'; // Updated last column to V (22 cols)
                $range = "A1:{$lastColumn}{$lastRow}";

                // 2. Alignment: Vertical Top, Horizontal Left (Wrap text enabled)
                $sheet->getStyle($range)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                $sheet->getStyle($range)->getAlignment()->setWrapText(true);

                // 3. Header Styling (Rows 9 and 10 contain the table headers now)
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
                    'L', // L
                    'M', // S
                    'N', // Level
                    'P', // Aspek Penting (P/TP)
                    'R', // Toleransi
                    'T', // L Lanjut
                    'U', // S Lanjut
                    'V'  // Level Lanjut
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
