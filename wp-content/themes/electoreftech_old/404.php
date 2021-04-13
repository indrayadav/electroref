<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Electoreftech
 */

get_header();
?>
        <div class="breadcrumb-banner-area ptb-120 bg-opacity" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/bg/6.jpg)">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="breadcrumb-text text-center">
						<h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'electoreftech' ); ?></h2>
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

		<div class="Our-Services-area pt-120 pb-65">
			<div class="container">
				<div class="section-info text-center mb-60">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'electoreftech' ); ?></p>
				</div>
			</div>
		</div>

<?php
get_footer();
