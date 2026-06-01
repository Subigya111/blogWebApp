<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;


class PostController extends Controller
{
    /**
     * show all posts
     */
    public function index() 
    {
        // Url: GET /posts
        $latestTime = now()->subDay(); // last 24 hours

        $posts=Post::where('created_at', '>=', $latestTime)->with('user')->orderBy('created_at', 'desc')->get();
        return view('posts.showAllPosts',compact('posts'));


    }

    /**
     * show the form for creating a new post.
     */
    public function create()
    {
        // Url: GET /posts/create
        return view('posts.createNewPost');
    }

    /**
     * save new post.
     */
    public function store(Request $request)
    {
        // Url: POST /posts
        $validate=$request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string|min:30',
        ]);
        $validate['user_id'] = auth()->id();
 

        Post::create($validate);
        return redirect()->route('posts.index')->with('success','Added Post Successfully'); //Redirect user and carry
                                                                            // this message to next page by using session
    }

    /**
     * display the specified post.
     */
    public function show(Post $post)
    {
        // Url: GET /posts/{id}
        $comments = Comment::with('user')->where('post_id', $post->id)->get(); //stores comment of a particular post 
                                                                            //with username
        $userComment = Comment::where('post_id', $post->id)->where('user_id', auth()->id())->first(); //stores comment of 
                                                                                        // logged in user
                                                                                        
        return view('posts.showOnePost',compact('post','comments','userComment')); //compact() makes an array 

    }

    /**
     * show the form for editing the specified post.
     */ 
    public function edit(Post $post)
    {
        // Url: GET /posts/{id}/edit
        if(auth()->id()!==$post->user_id){ //checking if the post belongs to logged in user
            return redirect()->route('loginForm')->with('error','Not allowed');
        }
        return view ('posts.editOnePost',compact('post'));

    }

    /**
     * update post.
     */
    public function update(Request $request, Post $post)
    {
        // Url: PUT /posts/{id}
        if (auth()->id()!==$post->user_id){ //checking if the post belongs to logged in user
            abort(403);
        }
        $validate=$request->validate([
            'title'=>'required|string|max:255',
            'content'=>'required|string|min:30'
        ]);
        $post->update($validate);
        return redirect()->route('posts.index')->with('success','Post Updated Successfully');
        
    }

    /**
     * delete specified post.
     */
    public function destroy(Post $post)
    {
        // Url: DELETE /posts/{id}
        if (auth()->id()!==$post->user_id){
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post deleted successfully');

    }
}
