@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')

<section class="container" id="showPage">
	<div class="welcome">
		<h1>Welcome</h1>
		<h2>What would you like to do today?</h2>
	</div>
	<div class="editOptions">
		<button type="button" class="btn btn-success">
		  	{!! link_to_route('articleCreate_path', 'CREATE NEW')!!}
		 </button>
	</div>

<?php $articles = $articles->sortBy('title'); ?>

@foreach ($articles as $article)
  <div class="row aboutText col-md-4">
    
  	<h4>{{$article->title}}</h4>
	  <button type="button" class="btn btn-primary">
	  	{!! link_to_route('articleEdit_path', 'EDIT PLACE', [$article->id])!!}
	  </button>
            {!! Form::open(['method' => 'DELETE', 'route' => ['articles.destroy', $article->id]]) !!}
                      <div class="form-group">
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}           	
                      </div>
              {!! Form::close() !!}
  </div>
@endforeach

</section> 

@stop