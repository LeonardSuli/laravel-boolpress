@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Editing Post: {{ $post->title }}</h1>

            <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>

        </div>

    </header>
    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Add a title for the post" value="{{ old('title', $post->title) }}" />
                <small id="titleHelper" class="form-text text-muted">Add post title here</small>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option selected disabled>Select one</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{-- {{ $category->id === old('category_id', $post->category->id) ? 'selected' : '' }}> --}} {{-- {{ $category->name }} --}}
                            {{ $category->id === old('category_id', optional($post->category)->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Cover Image --}}
            <div class="d-flex gap-3">

                <img width="140px" src="{{ asset('storage/' . $post->cover_image) }}" alt="">

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Upload Another Cover Image</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Cover image"
                        aria-describedby="coverImageHelper" />
                    <div id="coverImageHelper" class="form-text">Upload a cover image for this post</div>
                </div>

            </div>

            {{-- Tags --}}
            <div class="mb-3 d-flex gap-3">

                @foreach ($tags as $tag)
                    <div class="form-check">

                        {{-- Errors --}}
                        @if ($errors->any())
                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                id="tag-{{ $tag->id }}" name="tags[]"
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} />
                        @else
                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                id="tag-{{ $tag->id }}" name="tags[]"
                                {{ $post->tags->contains($tag->id) ? 'checked' : '' }} />
                        @endif
                        <label class="form-check-label" for="tag-{{ $tag->id }}"> {{ $tag->name }} </label>
                    </div>
                @endforeach

            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="5">{{ old('content', $post->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

        </form>
    </div>
@endsection
