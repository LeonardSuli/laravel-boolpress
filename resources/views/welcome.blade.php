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
                    @include('partials.post-card')

                @empty

                    <div class="col">
                        No posts here.
                    </div>
                @endforelse


            </div>
        </div>
    </div>
@endsection
