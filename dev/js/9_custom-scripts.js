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
    prevArrow: '<button type="button" class="partner-prev"><i class="fas fa-angle-right"></i></button>',
    nextArrow: '<button type="button" class="partner-next"><i class="fas fa-angle-left"></i></button>',
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
});

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