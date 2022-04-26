<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'birthdate',
        'arrivalYear',
        'promotion_id'
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    public function ratesByCourses(){
        return $this->belongsToMany(Course::class, 'rates', 'student_id', 'course_id')
        ->withPivot('rate')
        ->withPivot('semester_id')
        ->withTimestamps();
    }

    public function ratesBySemesters(){
        return $this->belongsToMany(Semester::class, 'rates', 'student_id', 'semester_id')
        ->withPivot('rate')
        ->withPivot('course_id')
        ->withTimestamps();
    }

}
