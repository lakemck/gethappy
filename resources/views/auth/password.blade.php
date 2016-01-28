@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="frontpage">

  <div class="row formContainer">




    {!! Form::open(array('class'=>'loginForm')) !!}


  <div class="form-group">
    {!! Form::label('email','EMAIL') !!}
    {!! Form::text('email', $value = null, array('placeholder' => 'EMAIL', 'class'=> 'loginForm')) !!}
      {!! $errors->first('email','<p class="error">:message</p>') !!}  

		</div>


    {!! Form::submit('submit', null, ['class' => 'btn btn-primary']) !!}


    {!! Form::close() !!}


  </div>


     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop