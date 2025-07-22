
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

    <!-- Filter Tabs -->
    <div class="d-flex justify-content-center mb-3">
    <div class="btn-group" role="group" aria-label="Subject Filter">
        <a href="{{ route('admin.subjects.filter', 'software') }}"
           class="btn btn-outline-success {{ request()->is('admin/subjects/filter/software') ? 'active' : '' }}">
            <i class="fas fa-laptop-code"></i> Software
        </a>
        <a href="{{ route('admin.subjects.filter', 'hardware') }}"
           class="btn btn-outline-primary {{ request()->is('admin/subjects/filter/hardware') ? 'active' : '' }}">
            <i class="fas fa-microchip"></i> Hardware
        </a>
         <a href="{{ route('admin.subjects.filter', 'both') }}"
           class="btn btn-outline-info {{ request()->is('admin/subjects/filter/both') ? 'active' : '' }}">
            <i class="fas fa-object-group"></i> Both
        </a>
        <a href="{{ route('admin.subjects.index') }}"
           class="btn btn-outline-secondary {{ request()->is('admin/subjects') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> All
        </a>
    </div>
</div>


    <!-- Main Content -->
    <div class="row mb-2 justify-content-center mt-2" >

            <div class=" col-2 col-md-10">

        <div class="card">
            <div class="card-body">

                <a href="{{ route('admin.subjects.create') }}" class="btn btn-success mb-2"><i class="fas fa-plus-circle me-1"></i>Add Subject</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white">
        <thead>
            <tr>



                <th>Code</th>
                <th>Name</th>
                <th>Class</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>



                <td>{{ $subject->subjectCode->type ?? '' }}-{{ $subject->code }}</td>
                <td>{{ $subject->name }}</td>
                <td><span class="badge bg-secondary">{{ $subject->class->name  }}/{{ $subject->class->term }}/{{ $subject->class->section  }}</span></td>
                <td>{{ $subject->teacher->name ?? 'N/A' }}</td>
                <td>
<a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-warning btn-sm">Edit</a>
<form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">Delete</button>
</form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


            </div></div>
            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
