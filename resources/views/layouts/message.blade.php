@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@else (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif