@extends('app')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)

                            <li class="list-group-item list-group-item-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
                @if(Session::has('user_login_failed'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('user_login_failed')}}
                    </div>
                @endif
                {!! Form::open(['url' =>'/discussions']) !!}

               @include('forum.form')
                {!! Form::submit('发布',['class'=>'btn btn-primary form-control']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@stop