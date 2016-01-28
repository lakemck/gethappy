@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="frontpage">

  <div class="row formContainer">




    {!! Form::open(['route' => 'articleStore_path', 'files' => true]) !!}
      
      @include ('articles._form', ['submitButtonText' => 'Add Article'])


    {!! Form::close() !!}


  </div>


     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop