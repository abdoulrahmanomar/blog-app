@extends('main')

@section('title', "| $post->title")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>
			<hr>
			<p>Posted In: {{ $post->category->name }}</p>
		</div>
	</div>
	<div  class="row">
		<div class="col-md-8 offset-md-2">
			@foreach($post->comments as $coment)

		        <div class="auther">
		        	<img src="" class="auth">
		        	<div class="name">
		        		<h4>{{$coment->name}}</h4>
		        		{{$coment->created_at}}
		        	</div>
		        	
		        </div>
		        <div class="comment">
		        	{{$coment->comment}}
		        </div>
              
      
		@endforeach
		</div>
		
	</div>
	<div class="row">
		<div id="commen">
			{!!Form::open(['route' => ['comments.store', $post->id] , 'method' => 'post'])!!}
			  <div class="col-md-6">
			  	{{Form::label('name','Name:')}}
			  	{{Form::text('name',null,['class'=>'form-control'])}}


			  </div>
			  <div class="col-md-6">
			  	{{Form::label('email','Email')}}
			  	{{Form::text('email',null,['class'=>'form-control'])}}

			  </div>
			  <div class="col-md-12">
			  	{{ Form::label('comment',"Comment:") }}
			  	{{Form::textarea('comment',null,['class'=>'form-control'])}}
			  	{{Form::submit('Add Comment',['class'=>'btn btn-success btn-block'])}}

			  </div>


			{{Form::close()}}

		</div>
	</div>

@endsection