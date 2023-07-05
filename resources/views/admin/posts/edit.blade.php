@extends('admin.layouts.app')

@section('title', 'Edit Posts')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Posts</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Edit Posts</li>
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
              <h3 class="card-title">Edit Posts</h3>
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
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="userId">Select User</label>
                          <select name="user_id" id="userId" class="select2 form-control">
                            @foreach($users as $key => $user)
                              <option value="{{ $key }}" @selected($key == $post->user_id)>{{ $user }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                      <label for="postTitle">Post Title</label>
                      <input type="text" name="title" class="form-control" id="postTitle" value="{{ $post->title }}">
                    </div>
                    <div class="form-group">
                      <label>Body</label>
                      <textarea name="body" id="summernoteposts" class="form-control">value="{{ $post->body }}"</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }}">
                          <label for="category">Select Category</label>
                          <select name="categories[]" id="category" class="select2 form-control" multiple="multiple">
                            @foreach($categories as $key => $category)
                              <option 
                                @foreach ($post->categories as $postCategory)
                                  {{ $postCategory->id == $key ? 'selected' : '' }}
                                @endforeach
                              value="{{ $key }}" >{{ $category }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
                          <label for="tag">Select Tags</label>
                          <select name="tags[]" id="tag" class="select2 form-control" multiple>
                            @foreach($tags as $key => $tag)
                              <option 
                                @foreach ($post->tags as $postTag)
                                  {{ $postTag->id == $key ? 'selected' : '' }}
                                @endforeach
                              value="{{ $key }}">{{ $tag }}</option>
                            @endforeach
                          </select>
                      </div>                      
                    </div>
                    <div class="form-group">
                      <label for="postImage">Featured Image</label>
                      <input type="file" class="dropify" name="image" class="form-control" data-allowed-file-extensions="jpg jpeg png"/>
                      <input type="hidden" class="form-control" name="old_image" value="{{ $post->image }}">
                    </div>
                    <div class="form-group">
                      <input type="checkbox" id="publish" class="filled-in" name="status" @checked(old('status', $post->status)) value="1">
                      <label for="publish">Publish</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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