(function () {
  'use strict';

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
    }
  }

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  (function ($) {
    window.Wds = window.Wds || {};

    var Data_Reset =
    /*#__PURE__*/
    function () {
      function Data_Reset() {
        _classCallCheck(this, Data_Reset);

        this.templates = {
          success: window.Wds.tpl_compile(window.Wds.template('reset', 'success')),
          error: window.Wds.tpl_compile(window.Wds.template('reset', 'error')),
          multisite_warning: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-warning')),
          multisite_progress: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-progress')),
          multisite_success: window.Wds.tpl_compile(window.Wds.template('reset', 'multisite-success'))
        };
        this.init();
      }

      _createClass(Data_Reset, [{
        key: "init",
        value: function init() {
          var _this = this;

          $(document).on('click', '.wds-data-reset-button', function (e) {
            return _this.handle_reset_button_click(e);
          }).on('click', '.wds-multisite-data-reset-button', function (e) {
            return _this.handle_multisite_reset_button_click(e);
          });
        }
      }, {
        key: "handle_reset_button_click",
        value: function handle_reset_button_click(e) {
          var $button = $(e.target).closest('button');
          Data_Reset.add_loading_class($button);
          this.reset();
        }
      }, {
        key: "reset",
        value: function reset() {
          var _this2 = this;

          var nonce = this.get_nonce();
          return this.post('wds_data_reset', nonce).done(function () {
            _this2.show_success_message();

            Data_Reset.reload_page();
          }).fail(function () {
            return _this2.show_error_message();
          });
        }
      }, {
        key: "get_modal",
        value: function get_modal() {
          return $('#wds-data-reset-modal');
        }
      }, {
        key: "get_modal_body",
        value: function get_modal_body() {
          return $('.wds-data-reset-modal-body', this.get_modal());
        }
      }, {
        key: "get_nonce",
        value: function get_nonce() {
          return $('[name="_data_reset_nonce"]', this.get_modal()).val();
        }
      }, {
        key: "show_success_message",
        value: function show_success_message() {
          var markup = this.templates.success({});
          this.get_modal_body().html(markup);
        }
      }, {
        key: "show_error_message",
        value: function show_error_message() {
          var markup = this.templates.error({});
          this.get_modal_body().html(markup);
        }
      }, {
        key: "handle_multisite_reset_button_click",
        value: function handle_multisite_reset_button_click(e) {
          var $button = $(e.target).closest('button');
          Data_Reset.add_loading_class($button);
          this.reset_multisite();
        }
      }, {
        key: "reset_multisite",
        value: function reset_multisite() {
          var _this3 = this;

          var nonce = this.get_multisite_nonce();
          return this.post('wds_multisite_data_reset', nonce).done(
          /**
           * @param {{total_sites:string, completed_sites:string}} data
           */
          function (data) {
            var total_sites = data.total_sites,
                completed_sites = data.completed_sites,
                progress_message = data.progress_message;

            _this3.show_multisite_progress_bar(progress_message);

            _this3.update_multisite_progress(total_sites, completed_sites);

            if (total_sites !== completed_sites) {
              _this3.reset_multisite();
            } else {
              _this3.show_multisite_success_message();

              Data_Reset.reload_page();
            }
          }).fail(function () {
            return _this3.show_multisite_error_message();
          });
        }
      }, {
        key: "show_multisite_progress_bar",
        value: function show_multisite_progress_bar(progress_message) {
          var markup = this.templates.multisite_progress({
            progress_message: progress_message
          });
          this.get_multisite_modal_body().html(markup);
        }
      }, {
        key: "show_multisite_error_message",
        value: function show_multisite_error_message() {
          var markup = this.templates.error({});
          this.get_multisite_modal_body().html(markup);
        }
      }, {
        key: "show_multisite_success_message",
        value: function show_multisite_success_message() {
          var markup = this.templates.multisite_success({});
          this.get_multisite_modal_body().html(markup);
        }
      }, {
        key: "get_multisite_progress_bar",
        value: function get_multisite_progress_bar() {
          return this.get_multisite_modal_body().find('.wds-progress');
        }
      }, {
        key: "update_multisite_progress",
        value: function update_multisite_progress(total_sites, completed_sites) {
          var progress_bar = this.get_multisite_progress_bar();

          if (progress_bar.length === 0) {
            return;
          }

          var site_progress = total_sites > 0 ? completed_sites / total_sites * 100 : 0;
          Wds.update_progress_bar(progress_bar, site_progress);
        }
      }, {
        key: "post",
        value: function post(action, nonce) {
          var deferred = new $.Deferred();
          $.post(ajaxurl, {
            action: action,
            _wpnonce: nonce
          }).done(function (data) {
            data = data || {};

            if (data.success) {
              deferred.resolve(data.data);
            } else {
              deferred.reject();
            }
          }).fail(deferred.reject);
          return deferred;
        }
      }, {
        key: "get_multisite_nonce",
        value: function get_multisite_nonce() {
          return $('[name="_multi_data_reset_nonce"]', this.get_multisite_modal()).val();
        }
      }, {
        key: "get_multisite_modal_body",
        value: function get_multisite_modal_body() {
          return $('.wds-multisite-data-reset-modal-body', this.get_multisite_modal());
        }
      }, {
        key: "get_multisite_modal",
        value: function get_multisite_modal() {
          return $('#wds-multisite-data-reset-modal');
        }
      }], [{
        key: "add_loading_class",
        value: function add_loading_class($button) {
          return $button.addClass('sui-button-onload');
        }
      }, {
        key: "reload_page",
        value: function reload_page() {
          setTimeout(function () {
            return window.location.reload();
          }, 1500);
        }
      }]);

      return Data_Reset;
    }();

    $(function () {
      new Data_Reset();
    });
  })(jQuery);

}());

//# sourceMappingURL=wds-data-reset.js.map