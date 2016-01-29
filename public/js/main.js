$(function(){

	$('#sortContainer').mixItUp();

});

$(function(){

    $('.categorySelector, .distanceSelector').hide();
        
    $('#fakeSelect, #fakeSelect3').on('click touch', function(){

        $('.categorySelector').slideToggle( "fast" );

    });

    $('#fakeSelect2, #fakeSelect4').on('click touch', function(){

        $('.distanceSelector').slideToggle( "fast" );

    });

    $('.select2-selection--multiple').eq(1).addClass('daySelect');
    $('.select2-selection--multiple').eq(0).addClass('catSelect');

});


$(function hamburger(){
    // When the hamburger is clicked
    $('.hamburger').on('click touch', function(){

        $('.homeMenu').toggleClass('show');

    });


});


$(function(){

    $('.detailsButton').on('click touch', function(){

        $('.mapContainer').css('left','0');
           if($(this).hasClass('pressed')){

                $('.mapButton').removeClass('pressed');

            }else{

            	$(this).addClass('pressed');
            	$('.mapButton').removeClass('pressed');


            $(this).parent().siblings(".details").show("slide", 100, "linear");
            };


    });

     $('.mapButton').on('click touch', function(){
            $('.mapContainer').css('left','0');
       if($(this).hasClass('pressed')){

            $('.detailsButton').removeClass('pressed');


        }else{

        	$(this).addClass('pressed');
        	$('.detailsButton').removeClass('pressed');


        };

        $(this).parent().siblings(".details").hide("slide", 100, "linear");
        // $(this).parent().siblings(".mapContainer").show("slide", 100, "linear");

    });

    $('.searchBoxes').hide();     

      $('#refineSearchButton').on('click touch', function(){

        $('.searchBoxes').slideToggle( "fast" );
        
        if(!$('#searchInput').val()){

            $('#searchInput').hide();

         }

    });

    $('.sortButtons').hide();     

      $('#showSortButton').on('click touch', function(){

        $('.sortButtons').slideToggle( "fast" );

    });

});



$(function(){
$(".descriptionText, .fa-minus-square").hide();
 $('.showMoreDetails').on('click touch', function(){
    // CLOSES ALL OTHER DESCRIPTIONS/IMAGES APART FROM ONE CLICKED 
    $(".descriptionText").not($(this).parent()
            .nextAll(".descriptionTextContainer")
            .first()
            .children('.descriptionText'))
            .slideUp(250);
    $(".resultImageContainer").not($(this).parent(".resultImageContainer")).removeClass("justTitle", 100, "linear");        
    
// SWAPS PLUS AND MINUS IMAGES
    $(".showMoreDetails").not(this).find("i.fa-minus-square").hide();
    $(".showMoreDetails").not(this).find("i.fa-plus-square").show();
    $(this).find(".fa-minus-square, .fa-plus-square").toggle();

        $(this).parent()
            .nextAll(".descriptionTextContainer")
            .first()
            .children('.descriptionText')
            .slideToggle(250);

        $(this).parent(".resultImageContainer").toggleClass("justTitle", 100, "linear");


});


});

// NEED TO FIX SO SHOW BUTTON STILL WORKS

$(function(){

    $('.sortDistance').on('click touch', function(){

           if($(this).hasClass('pressed')){

                $('.sortRating').removeClass('pressed');

            }else{

                $(this).addClass('pressed');
                $('.sortRating').removeClass('pressed');

        };

    });

     $('.sortRating').on('click touch', function(){

       if($(this).hasClass('pressed')){

            $('.sortDistance').removeClass('pressed');

        }else{

            $(this).addClass('pressed');
            $('.sortDistance').removeClass('pressed');

        };

    });

});

// $('#submitButton').hover(function(){

// (function pulse(){
//         $('#submitButton').delay(200).fadeOut('fast').delay(50).fadeIn('fast',pulse);
//     })();

//      });




// nR9fG1pjAT

// http://leafletjs.com/


