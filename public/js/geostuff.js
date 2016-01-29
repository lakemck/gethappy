$('.hiddenFields').hide();
$(".hiddenFields").removeAttr('id');
var input = document.getElementById('searchInput');
var options = {
    types: [],
    componentRestrictions: {country: 'nz'}
};

var autocomplete = new google.maps.places.Autocomplete(input, options);

// GEOCODE

$('#submitButton').on('click', function(event){
    event.preventDefault();

 if ($('#searchInput').hasClass('geo')){
            // $('#lat').val(lat);
            // $('#lng').val(lng);
          $('#searchForm').submit();

 } 

else if(!$('#searchInput').val()){

    $('#searchForm').submit();

 }

 else{

    var address = $('#searchInput').val();
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var lat = results[0].geometry.location.lat();
             var lng = results[0].geometry.location.lng();
            $('#lat').val(lat);
            $('#lng').val(lng);
          $('#searchForm').submit();

        } 
        else {
            $( ".searchFormErrors" ).show('fast').delay(2000).slideUp(300);
        } 
    });

 };  

});

// Hide geolocation button if address is filled out

$('#searchInput').change(function ()
{
    $('#geolocationButton').slideToggle( "fast" );
    $('.hiddenFields').slideToggle("fast");

});

// USE USERS LOCATION

$('#geolocationButton').on('click', function(event){
    $('#searchInput').toggleClass('geo');
    $('#searchInput').slideToggle( "fast" );
    $('.hiddenFields').slideToggle("fast");
  var startPos;
  var geoSuccess = function(position) {
    startPos = position;
    var lat = startPos.coords.latitude;
    $('#lat').val(lat);
    var lng =startPos.coords.longitude;
    $('#lng').val(lng);
    // document.getElementById('lat').innerHTML = startPos.coords.latitude;
    // document.getElementById('lng').innerHTML = startPos.coords.longitude;
  };
  var geoError = function(error) {
    console.log('Error occurred. Error code: ' + error.code);
    // error.code can be:
    //   0: unknown error
    //   1: permission denied
    //   2: position unavailable (error response from location provider)
    //   3: timed out
  };
  navigator.geolocation.getCurrentPosition(geoSuccess, geoError);
});

$('.noResultsFlash').delay(2000).slideUp(300);
