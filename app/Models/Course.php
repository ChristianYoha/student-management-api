<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'startDate',
        'totalCourseHours',
        'courseHoursByDay',
        'promotion_id',
        'teacher_id'
    ];

    protected $appends = ['endDate']; // For add the returned 'getEndDateAttribute' as endDate value into data collection of course

    public function getEndDateAttribute()
    {
        $days = (floor($this->totalCourseHours / $this->courseHoursByDay) - 1);
        $endDate = Carbon::createFromFormat('Y-m-d', $this->startDate);
        return $endDate->addDays($days)->toDateString();
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function ratesBySemesters(){
        return $this->belongsToMany(Semester::class, 'rates', 'course_id', 'semester_id')
        ->withPivot('rate')
        ->withPivot('student_id')
        ->withTimestamps();
    }

    public function ratesByStudents(){
        return $this->belongsToMany(Student::class, 'rates', 'course_id', 'student_id')
        ->withPivot('rate')
        ->withPivot('semester_id')
        ->withTimestamps();
    }

}
