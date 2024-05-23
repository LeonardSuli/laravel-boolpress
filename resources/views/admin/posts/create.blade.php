@extends('layouts.admin')

@section('content')
    <div class="container">

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Add a title for the post" />
                <small id="titleHelper" class="form-text text-muted">Add post title here</small>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Create
            </button>




        </form>
    </div>
@endsection
