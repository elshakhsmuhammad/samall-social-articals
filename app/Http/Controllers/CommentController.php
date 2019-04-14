<?php

namespace App\Http\Controllers;
use App\Notifications\Repyl_to_comment;
use App\Post;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(){

          //  $posts = Post::orderBy('created_at', 'desc')->get();
        return redirect(url('/home'));

    }
  /**  public function store(Request $request ,Post $post)

    {
        $request->validate([
            'body'=>'required',
        ]);


        $comment = new Comment();
     $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
           $comment->post_id = $request->post_id;

              $comment->save();
            //     return response(['success_message' => 'SuccessFully Make comment']);
            ///  $comment = Comment::find($this->route('comment'));

            //  return $comment && $this->user()->can('update', $comment);
            //}else{
//            }
//              $input['user_id'] = auth()->user()->id;

         //    Comment::create($input);
            // Auth()->user()->notify(new Repyl_to_comment($post));
            //  return redirect(url('/home',compact('comment')));
     //   return response($comment);
    return redirect(url('/home'));
    }**/
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'body' => 'required|string',
        ]);
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id =$request->post_id;
        $comment->body = $data['body'];
        $comment->save();
        // send notification to the author of the post commented on
//        $post = Post::find($id);
//        User::find($post->user_id)->notify(new Notify(auth()->id(), ' commented on ', $id));

        $addedComment = $this->addedComment($comment);
//        return $addedComment;
        return response()->json(['comment' => $addedComment]);
    }
    public function destroy($comment_id)
    {
        $comment = Comment::where('id', $comment_id)->first();
        if (Auth::user() != $comment->user) {
            return redirect()->back();
        }
        $comment->delete();
        return redirect(url('/home'));
    }
    public function postLikeComment(Request $request)
    {
        $comment_id = $request['commentId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $comment = Comment::find($comment_id);
        if (!$comment) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('comment_id', $comment_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }

}