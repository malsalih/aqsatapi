<?php

namespace Database\Seeders;

use App\Models\BillType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BillType::create(['bill_type'=>'دفع']);
        BillType::create(['bill_type'=>'قبض']);

    }
}
