<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterFormRequest;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends ApiResponseStatusController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( $promotions = Semester::all() ){
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
    public function store(SemesterFormRequest $semesterRequest)
    {
        //
        $newSemester = Semester::create($semesterRequest->all());

        if($newSemester){
            return $this->success('Semestre ajouté avec succès', $newSemester);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
        if($semester){
            return $this->success(null, $semester);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(SemesterFormRequest $semesterRequest, Semester $semester)
    {
        //
        $semester->name = $semesterRequest->get('name');
        if ($semester->update()){
            return $this->success('Semestre modifié avec succès', $semester);
        }
        return $this->fail('Une erreur s\'est produite. Veuillez réessayer.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Semester $semester)
    // {
    //
    // }
}
