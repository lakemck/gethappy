<?php 
<script>
  

function initialize() {

    var map_canvas = document.getElementById('map');

    // Initialise the map
    var map_options = {
        center: location,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(map_canvas, map_options)

    // Put all locations into array
    var locations = [
    @foreach ($articles as $article)
        [ {{ $article->lat }}, {{ $article->lng }} ]     
    @endforeach
    ];

    for (i = 0; i < locations.length; i++) {
        var location = new google.maps.LatLng(locations[i][0], locations[i][1]);

        var marker = new google.maps.Marker({
            position: location,
            map: map,
        }); 
    }

    // marker.setMap(map); // Probably not necessary since you set the map above

}



google.maps.event.addDomListener(window, 'load', initialize);







</script>

 ?>