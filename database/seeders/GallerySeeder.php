<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Seminar Nasional Teknisi Akuntansi 2024',
                'description' => 'Seminar nasional di Jakarta dengan 300+ peserta',
                'icon' => 'fa-chalkboard-teacher',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Software Akuntansi',
                'description' => 'Pelatihan praktis penggunaan software akuntansi modern',
                'icon' => 'fa-laptop-code',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Rapat Kerja Nasional',
                'description' => 'Koordinasi pengurus dan perwakilan daerah',
                'icon' => 'fa-users',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Sertifikasi Kompetensi',
                'description' => 'Program sertifikasi teknisi akuntansi tingkat nasional',
                'icon' => 'fa-certificate',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Kunjungan Industri',
                'description' => 'Study visit ke perusahaan dan KAP mitra',
                'icon' => 'fa-building',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Webinar Series 2024',
                'description' => 'Seri webinar online seputar isu terkini akuntansi',
                'icon' => 'fa-video',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
