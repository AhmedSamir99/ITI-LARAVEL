
@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <h2>Edit Post</h2>
        <form action="{{route('posts.store')}}" method="POST">
            <!-- Add CSRF token field if using Laravel -->
            @csrf
            <div class="form-group">
                <label for="Title">Title:</label>
                <input type="text" class="form-control" id="Title" name="Title" value="">
            </div>
            <div class="form-group">
                <label for="Title">Description:</label>
                <input type="text" class="form-control" id="Title" name="Title" value="">
            </div>
            <div class="form-group">
                <label for="Post Creator">Post Creator</label>
                <input type="text" class="form-control" id="Post Creator" name="Post Creator" value="">
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection
