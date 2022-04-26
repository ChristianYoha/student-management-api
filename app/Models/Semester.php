<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function ratesByCourses(){
        return $this->belongsToMany(Course::class, 'rates', 'semester_id', 'course_id')
        ->withPivot('rate')
        ->withPivot('student_id')
        ->withTimestamps();
    }

    public function ratesByStudents(){
        return $this->belongsToMany(Student::class, 'rates', 'semester_id', 'student_id')
        ->withPivot('rate')
        ->withPivot('course_id')
        ->withTimestamps();
    }
}
