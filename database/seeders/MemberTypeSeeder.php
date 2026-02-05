<?php

namespace Database\Seeders;

use App\Models\MemberType;
use Illuminate\Database\Seeder;

class MemberTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Disable activity logging during seeding
        config(['activitylog.enabled' => false]);
        
        $memberTypes = [
            [
                'code' => 'REG',
                'name' => 'Anggota Regular',
                'description' => 'Anggota biasa dengan hak penuh untuk menggunakan semua layanan koperasi',
                'is_active' => true,
            ],
            [
                'code' => 'EMP',
                'name' => 'Anggota Karyawan',
                'description' => 'Anggota yang merupakan karyawan perusahaan mitra',
                'is_active' => true,
            ],
            [
                'code' => 'PREM',
                'name' => 'Anggota Premium',
                'description' => 'Anggota dengan benefit tambahan dan limit pinjaman lebih tinggi',
                'is_active' => true,
            ],
            [
                'code' => 'LB',
                'name' => 'Anggota Luar Biasa',
                'description' => 'Anggota dengan hak terbatas',
                'is_active' => true,
            ],
        ];

        foreach ($memberTypes as $memberType) {
            MemberType::firstOrCreate(
                ['code' => $memberType['code']],
                $memberType
            );
        }

        $this->command->info('Member types seeded successfully!');
    }
}
