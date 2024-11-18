For Create Style :
$ ssh a409940b_1@d3ca7104b0.nxcli.net
Password: 
[a409940b@cloudhost-714165 ~]
$ pwd
$ cd d3ca7104b0.nxcli.net/html/
[a409940b@cloudhost-714165 html]$ php bin/magento s:s:d -f

Flushed cache types:
[a409940b@cloudhost-714165 html]$ php bin/magento c:f

For Webroot :
live_crowdfund@Crowdfund:/var/www/vhosts/www.crowdfund.mu$ cd webroot
live_crowdfund@Crowdfund:/var/www/vhosts/www.crowdfund.mu/webroot$ php bin/magento s:s:d -f
live_crowdfund@Crowdfund:/var/www/vhosts/www.crowdfund.mu/webroot$ php bin/magento c:f



SSH Connect : 

:- For bad permission error

chmod 400 /home/stathmos/Jaydeep_Data/carparts.pem 
chmod 600 /home/stathmos/Jaydeep_Data/carparts.pem
chmod 0400 /home/stathmos/Jaydeep_Data/carparts.pem
ssh -i /home/stathmos/Jaydeep_Data/carparts.pem /ubuntu@15.207.239.239


Live : ssh -i /home/jaydip/Desktop/zig.pem ubuntu@3.22.101.68
Staging : ssh -i zig.pem ubuntu@18.221.81.42


cd /var/www/html
php bin/magento c:f

php bin/magento s:s:d -f


php bin/magento s:up && php bin/magento s:d:c && php bin/magento s:s:d -f


[master_yadenmyjfb]:public_html$ php bin/magento s:up
[master_yadenmyjfb]:public_html$ php bin/magento s:d:c
[master_yadenmyjfb]:public_html$ php bin/magento i:re
[master_yadenmyjfb]:public_html$ php bin/magento i:rei
[master_yadenmyjfb]:public_html$ php bin/magento s:s:d -f
[master_yadenmyjfb]:public_html$ php bin/magento c:f



[a826b221@cloudhost-1913337 ~]$ cd fa3df461b1.nxcli.net/html/
[a826b221@cloudhost-1913337 html]$ php bin/magento s:s:d -f en_US en_GB it_IT
[a826b221@cloudhost-1913337 html]$ php bin/magento c:f

For Develpment mode:
php bin/magento deploy:mode:set developer
php bin/magento s:up 
php bin/magento s:d:c 
php bin/magento s:s:d -f en_US
php bin/magento s:s:d -f en_AU

For Production mode:
php bin/magento deploy:mode:set production




$count = 1;
<?php if($count % 2 == 1){ ?>
<?php } else { ?>
<?php } $count++; ?>




: Odd and even 

<?php
   $count = 1;
   $class = "";
   if( have_rows('product_information') ):
   while( have_rows('product_information') ) : the_row();
?>
<?php 
    if($count % 2 == 0) {
       $class = 'productright'; 
   } else {
       $class = 'productleft';
   }
?>
<?php 
  $count++;
  endwhile;
  endif;
?> 

<?php if($count % 2 == 0) {

  $class = 'gold_dataright';

} else {
    
    $class = 'gold_dataleft'; 
}

?>



<script type="text/javascript">
    require(['jquery', 'jquery/ui'], function($) { 
        $('body').click(function() {
            $(".mobile_sidebar").css('display','none');
            $(".bars_overlay").hide();
        });

        $('.mobile_sidebar').click(function(e) {
            e.stopPropagation();
        });

        $('#product-listing-filter-toggle').click(function(e) {
            $(".mobile_sidebar").show();
            $(".mobile_sidebar").css('display','block');
            $(".bars_overlay").show();
            e.stopPropagation();
        });
    });
</script>
<script type="text/javascript">
    require(['jquery', 'jquery/ui'], function($) {
        jQuery(document).ready(function() {

            jQuery(".link").click(function() {
               jQuery('html, body').animate({
                scrollTop: jQuery("#fitment_jump").offset().top
            }, 1000);
           });

            jQuery('.edit-btn').live('click', function(event) {        
               jQuery('#product-options-wrapper').toggle('show');
               jQuery('#product-options-wrapper').css('display','block');
           });
            jQuery(".btn-close").click(function() {
                jQuery(".product-options-wrapper").hide();
            });
            jQuery('.product-options-wrapper > .fieldset > .field').hide();
            jQuery('.product-options-wrapper > .fieldset > .field').first().show();


            if(window.matchMedia("(max-width: 767px)").matches)
            {
                jQuery('.productdetail_tabs .option-tab').click(function() {
                    var type = jQuery(this).attr('type');
                    
                    if(type == 'recommended')
                    {
                        if(jQuery(this).hasClass('active'))
                        {
                            jQuery(this).removeClass('active');
                            jQuery('.product-options-wrapper > .fieldset > .field').first().removeClass('show');
                        }
                        else
                        {
                            jQuery(this).addClass('active');
                            jQuery('.product-options-wrapper > .fieldset > .field').first().addClass('show');
                            jQuery('.product-options-wrapper > .fieldset > .field').last().removeClass('show');
                            jQuery("[type=upgrade]").removeClass('active');     
                        }
                    }
                    else
                    {
                        if(jQuery(this).hasClass('active'))
                        {
                            jQuery(this).removeClass('active');
                            jQuery('.product-options-wrapper > .fieldset > .field').last().removeClass('show');
                        }
                        else
                        {
                            jQuery(this).addClass('active');
                            jQuery('.product-options-wrapper > .fieldset > .field').last().addClass('show');
                            jQuery('.product-options-wrapper > .fieldset > .field').last().addClass('show-upgrade');
                            jQuery('.product-options-wrapper > .fieldset > .field').css('display','block');
                            jQuery('.product-options-wrapper > .fieldset > .field').first().removeClass('show');
                            jQuery("[type=recommended]").removeClass('active'); 
                        }                   
                    }
                });    
            } 
            else
            {
                jQuery('.productdetail_tabs .option-tab').click(function() {
                    var type = jQuery(this).attr('type');
                    jQuery('.productdetail_tabs .option-tab').removeClass('active');
                    jQuery(this).addClass('active');
                    jQuery('.product-options-wrapper > .fieldset > .field').hide();
                    jQuery('.product-options-wrapper > .fieldset > .field').removeClass('show');
                    if(type == 'recommended'){
                        jQuery('.product-options-wrapper > .fieldset > .field').first().show();
                        jQuery('.product-options-wrapper > .fieldset > .field').first().addClass('show');
                    }else{
                        jQuery('.product-options-wrapper > .fieldset > .field').addClass('show');
                        jQuery('.product-options-wrapper > .fieldset > .field').show();
                        jQuery('.product-options-wrapper > .fieldset > .field').first().hide();
                        jQuery('.product-options-wrapper > .fieldset > .field').first().removeClass('show');
                    }
                });    
            }
        });
});
</script>

<!--- Onclick Box Url Change --->
<script type="text/javascript">
    jQuery("#box_order_first").click(function() { 
        if(!jQuery(this).hasClass("box_active")) {
            jQuery(this).addClass("box_active");
        }
        jQuery("#box_order_second").removeClass("box_active");
        jQuery("#box_order_third").removeClass("box_active");
        
        newUrl = window.location.protocol + "//" + window.location.hostname + "/checkout?add-to-cart=232&quantity=1";

        jQuery("#order_now_link").attr("href", newUrl);
    });
    jQuery("#box_order_second").click(function() { 
        if(!jQuery(this).hasClass("box_active")) {
            jQuery(this).addClass("box_active");
        }
        jQuery("#box_order_first").removeClass("box_active");
        jQuery("#box_order_third").removeClass("box_active");

        newUrl = window.location.protocol + "//" + window.location.hostname + "/checkout?add-to-cart=232&quantity=3";

        jQuery("#order_now_link").attr("href", newUrl);
    });
    jQuery("#box_order_third").click(function() { 
        if(!jQuery(this).hasClass("box_active")) { 
            jQuery(this).addClass("box_active");
        }
        jQuery("#box_order_second").removeClass("box_active");
        jQuery("#box_order_first").removeClass("box_active");

        newUrl = window.location.protocol + "//" + window.location.hostname + "/checkout?add-to-cart=232&quantity=6";

        jQuery("#order_now_link").attr("href", newUrl);
    });
</script>
<!--- Onclick Box Url Change --->



<script>
    jQuery(document).ready(function() {
     jQuery('.care-tab-1').click(function() {
         setTimeout(function() {
            window.dispatchEvent(new Event('resize'));
        }, 100);
     });
     jQuery('.care-tab-2').click(function() {
        setTimeout(function() {
            window.dispatchEvent(new Event('resize'));
        }, 100);
    });
 });
</script>


<!--- Mobile tab Show --->
<script type="text/javascript">
    if(window.matchMedia('(max-width: 767px)').matches)
    {
        jQuery(document).ready(function () {
            jQuery('.care-tab-open-1').hide();
            jQuery('.care-tab-open-2').hide();
            jQuery('.care-tab-1').on('click', function() {
                jQuery('.care-tab-open-1').show();
                jQuery('.care-tab-open-2').hide();
            });
            jQuery('.care-tab-2').on('click', function() {
                jQuery('.care-tab-open-2').show();
                jQuery('.care-tab-open-1').hide();  
            });
        });
    }
</script>
<!--- Mobile tab Show --->


<!--- Timeline --->
<script type="text/javascript">
    var items = $(".timeline li");
    var lineToDraw = $('.draw-line');
    if(lineToDraw.length) {
      $(window).on('scroll', function () {

        let greyLineHeight = $('.default-line').height();
        let windowDistance = $(window).scrollTop();
        let timelineDistance = $(".timeline").offset().top;
        let headerHeight = $('.main-header').height();
        let line = 0;

        if((windowDistance + (2 * headerHeight)) >= timelineDistance) {
          line = windowDistance - timelineDistance + (2 * headerHeight);
          
          if(line <= greyLineHeight) {
            lineToDraw.css({
              'height' : line + 'px'
          });
        }
    }

    var bottom = lineToDraw.offset().top + lineToDraw.outerHeight(true);
    items.each(function(index) {
      var circlePosition = $(this).offset();

      if(bottom > circlePosition.top) {             
        $(this).addClass('in-view');
    } else {
        $(this).removeClass('in-view');
    }
}); 
});

      
  }

  $("#button").click(function() {
    $('html, body').animate({
        scrollTop: $("#strenth_number").offset().top
    }, 100);
});

</script>


<!--- Popup Model --->
<script type="text/javascript">
    var ebModal = document.getElementById('mySizeChartModal');
    var ebBtn = document.getElementById("mySizeChart");
    var ebSpan = document.getElementsByClassName("zip_close")[0];
    var ebOKBttn = document.getElementsByClassName("zip_button")[0];

    ebBtn.onclick = function() {
        ebModal.style.display = "block";
    }
    ebSpan.onclick = function() {
        ebModal.style.display = "none";
    }
    ebOKBttn.onclick = function() {
        ebModal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == ebModal) {
            ebModal.style.display = "none";
        }
    }
</script>
<div id="mySizeChartModal" class="zip_modal">
  <div class="zip_modal-content">
    <span class="zip_close">&times;</span>
    <input type="text" id="zipcode" name="zipcode" placeholder="Enter Zipcode...">
    <button class="zip_button">ok</button>
  </div>
</div>
<!-- Popup Model -->

<!---- Sticky Content Untill Footer Start--->
<script type="text/javascript">
    var pageWidth = $(window).width();
    jQuery(window).scroll(function () { 
        if (pageWidth > 1024) {
           if(jQuery(window).scrollTop() > 200) {
            jQuery('.product-info-main').css('position','fixed');
            jQuery('.product-info-main').css('top','0');
        }
        else if (jQuery(window).scrollTop() <= 200) {
            jQuery('.product-info-main').css('position','');
            jQuery('.product-info-main').css('top','');
        }     
        if (jQuery('.product-info-main').offset().top + jQuery(".product-info-main").height() > jQuery(".hide_scroll").offset().top) {
          jQuery('.product-info-main').css('top',-(jQuery(".product-info-main").offset().top + jQuery(".product-info-main").height() - jQuery(".hide_scroll").offset().top));
      }
  }
});
</script>
<!---- Sticky Content Untill Footer Start--->


<!---- Owl Carousle Width --->
<script type="text/javascript">
  $('.cart-slider').owlCarousel({
      loop:false,
      margin:30,
      nav:true,
      slideTransition: 'linear',
      autoplaySpeed: 1500,
      autoWidth:true,
      smartSpeed: 1500,
      responsiveClass:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          },
          1366:{
              items:2
          }
      }
  })
</script>
<!---- Owl Carousle Width --->


<!--- Jquery Button Bottom When Scroll --->
<script type="text/javascript">
=> First Jquery :

    var menu = jQuery('#cart_button');
    function isInViewport(scroll) {
        var viewportTop = jQuery('.order_sale').offset().top-100;
        var viewportBottom = viewportTop + jQuery('.order_sale').height();
        // console.log(scroll+'  --  '+viewportTop);
        if (scroll > viewportTop) {
            menu.addClass('scrollorder');
        } else {
            menu.removeClass('scrollorder');
        }
    }

    jQuery(window).scroll(function () {
        var scroll = jQuery(window).scrollTop();
        isInViewport(scroll)
    });


=> Second Jquery : Onclick Button Scroll Div

jQuery(function () {
  jQuery('.tablinks').on("click", function (event) {
    
    var string = jQuery(this).attr( "onclick" ); 
    var result= string.split(',')[1].trim();
    var match = result.match(/'([^']+)'/)[1];
    
    if(jQuery('div .order_sale > button').hasClass('clickedtab')){
      jQuery('div .order_sale > button').removeClass("clickedtab");
    }
    jQuery('#' + match  + ' .supplier_content_box .order_sale #order_scroll').addClass('clickedtab');  
    var menu = jQuery('#order_scroll');
    function isInViewport(scroll) {
        var viewportTop = jQuery('#' + match  + ' .supplier_content_box .order_sale').offset().top-50;
        var viewportBottom = viewportTop + jQuery('#' + match  + ' .supplier_content_box .order_sale').height();
        if (scroll > viewportTop) {
          if(jQuery('div .order_sale > button').hasClass('clickedtab')){  
            //menu.addClass('scrollorder');
            jQuery('#' + match  + ' .supplier_content_box .order_sale #order_scroll').addClass('scrollorder');
            //jQuery('div .order_sale > button').addClass('scrollorder');
          }
        } else {
           // menu.removeClass('scrollorder');
          jQuery('div .order_sale > button').removeClass('scrollorder');
          //jQuery('#' + match  + ' .supplier_content_box .order_sale #order_scroll').removeClass('scrollorder');
        }
    }

    jQuery(window).scroll(function () {
        var scroll = jQuery(window).scrollTop();
        isInViewport(scroll)
    });
  });  
});
</script>
<!--- Jquery Button Bottom When Scroll --->

<!--- Jquery onload scroll div when reach exact point --->
<script type="text/javascript">
jQuery(document).ready(function() {
  const distanceToTop = $('#Thirdbox .supplier_content_box .order_sale #order_scroll').offset().top-50;
  $(window).on("scroll", (event) => {
    const $header = $('#Thirdbox .supplier_content_box .order_sale #order_scroll');
    const y = $(window).scrollTop(); 
    if (y >= distanceToTop) $header.addClass('scrollorder');
    else $header.removeClass('scrollorder');
  });
});
</script>
<!--- Jquery onload scroll div when reach exact point --->

<!--- Jquery Length Check --->
<script type="text/javascript">
    if ( jQuery('.zq-cart-cartcontents--recommended-list li').length > 4 ) {
       jQuery('.scroll_cart').css("overflow-y", "scroll");
       jQuery('.scroll_cart').css("height", "100%");
       jQuery('.scroll_cart').css("max-height", "280px");
   }
</script>
<!--- Jquery Length Check --->


<!--- Jquery fix div auto scroll come footer div stop --->
<script type="text/javascript">
$(function() {
    $.fn.scrollBottom = function() {
        return $(document).height() - this.scrollTop() - this.height();
    };
    var $el = $('.desktopcartcontents');
    var $window = $(window);
    $window.bind("scroll resize", function() {
        var gap = $window.height() - $el.height() - 10;
        var visibleFoot = 467 - $window.scrollBottom();
        var scrollTop = $window.scrollTop()
        if(scrollTop < 120 + 10){
            $el.css({
                top: (120 - scrollTop) + "px",
                bottom: "auto"
            });
        }else if (visibleFoot > gap) {
            $el.css({
                top: "auto",
                bottom: visibleFoot + "px"
            });
        } else {
            $el.css({
                top: 0,
                bottom: "auto"
            });
        }
    });
});
</script>
<!--- Jquery fix div auto scroll come footer div stop --->


<!--- Jquery Onclick scroll div --->
<script type="text/javascript">
jQuery(function() {
    jQuery('a[href*=\\#]:not([href=\\#])').on('click', function() {
        var target = jQuery(this.hash);
        target = target.length ? target : jQuery('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            jQuery('html,body').animate({
                scrollTop: target.offset().top-121
            }, 1000);
            return false;
        }
    });
});
</script>
<!--- Jquery Onclick scroll div --->

< !-- Id wise link data display --->
<a href="<?php echo "/course-page-iframe/?id=".get_the_id(); ?>">Start Course</a>
<?php 
    $id = $_GET['id'];
    echo get_post_meta($id, 'iframe_code', true);
?>
< !-- Id wise link data display --->

< !-----  Upcoming and recent data -- >

<?php 

Upcoming Post & Custom field meta select  :

$today = date('F d, Y');
$webinar_posts = new WP_Query(
    array('post_type'=>'ac_event', 
        'post_status'=>'publish', 
        'posts_per_page'=> -1, 
        'orderby'=>'date', 
        'order'=>'DESC',
        'meta_key'=> 'ac_event_start_date',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'ac_event_start_date',
                'value' => $today,
                'compare' => '>=',
            ),
            array(
                'key' => 'webinar_language',
                'value' => 'french',
                'compare' => '=',
            )
        ),
    )
);

Previous Post :
$today = date('F d, Y');
$webinar_posts = new WP_Query(
    array('post_type'=>'ac_event', 
        'post_status'=>'publish', 
        'posts_per_page'=> -1, 
        'orderby'=>'date', 
        'order'=>'DESC',
        'meta_key'=> 'ac_event_start_date',
        'meta_query' => array(
            array(
                'key' => 'ac_event_start_date',
                'value' => $today,
                'compare' => '<=',
            )
        ),
    )
);?>
< !-----  Upcoming and recent data -- >

< !-----  Press enter key script --- >
<script type="text/javascript">
$('#cdk_userzipcode').on('keypress', function(e) { 
  if (e.which === 13 ) {
      e.preventDefault();
      updateZipCode();        
      return false;
  }
});
</script>
< !-----  Press enter key script --- >

< !-----  Mobile Menu Script --- >
<script type="text/javascript">
const menuBtn = document.querySelector('.menu-btn');
const hamburger = document.querySelector('.menu-btn__burger');
const nav = document.querySelector('.nav');
const menuNav = document.querySelector('.menu-nav');
const navItems = document.querySelectorAll('.menu-nav__item');

let showMenu = false;

menuBtn.addEventListener('click', toggleMenu);

function toggleMenu() {
  if(!showMenu) {
    hamburger.classList.add('open');
    nav.classList.add('open');
    menuNav.classList.add('open');
    navItems.forEach(item => item.classList.add('open'));

    showMenu = true;
  } else {
    hamburger.classList.remove('open');
    nav.classList.remove('open');
    menuNav.classList.remove('open');
    navItems.forEach(item => item.classList.remove('open'));

    showMenu = false;
  }
}
</script>
< !-----  Mobile Menu Script --- >

< !-----  Jquery Onclick radio check add class --- >
<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery('input').click(function () {
        jQuery('input:not(:checked)').parent().parent().removeClass("active");
        jQuery('input:checked').parent().parent().addClass("active");
    });    
});
</script>
<!-----  Jquery Onclick radio check add class --- >


<!- Multiple Row owl Carousel --> 
<script type="text/javascript">
jQuery(document).ready(function() {
  var el = jQuery('.feature-owl-carousel');
  
  var carousel;
  var carouselOptions = {
    margin: 20,
    nav: false,
    dots: false,
    slideBy: 'page',
    responsive: {
      0: {
        items: 1,
        rows: 2 
      },
      768: {
        items: 2,
        rows: 3 
      },
      991: {
        items: 4,
        rows: 2 
      }
    }
  };

  //Taken from Owl Carousel so we calculate width the same way
  var viewport = function() {
    var width;
    if (carouselOptions.responsiveBaseElement && carouselOptions.responsiveBaseElement !== window) {
      width = jQuery(carouselOptions.responsiveBaseElement).width();
    } else if (window.innerWidth) {
      width = window.innerWidth;
    } else if (document.documentElement && document.documentElement.clientWidth) {
      width = document.documentElement.clientWidth;
    } else {
      console.warn('Can not detect viewport width.');
    }
    return width;              
  };

  var severalRows = false;
  var orderedBreakpoints = [];
  for (var breakpoint in carouselOptions.responsive) {
    if (carouselOptions.responsive[breakpoint].rows > 1) {
      severalRows = true;
    }
    orderedBreakpoints.push(parseInt(breakpoint));
  }
  
  //Custom logic is active if carousel is set up to have more than one row for some given window width
  if (severalRows) {
    orderedBreakpoints.sort(function (a, b) {
      return b - a;
    });
    var slides = el.find('[data-slide-index]');
    var slidesNb = slides.length;
    if (slidesNb > 0) {
      var rowsNb;
      var previousRowsNb = undefined;
      var colsNb;
      var previousColsNb = undefined;

      //Calculates number of rows and cols based on current window width
      var updateRowsColsNb = function () {
        var width =  viewport();
        for (var i = 0; i < orderedBreakpoints.length; i++) {
          var breakpoint = orderedBreakpoints[i];
          if (width >= breakpoint || i == (orderedBreakpoints.length - 1)) {
            var breakpointSettings = carouselOptions.responsive['' + breakpoint];
            rowsNb = breakpointSettings.rows;
            colsNb = breakpointSettings.items;
            break;
          }
        }
      };

      var updateCarousel = function () {
        updateRowsColsNb();

        //Carousel is recalculated if and only if a change in number of columns/rows is requested
        if (rowsNb != previousRowsNb || colsNb != previousColsNb) {
          var reInit = false;
          if (carousel) {
            //Destroy existing carousel if any, and set html markup back to its initial state
            carousel.trigger('destroy.owl.carousel');
            carousel = undefined;
            slides = el.find('[data-slide-index]').detach().appendTo(el);
            el.find('.fake-col-wrapper').remove();
            reInit = true;
          }


          //This is the only real 'smart' part of the algorithm

          //First calculate the number of needed columns for the whole carousel
          var perPage = rowsNb * colsNb;
          var pageIndex = Math.floor(slidesNb / perPage);
          var fakeColsNb = pageIndex * colsNb + (slidesNb >= (pageIndex * perPage + colsNb) ? colsNb : (slidesNb % colsNb));

          //Then populate with needed html markup
          var count = 0;
          for (var i = 0; i < fakeColsNb; i++) {
            //For each column, create a new wrapper div
            var fakeCol = jQuery('<div class="fake-col-wrapper"></div>').appendTo(el);
            for (var j = 0; j < rowsNb; j++) {
              //For each row in said column, calculate which slide should be present
              var index = Math.floor(count / perPage) * perPage + (i % colsNb) + j * colsNb;
              if (index < slidesNb) {
                //If said slide exists, move it under wrapper div
                slides.filter('[data-slide-index=' + index + ']').detach().appendTo(fakeCol);
              }
              count++;
            }
          }
          //end of 'smart' part

          previousRowsNb = rowsNb;
          previousColsNb = colsNb;

          if (reInit) {
            //re-init carousel with new markup
            carousel = el.owlCarousel(carouselOptions);
          }
        }
      };

      //Trigger possible update when window size changes
      jQuery(window).on('resize', updateCarousel);

      //We need to execute the algorithm once before first init in any case
      updateCarousel();
    }
  }

  carousel = el.owlCarousel(carouselOptions);
});
</script>
<?php
    $count = 0;
    if($feature_course_posts->have_posts()) {
        while($feature_course_posts->have_posts()) {
        $count++;
      } 
    }
?>
<div class="slide" data-slide-index="<?php echo $count -1;?>"></div>
<!--- Multiple Row owl Carousel -->


<!--- Latitude and logitude and city and state autocomplate script -->

<script src="https://maps.google.com/maps/api/js?key=AIzaSyBtMUGbBUvK71p7kFOtwh-qsM0kqtL4X-w&libraries=places&callback=initAutocomplete" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#lat_area").addClass("d-none");
        jQuery("#long_area").addClass("d-none");
    });
    
    google.maps.event.addDomListener(window, 'load', initialize);
    
    function initialize() {
        var input = document.getElementById('street');
        var street = new google.maps.places.Autocomplete(input);
        street.addListener('place_changed', function() {
            var place = street.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var componentForm = {
                locality: 'long_name',
            };
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                 if (componentForm[addressType]) {
                  var val = place.address_components[i][componentForm[addressType]];
                  var state =  place.address_components[place.address_components.length - 3].long_name;
                  //console.log(state);
                  document.getElementById("city").value = val;
                  jQuery("#state").val(state).change();
                }
                
            }
            // jQuery('#latitude').val(place.geometry['location'].lat());
            // jQuery('#longitude').val(place.geometry['location'].lng());
            // jQuery('#city').val(place.city);
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            // --------- show lat and long ---------------
            jQuery("#lat_area").removeClass("d-none");
            jQuery("#long_area").removeClass("d-none");
        });
    }
</script>

<!--- Latitude and logitude and city and state autocomplate script Second code -->

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#lat_area").addClass("d-none");
        jQuery("#long_area").addClass("d-none");
    });
    
    google.maps.event.addDomListener(window, 'load', initialize);
    
    function initialize() {
        var input = document.getElementById('street');
        var street = new google.maps.places.Autocomplete(input);
        street.addListener('place_changed', function() {
            var place = street.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var componentForm = {
                locality: 'long_name',
            };

            for (var i = 0; i < place.address_components.length; i++) 
            {
                var addressType = place.address_components[i].types[0];
                console.log(addressType);
                console.log(place.address_components.length);
                
                if (place.address_components[i].types[0] == "administrative_area_level_1") 
                {
                    //this is the object you are looking for State
                    state = place.address_components[i];
                    jQuery("#state").val(state.long_name).change();
                    console.log(state);
                }

                if (place.address_components[i].types[0] == "postal_code") 
                {
                    //this is the object you are looking for
                    postal_code = place.address_components[i];
                    document.getElementById("zip_code").value = postal_code.long_name;
                    console.log(postal_code);
                }

                if (place.address_components[i].types[0] == "locality") 
                {
                    //this is the object you are looking for City
                    city = place.address_components[i];
                    document.getElementById("city").value = city.long_name;
                }

                /*if (componentForm[addressType]) 
                {
                    var val = place.address_components[i][componentForm[addressType]];
                    //var state =  place.address_components[place.address_components.length - 3].long_name;

                    

                    
                    document.getElementById("city").value = val;
                    jQuery("#state").val(state).change();
                }*/
                
            }
            // jQuery('#latitude').val(place.geometry['location'].lat());
            // jQuery('#longitude').val(place.geometry['location'].lng());
            // jQuery('#city').val(place.city);
                document.getElementById('latitude').value = place.geometry.location.lat();
                document.getElementById('longitude').value = place.geometry.location.lng();
            // --------- show lat and long ---------------
            jQuery("#lat_area").removeClass("d-none");
            jQuery("#long_area").removeClass("d-none");
        });
    }
</script>


<!---- All Toogle open issue fix  --->
$i = 1; (Before foreach)
<div class="filter-options-title" attr-id="<?= $i; ?>"></div> (On click div) 
<div class="filter-options-content" id="filter-options-content-<?= $i; ?>" style="display: none;"> (On click open div)
<?php $i++;?> (Before close foreach)

<script type="text/javascript">
    require(['jquery'],function($){
        jQuery(document).ready( function() {
            $(".filter-options-title").click(function () {
                var attrId = $(this).attr('attr-id');
                $("#filter-options-content-"+attrId).toggle();
                $(".filter-options-title").toggleClass("catmain");
            });
        });
    });
</script>

<!---- All Toogle open issue fix  --->

<!--- Toggle class add remove js --->
<script type="text/javascript">
require(['jquery'], function($) {
    jQuery(document).ready(function() {
        jQuery('.year_selector').click(function() {
                jQuery(this).toggleClass('border_year');
                jQuery('.year_display').toggle();
        });
    });
});
</script>
<!--- Toggle class add remove js --->

<!---- Toogle text change --->
<script type="text/javascript">
jQuery(document).ready(function(){
            jQuery(".edit_part_bg").css("display", "none");
            jQuery(".edit_toogle").click(function(){
                jQuery(".edit_part_bg").toggle("slow");
                jQuery(this).find('#editbtn').text(function(i, v){
                    return v === 'Edit' ? 'Close' : 'Edit'
                })
            });
        });
</script>

<!--- Latitude and logitude and city and state autocomplate script -->

<!--- Star Ratings Code --->
<?php 
$ratings_testimonial = get_field( 'testimonial_ratings' );
?>
<div class="ratings">
    <?php 
        if($ratings_testimonial){
            $ratings = intval($ratings_testimonial);
            for($m=1 ; $m<=$ratings; $m++) { 
    ?>
      <span>&#9733;</span>
    <?php   
          } 
        }
    ?>  
</div>
<!--- Star Ratings Code --->


<!--- click second toggle hide first jquery --->
<script type="text/javascript">
jQuery(document).mouseup(function(e) 
{
    var container = jQuery(".need_help_toggle");
    var container_account = jQuery(".account_top_links");

    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
    if (!container_account.is(e.target) && container_account.has(e.target).length === 0) 
    {
        container_account.hide();
    }
});
</script>
<!--- click second toggle hide first jquery --->


<!--- Ajax code save button with loader --->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        jQuery('#document_form').on('submit', function(e) {
            e.preventDefault();

            var form = jQuery(this);
            var formData = form.serialize();

            showLoader();

            jQuery.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>", // WordPress AJAX handler URL
                type: 'POST',
                data: {
                    action: 'bandi_custom_contest_documents', // Action name registered in WordPress
                    data: formData
                },
                success: function(response) {
                    // Handle success response
                    jQuery('#document_form')[0].reset();
                    hideLoader();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                }
            });
        });

        function showLoader() {
            // Disable form inputs
            jQuery('#document_form input').prop('disabled', true);

            // Create and display the loader element on the page
            var loader = jQuery('<div id="loader">Loading...</div>');
            jQuery('body').append(loader);
        }

        function hideLoader() {
            // Enable form inputs
            jQuery('#document_form input').prop('disabled', false);

            // Remove the loader element from the page
            jQuery('#loader').remove();
        }
    });
</script>
<!--- Ajax code save button with loader --->


<!--- On change select dropdown div change --->
<script type="text/javascript">
    jQuery(function() {
        jQuery('#id2').hide();
        jQuery('#id3').hide();
        jQuery('#id4').hide();
        
        jQuery('#document_type').change(function(){
            
        if(jQuery('#document_type').val() == 'work_text')    
            {
                jQuery("#id1").show();
                jQuery("#id2").hide();
                jQuery("#id3").hide();
                jQuery("#id4").hide();
            }
        else if(jQuery('#document_type').val() == 'participation_form')
            {
                jQuery("#id2").show();
                jQuery("#id1").hide();
                jQuery("#id3").hide();
                jQuery("#id4").hide();
            }
        else if(jQuery('#document_type').val() == 'payment_receipt')
            {
                jQuery("#id3").show();
                jQuery("#id1").hide();
                jQuery("#id2").hide();
                jQuery("#id4").hide();
            }
        else if(jQuery('#document_type').val() == 'identity_document')
            {
                jQuery("#id4").show();
                jQuery("#id1").hide();
                jQuery("#id2").hide();
                jQuery("#id3").hide();
            }
        });
    jQuery('#OpenImgUpload').click(function(){ jQuery('#imgupload').trigger('click'); });
    });
</script>
<!--- On change select dropdown div change --->


<!--- On scroll fixed header code mobile width---> 
<script type="text/javascript">
if(jQuery(window).width() < 768){
    jQuery(window).scroll(function() {
          var sticky = jQuery('.page-header'),
            scroll = jQuery(window).scrollTop();
           
          if (scroll >= 82) { 
            sticky.addClass('fixed'); 
            jQuery('#maincontent').css("padding-top", "82px");
          }
          else { 
           sticky.removeClass('fixed');
           jQuery('#maincontent').css("padding-top", "0px");
        }
    });
    jQuery(window).scroll(function() {
          var stickyfilter = jQuery('.filter strong'),
            scroll = jQuery(window).scrollTop();
           
          if (scroll >= 82) { 
            stickyfilter.addClass('fixed_filter'); 
            jQuery('#maincontent').attr("style", "padding-top: 82px !important;");
          }
          else { 
           stickyfilter.removeClass('fixed_filter');
           jQuery('#maincontent').css("padding-top", "0px");
        }
    });
}
</script>
<!--- On scroll fixed header code mobile width--->

<!--- Bubble Image Script Code --->
<script>
jQuery(document).ready(function() {
  var bubbleCount = 20; // Total number of bubbles
  var bubbleSizeRange = [20, 100]; // Range of bubble sizes
  var boxWidth = 800; // Width of the containing box
  var boxHeight = 480; // Height of the containing box
  var pictures = [];

  <?php
  // Assuming you're in a WordPress loop or have access to post data
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      // Assuming 'bubble_image' is the name of your ACF repeater field
      if (have_rows('bubble_image')) {
        while (have_rows('bubble_image')) {
          the_row();
          $image = get_sub_field('image_bubble'); // Change 'image_bubble' to your image field name
          if ($image) {
            $image_url = $image['url'];
            echo "pictures.push('$image_url');\n";
          }
        }
      }
    }
  }
  ?>

  function getRandomSize(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }
  function getRandomImage() {
    return pictures[Math.floor(Math.random() * pictures.length)];
  }
  function animateBubble(bubble) {
    var size = getRandomSize(bubbleSizeRange[0], bubbleSizeRange[1]);
    var imageUrl = getRandomImage();
    
    var randomX = Math.random() * (boxWidth - size);
    
    bubble.css({
      width: size + 'px',
      height: size + 'px',
      left: randomX + 'px',
      top: '-50px', // Start above the container
      background: 'url(' + imageUrl + ')',
      backgroundSize: 'cover'
    });
    bubble.delay(Math.random() * 3000).hide().fadeIn({ duration: 1500, start: function() { $(this).css('display', 'block'); } }).animate({ top: boxHeight + 'px', opacity: 0 }, 5000, function() {
      bubble.css({ top: '-50px', opacity: 1 }); // Reset position and opacity
      animateBubble(bubble); // Restart animation
    });
  }
  for (var i = 0; i < bubbleCount; i++) {
    var bubble = jQuery('<div class="bubble"></div>');
    jQuery('#bubble-container').append(bubble); // Add bubbles to a container div
    animateBubble(bubble);
  }
});
</script>
<!--- Bubble Image Script Code --->

<!--- Pagination Wordpress Code -->

<ul class="blog-posts post-col2">
    <?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
        'post_type' => 'post',
        'category_name' => 'blog',
        'paged' => $paged
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>
            <li class="post post-loop col-md-6">
                <div class="post-thumbs">
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail(); // Use the default thumbnail size
                        }
                        ?>
                    </a>
                </div>
                <div class="post-entry">
                    <div class="post-meta">
                        <span class="pub-date">
                            <em class="fa fa-calendar" aria-hidden="true"></em> <?php echo get_the_date('d M, Y'); ?>
                        </span>
                    </div>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                    <a class="btn-link link-arrow-sm" href="<?php the_permalink(); ?>">Read More</a>
                </div>
            </li>
    <?php
        endwhile;?>
   <?php
        $big = 999999999;

        $paginate_links = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            'type' => 'array',
        ));

        if ($paginate_links) {
            echo '<ul class="pagination">';
            foreach ($paginate_links as $page) {
                echo '<li>' . $page . '</li>';
            }
            echo '</ul>';
        }
    ?>
     <?php   wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in the "blog" category.</p>';
    endif;
    ?>
</ul>

<!--- Pagination Wordpress Code -->

<!-- Cookie Js Start -->

<script type="text/javascript">
    jQuery(document).ready(function() {
        if (document.cookie.indexOf("main_homepage_popup=1") == -1) {
            //jQuery('#modalUser').modal('show');
            jQuery("#modalUser").css({
              "display": "flex",
              "background": "#000000e3",
              "opacity": "1",
              "top": "40"
            });
        }

        jQuery(".enter-button").click(function() {
            // Set the cookie to indicate that the user has interacted with the modal
            document.cookie = "main_homepage_popup=1; max-age=86400"; // 86400 seconds in a day
            
            // Hide the modal
            //jQuery('#modalUser').modal('hide');
            jQuery("#modalUser").css({
              "display": "none",
              "background": "none"
            });
        });
    });

    function leave_site(){
        window.location.assign("https://www.google.com");
    }
</script>

<!-- Cookie Js End -->


<!--- Jquery Menu under border smooth scroll right Js --->
<script type="text/javascript">
document.querySelectorAll('#mega-menu-primary-menu.max-mega-menu li .mega-menu-link span.mega-indicator').forEach(function(element) {
        element.addEventListener('click', function() {
            setTimeout(function(){
                if( $("#mega-menu-primary-menu.max-mega-menu").find('li.mega-toggle-on').length > 0 ){
                    $("body").addClass("mega-menu-open");
              var x = $(element).parent().position();
              var left = x.left;
              document.getElementsByClassName("qc-bar")[0].style.transform = "translateX("+ left +"px) scaleX(0.494624) scaleY(1)";
                } else {
                    $("body").removeClass("mega-menu-open");
                }
            }, 100);
        });
    });
</script>
<!--- Jquery Menu under border smooth scroll right Js --->



<!-- Jquery Toogle On Click Button --->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
jQuery('.site-nav__link--main--footer--dropdown').click(function() {
    var dropdownContainer = $(this).next('.site-nav__footer__dropdown');
    if (dropdownContainer.is(':visible')) {
        dropdownContainer.hide();
    } else {
        jQuery('.site-nav__footer__dropdown').hide();
        dropdownContainer.show();
    }
});
</script>
<!-- Jquery Toogle On Click Button --->

<!-- Jquery on click jump to respective div and remove body and div class --->
<script type="text/javascript">
$(document).on('click', '.site-nav__link--main', function (event) {
    if (window.innerWidth <= 768) {
    $('body').removeClass('canvasmenu-right');
    $('.canvas-menu.drawer-left.mm-wrapper.active').removeClass('active');
    var targetSectionId = decodeURIComponent($(this).attr('href'));
    $('html, body').animate({
        scrollTop: $(targetSectionId).offset().top
    }, 1000);
   }
}); 
</script>
<!-- Jquery on click jump to respective div --->


<referenceContainer name="header.panel">
    <block class="Magento\Framework\View\Element\Template" name="custom.block" template="Magento_Theme::html/header/top_left_custom_block.phtml" before="-"/>
</referenceContainer>
<referenceContainer name="footer">
    <block class="Magento\Framework\View\Element\Template" name="footer_section" template="Magento_Theme::html/footer/footer.phtml" after="footer_links"/>
</referenceContainer>
<referenceContainer name="footer">
    <container name="custom.copyright" as="custom_copyright" label="Custom Copyright" htmlTag="div" htmlClass="custom-copyright">
        <block class="Magento\Framework\View\Element\Template" name="custom.copyright.block" template="Magento_Theme::html/footer/copyright.phtml" />
    </container>
</referenceContainer>
<move element="catalog.topnav" destination="header-wrapper" before="top.search" />

<!--- Grid Css--->
<style type="text/css">
    .grid{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(3, 1fr);
        grid-gap: 20px;
        grid-row: 1/2;
        grid-column: 2/3;
        grid-auto-rows: 150px;
    }
</style>
<!---- Content dot dot css --->
<style type="text/css">
    .contentdot {
        height: 42px;
        display: block;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<!---- Content dot dot css --->


<style type="text/css">
.onelinesection {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    justify-content: space-evenly;
    align-items: center;
    flex: 1;
}
</style>

<!---- Custom Image full width and title center css-->
<style type="text/css">
.custom-banner-image {
    display: flex;
    align-items: center;
    justify-content: center;
}
.custom-banner-innerimage {
    width: 100%;
    position: relative;
    max-width: 100%;
    height: 100%;
    display: flex;
}
.custom-banner-innerimage:before {
    width: 0;
    height: 0;
    padding-top: calc(100% / 1.7857);
    content: "";
}
.custom-banner-innerimage img {
    visibility: visible;
    opacity: 1;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    max-width: 100%;
    display: block;
    transition: opacity .3s ease;
    object-fit: cover;
    object-position: 50% 50%;
}
.custom-banner-title {
    text-align: center;
    position: absolute;
    padding: 48px;
    max-width: 650px;
}
.custom-banner-title h3 {
    color: #fff;
    text-shadow: 1px 1px 1px rgba(0,0,0,.004);
    font-size: 38px;
}
.custom-banner-innerimage:after {
    position: absolute;
    content: "";
    top: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #0000004d;
}
</style>


<?php 
add_action('wp_head', 'air_stiky_moore');
function air_stiky_moore(){
if(ICL_LANGUAGE_CODE == 'fr')
{
    echo '<div class="moore_stephens"><img src="https://www.demersbeaulne.com/wp-content/uploads/2017/09/Moore_FR-follow.png" alt="Moore Stephens"></div>';
} 
else
{
    echo '<div class="moore_stephens"><img src="https://www.demersbeaulne.com/wp-content/uploads/2017/09/Moore_EN-follow.png" alt="Moore Stephens"></div>';
}
}
?>




<!---- Dynamic Category Image Fetach code with acf field and position--->

<?php

.cat_product_image img {
        width: <?php echo get_field( 'category_image_width', 'options' ); ?>px !important;
        height: <?php echo get_field( 'category_image_height', 'options' ); ?>px !important;
        margin-top: <?php echo get_field( 'category_image_margin_top', 'options' ); ?>px !important;
        margin-bottom: <?php echo get_field( 'category_image_margin_bottom', 'options' ); ?>px !important;
}

$category_image_enable = get_field('category_image_enable','options');
$category_image_position = get_field('category_image_position', 'options');
$category_image = get_term_meta($category_id, 'thumbnail_id', true);
$image_url = "";
if($category_image) { 
    $image_url = wp_get_attachment_url($category_image);
} ?>
                                
<div id="<?php echo $cat->slug ?>" class="position-relative cat_details">
<?php 
    if ($category_image_enable && !empty($image_url)) 
    {

        if ($category_image_position === 'above') 
        {
?>
            <div class="cat_product_image">
              <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_cat_name($category_id)); ?>" />
            </div>
<?php
        }
?>
        
            <h4 class="mt-5 mb-5 cat_name" style=""><?php echo $cat->name ?></h4>
        
<?php 
        if(get_field( 'enable_category_description', 'options' ))
        { 
?>
            <p class="cat_desc">
                <?php echo $cat->category_description; ?>
            </p>
<?php 
        } 
?>
        
<?php
        if ($category_image_position === 'under') 
        {
?>
            <div class="cat_product_image">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_cat_name($category_id)); ?>" />
            </div>
<?php
        }
    }
?>

<!---- Dynamic Category Image fetch code with acf field and position--->


<!---- Jquery Code scroll div menu position set on --->
<script>
jQuery( document ).ready(function($) {

    var menuItems = $('li.nav-item');
    var sections = $('div.position-relative');

    $(window).on('scroll', function () {
        var scrollPosition = $(this).scrollTop();

        sections.each(function () {
            var target = $(this).attr('id');
            var offset = $(this).offset().top;

            if (scrollPosition >= offset && scrollPosition < offset + $(this).outerHeight()) {
                menuItems.removeClass('active');
                menuItems.filter('[data-target="' + target + '"]').addClass('active');
            }
        });
    });
});
</script>
<!---- Jquery Code scroll div menu position set on --->


<script type="text/javascript">
jQuery(document).ready(function(){
  var maxHeight = 240; // Adjust this value as needed
  
  jQuery(".footer-col:nth-child(4) .footer-info-list").each(function() {
    if (jQuery(this).height() > maxHeight) {
      jQuery(this).css('height', maxHeight + 'px').css('overflow-y', 'hidden');
      jQuery(this).after('<div class="show-more">Show More</div>');
    }
  });

  jQuery(".footer-col:nth-child(4) .show-more").click(function(){
    var $content = jQuery(this).prev(".footer-info-list");
    var currentHeight = $content.height();

    if (currentHeight <= maxHeight) {
      $content.css('height', 'auto').css('overflow-y', 'visible');
      jQuery(this).text('Show Less');
    } else {
      $content.css('height', maxHeight + 'px').css('overflow-y', 'hidden');
      jQuery(this).text('Show More');
    }
  });
});
</script>



https://codepen.io/daveredfern/pen/zBGBJV : Change background colour with fade animation as you scroll

<!--- On click Menu Jump to tab JS --->
<script type="text/javascript">
jQuery(document).ready(function($) {
    console.log("Document ready function executed");
    function activateTab(tabID) {
        jQuery('.et_pb_tab').removeClass('et_pb_active_content et-pb-active-slide');

        jQuery('#' + tabID).closest('.et_pb_tab').addClass('et_pb_active_content et-pb-active-slide');

        jQuery('.et_pb_tabs_controls li').removeClass('et_pb_tab_active');

        // Find the index of the active content tab
        var activeTabIndex = jQuery('.et_pb_tab').index(jQuery('.et_pb_active_content'));

        jQuery('.et_pb_tabs_controls li').eq(activeTabIndex).addClass('et_pb_tab_active');
    }
    if (window.location.hash) {
        var tabID = window.location.hash.substring(1); // Get the tab ID from the URL
        console.log("Tab ID:", tabID);
        activateTab(tabID);
    }
    window.addEventListener('hashchange', function() {
        if (window.location.hash) {
            var tabID = window.location.hash.substring(1); // Get the tab ID from the URL
            console.log("Tab ID:", tabID);
            activateTab(tabID);
        }
        window.location.href = window.location.href;
    });
});
</script>
<!--- On click Menu Jump to tab JS --->

<!-- Select dropdown QTY code -->
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    var selectDropdown = document.getElementById("quantity-select");
    var hiddenInput = document.querySelector(".quantity__input");

    selectDropdown.addEventListener("change", function() {
        hiddenInput.value = this.value;
        hiddenInput.dispatchEvent(new Event('change'));
    });
});
</script>


<!-- Toggle Div Next -->
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.action_container button').click(function() {
        var dropdownContainer = jQuery(this).next('.twoline_button');
        if (dropdownContainer.is(':visible')) {
            dropdownContainer.slideUp();
            jQuery(this).removeClass('active');
        } else {
            jQuery('.twoline_button').slideUp();
            jQuery('.action_container button').removeClass('active');
            jQuery(this).addClass('active');
            dropdownContainer.slideDown();
        }
    });
});
</script>
<!-- Toggle Div Next -->