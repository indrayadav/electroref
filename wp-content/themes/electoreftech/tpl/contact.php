<?php 
/* Template Name: Contact ss
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electoreftech
 */

get_header();

while ( have_posts() ) :
	the_post();

	$banner_img = get_template_directory_uri(). '/img/page_banner.jpg';
	$electroref_page_banner = get_post_meta(get_the_ID(), 'electroref_page_banner', true);

	if(isset($electroref_page_banner) && !empty($electroref_page_banner)){
		$banner_img = $electroref_page_banner;
	}
 ?>

        <div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo $banner_img; ?>)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text text-center">
						<h2><?php echo get_the_title(); ?></h2>
							<?php 
							if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
								electoreftech_breadcrumbs();
							}
							?>
						</div>
					</div>
				</div>
			</div>
        </div>
        
        <div class="contact-3-area contact-2 contact-3 pt-120 pb-50">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<div class="contact-wrapper-3 mb-30">
							<div class="contact-3-text">
								<h3>Leave Us a Message</h3>
								<p>If you have any queries, please contact us on detail below :</p>
							</div>
							<?php echo do_shortcode('[contact-form-7 id="150" title="Contact form 1"]');?>
							<p class="form-message"></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="contact-3-right-wrapper mb-30">
							<div class="contact-3-right-info">
								<h3>Show Room </h3>
								
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-pin"></i>
								</div>
								<div class="address-text">
									<span class="location">Address</span>
									<span class="USA">
Opposite to Hanumansthan Temple, Kupondole, Lalitpur,Nepal</span>
								</div>
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-phone"></i>
								</div>
								<div class="address-text">
									<span class="location">phone :</span>
									<span class="USA">01-5260961, 981-8776832</span>
								</div>
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-email"></i>
								</div>
								<div class="address-text">
									<span class="location">mail :</span>
									<span class="USA">electroref.tech@gmail.com</span>
								</div>
							</div>


					</div>
                    <div class="contact-3-right-wrapper mt-3 mb-30">
							<div class="contact-3-right-info">
								<h3>Service Center</h3>
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-pin"></i>
								</div>
								<div class="address-text">
									<span class="location">Address :</span>
									<span class="USA">Near Sarwanga Hospital
Kupondole, Lalitpur,Nepal</span>
								</div>
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-phone"></i>
								</div>
								<div class="address-text">
									<span class="location">phone :</span>
									<span class="USA">01-5180257, 981-8776832</span>
								</div>
							</div>
							<div class="contact-3-address">
								<div class="contact-3-icon">
									<i class="zmdi zmdi-email"></i>
								</div>
								<div class="address-text">
									<span class="location">mail :</span>
									<span class="USA">electroref.tech@gmail.com</span>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>

				<!-- map-area -->
				<div class="map-area pb-120">
			<div class="container">
				<style>
					#map_wrapper {
						height: 400px;
					}

					#map_canvas {
						width: 100%;
						height: 100%;
					}
					</style>
				<div id="map_wrapper">
					<div id="map_canvas" class="mapping"></div>
				</div>

				<script>
					jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "//maps.googleapis.com/maps/api/js?sensor=false&callback=initialize&key=AIzaSyCwHYuL2hs0CzlpOWXlime6VyGlomHmeDw";
    document.body.appendChild(script);
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    map.setTilt(45);
        
    // Multiple Markers
    var markers = [
        ['Electro-Ref Tech Showroom', 27.688321,85.316220, 'pin.png'],
        ['Electro-Ref Tech Service Center', 27.686269,85.315495, 'pin.png']
    ];
                        
    // Info Window Content
    var infoWindowContent = [
      
        ['<div class="info_content">' +
        '<div class="bg-white"> <a href="javascript:void(0)" class="close-map-popup"></a><figure class="pop-map-img mb-0" style="background:url(https://electroreftech.com/wp-content/uploads/2020/03/new-shop-150x150.jpg) center center ;height:100%; background-size: cover; "><img class="img-reponsive" style="opacity: 0;" src="https://electroreftech.com/wp-content/uploads/2020/03/new-shop-150x150.jpg"></figure><div class="pop-map-content"> <h3><a href="https://g.page/electroref-tech?share" target="_blank">Electro-Ref Tech <br />Show Room</a></h3><p>Opposite to Hanuman Than <br />  Temple, Kupondole, <br />  Lalitpur, Nepal</p><ul class="d-flex item-items"><li><i class="icon icon-room"></i><span>Tel. : 01-5260961, 981-8776832</span></li></ul>                    </div>                    <a href="javascript:void(0)" class="map-thumbnail" link=""></a></div>' +
        '</div>'],
		[ '<div class="info_content">' +
        '<div class="bg-white"> <a href="javascript:void(0)" class="close-map-popup"></a><figure class="pop-map-img mb-0" style="background:url(https://electroreftech.com/wp-content/uploads/2020/05/electro-ref-tech-service-center-150x150.jpg) center center ;height:100%; background-size: cover; "><img class="img-reponsive" style="opacity: 0;" src="https://electroreftech.com/wp-content/uploads/2020/05/electro-ref-tech-service-center-150x150.jpg"></figure><div class="pop-map-content"> <h3><a href="https://goo.gl/maps/iYPxgfH41EnXPciW6" target="_blank">Electro-Ref Tech <br />Service Center</a></h3><p>Near Sarvanga Hospital <br /> Kupondole, Lalitpur, Nepal</p><ul class="d-flex item-items"><li><i class="icon icon-room"></i><span>Tel. : 01-5260961, 981-8776832</span></li></ul>                    </div>                    <a href="javascript:void(0)" class="map-thumbnail" link=""></a></div>' +
        '</div>']
    ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: 'https://electroreftech.com/wp-content/themes/electoreftech/img/'+ markers[i][3],
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
    }

    // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(16);
        google.maps.event.removeListener(boundsListener);
    });
    
}
				</script>
			</div>
		</div>
		<!-- map-end -->

<?php 
endwhile; // End of the loop.
get_footer();
