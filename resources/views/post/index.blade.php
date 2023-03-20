@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center">
        <button type="button" class="mt-4 btn btn-success">  <a href="{{route('posts.create')}}" class="btn green  text-white" > Create Post </a> </button>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post['title']}}</td>
                @if ($post->user)
                <td>{{$post->user->name}}</td>
                @else
                <td>Not Found</td>
                @endif
                <td>{{$post['created_at']->format('Y-m-d')}}</td>
                <td>
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>
                    
                    <form style="display: inline" action="{{route('posts.destroy',['post'=> $post->id])}}" method="POST">
                        @csrf
                        @method('Delete')
                        <button id="submit" type="submit" class="btn btn-danger" onclick="return check()">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
        
        

        </tbody>
    </table>
    {{ $posts->links() }}


@endsection


<script>
    function check(){
        
        if (confirm("Are you sure you want to delete this post?")) {
             // code to delete the item
             return true;
             
        } 
        else {
            // code to cancel the deletion
            return false ;
        }

    }

</script>


