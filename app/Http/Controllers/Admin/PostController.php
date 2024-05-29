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

        return view('admin.posts.index', ['posts' => Post::where('user_id', auth()->id())->orderByDesc('id')->paginate()]);
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

        if ($request->has('cover_image')) {

            $image_path = Storage::put('uploads', $request->cover_image);
            // dd($image_path);

            $val_data['cover_image'] = $image_path;
            // dd($val_data);
        }

        $val_data['user_id'] = auth()->id();

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

        if ($post->user_id == auth()->id()) {

            $categories = Category::all();

            return view('admin.posts.edit', compact('post', 'categories'));
        }
        abort(403, 'You cannnot edit posts of others users!');
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // Se un altro utente prova ad hackerare i post degli altri non può
        if (auth()->id != $post->user_id) {

            abort(403, 'Really you try hack my app???');
        }

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
        // Se un altro utente prova ad hackerare i post degli altri non può
        if (auth()->id() != $post->user_id) {

            abort(403, 'Really you try hack my app???');
        }

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
