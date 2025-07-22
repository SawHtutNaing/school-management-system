<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassStudent;
use App\Models\StudentSubject;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class StudentApiController extends Controller
{
    public function getStudentData($id)
    {
        // Fetch student data along with subjects
        $subjects = StudentSubject::where('student_id', $id)
            ->with('subject')
            ->get();
        // Fetch class information for the student
        $classId = ClassStudent::where('student_id', $id)
            ->value('class_model_id');
        $classInfo = ClassModel::find($classId);

        if (!$subjects || !$classInfo) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        return response()->json(
            [
                'subjects' => $subjects,
                'class' => $classInfo,
            ]
        );
    }
}
