@extends('main')

@section('title')
 | All Categories
@endsection

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>Tags</h1>
		<table class="table">
           <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Name</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($tags as $t)
			    <tr>
			      
			      <td>{{ $t->id}}</td>
			      <td> <a href="{{route('tags.show',$t->id)}}">{{$t->name}}</a></td>
			    </tr>
			    @endforeach
			   
			  </tbody>
           </table>

	</div><!-- end of column -md-8 -->
	<div class="col-md-3">
		<div class="card">
			{!! Form::open(['route'=> 'tags.store', 'method'=> 'post'])!!}
			   <h2>New Tag</h2>
			   {{ Form::label('name','Name:')}}
			   {{Form::text('name',null,['class'=> 'form-control'])}}
			   <hr>
			   {{Form::submit('Create Tag',['class'=> 'btn btn-primary btn-block'])}}

			{!! Form::close()!!}
		</div>
	</div>
</div>

@endsection