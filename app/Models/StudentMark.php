<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'marks',
        'grade',
        'grade_point'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    // Calculate grade and grade point based on marks
    public static function calculateGrade($marks)
    {
        if ($marks >= 90) return ['grade' => 'A', 'grade_point' => 4.0];
        if ($marks >= 80) return ['grade' => 'B', 'grade_point' => 3.0];
        if ($marks >= 70) return ['grade' => 'C', 'grade_point' => 2.0];
        if ($marks >= 60) return ['grade' => 'D', 'grade_point' => 1.0];
        return ['grade' => 'F', 'grade_point' => 0.0];
    }
}
