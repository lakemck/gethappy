@extends('template')
@section('styles')
        <link href="{{URL::to('css/resultsstyles.css')}}" rel="stylesheet" media="screen, projection">
@stop
@section('content')
<section class="container" id="resultsPage">
    <div class="viewButtons">
      
      <button type="button" class="detailsButton pressed">DETAILS</button>

      <button type="button" class="mapButton">MAP</button>

    </div> 
 <div class="details"> 
    <div id="refineSearchButton">
        <span id="fakeSelectText"><span class="resultsCounter"><span class="resultsNumber">{{$articles->count()}}</span> results</span> REFINE SEARCH</span>
        <div class="refineArrow"><i class="fa fa-chevron-down"></i></div>
    </div> 

  <div class="row searchBoxes totesHidden">

    {!! Form::model($formdata, ['method' => 'GET', 'id' => 'searchForm', 'name' => 'searchForm', 'route' => 'articles_path']) !!}

      {!! Form::input('search', 'q', null, ['placeholder' => 'LOCATION', 'class' => 'locationSearch', 'id' => 'searchInput'])!!}
      <div class="searchFormErrors" style="display: none">Enter Address</div>
    {!! $errors->first('search','<p class="error">:message</p>')!!}

      {!! Form::hidden('lat', null, ['id' => 'lat'])!!}
      {!! Form::hidden('lng', null, ['id' => 'lng'])!!}

      {!! Form::select('categoryList[]', $categories, null, ['class' => 'categorySelector', 'id' => 'categoryList2', 'multiple']) !!}
    {!! $errors->first('category','<p class="error">:message</p>')!!}
        {!! Form::select('dayList[]', $days, null, ['class' => 'distanceSelector', 'id' => 'dayList2', 'multiple']) !!}
      {!! $errors->first('day','<p class="error">:message</p>')!!}
      
    {!! Form::submit('MAKE ME HAPPY', array('id' => 'submitButton', 'class' => 'refineSearchSubmit')) !!}
  
    {!! Form::close() !!}

  </div>
    <div id="showSortButton">
        <span id="fakeSelectText">SORT BY</span>
        <div class="refineArrow"><i class="fa fa-sort"></i></div>
    </div> 
    <div class="button-group sort-by-button-group row sortButtons totesHidden">
      
<!-- MIX IT UP -->
      <button class="sort sortDistance" data-sort="distance:asc"><i class="fa fa-location-arrow"></i> Distance</button>
      <button class="sort sortRating" data-sort="rating:desc"><i class="fa fa-star"></i> Rating</button>
    </div>
    
    <div class="results" id="sortContainer">
        @if ($articles->count())
        <?php
        // set the default timezone to use. 
        date_default_timezone_set('Pacific/Auckland');
        // Prints something like: Monday
        $today = date("l");
        $articles = $articles->sortBy('distance');
        ?>
        @foreach ($articles as $article)
          <article class="barContainer mix category-<?php echo $article->id; ?>" data-rating="<?php echo $article->rating; ?>" data-distance="<?php echo $article->distance; ?>">
             <div class="resultImageContainer">
                <div class="resultImage">
        @if ($article->image != '')          
                {!! HTML::image('images/'.$article->image, $article->image) !!}  
        @else 
                <img src="{{URL::to('images/gd.jpg')}}" alt="">  
        @endif
                </div>
        <?php $kms = round($article->distance, 1, PHP_ROUND_HALF_UP); ?>    
        <!-- CREATE AN ARRAY OF IDS THEN GET THE INDEX/KEY OF THIS PARTICULAR ARTICLE ID -->
              <?php $something = $articles->lists('id'); 
                    $artID = $article->id;  
                    $key= $something->search($artID); ?>
                    
               <div class="resultsTitle showMoreDetails" onclick="myClick(<?php echo $key; ?>);">
                  <h2>{{$article->title}}</h2>
                  <!--<h4 class="distance">km</h4> -->
               </div> 
        
                <div class="showMoreDetails" onclick="myClick(<?php echo $key; ?>);"><i class="fa fa-plus-square"></i><i class="fa fa-minus-square"></i></div>
                </h2><h4 class="distanceRight"><?php echo $kms ?> km</h4> 
              </div>
              <div class="dealText">
                      @if ($article->deal != "" ) 
                        @if($article->rating == '1')
                          <p><i class='fa fa-star'></i></p>
                          @elseif($article->rating == '2')
                          <p><i class='fa fa-star'></i><i class='fa fa-star'></i></p>
                          @elseif($article->rating == '3')
                          <p><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></p>
                        @endif
                        <p>{{$article->deal}}</p>
                      @else
                        <p>No deals atm</p>
                      @endif  
              </div>
              <div class="daytypeContainer">

                <ul id="dayIcons">
                  @foreach ($article->days as $day)
                      @if($day->dayname == 'Monday')
                        <li><div class="dayCircle open"><p>M</p></div></li>
                          @elseif ($day->dayname  == 'Tuesday')
                        <li><div class="dayCircle open"><p>Tu</p></div></li>
                         @elseif ($day->dayname  == 'Wednesday')
                        <li><div class="dayCircle open"><p>W</p></div></li>
                         @elseif ($day->dayname  == 'Thursday')
                        <li><div class="dayCircle open"><p>Th</p></div></li>
                         @elseif ($day->dayname  == 'Friday')
                        <li><div class="dayCircle open"><p>F</p></div></li>
                        @elseif ($day->dayname  == 'Saturday')
                        <li><div class="dayCircle open"><p>Sa</p></div></li>
                        @elseif ($day->dayname  == 'Sunday')
                        <li><div class="dayCircle open"><p>Su</p></div></li>
                      @endif
                  @endforeach 
                </ul>
        
                <ul id="categoryIcons">
                  @foreach ($article->categories as $category)
                    @if($category->name == 'Drinks')
                    <li><i class="fa fa-glass"></i></li>
                    @elseif ($category->name == 'Food')
                    <li><i class="fa fa-cutlery"></i></li>
                    @elseif ($category->name == 'Entertainment')
                    <li><i class="fa fa-film"></i></li>
                    @endif
                  @endforeach
                </ul>
        
              </div>
        
              <div class="descriptionTextContainer">
                
                <div class="descriptionText">
                    <div class="descriptionTextWys">    
                  {!! $article->description !!}
                  </div>
              @if(Auth::check())
                <p>{!! link_to_route('articleEdit_path', 'EDIT PLACE', [$article->id])!!}</p>
              @endif
                  <div class="deetsContainer">
                     <div class="otherInfoContainer">
                      <ul class="otherInfoIcons">
                        <li><i class="fa fa-smile-o"></i><p>{{$article->address}}</p></li>
                        @if($article->phone != "")
                        <li><i class="fa fa-phone"></i><p>{{$article->phone}}</p></li>
                        @endif
                        @if($article->email != "")
                        <li><i class="fa fa-envelope-o"></i><p>{{$article->email}}</p></li>
                        @endif
                        @if($article->website != "")
                        <li><i class="fa fa-home"></i><a href="http://{{$article->website}}" target="blank" class="websiteLink">{{$article->website}}</a></li>
                        @endif
        
        <!-- GET DEST COORDINATES FOR GOOGLE DIRECTIONS -->
            <?php $googDestLat = $article->lat;
                  $googDestLng = $article->lng;
             ?> 
                        <li><a href="http://maps.google.com/maps?saddr=<?php echo $googDestLat.','.$googDestLng; ?>&daddr=<?php echo $startLat.','.$startLng; ?>" target='blank' class="getDirectionsLink">GET DIRECTIONS</a></li>
                      </ul>
                    </div>
        
                  </div>  
                </div>
        
              </div>
          </article>
        @endforeach

        @else

          <p>no search results</p>

        @endif
    </div>
 </div>

  <div class="mapContainer">
    
    <div id="map_canvas"></div>

  </div>

</section> 


@stop
@section('footer')
<script type="text/javascript" src="{{ URL::asset('js/geostuff.js') }}"></script>
<script>


var locations = [
    @foreach($articles as $article)
    [{{$article->lat}}, {{$article->lng}}],
    @endforeach
    ];

var barTitle = [
        @foreach($articles as $article)
        "{{$article->title}}" ,
        @endforeach
        ];
var barDeal = [
        @foreach($articles as $article)
              @if ($article->deal != "" )  
                "{{$article->deal}}" ,
              @else
                "No Deals ATM" ,
              @endif
        @endforeach
        ];
var barDistance = [
        @foreach($articles as $article)
        <?php $infoKms = round($article->distance, 1, PHP_ROUND_HALF_UP); ?>
        "<?php echo $infoKms; ?>" ,
        @endforeach
        ];    

var infoWindowContent = [];
var markers = [];
var destLocations = [];
var i, marker;


// var origins = startPoint;
// var destination = endPoint;

  // var query = {
  //   origins: startPoint,
  //   destinations: endPoint,
  //   travelMode: google.maps.TravelMode.WALKING,
  //   unitSystem: google.maps.UnitSystem.IMPERIAL
  // };

  // var map, dms;
  // var dirService, dirRenderer;
  // var highlightedCell;
  // var routeQuery;
  // var bounds;
  // var panning = false;




function initialize() {
 
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map_canvas = document.getElementById('map_canvas');

    var myLatlng = new google.maps.LatLng(parseFloat({{ $startLat }}),parseFloat({{ $startLng }}));

    var map_options = {
        // center: myLatlng,
        zoom: 15,
        zoomControl: true,
        zoomControlOptions: {
        position: google.maps.ControlPosition.BOTTOM_RIGHT
        },
        scaleControl: true,
        panControl: true,   
        panControlOptions:{
        position: google.maps.ControlPosition.BOTTOM_LEFT

        },
        mapTypeControl: false,   
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(map_canvas, map_options);



    var barID = [
    @foreach($articles as $article)
    {{$article->id}},
    @endforeach
    ];


 // DISTANCE STUFF
 // NEED THIS ID TO MATCH THE ID OF THE ARTICLE THAT IS CLICKED

$(".getOriginForm").submit(function(event) { 
          event.preventDefault();
      var destLat = $(this).parent().find('.lat').val();
      var destLng = $(this).parent().find('.lng').val();

var startLat = <?php echo $startLat; ?>;
var startLng = <?php echo $startLng; ?>;
// var destLat = document.getElementById('lat');
// var destLng = document.getElementById('lng');
var startPoint = new google.maps.LatLng(parseFloat(startLat),parseFloat(startLng));
var endPoint = new google.maps.LatLng(parseFloat(destLat),parseFloat(destLng));



    directionsDisplay.setMap(map);

    var printRoute = function () {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    };


function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: startPoint,
        destination: endPoint,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

    });






// END DISTANCE STUFF

for (i = 0; i < locations.length; i++) {
    infoWindowContent[i] = getInfoWindowDetails(locations[i]);
    var location = new google.maps.LatLng(locations[i][0], locations[i][1]);

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        id: barID[i],
        icon: 'images/happymarker.png'
    });

  // var infowindow = new google.maps.InfoWindow()
  var infoBubble = new InfoBubble({
      map: map,
      // content: '<div style="overflow: hidden;"><div>',
      // position: new google.maps.LatLng(-32.0, 149.0),
      // minWidth: 200,
      minHeight: 150,
      shadowStyle: 1,
      padding: 0,
      backgroundColor: '#3398DA',
      borderRadius: 5,
      arrowSize: 12,
      borderWidth: 2,
      borderColor: '#F1C40F',
      disableAutoPan: true,
      hideCloseButton: true,
      arrowPosition: 30,
      backgroundClassName: 'transparent',
      arrowStyle: 2
    });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infoBubble.setContent(infoWindowContent[i]);
          infoBubble.open(map, marker);
          map.panTo(marker.getPosition());
          map.setZoom(17);
        }
      })(marker, i));

      markers.push(marker);
}

// SET MINIMUM ZOOM LEVEL.
  google.maps.event.addListener(map, 'zoom_changed', function() {
      zoomChangeBoundsListener = 
          google.maps.event.addListener(map, 'bounds_changed', function(event) {
              if (this.getZoom() > 15 && this.initialZoom == true) {
                  // Change max/min zoom here
                  this.setZoom(16);
                  this.initialZoom = false;
              }
          google.maps.event.removeListener(zoomChangeBoundsListener);
      });
  });
  map.initialZoom = true;


// FIT BOUNDS BY MARKERS.

fitBounds();
    
function fitBounds() {
    var bounds = calculateBounds();
    if (bounds != undefined) {
        map.fitBounds(bounds);
    }
}
function calculateBounds() {
    var allMarkers =  markers;
    if (allMarkers.length > 0) {
        var bounds = new google.maps.LatLngBounds();
        for (i = 0; i < allMarkers.length; i++) {
            bounds.extend(allMarkers[i].getPosition());
        }
    }
    return bounds;
}


}

function getInfoWindowDetails(location){
        var contentString = '<div id="infoWindowBox">' +
                            '<h3 id="firstHeading" class="infoWindowTitle">' + barTitle[i] + '</h3>'+
                                '<div class="infoDeal">'+ barDeal[i] + '</div>'+
                                '<div class="infoDistance">'+ barDistance[i] + 'km' + '</div>'+
                                '<div class="directionsLinkMap"><a href="http://maps.google.com/maps?saddr=<?php echo $googDestLat.','.$googDestLng; ?>&daddr=<?php echo $startLat.','.$startLng; ?>" target="blank" class="getDirectionsLink">'+"GO"+'<i class="fa fa-location-arrow"></i></a></div>'+
                              '</div>';
        return contentString;
    }

  

 google.maps.event.addDomListener(window, "load", initialize);

// SHOW MORE INFO BUTTON TRIGGERS INFOWINDOW/MARKER
        function myClick(id){
            google.maps.event.trigger(markers[id], 'click');
        }  

  $('#categoryList2').select2({
    placeholder: "CATEGORY",
  minimumResultsForSearch: Infinity,
  formatSelectionCssClass: function (data, container) { return "myCssClass"; },

  });
  $('#dayList2').select2({
    placeholder: "DAY",
    minimumResultsForSearch: Infinity,
  formatSelectionCssClass: function (data, container) { return "myCssClass"; },
  });

</script>
@stop
