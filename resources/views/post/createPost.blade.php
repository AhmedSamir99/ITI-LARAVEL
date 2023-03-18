
@extends('layouts.app')



@section('content')
    

<div class="container">
		<h1>Create a New Post</h1>
		<form action="{{route('posts.store')}}" method="post">
  @csrf
			<div class="form-group" >
				<label for="post-title">Title</label>
				<input type="text" class="form-control" id="post-title" placeholder="Enter post title">
			</div>
			<div class="form-group">
				<label for="post-content">Description</label>
				<textarea class="form-control" id="post-content" rows="5" placeholder="Enter post content"></textarea>
			</div>

            <div class="form-group mb-3">
    <label for="post-creator">Post Creator</label>
    <input type="text" class="form-control" id="post-creater" placeholder="Enter your name">
</div>

<button type="submit" class="btn btn-primary">Publish Post </button>
		</form>
	</div>






@endsection
