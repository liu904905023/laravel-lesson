@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>来了，老1弟！</h1>

            <a class="btn btn-lg btn-primary pull-right" href="{{url('/discussions/create')}}" role="button">发布&raquo;</a>
            </p>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{$discussion->user->avatar}}" class='media-object img-circle' alt="64x64" style="width: 64px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="/discussions/{{$discussion->id}}"> {{$discussion->title}}</a>
                                <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a href="">{{count($discussion->comments)}}</a>
                                        回复
                                    </span>
                                </div>

                            </h4>
                            {{$discussion->user->name}}
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        <div class="pull-right">
            {{$discussions->render()}}
        </div>
    </div>
@stop