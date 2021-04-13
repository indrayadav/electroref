(function ($, undefined) {
	window.Wds = window.Wds || {};
	var crawlerReport = window.Wds.URLCrawlerReport;

	function update_page_after_report_reload() {
		var $report = $('.wds-crawl-results-report'),
			active_issues = $report.data('activeIssues'),
			ignored_issues = $report.data('ignoredIssues'),
			$vertical_tab = $report.closest('.tab_url_crawler'),
			$title_issues_indicator = $vertical_tab.find('.sui-box-header .sui-tag'),
			$crawler_tab = $('li.tab_url_crawler'),
			$label_issues_indicator = $crawler_tab.find('.sui-tag'),
			$label_tick = $crawler_tab.find('.sui-icon-check-tick'),
			$label_spinner = $crawler_tab.find('.sui-icon-loader'),
			$new_crawl_button = $('.wds-new-crawl-button'),
			$title_ignore_all_button = $('.sui-box-header .wds-ignore-all').closest('div');

		if (active_issues === undefined) {
			// In progress or no data
			return;
		}

		if (active_issues > 0) {
			$title_issues_indicator.show().html(active_issues);
			$label_issues_indicator.show().html(active_issues);
			$title_ignore_all_button.show();
			$label_tick.hide();
		} else {
			$title_issues_indicator.hide();
			$label_issues_indicator.hide();
			$title_ignore_all_button.hide();
			$label_tick.show();
		}

		// Hide the spinner and show the new crawl button regardless of the result
		$label_spinner.hide();
		$new_crawl_button.show();
	}

	function update_progress() {
		var $container = $('.tab_url_crawler');
		if (
			!$container.find('.wds-url-crawler-progress').length
			|| !crawlerReport
		) {
			return;
		}

		crawlerReport.reload_report().done(function () {
			setTimeout(update_progress, 5000);
		});
	}

	function handle_accordion_item_click() {
		var $accordion_item = $(this).closest('.sui-accordion-item');

		// Keep one section open at a time
		$('.sui-accordion-item--open').not($accordion_item).removeClass('sui-accordion-item--open');
	}

	function initialize_components() {
		$('.sui-accordion').each(function () {
			SUI.suiAccordion(this);
		});
		$('.sui-accordion-item-header').off('click.sui.accordion').on('click.sui.accordion', handle_accordion_item_click);
		SUI.suiTabs();
	}

	// As soon as a link is clicked inside the dropdown close it
	function close_links_dropdown() {
		var $dropdown = $(this).closest('.wds-links-dropdown');
		$dropdown.removeClass('open');
	}

	function change_crawl_frequency() {
		var $radio = $(this),
			frequency = $radio.val();

		$dow_selects = $('.wds-dow').hide();
		$dow_selects.find('select').prop('disabled', true);
		$dow_selects.filter('.' + frequency).show();
		$dow_selects.filter('.' + frequency).find('select').prop('disabled', false);
	}

	function update_sitemap_sub_section_visbility() {
		$('.wds-sitemap-toggleable').each(function () {
			var $toggleable = $(this),
				$nested_table = $toggleable.next('tr').find('.sui-table');

			if ($toggleable.find('input[type="checkbox"]').is(':checked')) {
				$nested_table.show();
			} else {
				$nested_table.hide();
			}
		});
	}

	function submit_dialog_form_on_enter(e) {
		var $button = $(this).find('.wds-submit-redirect'),
			key = e.which;

		if ($button.length && 13 === key) {
			e.preventDefault();
			e.stopPropagation();

			$button.click();
		}
	}

	function switch_to_native_sitemap() {
		var $button = $('#wds-switch-to-native-button');

		Wds.open_dialog(
			'wds-switch-to-native-modal',
			'wds-switch-to-native-sitemap',
			$button.attr('id')
		);
		$button.off().on('click', function () {
			$button.addClass('sui-button-onload');
			override_native(false, function () {
				window.location.href = add_query_params({
					'switched-to-native': 1
				});
			});
		});
	}

	function switch_to_smartcrawl_sitemap() {
		var $button = $('#wds-switch-to-smartcrawl-button');

		Wds.open_dialog(
			'wds-switch-to-smartcrawl-modal',
			'wds-switch-to-smartcrawl-sitemap',
			$button.attr('id')
		);
		$button.off().on('click', function () {
			$button.addClass('sui-button-onload');
			override_native(true, function () {
				window.location.href = add_query_params({
					'switched-to-sc': 1
				});
			});
		});
	}

	function add_query_params(params) {
		var current_url = window.location.href,
			current_params = new URLSearchParams(window.location.search);

		return current_url.split('?')[0] + '?' + $.param($.extend({}, {page: current_params.get('page')}, params));
	}

	function override_native(override, callback) {
		return $.post(
			ajaxurl,
			{
				action: 'wds-override-native',
				override: override ? '1' : '0',
				_wds_nonce: Wds.get('sitemaps', 'nonce')
			},
			callback,
			'json'
		);
	}

	function manually_notify_search_engines() {
		var $button = $(this);
		$button.addClass('sui-button-onload');
		return $.post(
			ajaxurl,
			{
				action: 'wds-manually-update-engines',
				_wds_nonce: Wds.get('sitemaps', 'nonce')
			},
			function () {
				Wds.show_floating_message(
					'wds-sitemap-manually-notify-search-engines',
					Wds.l10n('sitemaps', 'manually_notified_engines'),
					'success'
				);
				$button.removeClass('sui-button-onload');
			},
			'json'
		);
	}

	function manually_update_sitemap() {
		var $button = $(this);
		$button.addClass('sui-button-onload');
		return $.post(
			ajaxurl,
			{
				action: 'wds-manually-update-sitemap',
				_wds_nonce: Wds.get('sitemaps', 'nonce')
			},
			function () {
				Wds.show_floating_message(
					'wds-sitemap-manually-updated',
					Wds.l10n('sitemaps', 'manually_updated'),
					'success'
				);
				$button.removeClass('sui-button-onload');
			},
			'json'
		);
	}

	function deactivate_sitemap_module() {
		$(this).addClass('sui-button-onload');
		return $.post(
			ajaxurl,
			{
				action: 'wds-deactivate-sitemap-module',
				_wds_nonce: Wds.get('sitemaps', 'nonce')
			},
			function () {
				window.location.reload();
			},
			'json'
		);
	}

	function init() {
		window.Wds.hook_conditionals();
		window.Wds.hook_toggleables();
		window.Wds.conditional_fields();
		window.Wds.dismissible_message();
		window.Wds.vertical_tabs();

		update_progress();
		initialize_components();

		$(document)
			.on('click', '.wds-links-dropdown a', close_links_dropdown)
			.on('change', '.wds-sitemap-toggleable input[type="checkbox"]', update_sitemap_sub_section_visbility)
			.on('keydown', '.sui-modal', submit_dialog_form_on_enter)
			.on('change', '.wds-crawler-frequency-radio', change_crawl_frequency)
			.on('change', '#wds_sitemap_options-sitemap-disable-automatic-regeneration', function () {
				var $checkbox = $(this),
					$notice = $checkbox.closest('.sui-toggle').find('.sui-notice');

				$notice.toggleClass('hidden', $checkbox.is(':checked'));
			})
			.on('click', '#wds-switch-to-native-sitemap', switch_to_native_sitemap)
			.on('click', '#wds-switch-to-smartcrawl-sitemap', switch_to_smartcrawl_sitemap)
			.on('click', '#wds-deactivate-sitemap-module', deactivate_sitemap_module)
			.on('click', '#wds-manually-update-sitemap', manually_update_sitemap)
			.on('click', '#wds-manually-notify-search-engines', manually_notify_search_engines)
		;

		$('.wds-crawler-frequency-radio:checked').each(function () {
			change_crawl_frequency.apply(this);
		});

		if (crawlerReport) {
			crawlerReport.init();
			$(crawlerReport)
				.on('wds_url_crawler_report:reloaded', update_page_after_report_reload)
				.on('wds_url_crawler_report:reloaded', initialize_components);
		}

		$(update_sitemap_sub_section_visbility);
	}

	$(init);
})(jQuery);
