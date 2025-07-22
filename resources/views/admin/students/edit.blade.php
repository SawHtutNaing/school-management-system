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

        <div class="row mb-2 justify-content-center mt-2" >

            <div class=" col-2 col-md-10">

        <div class="card">
            <div class="card-body">


         <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Student No:</label>
        <input type="text" name="student_no" class="form-control" value="{{ old('student_no', $student->student_no) }}" required>
    </div>

    <div class="mb-3">
        <label>Gender:</label>
        <select name="gender" class="form-control" required>
            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Date of Birth:</label>
        <input type="date" name="dob" class="form-control" value="{{ old('dob', $student->dob) }}" required>
    </div>

    <div class="mb-3">
        <label>Classes:</label>
        <select name="class_ids[]" class="form-control" multiple required>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}"
                    {{ in_array($class->id, old('class_ids', $student->classes->pluck('id')->toArray())) ? 'selected' : '' }}>
                    {{ $class->name }}/{{ $class->term }}/{{ $class->section }}
                </option>
            @endforeach
        </select>
        <small class="text-light">Hold Ctrl (Windows) or Cmd (Mac) to select multiple classes</small>
    </div>

    <div class="mb-3">
        <label>Subjects:</label>
        <div class="row">
            @foreach ($subjects as $subject)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="subject_ids[]"
                            id="subject{{ $subject->id }}" value="{{ $subject->id }}"
                            {{ in_array($subject->id, old('subject_ids', $student->subjects->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="form-check-label" for="subject{{ $subject->id }}">
                            {{ $subject->name }} ({{ $subject->code }})
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update Student</button>
</form>
            </div></div></div></div>
    </section>
     </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
