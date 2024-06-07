<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Post::with(['category', 'user', 'tags'])->orderByDesc('id')->paginate()
        ]);
    }

    public function show($id)
    {
        // return $id;

        $post = Post::with(['category', 'user', 'tags'])->where('id', $id)->first();

        if ($post) {

            // 1 metodo
            return response()->json([
                'success' => true,
                'results' => $post
            ]);

            // 2 metodo
            // return $post;

        } else {


            return response()->json([
                'success' => false,
                'results' => '404 not found'
            ]);
        }
    }
}
