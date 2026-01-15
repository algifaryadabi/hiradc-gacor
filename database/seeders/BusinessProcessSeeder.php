<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessProcessSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_probis' => 'Audit', 'kode_probis' => 'AUD'],
            ['id' => 2, 'nama_probis' => 'Business Development', 'kode_probis' => 'BDV'],
            ['id' => 3, 'nama_probis' => 'Business Process Management', 'kode_probis' => 'BPM'],
            ['id' => 4, 'nama_probis' => 'Project Management', 'kode_probis' => 'COE'],
            ['id' => 5, 'nama_probis' => 'Communication', 'kode_probis' => 'COM'],
            ['id' => 6, 'nama_probis' => 'Sustainable Responsibilities', 'kode_probis' => 'CSR'],
            ['id' => 7, 'nama_probis' => 'Distribution & Transportation', 'kode_probis' => 'DIT'],
            ['id' => 8, 'nama_probis' => 'Accounting And Finance Include Capex', 'kode_probis' => 'FNC'],
            ['id' => 9, 'nama_probis' => 'General Affair & Security', 'kode_probis' => 'GAS'],
            ['id' => 10, 'nama_probis' => 'Governance, Risk And Compliance', 'kode_probis' => 'GRC'],
            ['id' => 11, 'nama_probis' => 'Human Capital Management', 'kode_probis' => 'HCM'],
            ['id' => 12, 'nama_probis' => 'Information & Communication Technology', 'kode_probis' => 'ICT'],
            ['id' => 13, 'nama_probis' => 'Innovation Management', 'kode_probis' => 'INO'],
            ['id' => 14, 'nama_probis' => 'Knowledge Management', 'kode_probis' => 'KMN'],
            ['id' => 15, 'nama_probis' => 'Performance Management', 'kode_probis' => 'KPI'],
            ['id' => 16, 'nama_probis' => 'Legal', 'kode_probis' => 'LGL'],
            ['id' => 17, 'nama_probis' => 'Marketing, Sales & Crm', 'kode_probis' => 'MKT'],
            ['id' => 18, 'nama_probis' => 'Maintenance Productive Asset', 'kode_probis' => 'MTC'],
            ['id' => 19, 'nama_probis' => 'Optimalization Non Productive Asset', 'kode_probis' => 'OAS'],
            ['id' => 20, 'nama_probis' => 'Portfolio Management', 'kode_probis' => 'PFM'],
            ['id' => 21, 'nama_probis' => 'Project Management (Non Physical Project)', 'kode_probis' => 'PMT'],
            ['id' => 22, 'nama_probis' => 'Production', 'kode_probis' => 'PRD'],
            ['id' => 23, 'nama_probis' => 'Procurement And Inventory', 'kode_probis' => 'PRO'],
            ['id' => 24, 'nama_probis' => 'Quality Management', 'kode_probis' => 'QCA'],
            ['id' => 25, 'nama_probis' => 'Research & Development', 'kode_probis' => 'RND'],
            ['id' => 26, 'nama_probis' => 'Safety, Health And Environment Management', 'kode_probis' => 'SHE'],
            ['id' => 27, 'nama_probis' => 'Management System', 'kode_probis' => 'SYM'],
            ['id' => 28, 'nama_probis' => 'Vission, Mission & Strategic Planning', 'kode_probis' => 'VMS'],
        ];

        foreach ($data as $item) {
            DB::table('business_processes')->updateOrInsert(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
