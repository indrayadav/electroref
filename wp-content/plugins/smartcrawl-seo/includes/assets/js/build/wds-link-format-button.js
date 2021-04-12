(function (wp) {
  'use strict';

  wp = wp && Object.prototype.hasOwnProperty.call(wp, 'default') ? wp['default'] : wp;

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

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  function ownKeys(object, enumerableOnly) {
    var keys = Object.keys(object);

    if (Object.getOwnPropertySymbols) {
      var symbols = Object.getOwnPropertySymbols(object);
      if (enumerableOnly) symbols = symbols.filter(function (sym) {
        return Object.getOwnPropertyDescriptor(object, sym).enumerable;
      });
      keys.push.apply(keys, symbols);
    }

    return keys;
  }

  function _objectSpread2(target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i] != null ? arguments[i] : {};

      if (i % 2) {
        ownKeys(source, true).forEach(function (key) {
          _defineProperty(target, key, source[key]);
        });
      } else if (Object.getOwnPropertyDescriptors) {
        Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));
      } else {
        ownKeys(source).forEach(function (key) {
          Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
        });
      }
    }

    return target;
  }

  function _inherits(subClass, superClass) {
    if (typeof superClass !== "function" && superClass !== null) {
      throw new TypeError("Super expression must either be null or a function");
    }

    subClass.prototype = Object.create(superClass && superClass.prototype, {
      constructor: {
        value: subClass,
        writable: true,
        configurable: true
      }
    });
    if (superClass) _setPrototypeOf(subClass, superClass);
  }

  function _getPrototypeOf(o) {
    _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
      return o.__proto__ || Object.getPrototypeOf(o);
    };
    return _getPrototypeOf(o);
  }

  function _setPrototypeOf(o, p) {
    _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
      o.__proto__ = p;
      return o;
    };

    return _setPrototypeOf(o, p);
  }

  function _objectWithoutPropertiesLoose(source, excluded) {
    if (source == null) return {};
    var target = {};
    var sourceKeys = Object.keys(source);
    var key, i;

    for (i = 0; i < sourceKeys.length; i++) {
      key = sourceKeys[i];
      if (excluded.indexOf(key) >= 0) continue;
      target[key] = source[key];
    }

    return target;
  }

  function _objectWithoutProperties(source, excluded) {
    if (source == null) return {};

    var target = _objectWithoutPropertiesLoose(source, excluded);

    var key, i;

    if (Object.getOwnPropertySymbols) {
      var sourceSymbolKeys = Object.getOwnPropertySymbols(source);

      for (i = 0; i < sourceSymbolKeys.length; i++) {
        key = sourceSymbolKeys[i];
        if (excluded.indexOf(key) >= 0) continue;
        if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue;
        target[key] = source[key];
      }
    }

    return target;
  }

  function _assertThisInitialized(self) {
    if (self === void 0) {
      throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
    }

    return self;
  }

  function _possibleConstructorReturn(self, call) {
    if (call && (typeof call === "object" || typeof call === "function")) {
      return call;
    }

    return _assertThisInitialized(self);
  }

  function _slicedToArray(arr, i) {
    return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _nonIterableRest();
  }

  function _arrayWithHoles(arr) {
    if (Array.isArray(arr)) return arr;
  }

  function _iterableToArrayLimit(arr, i) {
    if (!(Symbol.iterator in Object(arr) || Object.prototype.toString.call(arr) === "[object Arguments]")) {
      return;
    }

    var _arr = [];
    var _n = true;
    var _d = false;
    var _e = undefined;

    try {
      for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) {
        _arr.push(_s.value);

        if (i && _arr.length === i) break;
      }
    } catch (err) {
      _d = true;
      _e = err;
    } finally {
      try {
        if (!_n && _i["return"] != null) _i["return"]();
      } finally {
        if (_d) throw _e;
      }
    }

    return _arr;
  }

  function _nonIterableRest() {
    throw new TypeError("Invalid attempt to destructure non-iterable instance");
  }

  if (((wp || {}).blockEditor || {}).__experimentalLinkControl) {
    Promise.resolve().then(function () { return linkFormatButton; }).then(function (_ref) {
      var link = _ref.link;
      var _wp$richText = wp.richText,
          registerFormatType = _wp$richText.registerFormatType,
          unregisterFormatType = _wp$richText.unregisterFormatType;
      [link].forEach(function (_ref2) {
        var name = _ref2.name,
            settings = _objectWithoutProperties(_ref2, ["name"]);

        unregisterFormatType(name);
        registerFormatType(name, settings);
      });
    });
  } else {
    console.log('SmartCrawl: wp.blockEditor.__experimentalLinkControl not found');
  }

  /** Detect free variable `global` from Node.js. */
  var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

  /** Detect free variable `self`. */
  var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

  /** Used as a reference to the global object. */
  var root = freeGlobal || freeSelf || Function('return this')();

  /** Built-in value references. */
  var Symbol$1 = root.Symbol;

  /** Used for built-in method references. */
  var objectProto = Object.prototype;

  /** Used to check objects for own properties. */
  var hasOwnProperty = objectProto.hasOwnProperty;

  /**
   * Used to resolve the
   * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
   * of values.
   */
  var nativeObjectToString = objectProto.toString;

  /** Built-in value references. */
  var symToStringTag = Symbol$1 ? Symbol$1.toStringTag : undefined;

  /**
   * A specialized version of `baseGetTag` which ignores `Symbol.toStringTag` values.
   *
   * @private
   * @param {*} value The value to query.
   * @returns {string} Returns the raw `toStringTag`.
   */
  function getRawTag(value) {
    var isOwn = hasOwnProperty.call(value, symToStringTag),
        tag = value[symToStringTag];

    try {
      value[symToStringTag] = undefined;
      var unmasked = true;
    } catch (e) {}

    var result = nativeObjectToString.call(value);
    if (unmasked) {
      if (isOwn) {
        value[symToStringTag] = tag;
      } else {
        delete value[symToStringTag];
      }
    }
    return result;
  }

  /** Used for built-in method references. */
  var objectProto$1 = Object.prototype;

  /**
   * Used to resolve the
   * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
   * of values.
   */
  var nativeObjectToString$1 = objectProto$1.toString;

  /**
   * Converts `value` to a string using `Object.prototype.toString`.
   *
   * @private
   * @param {*} value The value to convert.
   * @returns {string} Returns the converted string.
   */
  function objectToString(value) {
    return nativeObjectToString$1.call(value);
  }

  /** `Object#toString` result references. */
  var nullTag = '[object Null]',
      undefinedTag = '[object Undefined]';

  /** Built-in value references. */
  var symToStringTag$1 = Symbol$1 ? Symbol$1.toStringTag : undefined;

  /**
   * The base implementation of `getTag` without fallbacks for buggy environments.
   *
   * @private
   * @param {*} value The value to query.
   * @returns {string} Returns the `toStringTag`.
   */
  function baseGetTag(value) {
    if (value == null) {
      return value === undefined ? undefinedTag : nullTag;
    }
    return (symToStringTag$1 && symToStringTag$1 in Object(value))
      ? getRawTag(value)
      : objectToString(value);
  }

  /**
   * Checks if `value` is object-like. A value is object-like if it's not `null`
   * and has a `typeof` result of "object".
   *
   * @static
   * @memberOf _
   * @since 4.0.0
   * @category Lang
   * @param {*} value The value to check.
   * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
   * @example
   *
   * _.isObjectLike({});
   * // => true
   *
   * _.isObjectLike([1, 2, 3]);
   * // => true
   *
   * _.isObjectLike(_.noop);
   * // => false
   *
   * _.isObjectLike(null);
   * // => false
   */
  function isObjectLike(value) {
    return value != null && typeof value == 'object';
  }

  /** `Object#toString` result references. */
  var symbolTag = '[object Symbol]';

  /**
   * Checks if `value` is classified as a `Symbol` primitive or object.
   *
   * @static
   * @memberOf _
   * @since 4.0.0
   * @category Lang
   * @param {*} value The value to check.
   * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
   * @example
   *
   * _.isSymbol(Symbol.iterator);
   * // => true
   *
   * _.isSymbol('abc');
   * // => false
   */
  function isSymbol(value) {
    return typeof value == 'symbol' ||
      (isObjectLike(value) && baseGetTag(value) == symbolTag);
  }

  /**
   * A specialized version of `_.map` for arrays without support for iteratee
   * shorthands.
   *
   * @private
   * @param {Array} [array] The array to iterate over.
   * @param {Function} iteratee The function invoked per iteration.
   * @returns {Array} Returns the new mapped array.
   */
  function arrayMap(array, iteratee) {
    var index = -1,
        length = array == null ? 0 : array.length,
        result = Array(length);

    while (++index < length) {
      result[index] = iteratee(array[index], index, array);
    }
    return result;
  }

  /**
   * Checks if `value` is classified as an `Array` object.
   *
   * @static
   * @memberOf _
   * @since 0.1.0
   * @category Lang
   * @param {*} value The value to check.
   * @returns {boolean} Returns `true` if `value` is an array, else `false`.
   * @example
   *
   * _.isArray([1, 2, 3]);
   * // => true
   *
   * _.isArray(document.body.children);
   * // => false
   *
   * _.isArray('abc');
   * // => false
   *
   * _.isArray(_.noop);
   * // => false
   */
  var isArray = Array.isArray;

  /** Used as references for various `Number` constants. */
  var INFINITY = 1 / 0;

  /** Used to convert symbols to primitives and strings. */
  var symbolProto = Symbol$1 ? Symbol$1.prototype : undefined,
      symbolToString = symbolProto ? symbolProto.toString : undefined;

  /**
   * The base implementation of `_.toString` which doesn't convert nullish
   * values to empty strings.
   *
   * @private
   * @param {*} value The value to process.
   * @returns {string} Returns the string.
   */
  function baseToString(value) {
    // Exit early for strings to avoid a performance hit in some environments.
    if (typeof value == 'string') {
      return value;
    }
    if (isArray(value)) {
      // Recursively convert values (susceptible to call stack limits).
      return arrayMap(value, baseToString) + '';
    }
    if (isSymbol(value)) {
      return symbolToString ? symbolToString.call(value) : '';
    }
    var result = (value + '');
    return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
  }

  /**
   * Checks if `value` is the
   * [language type](http://www.ecma-international.org/ecma-262/7.0/#sec-ecmascript-language-types)
   * of `Object`. (e.g. arrays, functions, objects, regexes, `new Number(0)`, and `new String('')`)
   *
   * @static
   * @memberOf _
   * @since 0.1.0
   * @category Lang
   * @param {*} value The value to check.
   * @returns {boolean} Returns `true` if `value` is an object, else `false`.
   * @example
   *
   * _.isObject({});
   * // => true
   *
   * _.isObject([1, 2, 3]);
   * // => true
   *
   * _.isObject(_.noop);
   * // => true
   *
   * _.isObject(null);
   * // => false
   */
  function isObject(value) {
    var type = typeof value;
    return value != null && (type == 'object' || type == 'function');
  }

  /** Used as references for various `Number` constants. */
  var NAN = 0 / 0;

  /** Used to match leading and trailing whitespace. */
  var reTrim = /^\s+|\s+$/g;

  /** Used to detect bad signed hexadecimal string values. */
  var reIsBadHex = /^[-+]0x[0-9a-f]+$/i;

  /** Used to detect binary string values. */
  var reIsBinary = /^0b[01]+$/i;

  /** Used to detect octal string values. */
  var reIsOctal = /^0o[0-7]+$/i;

  /** Built-in method references without a dependency on `root`. */
  var freeParseInt = parseInt;

  /**
   * Converts `value` to a number.
   *
   * @static
   * @memberOf _
   * @since 4.0.0
   * @category Lang
   * @param {*} value The value to process.
   * @returns {number} Returns the number.
   * @example
   *
   * _.toNumber(3.2);
   * // => 3.2
   *
   * _.toNumber(Number.MIN_VALUE);
   * // => 5e-324
   *
   * _.toNumber(Infinity);
   * // => Infinity
   *
   * _.toNumber('3.2');
   * // => 3.2
   */
  function toNumber(value) {
    if (typeof value == 'number') {
      return value;
    }
    if (isSymbol(value)) {
      return NAN;
    }
    if (isObject(value)) {
      var other = typeof value.valueOf == 'function' ? value.valueOf() : value;
      value = isObject(other) ? (other + '') : other;
    }
    if (typeof value != 'string') {
      return value === 0 ? value : +value;
    }
    value = value.replace(reTrim, '');
    var isBinary = reIsBinary.test(value);
    return (isBinary || reIsOctal.test(value))
      ? freeParseInt(value.slice(2), isBinary ? 2 : 8)
      : (reIsBadHex.test(value) ? NAN : +value);
  }

  /** Used as references for various `Number` constants. */
  var INFINITY$1 = 1 / 0,
      MAX_INTEGER = 1.7976931348623157e+308;

  /**
   * Converts `value` to a finite number.
   *
   * @static
   * @memberOf _
   * @since 4.12.0
   * @category Lang
   * @param {*} value The value to convert.
   * @returns {number} Returns the converted number.
   * @example
   *
   * _.toFinite(3.2);
   * // => 3.2
   *
   * _.toFinite(Number.MIN_VALUE);
   * // => 5e-324
   *
   * _.toFinite(Infinity);
   * // => 1.7976931348623157e+308
   *
   * _.toFinite('3.2');
   * // => 3.2
   */
  function toFinite(value) {
    if (!value) {
      return value === 0 ? value : 0;
    }
    value = toNumber(value);
    if (value === INFINITY$1 || value === -INFINITY$1) {
      var sign = (value < 0 ? -1 : 1);
      return sign * MAX_INTEGER;
    }
    return value === value ? value : 0;
  }

  /**
   * Converts `value` to an integer.
   *
   * **Note:** This method is loosely based on
   * [`ToInteger`](http://www.ecma-international.org/ecma-262/7.0/#sec-tointeger).
   *
   * @static
   * @memberOf _
   * @since 4.0.0
   * @category Lang
   * @param {*} value The value to convert.
   * @returns {number} Returns the converted integer.
   * @example
   *
   * _.toInteger(3.2);
   * // => 3
   *
   * _.toInteger(Number.MIN_VALUE);
   * // => 0
   *
   * _.toInteger(Infinity);
   * // => 1.7976931348623157e+308
   *
   * _.toInteger('3.2');
   * // => 3
   */
  function toInteger(value) {
    var result = toFinite(value),
        remainder = result % 1;

    return result === result ? (remainder ? result - remainder : result) : 0;
  }

  /**
   * Converts `value` to a string. An empty string is returned for `null`
   * and `undefined` values. The sign of `-0` is preserved.
   *
   * @static
   * @memberOf _
   * @since 4.0.0
   * @category Lang
   * @param {*} value The value to convert.
   * @returns {string} Returns the converted string.
   * @example
   *
   * _.toString(null);
   * // => ''
   *
   * _.toString(-0);
   * // => '-0'
   *
   * _.toString([1, 2, 3]);
   * // => '1,2,3'
   */
  function toString(value) {
    return value == null ? '' : baseToString(value);
  }

  /**
   * The base implementation of `_.clamp` which doesn't coerce arguments.
   *
   * @private
   * @param {number} number The number to clamp.
   * @param {number} [lower] The lower bound.
   * @param {number} upper The upper bound.
   * @returns {number} Returns the clamped number.
   */
  function baseClamp(number, lower, upper) {
    if (number === number) {
      if (upper !== undefined) {
        number = number <= upper ? number : upper;
      }
      if (lower !== undefined) {
        number = number >= lower ? number : lower;
      }
    }
    return number;
  }

  /**
   * Checks if `string` starts with the given target string.
   *
   * @static
   * @memberOf _
   * @since 3.0.0
   * @category String
   * @param {string} [string=''] The string to inspect.
   * @param {string} [target] The string to search for.
   * @param {number} [position=0] The position to search from.
   * @returns {boolean} Returns `true` if `string` starts with `target`,
   *  else `false`.
   * @example
   *
   * _.startsWith('abc', 'a');
   * // => true
   *
   * _.startsWith('abc', 'b');
   * // => false
   *
   * _.startsWith('abc', 'b', 1);
   * // => true
   */
  function startsWith(string, target, position) {
    string = toString(string);
    position = position == null
      ? 0
      : baseClamp(toInteger(position), 0, string.length);

    target = baseToString(target);
    return string.slice(position, position + target.length) == target;
  }

  /** Used to generate unique IDs. */
  var idCounter = 0;

  /**
   * Generates a unique ID. If `prefix` is given, the ID is appended to it.
   *
   * @static
   * @since 0.1.0
   * @memberOf _
   * @category Util
   * @param {string} [prefix=''] The value to prefix the ID with.
   * @returns {string} Returns the unique ID.
   * @example
   *
   * _.uniqueId('contact_');
   * // => 'contact_104'
   *
   * _.uniqueId();
   * // => '105'
   */
  function uniqueId(prefix) {
    var id = ++idCounter;
    return toString(prefix) + id;
  }

  var _wp$url = wp.url,
      getProtocol = _wp$url.getProtocol,
      isValidProtocol = _wp$url.isValidProtocol,
      getAuthority = _wp$url.getAuthority,
      isValidAuthority = _wp$url.isValidAuthority,
      getPath = _wp$url.getPath,
      isValidPath = _wp$url.isValidPath,
      getQueryString = _wp$url.getQueryString,
      isValidQueryString = _wp$url.isValidQueryString,
      getFragment = _wp$url.getFragment,
      isValidFragment = _wp$url.isValidFragment;
  function isValidHref(href) {
    if (!href) {
      return false;
    }

    var trimmedHref = href.trim();

    if (!trimmedHref) {
      return false;
    } // Does the href start with something that looks like a URL protocol?


    if (/^\S+:/.test(trimmedHref)) {
      var protocol = getProtocol(trimmedHref);

      if (!isValidProtocol(protocol)) {
        return false;
      } // Add some extra checks for http(s) URIs, since these are the most common use-case.
      // This ensures URIs with an http protocol have exactly two forward slashes following the protocol.


      if (startsWith(protocol, 'http') && !/^https?:\/\/[^\/\s]/i.test(trimmedHref)) {
        return false;
      }

      var authority = getAuthority(trimmedHref);

      if (!isValidAuthority(authority)) {
        return false;
      }

      var path = getPath(trimmedHref);

      if (path && !isValidPath(path)) {
        return false;
      }

      var queryString = getQueryString(trimmedHref);

      if (queryString && !isValidQueryString(queryString)) {
        return false;
      }

      var fragment = getFragment(trimmedHref);

      if (fragment && !isValidFragment(fragment)) {
        return false;
      }
    } // Validate anchor links.


    if (startsWith(trimmedHref, '#') && !isValidFragment(trimmedHref)) {
      return false;
    }

    return true;
  }
  function createLinkFormat(_ref) {
    var url = _ref.url,
        type = _ref.type,
        id = _ref.id,
        opensInNewWindow = _ref.opensInNewWindow,
        relSponsored = _ref.relSponsored,
        relUgc = _ref.relUgc,
        relNofollow = _ref.relNofollow;
    var format = {
      type: 'core/link',
      attributes: {
        url: url
      }
    };
    if (type) format.attributes.type = type;
    if (id) format.attributes.id = id;
    var rel = [];

    if (opensInNewWindow) {
      format.attributes.target = '_blank';
      rel.push('noreferrer');
      rel.push('noopener');
    }

    if (relSponsored) {
      rel.push('sponsored');
    }

    if (relUgc) {
      rel.push('ugc');
    }

    if (relNofollow) {
      rel.push('nofollow');
    }

    if (rel.length) {
      format.attributes.rel = rel.join(' ');
    }

    return format;
  }

  var _wp$element = wp.element,
      useMemo = _wp$element.useMemo,
      useState = _wp$element.useState;
  var __ = wp.i18n.__;
  var _wp$components = wp.components,
      withSpokenMessages = _wp$components.withSpokenMessages,
      Popover = _wp$components.Popover;
  var prependHTTP = wp.url.prependHTTP;
  var _wp$richText = wp.richText,
      create = _wp$richText.create,
      insert = _wp$richText.insert,
      isCollapsed = _wp$richText.isCollapsed,
      applyFormat = _wp$richText.applyFormat;
  var __experimentalLinkControl = wp.blockEditor.__experimentalLinkControl;
  var LinkControl = __experimentalLinkControl;
  var customLinkControlSettings = [{
    id: 'opensInNewTab',
    title: __('Open in new tab')
  }, {
    id: 'relSponsored',
    title: __('Sponsored link')
  }, {
    id: 'relUgc',
    title: __('User generated content')
  }, {
    id: 'relNofollow',
    title: __('Nofollow')
  }];

  function InlineLinkUI(_ref) {
    var isActive = _ref.isActive,
        activeAttributes = _ref.activeAttributes,
        addingLink = _ref.addingLink,
        value = _ref.value,
        onChange = _ref.onChange,
        speak = _ref.speak,
        stopAddingLink = _ref.stopAddingLink;
    var mountingKey = useMemo(uniqueId, [addingLink]);

    var _useState = useState(),
        _useState2 = _slicedToArray(_useState, 2),
        nextLinkValue = _useState2[0],
        setNextLinkValue = _useState2[1];

    var anchorRef = useMemo(function () {
      var selection = window.getSelection();

      if (!selection.rangeCount) {
        return;
      }

      var range = selection.getRangeAt(0);

      if (addingLink && !isActive) {
        return range;
      }

      var element = range.startContainer; // If the caret is right before the element, select the next element.

      element = element.nextElementSibling || element;

      while (element.nodeType !== window.Node.ELEMENT_NODE) {
        element = element.parentNode;
      }

      return element.closest('a');
    }, [addingLink, value.start, value.end]);

    var linkValue = _objectSpread2({
      url: activeAttributes.url,
      type: activeAttributes.type,
      id: activeAttributes.id,
      opensInNewTab: activeAttributes.target === '_blank',
      relSponsored: !!activeAttributes.rel && activeAttributes.rel.includes('sponsored'),
      relUgc: !!activeAttributes.rel && activeAttributes.rel.includes('ugc'),
      relNofollow: !!activeAttributes.rel && activeAttributes.rel.includes('nofollow')
    }, nextLinkValue);

    function onChangeLink(nextValue) {
      nextValue = _objectSpread2({}, nextLinkValue, {}, nextValue);
      var didToggleSetting = (linkValue.opensInNewTab !== nextValue.opensInNewTab || linkValue.relSponsored !== nextValue.relSponsored || linkValue.relUgc !== nextValue.relUgc || linkValue.relNofollow !== nextValue.relNofollow) && linkValue.url === nextValue.url;
      var didToggleSettingForNewLink = didToggleSetting && nextValue.url === undefined;
      setNextLinkValue(didToggleSettingForNewLink ? nextValue : undefined);

      if (didToggleSettingForNewLink) {
        return;
      }

      var newUrl = prependHTTP(nextValue.url);
      var format = createLinkFormat({
        url: newUrl,
        type: nextValue.type,
        id: nextValue.id !== undefined && nextValue.id !== null ? String(nextValue.id) : undefined,
        opensInNewWindow: nextValue.opensInNewTab,
        relSponsored: nextValue.relSponsored,
        relUgc: nextValue.relUgc,
        relNofollow: nextValue.relNofollow
      });

      if (isCollapsed(value) && !isActive) {
        var newText = nextValue.title || newUrl;
        var toInsert = applyFormat(create({
          text: newText
        }), format, 0, newText.length);
        onChange(insert(value, toInsert));
      } else {
        var newValue = applyFormat(value, format);
        newValue.start = newValue.end;
        newValue.activeFormats = [];
        onChange(newValue);
      }

      if (!didToggleSetting) {
        stopAddingLink();
      }

      if (!isValidHref(newUrl)) {
        speak(__('Warning: the link has been inserted but may have errors. Please test it.'), 'assertive');
      } else if (isActive) {
        speak(__('Link edited.'), 'assertive');
      } else {
        speak(__('Link inserted.'), 'assertive');
      }
    }

    return wp.element.createElement(Popover, {
      key: mountingKey,
      anchorRef: anchorRef,
      focusOnMount: addingLink ? 'firstElement' : false,
      onClose: stopAddingLink,
      position: "bottom center"
    }, wp.element.createElement(LinkControl, {
      value: linkValue,
      onChange: onChangeLink,
      settings: customLinkControlSettings,
      forceIsEditingLink: addingLink
    }));
  }

  var InlineLinkUI$1 = withSpokenMessages(InlineLinkUI);

  var __$1 = wp.i18n.__;
  var Component = wp.element.Component;
  var withSpokenMessages$1 = wp.components.withSpokenMessages;
  var _wp$richText$1 = wp.richText,
      getTextContent = _wp$richText$1.getTextContent,
      applyFormat$1 = _wp$richText$1.applyFormat,
      removeFormat = _wp$richText$1.removeFormat,
      slice = _wp$richText$1.slice,
      isCollapsed$1 = _wp$richText$1.isCollapsed;
  var _wp$url$1 = wp.url,
      isURL = _wp$url$1.isURL,
      isEmail = _wp$url$1.isEmail;
  var _wp$blockEditor = wp.blockEditor,
      RichTextToolbarButton = _wp$blockEditor.RichTextToolbarButton,
      RichTextShortcut = _wp$blockEditor.RichTextShortcut;
  var decodeEntities = wp.htmlEntities.decodeEntities;
  var linkIcon = 'admin-links';
  var linkOff = 'editor-unlink';
  var name = 'core/link';

  var title = __$1('Link');

  var link = {
    name: name,
    title: title,
    tagName: 'a',
    className: null,
    attributes: {
      url: 'href',
      type: 'data-type',
      id: 'data-id',
      target: 'target',
      rel: 'rel'
    },
    __unstablePasteRule: function __unstablePasteRule(value, _ref) {
      var html = _ref.html,
          plainText = _ref.plainText;

      if (isCollapsed$1(value)) {
        return value;
      }

      var pastedText = (html || plainText).replace(/<[^>]+>/g, '').trim(); // A URL was pasted, turn the selection into a link

      if (!isURL(pastedText)) {
        return value;
      } // Allows us to ask for this information when we get a report.


      window.console.log('Created link:\n\n', pastedText);
      return applyFormat$1(value, {
        type: name,
        attributes: {
          url: decodeEntities(pastedText)
        }
      });
    },
    edit: withSpokenMessages$1(
    /*#__PURE__*/
    function (_Component) {
      _inherits(LinkEdit, _Component);

      function LinkEdit() {
        var _this;

        _classCallCheck(this, LinkEdit);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(LinkEdit).apply(this, arguments));
        _this.addLink = _this.addLink.bind(_assertThisInitialized(_this));
        _this.stopAddingLink = _this.stopAddingLink.bind(_assertThisInitialized(_this));
        _this.onRemoveFormat = _this.onRemoveFormat.bind(_assertThisInitialized(_this));
        _this.state = {
          addingLink: false
        };
        return _this;
      }

      _createClass(LinkEdit, [{
        key: "addLink",
        value: function addLink() {
          var _this$props = this.props,
              value = _this$props.value,
              onChange = _this$props.onChange;
          var text = getTextContent(slice(value));

          if (text && isURL(text)) {
            onChange(applyFormat$1(value, {
              type: name,
              attributes: {
                url: text
              }
            }));
          } else if (text && isEmail(text)) {
            onChange(applyFormat$1(value, {
              type: name,
              attributes: {
                url: "mailto:".concat(text)
              }
            }));
          } else {
            this.setState({
              addingLink: true
            });
          }
        }
      }, {
        key: "stopAddingLink",
        value: function stopAddingLink() {
          this.setState({
            addingLink: false
          });
          this.props.onFocus();
        }
      }, {
        key: "onRemoveFormat",
        value: function onRemoveFormat() {
          var _this$props2 = this.props,
              value = _this$props2.value,
              onChange = _this$props2.onChange,
              speak = _this$props2.speak;
          onChange(removeFormat(value, name));
          speak(__$1('Link removed.'), 'assertive');
        }
      }, {
        key: "render",
        value: function render() {
          var _this$props3 = this.props,
              isActive = _this$props3.isActive,
              activeAttributes = _this$props3.activeAttributes,
              value = _this$props3.value,
              onChange = _this$props3.onChange;
          return wp.element.createElement(React.Fragment, null, wp.element.createElement(RichTextShortcut, {
            type: "primary",
            character: "k",
            onUse: this.addLink
          }), wp.element.createElement(RichTextShortcut, {
            type: "primaryShift",
            character: "k",
            onUse: this.onRemoveFormat
          }), isActive && wp.element.createElement(RichTextToolbarButton, {
            name: "link",
            icon: linkOff,
            title: __$1('Unlink'),
            onClick: this.onRemoveFormat,
            isActive: isActive,
            shortcutType: "primaryShift",
            shortcutCharacter: "k"
          }), !isActive && wp.element.createElement(RichTextToolbarButton, {
            name: "link",
            icon: linkIcon,
            title: title,
            onClick: this.addLink,
            isActive: isActive,
            shortcutType: "primary",
            shortcutCharacter: "k"
          }), (this.state.addingLink || isActive) && wp.element.createElement(InlineLinkUI$1, {
            addingLink: this.state.addingLink,
            stopAddingLink: this.stopAddingLink,
            isActive: isActive,
            activeAttributes: activeAttributes,
            value: value,
            onChange: onChange
          }));
        }
      }]);

      return LinkEdit;
    }(Component))
  };

  var linkFormatButton = /*#__PURE__*/Object.freeze({
    __proto__: null,
    link: link
  });

}(wp));

//# sourceMappingURL=wds-link-format-button.js.map