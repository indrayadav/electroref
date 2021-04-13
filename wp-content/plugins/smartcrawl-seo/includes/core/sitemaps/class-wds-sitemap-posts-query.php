<?php

class Smartcrawl_Sitemap_Posts_Query extends Smartcrawl_Sitemap_Query {
	function get_items( $type = '', $page_number = 0 ) {
		$items = array();
		$posts = $this->fetch_full_data( $type, $page_number );
		foreach ( $posts as $post ) {
			$item = new Smartcrawl_Sitemap_Item();

			$item->set_location( $this->get_post_url( $post ) )
			     ->set_priority( $this->get_post_priority( $post ) )
			     ->set_change_frequency( Smartcrawl_Sitemap_Item::FREQ_WEEKLY )
			     ->set_last_modified( $this->get_post_modified_time( $post ) )
			     ->set_images( $this->get_post_images( $post ) );

			$items[] = $item;
		}

		return $items;
	}

	private function get_post_images( $post ) {
		if ( ! Smartcrawl_Sitemap_Utils::sitemap_images_enabled() ) {
			return array();
		}

		$thumbnail_id = get_post_thumbnail_id( $post->ID );
		$thumbnail_image = wp_get_attachment_image( $thumbnail_id, 'full' );

		$html = $thumbnail_image;
		if ( ! empty( $post->post_content ) ) {
			$html .= "\n" . $post->post_content;
		}

		return $this->find_images( $html );
	}

	private function get_post_url( $post ) {
		return ! empty( $post->canonical )
			? $post->canonical
			: get_permalink( $post->ID );
	}

	private function get_post_priority( $post ) {
		$default = $post->post_parent ? 0.6 : 0.8;
		$priority = ! empty( $post->sitemap_priority )
			? $post->sitemap_priority
			: $default;

		return apply_filters( 'wds-post-priority', $priority, $post );
	}

	private function get_post_modified_time( $post ) {
		return ! empty( $post->post_modified )
			? strtotime( $post->post_modified )
			: time();
	}

	public function get_filter_prefix() {
		return 'wds-sitemap-posts';
	}

	/**
	 * Returns post IDs whose canonical URLs are ignored. (Assumes that canonical URLs are absolute)
	 *
	 * @param $types
	 *
	 * @return array
	 */
	private function get_ignored_canonical_url_ids( $types ) {
		$ignore_urls = Smartcrawl_Sitemap_Utils::get_ignore_urls();
		if ( empty( $ignore_urls ) ) {
			return array();
		}
		/**
		 * On the sitemap settings page we are forcing ignore URLs to be relative.
		 * Let's convert them to absolute first.
		 */
		$absolute_urls = array_map( array( $this, 'absolute_url' ), $ignore_urls );
		$possible_canonicals = array_merge(
			array_map( 'untrailingslashit', $absolute_urls ),
			array_map( 'trailingslashit', $absolute_urls )
		);

		return get_posts( array(
			'fields'     => 'ids',
			'post_type'  => $types,
			'meta_query' => array(
				array(
					'key'     => '_wds_canonical',
					'value'   => join( ',', $possible_canonicals ),
					'compare' => 'IN',
				),
			),
		) );
	}

	private function absolute_url( $url ) {
		$url = trim( $url );

		$host = parse_url( home_url(), PHP_URL_HOST );
		if ( strpos( $url, $host ) === false ) {
			$url = home_url( $url );
		}

		return $url;
	}

	private function get_ignored_url_ids() {
		$ignore_urls = Smartcrawl_Sitemap_Utils::get_ignore_urls();
		$post_ids = array();

		foreach ( $ignore_urls as $ignore_url ) {
			$post_id = url_to_postid( $ignore_url );

			if ( $post_id ) {
				$post_ids[] = $post_id;
			}
		}

		return $post_ids;
	}

	private function prepare_posts_query( $type, $offset, $limit, $columns, $include_ids = array() ) {
		global $wpdb;

		$included_types = empty( $type ) ? $this->get_supported_types() : array( $type );
		if ( empty( $included_types ) ) {
			return false;
		}

		$included_types_placeholders = $this->get_db_placeholders( $included_types );
		$included_types_string = $wpdb->prepare( $included_types_placeholders, $included_types );
		$types_where = "AND post_type IN ({$included_types_string})";

		$ignore_ids_where = '';
		$ignore_ids = $this->get_ignore_ids( $included_types );
		if ( $ignore_ids ) {
			$ignore_ids_placeholders = $this->get_db_placeholders( $ignore_ids, '%d' );
			$ignore_ids_string = $wpdb->prepare( $ignore_ids_placeholders, $ignore_ids );
			$ignore_ids_where = "AND ID NOT IN ({$ignore_ids_string})";
		}

		$include_ids_where = '';
		if ( $include_ids ) {
			$include_ids_placeholders = $this->get_db_placeholders( $include_ids, '%d' );
			$include_ids_string = $wpdb->prepare( $include_ids_placeholders, $include_ids );
			$include_ids_where = "AND ID IN ({$include_ids_string})";
		}

		$column_string = join( ', ', $columns );

		// TODO check if we need to sort on post_type before anything else so that posts of the same type are grouped together
		$query = "SELECT {$column_string} FROM {$wpdb->posts} " .
		         "WHERE post_status = 'publish' " .
		         "AND post_password = '' " .
		         "{$include_ids_where} " .
		         "{$types_where} " .
		         "{$ignore_ids_where} " .
		         "AND ID NOT IN (SELECT post_id FROM {$wpdb->postmeta} WHERE (meta_key = '_wds_meta-robots-noindex' AND meta_value = 1) OR (meta_key = '_wds_redirect' AND meta_value != '')) " .

		         "ORDER BY post_modified ASC LIMIT {$limit} OFFSET {$offset}";

		return $query;
	}

	/**
	 * @param $post WP_Post
	 *
	 * @return bool
	 */
	public function is_post_included( $post ) {
		if ( ! is_a( $post, 'WP_Post' ) ) {
			return false;
		}

		if ( ! in_array( $post->post_type, $this->get_supported_types(), true ) ) {
			return false;
		}

		$query = $this->prepare_posts_query( $post->post_type, 0, 1, array( 'ID' ), array( $post->ID ) );
		if ( ! $query ) {
			return false;
		}

		global $wpdb;
		$posts = $wpdb->get_results( $query );

		return ! empty( $posts );
	}

	private function fetch_essential_data( $type, $page_number ) {
		global $wpdb;
		$limit = $this->get_limit( $page_number, SMARTCRAWL_SITEMAP_POST_LIMIT );
		$offset = $this->get_offset( $page_number );
		$posts_query = $this->prepare_posts_query( $type, $offset, $limit, array( 'ID', 'post_modified' ) );
		if ( ! $posts_query ) {
			return array();
		}

		$posts = $wpdb->get_results( $posts_query );

		return $posts ? $posts : array();
	}

	private function fetch_full_data( $type, $page_number ) {
		global $wpdb;

		$columns = array( 'ID', 'post_parent', 'post_type', 'post_modified' );
		if ( Smartcrawl_Sitemap_Utils::sitemap_images_enabled() ) {
			$columns[] = 'post_content';
		}

		$limit = $this->get_limit( $page_number, SMARTCRAWL_SITEMAP_POST_LIMIT );
		$offset = $this->get_offset( $page_number );
		$posts_query = $this->prepare_posts_query( $type, $offset, $limit, $columns );
		if ( ! $posts_query ) {
			return array();
		}

		$query = "SELECT posts.*, canonical.meta_value AS canonical, sitemap_priority.meta_value AS sitemap_priority FROM ({$posts_query}) AS posts " .
		         "LEFT OUTER JOIN {$wpdb->postmeta} AS canonical ON ID = canonical.post_id AND canonical.meta_key = '_wds_canonical' " .
		         "LEFT OUTER JOIN {$wpdb->postmeta} AS sitemap_priority ON ID = sitemap_priority.post_id AND sitemap_priority.meta_key = '_wds_sitemap-priority'";

		$posts = $wpdb->get_results( $query );

		$posts = $posts ? $posts : array();

		return $posts;
	}

	private function get_db_placeholders( $items, $single_placeholder = '%s' ) {
		return join( ',', array_fill( 0, count( $items ), $single_placeholder ) );
	}

	public function get_ignore_ids( $post_types ) {
		return array_unique( array_merge(
			Smartcrawl_Sitemap_Utils::get_ignore_ids(),
			$this->get_ignored_url_ids(),
			$this->get_ignored_canonical_url_ids( $post_types ),
			$this->get_front_page_id()
		) );
	}

	public function get_supported_types() {
		$options = Smartcrawl_Settings::get_options();
		$types = array();
		$raw = get_post_types( array(
			'public'  => true,
			'show_ui' => true,
		) );
		foreach ( $raw as $type ) {
			if ( ! empty( $options[ 'post_types-' . $type . '-not_in_sitemap' ] ) ) {
				continue;
			}
			$types[] = $type;
		}
		return $types;
	}

	/**
	 * @return int
	 */
	public function get_item_count() {
		global $wpdb;

		$posts_query = $this->prepare_posts_query( '', 0, Smartcrawl_Sitemap_Query::NO_LIMIT, array( 'ID' ) );
		if ( ! $posts_query ) {
			return 0;
		}

		$posts = $wpdb->get_results( $posts_query );

		return count( $posts );
	}

	protected function get_index_items_for_type( $type ) {
		global $wpdb;
		$items = $this->fetch_essential_data( $type, 0 );
		if ( empty( $items ) ) {
			return array();
		}
		$item_count = $wpdb->num_rows;

		return $this->make_index_items( $type, $items, $item_count );
	}

	/**
	 * @param WP_Post $item
	 *
	 * @return mixed
	 */
	protected function get_item_last_modified( $item ) {
		return $this->get_post_modified_time( $item );
	}

	/**
	 * @return array
	 */
	private function get_front_page_id() {
		return 'page' === get_option( 'show_on_front' )
			? array( (int) get_option( 'page_on_front' ) )
			: array();
	}
}
