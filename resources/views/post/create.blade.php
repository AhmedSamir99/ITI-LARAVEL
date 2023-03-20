
@extends('layouts.app')



@section('content')
    

<div class="container">
		<h1>Create a New Post</h1>
		<form action="{{route('posts.store')}}" method="post">
  @csrf
			<div class="form-group" >
				<label for="post-title">Title</label>
				<input type="text" class="form-control" id="post-title" placeholder="Enter post title" name="title">
			</div>
			<div class="form-group">
				<label for="post-content">Description</label>
				<textarea class="form-control" id="post-content" rows="5" placeholder="Enter post content" name="description"></textarea>
			</div>

            <div class="mb-3">
				<label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
				<select name="post_creator" class="form-control">
					@foreach($users as $user)
						<option value="{{$user->id}}">{{$user->name}}</option>
					@endforeach
				</select>
			</div>

<button type="submit" class="btn btn-primary">Publish Post </button>
		</form>
	</div>






@endsection