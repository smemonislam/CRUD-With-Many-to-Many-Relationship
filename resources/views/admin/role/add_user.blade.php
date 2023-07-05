@extends('admin.layouts.app')

@section('title', 'New User')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Add New User</li>
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
              <a href="{{ route('users.index') }}" class="btn btn-info">Back</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label>User Role</label>
                  <select class="form-control select2" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                    <option>Alaska</option>
                    <option>California</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="userName">Name</label>
                  <input type="text" class="form-control" id="userName" placeholder="User Name">
                </div>
                <div class="form-group">
                  <label for="inputUserName">User Name</label>
                  <input type="text" class="form-control" id="inputUserName" placeholder="Enter User Name">
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" class="form-control" id="inputEmail" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="inputFile">Upload Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inputFile">
                      <label class="custom-file-label" for="inputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>About Me</label>
                  <textarea name="about" id="summernote" class="form-control"></textarea>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="inputCheck">
                  <label class="form-check-label" for="inputCheck">Remember me</label>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
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
