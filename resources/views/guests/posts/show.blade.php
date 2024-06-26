@extends('layouts.app')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>{{ $post->title }}</h1>

            <a class="btn btn-primary" href="{{ route('posts.index') }}">All Posts</a>

        </div>

    </header>

    <div class="container mt-5">

        <div class="row">

            <div class="col">

                @if (Str::startsWith($post->cover_image, 'https://'))
                    <img src="{{ $post->cover_image }}" alt="">
                @else
                    <img width="100%" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                @endif

            </div>

            <div class="col">

                <h2>{{ $post->title }}</h2>

                <div>{{ $post->content }}</div>

            </div>
        </div>



    </div>
@endsection
