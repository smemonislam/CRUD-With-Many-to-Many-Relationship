@extends('admin.layouts.app')

@section('title', 'All Posts')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Posts <span class="badge bg-info">{{ $posts->count() }}</span></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Posts</li>
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
              <a href="{{ route('posts.create') }}" class="btn btn-info">Add New Posts</a>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>SL</th>
                <th>Title</th>
                <th>Author</th>
                <th>Post View</th>
                <th>Is Approved</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->view_count }}</td>
                    <td>
                      @if($post->is_approved == 1)
                        <span class="badge bg-blue">Approved</span>
                      @else
                        <span class="badge bg-pink">Pending</span>
                      @endif
                    </td>
                    <td>
                      @if($post->status == 1)
                        <span class="badge bg-blue">Active</span>
                      @else
                        <span class="badge bg-pink">Deactive</span>
                      @endif
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                      <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm">Edit</a>
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
                <th>Title</th>
                <th>Author</th>
                <th>Post View</th>
                <th>Is Approved</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
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