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

                            <td>
                                @if (Str::startsWith($post->cover_image, 'https://'))
                                    <img width="140px" src="{{ $post->cover_image }}" alt="">
                                @else
                                    <img width="140px" src="{{ asset('storage/' . $post->cover_image) }}" alt="">
                                @endif
                            </td>

                            <td>{{ $post->title }}</td>

                            <td>{{ $post->slug }}</td>

                            <td>

                                <a class="btn btn-primary btn-sm" href="{{ route('admin.posts.show', $post) }}">
                                    <i class="fas fa-eye fa-xs fa-fw"></i> View
                                </a>

                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.posts.edit', $post) }}">
                                    <i class="fas fa-pencil fa-xs fa-fw"></i> Edit
                                </a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $post->id }}">
                                    <i class="fas fa-trash fa-xs fa-fw"></i> Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $post->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $post->id }}">
                                                    Delete post
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                You are about to destroy this post: <strong>{{ $post->title }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        Confirm
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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

        {{ $posts->links('pagination::bootstrap-5') }}

    </div>
@endsection
