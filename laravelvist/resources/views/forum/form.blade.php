@include('editor::head')
<div class="form-group">
    {!! Form::label('title','Title:') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <div class="editor">
        {!! Form::label('body','内容:') !!}
        {!! Form::textarea('body',null,['class'=>'form-control','id'=>'myEditor']) !!}
    </div>
</div>