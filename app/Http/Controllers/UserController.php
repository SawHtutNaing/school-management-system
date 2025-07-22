<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with(['profile', 'roles', 'subjects'])->get();
        return view('admin.teachers.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::all();


        return view('admin.teachers.index', compact('roles', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'pfimage' => 'nullable|image|max:2048',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:Male,Female,Other',
            'department' => 'required|string',
            'subject' => 'nullable|array',
            'subject.*' => 'exists:subjects,id',
            'role' => 'nullable|array',
            'role.*' => 'exists:roles,id',
            'bio' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->hasFile('pfimage')) {
            $filename = $request->file('pfimage')->store('profile_images', 'public');
        }

        $user->profile()->create([
            'pfimage' => $filename ?? null,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'department' => $request->department,
            'bio' => $request->bio,
            'status' => $request->has('status') ? true : false,
        ]);

        $user->roles()->attach($request->role);
        $user->subjects()->attach($request->subject);

        return back()->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
