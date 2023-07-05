@extends('admin.layouts.app')

@section('title', 'All User')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>User List</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
       
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Add New User</h3>
              <a href="{{ route('users.create') }}" class="btn btn-info">Add New User</a>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>User Role</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <img src="{{ asset('files/users/'.$user->image) }}" alt="{{ $user->name }}" class="rounded-circle" width="50" height="50">
                    </td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>SL</th>
                <th>Image</th>
                <th>User Role</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
@endsection