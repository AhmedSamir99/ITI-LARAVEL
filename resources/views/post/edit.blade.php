
@extends('layouts.app')

@section('content')
<div class="container mt-4">
        <h2>Edit Post</h2>
        <form action="{{route('posts.update' , ['post'=>$post->id])}}" method="POST" enctype="multipart/form-data">
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
            
            <div class="group">
                <label for="exampleFormControlTextarea1" class="form-label">Post Image</label>
            <input type="file" name="image" class="form-control" id="exampleFormControlTextarea1" >
            @if($post->image_path)
            <img src="{{Storage::url($post->image_path)}}" width="250px"  alt="{{$post->image_path}}">
            @endif
            </div>
            
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection
