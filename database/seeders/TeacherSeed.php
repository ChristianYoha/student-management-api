<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Set Teacher datas
        $teachers = [
            ['lastname'=>'BOUGY', 'firstname'=>'Alexis', 'arrivalYear'=>2022],      //#1
            ['lastname'=>'CHEVRON', 'firstname'=>'Pierrick', 'arrivalYear'=>2022],  //#2
            ['lastname'=>'GRIMAUD', 'firstname'=>'Pierre', 'arrivalYear'=>2022],    //#3
            ['lastname'=>'CHEVAUX', 'firstname'=>'Garance', 'arrivalYear'=>2022],   //#4
            ['lastname'=>'BARDIN', 'firstname'=>'Thibaud', 'arrivalYear'=>2022],    //#5
            ['lastname'=>'ELMALEH', 'firstname'=>'Yanis', 'arrivalYear'=>2022],     //#6
            ['lastname'=>'ELHAIK', 'firstname'=>'Sandrine', 'arrivalYear'=>2022],   //#7
            ['lastname'=>'RAK', 'firstname'=>'Jeremy', 'arrivalYear'=>2022],        //#8
        ];
        foreach($teachers as $teacher){
            Teacher::create($teacher);
        }
    }
}
