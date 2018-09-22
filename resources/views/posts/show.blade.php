@extends('main')

@section('title', '| View Post')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			
			<p class="lead">{!! $post->body !!}</p>
			<hr>
		<div class="tags"> 
			@foreach($post->tags as $tag)
			<div class="btn-group" role="group" aria-label="Basic example">
             <a href="{{route('tags.show',$tag->id)}}"> <button type="button" class="btn btn-secondary"> {{$tag->name}}</button></a>
  
             </div>

			@endforeach
		</div>
		<div id="comment">
			<h3>Comments <small>{{$post->Comments()->count()}} Total Comments</small></h3>
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Comment</th>
						<th></th>
					</tr>
					

				</thead>
				<tbody>
					@foreach($post->Comments as $comment )
					<tr>
						<td>{{$comment->name}}</td>
						<td>{{ $comment->email}}</td>
						<td>{{ $comment->comment}}</td>
						<td> 
						{!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-sm']) !!}{!! Form::close() !!}
						</td>
						<td><a href="{{ route('comments.edit', $comment->id)}}" class="btn btn-sm btn-secondary">Edit</a></td>
						
					</tr>
					@endforeach
				</tbody>
				
			</table>
		</div>
	</div>

		<div class="col-md-12">
			<div class="card">
				<dl class="dl-horizontal">
					<label>Url:</label>
					<p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p>
				</dl>
					<dl class="dl-horizontal">
					<label>Category:</label>
					<p>{{ $post->Category->name }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Created At:</label>
					<p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Last Updated:</label>
					<p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						{{ Html::linkRoute('posts.index', '<< See All Posts', array(), ['class' => 'btn btn-secondary btn-block btn-h1-spacing']) }}
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection