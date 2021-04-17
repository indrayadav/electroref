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

<section id="breadcrumb-nf">
	<div class="container">
	<h1><?php echo get_the_title(); ?></h1>
		<?php
			if ( function_exists( 'electoreftech_breadcrumbs' ) ) {
				electoreftech_breadcrumbs();
			}
			?>
	</div>
</section>

<section id="detail-page">
	<div class="container">
		<h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'electoreftech' ); ?></h2>
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'electoreftech' ); ?></p>
	</div>
</section>  


<?php
get_footer();
