<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Carbon\Carbon;

class PromotionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Set Promotion datas
        $promotions = [
            ['name'=>'A2', 'endYear'=> intval(Carbon::now()->addYears(3)->format('Y'))], //#1
            ['name'=>'A3', 'endYear'=> intval(Carbon::now()->addYears(2)->format('Y'))], //#2
            ['name'=>'A4', 'endYear'=> intval(Carbon::now()->addYears(1)->format('Y'))], //#3
            ['name'=>'A5', 'endYear'=> intval(Carbon::now()->format('Y'))], //#4
        ];
        foreach($promotions as $promotion){
            Promotion::create($promotion);
        }
    }
}
