<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFormRequest;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends ApiResponseStatusController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( $students = Student::with('promotion')->get() ){
            return $this->success(null, $students);
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
        if( $promotions = Promotion::all()){
            return $this->success(null, $promotions);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentFormRequest $studentRequest)
    {
        //
        $newStudent = Student::create($studentRequest->all());

        if($newStudent){
            return $this->success('L\'etudiant(e) '.$newStudent->lastname.' '.$newStudent->firstname.' ajouté(e) avec succès', $newStudent);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
        if($student){
            // add the promotion to returned datas
            $student->promotion;
            return $this->success(null, $student);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
        if($student && $promotions = Promotion::all()){
            return $this->success(null, [
                'student' => $student,
                'promotions' => $promotions
            ]);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentFormRequest $studentRequest, Student $student)
    {
        //
        $student->lastname = $studentRequest->get('lastname');
        $student->firstname = $studentRequest->get('firstname');
        $student->birthdate = $studentRequest->get('birthdate');
        $student->arrivalYear = $studentRequest->get('arrivalYear');
        $student->promotion_id = $studentRequest->get('promotion_id');
        if ($student->update()){
            return $this->success('Etudiant(e) modifié(e) avec succès', $student);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
        if ($student->delete()) {
            return $this->success('Etudiant(e) supprimé(e) avec succès',null);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }
}
