<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $teacherCount = Teacher::count();
        $studentCount = Student::count();
        $subjectCount = Subject::count();

        return view('admin.pages.dashboard', compact(
            'teacherCount',
            'studentCount',
            'subjectCount'
        ));
    }
}
