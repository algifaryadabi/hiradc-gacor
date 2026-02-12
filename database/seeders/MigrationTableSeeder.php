<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrationTableSeeder extends Seeder
{
    /**
     * Seed the migrations table with existing migrations
     */
    public function run(): void
    {
        $migrations = [
            '2014_10_12_000000_create_users_table',
            '2014_10_12_100000_create_password_reset_tokens_table',
            '2019_08_19_000000_create_failed_jobs_table',
            '2019_12_14_000001_create_personal_access_tokens_table',
            '2024_02_04_000000_remove_residual_risk_columns_from_document_details',
            '2026_01_12_074800_update_documents_table_json',
            '2026_01_12_100000_create_documents_table',
            '2026_01_12_100001_create_document_approvals_table',
            '2026_01_13_021010_add_remember_token_to_users_table',
            '2026_01_13_033957_make_role_jabatan_nullable_in_users_table',
            '2026_01_14_100000_create_master_data_tables',
            '2026_01_15_010013_add_compliance_checklist_to_documents_table',
            '2026_01_15_072209_create_business_processes_table',
            '2026_01_15_072229_add_id_probis_to_unit_table',
            '2026_01_15_072819_add_id_probis_to_seksi_table',
            '2026_01_16_093608_add_can_submit_document_to_users_table',
            '2026_01_16_131800_drop_kolom8_pihak_from_documents_table',
            '2026_01_16_135225_add_level2_workflow_to_documents_table',
            '2026_01_16_190935_create_document_details_table',
            '2026_01_16_201252_add_judul_dokumen_to_documents_table',
            '2026_01_17_051238_add_level2_tracking_to_documents_table',
            '2026_01_17_122000_add_level2_columns_safe',
            '2026_01_17_170000_add_can_create_documents_to_users_table',
            '2026_01_17_170845_add_staff_assignment_to_documents_table',
            '2026_01_17_173000_create_can_create_documents_table',
            '2026_01_17_173100_modify_can_create_documents_in_users_table',
            '2026_01_17_202512_create_can_create_document_table',
            '2026_01_17_203129_add_can_create_document_to_users_table',
            '2026_01_18_060538_rename_pic_schema_tables',
            '2026_01_21_073942_add_follow_up_columns_to_document_details_table',
            '2026_01_21_081559_add_conditional_fields_to_document_details_table',
            '2026_01_21_083405_remove_obsolete_columns_from_documents_table',
            '2026_01_21_083532_remove_obsolete_columns_from_documents_table',
            '2026_01_21_083820_update_kolom7_dampak_nullable_in_document_details',
            '2026_01_21_083826_update_kolom7_dampak_nullable_in_document_details',
            '2026_01_22_023937_split_kolom9_into_separate_fields',
            '2026_01_22_023940_split_kolom9_into_separate_fields',
            '2026_01_22_071029_drop_kolom4_pihak_from_document_details',
            '2026_01_22_100000_drop_kolom4_pihak_from_document_details',
            '2026_01_26_152716_add_workflow_columns_to_documents_table',
            '2026_01_26_164734_update_unit_status_columns_to_string',
            '2026_01_28_014418_add_split_compliance_checklist_to_documents_table',
            '2026_01_28_131412_add_reviewer_verifier_to_users_table',
            '2026_01_29_090000_add_missing_is_reviewer_to_users',
            '2026_01_30_161347_add_status_to_document_details_table',
            '2026_02_03_155249_add_tolerance_and_program_fields_to_document_details_table',
            '2026_02_03_155257_create_puk_programs_table',
            '2026_02_03_155300_create_pmk_programs_table',
            '2026_02_04_150451_create_puk_pmk_edit_logs_table',
            '2026_02_05_153000_add_program_type_to_document_details',
            '2026_02_10_003807_create_document_archives_table',
            '2026_02_10_003815_add_revision_fields_to_documents_table',
            '2026_02_10_182530_add_she_sec_done_to_documents_table',
            '2026_02_11_074629_add_otp_columns_to_users_table',
            '2026_02_11_143009_update_documents_approval_status_enum',
            '2026_02_12_030134_change_pic_nullable_in_puk_pmk_programs'
        ];

        $data = [];
        foreach ($migrations as $migration) {
            $data[] = [
                'migration' => $migration,
                'batch' => 1
            ];
        }

        DB::table('migrations')->insert($data);

        $this->command->info('Successfully marked ' . count($migrations) . ' migrations as run.');
    }
}
