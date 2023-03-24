
@extends('layouts.app')



@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="container">
		<h1>Create a New Post</h1>
		<form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
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
				<label for="exampleFormControlTextarea1" class="form-label">Image</label>
				<input type="file" name="image" class="form-control" id="exampleFormControlTextarea1" rows="3">
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
