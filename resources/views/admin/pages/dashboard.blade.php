@extends('admin.layout.layout')

@section('main-content')
<div class="content-wrapper bg-light min-vh-100">
    <!-- Header -->
    <div class="content-header py-4">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 text-dark fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Main Section -->
    <section class="content pb-5">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <!-- Teacher -->
               <div class="col-md-4">
    <div class="small-box card-gradient-teacher shadow-lg p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="text-white-50 mb-1">Total Teachers</h5>
                <h3 class="text-white fw-bold">{{ \App\Models\Teacher::count() }}</h3>
            </div>
            <div class="icon fs-1 text-white">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
        <a href="{{ route('admin.teachers.index') }}" class="text-white-50 fw-semibold d-block mt-3">
            More info <i class="fas fa-arrow-circle-right ms-1"></i>
        </a>
    </div>
</div>


               <!-- Student -->
<div class="col-md-4">
    <div class="small-box card-gradient-student shadow-lg p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-white">{{ \App\Models\Student::count() }}</h3>
                <p class="fs-5 text-white">Students</p>
            </div>
            <div class="icon fs-1 text-white">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
        <a href="{{ route('admin.students.index') }}" class="text-white-50 fw-semibold">
            More info <i class="fas fa-arrow-circle-right ms-1"></i>
        </a>
    </div>
</div>


                <!-- Subject -->
               <div class="col-md-4">
    <div class="small-box card-gradient-subject shadow-lg p-4 rounded-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-white">{{ \App\Models\Subject::count() }}</h3>
                <p class="fs-5 text-white">Subjects</p>
            </div>
            <div class="icon fs-1 text-white">
                <i class="fas fa-book-open"></i>
            </div>
        </div>
        <a href="{{ route('admin.subjects.index') }}" class="text-white-50 fw-semibold">
            More info <i class="fas fa-arrow-circle-right ms-1"></i>
        </a>
    </div>
</div>

            </div>

            <!-- Result Graph + Actions -->
            <div class="row g-4">
                <!-- Chart -->

                        <div class="card-body d-grid gap-3">
                            <a href="{{ route('admin.teachers.create') }}" class="btn btn-teal">
                                <i class="fas fa-plus-circle me-2"></i>Add New Teacher
                            </a>
                            <a href="{{ route('admin.students.create') }}" class="btn btn-indigo">
                                <i class="fas fa-user-plus me-2"></i>Register New Student
                            </a>
                            <a href="{{ route('admin.subjects.create') }}" class="btn btn-purple">
                                <i class="fas fa-book-medical me-2"></i>Create New Subject
                            </a>
                            <a href="{{ route('admin.results.create') }}" class="btn btn-info">
                                <i class="fas fa-poll me-2"></i>Create New Results
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Styles -->
<style>
    .card-gradient-teacher {
        background: linear-gradient(135deg, #17a2b8, #6f42c1);
        color: white;
    }

    .card-gradient-student {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }

    .card-gradient-subject {
        background: linear-gradient(135deg, #6f42c1, #e83e8c);
        color: white;
    }

    .btn-teal {
        background-color: #20c997;
        color: white;
    }

    .btn-indigo {
        background-color: #6610f2;
        color: white;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: white;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .icon {
        color: rgba(255, 255, 255, 0.3);
    }

    .small-box:hover .icon {
        color: rgba(255, 255, 255, 0.5);
    }
</style>

<!-- Chart.js Script -->

@endsection
