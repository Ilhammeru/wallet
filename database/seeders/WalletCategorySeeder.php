<?php

namespace Database\Seeders;

use App\Models\WalletCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ''
        ];
        WalletCategory::create([]);
    }
}
