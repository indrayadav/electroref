<?php

class Smartcrawl_Sitemap_Builder {
	/**
	 * @param $items Smartcrawl_Sitemap_Item[]
	 *
	 * @return string
	 */
	public function build( $items ) {
		$stylesheet = Smartcrawl_Sitemap_Utils::stylesheet_enabled()
			? $this->get_stylesheet( 'xml-sitemap' )
			: '';
		$image_schema = Smartcrawl_Sitemap_Utils::sitemap_images_enabled()
			? "xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'"
			: '';

		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n{$stylesheet}\n";
		$xml .= "<urlset xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' {$image_schema}>\n";
		$xml .= $this->get_xml_for_items( $items );
		$xml .= "</urlset>";

		return $xml;
	}

	/**
	 * @param $index_items Smartcrawl_Sitemap_Index_Item[]
	 *
	 * @return string
	 */
	public function build_index( $index_items ) {
		$stylesheet = Smartcrawl_Sitemap_Utils::stylesheet_enabled()
			? $this->get_stylesheet( 'xml-sitemap-index' )
			: '';

		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n{$stylesheet}\n";
		$xml .= "<sitemapindex xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd' xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";
		$xml .= $this->get_xml_for_items( $index_items );
		$xml .= "</sitemapindex>";

		return $xml;
	}

	/**
	 * @param $items Smartcrawl_Sitemap_Index_Item[]
	 *
	 * @return string
	 */
	private function get_xml_for_items( $items ) {
		$item_xml = '';
		foreach ( $items as $item ) {
			$item_xml .= $item->to_xml();
			$item_xml .= "\n";
		}

		return $item_xml;
	}

	private function get_stylesheet( $file_name ) {
		$hide_branding = Smartcrawl_White_Label::get()->is_hide_wpmudev_branding();
		$plugin_dir_url = SMARTCRAWL_PLUGIN_URL;
		$xsl = $hide_branding
			? $file_name . '-whitelabel'
			: $file_name;

		return "<?xml-stylesheet type='text/xml' href='{$plugin_dir_url}admin/templates/xsl/{$xsl}.xsl'?>\n";
	}
}
