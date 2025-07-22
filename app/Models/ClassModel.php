<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $fillable = ['name','term','section'];





    // public function students()
    // {
    // return $this->belongsToMany(Student::class, 'class_student', 'class_model_id', 'student_id');    }
    public function students()
{
    return $this->belongsToMany(Student::class, 'class_students', 'class_model_id', 'student_id');
}


  public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }



}


