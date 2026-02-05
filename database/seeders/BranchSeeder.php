<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        // Disable activity logging during seeding
        config(['activitylog.enabled' => false]);
        
        $branches = [
            [
                'code' => 'HQ',
                'name' => 'Kantor Pusat',
                'address' => 'Jl. Raya Utama No. 123',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '12345',
                'phone' => '021-1234567',
                'email' => 'pusat@koperasidagang.com',
                'is_active' => true,
            ],
            [
                'code' => 'BDG',
                'name' => 'Cabang Bandung',
                'address' => 'Jl. Asia Afrika No. 45',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40111',
                'phone' => '022-7654321',
                'email' => 'bandung@koperasidagang.com',
                'is_active' => true,
            ],
            [
                'code' => 'SBY',
                'name' => 'Cabang Surabaya',
                'address' => 'Jl. Tunjungan No. 78',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60261',
                'phone' => '031-9876543',
                'email' => 'surabaya@koperasidagang.com',
                'is_active' => true,
            ],
        ];

        foreach ($branches as $branch) {
            Branch::firstOrCreate(
                ['code' => $branch['code']],
                $branch
            );
        }

        $this->command->info('Branches seeded successfully!');
    }
}
