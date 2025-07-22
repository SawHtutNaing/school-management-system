<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SubjectCode extends Model
{
    //
    use HasFactory;

    // Fillable fields (mass assignable)
    protected $fillable = [
        'type',

    ];

    // A SubjectCode can have many Subjects
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

}
