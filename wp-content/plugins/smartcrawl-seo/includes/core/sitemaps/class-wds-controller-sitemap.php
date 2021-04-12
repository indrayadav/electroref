<?php

class Smartcrawl_Controller_Sitemap extends Smartcrawl_Base_Controller {

	private static $_instance;

	public static function get() {
		if ( empty( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function should_run() {
		return Smartcrawl_Settings::get_setting( 'sitemap' )
		       && smartcrawl_is_allowed_tab( Smartcrawl_Settings::TAB_SITEMAP );
	}

	protected function init() {
		add_action( 'wp_ajax_wds_update_sitemap', array( $this, 'json_update_sitemap' ) );
		add_action( 'wp_ajax_wds_update_engines', array( $this, 'json_update_engines' ) );

		add_action( 'wp_ajax_wds-sitemap-add_extra', array( $this, 'json_add_sitemap_extra' ) );
		add_action( 'wp_ajax_wds-get-sitemap-report', array( $this, 'json_get_sitemap_report' ) );

		add_action( 'wp_ajax_wds-manually-update-engines', array( $this, 'json_manually_update_engines' ) );
		add_action( 'wp_ajax_wds-manually-update-sitemap', array( $this, 'json_manually_update_sitemap' ) );
		add_action( 'wp_ajax_wds-deactivate-sitemap-module', array( $this, 'json_deactivate_sitemap_module' ) );
		add_action( 'wp_ajax_wds-override-native', array( $this, 'json_override_native' ) );

		add_action( 'admin_init', array( $this, 'prime_cache_on_sitemap_settings_page_load' ) );

		add_action( 'update_option_wds_sitemap_options', array( $this, 'invalidate_sitemap_cache' ) );
		add_action( 'update_site_option_wds_sitemap_options', array( $this, 'invalidate_sitemap_cache' ) );

		if ( Smartcrawl_Sitemap_Utils::auto_regeneration_enabled() ) {
			add_action( 'save_post', array( $this, 'handle_post_save' ) );
			add_action( 'delete_post', array( $this, 'handle_post_delete' ) );
			add_action( 'wp_update_term_data', array( $this, 'handle_term_slug_update' ), 10, 3 );
			add_action( 'pre_delete_term', array( $this, 'handle_term_deletion' ), 10, 2 );
		}
	}

	public function prime_cache_on_sitemap_settings_page_load() {
		global $plugin_page;

		$is_sitemap_page = isset( $plugin_page ) && Smartcrawl_Settings::TAB_SITEMAP === $plugin_page;
		if ( ! $is_sitemap_page ) {
			return;
		}

		if ( Smartcrawl_Sitemap_Cache::get()->is_index_cached() ) {
			return;
		}

		Smartcrawl_Sitemap_Utils::prime_cache( false );
	}

	public function json_get_sitemap_report() {
		$result = array(
			'success' => false,
		);
		$data = $this->get_request_data();
		$open_type = isset( $data['open_type'] ) ? sanitize_text_field( $data['open_type'] ) : null;
		$ignored_tab_open = empty( $data['ignored_tab_open'] ) ? false : $data['ignored_tab_open'];

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json( $result );

			return;
		}

		$seo_service = Smartcrawl_Service::get( Smartcrawl_Service::SERVICE_SEO );
		$crawl_report = $seo_service->get_report();
		$result['summary_markup'] = Smartcrawl_Simple_Renderer::load( 'sitemap/sitemap-crawl-stats', array(
			'crawl_report'    => $crawl_report,
			'override_native' => Smartcrawl_Sitemap_Utils::override_native(),
		) );
		$result['markup'] = Smartcrawl_Simple_Renderer::load( 'sitemap/sitemap-crawl-content', array(
			'crawl_report'     => $crawl_report,
			'open_type'        => $open_type,
			'ignored_tab_open' => $ignored_tab_open,
		) );
		$result['success'] = true;

		wp_send_json( $result );
	}

	/**
	 * Adds extra item to sitemap processing
	 */
	public function json_add_sitemap_extra() {
		$result = array( 'status' => 0 );
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json( $result );

			return;
		}

		$data = $this->get_request_data();
		if ( empty( $data['path'] ) ) {
			wp_send_json( $result );

			return;
		}

		$path = $data['path'];
		$paths = is_array( $path )
			? array_map( 'sanitize_text_field', (array) $path )
			: array( sanitize_text_field( $path ) );
		if ( ! is_array( $paths ) ) {
			$paths = array();
		}

		$extras = Smartcrawl_Sitemap_Utils::get_extra_urls();
		foreach ( $paths as $current_path ) {
			$index = array_search( $current_path, $extras, true );
			if ( false === $index ) {
				$extras[] = esc_url( $current_path );
			}
		}
		Smartcrawl_Sitemap_Utils::set_extra_urls( $extras );

		// Update sitemap
		$this->invalidate_sitemap_cache();

		$result['status'] = 1;
		$result['add_all_message'] = Smartcrawl_Simple_Renderer::load( 'dismissable-notice', array(
			'message' => __( 'The missing items have been added to your sitemap as extra URLs.', 'wds' ),
			'class'   => 'sui-notice-info',
		) );

		wp_send_json( $result );
	}

	public function json_manually_update_engines() {
		Smartcrawl_Sitemap_Utils::notify_engines( true );
	}

	public function json_manually_update_sitemap() {
		$this->invalidate_sitemap_cache();
	}

	public function json_deactivate_sitemap_module() {
		$data = $this->get_request_data();
		if ( empty( $data ) ) {
			wp_send_json_error();
			return;
		}

		Smartcrawl_Settings::deactivate_component( 'sitemap' );
		wp_send_json_success();
	}

	public function json_override_native() {
		$data = $this->get_request_data();
		$override = smartcrawl_get_array_value( $data, 'override' );

		if ( is_null( $override ) ) {
			wp_send_json_error();
			return;
		}

		Smartcrawl_Sitemap_Utils::set_sitemap_option( 'override-native', (boolean) $override );
		wp_send_json_success();
	}

	/**
	 * Invalidates sitemap cache.
	 *
	 * This is so the next sitemap request re-generates the caches.
	 * Serves as performance improvement for post-based action listeners.
	 *
	 * On setups with large posts table, fully regenerating sitemap can take a
	 * while. So instead, we just invalidate the cache and potentially ping the
	 * search engines to notify them about the change.
	 *
	 * @param $post_id
	 */
	public function handle_post_save( $post_id ) {
		$post = get_post( $post_id );
		if (
			! Smartcrawl_Sitemap_Utils::is_post_type_included( $post->post_type )
			|| wp_is_post_autosave( $post )
			|| wp_is_post_autosave( $post )
		) {
			return;
		}

		$this->invalidate_sitemap_cache();

		// Also notify engines of changes.
		// Do *not* forcefully do so, respect settings.
		Smartcrawl_Sitemap_Utils::notify_engines();
	}

	public function handle_post_delete( $post_id ) {
		if ( ! Smartcrawl_Sitemap_Utils::is_post_included( get_post( $post_id ) ) ) {
			return;
		}

		$this->invalidate_sitemap_cache();
		Smartcrawl_Sitemap_Utils::notify_engines();
	}

	public function handle_term_slug_update( $data, $term_id, $taxonomy ) {
		$term = get_term( $term_id, $taxonomy );
		$new_slug = smartcrawl_get_array_value( $data, 'slug' );
		$taxonomy_included = Smartcrawl_Sitemap_Utils::is_taxonomy_included( $taxonomy );

		if ( $taxonomy_included && ! empty( $term->count ) && $new_slug !== $term->slug ) {
			$this->invalidate_sitemap_cache();
			Smartcrawl_Sitemap_Utils::notify_engines();
		}

		return $data;
	}

	public function handle_term_deletion( $term_id, $taxonomy ) {
		$term = get_term( $term_id, $taxonomy );
		if ( is_wp_error( $term ) ) {
			return;
		}

		if ( ! Smartcrawl_Sitemap_Utils::is_term_included( $term ) ) {
			return;
		}

		$this->invalidate_sitemap_cache();
		Smartcrawl_Sitemap_Utils::notify_engines();
	}

	public function json_update_sitemap() {
		$this->invalidate_sitemap_cache();
		Smartcrawl_Sitemap_Utils::prime_cache( true );
		die( 1 );
	}

	public function json_update_engines() {
		Smartcrawl_Sitemap_Utils::notify_engines( 1 );
		die( 1 );
	}

	private function get_request_data() {
		return isset( $_POST['_wds_nonce'] ) && wp_verify_nonce( $_POST['_wds_nonce'], 'wds-nonce' ) ? stripslashes_deep( $_POST ) : array();
	}

	public function invalidate_sitemap_cache() {
		Smartcrawl_Sitemap_Cache::get()->invalidate();
	}
}
