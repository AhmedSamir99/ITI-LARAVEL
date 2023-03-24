<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts= Post::all();
        $allPosts = Post::orderBy('created_at', 'desc')->paginate(10);
       
        return view('post.index', ['posts' => $allPosts] );
    }

    public function show($id)
    {
//        dd($id);

        $post=Post::find($id);
        $comments=$post->comments;
        // $post =  [
        //     'id' => 3,
        //     'title' => 'Javascript',
        //     'posted_by' => 'Ali',
        //     'created_at' => '2022-08-01 10:00:00',
        //     'description' => 'hello description',
        // ];

//        dd($post);
// dd($comments);
return view('post.show', ["comments"=>$comments],['post' => $post]);
    }

    public function create()
    {
        $users=User::all();
        // dd($users);
        return view('post.create',['users'=>$users]);
        // return "hellooooooo";
    }

    public function store(StorePostRequest $request){

      $post=new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = $request->input('post_creator');
        
        $path = Storage::putFile('public', $request->file('image'));
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('public/posts', $image, $filename);
            $post->image_path = $path;
            $post->save();
        }

        return to_route('posts.index');

    }

    public function edit($id){
        
        $post=Post::find($id);
        // dd($post);
        // return view('post.edit');
        // return view('post.index');
        return view('post.edit', ['post' => $post]);

    }

    public function update($id,Request $request){
        
        $post=Post::find($id);
        // dd($post->title);

        // $title=$post->title;
        // $description=$post->description;

        // dd($request->Title);
        // dd($request->Description);


        $post->update([
            'title'=>$request->Title,
            'description'=> $request->Description
        ]);
        
        return redirect()-> route('posts.index');
    }

    public function destroy($id){

         $post = Post::find($id);
        
         $post->delete();
        //  dd($post);

         return redirect()->route('posts.index');




    }






}