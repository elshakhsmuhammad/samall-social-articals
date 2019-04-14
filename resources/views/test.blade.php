<div class="row">
    <div class="offset3 span8">
        <h3>{{trans('user.what_do_you_have_to_say?')}}</h3>
        <form action="{{ route('home.store') }}" method="post">
            <div class="row controls">
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="span6 control-group">
                    <input style="width: 96%;" type="text" class="form-control" name="title"  placeholder="{{trans('user.subject_title')}}">
                </div>

            </div>
            <div class="row controls">
                <div class="span6 control-group">

                    <textarea placeholder="{{trans('user.subject')}}" maxlength="5000" rows="7" name="body" class="span6"></textarea>
                </div>
            </div>
            <div class="btn-toolbar">
                <input type="submit" value="test" class="btn btn-primary">
            </div>
        </form>
    </div>