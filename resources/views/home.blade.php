@extends('layouts.master')
@section('content')
    <div class="container">
    <div class="row">
        <div class="offset3 span8">
            <h3>{{trans('user.what_do_you_have_to_say?')}} </h3>

                <div class="row controls">

                         <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                    <div class="span6 control-group">
                        <input style="width: 96%;" type="text"id="posttitle" class="form-control" name="title"  placeholder="{{trans('user.subject_title')}}" title="{{trans('user.subject_title')}}">
                    </div>

                </div>
                <div class="row controls">
                    <div class="span6 control-group">

                        <textarea placeholder="{{trans('user.subject')}}" maxlength="5000" rows="7" name="body"id="postbody" title="{{trans('user.subject')}}" class="span6"></textarea>
                    </div>
                </div>
                <div class="btn-toolbar">
                    <input type="submit" value="{{trans('user.publish')}}" class="btn btn-theme" id="postBtn" title="{{trans('user.publish')}}">
                </div>

        </div>
    </div>

        <div class="row">
        <h4>{{trans('user.posts')}}</h4>
        <!-- start: Accordion -->

            <div class="accordion-group"  id="postslist">
                @foreach($posts as $post)
              @include('postList')
                    @endforeach
            </div>
        </div>
        </div>

        </div>
    <div class="offset1 pagination"> <ul> <li class="disabled">   {{ $posts->links() }}</li> </ul> </div>
    </div>
        <!--end: Accordion -->
    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
        var urlLikeComment ='{{route('likeComment')}}'

    </script>
@endsection
@section('javascript')
    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function(){

            // Fetch records
            fetchRecords();

            // Add record
            $('#postBtn').click(function(){

                var user_id= $('#user_id').val();
                var title = $('#posttitle').val();
                var body = $('#postbody').val();

                if(user_id != ''  && body != ''){
                    $.ajax({
                        url: 'addPost',
                        type: 'post',
                        data: {_token: CSRF_TOKEN,user_id: user_id,title: title,body: body},
                        success: function(response){

                            if(response > 0){
                                var id = response;
                                var findnorecord = $('#postslist div.norecord').length;

                                if(findnorecord > 0){
                                    $('#postslist div.norecord').remove();
                                }
                                var tr_str = "<div >"+
                                    "<div  align='center'><input type='hidden' value='" + user_id + "' id='user_id"+id+"' disabled ></div >" +
                                    "<div align='center'><input type='text' value='" +posttitle+ "' id='posttitle_"+id+"'></div>" +
                                    "<div align='center'><textarea  value='" +postbody + "' id='postbody_"+id+"'></textarea></div>" +
                                    "<div align='center'><input type='button' value='Update' class='update' data-id='"+id+"' ><input type='button' value='Delete' class='delete' data-id='"+id+"' ></div>"+
                                    "</div>";

                                $("#postslist div").append(tr_str);
                            }else if(response == 0){
                                alert('Username already in use.');
                            }else{
                                alert(response);
                            }

                            // Empty the input fields
                            $('#user_id').val('');
                            $('#posttitle').val('');
                            $('#postbody').val('');
                        }
                    });
                }else{
                    alert('Fill all fields');
                }
            });

        });

        // Update record
        $(document).on("click", ".update" , function() {
            var edit_id = $(this).data('id');

            var posttitle = $('#posttitle_'+edit_id).val();
            var postbody = $('#postbody_'+edit_id).val();

            if(posttitle != '' && postbody != ''){
                $.ajax({
                    url: 'updatePost',
                    type: 'post',
                    data: {_token: CSRF_TOKEN,editid: edit_id,title:title,body: body},
                    success: function(response){
                        alert(response);
                    }
                });
            }else{
                alert('Fill all fields');
            }
        });

        // Delete record
        $(document).on("click", ".delete" , function() {
            var delete_id = $(this).data('id');
            var el = this;
            $.ajax({
                url: 'deletePost/'+delete_id,
                type: 'get',
                success: function(response){
                    $(el).closest( "div" ).remove();
                    alert(response);
                }
            });
        });

        // Fetch records
        function fetchRecords(){
            $.ajax({
                url: 'getPostss',
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    $('#userTable div:not(:first)').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        for(var i=0; i<len; i++){

                            var id = response['data'][i].id;
                            var user_id = response['data'][i].user_id;
                            var title = response['data'][i].title;
                            var body = response['data'][i].body;

                            var tr_str = "<div >"+
                                "<div  align='center'><input type='hidden' value='" + user_id + "' id='user_id"+id+"' disabled ></div >" +
                                "<div align='center'><input type='text' value='" +posttitle+ "' id='posttitle_"+id+"'></div>" +
                                "<div align='center'><textarea  value='" +postbody + "' id='postbody_"+id+"'></textarea></div>" +
                                "<div align='center'><input type='button' value='Update' class='update' data-id='"+id+"' ><input type='button' value='Delete' class='delete' data-id='"+id+"' ></div>"+
                                "</div>";


                            $("#postslist div").append(tr_str);

                        }
                    }else{
                        var tr_str = "<div class='norecord'>" +
                            "<div  align='center' colspan='4'>No record found.</div >" +
                            "</div>";

                        $("#postslist div").append(tr_str);
                    }

                }
            });
        }
/////////////////////////////////postLikes///////////////////////////////////////////////////
            var postId = 0;
            $('.like').on('click', function(event) {
                event.preventDefault();
                postId = event.target.parentNode.parentNode.dataset['postid'];
                var isLike = event.target.previousElementSibling == null;
                $.ajax({
                    method: 'POST',
                    url: urlLike,
                    data: {isLike: isLike, postId: postId, _token: token}
                })
                    .done(function() {
                        event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don't like this post' : 'Dislike';
                        if (isLike) {
                            event.target.nextElementSibling.innerText = 'Dislike';
                        } else {
                            event.target.previousElementSibling.innerText = 'Like';
                        }
                    });
            });
 ////////////////////////////////////////////////////////commentsLike///////////////////////
            var commentId = 0;
            $('.likeComment').on('click', function(event) {
                event.preventDefault();
                commentId = event.target.parentNode.parentNode.dataset['commentid'];
                var isLike = event.target.previousElementSibling == null;
                $.ajax({
                    method: 'POST',
                    url: urlLikeComment,
                    data: {isLike: isLike, commentId:commentId, _token: token}
                })
                    .done(function() {
                        event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don't like this post' : 'Dislike';
                        if (isLike) {
                            event.target.nextElementSibling.innerText = 'Dislike';
                        } else {
                            event.target.previousElementSibling.innerText = 'Like';
                        }
                    });
            });
            /////////////////////////////////////////////////////////////////////////////////////add comment////


    </script>
@endsection
