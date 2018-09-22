@extends('main');


@section('title')

| {{ $tag->name }}
@endsection

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>{{ $tag->name }} Tag <small>{{ $tag->posts()->count()}} Posts</small></h1>
	</div>
	<div class="col-md-2">
		<a href="{{route('tags.edit',$tag->id)}}" class="btn btn-lg btn-primary float-right">Edit</a>
	</div>
	<div class="col-md-2">
		{{Form::open(['route'=>['tags.destroy',$tag->id],'method'=>'DELETE'])}}
		 {!!Form::submit('Delete',['class'=>'btn btn-danger btn-lg'])!!}
		 {{Form::close()}}
		
	</div>

</div>
<div class="row">
	<div class="col-md-12">

		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
					<th></th>
					
				</tr>
				

			</thead>
			<tbody>
				@foreach( $tag->posts as $post)
				<tr>
					<th>{{$post->id}}</th>
					<td> {{$post->title}}</td>
					@foreach($post->tags as $tag)
					<td> 
						<div class="btn-group" role="group" aria-label="Basic example">
             <a href="{{route('tags.show',$tag->id)}}"> <button type="button" class="btn btn-secondary"> {{$tag->name}}</button></a>
  
             </div>
		</td>
		
		@endforeach
		<td>
		   <a href="{{route('posts.show',$post->id)}}" class="btn btn-warning btn-sm"> View</a>
		</td>
					
		</tr>
		



				@endforeach
			</tbody>
			
		</table>
	</div>
</div>

@endsection