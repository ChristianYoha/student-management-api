<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Semester;

class RateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Set Rate of Student
        $theCourses = DB::table('courses')
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();
        $theStudents = DB::table('students')
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();

        // Semester One
        $theSemester = Semester::where('name', 'Semestre 1')->first();
        foreach($theCourses as $theCourse){
            foreach($theStudents as $theStudent){
                if( $theCourse->promotion_id == $theStudent->promotion_id){
                    $theSemester->ratesByStudents()->attach(
                        $theStudent->id,
                        [
                            'course_id'=>$theCourse->id,
                            'rate' => rand(8, 20)
                        ]
                    );
                }
            }
        }

        // Semester Two
        $theSemester = Semester::where('name', 'Semestre 2')->first();
        foreach($theCourses as $theCourse){
            foreach($theStudents as $theStudent){
                if( $theCourse->promotion_id == $theStudent->promotion_id){
                    $theSemester->ratesByStudents()->attach(
                        $theStudent->id,
                        [
                            'course_id'=>$theCourse->id,
                            'rate' => rand(8, 20)
                        ]
                    );
                }
            }
        }
    }
}
