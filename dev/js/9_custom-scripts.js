/*!
 * theme custom scripts
*/

jQuery(document).ready(function($){
  $('.partners').slick({
    dots: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    centerMade:true,
    nextArrow: '<button type="button" class="partner-prev"><i class="fas fa-angle-right"></i></button>',
    prevArrow: '<button type="button" class="partner-next"><i class="fas fa-angle-left"></i></button>',
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 4
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2
        }
      }
    ]
  });

  if(typeof $.fn.waypoint !== 'undefined'){
    $('.timeline-year').first().addClass('active');
    
    var waypoint = $('.timeline-year').waypoint({
      handler: function(direction){
        moveMarker(direction, this.element);
      },
      offset: '45%'
    });
  }

  function moveMarker(direction, $newYear){
    var $oldYear = $('.timeline-year.active');

    $oldYear.removeClass('active');
    $($newYear).addClass('active');
  }

  $('#hero-carousel.carousel-heights .carousel-inner .carousel-item').carouselHeights();

  $('#product-inquiry-modal').on('show.bs.modal', function(e){
    var button = $(e.relatedTarget);
    var productName = button.data('product_name');

    var modal = $(this);
    modal.find('#product-inquiry-modal-label').text(productName);
    modal.find('[id^="field_product_name"]').val(productName);
  });

  $('#contact-location-modal').on('show.bs.modal', function(e){
    var button = $(e.relatedTarget);
    var contactLocation = button.data('contact_location');

    var modal = $(this);
    modal.find('#location_title').text(contactLocation);
    modal.find('#field_location_title').val(contactLocation);
  });

  $('.locations-map').each(function () {
    map = new_map($(this));
  });
});


/**
 * Normalize Carousel Heights
 */
$.fn.carouselHeights = function () {
  var items = $(this), //grab all slides
    heights = [], //create empty array to store height values
    tallest; //create variable to make note of the tallest slide

  var normalizeHeights = function () {
    items.each(function () { //add heights to array
      heights.push($(this).height());
    });
    tallest = Math.max.apply(null, heights); //cache largest value
    items.each(function () {
      $(this).css('min-height', tallest + 'px');
    });
  };

  normalizeHeights();

  $(window).on('resize orientationchange', function () {
    //reset vars
    tallest = 0;
    heights.length = 0;

    items.each(function () {
      $(this).css('min-height', '0'); //reset min-height
    });
    normalizeHeights(); //run it again 
  });
};

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map($el) {

  // var
  var $markers = $el.find('.marker');


  // vars
  var args = {
    zoom: 16,
    center: new google.maps.LatLng(0, 0),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };


  // create map	        	
  var map = new google.maps.Map($el[0], args);


  // add a markers reference
  map.markers = [];


  // add markers
  $markers.each(function () {

    add_marker($(this), map);

  });


  // center map
  center_map(map);


  // return
  return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker($marker, map) {

  // var
  var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

  // create marker
  var marker = new google.maps.Marker({
    position: latlng,
    map: map
  });

  // add to array
  map.markers.push(marker);

  // if marker contains HTML, add it to an infoWindow
  if ($marker.html()) {
    // create info window
    var infowindow = new google.maps.InfoWindow({
      content: $marker.html()
    });

    // show info window when marker is clicked
    google.maps.event.addListener(marker, 'click', function () {

      infowindow.open(map, marker);

    });
  }

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map(map) {

  // vars
  var bounds = new google.maps.LatLngBounds();

  // loop through all markers and create bounds
  $.each(map.markers, function (i, marker) {

    var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

    bounds.extend(latlng);

  });

  // only 1 marker?
  if (map.markers.length == 1) {
    // set center of map
    map.setCenter(bounds.getCenter());
    map.setZoom(16);
  }
  else {
    // fit to bounds
    map.fitBounds(bounds);
  }

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;