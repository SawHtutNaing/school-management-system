<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'classes', 'subjects'])->get(); // ✅ must be plural "classes"
        return view('admin.students.index', compact('students'));
    }



    public function create()
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();
        return view('admin.students.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'student_no' => 'required|unique:students',
            'gender' => 'required',
            'dob' => 'required|date',
            'class_id' => 'required|array',
            'class_id.*' => 'exists:class_models,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => 'student',
            'password' => Hash::make($validated['password']),
        ]);

        // Create student
        $student = Student::create([
            'user_id' => $user->id,
            'student_no' => $validated['student_no'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
        ]);

        // Attach classes
        $student->classes()->attach($validated['class_id']);

        // Sync subjects (if any)
        if (!empty($validated['subject_ids'])) {
            $student->subjects()->sync($validated['subject_ids']);
        }

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully!');
    }

    public function edit(Student $student)
    {
        $classes = ClassModel::all();
        $subjects = Subject::all(); // Add this line to get all subjects
        return view('admin.students.edit', compact('student', 'classes', 'subjects'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'student_no' => 'required|unique:students,student_no,' . $student->id,
            'gender' => 'required',
            'dob' => 'required|date',
            'class_ids' => 'required|array',
            'class_ids.*' => 'exists:class_models,id',
            'subject_ids' => 'nullable|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        // Update student details
        $student->update([
            'student_no' => $validated['student_no'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
        ]);

        // Sync classes (required field)
        $student->classes()->sync($validated['class_ids']);

        // Sync subjects (handle null case properly)
        $student->subjects()->sync($validated['subject_ids'] ?? []);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }
    public function destroy(Student $student)
    {
        $student->user()->delete();
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted.');
    }
}
