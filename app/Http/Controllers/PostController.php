<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('admin.posts.add_posts', compact('users','categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    

        if( $request->has('image') ){
            $photoname = $request->image;
            $slug = Str::slug($request->title);
            $currentDate = Carbon::now()->toDateString();
            
            if( isset($photoname) ){
                $image = $slug . '-' . $currentDate . '.' . $photoname->getClientOriginalExtension();
                if( !Storage::disk('public')->exists('files/posts') ){
                    Storage::disk('public')->makeDirectory('files/posts');
                }
                $path = storage_path().'/app/public/files/posts/' . $image;
               Image::make($photoname)->resize(1600, 1066)->save($path);
            }else{
                $image = 'default.png';
            }
        }
        $post = new Post;
        $post->user_id      = $request->user_id;
        $post->title        = $request->title;
        $post->body         = $request->body;
        $post->image        = $image;
        $post->status       = $request->status;
        $post->is_approved  = true;

        $post->save();
        
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        return redirect()->back()->with(['message' => 'Added Successfully.', 'alert-type' => 'success']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $users = User::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('admin.posts.edit', compact('post', 'users', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = Post::findOrFail($post->id);

        $photoname = $request->image;
        $slug = Str::slug($request->title);
        $currentDate = Carbon::now()->toDateString();
        
        if( isset($photoname) ){
            $image = $slug . '-' . $currentDate . '.' . $photoname->getClientOriginalExtension();
            if( !Storage::disk('public')->exists('files/posts') ){
                Storage::disk('public')->makeDirectory('files/posts');
            }
            
            if(Storage::exists('public/files/posts/'.$post->image)){
                Storage::delete('public/files/posts/'.$post->image);
            }

            $path = storage_path().'/app/public/files/posts/' . $image;
            Image::make($photoname)->resize(1600, 1066)->save($path);
        }else{
            $image = $post->image;
        }

        $post->user_id      = $request->user_id;
        $post->title        = $request->title;
        $post->body         = $request->body;
        $post->image        = $image;
        if( isset($request->status) ){
            $post->status = true;
        }else{
            $post->status = false;
        }
        
        $post->is_approved  = true;

        $post->save();
        
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        return redirect()->back()->with(['message' => 'Update Successfully.', 'alert-type' => 'success']);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(Storage::disk('public')->exists('files/posts/'.$post->image)){
            Storage::disk('public')->delete('files/posts/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();

        return redirect()->back()->with(['message' => 'Delete Successfully.', 'alert-type' => 'success']);
    }
}
