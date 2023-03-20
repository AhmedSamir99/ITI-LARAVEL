
@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <h2>Edit Post</h2>
        <form action="{{route('posts.update' , ['post'=>$post->id])}}" method="POST">
            <!-- Add CSRF token field if using Laravel -->
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="Title" >Title:</label>
                <input type="text" class="form-control" id="Title" name="Title" value="{{$post->title}}">
            </div>
            
            <div class="form-group">
                <label for="Description">Description:</label>
                <input type="text" class="form-control" id="Description" name="Description" value="{{$post->description}}">
            </div>
            
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection
