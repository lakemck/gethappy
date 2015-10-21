@extends('template')

@section('content')
<section class="container" id="resultsPage">
    <div class="viewButtons">
      
      <button type="button" class="detailsButton pressed">DETAILS</button>

      <button type="button" class="mapButton">MAP</button>

    </div> 
  <div class="details"> 

  

    <div id="refineSearchButton">
        <span id="fakeSelectText">REFINE SEARCH</span>
        <div class="arrow"><i class="fa fa-chevron-down"></i></div>
    </div> 
      <div class="row searchBoxes">
        
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

    <article class="results">


      <div class="resultImageContainer">
        <div class="resultImage">
          <img src="img/gd.jpg" alt="">
        </div>

        <h2>golden dawn</h2>

        <i class="fa fa-plus-square showMoreDetails"></i>

      </div>

      <div class="daytypeContainer">
        
        <ul id="dayIcons">
          <li><div class="dayCircle"><span>M</span></div></li>
          <li><div class="dayCircle"><span>T</span></div></li>
          <li><div class="dayCircle"><span>W</span></div></li>
          <li><div class="dayCircle"><span>T</span></div></li>
          <li><div class="dayCircle open"><span>F</span></div></li>
          <li><div class="dayCircle open"><span>S</span></div></li>
          <li><div class="dayCircle"><span>S</span></div></li>
        </ul>

        <ul id="categoryIcons">
          <li><i class="fa fa-cutlery"></i></li>
          <li><i class="fa fa-beer"></i></li>

        </ul>

      </div>

      <div class="descriptionTextContainer">
        
        <div class="descriptionText">
        <p>Cheesecake jujubes topping wafer donut tart sweet fruitcake. Dessert carrot cake sugar plum marzipan chocolate cotton candy marzipan danish. Cake jelly apple pie brownie pie ice cream.</p>
        </div>
        <div class="deetsContainer">

           <div class="otherInfoContainer">
            <ul id="otherInfoIcons">
              <li><i class="fa fa-phone"></i><p>022132032</p></li>
              <li><i class="fa fa-envelope-o"></i><p>goldendawn@gmail.com</p></li>
              <li><i class="fa fa-home"></i><a href="http://www.goldendawn.co.nz/p/whats-on.html">goldendawn.com</a></li>
            </ul>

          </div>

          <div class="addressContainer">
            <p class="streetText">43 Ponsonby Rd</p>
            <p class="cityText">AUCKLAND</p>
          </div>

        </div>  

      </div>

      

    </article>

<article class="results">

      <div class="resultImageContainer">
        <div class="resultImage">
          <img src="img/wc.jpg" alt="">
        </div>

        <h2>Wine Cellar</h2>
        <i class="fa fa-plus-square showMoreDetails"></i>
      </div>

      <div class="daytypeContainer">
        
        <ul id="dayIcons">
          <li><div class="dayCircle open"><span>M</span></div></li>
          <li><div class="dayCircle"><span>T</span></div></li>
          <li><div class="dayCircle"><span>W</span></div></li>
          <li><div class="dayCircle"><span>T</span></div></li>
          <li><div class="dayCircle"><span>F</span></div></li>
          <li><div class="dayCircle"><span>S</span></div></li>
          <li><div class="dayCircle"><span>S</span></div></li>
        </ul>

        <ul id="categoryIcons">
          <li><i class="fa fa-cutlery"></i></li>
          <li><i class="fa fa-beer"></i></li>

        </ul>

      </div>

      <div class="descriptionTextContainer">
        
        <div class="descriptionText">
        <p>Cheesecake jujubes topping wafer donut tart sweet fruitcake. Dessert carrot cake sugar plum marzipan chocolate cotton candy marzipan danish. Cake jelly apple pie brownie pie ice cream.</p>
        </div>

        <div class="deetsContainer">

           <div class="otherInfoContainer">
            <ul id="otherInfoIcons">
              <li><i class="fa fa-phone"></i><p>022df132032</p></li>
              <li><i class="fa fa-envelope-o"></i><p>goldendawnsdfs@gmail.com</p></li>
              <li><i class="fa fa-home"></i><a href="http://www.goldendawn.co.nz/p/whats-on.html">goldendawn.com</a></li>
            </ul>

          </div>

          <div class="addressContainer">
            <p class="streetText">143 Karangahape Rd</p>
            <p class="cityText">AUCKLAND</p>
          </div>

        </div>  

      </div>

      

    </article>  


  </div>


     <!-- Example row of columns -->

</section> 

@stop