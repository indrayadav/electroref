;(function ($) {
	window.Wds = window.Wds || {};

	class Data_Reset {
		constructor() {
			this.templates = {
				success: window.Wds.tpl_compile(window.Wds.template('reset', 'success')),
				error: window.Wds.tpl_compile(window.Wds.template('reset', 'error')),
				multisite_warning: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-warning')),
				multisite_progress: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-progress')),
				multisite_success: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-success')),
			};

			this.init();
		}

		init() {
			$(document)
				.on('click', '.wds-data-reset-button', (e) => this.handle_reset_button_click(e))
				.on('click', '.wds-multisite-data-reset-button', (e) => this.handle_multisite_reset_button_click(e));
		}

		handle_reset_button_click(e) {
			let $button = $(e.target).closest('button');
			Data_Reset.add_loading_class($button);

			this.reset();
		}

		reset() {
			let nonce = this.get_nonce();

			return this.post('wds_data_reset', nonce)
				.done(() => {
					this.show_success_message();
					Data_Reset.reload_page();
				})
				.fail(() => this.show_error_message());
		}

		get_modal() {
			return $('#wds-data-reset-modal');
		}

		get_modal_body() {
			return $('.wds-data-reset-modal-body', this.get_modal());
		}

		get_nonce() {
			return $('[name="_data_reset_nonce"]', this.get_modal()).val();
		}

		show_success_message() {
			let markup = this.templates.success({});
			this.get_modal_body().html(markup);
		}

		show_error_message() {
			let markup = this.templates.error({});
			this.get_modal_body().html(markup);
		}

		handle_multisite_reset_button_click(e) {
			let $button = $(e.target).closest('button');
			Data_Reset.add_loading_class($button);

			this.reset_multisite();
		}

		reset_multisite() {
			let nonce = this.get_multisite_nonce();

			return this.post('wds_multisite_data_reset', nonce)
				.done(
					/**
					 * @param {{total_sites:string, completed_sites:string}} data
					 */
					(data) => {
						let total_sites = data.total_sites,
							completed_sites = data.completed_sites,
							progress_message = data.progress_message;

						this.show_multisite_progress_bar(progress_message);
						this.update_multisite_progress(total_sites, completed_sites);

						if (total_sites !== completed_sites) {
							this.reset_multisite();
						} else {
							this.show_multisite_success_message();
							Data_Reset.reload_page();
						}
					})
				.fail(() => this.show_multisite_error_message());
		}

		show_multisite_progress_bar(progress_message) {
			let markup = this.templates.multisite_progress({progress_message: progress_message});
			this.get_multisite_modal_body().html(markup);
		}

		show_multisite_error_message() {
			let markup = this.templates.error({});
			this.get_multisite_modal_body().html(markup);
		}

		show_multisite_success_message() {
			let markup = this.templates.multisite_success({});
			this.get_multisite_modal_body().html(markup);
		}

		get_multisite_progress_bar() {
			return this.get_multisite_modal_body().find('.wds-progress');
		}

		update_multisite_progress(total_sites, completed_sites) {
			let progress_bar = this.get_multisite_progress_bar();
			if (progress_bar.length === 0) {
				return;
			}

			let site_progress = total_sites > 0
				? (completed_sites / total_sites) * 100
				: 0;

			Wds.update_progress_bar(progress_bar, site_progress);
		}

		post(action, nonce) {
			let deferred = new $.Deferred();

			$.post(ajaxurl, {
				action: action,
				_wpnonce: nonce
			}).done((data) => {
				data = (data || {});
				if (data.success) {
					deferred.resolve(data.data);
				} else {
					deferred.reject();
				}
			}).fail(deferred.reject);

			return deferred;
		}

		get_multisite_nonce() {
			return $('[name="_multi_data_reset_nonce"]', this.get_multisite_modal()).val();
		}

		get_multisite_modal_body() {
			return $('.wds-multisite-data-reset-modal-body', this.get_multisite_modal());
		}

		get_multisite_modal() {
			return $('#wds-multisite-data-reset-modal');
		}

		static add_loading_class($button) {
			return $button.addClass('sui-button-onload');
		}

		static reload_page() {
			setTimeout(() => window.location.reload(), 1500);
		}
	}

	$(function () {
		new Data_Reset();
	});
})(jQuery);
