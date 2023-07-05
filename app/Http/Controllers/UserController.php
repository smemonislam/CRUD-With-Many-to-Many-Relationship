<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Requests\updateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_roles = Role::pluck('name', 'id');
        return view('admin.user.add_user', compact('user_roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        

        if($request->file('image')){
            $photoname = $request->image;
            $image = time(). '.' . $photoname->getClientOriginalExtension();   
            Image::make($photoname)->resize(300, 300)->save(public_path('files/users/').$image);
        }

        $data = [
            "role_id"   => $request->user_role,
            "name"      => $request->name,
            "username"  => $request->username,
            "email"     => $request->email,
            "password"  => bcrypt($request->password),
            "about"     => $request->about,
            'image'     => $image,
        ];

        User::create($data);
        return redirect()->back()->with(['message' => 'Added Successfully.', 'alert-type' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user_roles = Role::pluck('name', 'id');
        return view('admin.user.edit', compact('user', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, User $user)
    {
        $user = User::findOrFail($user->id);
        $user->role_id  = $request->user_role;
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->about    = $request->about;

        if($request->file('image')){
            $destination = 'files/users/' . $request->old_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            
            $photoname = $request->image;
            $image = time(). '.' . $photoname->getClientOriginalExtension();   
            Image::make($photoname)->resize(300, 300)->save(public_path('files/users/').$image);
            $user->image    = $image;
        }

        $user->update();
        return redirect()->back()->with(['message' => 'Update Successfully.', 'alert-type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with(['message' => 'Delete Successfully.', 'alert-type' => 'success']);
    }
}
