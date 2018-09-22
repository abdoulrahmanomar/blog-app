@extends('main')

@section('title')
| Edit Comment
@endsection

@section('content')

<h3> Edit Comment </h3>
{{Form::model($comment,['route'=>['comments.update', $comment->id],'method' => 'PUT'])}}
 {{ Form::label('name','Name:') }}
 {{ Form::text('name',null,['class'=>'form-control','disabled'=>'']) }}

 {{Form::label('email','Email:')}}
 {{ Form::text('email',null,['class'=>'form-control','disabled'=>'']) }}

 {{Form::label('comment','Comment:')}}
 {{Form::textarea('comment',null,['class'=>'form-control'])}}

 {{Form::submit('Update', ['class'=>'btn btn-block btn-success'])}}



{{Form::close()}}

@endsection