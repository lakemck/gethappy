@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="frontpage">
@if(Auth::check())
  <div class="row formContainer">




    {!! Form::open(array('class'=>'loginForm')) !!}
        
        <div class="form-group">
    {!! Form::label('name','NAME') !!}
    {!! Form::text('name', $value = null, array('placeholder' => 'NAME', 'class'=> 'loginForm')) !!}
      {!! $errors->first('name','<p class="error">:message</p>') !!}  

		</div>

        <div class="form-group">
    {!! Form::label('email','EMAIL') !!}
    {!! Form::text('email', $value = null, array('placeholder' => 'EMAIL', 'class'=> 'loginForm')) !!}
      {!! $errors->first('email','<p class="error">:message</p>') !!}  

		</div>

        <div class="form-group">
    {!! Form::label('password','PASSWORD') !!}
    {!! Form::password('password', array('placeholder' => 'PASSWORD', 'class' => 'loginForm')) !!}
                  {!! $errors->first('password','<p class="error">:message</p>') !!}  
		</div>
        <div class="form-group">

    {!! Form::label('password_confirmation','Confirmed password') !!}
    {!! Form::password('password_confirmation') !!}
                  {!! $errors->first('password_confirmation','<p class="error">:message</p>') !!}  
		</div>

    {!! Form::submit('submit', null, ['class' => 'btn btn-primary']) !!}


    {!! Form::close() !!}


  </div>
@else
  <div class="row formContainer">
    You can't register
  </div>
@endif
     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop