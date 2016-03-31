@extends('template')

@section('content')
<div class="FlexContainerWrapper">
<div class="container" id="frontpage">
  <div class="row logo">      
      <div class="mainLogoImage">
  
        <img src="{{URL::to('images/happyfacesmallblue.jpg')}}" alt="Happy Hour Auckland">  

      </div>

      <div class="logoName">    
        <h1 class="siteTitle">GET HAPPY</h1>
        <h2>NZ's HAPPY HOUR/DEAL FINDER</h2>
        <!--<h2>UNDER MAINTENANCE BACK TOMORROW</h2>-->
      </div>
    @if (Session::has('flash_message'))
      <div class="noResultsFlash">{{ Session::get('flash_message')}}</div>
    @endif
  </div>
  
  <div class="row searchBoxes show">

    {!! Form::open(['method' => 'GET', 'id' => 'searchForm', 'name' => 'searchForm', 'route' => 'articles_path']) !!}

      {!! Form::input('search', 'q', null, ['placeholder' => 'ENTER A LOCATION', 'class' => 'locationSearch', 'id' => 'searchInput'])!!}
      <div class="searchFormErrors" style="display: none">Enter Address</div>
    {!! $errors->first('search','<p class="error">:message</p>')!!}

      {!! Form::hidden('lat', null, ['id' => 'lat'])!!}
      {!! Form::hidden('lng', null, ['id' => 'lng'])!!}

      <div id="geolocationButton" class="geolocationSearch"><span>or</span> Use My Location <i class="fa fa-location-arrow"></i></div>

      <div class="hiddenFields totesHidden">
        {!! Form::select('categoryList[]', $categories, null, ['placeholder' => 'TYPE', 'class' => 'categorySelector', 'id' => 'categoryList', 'multiple']) !!}
      {!! $errors->first('category','<p class="error">:message</p>')!!}
        {!! Form::select('dayList[]', $days, null, ['class' => 'distanceSelector', 'id' => 'dayList', 'multiple']) !!}
      {!! $errors->first('day','<p class="error">:message</p>')!!}

      {!! Form::submit('MAKE ME HAPPY', array('id' => 'submitButton', 'class' => 'searchSubmit')) !!}
    
      {!! Form::close() !!}
    </div>
  </div>
  <div class="row developmentMode">
    <p>*Just Auckland & Wellington atm</h4>
  </div>


     <!-- Example row of columns -->

</div> <!-- /container -->    
</div>
@stop
@section('footer')

<script type="text/javascript">

$('#categoryList').select2({
        minimumResultsForSearch: -1,
        // dropdownCssClass : 'no-search',
        placeholder: "CATEGORY"

      });
  $('#dayList').select2({
    minimumResultsForSearch: -1,
    placeholder: "DAY"

  });

</script> 

<script type="text/javascript" src="{{ URL::asset('js/geostuff.js') }}"></script>

@stop

