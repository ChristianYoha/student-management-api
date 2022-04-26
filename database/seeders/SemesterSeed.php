<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Set Semester datas
        $semesters = [
            ['name'=>'Semestre 1'],
            ['name'=>'Semestre 2'],
        ];
        foreach($semesters as $semester){
            Semester::create($semester);
        }
    }
}
