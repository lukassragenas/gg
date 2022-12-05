jQuery(document).ready(function($){
    $('.video').parent().click(function () {
      if($(this).children(".video").get(0).paused){   
             $(this).children(".video").get(0).play();   $(this).children(".playpause").fadeOut();
        }else{     
            $(this).children(".video").get(0).pause();
      $(this).children(".playpause").fadeIn();
        }
    });


    $('nav li:nth-child(1)').click(function () {
      if ($('.bottom-bar').hasClass('move-up')) {
        $('.bottom-bar').removeClass('move-up');
        $('.bottom-bar').addClass('move-down');
        $('nav li:nth-child(1)').removeClass('category-active');

      } else {
        $('.bottom-bar').removeClass('move-down');
        $('.bottom-bar').addClass('move-up');
        $('nav li:nth-child(1)').addClass('category-active');
      }

      if ($('.bottom-bar').hasClass('move-up') && $('.bottom-bar-recipes-menu').hasClass('move-up')) {
        $('.bottom-bar-recipes-menu').addClass('change-index');
      } else {
        $('.bottom-bar-recipes-menu').removeClass('change-index');

      }
  
    });

    $('nav li:nth-child(2)').click(function () {
      if ($('.bottom-bar-recipes-menu').hasClass('move-up')) {
        $('.bottom-bar-recipes-menu').removeClass('move-up');
        $('.bottom-bar-recipes-menu').addClass('move-down');
        $('nav li:nth-child(2)').removeClass('category-active');

      } else {
        $('.bottom-bar-recipes-menu').removeClass('move-down');
        $('.bottom-bar-recipes-menu').addClass('move-up');
        $('nav li:nth-child(2)').addClass('category-active');
      }

      if ($('.bottom-bar').hasClass('move-up') && $('.bottom-bar-recipes-menu').hasClass('move-up')) {
        $('.bottom-bar-recipes-menu').addClass('change-index');
      } else {
        $('.bottom-bar-recipes-menu').removeClass('change-index');

      }
  
    });


    $('.specifications-info').hide();
    $('.specifications-link').removeClass('active-info');
    $('.about-link').addClass('active-info');


    $('.about-link').click(function () {
      $('.specifications-link').removeClass('active-info');
      $('.about-link').addClass('active-info');
      $('.specifications-info').hide();
      $('.about-info').show();
     });


     $('.specifications-link').click(function () {
       $('.about-link').removeClass('active-info');
      $('.specifications-link').addClass('active-info');
      $('.about-info').hide();
      $('.specifications-info').show();
     });

     

     $( ".outofstock a" ).prop( "disabled", false );

    
     $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      centerMode: true,
      focusOnSelect: true,
      centerPadding: '10'
    });

    $('.woocommerce-address-fields input').addClass('form-control');

    
var productPopularSwiper = $('.productPopularSwiper li');
var productNewSwiper = $('.productNewSwiper li');
var productSaleSwiper = $('.productSaleSwiper li');
var productRelatedSwiper = $('.productRelatedSwiper li');
if(productPopularSwiper.length < 4) {
  $('.popular-nav').addClass('display-none');
}

if(productNewSwiper.length < 4) {
  $('.new-nav').addClass('display');
}

if(productSaleSwiper.length < 4) {
  $('.sale-nav').addClass('display-none');
}

if(productRelatedSwiper.length < 4) {
  $('.related-nav').addClass('display-none');
}


$('.search-submit').click(function()
{
  alert('Įveskite raktinį žodį');

  // $('.search-field').click(function()

  alert('Įveskite raktinį žodį');
    if( !$(this).val() ) {
    }
});


  });

