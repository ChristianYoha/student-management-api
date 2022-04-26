<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherFormRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends ApiResponseStatusController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( $teachers = Teacher::with('courses')->get() ){
            return $this->success(null, $teachers);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherFormRequest $teacherRequest)
    {
        //
        $newTeacher = Teacher::create($teacherRequest->all());

        if($newTeacher){
            return $this->success('L\'intervenant(e) '.$newTeacher->lastname.' '.$newTeacher->firstname.' ajouté(e) avec succès', $newTeacher);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
        if($teacher){
            return $this->success(null, $teacher);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
        if($teacher){
            return $this->success(null, ['student' => $teacher]);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherFormRequest $teacherRequest, Teacher $teacher)
    {
        //
        $teacher->lastname = $teacherRequest->get('lastname');
        $teacher->firstname = $teacherRequest->get('firstname');
        $teacher->arrivalYear = $teacherRequest->get('arrivalYear');
        if ($teacher->update()){
            return $this->success('Intervenant(e) modifié(e) avec succès', $teacher);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
        if ($teacher->delete()) {
            return $this->success('Intervenant(e) supprimé(e) avec succès',null);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }
}
