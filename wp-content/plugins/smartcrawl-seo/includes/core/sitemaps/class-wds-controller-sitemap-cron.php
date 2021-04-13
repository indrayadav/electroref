<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Smartcrawl_Controller_Sitemap_Cron extends Smartcrawl_Base_Controller {
	const WEEKLY = 'wds-weekly';
	const EVENT_HOOK = 'wds_weekly_sitemap_check_hook';

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
		add_filter( 'cron_schedules', array( $this, 'add_weekly_schedule' ) );
		add_action( 'admin_init', array( $this, 'schedule_sitemap_check_event' ) );
		add_action( self::EVENT_HOOK, array( $this, 'maybe_split_sitemap' ) );
	}

	public function add_weekly_schedule( $schedules ) {
		if ( ! is_array( $schedules ) ) {
			$schedules = array();
		}

		$schedules[ self::WEEKLY ] = array(
			'interval' => 604800,
			'display'  => esc_html__( 'SmartCrawl Weekly', 'wds' ),
		);
		return $schedules;
	}

	public function schedule_sitemap_check_event() {
		if ( ! wp_next_scheduled( self::EVENT_HOOK ) ) {
			wp_schedule_event( time(), self::WEEKLY, self::EVENT_HOOK );
		}
	}

	public function maybe_split_sitemap() {
		if ( Smartcrawl_Sitemap_Utils::split_sitemaps_enabled() ) {
			return; // Nothing to do
		}

		$query = new Smartcrawl_Sitemap_Posts_Query();
		$post_count = $query->get_item_count();
		if ( $post_count > SMARTCRAWL_SITEMAP_POST_LIMIT ) {
			// Do split
			Smartcrawl_Sitemap_Utils::set_split_sitemap( true );
			Smartcrawl_Sitemap_Utils::set_sitemap_option( 'sitemap-split-automatically', true );
			Smartcrawl_Sitemap_Utils::set_sitemap_option( 'sitemap-post-count', $post_count );

			// Invalidate and prime the cache
			Smartcrawl_Sitemap_Cache::get()->invalidate();
			Smartcrawl_Sitemap_Utils::prime_cache( false );
		}
	}

	public static function unschedule_event() {
		$event = self::EVENT_HOOK;
		$next_timestamp = wp_next_scheduled( $event );
		if ( empty( $next_timestamp ) ) {
			return;
		}

		wp_unschedule_event( $next_timestamp, $event );
	}
}
