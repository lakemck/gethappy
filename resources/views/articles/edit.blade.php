@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="frontpage">

  <div class="row formContainer">



    {!! Form::model($article, ['route' => ['articleUpdate_path', $article->id], 'files' => true, 'method' => 'PATCH']) !!}

      @include ('articles._form', ['submitButtonText' => 'Update Article'])

    {!! Form::close() !!}



  </div>


     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop