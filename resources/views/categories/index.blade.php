@extends('main')

@section('title')
 | All Categories
@endsection

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>Categories</h1>
		<table class="table">
           <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">name</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($cat as $c)
			    <tr>
			      
			      <td>{{ $c->id}}</td>
			      <td> {{$c->name}}</td>
			    </tr>
			    @endforeach
			   
			  </tbody>
           </table>

	</div><!-- end of column -md-8 -->
	<div class="col-md-3">
		<div class="card">
			{!! Form::open(['route'=> 'categories.store', 'method'=> 'post'])!!}
			   <h2>New Category</h2>
			   {{ Form::label('name','Name:')}}
			   {{Form::text('name',null,['class'=> 'form-control'])}}
			   <hr>
			   {{Form::submit('Create Category',['class'=> 'btn btn-primary btn-block'])}}

			{!! Form::close()!!}
		</div>
	</div>
</div>

@endsection