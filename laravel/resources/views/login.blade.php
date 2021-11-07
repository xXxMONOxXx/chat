@extends('common.default')
@section('content')
    <center>
        <h2>{{$chat_stat['bro']}} Bro!</h2>
        <h2>{{$chat_stat['sis']}} Sis!</h2>
        <form style="width: 300px; height: 50em;" size="20" class="form" action="/sign-in" method="post" autocompete="off">
            <h1>Sign In</h1>
            <div class="form-row mb-2">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                @if($errors->first('email'))
                    <p class="text-danger">{{$errors->first('email')}}</p>
                @endif
            </div>
            <div class="form-row mb-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                @if($errors->first('password'))
                    <p class="text-danger">{{$errors->first('password')}}</p>
                @endif
            </div>
            <div class="form-row mb-2">
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <div class="form-row">
                <a href="/sign-in/github" class="btn btn-secondary btn-block">Sign in with GitHub</a>
                <a href="/sign-in/facebook" class="btn btn-primary btn-block">Sign in with Facebook</a>
            </div>
        </form>
    </center>
@endsection
