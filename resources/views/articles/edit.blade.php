@extends('template')
@section('styles')
        <link href="{{URL::to('css/otherstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="frontpage">

  <div class="row formContainer">



    {!! Form::model($article, ['route' => ['articleUpdate_path', $article->id], 'files' => true, 'method' => 'PATCH']) !!}

<div class="form-group">
    {!! Form::label('title','TITLE') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title','<p class="error">:message</p>')!!}
</div>

<div class="form-group">
    {!! Form::label('deal','DEAL') !!}
    {!! Form::text('deal', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('image','PHOTO') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('description','DESCRIPTION') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      
</div>


<div class="form-group">
    {!! Form::label('categoryList','Category') !!}
    {!! Form::select('categoryList[]', $categories, null, ['class' => 'form-control', 'id' => 'categoryList', 'multiple']) !!}
  
</div>

<div class="form-group">
    {!! Form::label('dayList','Day') !!}
    {!! Form::select('dayList[]', $days, null, ['class' => 'form-control', 'id' => 'dayList', 'multiple']) !!}
  
</div>



@foreach ($article->deals as $deal)
         
        @if($deal->dayID == '1')

        <div class="form-group">
            {!! Form::label('dealname','Monday') !!}
            {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '1']) !!}
        </div>
        @endif

        @if($deal->dayID == '2' )
        <div class="form-group">
            {!! Form::label('dealname','Tuesday') !!}
            {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '2']) !!}
        </div>
        @endif
        @if($deal->dayID == '3' )
        <div class="form-group">
            {!! Form::label('dealname','Wednesday') !!}
            {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '3']) !!}
        </div>
        @endif

@if($deal->dayID == '4')
<div class="form-group">
    {!! Form::label('dealname','Thursday') !!}
    {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '4']) !!}
</div>

@endif


@if($deal->dayID == '5' )
<div class="form-group">
    {!! Form::label('dealname','Friday') !!}
    {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '5']) !!}
</div>
@endif

@if($deal->dayID == '6' )
<div class="form-group">
    {!! Form::label('dealname','Saturday') !!}
    {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '6']) !!}
</div>
@endif

@if($deal->dayID == '7' )
<div class="form-group">
    {!! Form::label('dealname','Sunday') !!}
    {!! Form::text('dealname[]', $deal->dealname, null, ['class' => 'form-control', 'id' => '7']) !!}
</div>
@endif

@endforeach

<div class="form-group">
    {!! Form::label('address','ADDRESS') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('phone ','PHONE') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('email','EMAIL') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('website','WEBSITE') !!}
    <p>format: www.thesite.com</p>
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
      
</div>

<div class="form-group">
    {!! Form::label('rating','RATING') !!}
    <p><i class="fa fa-star"></i>3 stars is great deal. 2 stars ok. 1 star is no deal at all.</p>
        {!! Form::select('rating', ['1' => '1', '2' => '2', '3' => '3'], null, ['class' => 'form-control', 'size' => '3']) !!} 
      
</div>


<div class="form-group">

    {!! Form::label('lat ','LAT') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
    {!! $errors->first('lat','<p class="error">:message</p>')!!}
</div>

<div class="form-group">
    {!! Form::label('lon ','LON') !!}
    {!! Form::text('lng', null, ['class' => 'form-control']) !!}
    {!! $errors->first('lng','<p class="error">:message</p>')!!} 
</div>

<div class="form-group">
    
    {!! Form::submit('update article', null, ['class' => 'btn btn-primary']) !!}

</div>


    {!! Form::close() !!}



  </div>
@section ('footer')

<script type="text/javascript">
  $('select').select2();
</script>

@endsection

@include ('errors.list')
 


     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop
