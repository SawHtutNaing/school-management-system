<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class TeacherController extends Controller
{
   public function index()
{
    $teachers = Teacher::all();

return view('admin.teachers.index', compact('teachers'));
}



    public function create()
    {
        return view('admin.teachers.create');
    }



//     public function show(Teacher $teacher)
// {
//     $totalTeachers = Teacher::count(); // Count of all teachers

//     return view('admin.teachers.show', compact('teacher', 'totalTeachers'));
// }


public function store(Request $request)
{
    $validatedData = $request->validate([
        'name'       => 'required',
        'email'      => 'required|email|unique:teachers,email',
        'password'   => 'required',
        'department' => 'required',
    ]);

    // Hash the password before saving
    $validatedData['password'] = Hash::make($validatedData['password']);

    Teacher::create($validatedData);

    return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully');
}
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }


public function update(Request $request, Teacher $teacher)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:teachers,email,' . $teacher->id,
        'password' => 'nullable|string|max:20',
        'department' => 'nullable|string|max:255',
    ]);

    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']); // Don’t update the password if it’s empty
    }

    $teacher->update($validatedData);

    return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully');
}


    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully');
    }



}
