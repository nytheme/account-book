<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>家計簿</title>

    </head>
    <body>
    @if (Auth::check())
        <h2><a href="accountLists">買い物リストへ</a></h2>
        {!! link_to_route('logout.get', 'Logout') !!}
    @else
        <h2>ログイン</h2>
        {!! Form::open(['route' => 'login.post']) !!}
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Log in', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
        
        <h2>新規グループ登録</h2>
        {!! Form::open(['route' => 'signup.post']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'Confirmation') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    @endif
    </body>
</html>
