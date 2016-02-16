@extends('template')

@section('content')

<section class="container" id="aboutPage">
  <div class="row logo">      
      <div class="mainLogoImage">
  
        <a href="{{URL::to('/')}}"><img src="{{URL::to('images/happyfacesmall.png')}}" alt=""></a>  

      </div>

      <div class="aboutLogoName">    
        <h1 class="aboutTitle">GET HAPPY</h1>
        <h2 class="aboutSlogan">NZ's HAPPY HOUR/DEAL FINDER</h2>
      </div>
  </div>
  <div class="row aboutText col-md-4">
    <h3></h3>
    <p>Get Happy is a deal finder based in NZ. The site is currently loaded only with deals, discounts and things to do in Wellington & Auckland. We administer the site ourselves and do our best to make sure the deals are current. Unfortunately establishments change their offers regularly so there may be errors on our site. We take no responsibility for out of date deals and encourage consumers to contact the establishment to confirm deals beforehand. We also take no responsibility for the content and legality of any of the deals advertised on this site. We just share what is already publicly available.</p>
    <p>Should you have any deals, please send us an email at <span>gethappynz@gmail.com</span></p>
  </div>


     <!-- Example row of columns -->

</section> <!-- /container -->        
@stop

