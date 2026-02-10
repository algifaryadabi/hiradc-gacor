<?php

namespace App\Exports;

use App\Models\Document;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class PukProgramExport implements FromCollection, WithTitle, WithStyles, WithEvents
{
    protected $document;
    protected $pukProgram;

    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->document->load(['pukProgram', 'user', 'unit']);
        $this->pukProgram = $this->document->pukProgram;
    }

    public function collection()
    {
        // Return empty collection - we'll build everything in AfterSheet
        return collect([]);
    }

    public function title(): string
    {
        $unitName = $this->document->unit ? $this->document->unit->nama_unit : 'Unit';
        return 'PUK ' . substr($unitName, 0, 20);
    }


    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Get data
                $unitName = $this->document->unit ? $this->document->unit->nama_unit : '-';
                $tanggal = $this->pukProgram->approved_at 
                    ? $this->pukProgram->approved_at->locale('id')->isoFormat('D MMMM YYYY') 
                    : now()->locale('id')->isoFormat('D MMMM YYYY');
                
                // Get Kepala Seksi and Kepala Unit
                $kaSeksi = null;
                $kaSeksiJabatan = 'Ka. Seksi';
                if ($this->document->user && $this->document->user->id_seksi) {
                    $kaSeksi = User::where('id_seksi', $this->document->user->id_seksi)
                                   ->where('role_jabatan', 4)
                                   ->where('user_aktif', 1)
                                   ->with('roleJabatan')
                                   ->first();
                    if ($kaSeksi && $kaSeksi->roleJabatan) {
                        $kaSeksiJabatan = $kaSeksi->roleJabatan->nama_role_jabatan;
                    }
                }
                
                $kaUnit = null;
                $kaUnitJabatan = 'Ka. Unit';
                if ($this->document->id_unit) {
                    $kaUnit = User::where('id_unit', $this->document->id_unit)
                                  ->where('role_jabatan', 3)
                                  ->where('user_aktif', 1)
                                  ->with('roleJabatan')
                                  ->first();
                    if ($kaUnit && $kaUnit->roleJabatan) {
                        $kaUnitJabatan = $kaUnit->roleJabatan->nama_role_jabatan;
                    }
                }

                $currentRow = 1;

                // === COVER SECTION ===
                // Title
                $sheet->setCellValue("A{$currentRow}", 'PROGRAM UNIT KERJA (PUK)');
                $sheet->mergeCells("A{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                // Subtitle
                $sheet->setCellValue("A{$currentRow}", 'K3/KO/LINGKUNGAN/PENGAMANAN*');
                $sheet->mergeCells("A{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true)->setSize(12);
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                $currentRow++; // Empty row

                // Unit and Date
                $sheet->setCellValue("A{$currentRow}", "Unit: {$unitName}");
                $sheet->mergeCells("A{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                $sheet->setCellValue("A{$currentRow}", "Tanggal: Padang, {$tanggal}");
                $sheet->mergeCells("A{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                $currentRow++; // Empty row

                // Signature Section
                $signatureRow = $currentRow;
                $sheet->setCellValue("A{$signatureRow}", 'Disiapkan oleh');
                $sheet->mergeCells("A{$signatureRow}:H{$signatureRow}");
                $sheet->getStyle("A{$signatureRow}")->getFont()->setBold(true);
                $sheet->getStyle("A{$signatureRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue("I{$signatureRow}", 'Disahkan oleh');
                $sheet->mergeCells("I{$signatureRow}:Q{$signatureRow}");
                $sheet->getStyle("I{$signatureRow}")->getFont()->setBold(true);
                $sheet->getStyle("I{$signatureRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                $currentRow += 2; // Space for signature

                // Names
                $nameRow = $currentRow;
                $kaSeksiName = $kaSeksi ? $kaSeksi->nama_user : '........................';
                $kaUnitName = $kaUnit ? $kaUnit->nama_user : '........................';
                
                $sheet->setCellValue("A{$nameRow}", $kaSeksiName);
                $sheet->mergeCells("A{$nameRow}:H{$nameRow}");
                $sheet->getStyle("A{$nameRow}")->getFont()->setBold(true);
                $sheet->getStyle("A{$nameRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue("I{$nameRow}", $kaUnitName);
                $sheet->mergeCells("I{$nameRow}:Q{$nameRow}");
                $sheet->getStyle("I{$nameRow}")->getFont()->setBold(true);
                $sheet->getStyle("I{$nameRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                // Positions
                $sheet->setCellValue("A{$currentRow}", $kaSeksiJabatan);
                $sheet->mergeCells("A{$currentRow}:H{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->setCellValue("I{$currentRow}", $kaUnitJabatan);
                $sheet->mergeCells("I{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("I{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentRow++;

                $currentRow++;

                $currentRow++; // Empty row

                // === INFO SECTION ===
                $infoStartRow = $currentRow;
                
                $sheet->setCellValue("A{$currentRow}", 'Judul Program');
                $sheet->setCellValue("B{$currentRow}", ': ' . $this->pukProgram->judul);
                $sheet->mergeCells("B{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
                $currentRow++;

                $sheet->setCellValue("A{$currentRow}", 'Tujuan');
                $sheet->setCellValue("B{$currentRow}", ': ' . $this->pukProgram->tujuan);
                $sheet->mergeCells("B{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
                $currentRow++;

                $sheet->setCellValue("A{$currentRow}", 'Sasaran');
                $sheet->setCellValue("B{$currentRow}", ': ' . $this->pukProgram->sasaran);
                $sheet->mergeCells("B{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
                $currentRow++;

                $sheet->setCellValue("A{$currentRow}", 'Penanggung Jawab');
                $sheet->setCellValue("B{$currentRow}", ': ' . $this->pukProgram->penanggung_jawab);
                $sheet->mergeCells("B{$currentRow}:Q{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
                $currentRow++;

                if ($this->pukProgram->uraian_revisi) {
                    $sheet->setCellValue("A{$currentRow}", 'Uraian Revisi');
                    $sheet->setCellValue("B{$currentRow}", ': ' . $this->pukProgram->uraian_revisi);
                    $sheet->mergeCells("B{$currentRow}:Q{$currentRow}");
                    $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true);
                    $currentRow++;
                }

                // Style info section
                $infoEndRow = $currentRow - 1;
                $sheet->getStyle("A{$infoStartRow}:Q{$infoEndRow}")
                    ->getBorders()
                    ->getOutline()
                    ->setBorderStyle(Border::BORDER_THIN);

                $currentRow++; // Empty row

                // === TABLE SECTION ===
                $sheet->setCellValue("A{$currentRow}", 'Detail Kegiatan');
                $sheet->getStyle("A{$currentRow}")->getFont()->setBold(true)->setSize(12);
                $sheet->getStyle("A{$currentRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $currentRow++;

                // Table Headers - Main row
                $headerRow = $currentRow;
                
                // NO - rowspan 2 (merge with next row)
                $sheet->setCellValue("A{$headerRow}", 'NO');
                $sheet->mergeCells("A{$headerRow}:A" . ($headerRow + 1));
                
                // URAIAN KEGIATAN - rowspan 2
                $sheet->setCellValue("B{$headerRow}", 'URAIAN KEGIATAN');
                $sheet->mergeCells("B{$headerRow}:B" . ($headerRow + 1));
                
                // KOORDINATOR - rowspan 2
                $sheet->setCellValue("C{$headerRow}", 'KOORDINATOR');
                $sheet->mergeCells("C{$headerRow}:C" . ($headerRow + 1));
                
                // PELAKSANA - rowspan 2
                $sheet->setCellValue("D{$headerRow}", 'PELAKSANA');
                $sheet->mergeCells("D{$headerRow}:D" . ($headerRow + 1));
                
                // TARGET (%) - colspan 12
                $sheet->setCellValue("E{$headerRow}", 'TARGET (%)');
                $sheet->mergeCells("E{$headerRow}:P{$headerRow}");
                
                // ANGGARAN - rowspan 2
                $sheet->setCellValue("Q{$headerRow}", 'ANGGARAN');
                $sheet->mergeCells("Q{$headerRow}:Q" . ($headerRow + 1));
                
                // Style main header
                $sheet->getStyle("A{$headerRow}:Q{$headerRow}")
                    ->getFont()->setBold(true);
                $sheet->getStyle("A{$headerRow}:Q{$headerRow}")
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("A{$headerRow}:Q{$headerRow}")
                    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                
                $currentRow++;

                // Sub-header (Month numbers) - only for TARGET columns
                $subHeaderRow = $currentRow;
                // A, B, C, D are already merged from main header
                // Only fill E-P with month numbers
                for ($m = 1; $m <= 12; $m++) {
                    $col = chr(68 + $m); // E=69, so 68+1=69=E
                    $sheet->setCellValue("{$col}{$subHeaderRow}", $m);
                }
                // Q is already merged from main header

                // Style sub-header
                $sheet->getStyle("E{$subHeaderRow}:P{$subHeaderRow}")
                    ->getFont()->setBold(true);
                $sheet->getStyle("A{$subHeaderRow}:Q{$subHeaderRow}")
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("A{$subHeaderRow}:Q{$subHeaderRow}")
                    ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                $currentRow++;

                // Table Data
                $programKerja = $this->pukProgram->program_kerja ?? [];
                if (is_array($programKerja) && count($programKerja) > 0) {
                    foreach ($programKerja as $index => $item) {
                        $dataRow = $currentRow;
                        
                        // Number
                        $sheet->setCellValue("A{$dataRow}", $index + 1);
                        $sheet->getStyle("A{$dataRow}")
                            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                        $sheet->getStyle("A{$dataRow}")->getFont()->setBold(true);
                        
                        // Uraian
                        $sheet->setCellValue("B{$dataRow}", $item['uraian'] ?? '-');
                        $sheet->getStyle("B{$dataRow}")->getAlignment()->setWrapText(true);
                        
                        // Koordinator
                        $sheet->setCellValue("C{$dataRow}", $item['koordinator'] ?? '-');
                        
                        // Pelaksana
                        $sheet->setCellValue("D{$dataRow}", $item['pelaksana'] ?? '-');
                        
                        // Targets (12 months)
                        $targets = $item['target'] ?? [];
                        for ($m = 0; $m < 12; $m++) {
                            $col = chr(69 + $m); // E=69
                            $value = isset($targets[$m]) && $targets[$m] !== '' && $targets[$m] !== null ? $targets[$m] : '-';
                            $sheet->setCellValue("{$col}{$dataRow}", $value);
                            $sheet->getStyle("{$col}{$dataRow}")
                                ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                            if ($value !== '-') {
                                $sheet->getStyle("{$col}{$dataRow}")->getFont()->setBold(true);
                            }
                        }
                        
                        // Anggaran
                        $anggaran = isset($item['anggaran']) && $item['anggaran'] 
                            ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') 
                            : '-';
                        $sheet->setCellValue("Q{$dataRow}", $anggaran);
                        $sheet->getStyle("Q{$dataRow}")
                            ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                        
                        // Borders for data row
                        $sheet->getStyle("A{$dataRow}:Q{$dataRow}")
                            ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
                        
                        $currentRow++;
                    }
                } else {
                    $sheet->setCellValue("A{$currentRow}", 'Belum ada detail program kerja');
                    $sheet->mergeCells("A{$currentRow}:Q{$currentRow}");
                    $sheet->getStyle("A{$currentRow}")
                        ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("A{$currentRow}")->getFont()->setItalic(true);
                    $currentRow++;
                }

                // Global settings
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
                $sheet->getStyle("A1:Q{$currentRow}")->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
                
                // Auto-size all columns to fit content
                foreach (range('A', 'Q') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
