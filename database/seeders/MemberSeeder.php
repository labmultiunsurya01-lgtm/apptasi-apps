<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lengkap'      => 'Dr. Siti Aminah, S.E., M.Ak.',
                'nik'               => '3201012345678901',
                'email'             => 'siti.aminah@example.com',
                'no_hp'             => '081234567890',
                'alamat'            => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'institusi'         => 'Universitas Indonesia',
                'jabatan'           => 'Dosen Akuntansi',
                'status'            => 'approved',
                'nomor_anggota'     => '202400001',
                'tanggal_bergabung' => '2024-01-15',
            ],
            [
                'nama_lengkap'      => 'Budi Santoso, S.E., Ak.',
                'nik'               => '3201012345678902',
                'email'             => 'budi.santoso@example.com',
                'no_hp'             => '081298765432',
                'alamat'            => 'Jl. Gatot Subroto No. 45, Bandung',
                'institusi'         => 'Kantor Akuntan Publik XYZ',
                'jabatan'           => 'Praktisi Teknisi Akuntansi',
                'status'            => 'approved',
                'nomor_anggota'     => '202400002',
                'tanggal_bergabung' => '2024-02-20',
            ],
            [
                'nama_lengkap'      => 'Rina Wulandari, S.Ak.',
                'nik'               => '3201012345678903',
                'email'             => 'rina.wulandari@example.com',
                'no_hp'             => '082112345678',
                'alamat'            => 'Jl. Sudirman No. 88, Surabaya',
                'institusi'         => 'Politeknik Negeri Surabaya',
                'jabatan'           => 'Dosen Praktisi',
                'status'            => 'approved',
                'nomor_anggota'     => '202400003',
                'tanggal_bergabung' => '2024-03-10',
            ],
        ];

        foreach ($data as $item) {
            Member::create($item);
        }
    }
}
