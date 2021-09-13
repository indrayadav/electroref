(function ($) {

    "use strict";
    
    var electroref_params = window.electroref_params;

    $(document).ready(function() {

        $("#filter_prod_brand").data("placeholder","Select Brand").chosen();
    
        $("#filter_sort_product").data("placeholder","Sort product").chosen();

        // $('input[type=checkbox][name=prod_cat]').change(function() {
        //     if ($(this).prop("checked")) {
        //         $('#filter_prod_cat').val( $(this).val );
        //     }
        //     else {
        //         $('#filter_prod_cat').val( '' );
        //     }
        //     alert($(this).val);
        //     filter_results();
            
        // });

        // $('.filter_option_cat label').on('click', function (event) {
        //    // event.preventDefault();    
        //    var ele = $(this).closest('.list-group-item').find('input');  
        //    $(this).closest('.filter_option_cat').find('.list-group-item input').each(function() {
        //     $(this).attr('checked', false);
        //    }); 
            

        //     if(ele.is(':checked')){
        //         $('#filter_prod_cat').val( '' );
        //     }else{
        //         $('#filter_prod_cat').val( ele.val() );
        //     }
        //     filter_results();

        // });

        $('.filter_option_cat label').on('click', function (event) {
            var group = "input:checkbox[name='"+$(this).attr("name")+"']";
            $(group).attr("checked",false);
            $(this).attr("checked",true);
            filter_results();
        });

        FB.init({
            appId: 220198652759638,
            status: true,
            cookie: true,
            xfbml: true
        });
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

    // Main search form
    $("#main_search_form").on("click", "span.input-group-addon", function() {
        $( "#main_search_form" ).submit();
    });

    // Add to wishlist
    $(".wishcompareicon").on("click", "a.watchlist", function() {
        var veiw_wrap = $(this).closest('.wishcompareicon');
        var post_id = veiw_wrap.find('.post_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: electroref_params.admin_ajax_url,
            data: {
                'action': 'electoreftech_save_wishlist',
                'post_id': post_id,
            },
            success: function(data) {                
                veiw_wrap.find('a.watchlist').html(data.message);
                $('.watch_total').html(data.my_total_wishlist);
                return false;
            }
        });

        return false;
    });

    // Add to wishlist single page
    $(".share-product").on("click", ".wishlistprodiocn a", function() {

        var veiw_wrap = $(this).closest('.share-product');
        var post_id = veiw_wrap.find('.post_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: electroref_params.admin_ajax_url,
            data: {
                'action': 'electoreftech_save_wishlist',
                'post_id': post_id,
                'page': 'single',
            },
            success: function(data) {                
                veiw_wrap.find('.wishlistprodiocn a').html(data.message + data.txt);
                $('.watch_total').html(data.my_total_wishlist);
                return false;
            }
        });

        return false;
    });

    // Add to Compare list (general)
    $(".wishcompareicon").on("click", "a.comparelist", function() {
        var veiw_wrap = $(this).closest('.wishcompareicon');
        var post_id = veiw_wrap.find('.post_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: electroref_params.admin_ajax_url,
            data: {
                'action': 'electoreftech_save_comparelist',
                'post_id': post_id,
            },
            success: function(data) {                
                veiw_wrap.find('a.comparelist').html(data.message);
                $('.compare_total').html(data.my_total_compare);
                return false;
            }
        });

        return false;
    });

        // Add to Compare list (compare list page )
        $(".compare_delete").on("click", "a", function() {
            var veiw_wrap = $(this).closest('.compare_delete');
            var post_id = veiw_wrap.find('.post_id').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: electroref_params.admin_ajax_url,
                data: {
                    'action': 'electoreftech_save_comparelist',
                    'post_id': post_id,
                },
                success: function(data) {                
                    location.reload();
                    return false;
                }
            });
    
            return false;
        });

    // Choose rating
    $(".choose_rating").on("click", "ul li a", function() {
        var veiw_wrap = $(this).closest('.choose_rating');
        var rating = $(this).attr( "title" ); 
        $('#post_rating').val(rating);
        veiw_wrap.find( "ul li a i" ).each(function( index ) {
            index = index + 1;
            $( this ).removeClass('fa-star');
            $( this ).removeClass('fa-star-o');

            if(index <= rating){
                $( this ).addClass('fa-star');  
            } else{
                $( this ).addClass('fa-star-o');
            }
          });

    });    

    // Toggle Nav
    $(".cate_lists").on("click", "span.btn_toggle a", function() {
        var veiw_wrap = $(this).closest('.cate_lists');
        veiw_wrap.find('.electroref_toggle_wrap li:hidden').slice(0, 5).show('slow');
        if (veiw_wrap.find('.electroref_toggle_wrap li').length == veiw_wrap.find('.electroref_toggle_wrap li:visible').length) {
            $(this).hide();
        }
    });

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


    // Add product review
    $("#frm_review").validate({
        rules: {
            review: {
                required: true
            },
        },
        messages: {
            review: {
                required: "Review must be filled.",
            },
        },
        submitHandler: function() {
            var review = ($('textarea#review').length) ? $('textarea#review').val() : '';
            var post_id = ($('#post_id').length) ? $('#post_id').val() : '';
            var post_rating = ($('#post_rating').length) ? $('#post_rating').val() : '';

            $.ajax({
                type: "POST",
                dataType: "json",
                url: electroref_params.admin_ajax_url,
                data: {
                    'action': 'electoreftech_save_review',
                    'review': review,
                    'post_id': post_id,
                    'post_rating': post_rating
                },

                success: function(data) {
                    $('#review_sent_msg').html(data.msg);
                    $('#review_sent_msg').removeClass('alert-warning');
                    $('#review_sent_msg').addClass('alert-success');
                    $('#review_sent_msg').addClass('alert');
                    $('#review_sent_msg').css('margin-top', '20px');
                    $('#frm_review')[0].reset();
                    return false;
                }
            });

            return false;
        }

    });
    
    // Request Product Quote Form
    $("#booknowModal").on("click", ".btn_request_quote", function() {
        var cust_name = ($('#cust_name').length) ? $('#cust_name').val() : '';
        var cust_email = ($('#cust_email').length) ? $('#cust_email').val() : '';
        var cust_phone = ($('#cust_phone').length) ? $('#cust_phone').val() : '';
        var product_id = ($('#product_id').length) ? $('#product_id').val() : '';
        var cust_msg = ($('textarea#cust_msg').length) ? $('textarea#cust_msg').val() : '';

        $.ajax({
            type: "POST",
            dataType: "json",
            url: electroref_params.admin_ajax_url,
            data: {
                'action': 'electoreftech_request_quote',
                'cust_name': cust_name,
                'cust_email': cust_email,
                'cust_phone': cust_phone,
                'cust_msg': cust_msg,
                'product_id': product_id
            },

            success: function(data) {
                $('#request_sent_msg').html(data.msg);
                $('#request_sent_msg').removeClass('alert-warning');
                $('#request_sent_msg').addClass('alert-success');
                $('#request_sent_msg').addClass('alert');
                $('#request_sent_msg').css('margin-top', '20px');
                if(data.status == 'success'){
                    $('#frm_request_quote')[0].reset();
                }
                
                return false;
            }
        });

        return false;
    });


    $(document).ready(function() {
        $(".set > a").on("click", function() {
          if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
              .siblings(".content")
              .slideUp(200);
            $(".set > a i")
              .removeClass("fa-minus")
              .addClass("fa-plus");
          } else {
            $(".set > a i")
              .removeClass("fa-minus")
              .addClass("fa-plus");
            $(this)
              .find("i")
              .removeClass("fa-plus")
              .addClass("fa-minus");
            $(".set > a").removeClass("active");
            $(this).addClass("active");
            $(".content").slideUp(200);
            $(this)
              .siblings(".content")
              .slideDown(200);
          }
        });

        if ($(".ch_open").length > 0) {
             $('.ch_open').click();
        }
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
