<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_code_id',
        'code',
        'teacher_id',
        'class_id',
        'description',
    ];

    /* ──────────────
     |  Relationships
     ──────────────*/

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);          // nullable
    }

    public function class()
    {
        // your table is 'class_models', so specify foreign/owner key
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subjectCode()
    {
        return $this->belongsTo(SubjectCode::class);
    }

    /** Students taking this subject (pivot: student_subjects) */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subjects')
                    ->withTimestamps();
    }

    /** Results awarded for this subject */


}
