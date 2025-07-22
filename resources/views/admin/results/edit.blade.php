@extends('admin.layout.layout')

@section('main-content')
<div class="content-wrapper" style="background-color: #eef3f9;">
    <div class="content-header py-3">
        <div class="container-fluid">
            <h1 class="text-primary"><b>Admin Dashboard</b></h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-warning text-dark rounded-top-4">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Student Mark</h4>
            </div>
            <div class="card-body bg-light rounded-bottom-4 p-4">
                <form action="{{ route('admin.results.update', $result->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Student --}}
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student</label>
                        <select name="student_id" id="student_id" class="form-select" required>
                            <option disabled>Select a student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $result->student_id == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->student_no }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subject --}}
                    <div class="mb-3">
                        <label for="subject_id" class="form-label">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-select" required>
                            <option disabled>Select a subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ $result->subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Class --}}
                    <div class="mb-3">
                        <label for="class_id" class="form-label">Class</label>
                        <select name="class_id" id="class_id" class="form-select" required>
                            <option disabled>Select a class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $result->class_id == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}/{{ $class->term }}/{{ $class->section }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Marks --}}
                    <div class="mb-3">
                        <label for="marks" class="form-label">Marks (0 - 100)</label>
                        <input type="number" name="marks" id="marks" class="form-control" min="0" max="100"
                               value="{{ old('marks', $result->marks) }}" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning me-2 px-4">✏️ Update</button>
                        <a href="{{ route('admin.results.index') }}" class="btn btn-secondary px-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
