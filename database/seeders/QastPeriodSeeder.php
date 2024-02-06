<?php

namespace Database\Seeders;

use App\Models\QastPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QastPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        QastPeriod::create(["qast_period"=> "كل اسبوع",]);
        QastPeriod::create(["qast_period"=> "كل 10 ايام",]);
        QastPeriod::create(["qast_period"=> "كل شهر",]);
        QastPeriod::create(["qast_period"=> "كل سنة",]);
    }
}
