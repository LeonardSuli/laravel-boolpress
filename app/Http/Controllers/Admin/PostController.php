<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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
        return view('admin.posts.create', ['categories' => Category::all()]);
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

        $image_path = Storage::put('uploads', $request->cover_image);
        // dd($image_path);
        $val_data['cover_image'] = $image_path;
        // dd($val_data);

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
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
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

        if ($request->has('cover_image')) {

            // check if the current post has a cover image
            if ($post->cover_image) {

                // if so, delete it
                Storage::delete($post->cover_image);
            }

            // upload the new image
            $image_path = Storage::put('uploads', $request->cover_image);
            // dd($image_path);
            $val_data['cover_image'] = $image_path;
            // dd($val_data);

        };

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

        if ($post->cover_image) {

            // if so, delete it
            Storage::delete($post->cover_image);
        }

        // delete the resource
        $post->delete();

        // redirect
        return to_route('admin.posts.index')->with('message', 'Post deleted successfully');
    }
}
