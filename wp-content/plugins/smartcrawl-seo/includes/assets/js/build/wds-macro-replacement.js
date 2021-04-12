(function (wp, $, _) {
  'use strict';

  wp = wp && Object.prototype.hasOwnProperty.call(wp, 'default') ? wp['default'] : wp;
  $ = $ && Object.prototype.hasOwnProperty.call($, 'default') ? $['default'] : $;
  _ = _ && Object.prototype.hasOwnProperty.call(_, 'default') ? _['default'] : _;

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

  function _toConsumableArray(arr) {
    return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread();
  }

  function _arrayWithoutHoles(arr) {
    if (Array.isArray(arr)) {
      for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) arr2[i] = arr[i];

      return arr2;
    }
  }

  function _iterableToArray(iter) {
    if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter);
  }

  function _nonIterableSpread() {
    throw new TypeError("Invalid attempt to spread non-iterable instance");
  }

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

  var PostObjectsCache =
  /*#__PURE__*/
  function () {
    function PostObjectsCache() {
      _classCallCheck(this, PostObjectsCache);

      this.authors = {};
      this.taxonomy_terms = {};
      this.register_api_fetch_middleware();
    }

    _createClass(PostObjectsCache, [{
      key: "key",
      value: function key(prefix, id) {
        id = '' + id;
        return prefix + id.trim();
      }
    }, {
      key: "add_categories",
      value: function add_categories(cats) {
        this.add_taxonomy_terms('category', cats);
      }
    }, {
      key: "get_categories",
      value: function get_categories(ids) {
        return this.get_taxonomy_terms('category', ids);
      }
    }, {
      key: "add_tags",
      value: function add_tags(tags) {
        this.add_taxonomy_terms('post_tag', tags);
        this.add_taxonomy_terms('post_tag', tags, 'name');
      }
    }, {
      key: "get_tags",
      value: function get_tags(ids) {
        return this.get_taxonomy_terms('post_tag', ids);
      }
    }, {
      key: "author_key",
      value: function author_key(id) {
        return this.key('author-', id);
      }
    }, {
      key: "add_authors",
      value: function add_authors(authors) {
        var _this = this;

        if (Array.isArray(authors)) {
          authors.forEach(function (author) {
            _this.add_author(author);
          });
        } else if (!!authors.id) {
          this.add_author(authors);
        }
      }
    }, {
      key: "add_author",
      value: function add_author(author) {
        var key = this.author_key(author.id);
        this.authors[key] = author;
      }
    }, {
      key: "get_author",
      value: function get_author(id) {
        var key = this.author_key(id);

        if (this.authors.hasOwnProperty(key)) {
          return this.authors[key];
        }

        return false;
      }
    }, {
      key: "get_query_var",
      value: function get_query_var(url, variable) {
        var query = url.substring(1);
        var vars = query.split(/[&?]/);

        for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split('=');

          if (decodeURIComponent(pair[0]) === variable) {
            return decodeURIComponent(pair[1]);
          }
        }

        return false;
      }
    }, {
      key: "register_api_fetch_middleware",
      value: function register_api_fetch_middleware() {
        var _this2 = this;

        wp.apiFetch.use(function (options, next) {
          if (_this2.is_term_request(options)) {
            var fields = _this2.get_query_var(options.path, '_fields');

            if (fields) {
              options.path = options.path.replace(encodeURIComponent(fields), encodeURIComponent(fields + ',description'));
            }
          }

          var result = next(options);
          result.then(function (values) {
            if (_this2.is_category_request(options)) {
              _this2.add_categories(values);
            }

            if (_this2.is_tag_request(options)) {
              _this2.add_tags(values);
            }

            if (_this2.is_get_request(options, '/wp/v2/users/')) {
              _this2.add_authors(values);
            }

            var taxonomy = _this2.get_taxonomy_slug(options);

            if (taxonomy) {
              _this2.add_taxonomy_terms(taxonomy, values);
            }
          })["catch"](function (error) {
            console.log(error);
          });
          return result;
        });
      }
    }, {
      key: "get_taxonomy_slug",
      value: function get_taxonomy_slug(request) {
        if (request.method && request.method !== 'GET' || !request.path) {
          return false;
        }

        var taxonomies = this.get_taxonomies(),
            matches = request.path.match(/\/wp\/v2\/([a-z_-]*).*/);

        if (!matches || matches.length < 2 || !matches[1]) {
          return false;
        }

        return taxonomies.includes(matches[1]) ? matches[1] : false;
      }
    }, {
      key: "is_term_request",
      value: function is_term_request(request) {
        return this.is_category_request(request) || this.is_tag_request(request) || !!this.get_taxonomy_slug(request);
      }
    }, {
      key: "is_category_request",
      value: function is_category_request(request) {
        return this.is_get_request(request, '/wp/v2/categories');
      }
    }, {
      key: "is_tag_request",
      value: function is_tag_request(request) {
        return this.is_get_request(request, '/wp/v2/tags');
      }
    }, {
      key: "is_get_request",
      value: function is_get_request(request, keyword) {
        return request && (!request.method || request.method === 'GET') && request.path && request.path.includes(keyword);
      }
    }, {
      key: "taxonomy_key",
      value: function taxonomy_key(taxonomy, id) {
        return this.key('taxonomy-' + taxonomy + '-term-', id);
      }
    }, {
      key: "get_taxonomy_terms",
      value: function get_taxonomy_terms(taxonomy, terms_ids) {
        var _this3 = this;

        var terms = [];
        terms_ids.forEach(function (id) {
          var key = _this3.taxonomy_key(taxonomy, id);

          if (_this3.taxonomy_terms.hasOwnProperty(key)) {
            terms.push(_this3.taxonomy_terms[key]);
          }
        });

        if (terms.length !== terms_ids.length) {
          return [];
        }

        return terms;
      }
    }, {
      key: "add_taxonomy_terms",
      value: function add_taxonomy_terms(taxonomy, terms) {
        var _this4 = this;

        var field = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'id';

        if (Array.isArray(terms)) {
          terms.forEach(function (term) {
            _this4.add_taxonomy_term(taxonomy, term, field);
          });
        } else if (!!terms.id) {
          this.add_taxonomy_term(taxonomy, terms, field);
        }
      }
    }, {
      key: "add_taxonomy_term",
      value: function add_taxonomy_term(taxonomy, term) {
        var field = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'id';
        var key = this.taxonomy_key(taxonomy, term[field]);
        this.taxonomy_terms[key] = term;
      }
    }, {
      key: "get_taxonomies",
      value: function get_taxonomies() {
        return Config_Values.get('taxonomies', 'replacement');
      }
    }]);

    return PostObjectsCache;
  }();

  var PostObjectFetcher =
  /*#__PURE__*/
  function () {
    /**
     * @param postObjectsCache {PostObjectsCache}
     */
    function PostObjectFetcher(postObjectsCache) {
      _classCallCheck(this, PostObjectFetcher);

      this.cache = postObjectsCache;
      this.category_promise = null;
      this.tag_promise = null;
      this.author_promise = null;
      this.term_promise = {};
    }

    _createClass(PostObjectFetcher, [{
      key: "fetch_category_data",
      value: function fetch_category_data(ids) {
        var _this = this;

        if (!this.category_promise) {
          this.category_promise = new Promise(function (resolve, reject) {
            if (!ids || !ids.length) {
              resolve([]);
              return;
            }

            var categories = _this.cache.get_categories(ids);

            if (categories.length) {
              resolve(categories);
              return;
            }

            var params = $.param({
              include: ids
            }),
                path = '/wp/v2/categories?' + params;
            wp.apiFetch({
              path: path
            }).then(function (data) {
              resolve(data);
            })["catch"](reject);
          });
          this.category_promise.then(function () {
            _this.category_promise = null;
          });
        }

        return this.category_promise;
      }
    }, {
      key: "fetch_tag_data",
      value: function fetch_tag_data(ids) {
        var _this2 = this;

        if (!this.tag_promise) {
          this.tag_promise = new Promise(function (resolve, reject) {
            if (!ids || !ids.length) {
              resolve([]);
              return;
            }

            var args = {};

            if (_this2.ids_numeric(ids)) {
              args.include = ids;
            } else if (_this2.ids_slugs(ids)) {
              args.slug = ids;
            } else {
              reject('IDs malformed');
              return;
            }

            var tags = _this2.cache.get_tags(ids);

            if (tags.length) {
              resolve(tags);
              return;
            }

            var path = '/wp/v2/tags?' + $.param(args);
            wp.apiFetch({
              path: path
            }).then(function (data) {
              resolve(data);
            })["catch"](reject);
          });
          this.tag_promise.then(function () {
            _this2.tag_promise = null;
          });
        }

        return this.tag_promise;
      }
    }, {
      key: "fetch_taxonomy_terms",
      value: function fetch_taxonomy_terms(taxonomy, ids) {
        var _this3 = this;

        if (!this.term_promise.hasOwnProperty(taxonomy)) {
          this.term_promise[taxonomy] = new Promise(function (resolve, reject) {
            if (!ids || !ids.length) {
              resolve([]);
              return;
            }

            var terms = _this3.cache.get_taxonomy_terms(taxonomy, ids);

            if (terms.length) {
              resolve(terms);
              return;
            }

            var params = $.param({
              include: ids
            }),
                path = '/wp/v2/' + taxonomy + '?' + params;
            wp.apiFetch({
              path: path
            }).then(function (data) {
              resolve(data);
            })["catch"](reject);
          });
          this.term_promise[taxonomy].then(function () {
            delete _this3.term_promise[taxonomy];
          });
        }

        return this.term_promise[taxonomy];
      }
    }, {
      key: "fetch_author_data",
      value: function fetch_author_data(id) {
        var _this4 = this;

        if (!this.author_promise) {
          this.author_promise = new Promise(function (resolve, reject) {
            if (!id) {
              resolve(false);
              return;
            }

            var author = _this4.cache.get_author(id);

            if (author) {
              resolve(author);
              return;
            }

            var path = '/wp/v2/users/' + id;
            wp.apiFetch({
              path: path
            }).then(function (data) {
              resolve(data);
            })["catch"](reject);
          });
          this.author_promise.then(function () {
            _this4.author_promise = null;
          });
        }

        return this.author_promise;
      }
    }, {
      key: "ids_numeric",
      value: function ids_numeric(ids) {
        if (!Array.isArray(ids)) {
          return false;
        }

        return ids.reduce(function (all_numeric, id) {
          var is_numeric = !isNaN(id);
          return all_numeric && is_numeric;
        }, true);
      }
    }, {
      key: "ids_slugs",
      value: function ids_slugs(ids) {
        if (!Array.isArray(ids)) {
          return false;
        }

        return ids.reduce(function (all_slugs, id) {
          var is_slug = isNaN(id);
          return all_slugs && is_slug;
        }, true);
      }
    }]);

    return PostObjectFetcher;
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

  var MacroReplacement =
  /*#__PURE__*/
  function () {
    /**
     * @param postObjectFetcher {PostObjectFetcher}
     */
    function MacroReplacement(postObjectFetcher) {
      _classCallCheck(this, MacroReplacement);

      this.fetcher = postObjectFetcher;
    }
    /**
     * @param date {Date}
     * @param format {string}
     */


    _createClass(MacroReplacement, [{
      key: "format_date",
      value: function format_date(date, format) {
        return wp.date.dateI18n(format, date);
      }
      /**
       * @param {Post} post
       */

    }, {
      key: "get_excerpt_or_trimmed_content",
      value: function get_excerpt_or_trimmed_content(post) {
        return this.get_trimmed_excerpt(post.get_excerpt(), post.get_content());
      }
    }, {
      key: "get_trimmed_excerpt",
      value: function get_trimmed_excerpt(excerpt, content) {
        var string = !!excerpt ? excerpt : content,
            metadesc_max_length = Config_Values.get('metadesc_max_length', 'replacement'); // Strip all HTML tags

        string = String_Utils.strip_html(string); // Normalize whitespace

        string = String_Utils.normalize_whitespace(string);
        var shortcode_position = string.indexOf('[');

        if (shortcode_position !== -1 && shortcode_position < metadesc_max_length) {
          // Remove shortcodes but keep the content
          string = String_Utils.remove_shortcodes(string);
        } // TODO: Encode any HTML entities like > and <


        return this.truncate_meta_description(string, metadesc_max_length);
      }
    }, {
      key: "truncate_meta_description",
      value: function truncate_meta_description(string, metadesc_max_length) {
        return String_Utils.truncate_string(string, metadesc_max_length);
      }
      /**
       * @param text
       * @param {Term} term
       * @returns {Promise<unknown>}
       */

    }, {
      key: "replace_term_macros",
      value: function replace_term_macros(text, term) {
        var specific_replacements = {
          '%%id%%': term.get_id(),
          '%%term_title%%': term.get_title(),
          '%%term_description%%': term.get_description()
        };

        if (term.get_taxonomy() === 'category') {
          specific_replacements['%%category%%'] = term.get_title();
          specific_replacements['%%category_description%%'] = term.get_description();
        } else if (term.get_taxonomy() === 'post_tag') {
          specific_replacements['%%tag%%'] = term.get_title();
          specific_replacements['%%tag_description%%'] = term.get_description();
        }

        return this.do_replace(text, {}, specific_replacements);
      }
      /**
       * @param text
       * @param {Post} post
       */

    }, {
      key: "replace",
      value: function replace(text, post) {
        var _this = this;

        var fetcher = this.fetcher;
        var load_required = {
          "%%name%%": function name() {
            return new Promise(function (resolve, reject) {
              fetcher.fetch_author_data(post.get_author_id()).then(function (author) {
                var name = author && author.name ? author.name : '',
                    macro = {
                  "%%name%%": name
                };
                resolve(macro);
              })["catch"](reject);
            });
          },
          "%%category%%": function category(matches) {
            var field = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'name';
            var first_only = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
            return new Promise(function (resolve, reject) {
              fetcher.fetch_category_data(post.get_category_ids()).then(function (categories) {
                var category_names = _this.get_term_macro_value(categories, field, first_only),
                    macro = {};

                if (matches && matches.length) {
                  macro[matches[0]] = category_names;
                }

                resolve(macro);
              })["catch"](reject);
            });
          },
          "%%tag%%": function tag(matches) {
            var field = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'name';
            var first_only = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
            return new Promise(function (resolve, reject) {
              fetcher.fetch_tag_data(post.get_tag_ids()).then(function (tags) {
                var tags_names = _this.get_term_macro_value(tags, field, first_only),
                    macro = {};

                if (matches && matches.length) {
                  macro[matches[0]] = tags_names;
                }

                resolve(macro);
              })["catch"](reject);
            });
          }
        };

        load_required['%%ct_(desc_){0,1}([a-z_]*)%%'] = function (matches) {
          var field = 'name';

          if (matches.length === 3 && matches[1] === 'desc_') {
            field = 'description';
          }

          var taxonomy = matches[2];

          if (taxonomy === 'category') {
            var category = load_required['%%category%%'];
            return category(matches, field, true);
          } else if (taxonomy === 'post_tag') {
            var tag = load_required['%%tag%%'];
            return tag(matches, field, true);
          }

          return new Promise(function (resolve, reject) {
            fetcher.fetch_taxonomy_terms(taxonomy, post.get_taxonomy_terms(taxonomy)).then(function (terms) {
              var term_names = _this.get_term_macro_value(terms, field, true),
                  macro = {};

              if (matches && matches.length) {
                macro[matches[0]] = term_names;
              }

              resolve(macro);
            })["catch"](reject);
          });
        };

        return this.do_replace(text, load_required, {
          "%%id%%": post.get_id(),
          "%%title%%": post.get_title(),
          "%%excerpt%%": this.get_excerpt_or_trimmed_content(post),
          "%%excerpt_only%%": post.get_excerpt(),
          "%%modified%%": this.format_date(post.get_modified(), 'Y-m-d H:i:s'),
          "%%date%%": this.format_date(post.get_date(), this.get_date_format()),
          "%%userid%%": post.get_author_id(),
          "%%caption%%": post.get_excerpt()
        });
      }
    }, {
      key: "do_replace",
      value: function do_replace(text, dynamic_macros, specific_replacements) {
        var _this2 = this;

        var promises = [];
        Object.keys(dynamic_macros).forEach(function (macro) {
          var callback = dynamic_macros[macro],
              all_matches = _toConsumableArray(text.matchAll(macro));

          if (all_matches && all_matches.length) {
            all_matches.forEach(function (match) {
              if (match && match.length) {
                promises.push(callback(match));
              }
            });
          }
        });
        return new Promise(function (resolve, reject) {
          Promise.all(promises).then(function (loaded) {
            loaded.push(specific_replacements);
            loaded.push(_this2.get_general_replacements());
            var replacements = loaded.reduce(function (result, current) {
              return Object.assign(result, current);
            }, {});
            Object.keys(replacements).forEach(function (macro_key) {
              var regex = new RegExp(macro_key, 'g');
              text = text.replace(regex, replacements[macro_key]);
            }); // Strip out any remaining unrecognized macros

            var unrecognizedMacrosRegex = new RegExp('%%[a-zA-Z_]*%%', 'g');
            text = text.replace(unrecognizedMacrosRegex, '');
            resolve(text);
          })["catch"](reject);
        });
      }
    }, {
      key: "get_term_macro_value",
      value: function get_term_macro_value(terms, field, first_only) {
        if (!Array.isArray(terms)) {
          terms = [];
        }

        terms = _.sortBy(terms, function (term) {
          return term.name;
        });
        var values = terms.reduce(function (result, item) {
          if (item.hasOwnProperty(field)) {
            result.push(item[field]);
          }

          return result;
        }, []);
        return first_only && values.length ? values[0] : values.join(', ');
      }
    }, {
      key: "get_general_replacements",
      value: function get_general_replacements() {
        var timeFormat = Config_Values.get('time_format', 'replacement');
        return {
          "%%sep%%": this.get_global('sep'),
          "%%sitename%%": this.get_global('sitename'),
          "%%sitedesc%%": this.get_global('sitedesc'),
          '%%page%%': this.get_global('page'),
          '%%pagetotal%%': this.get_global('pagetotal'),
          '%%pagenumber%%': this.get_global('pagenumber'),
          '%%spell_pagenumber%%': this.get_global('spell_pagenumber'),
          '%%spell_pagetotal%%': this.get_global('spell_pagetotal'),
          '%%spell_page%%': this.get_global('spell_page'),
          "%%currenttime%%": this.format_date(new Date(), timeFormat),
          "%%currentdate%%": this.format_date(new Date(), this.get_date_format()),
          "%%currentmonth%%": this.format_date(new Date(), 'F'),
          "%%currentyear%%": this.format_date(new Date(), 'Y')
        };
      }
    }, {
      key: "get_date_format",
      value: function get_date_format() {
        return Config_Values.get('date_format', 'replacement');
      }
    }, {
      key: "get_global",
      value: function get_global(key) {
        return Config_Values.get(['replacements', key], 'replacement');
      }
    }]);

    return MacroReplacement;
  }();

  (function () {
    var postObjectsCache = new PostObjectsCache();
    var postObjectFetcher = new PostObjectFetcher(postObjectsCache);
    window.Wds.macroReplacement = new MacroReplacement(postObjectFetcher);
  })(jQuery);

}(wp, jQuery, _));

//# sourceMappingURL=wds-macro-replacement.js.map