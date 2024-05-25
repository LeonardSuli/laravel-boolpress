@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">
                Welcome to Boolpress
            </h1>

            <p class="col-md-8 fs-4">Read our amazing blog</p>
        </div>
    </div>

    <div class="latest_post">
        <div class="container">
            <div class="row">

                @forelse ($latest_posts as $post)
                    <div class="col">

                        <div class="card">

                            @if (Str::startsWith($post->cover_image, 'https://'))
                                <img class="card-img-top" src="{{ $post->cover_image }}" alt="">
                            @else
                                <img class="card-img-top" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                            @endif

                            <div class="card-body">
                                <h3>{{ $post->title }}</h3>
                            </div>
                        </div>

                    </div>

                @empty

                    <div class="col">
                        No posts here.
                    </div>
                @endforelse


            </div>
        </div>
    </div>
@endsection
