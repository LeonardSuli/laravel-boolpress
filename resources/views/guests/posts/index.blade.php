@extends('layouts.app')

@section('content')
    <div class="jumbotron p-5 mb-4 text-white"
        style="background-image: url({{ asset('storage/' . $posts[0]->cover_image) }}); background-size: cover;">

        <div class="container py-5">

            <h1 class="display-5 fw-bold">
                Posts
            </h1>

            <p class="col-md-8 fs-4">Read our amazing Blog</p>

            <a class="btn btn-outline-light" href="#posts">
                <i class="fa fa-chevron-down" aria-hidden="true"></i>
            </a>
        </div>

    </div>

    <section id="posts">

        <div class="container my-3">

            <h1>All posts for guests here.</h1>

            <div class="row row-cols-1 row-cols-sm-3 g-4 pb-4">

                @forelse ($posts as $post)
                    @include('partials.post-card')

                @empty

                    <div class="col-12">
                        <p>No posts here.</p>
                    </div>
                @endforelse
            </div>

            {{ $posts->links('pagination::bootstrap-5') }}

        </div>

    </section>
@endsection
