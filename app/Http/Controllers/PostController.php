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
        
        $allPosts = Post::orderBy('created_at', 'desc')->with('user')->paginate(10);
       
        return view('post.index', ['posts' => $allPosts] );
    }

    public function show($id)
    {

        $post=Post::find($id);
        $comments=$post->comments;
        
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
        
        // $path = Storage::putFile('public', $request->file('image'));
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName(); //the name of the image
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

    public function update(Request $request,$id){
        
        $post=Post::find($id);
        $title= request()->title;
        $description=request()->description;
        $postCreator=request()->post_creator;
        

            
        if ($request->hasFile('image')) {
            if($post->image_path){
                $imagePath=$post->image_path;
                dd($imagePath);
                Storage::delete('public/posts/'. $imagePath);
            }
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('public/posts/', $image, $filename);
            $post->image_path = $path;
        }
        

        
    
        $post->save();
        return redirect()->back();
    }

    public function destroy($id){

         $post = Post::find($id);
        
         $post->delete();
        //  dd($post);

         return redirect()->route('posts.index');




    }






}