
@extends('admin.layout.layout')
@section('main-content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper " style="background-color: #b7d9ee">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0" style="color: white;"><b>Admin Dashboard</b></h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

    <section class="section">

        <div class="row mb-2 justify-content-center mt-2" >

            <div class=" col-2 col-md-10">

        <div class="card">
            <div class="card-body">


                @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
            <div class="mb-3">
            <label for="codes">Code</label>
            <select name="subject_code_id" class="form-control" required>
    <option disabled selected>Select Code Type</option>
    @foreach ($subjectCodes as $types)
        <option value="{{ $types->id }}">{{ $types->type }}</option>
    @endforeach
</select>



        </div>

            <div class="mb-3">
            <label for="code">Code_digit</label>
            <input type="text" class="form-control" name="code" required value="{{ old('code') }}">
        </div>
        <div class="mb-3">
            <label for="name">Subject Name</label>
            <input type="text" class="form-control" name="name" required value="{{ old('name') }}">
        </div>



        <div class="mb-3">
            <label for="teacher_id">Teacher</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher </option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="class_id">Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}/{{ $class->term}}/{{ $class->section}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Subject</button>
    </form>

            </div></div>
            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
