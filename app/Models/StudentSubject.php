<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class StudentSubject extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
