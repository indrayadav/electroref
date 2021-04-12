(function ($) {
  'use strict';

  $ = $ && Object.prototype.hasOwnProperty.call($, 'default') ? $['default'] : $;

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

  var Post =
  /*#__PURE__*/
  function () {
    function Post() {
      _classCallCheck(this, Post);

      this.taxonomies = {};
    }

    _createClass(Post, [{
      key: "set_id",
      value: function set_id(id) {
        this.id = id;
        return this;
      }
    }, {
      key: "get_id",
      value: function get_id() {
        return this.id;
      }
    }, {
      key: "set_type",
      value: function set_type(type) {
        this.type = type;
        return this;
      }
    }, {
      key: "get_type",
      value: function get_type() {
        return this.type;
      }
    }, {
      key: "set_author_id",
      value: function set_author_id(author_id) {
        this.author_id = author_id;
        return this;
      }
    }, {
      key: "get_author_id",
      value: function get_author_id() {
        return this.author_id;
      }
    }, {
      key: "set_title",
      value: function set_title(title) {
        this.title = title;
        return this;
      }
    }, {
      key: "get_title",
      value: function get_title() {
        return this.title;
      }
    }, {
      key: "set_content",
      value: function set_content(content) {
        this.content = content;
        return this;
      }
    }, {
      key: "get_content",
      value: function get_content() {
        return this.content;
      }
    }, {
      key: "set_excerpt",
      value: function set_excerpt(excerpt) {
        this.excerpt = excerpt;
        return this;
      }
    }, {
      key: "get_excerpt",
      value: function get_excerpt() {
        return this.excerpt;
      }
    }, {
      key: "set_category_ids",
      value: function set_category_ids(category_ids) {
        this.set_taxonomy_terms('category', category_ids);
        return this;
      }
    }, {
      key: "get_category_ids",
      value: function get_category_ids() {
        return this.get_taxonomy_terms('category');
      }
    }, {
      key: "set_tag_ids",
      value: function set_tag_ids(ids) {
        this.set_taxonomy_terms('post_tag', ids);
        return this;
      }
    }, {
      key: "get_tag_ids",
      value: function get_tag_ids() {
        return this.get_taxonomy_terms('post_tag');
      }
    }, {
      key: "set_slug",
      value: function set_slug(slug) {
        this.slug = slug;
        return this;
      }
    }, {
      key: "get_slug",
      value: function get_slug() {
        return this.slug;
      }
      /**
       * @param date {Date}
       */

    }, {
      key: "set_date",
      value: function set_date(date) {
        this.date = date;
        return this;
      }
    }, {
      key: "get_date",
      value: function get_date() {
        return this.date;
      }
      /**
       * @param modified {Date}
       */

    }, {
      key: "set_modified",
      value: function set_modified(modified) {
        this.modified = modified;
        return this;
      }
    }, {
      key: "get_modified",
      value: function get_modified() {
        return this.modified;
      }
    }, {
      key: "set_permalink",
      value: function set_permalink(permalink) {
        this.permalink = permalink;
        return this;
      }
    }, {
      key: "get_permalink",
      value: function get_permalink() {
        return this.permalink;
      }
    }, {
      key: "set_taxonomy_terms",
      value: function set_taxonomy_terms(taxonomy, terms) {
        this.taxonomies[taxonomy] = terms;
      }
    }, {
      key: "get_taxonomy_terms",
      value: function get_taxonomy_terms(taxonomy) {
        return this.taxonomies.hasOwnProperty(taxonomy) ? this.taxonomies[taxonomy] : [];
      }
    }]);

    return Post;
  }();

  var Config_Values =
  /*#__PURE__*/
  function () {
    function Config_Values() {
      _classCallCheck(this, Config_Values);
    }

    _createClass(Config_Values, null, [{
      key: "get",
      value: function get(keys) {
        var scope = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'general';

        if (!Array.isArray(keys)) {
          keys = [keys];
        }

        var value = window['_wds_' + scope] || {};
        keys.forEach(function (key) {
          if (value && value.hasOwnProperty(key)) {
            value = value[key];
          } else {
            value = '';
          }
        });
        return value;
      }
    }, {
      key: "get_bool",
      value: function get_bool(varname) {
        var scope = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'general';
        return !!this.get(varname, scope);
      }
    }]);

    return Config_Values;
  }();

  var String_Utils =
  /*#__PURE__*/
  function () {
    function String_Utils() {
      _classCallCheck(this, String_Utils);
    }

    _createClass(String_Utils, null, [{
      key: "truncate_string",
      value: function truncate_string(string, limit) {
        if (string.length > limit) {
          var stringArray = Array.from(string);
          string = stringArray.splice(0, limit - 4).join('').trim() + ' ...';
        }

        return string;
      }
    }, {
      key: "normalize_whitespace",
      value: function normalize_whitespace(string) {
        // Replace whitespace characters with simple spaces
        string = string.replace(/(\r\n|\n|\r|\t)/gm, " "); // Replace each set of multiple consecutive spaces with a single space

        string = string.replace(/[ ]+/g, " ");
        return string.trim();
      }
    }, {
      key: "remove_shortcodes",
      value: function remove_shortcodes(string) {
        string = string || '';

        if (string.indexOf('[') === -1) {
          return string;
        } // Modified version of regex from PHP function get_shortcode_regex()


        var regex = /\[(\[?)([a-zA-Z0-9_-]*)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)\[\/\2\])?)(\]?)/g,
            self = this;
        return string.replace(regex, function (match, start_bracket, shortcode, attributes, match_4, content, end_bracket, offset, string) {
          if (arguments.length < 7) {
            // Not the expected regex for some reason. Try returning the full match or fall back to empty string.
            return match || '';
          } // Allow [[foo]] syntax for escaping a tag.


          if ('[' === start_bracket && ']' === end_bracket) {
            // Return the whole matched string without the surrounding square brackets that were there for escaping
            return match.substring(1, match.length - 1);
          }

          var omitted = Config_Values.get('omitted_shortcodes', 'replacement');

          if (!!content && !omitted.includes(shortcode)) {
            // Call the removal method on the content nested in the current shortcode
            // This will continue recursively until we have removed all shortcodes
            return self.remove_shortcodes(content.trim());
          } // Just remove the content-less, non-escaped shortcodes


          return '';
        });
      }
    }, {
      key: "strip_html",
      value: function strip_html(html) {
        var div = document.createElement("DIV");
        div.innerHTML = html;
        return div.textContent || div.innerText || "";
      }
    }, {
      key: "process_string",
      value: function process_string(string) {
        var limit = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
        string = String_Utils.strip_html(string);
        string = String_Utils.normalize_whitespace(string);

        if (limit) {
          string = String_Utils.truncate_string(string, limit);
        }

        return string;
      }
    }]);

    return String_Utils;
  }();

  var OptimumLengthIndicator =
  /*#__PURE__*/
  function () {
    /**
     * @param $field jQuery element
     * @param macroReplacementFunction
     * @param options
     */
    function OptimumLengthIndicator($field, macroReplacementFunction, options) {
      _classCallCheck(this, OptimumLengthIndicator);

      if (!this.is_field_valid($field)) {
        return;
      }

      this.$el = $field;
      this.macroReplacementFunction = macroReplacementFunction;
      this.upper = options.upper || 0;
      this.lower = options.lower || 0;
      this.default_value = options.default_value || '';
      var offset = 8 / 100 * this.upper;
      this.almost_lower = this.lower + offset;
      this.almost_upper = this.upper - offset;
      this.init_element($field);
      this.init_listeners();
      this.update_indicator();
    }

    _createClass(OptimumLengthIndicator, [{
      key: "init_listeners",
      value: function init_listeners() {
        var _this = this;

        this.$el.on('input propertychange', _.debounce(function () {
          return _this.update_indicator();
        }, 200)).one('input propertychange', function () {
          return _this.add_resolving_class();
        });
      }
    }, {
      key: "is_field_valid",
      value: function is_field_valid($element) {
        return !$element.is(this.field_selector()) // Already initialized
        && $element.is('input,textarea');
      }
    }, {
      key: "init_element",
      value: function init_element($element) {
        $element.addClass(this.field_class());
        $('<div><span></span><span></span></div>').addClass(this.indicator_class()).insertAfter($element);
        return $element;
      }
    }, {
      key: "get_indicator",
      value: function get_indicator() {
        return this.$el.next(this.indicator_selector());
      }
    }, {
      key: "get_bar",
      value: function get_bar() {
        return this.get_indicator().find('span').first();
      }
    }, {
      key: "get_char_count_container",
      value: function get_char_count_container() {
        return this.get_indicator().find('span').last();
      }
    }, {
      key: "reset_classes",
      value: function reset_classes() {
        this.$el.removeClass('over almost-over just-right almost-under under');
      }
    }, {
      key: "remove_resolving_class",
      value: function remove_resolving_class() {
        this.$el.removeClass('resolving');
      }
    }, {
      key: "add_resolving_class",
      value: function add_resolving_class() {
        this.$el.addClass('resolving');
      }
    }, {
      key: "update_indicator",
      value: function update_indicator() {
        var _this2 = this;

        var value = this.$el.val();
        value = !!value ? value : this.default_value;

        if (!value) {
          this.get_char_count_container().hide();
          this.reset_classes();
          this.remove_resolving_class();
          return;
        }

        this.macroReplacementFunction(value).then(function (final_value) {
          final_value = String_Utils.strip_html(final_value);
          final_value = String_Utils.normalize_whitespace(final_value);
          var length = Array.from(final_value).length,
              ideal_length = (_this2.upper + _this2.lower) / 2,
              percentage = length / ideal_length * 100;

          _this2.remove_resolving_class();

          _this2.$el.one('input propertychange', function () {
            return _this2.add_resolving_class();
          }); // When the length is equal to mean, the progress bar should be in the center instead of the end. Therefore:


          percentage = percentage / 2;
          percentage = percentage > 100 ? 100 : percentage; // Update width

          _this2.get_bar().width(percentage + '%'); // Update count


          var count = _this2.get_char_count_container();

          count.html(length + ' / ' + _this2.lower + '-' + _this2.upper + ' ' + Config_Values.get(['strings', 'characters'], 'admin'));

          if (!!length) {
            count.show();
          } else {
            count.hide();
          }

          _this2.reset_classes();

          if (length > _this2.upper) {
            _this2.$el.addClass('over');
          } else if (_this2.almost_upper < length && length <= _this2.upper) {
            _this2.$el.addClass('almost-over');
          } else if (_this2.almost_lower <= length && length <= _this2.almost_upper) {
            _this2.$el.addClass('just-right');
          } else if (_this2.lower <= length && length < _this2.almost_lower) {
            _this2.$el.addClass('almost-under');
          } else if (_this2.lower > length) {
            _this2.$el.addClass('under');
          }
        });
      }
    }, {
      key: "field_class",
      value: function field_class() {
        return 'wds-optimum-length-indicator-field';
      }
    }, {
      key: "field_selector",
      value: function field_selector() {
        return '.' + this.field_class();
      }
    }, {
      key: "indicator_class",
      value: function indicator_class() {
        return 'wds-optimum-length-indicator';
      }
    }, {
      key: "indicator_selector",
      value: function indicator_selector() {
        return '.' + this.indicator_class();
      }
    }]);

    return OptimumLengthIndicator;
  }();

  var Term =
  /*#__PURE__*/
  function () {
    function Term() {
      _classCallCheck(this, Term);
    }

    _createClass(Term, [{
      key: "set_id",
      value: function set_id(id) {
        this.id = id;
        return this;
      }
    }, {
      key: "get_id",
      value: function get_id() {
        return this.id;
      }
    }, {
      key: "set_title",
      value: function set_title(title) {
        this.title = title;
        return this;
      }
    }, {
      key: "get_title",
      value: function get_title() {
        return this.title;
      }
    }, {
      key: "set_slug",
      value: function set_slug(slug) {
        this.slug = slug;
        return this;
      }
    }, {
      key: "get_slug",
      value: function get_slug() {
        return this.slug;
      }
    }, {
      key: "set_description",
      value: function set_description(description) {
        this.description = description;
        return this;
      }
    }, {
      key: "get_description",
      value: function get_description() {
        return this.description;
      }
    }, {
      key: "set_taxonomy",
      value: function set_taxonomy(taxonomy) {
        this.taxonomy = taxonomy;
        return this;
      }
    }, {
      key: "get_taxonomy",
      value: function get_taxonomy() {
        return this.taxonomy;
      }
    }, {
      key: "set_permalink",
      value: function set_permalink(permalink) {
        this.permalink = permalink;
        return this;
      }
    }, {
      key: "get_permalink",
      value: function get_permalink() {
        return this.permalink;
      }
    }]);

    return Term;
  }();

  (function () {
    window.Wds.randomPosts = {};
    window.Wds.randomTerms = {};
    var random_posts = Config_Values.get('random_posts', 'onpage_components');
    Object.keys(random_posts).forEach(function (post_type) {
      var post_data = random_posts[post_type];
      var post = new Post();
      post.set_id(post_data.ID).set_type(post_data.post_type).set_author_id(post_data.post_author).set_title(post_data.post_title).set_content(post_data.post_content).set_excerpt(post_data.post_excerpt).set_slug(post_data.post_name).set_date(new Date(post_data.post_date)).set_modified(new Date(post_data.post_modified)).set_permalink(post_data.permalink);

      if (post_data.taxonomy_terms) {
        Object.keys(post_data.taxonomy_terms).forEach(function (taxonomy) {
          post.set_taxonomy_terms(taxonomy, post_data.taxonomy_terms[taxonomy]);
        });
      }

      window.Wds.randomPosts[post_type] = post;
    });
    var random_terms = Config_Values.get('random_terms', 'onpage_components');
    Object.keys(random_terms).forEach(function (taxonomy) {
      var term_data = random_terms[taxonomy];
      var term = new Term();
      term.set_id(term_data.term_id).set_title(term_data.name).set_slug(term_data.slug).set_description(term_data.description).set_permalink(term_data.permalink).set_taxonomy(taxonomy);
      window.Wds.randomTerms[taxonomy] = term;
    });
    window.Wds.OptimumLengthIndicator = OptimumLengthIndicator;
    window.Wds.String_Utils = String_Utils;
  })(jQuery);

}(jQuery));

//# sourceMappingURL=wds-onpage-components.js.map