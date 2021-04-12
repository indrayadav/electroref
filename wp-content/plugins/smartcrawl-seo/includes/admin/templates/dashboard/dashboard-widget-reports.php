<?php
$show_checkup = smartcrawl_can_show_dash_widget_for( Smartcrawl_Settings_Settings::TAB_CHECKUP );
$show_crawler = smartcrawl_can_show_dash_widget_for( Smartcrawl_Settings_Settings::TAB_SITEMAP );
if ( ! $show_checkup && ! $show_crawler ) {
	return;
}
$service = Smartcrawl_Service::get( Smartcrawl_Service::SERVICE_CHECKUP );
$template = $service->is_member() ? 'dashboard/dashboard-reports-full' : 'dashboard/dashboard-reports-free';
$this->_render( $template );
