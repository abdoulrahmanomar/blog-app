@extends('main')

@section('title')

|Edit Tag
@endsection

@section('content')

{{Form::model($tag, ['route'=>['tags.update', $tag->id],'method'=>'put'])}}
{{Form::label('name','Tag:')}}
{{Form::text('name',null,['class'=>'form-control'])}}

{{Form::submit('save Changes' , ['class'=>'btn btn-primary'])}}

{{Form::close()}}

@endsection