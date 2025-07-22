@extends('admin.layout.layout')
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper " style="background-color: #b7d9ee">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" style="color: rgb(7, 20, 60);"><b>Admin Dashboard</b></h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">

            <section class="section">
                <div class="row justify-content-center mt-2">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <section>


                                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle me-1"></i>Add New
                                        Teacher</a>

                                  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $teacher)
                                                <tr>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->email }}</td>

                                                    <td>{{ $teacher->department }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf @method('DELETE')
                                                            <button class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                        <div></div>


            </section>
            <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
