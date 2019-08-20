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
});