@extends('admin.layout.layout')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: #b7d9ee">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: rgb(7, 20, 60)"><b>Admin Dashboard</b></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <section class="section">

                <div class="row mb-2 justify-content-center mt-2">

                    <div class=" col-2 col-md-10">

                        <div class="card">
                            <div class="card-body">

                                <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-2"><i
                                        class="fas fa-plus-circle me-1"></i>Add Student</a>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif


                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Student No</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Classes</th>
                                            <th>Subjects</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($students as $student)
                                            <tr>
                                                <td>{{ $student->user->name ?? 'N/A' }}</td>
                                                <td>{{ $student->user->email ?? 'N/A' }}</td>
                                                <td>{{ $student->student_no }}</td>
                                                <td>{{ $student->gender }}</td>
                                                <td>{{ $student->dob }}</td>
                                                <td>
                                                    @forelse ($student->classes as $class)
                                                        <span
                                                            class="badge bg-secondary">{{ $class->name }}/{{ $class->term }}/{{ $class->section }}</span>
                                                    @empty
                                                        <span class="text-muted">N/A</span>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse ($student->subjects as $subj)
                                                        <span class="badge bg-info">{{ $subj->name }}</span>
                                                    @empty
                                                        <span class="text-muted">N/A</span>
                                                    @endforelse
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>

                                                    <form action="{{ route('admin.students.destroy', $student->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Delete?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No students found.</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>

                                <!-- /.content -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
