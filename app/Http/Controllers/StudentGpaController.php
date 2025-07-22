<?php

namespace App\Http\Controllers;

use App\Models\StudentGpa;
use App\Models\StudentMark;
use Illuminate\Http\Request;

class StudentGpaController extends Controller
{
    // Show all GPAs
    // public function index()
    // {
    //     $gpas = StudentGpa::with(['student', 'class'])->get();
    //     return view('admin.gpas.', compact('gpas'));
    // }

    // Recalculate GPA manually
    public function recalculate($student_id, $class_id)
    {
        $marks = StudentMark::where('student_id', $student_id)
                            ->where('class_id', $class_id)
                            ->get();

        if ($marks->isEmpty()) {
            return back()->with('error', 'No marks found.');
        }

        $total_points = $marks->sum('grade_point');
        $count = $marks->count();
        $earned = $marks->where('grade_point', '>', 0)->count();
        $gpa = round($total_points / $count, 2);

        StudentGpa::updateOrCreate(
            ['student_id' => $student_id, 'class_id' => $class_id],
            ['gpa' => $gpa, 'total_credits' => $count, 'earned_credits' => $earned]
        );

        return back()->with('success', 'GPA recalculated.');
    }
}
