@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Create Post</h1>

            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>

        </div>

    </header>

    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Add a title for the post" />
                <small id="titleHelper" class="form-text text-muted">Add post title here</small>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option selected disabled>Select one</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach

                </select>
            </div>

            {{-- Cover Image --}}
            <div class="mb-3">
                <label for="cover_image" class="form-label">Upload Cover Image</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Cover image"
                    aria-describedby="coverImageHelper" />
                <div id="coverImageHelper" class="form-text">Upload a cover image for this post</div>
            </div>

            {{-- Tags --}}
            <div class="mb-3 d-flex gap-3">

                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                            id="tag-{{ $tag->id }}" name="tags[]"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="tag-{{ $tag->id }}"> {{ $tag->name }} </label>
                    </div>
                @endforeach

            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="5">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Create
            </button>




        </form>
    </div>
@endsection
