<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Unlimited Features',
                'description' => 'Unlimited transfer to friends',
            ],
            [
                'name' => 'Unlimited Users',
                'description' => 'Unlimited transfer to friends',
            ],
            [
                'name' => 'Unlimited wallets',
                'description' => 'Unlimited transfer to friends',
            ],
            [
                'name' => 'Up to 10 Million transaction per day',
                'description' => 'You can communicate with more than 100 friends',
            ],
        ];

        Schema::disableForeignKeyConstraints();

        Package::truncate();
        Feature::truncate();

        Schema::enableForeignKeyConstraints();

        Feature::insert($data);
    }
}
