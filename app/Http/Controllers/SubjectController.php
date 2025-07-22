<?php

namespace App\Http\Controllers;

use App\Models\SubjectCode;
use App\Models\Teacher;
use App\Models\ClassModel;
use App\Models\Subject;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::with(['teacher', 'class', 'subjectCode'])->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $subjectCodes = SubjectCode::all();
        $teachers = Teacher::all();
        $classes = ClassModel::all();

        return view('admin.subjects.create', data: compact('subjectCodes', 'teachers', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_code_id' => 'required|exists:subject_codes,id',
            'code' => 'required|string|max:10|unique:subjects,code',
            'teacher_id' => 'nullable|exists:teachers,id',
            'class_id' => 'required|exists:class_models,id',
            'description' => 'nullable|string',
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }
    // SubjectController.php
    public function edit(Subject $subject)
    {
        $subjectCodes = SubjectCode::all();
        $teachers     = Teacher::all();
        $classes      = ClassModel::all();

        return view('admin.subjects.edit', compact('subjectCodes', 'subject', 'teachers', 'classes'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subject_code_id' => 'required|exists:subject_codes,id',
            'code' => 'required|string|max:10|unique:subjects,code,' . $subject->id,
            'teacher_id' => 'nullable|exists:teachers,id',
            'class_id' => 'required|exists:class_models,id',
            'description' => 'nullable|string',
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
    // SubjectController.php

    public function filterByType($type)
    {
        $typeMap = [
            'software' => ['CS', 'CST', 'E'],
            'hardware' => ['CT', 'CST', 'E'],
        ];

        if ($type === 'both') {
            // Find common types between software and hardware
            $softwareTypes = $typeMap['software'];
            $hardwareTypes = $typeMap['hardware'];

            // Get common type values
            $commonTypes = array_intersect($softwareTypes, $hardwareTypes);

            $subjects = Subject::whereHas('subjectCode', function ($query) use ($commonTypes) {
                $query->whereIn('type', $commonTypes);
            })->with(['teacher', 'class', 'subjectCode'])->get();
        } else {
            $types = $typeMap[$type] ?? [];

            $subjects = Subject::whereHas('subjectCode', function ($query) use ($types) {
                $query->whereIn('type', $types);
            })->with(['teacher', 'class', 'subjectCode'])->get();
        }

        return view('admin.subjects.index', compact('subjects'));
    }
}
