<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CheckDocumentEvaluation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hiradc:check-evaluation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for documents that need annual evaluation (1 year since last review)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking documents for annual evaluation...');

        // Find all published documents where last_review_date is >= 365 days ago
        $oneYearAgo = Carbon::now()->subDays(365);

        $documentsNeedingEvaluation = Document::where('status', 'published')
            ->whereNotNull('last_review_date')
            ->where('last_review_date', '<=', $oneYearAgo->format('Y-m-d'))
            ->where('is_need_evaluation', false) // Only flag once
            ->with(['user', 'unit'])
            ->get();

        if ($documentsNeedingEvaluation->isEmpty()) {
            $this->info('No documents need evaluation at this time.');
            return;
        }

        $this->info("Found {$documentsNeedingEvaluation->count()} document(s) needing evaluation.");

        foreach ($documentsNeedingEvaluation as $document) {
            try {
                // 1. Set evaluation flag
                $document->is_need_evaluation = true;
                $document->save();

                // 2. Get Kepala Unit email
                $kepalaUnit = User::where('id_unit', $document->id_unit)
                    ->where('role_jabatan', 3) // Senior Manager (Kepala Unit)
                    ->first();

                if (!$kepalaUnit || !$kepalaUnit->email) {
                    $this->warn("No Kepala Unit email found for document ID: {$document->id}");
                    continue;
                }

                // 3. Send email notification
                $unitName = $document->unit->nama_unit ?? 'Unknown Unit';
                $documentTitle = $document->judul_dokumen ?? 'HIRADC Document';
                $lastReviewDate = Carbon::parse($document->last_review_date)->format('d M Y');

                Mail::send('emails.document_evaluation_reminder', [
                    'kepalaName' => $kepalaUnit->nama_user,
                    'documentTitle' => $documentTitle,
                    'unitName' => $unitName,
                    'lastReviewDate' => $lastReviewDate,
                    'documentUrl' => route('documents.published.detail', $document->id),
                ], function ($message) use ($kepalaUnit, $unitName) {
                    $message->to($kepalaUnit->email)
                        ->subject("Peringatan Evaluasi Tahunan Dokumen HIRADC - {$unitName}");
                });

                $this->info("✓ Email sent to {$kepalaUnit->email} for document ID: {$document->id}");

            } catch (\Exception $e) {
                $this->error("Failed to process document ID {$document->id}: {$e->getMessage()}");
            }
        }

        $this->info('Annual evaluation check completed.');
    }
}
