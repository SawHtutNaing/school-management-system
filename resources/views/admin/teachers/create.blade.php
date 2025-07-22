
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


    <form action="{{ route('admin.teachers.store') }}" method="POST">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" required class="form-control" />
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required class="form-control" />
        </div>
        <div>
            <label>Password:</label>
            <input type="text" name="password" class="form-control" />
        </div>
        {{-- <div>
            <label>Department:</label>
            <input type="text" name="department" class="form-control" />
        </div> --}}
        <div>
        <label for="department">Department:</label>
                    <select name="department" id="department" class="form-control">
                        <option value="Select department">Select department</option>
                      <option value="Software department">Software department</option>
                      <option value="Hardware department">Hardware department</option>
                      <option value="English department">English department</option>
                      <option value="Computing department">Computing department</option>

                      </select>
        </div>
        <button type="submit" class="btn btn-success mt-2">Add</button>
    </form>
            </div></div>
            </div>

        </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
