<?php

namespace Database\Seeders;

use App\Models\Pemilihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemilihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemilihans = [
            [
                'nama' => 'Pemilihan Ketua OSIS 2025',
                'deskripsi' => 'Pemilihan ketua organisasi siswa intra sekolah (OSIS) periode 2025-2026. Setiap siswa dapat memilih satu kandidat yang akan memimpin OSIS untuk satu tahun ke depan.',
                'tanggal_mulai' => now()->addDays(5),
                'tanggal_selesai' => now()->addDays(7),
                'status' => 'nonaktif',
                'published_at' => null,
            ],
            [
                'nama' => 'Pemilihan Ketua MPK',
                'deskripsi' => 'Pemilihan ketua Majelis Perwakilan Kelas (MPK) untuk periode 2025-2026. MPK berfungsi sebagai perwakilan aspirasi siswa dari setiap kelas.',
                'tanggal_mulai' => now()->addDays(10),
                'tanggal_selesai' => now()->addDays(12),
                'status' => 'nonaktif',
                'published_at' => null,
            ],
            [
                'nama' => 'Voting Guru Favorit',
                'deskripsi' => 'Pemilihan guru favorit tahun ini. Hasil voting akan digunakan untuk apresiasi dalam acara akhir tahun sekolah.',
                'tanggal_mulai' => now()->subDays(2),
                'tanggal_selesai' => now()->addDays(1),
                'status' => 'aktif',
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($pemilihans as $pemilihan) {
            Pemilihan::create($pemilihan);
        }
    }
}
