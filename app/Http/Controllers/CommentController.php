<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function storeComment(CommentRequest $request,Post $post){
      $validated=$request->validated();
      Comment::create([
        'comment'=>$validated['comment'],
        'post_id'=>$post->id ,
        'user_id'=>auth()->id()
      ]);
   
      return redirect()->route('posts.show',$post)->with('success','Comment Added');
    }

    public function editComment(Comment $comment){
        if (auth()->id() !== $comment->user_id) {  //checking if the comment belongs to logged in user
        abort(403);
    }

      return view('stuffs.editComment',compact('comment'));
    }
    public function updateComment(Request $request, Comment $comment){
    if (auth()->id() !== $comment->user_id) {  //checking if the comment belongs to logged in user
        abort(403);
    }

    $validated = $request->validate([
        'comment' => 'required'
    ]);

    $comment->update($validated);

    return redirect()->route('posts.show',$comment->post_id)->with('success','Comment Updated');
}
public function deleteComment(Comment $comment)
{
    if (auth()->id() !== $comment->user_id) {
        abort(403);
    }

    $comment->delete();

    return redirect()->back()->with('success','Comment Deleted');
}
}
