@extends('app')
@section('content')
    <meta id="token" name="token" value="{{csrf_token()}}">
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="">
                        <img src="{{$discussion->user->avatar}}" class='media-object img-circle' alt="64x64" style="width: 64px">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{$discussion->title}}</h4>
                    {{$discussion->user->name}}
                </div>

            </div>

            @if(\Auth::user()->id==$discussion->user_id&&Auth::check())
            <a class="btn btn-lg btn-primary pull-right" href="/discussions/{{$discussion->id}}/edit" role="button">修改&raquo;</a>
            @endif
        </div>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                <div class="blog-post">
                    {!! Parsedown::instance()->setMarkupEscaped(true)->text($discussion->body) !!}
                </div>
                <hr>
                <div class="media" v-for="comment in comments">
                    <div class="media-left">
                        <a href="">
                            <img v-bind:src="comment.avatar" class='media-object img-circle' alt="64x64" style="width: 64px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"> @{{comment.name}}</h4>
                        @{{comment.body}}
                    </div>

                </div>
                @foreach($comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{$comment->user->avatar}}" class='media-object img-circle' alt="64x64" style="width: 64px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"> {{$comment->user->name}}</h4>
                            {{$comment->body}}
                        </div>

                    </div>
                    @endforeach
                <div class="pull-right">
                    {!! $comments->links()!!}
                </div>
                <hr>
                {!! Form::open(['url' =>'/comment','v-on:submit'=>'onSubmitForm']) !!}
                {!! Form::hidden('discussion',$discussion->id) !!}

                <div class="form-group">
                    {!! Form::textarea('body',null,['class'=>'form-control','v-model'=>'newComment.body']) !!}
                </div>
                {!! Form::submit('发表评论',['class'=>'btn btn-primary form-control']) !!}

                {!! Form::close() !!}
            </div>
        </div>

    </div>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        new Vue({
            el: '#post',
            data: {
                comments: [],
                newComment:{
                    name:'{{Auth::user()->name}}',
                    avatar:'{{Auth::user()->avatar}}',
                    body:''
                },
                newPost:{
                    discussion :'{{$discussion->id}}',
                    user_id:'{{Auth::user()->id}}',
                    body:''
                }
            },
            methods:{
                onSubmitForm:function (e) {
                    e.preventDefault();
                    var comment = this.newComment;
                    var post = this.newPost;
                    post.body=comment.body;
                    this.$http.post('/comment',post).then(function () {
                        this.comments.push(comment);

                        console.log((comment.avatar));

                    });

                    this.newComment={
                        name:'{{Auth::user()->name}}',
                        avatar:'{{Auth::user()->avatar}}',
                        body:''
                    }
                }
            }
        });
    </script>

@stop