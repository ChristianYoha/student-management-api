<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateFormRequest;
use App\Models\Course;
use App\Models\Promotion;
use App\Models\Semester;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class RateController extends ApiResponseStatusController
{
    //

    public function getRate(Student $student)
    {
        if($student){
            $drapoSemester = 0;
            $drapoCourses = 0;
            $data = [];
            foreach($student->ratesBySemesters as $ratesBySemester){
                if ($drapoSemester != $ratesBySemester->id){
                    $array = [];
                    foreach($student->ratesByCourses as $ratesByCourse){
                        if( $drapoCourses != $ratesByCourse->id){
                            if($ratesByCourse->pivot->semester_id == $ratesBySemester->id){
                                array_push($array, [
                                    'course'=> Course::find($ratesByCourse->id),
                                    'rate' => $ratesByCourse->pivot->rate,
                                ]);
                            }
                            $drapoCourses = $ratesByCourse->id;
                        }
                    }
                    array_push($data, [
                        'semester' => Semester::find($ratesBySemester->id),
                        'data' => $array
                    ]);
                    $drapoSemester = $ratesBySemester->id;
                }
            }

            return $this->success(null, $data);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }


    public function create(Student $student)
    {
        $promotion = new Promotion;
        $promotion = $student->promotion;
        $promotion->courses; // add courses collection of this promotion and all are into returned student collection

        if($student){
            return $this->success(null, [
                'student' => $student,
                'semesters' => Semester::all()
            ]);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');

    }

    public function store(RateFormRequest $rateRequest)
    {
        try{
            $semester = Semester::find($rateRequest->get('semester_id'));
            $semester->ratesByCourses()->attach(
                $rateRequest->get('course_id'),
                [
                    'student_id' => $rateRequest->get('student_id'),
                    'rate'=>$rateRequest->get('rate')
                ]);

                return $this->success('Note ajoutée avec succès', null);
        }catch(Exception $e){
            return $this->fail('Une erreur s\'est produite. Veuillez réessayer.('.$e->getMessage().')');
        }
    }
}
