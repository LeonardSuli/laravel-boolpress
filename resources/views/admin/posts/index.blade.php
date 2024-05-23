@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Posts</h1>

            <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create</a>

        </div>

    </header>

    {{-- Flash redirect --}}
    <div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cover image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($posts as $post)
                        <tr class="">
                            <td scope="row">{{ $post->id }}</td>
                            <td><img src="{{ $post->cover_image }}" alt=""></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->slug }}</td>

                            <td>
                                <a href="{{ route('admin.posts.show', $post) }}">View</a>
                                <a href="{{ route('admin.posts.edit', $post) }}">Edit</a>
                            </td>

                        </tr>

                    @empty

                        <tr class="">
                            <td scope="row" colspan="5">No record to show.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

    </div>
@endsection
