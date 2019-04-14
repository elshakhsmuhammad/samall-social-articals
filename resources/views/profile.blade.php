@extends('layouts.master')
@section('content')
<h1>{{$user->name}}</h1>
@if(auth()->user()->id == $user->id)
    <h3>hi</h3>
    @else
    <h3>test</h3>
@endif
<img src="..." class="img-fluid" alt="Responsive image">
<div class="accordion-group">
    @foreach($posts as $post)
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo{{'_'.$post->id}}">
                <i class="icon-plus"></i> {{''.$post->title}}</a>
        </div>
        <div id="collapseTwo{{'_'.$post->id}}" class="accordion-body collapse">
            <div class="accordion-inner">
                <div class="offset1 text-dark" > <p class="text-lg-center ">{{$post->body}}</p>
                    <span>{{trans('user.create_by')}}<a href="{{url("/home/profile/".$post->user->id)}}" > :<strong>{{$post->user->name}}</strong></a> </span>
                    <small>{{$post->created_at->diffForHumans()}}</small>
                </div>
                <div class=" offset1 row">
                    @if(Auth::user() == $post->user)

                        <a href="#" class="edit"><i class=" btn btn-light icon-pencil "></i></a>
                        <form style="display: inline"  method="post"  action={{route('home.destroy',$post->id)}} >
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value='DELETE'>
                            <button type="submit" class="btn  btn btn-xs btn-theme" onclick="return confirm('{{trans('user.are_you_shower')}}')">
                                <i class="icon-trash"></i></button>
                        </form>
                    @endif
                    <a href="#" class="btn btn-xs icon-thumbs-up-alt like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                    <a href="#" class="like btn btn-xs icon-thumbs-down-alt like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                </div>
                <div class="offset1 row">

                    <form method="post" action="{{ route('comment.store'   ) }}">
                        @csrf
                        <div class="span9 form-control">
                            <textarea class="span6 form-control" name="body" placeholder="{{trans('user.create_comment')}}"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" />
                        </div>
                        <div class="span4 form-control">
                            <input type="submit" class=" btn btn-success" id="test" value="Add Comment" />
                        </div>
                    </form>
                    <div class="span11">
                        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection