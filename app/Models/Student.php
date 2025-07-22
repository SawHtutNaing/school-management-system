<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',

        'student_no',
        'gender',
        'dob',
        'class_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//     public function class()
//     {
//  return $this->belongsToMany(ClassModel::class, 'class_student', 'student_id', 'class_model_id');    }
// }


public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects');
    }
public function classes()
{
    return $this->belongsToMany(ClassModel::class, 'class_students', 'student_id', 'class_model_id');
}


// In app/Models/Student.php
public function calculateGpa($classId)
{
    $marks = $this->studentMarks()
                ->with('subject')
                ->where('class_id', $classId)
                ->get();

    $totalGradePoints = 0;
    $totalCredits = 0;

    foreach ($marks as $mark) {
        $subjectCredits = $mark->subject->credit_hours ?? 1;
        $totalGradePoints += $mark->grade_point * $subjectCredits;
        $totalCredits += $subjectCredits;
    }

    return $totalCredits > 0 ? $totalGradePoints / $totalCredits : 0;
}



}
