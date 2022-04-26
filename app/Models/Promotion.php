<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['name','endYear'];


    public function courses()
    {
        return $this->hasMany(Course::class, 'promotion_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'promotion_id');
    }
}
