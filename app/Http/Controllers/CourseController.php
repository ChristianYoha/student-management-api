<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseFormRequest;
use App\Models\Course;
use App\Models\Promotion;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends ApiResponseStatusController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( $courses = Course::with('teacher')->with('promotion')->get() ){
            return $this->success(null, $courses);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promotions = Promotion::all();
        $teachers = Teacher::all();
        return $this->success(null, [
            'promotions' => $promotions,
            'teachers' => $teachers,
        ]);

        //return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseFormRequest $courseRequest)
    {
        //
        $validatedDatas = $courseRequest->all();

        // logic of courseHours
        $totalCourseHours = $courseRequest->get('totalCourseHours');
        $courseHoursByDay = $courseRequest->get('courseHoursByDay');
        if($totalCourseHours / $courseHoursByDay > 5)
            return $this->unprocessable([
                'courseDurationError' => 'la durée maximal du cours doit être de 5 jours',
            ]);

        $newCourse = Course::create($validatedDatas);

        if($newCourse){
            return $this->success('Le cours : "'.$newCourse->name.'" est ajouté avec succès', $newCourse);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
        if($course){
            // add promotions and teachers into returned datas
            $course->promotion;
            $course->teacher;
            return $this->success(null, $course);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        $course && $promotions = Promotion::all();
        $teachers = Teacher::all();
        return $this->success(null, [
            'course' => $course,
            'teachers' => $teachers,
            'promotions' => $promotions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseFormRequest $courseRequest, Course $course)
    {
        //
        $course->name = $courseRequest->get('name');
        $course->startDate = $courseRequest->get('startDate');
        $course->totalCourseHours = $courseRequest->get('totalCourseHours');
        $course->courseHoursByDay = $courseRequest->get('courseHoursByDay');
        $course->promotion_id = $courseRequest->get('promotion_id');
        $course->teacher_id = $courseRequest->get('teacher_id');
        if($course->update()){
            return $this->success('Cours modifié avec succès', $course);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Course $course)
    // {
    //     //
    //     if ($course->delete()) {
    //         return $this->success('Cours supprimé avec succès',null);
    //     }
    //     return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    // }
}
