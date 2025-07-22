<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\StudentGpa;
use App\Models\StudentMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class StudentMarkController extends Controller
{
    // Display all marks
    public function index()
    {
        // ➊ Marks (eager‑load relations)
        $marks = StudentMark::with(['student', 'subject', 'class'])
            ->orderBy('student_id')
            ->orderBy('subject_id')
            ->get();

        // ➋ GPAs (keyed by student_id + class_id for fast lookup)
        $gpas = StudentGpa::with(['student', 'class'])
            ->get()
            ->keyBy(fn($g) => $g->student_id . '-' . $g->class_id);

        return view('admin.results.index', compact('marks', 'gpas'));
    }


    // Show form to create new marks
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $classes = ClassModel::all();
        return view('admin.results.create', compact('students', 'subjects', 'classes'));
    }

    // Store new marks
    public function store(Request $request)
    {
        Log::info("Reached Function validation might be failing");
        Log::info($request);
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:class_models,id',
        ]);

        Log::info("Validation passed");
        $studentId = $request->student_id;
        $classId = $request->class_id;
        $marks = $request->marks;

        Log::info($marks);

        foreach ($marks as $subjectId => $score) {
            $gradeData = StudentMark::calculateGrade($score);
            StudentMark::create([
                'student_id' => $request->student_id,
                'subject_id' => $subjectId,
                'class_id' => $request->class_id,
                'marks' => $score,
                'grade' => $gradeData['grade'],
                'grade_point' => $gradeData['grade_point']
            ]);
        }

        $marks = StudentMark::where('student_id', $request->student_id)
            ->where('class_id', $request->class_id)
            ->get();

        $totalPoints = $marks->sum('grade_point');
        $subjectCount = $marks->count();
        $earnedCredits = $marks->where('grade_point', '>', 0)->count();
        $gpa = $subjectCount > 0 ? round($totalPoints / $subjectCount, 2) : 0;

        StudentGpa::updateOrCreate(
            ['student_id' => $request->student_id, 'class_id' => $request->class_id],
            [
                'gpa' => $gpa,
                'total_credits' => $subjectCount,
                'earned_credits' => $earnedCredits
            ]
        );

        return back()->with('success', 'Marks added successfully!');
    }

    public function edit(StudentMark $result)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $classes  = ClassModel::all();

        return view('admin.results.edit', compact('result', 'students', 'subjects', 'classes'));
    }
    public function update(Request $request, StudentMark $result)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'class_id'   => 'required|exists:class_models,id',
            'marks'      => 'required|numeric|min:0|max:100',
        ]);

        $gradeData = StudentMark::calculateGrade($request->marks);

        $result->update([
            'student_id'   => $request->student_id,
            'subject_id'   => $request->subject_id,
            'class_id'     => $request->class_id,
            'marks'        => $request->marks,
            'grade'        => $gradeData['grade'],
            'grade_point'  => $gradeData['grade_point'],
        ]);

        // Recalculate GPA
        $marks = StudentMark::where('student_id', $request->student_id)
            ->where('class_id', $request->class_id)
            ->get();

        $totalPoints   = $marks->sum('grade_point');
        $subjectCount  = $marks->count();
        $earnedCredits = $marks->where('grade_point', '>', 0)->count();
        $gpa           = $subjectCount ? round($totalPoints / $subjectCount, 2) : 0;

        StudentGpa::updateOrCreate(
            ['student_id' => $request->student_id, 'class_id' => $request->class_id],
            ['gpa' => $gpa, 'total_credits' => $subjectCount, 'earned_credits' => $earnedCredits]
        );

        return redirect()->route('admin.results.index')->with('success', 'Mark updated successfully!');
    }

    public function destroy(StudentMark $result)
    {
        $studentId = $result->student_id;
        $classId   = $result->class_id;

        $result->delete();

        // Recalculate GPA after deletion
        $marks = StudentMark::where('student_id', $studentId)
            ->where('class_id', $classId)
            ->get();

        if ($marks->count()) {
            $totalPoints   = $marks->sum('grade_point');
            $subjectCount  = $marks->count();
            $earnedCredits = $marks->where('grade_point', '>', 0)->count();
            $gpa           = $subjectCount ? round($totalPoints / $subjectCount, 2) : 0;

            StudentGpa::updateOrCreate(
                ['student_id' => $studentId, 'class_id' => $classId],
                ['gpa' => $gpa, 'total_credits' => $subjectCount, 'earned_credits' => $earnedCredits]
            );
        } else {
            // No marks left ⇒ delete GPA
            StudentGpa::where('student_id', $studentId)
                ->where('class_id', $classId)
                ->delete();
        }

        return redirect()->route('admin.results.index')->with('success', 'Mark deleted successfully!');
    }

    // Show edit form
    // public function edit(StudentMark $studentMark)
    // {
    //     $students = Student::all();
    //     $subjects = Subject::all();
    //     $classes = ClassModel::all();
    //     return view('admin.results.edit', compact('studentMark', 'students', 'subjects', 'classes'));
    // }

    // Update marks
    // public function update(Request $request, StudentMark $studentMark)
    // {
    //     $request->validate([
    //         'student_id' => 'required|exists:students,id',
    //         'subject_id' => 'required|exists:subjects,id',
    //         'class_id' => 'required|exists:class_models,id',
    //         'marks' => 'required|numeric|min:0|max:100'
    //     ]);

    //     $gradeData = StudentMark::calculateGrade($request->marks);

    //     $studentMark->update([
    //         'student_id' => $request->student_id,
    //         'subject_id' => $request->subject_id,
    //         'class_id' => $request->class_id,
    //         'marks' => $request->marks,
    //         'grade' => $gradeData['grade'],
    //         'grade_point' => $gradeData['grade_point']
    //     ]);

    //     return redirect()->route('admin.results.index')->with('success', 'Marks updated successfully!');
    // }

    // Delete marks
    // public function destroy(StudentMark $studentMark)
    // {
    //     $studentMark->delete();
    //     return redirect()->route('admin.results.index')->with('success', 'Marks deleted successfully!');
    // }

}
