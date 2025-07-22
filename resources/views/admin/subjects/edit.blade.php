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

                <div class="row mb-2 justify-content-center mt-2">

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

    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
        <label for="subject_code_id" class="form-label">Code Type</label>
        <select name="subject_code_id" class="form-control" required>
            <option disabled>Select Code Type</option>
            @foreach ($subjectCodes as $types)
                <option value="{{ $types->id }}"
                        {{ $subject->subject_code_id == $types->id ? 'selected' : '' }}>
                    {{ $types->type }}
                </option>
            @endforeach
        </select>
    </div>
            <div class="mb-3">
            <label for="code" class="form-label">Subject Code</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $subject->code) }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Subject Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
        </div>



        <div class="mb-3">
            <label for="teacher_id" class="form-label">Teacher</label>
            <select name="teacher_id" class="form-control">
                <option value="">Select Teacher </option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $subject->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="class_id" class="form-label">Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">Select Class</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ $subject->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->name }} / {{ $class->term }} / {{ $class->semester }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $subject->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Subject</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>


                            </div>
                        </div>
                    </div>

                </div>


            </section>
            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
