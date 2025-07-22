@extends('admin.layout.layout')

@section('main-content')
<div class="content-wrapper" style="background-color: #eef3f9;">
    <div class="content-header py-3">
        <div class="container-fluid">
            <h1 class="text-primary"><b>Admin Dashboard</b></h1>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-dark">📊 Student Marks & GPA</h3>
            <a href="{{ route('admin.results.create') }}" class="btn btn-success">
                + Add Mark
            </a>
        </div>

        {{-- Success / Error Flash --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- MARKS TABLE --}}
        <div class="card shadow-sm rounded">
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle mb-0">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Student No</th>
                            <th>Class</th>
                            <th>Subject</th>
                            <th>Marks</th>
                            <th>Grade</th>
                            <th>Point</th>
                            <th>GPA</th>
                            <th>Total Credits</th>
                            <th>Earned Credits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($marks as $index => $m)
                            @php
                                $gKey = $m->student_id . '-' . $m->class_id;
                                $g    = $gpas[$gKey] ?? null;
                            @endphp
                            <tr class="text-center align-middle">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $m->student->student_no }}</td>
                                <td>{{ $m->class->name }}</td>
                                <td>{{ $m->subject->name }}</td>
                                <td class="text-end">{{ $m->marks }}</td>
                                <td>{{ $m->grade }}</td>
                                <td class="text-end">{{ $m->grade_point }}</td>
                                <td class="text-end">{{ $g?->gpa ?? '—' }}</td>
                                <td class="text-end">{{ $g?->total_credits ?? '—' }}</td>
                                <td class="text-end">{{ $g?->earned_credits ?? '—' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.results.edit', $m->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.results.destroy', $m->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this mark?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted">No marks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
