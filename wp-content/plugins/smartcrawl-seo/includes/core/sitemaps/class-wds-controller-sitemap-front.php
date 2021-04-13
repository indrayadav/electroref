<?php

class Smartcrawl_Controller_Sitemap_Front extends Smartcrawl_Base_Controller {
	const SITEMAP_TYPE_INDEX = 'index';
	const SITEMAP_REWRITE_RULES_FLUSHED = 'wds-sitemap-rewrite-rules-flushed';

	/**
	 * @var Smartcrawl_Sitemap_Builder
	 */
	private $builder;

	private static $_instance;

	public static function get() {
		if ( empty( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function sitemap_enabled() {
		return Smartcrawl_Settings::get_setting( 'sitemap' )
		       && smartcrawl_is_allowed_tab( Smartcrawl_Settings::TAB_SITEMAP );
	}

	public function __construct() {
		$this->builder = new Smartcrawl_Sitemap_Builder();
	}

	protected function init() {
		add_action( 'init', array( $this, 'add_rewrites' ) );
		add_action( 'wp', array( $this, 'serve_sitemap' ), 999 );
		add_action( 'wp_sitemaps_enabled', array( $this, 'maybe_disable_native_sitemap' ) );

		return true;
	}

	public function maybe_disable_native_sitemap( $is_enabled ) {
		if ( Smartcrawl_Sitemap_Utils::override_native() ) {
			return false;
		}

		return $is_enabled;
	}

	public function add_rewrites() {
		/**
		 * @var $wp \WP
		 */
		global $wp;

		$wp->add_query_var( 'wds_sitemap' );
		$wp->add_query_var( 'wds_sitemap_type' );
		$wp->add_query_var( 'wds_sitemap_page' );
		$wp->add_query_var( 'wds_sitemap_gzip' );

		add_rewrite_rule( 'sitemap\.xml(\.gz)?$', 'index.php?wds_sitemap=1&wds_sitemap_type=index&wds_sitemap_gzip=$matches[1]', 'top' );
		add_rewrite_rule( '([^/]+?)-sitemap([0-9]+)?\.xml(\.gz)?$', 'index.php?wds_sitemap=1&wds_sitemap_type=$matches[1]&wds_sitemap_page=$matches[2]&wds_sitemap_gzip=$matches[3]', 'top' );

		$this->maybe_flush_rewrite_rules();
	}

	public function serve_sitemap() {
		if ( ! $this->is_sitemap_query() ) {
			return;
		}

		$native_available = Smartcrawl_Sitemap_Utils::native_sitemap_available();
		if ( ! $this->sitemap_enabled() ) {
			$this->maybe_redirect_to_native( $native_available );
			return;
		}

		$override_native = Smartcrawl_Sitemap_Utils::override_native();
		if ( ! $override_native && $native_available ) {
			$this->redirect_to_native();
			return;
		}

		$sitemap_type = $this->get_sitemap_type_var();
		$sitemap_page = $this->get_sitemap_page_var();

		$sitemap_cache = Smartcrawl_Sitemap_Cache::get();
		$cached = $sitemap_cache->get_cached( $sitemap_type, $sitemap_page );

		if ( ! empty( $cached ) ) {
			$this->output_xml( $cached );
			return;
		}

		// We're potentially about to do some heavy lifting so let's increase the time limit
		Smartcrawl_Sitemap_Utils::set_time_limit( 120 );

		do_action( 'wds_before_sitemap_rebuild' );

		if ( Smartcrawl_Sitemap_Utils::split_sitemaps_enabled() ) {
			if ( $sitemap_type === self::SITEMAP_TYPE_INDEX ) {
				$xml = $this->build_index();
			} else {
				$xml = $this->build_partial_sitemap( $sitemap_type, $sitemap_page );
			}
		} else {
			$xml = $this->build_complete_sitemap();
		}

		if ( ! $xml ) {
			$this->maybe_redirect_to_native( $native_available );
			return;
		}

		$sitemap_cache->set_cached( $sitemap_type, $sitemap_page, $xml );
		$this->output_xml( $xml );
	}

	private function maybe_redirect_to_native( $native_available ) {
		if ( $native_available ) {
			$this->redirect_to_native();
		} else {
			$this->do_404();
		}
	}

	private function redirect_to_native() {
		/**
		 * @var $wp_sitemaps WP_Sitemaps
		 */
		global $wp_sitemaps;

		wp_safe_redirect( $wp_sitemaps->index->get_index_url() );
	}

	private function build_partial_sitemap( $type, $page ) {
		$items = array();
		if ( $type === 'post' && $page === 1 ) {
			$items[] = $this->make_home_page_item();
		}

		foreach ( $this->get_queries() as $query ) {
			if ( $query->can_handle_type( $type ) ) {
				$items = array_merge(
					$items,
					$query->get_items( $type, $page )
				);
				break;
			}
		}

		$items = apply_filters( 'wds_partial_sitemap_items', $items, $type, $page );

		if ( empty( $items ) ) {
			return false;
		}

		return $this->builder->build( $items );
	}

	private function build_complete_sitemap() {
		$items = array( $this->make_home_page_item() );

		foreach ( $this->get_queries() as $query ) {
			$items = array_merge(
				$items,
				$query->get_items()
			);
		}

		$items = apply_filters( 'wds_full_sitemap_items', $items );

		if ( empty( $items ) ) {
			return false;
		}

		$this->post_process( $items );

		return $this->builder->build( $items );
	}

	private function build_index() {
		$index_items = array();

		foreach ( $this->get_queries() as $query ) {
			$index_items = array_merge(
				$index_items,
				$query->get_index_items()
			);
		}

		if ( empty( $index_items ) ) {
			return false;
		}

		$this->post_process( $index_items );

		return $this->builder->build_index( $index_items );
	}

	private function output_xml( $xml ) {
		if ( ! headers_sent() ) {
			status_header( 200 );
			// Prevent the search engines from indexing the XML Sitemap.
			header( 'X-Robots-Tag: noindex, follow', true );
			header( 'Content-Type: text/xml; charset=UTF-8' );

			if ( $this->is_gzip_request() && $this->is_gzip_supported() ) {
				header( 'Content-Encoding: gzip' );
				$xml = gzencode( $xml );
			}
			die( $xml );
		}
	}

	private function is_gzip_supported() {
		$accepted = (string) smartcrawl_get_array_value( $_SERVER, 'HTTP_ACCEPT_ENCODING' );
		return stripos( $accepted, 'gzip' ) !== false;
	}

	private function is_sitemap_query() {
		return (boolean) get_query_var( 'wds_sitemap' );
	}

	private function get_sitemap_type_var() {
		return (string) get_query_var( 'wds_sitemap_type' );
	}

	private function get_sitemap_page_var() {
		return (int) get_query_var( 'wds_sitemap_page' );
	}

	private function is_gzip_request() {
		$query_var = get_query_var( 'wds_sitemap_gzip' );
		return ! empty( $query_var );
	}

	/**
	 * @return Smartcrawl_Sitemap_Query[]
	 */
	private function get_queries() {
		$queries = array(
			new Smartcrawl_Sitemap_Posts_Query(),
			new Smartcrawl_Sitemap_Terms_Query(),
			new Smartcrawl_Sitemap_BP_Groups_Query(),
			new Smartcrawl_Sitemap_BP_Profile_Query(),
			new Smartcrawl_Sitemap_Extras_Query(),
		);

		return $queries;
	}

	private function do_404() {
		global $wp_query;

		$wp_query->set_404();
		status_header( 404 );
	}

	private function post_process( $items ) {
		do_action( 'wds_sitemap_created' );
		Smartcrawl_Sitemap_Utils::notify_engines();
		Smartcrawl_Sitemap_Utils::update_meta_data( count( $items ) );
	}

	private function make_home_page_item() {
		$item = new Smartcrawl_Sitemap_Item();
		$item->set_location( home_url( '/' ) )
		     ->set_priority( 1 )
		     ->set_change_frequency( Smartcrawl_Sitemap_Item::FREQ_DAILY );

		return $item;
	}

	protected function maybe_flush_rewrite_rules() {
		$flushed = get_option( self::SITEMAP_REWRITE_RULES_FLUSHED, false );
		if ( $flushed !== SMARTCRAWL_VERSION ) {
			flush_rewrite_rules();
			update_option( self::SITEMAP_REWRITE_RULES_FLUSHED, SMARTCRAWL_VERSION );
		}
	}
}
