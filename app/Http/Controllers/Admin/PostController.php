<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Post::orderByDesc('id')->paginate());

        return view('admin.posts.index', ['posts' => Post::orderByDesc('id')->paginate()]);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd($request->all());

        // validate
        $val_data = $request->validated();
        // dd($val_data);
        $val_data['slug'] = Str::slug($request->title, '-');

        // create
        Post::create($val_data);

        // redirect
        return to_route('admin.posts.index')->with('message', 'Post created successfully');
    }





    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // dd($request->all());

        // validate
        $val_data = $request->validated();
        // dd($val_data);
        $val_data['slug'] = Str::slug($request->title, '-');

        // update
        $post->update($val_data);

        // redirect
        return to_route('admin.posts.index')->with('message', 'Post updated successfully');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
