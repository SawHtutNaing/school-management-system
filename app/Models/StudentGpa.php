<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGpa extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'gpa',
        'total_credits',
        'earned_credits',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
