(function ($) {

"use strict";

var electroref_params = window.electroref_params;


$(document).ready(function() {

    $("#filter_prod_brand").data("placeholder","Select Brand").chosen();

    $("#filter_prod_cat").data("placeholder","Select Category").chosen();
    $("#filter_sort_product").data("placeholder","Sort product").chosen();
});

  $(window).on('scroll',function() {    

   var scroll = $(window).scrollTop();

   if (scroll < 245) {

    $("#header-sticky").removeClass("scroll-header");

   }else{

    $("#header-sticky").addClass("scroll-header");

   }

  });

  

/* meanmenu */

$('.main-menu nav').meanmenu({

	 meanMenuContainer: '.mobile-menu',

	 meanScreenWidth: "991"

 });







/* testimonial-active */

$('.testimonial-active').owlCarousel({

    loop:true,

    nav:false,

	dots:true,

    responsive:{

        0:{

            items:1

        },

        600:{

            items:1

        },

        992:{

            items:2

        },

        1200:{

            items:3

        }

    }

});

/* Home Product */

$('#home_products').owlCarousel({

    loop:true,

    nav:false,

	dots:true,
	autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,

    responsive:{

        0:{

            items:1

        },

        600:{

            items:1

        },

        992:{

            items:2

        },

        1200:{

            items:4

        }

    }

});


  // Owl Carousel Carousels
  $('#footer_brands').owlCarousel({
    loop:true,

    nav:false,

	dots:true,
	autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,

    responsive:{

        0:{

            items:2

        },

        600:{

            items:2

        },

        992:{

            items:4

        },

        1200:{

            items:6

        }

    }
    });


/* Scroll Up */

$.scrollUp({

	easingType: 'linear',

	scrollSpeed: 900,

	animation: 'fade',

	scrollText: '<i class="fa fa-angle-up"></i>',

});	







		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);
			e.preventDefault();
			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});
		
$("#home-slider").owlCarousel({
 
      //navigation : true, // Show next and prev buttons
         loop:true,
      slideSpeed : 300,
      paginationSpeed : 400,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
 
      items : 1, 
      itemsDesktop : false,
      itemsDesktopSmall : false,
      itemsTablet: false,
      itemsMobile : false,
      nav: true,
     dots: true,
 
  });

   /* Filter page price slider */

   if ($("#slide_filter_price").length > 0) {
    var slide_filter_price = document.getElementById('slide_filter_price');
    noUiSlider.create(slide_filter_price, {
        start: [electroref_params.min_price, electroref_params.max_price],
        connect: true,
        step: 1,
        range: {
            min: parseInt(electroref_params.slider_min_price),
            max: parseInt(electroref_params.slider_max_price)
        }

    });

    /* Trigger filter slide price */
    slide_filter_price.noUiSlider.on('change.one', function() {
        filter_results();
    });

    slide_filter_price.noUiSlider.on('update', function(values, handle) {
        values[handle] = parseInt(values[handle]);
        if (handle) {
            $('#filter_max_price').val(values[handle]);
        } else {
            $('#filter_min_price').val(values[handle]);
        }
    });

}


      /* Load More Ajax
    .......................................... */
    $("#btn_load_more").click(function() {
        filter_results('load_more');
    });

    $('#query').keyup(function(e){
        if(e.keyCode == 13)
        {
            filter_results()
        }
    });

  /*Filter Sort listing  */
   $("#text_search").click(function() {
        filter_results();
    });

    $('#filter_prod_cat').on("change", function() {
        filter_results();
    });

    $('#filter_prod_brand').on("change", function() {
        filter_results();
    });

    $('#filter_sort_product').on("change", function() {
        filter_results();
    });

    function filter_results(opt_mode = 'filter') {
        
        var search_param = '';

        $('#btn_load_more').html(electroref_params.loading_text);
        $('#btn_load_more').prop("disabled", true);

        if (opt_mode == 'filter') {
            $('#paged').val(2);
        }

        $('.pre-loader').show();

        var query = ($('#query').length) ? $('#query').val() : '';
        var filter_min_price = ($('#filter_min_price').length) ? $('#filter_min_price').val() : '';
        var filter_max_price = ($('#filter_max_price').length) ? $('#filter_max_price').val() : '';

        var posts_per_page = ($('#posts_per_page').length) ? $('#posts_per_page').val() : 6;
        var paged = ($('#paged').length) ? $('#paged').val() : 1;
        var filter_prod_cat = ($('#filter_prod_cat').length) ? $('#filter_prod_cat').val() : '';
        var filter_prod_brand = ($('#filter_prod_brand').length) ? $('#filter_prod_brand').val() : '';
        var filter_sort_product = ($('#filter_sort_product').length) ? $('#filter_sort_product').val() : '';

        if (filter_min_price != '') {
            search_param = search_param + '&min_price=' + filter_min_price;
        }

        if (filter_max_price != '') {
            search_param = search_param + '&max_price=' + filter_max_price;
        }

        if (filter_prod_cat != '') {
            search_param = search_param + '&prod_cat=' + filter_prod_cat;
        }

        if (filter_prod_brand != '') {
            search_param = search_param + '&prod_brand=' + filter_prod_brand;
        }

        if (filter_sort_product != '') {
            search_param = search_param + '&orderby=' + filter_sort_product;
        }

        if (query != '') {
            search_param = search_param + '&query=' + query;
        }

        // Add Push state to update url in browser 
        window.history.pushState("Eletroref", electroref_params.site_name, electroref_params.search_url + '?' + search_param);

        // ajax
        $.ajax({
            type: "POST",
            dataType: "json",
            url: electroref_params.admin_ajax_url,
            data: {
                'action': 'electro_filter_product',
                'filter_min_price': filter_min_price,
                'filter_max_price': filter_max_price,
                'filter_prod_cat': filter_prod_cat,
                'filter_prod_brand': filter_prod_brand,
                'posts_per_page': posts_per_page,
                'paged': paged,
                'filter_sort_product': filter_sort_product,
                'query': query,
                'opt_mode': opt_mode,

            },
            success: function(data) {

                if (opt_mode == 'load_more') {

                    if (data.content == '') {
                        $('#btn_load_more').html(electroref_params.no_more_content_text);
                    } else {
                        $('#listing_holder').append(data.content);
                        $('#paged').val(parseInt(paged) + 1);
                        $('#btn_load_more').html(data.load_more_text);
                    }

                } else {

                    if (data.content == '') {
                        $('#listing_holder').empty();
                    } else {
                        $('#listing_holder').html(data.content);
                    }

                    $('#paged').val('2');
                    $('#btn_load_more').html(data.load_more_text);
                    $('.product-result-count').html(data.total_record);

                }

                $('#btn_load_more').prop("disabled", false);
                $('.pre-loader').hide();
                return false;

            }
        });
        return false;
    
    }  

    $(document).ready(function() {
    FB.init({
        appId: 220198652759638,
        status: true,
        cookie: true,
        xfbml: true
    });

});


	
})(jQuery);	

function postToFeed(url, picture, fb_title, fb_description) {
    'use strict';

    var obj = {
        method: 'feed',
        link: url,
        picture: picture,
        name: fb_title,
        caption: fb_title,
        description: fb_description
    };

    function callback(response) {
        //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
    }
    FB.ui(obj, callback);
}

// Load the SDK Asynchronously
function fb_callout(fb_url, picture, name, description) {
    'use strict';

    postToFeed(fb_url, picture, name, description);
}

function share_on_twitter(share_url, share_text) {
    'use strict';

    var sharethis_url = "https://twitter.com/intent/tweet?url=" + share_url + "&text=" + share_text;
    window.open(sharethis_url, 'Twitter_share', 'width=650,height=530');
    return false;
}
function pin_it_now(p_url, image, share_text) {
    'use strict';

    var pin_url = 'http://pinterest.com/pin/create/button/?url=' + p_url + '&media=' + image + '&description=' + share_text;
    window.open(pin_url, 'Pin_Login', 'width=650,height=530');
    return false;
}
