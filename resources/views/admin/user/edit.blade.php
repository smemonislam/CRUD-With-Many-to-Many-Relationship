@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Edit User</li>
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
              <h3 class="card-title">Edit User</h3>
              <a href="{{ route('users.create') }}" class="btn btn-info">Add New User</a>
              <a href="{{ route('users.index') }}" class="btn btn-info">Back</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
           <!-- form start -->
           <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label>User Role</label>
                  <select name="user_role" class="form-control select2" style="width: 100%;">                    
                    @foreach ($user_roles as $key => $item)                     
                      <option value="{{ $key }}" @selected($user->role_id == $key)>{{ $item }}</option>
                    @endforeach                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="userName">Name</label>
                  <input type="text" name="name" class="form-control" id="userName" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                  <label for="inputUserName">User Name</label>
                  <input type="text" name="username" class="form-control" id="inputUserName" value="{{ $user->username }}">
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                  <label for="inputPassword">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="inputConfirm">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="inputConfirm" placeholder="Confrim Password">
                </div>
                <div class="form-group">
                  <label for="inputFile">Upload Image</label>
                  <input type="file" class="dropify" name="image" class="form-control" data-allowed-file-extensions="jpg jpeg png"/>
                  <input type="hidden" name="old_image" value="{{ $user->image }}">
                </div>
                <div class="form-group">
                  <label>About Me</label>
                  <textarea name="about" id="summernote" class="form-control">{{ $user->about }}</textarea>
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
@push('js')
    <script type="text/javascript">
      $('.dropify').dropify();
    </script>
@endpush