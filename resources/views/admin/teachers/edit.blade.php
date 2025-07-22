
@extends('admin.layout.layout')
@section('main-content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper " style="background-color: #b7d9ee">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 ">
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
        <div class="row justify-content-center mt-2">
            <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <section>


    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ $teacher->name }}" required class="form-control" />
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $teacher->email }}" required class="form-control" />
    </div>

    <div>
        <label>Password:</label>
        <input type="password" name="password" class="form-control" />
    </div>

    <div>
        <label>Department:</label>
        <input type="text" name="department" value="{{ $teacher->department }}" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>

</section>
            </div></div></div></div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
