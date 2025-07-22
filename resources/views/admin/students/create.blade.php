@extends('admin.layout.layout')
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper " style="background-color: #b7d9ee">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: rgb(7, 20, 60)"><b>Admin Dashboard</b></h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->


        <section class="content">

            <section class="section">

                <div class="row mb-2 justify-content-center mt-2">

                    <div class=" col-2 col-md-10">

                        <div class="card">
                            <div class="card-body">


                                <form action="{{ route('admin.students.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Name:</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email:</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Student No:</label>
                                        <input type="text" name="student_no" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Gender:</label>
                                        <select name="gender" class="form-control" required>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Date of Birth:</label>
                                        <input type="date" name="dob" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Class:</label>
                                        {{-- <select name="class_id" class="form-control" multiple="multiple" data-placeholder="Select class" required> --}}
                                        <select name="class_id[]" class="form-control" multiple required>

                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">
                                                    {{ $class->name }}/{{ $class->term }}/{{ $class->section }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Subjects:</label>
                                        <div class="row">
                                            @foreach ($subjects as $subject)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="subject_ids[]"
                                                            id="subject{{ $subject->id }}" value="{{ $subject->id }}">
                                                        <label class="form-check-label" for="subject{{ $subject->id }}">
                                                            {{ $subject->name }} ({{ $subject->code }})
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <button class="btn btn-success">Create Student</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection


