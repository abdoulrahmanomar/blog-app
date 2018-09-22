@extends('main')

@section('title', '| Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'textarea' });</script>

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>

			{!! Form::open(array('route' => 'posts.store', 'data-parsley-validate' => '','method'=>'POST','files' => true)) !!}
				{{ Form::label('title', 'Title:') }}
				{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' => '255') ) }}

				{{Form::label('category_id','Category:')}}
				
				<select class="form-control" name="category_id">
					@foreach($cat as $c)
					   <option value="{{ $c->id }}">{{ $c->name }}</option>
					@endforeach
				</select>
				{{Form::label('tags','Tag:')}}
				
				<select class="form-control select2-multi" name="tags[]" multiple="multiple">
					@foreach($tags as $t)
					   <option value="{{ $t->id }}">{{ $t->name }}</option>
					@endforeach
				</select>
				{{Form::label('image','Upload Featured Image:')}}
				{{ Form::file('image',['class'=>'image']) }}

				{{ Form::label('body', "Post Body:") }}
				{{ Form::textarea('body', null, array('class' => 'form-control')) }}

				{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection


@section('scripts')

	
	{!! Html::script('js/select2.min.js') !!}
	<script>
		$(document).ready(function() {
        $('.select2-multi').select2();

        });
		
	</script>
	


@endsection
