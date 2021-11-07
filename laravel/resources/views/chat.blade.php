@extends('layouts.app')
@section('content')
    <title>{{config('app.name', 'Chat')}}</title>
    <div class="card-text card-body card-header">
        @if(count($data['messages'])>0)
            @foreach($data['messages'] as $message)
                <a href="">{{$message->user_name}} Pushed the button '{{$message->message}}'</a>
                <br>
                <sup>
                    <h10 style="color: gray">Pushed at {{$message->created_at}}</h10>
                </sup>
                <br>
            @endforeach
        @endif
    </div>
    <br>
    <center>
        @if($data['stat']['sis']!=null)
            <sup>Last time pushed button by {{$data['stat']['sis']->user_name}}
                at {{$data['stat']['sis']->created_at}}</sup>
        @endif
        {!! Form::open (['action'=>'MessageController@store', 'method'=>'MESSAGE'])!!}
        {{Form::hidden('user_name', Auth::user()->name, ['class'=>'form-control', 'placeholder'=>'Body'])}}
        {{Form::hidden('message', 'Sis!', ['class'=>'form-control', 'placeholder'=>'Body'])}}
        {{Form::submit('Sis!', ['class'=>'btn btn-primary btn-block'])}}
        {!! Form::close() !!}
        <br>
        @if($data['stat']['bro']!=null)
            <sup>Last time pushed button by {{$data['stat']['bro']->user_name}}
                at {{$data['stat']['bro']->created_at}}</sup>
        @endif
        {!! Form::open (['action'=>'MessageController@store', 'method'=>'MESSAGE'])!!}
        {{Form::hidden('user_name', Auth::user()->name, ['class'=>'form-control', 'placeholder'=>'Body'])}}
        {{Form::hidden('message', 'Bro!', ['class'=>'form-control', 'placeholder'=>'Body'])}}
        {{Form::submit('Bro!', ['class'=>'btn btn-primary btn-block'])}}
        {!! Form::close() !!}
    </center>
    <br>
    <button onclick="topFunction()" class="btn btn-secondary btn-block" id="toTheTop" title="Go to top">Top</button>
    <script>
        window.scrollTo(0, document.body.scrollHeight);

        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>

@endsection
