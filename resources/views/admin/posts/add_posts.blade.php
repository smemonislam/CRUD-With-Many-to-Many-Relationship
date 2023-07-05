@extends('admin.layouts.app')

@section('title', 'New Posts')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New Posts</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Add New Posts</li>
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
              <h3 class="card-title">Add New Posts</h3>
              <a href="{{ route('posts.index') }}" class="btn btn-info">Back</a>
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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userId">Select User</label>
                          <select name="user_id" id="userId" class="select2 form-control">
                            @foreach($users as $key => $user)
                              <option value="{{ $key }}">{{ $user }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                      <label for="postTitle">Post Title</label>
                      <input type="text" name="title" class="form-control" id="postTitle">
                    </div>
                    <div class="form-group">
                      <label>Body</label>
                      <textarea name="body" id="summernoteposts" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                          <label for="category">Select Category</label>
                          <select name="categories[]" id="category" class="select2 form-control" multiple="multiple">
                            @foreach($categories as $key => $category)
                              <option value="{{ $key }}">{{ $category }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                          <label for="tag">Select Tags</label>
                          <select name="tags[]" id="tag" class="select2 form-control" multiple>
                            @foreach($tags as $key => $tag)
                              <option value="{{ $key }}">{{ $tag }}</option>
                            @endforeach
                          </select>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label for="postImage">Featured Image</label>
                      <input type="file" class="dropify" name="image" class="form-control" data-allowed-file-extensions="jpg jpeg png"/>
                    </div>
                    <div class="form-group">
                      <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                      <label for="publish">Publish</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Publish</button>
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
    $('#summernoteposts').summernote({
      height: 300     
    });
  </script>
@endpush