@extends('template')

@section('content')

<section class="container" id="frontpage">
  <div class="row logo">      
      <div class="logoImage">
  
        <img src="img/happyfacesmallblue.png" alt="">  

      </div>

      <div class="logoName">
        
        <h1 class="siteTitle">GET HAPPY</h1>
        <h2>NZ's HAPPY HOUR/DEAL FINDER</h2>

      </div>
  </div>
  <div class="row searchBoxes show">
    
    <form action="" class="searchForm">
      <input type="search" placeholder="LOCATION" class="locationSearch">
      <div id="fakeSelect">
        <span id="fakeSelectText">TYPE</span>
        <div class="arrow"><i class="fa fa-chevron-down"></i></div>
      </div>
      <select name="" id="categories" class="categorySelector hide">

        <option value="food">FOOD</option>
        <option value="drinks">DRINKS</option>
        <option value="entertainment">ENTERTAINMENT</option>

      </select>
      <input type="submit" value="MAKE ME HAPPY" class="happySubmit">

    </form>
  

  </div>


     <!-- Example row of columns -->

</section> <!-- /container -->        

@stop