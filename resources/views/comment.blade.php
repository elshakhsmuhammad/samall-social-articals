<div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
    <a href="{{url("/home/profile/".$comment->user->id)}}" > :<strong>{{$comment->user->name}}</strong></a>
    <p>{{ $comment->body }}</p>
    <div class="interaction">
        <a href="#" class="btn btn-xs btn-warning like">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->like == 1 ? 'You like this comment' : 'Like' : 'Like'  }}</a> |
        <a href="#" class="btn btn-xs btn-theme like">{{ Auth::user()->likes()->where('comment_id', $comment->id)->first() ? Auth::user()->likes()->where('comment_id', $comment->id)->first()->like == 0 ? 'You don\'t like this comment' : 'Dislike' : 'Dislike'  }}</a>
        @if(Auth::user() == $post->user)
            <a href="#" class="edit"><i class=" btn btn-light icon-pencil "></i></a>
            <form style="display: inline"  method="post"  action={{route('comment.destroy',$comment->id)}} >
                {{csrf_field()}}
                <input type="hidden" name="_method" value='DELETE'>
                <button type="submit" class="btn btn-theme" onclick="return confirm('{{trans('user.are_you_shower')}}')">
                    <i class="icon-trash"></i></button>
            </form>
        @endif
        <div>
            <a href="" id="reply"></a>

            <input type="text" name="body" class="form-control" id="commentBox"/>



            <div>
                @include('posts.commentsDisplay', ['comments' => $comment->replies])
            </div>
        </div>
    </div>
</div>
