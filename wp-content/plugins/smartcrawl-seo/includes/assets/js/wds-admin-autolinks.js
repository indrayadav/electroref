;(function ($) {

	function submit_dialog_form_on_enter(e) {
		var $button = $(this).find('.wds-action-button'),
			key = e.which;

		if ($button.length && 13 === key) {
			e.preventDefault();
			e.stopPropagation();

			$button.click();
		}
	}

	function validate_moz_form(e) {
		var is_valid = true,
			$form = $(this),
			$submit_button = $('button[type="submit"]', $form);

		$('.sui-form-field', $form).each(function () {
			var $form_field = $(this),
				$input = $('input', $form_field);

			if (!$input.val().trim()) {
				is_valid = false;
				$form_field.addClass('sui-form-field-error');

				$input.on('focus keydown', function () {
					$(this).closest('.sui-form-field-error').removeClass('sui-form-field-error');
				});
			}
		});

		if (is_valid) {
			$submit_button.addClass('sui-button-onload');
		} else {
			$submit_button.removeClass('sui-button-onload');
			e.preventDefault();
		}
	}

	function adjust_robots_field_height() {
		this.style.height = "1px";
		this.style.height = this.scrollHeight + "px";
	}

	function open_add_redirect_form() {
		var query = new URLSearchParams(window.location.search);
		if (
			query.get('tab') === 'tab_url_redirection'
			&& query.get('add_redirect')
		) {
			$('button.wds-add-redirect').click();
		}
	}

	$(function () {
		$(".box-autolinks-custom-keywords-settings").each(function () {
			window.Wds.Keywords.custom_pairs($(this));
		});
		$("#ignorepost").closest(".wds-excluded-posts").each(function () {
			window.Wds.Postlist.exclude($(this));
		});

		$('.wds-vertical-tabs').on('wds_vertical_tabs:tab_change', function (event, active_tab) {
			$(active_tab)
				.find('.wds-vertical-tab-section')
				.removeClass('hidden');
		});

		$(document)
			.on('submit', '.wds-moz-form', validate_moz_form)
			.on('input propertychange', '.tab_robots_editor textarea', adjust_robots_field_height)
			.on('keydown', '.sui-modal', submit_dialog_form_on_enter);

		$('.tab_robots_editor textarea').each(function () {
			adjust_robots_field_height.apply(this);
		});
		window.Wds.link_dropdown();
		window.Wds.accordion();
		window.Wds.vertical_tabs();
		window.Wds.hook_toggleables();

		open_add_redirect_form();
	});

})(jQuery);
