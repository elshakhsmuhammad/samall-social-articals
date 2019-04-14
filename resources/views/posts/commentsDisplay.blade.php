
@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
        <h6>{{ $comment->user->name }}</h6>
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
        <form method="post" action="{{ route('comment.store',$post->id) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="{{trans('user.reply')}}" />
            </div>
        </form>

<div>
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
            </div>
        </div>
    </div>

@endforeach