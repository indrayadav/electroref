(function (wp, _$1, $, Wds) {
  'use strict';

  wp = wp && Object.prototype.hasOwnProperty.call(wp, 'default') ? wp['default'] : wp;
  _$1 = _$1 && Object.prototype.hasOwnProperty.call(_$1, 'default') ? _$1['default'] : _$1;
  $ = $ && Object.prototype.hasOwnProperty.call($, 'default') ? $['default'] : $;
  Wds = Wds && Object.prototype.hasOwnProperty.call(Wds, 'default') ? Wds['default'] : Wds;

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

  /**
   * @author Toru Nagashima <https://github.com/mysticatea>
   * @copyright 2015 Toru Nagashima. All rights reserved.
   * See LICENSE file in root directory for full license.
   */
  /**
   * @typedef {object} PrivateData
   * @property {EventTarget} eventTarget The event target.
   * @property {{type:string}} event The original event object.
   * @property {number} eventPhase The current event phase.
   * @property {EventTarget|null} currentTarget The current event target.
   * @property {boolean} canceled The flag to prevent default.
   * @property {boolean} stopped The flag to stop propagation.
   * @property {boolean} immediateStopped The flag to stop propagation immediately.
   * @property {Function|null} passiveListener The listener if the current listener is passive. Otherwise this is null.
   * @property {number} timeStamp The unix time.
   * @private
   */

  /**
   * Private data for event wrappers.
   * @type {WeakMap<Event, PrivateData>}
   * @private
   */
  const privateData = new WeakMap();

  /**
   * Cache for wrapper classes.
   * @type {WeakMap<Object, Function>}
   * @private
   */
  const wrappers = new WeakMap();

  /**
   * Get private data.
   * @param {Event} event The event object to get private data.
   * @returns {PrivateData} The private data of the event.
   * @private
   */
  function pd(event) {
      const retv = privateData.get(event);
      console.assert(
          retv != null,
          "'this' is expected an Event object, but got",
          event
      );
      return retv
  }

  /**
   * https://dom.spec.whatwg.org/#set-the-canceled-flag
   * @param data {PrivateData} private data.
   */
  function setCancelFlag(data) {
      if (data.passiveListener != null) {
          if (
              typeof console !== "undefined" &&
              typeof console.error === "function"
          ) {
              console.error(
                  "Unable to preventDefault inside passive event listener invocation.",
                  data.passiveListener
              );
          }
          return
      }
      if (!data.event.cancelable) {
          return
      }

      data.canceled = true;
      if (typeof data.event.preventDefault === "function") {
          data.event.preventDefault();
      }
  }

  /**
   * @see https://dom.spec.whatwg.org/#interface-event
   * @private
   */
  /**
   * The event wrapper.
   * @constructor
   * @param {EventTarget} eventTarget The event target of this dispatching.
   * @param {Event|{type:string}} event The original event to wrap.
   */
  function Event$1(eventTarget, event) {
      privateData.set(this, {
          eventTarget,
          event,
          eventPhase: 2,
          currentTarget: eventTarget,
          canceled: false,
          stopped: false,
          immediateStopped: false,
          passiveListener: null,
          timeStamp: event.timeStamp || Date.now(),
      });

      // https://heycam.github.io/webidl/#Unforgeable
      Object.defineProperty(this, "isTrusted", { value: false, enumerable: true });

      // Define accessors
      const keys = Object.keys(event);
      for (let i = 0; i < keys.length; ++i) {
          const key = keys[i];
          if (!(key in this)) {
              Object.defineProperty(this, key, defineRedirectDescriptor(key));
          }
      }
  }

  // Should be enumerable, but class methods are not enumerable.
  Event$1.prototype = {
      /**
       * The type of this event.
       * @type {string}
       */
      get type() {
          return pd(this).event.type
      },

      /**
       * The target of this event.
       * @type {EventTarget}
       */
      get target() {
          return pd(this).eventTarget
      },

      /**
       * The target of this event.
       * @type {EventTarget}
       */
      get currentTarget() {
          return pd(this).currentTarget
      },

      /**
       * @returns {EventTarget[]} The composed path of this event.
       */
      composedPath() {
          const currentTarget = pd(this).currentTarget;
          if (currentTarget == null) {
              return []
          }
          return [currentTarget]
      },

      /**
       * Constant of NONE.
       * @type {number}
       */
      get NONE() {
          return 0
      },

      /**
       * Constant of CAPTURING_PHASE.
       * @type {number}
       */
      get CAPTURING_PHASE() {
          return 1
      },

      /**
       * Constant of AT_TARGET.
       * @type {number}
       */
      get AT_TARGET() {
          return 2
      },

      /**
       * Constant of BUBBLING_PHASE.
       * @type {number}
       */
      get BUBBLING_PHASE() {
          return 3
      },

      /**
       * The target of this event.
       * @type {number}
       */
      get eventPhase() {
          return pd(this).eventPhase
      },

      /**
       * Stop event bubbling.
       * @returns {void}
       */
      stopPropagation() {
          const data = pd(this);

          data.stopped = true;
          if (typeof data.event.stopPropagation === "function") {
              data.event.stopPropagation();
          }
      },

      /**
       * Stop event bubbling.
       * @returns {void}
       */
      stopImmediatePropagation() {
          const data = pd(this);

          data.stopped = true;
          data.immediateStopped = true;
          if (typeof data.event.stopImmediatePropagation === "function") {
              data.event.stopImmediatePropagation();
          }
      },

      /**
       * The flag to be bubbling.
       * @type {boolean}
       */
      get bubbles() {
          return Boolean(pd(this).event.bubbles)
      },

      /**
       * The flag to be cancelable.
       * @type {boolean}
       */
      get cancelable() {
          return Boolean(pd(this).event.cancelable)
      },

      /**
       * Cancel this event.
       * @returns {void}
       */
      preventDefault() {
          setCancelFlag(pd(this));
      },

      /**
       * The flag to indicate cancellation state.
       * @type {boolean}
       */
      get defaultPrevented() {
          return pd(this).canceled
      },

      /**
       * The flag to be composed.
       * @type {boolean}
       */
      get composed() {
          return Boolean(pd(this).event.composed)
      },

      /**
       * The unix time of this event.
       * @type {number}
       */
      get timeStamp() {
          return pd(this).timeStamp
      },

      /**
       * The target of this event.
       * @type {EventTarget}
       * @deprecated
       */
      get srcElement() {
          return pd(this).eventTarget
      },

      /**
       * The flag to stop event bubbling.
       * @type {boolean}
       * @deprecated
       */
      get cancelBubble() {
          return pd(this).stopped
      },
      set cancelBubble(value) {
          if (!value) {
              return
          }
          const data = pd(this);

          data.stopped = true;
          if (typeof data.event.cancelBubble === "boolean") {
              data.event.cancelBubble = true;
          }
      },

      /**
       * The flag to indicate cancellation state.
       * @type {boolean}
       * @deprecated
       */
      get returnValue() {
          return !pd(this).canceled
      },
      set returnValue(value) {
          if (!value) {
              setCancelFlag(pd(this));
          }
      },

      /**
       * Initialize this event object. But do nothing under event dispatching.
       * @param {string} type The event type.
       * @param {boolean} [bubbles=false] The flag to be possible to bubble up.
       * @param {boolean} [cancelable=false] The flag to be possible to cancel.
       * @deprecated
       */
      initEvent() {
          // Do nothing.
      },
  };

  // `constructor` is not enumerable.
  Object.defineProperty(Event$1.prototype, "constructor", {
      value: Event$1,
      configurable: true,
      writable: true,
  });

  // Ensure `event instanceof window.Event` is `true`.
  if (typeof window !== "undefined" && typeof window.Event !== "undefined") {
      Object.setPrototypeOf(Event$1.prototype, window.Event.prototype);

      // Make association for wrappers.
      wrappers.set(window.Event.prototype, Event$1);
  }

  /**
   * Get the property descriptor to redirect a given property.
   * @param {string} key Property name to define property descriptor.
   * @returns {PropertyDescriptor} The property descriptor to redirect the property.
   * @private
   */
  function defineRedirectDescriptor(key) {
      return {
          get() {
              return pd(this).event[key]
          },
          set(value) {
              pd(this).event[key] = value;
          },
          configurable: true,
          enumerable: true,
      }
  }

  /**
   * Get the property descriptor to call a given method property.
   * @param {string} key Property name to define property descriptor.
   * @returns {PropertyDescriptor} The property descriptor to call the method property.
   * @private
   */
  function defineCallDescriptor(key) {
      return {
          value() {
              const event = pd(this).event;
              return event[key].apply(event, arguments)
          },
          configurable: true,
          enumerable: true,
      }
  }

  /**
   * Define new wrapper class.
   * @param {Function} BaseEvent The base wrapper class.
   * @param {Object} proto The prototype of the original event.
   * @returns {Function} The defined wrapper class.
   * @private
   */
  function defineWrapper(BaseEvent, proto) {
      const keys = Object.keys(proto);
      if (keys.length === 0) {
          return BaseEvent
      }

      /** CustomEvent */
      function CustomEvent(eventTarget, event) {
          BaseEvent.call(this, eventTarget, event);
      }

      CustomEvent.prototype = Object.create(BaseEvent.prototype, {
          constructor: { value: CustomEvent, configurable: true, writable: true },
      });

      // Define accessors.
      for (let i = 0; i < keys.length; ++i) {
          const key = keys[i];
          if (!(key in BaseEvent.prototype)) {
              const descriptor = Object.getOwnPropertyDescriptor(proto, key);
              const isFunc = typeof descriptor.value === "function";
              Object.defineProperty(
                  CustomEvent.prototype,
                  key,
                  isFunc
                      ? defineCallDescriptor(key)
                      : defineRedirectDescriptor(key)
              );
          }
      }

      return CustomEvent
  }

  /**
   * Get the wrapper class of a given prototype.
   * @param {Object} proto The prototype of the original event to get its wrapper.
   * @returns {Function} The wrapper class.
   * @private
   */
  function getWrapper(proto) {
      if (proto == null || proto === Object.prototype) {
          return Event$1
      }

      let wrapper = wrappers.get(proto);
      if (wrapper == null) {
          wrapper = defineWrapper(getWrapper(Object.getPrototypeOf(proto)), proto);
          wrappers.set(proto, wrapper);
      }
      return wrapper
  }

  /**
   * Wrap a given event to management a dispatching.
   * @param {EventTarget} eventTarget The event target of this dispatching.
   * @param {Object} event The event to wrap.
   * @returns {Event} The wrapper instance.
   * @private
   */
  function wrapEvent(eventTarget, event) {
      const Wrapper = getWrapper(Object.getPrototypeOf(event));
      return new Wrapper(eventTarget, event)
  }

  /**
   * Get the immediateStopped flag of a given event.
   * @param {Event} event The event to get.
   * @returns {boolean} The flag to stop propagation immediately.
   * @private
   */
  function isStopped(event) {
      return pd(event).immediateStopped
  }

  /**
   * Set the current event phase of a given event.
   * @param {Event} event The event to set current target.
   * @param {number} eventPhase New event phase.
   * @returns {void}
   * @private
   */
  function setEventPhase(event, eventPhase) {
      pd(event).eventPhase = eventPhase;
  }

  /**
   * Set the current target of a given event.
   * @param {Event} event The event to set current target.
   * @param {EventTarget|null} currentTarget New current target.
   * @returns {void}
   * @private
   */
  function setCurrentTarget(event, currentTarget) {
      pd(event).currentTarget = currentTarget;
  }

  /**
   * Set a passive listener of a given event.
   * @param {Event} event The event to set current target.
   * @param {Function|null} passiveListener New passive listener.
   * @returns {void}
   * @private
   */
  function setPassiveListener(event, passiveListener) {
      pd(event).passiveListener = passiveListener;
  }

  /**
   * @typedef {object} ListenerNode
   * @property {Function} listener
   * @property {1|2|3} listenerType
   * @property {boolean} passive
   * @property {boolean} once
   * @property {ListenerNode|null} next
   * @private
   */

  /**
   * @type {WeakMap<object, Map<string, ListenerNode>>}
   * @private
   */
  const listenersMap = new WeakMap();

  // Listener types
  const CAPTURE = 1;
  const BUBBLE = 2;
  const ATTRIBUTE = 3;

  /**
   * Check whether a given value is an object or not.
   * @param {any} x The value to check.
   * @returns {boolean} `true` if the value is an object.
   */
  function isObject(x) {
      return x !== null && typeof x === "object" //eslint-disable-line no-restricted-syntax
  }

  /**
   * Get listeners.
   * @param {EventTarget} eventTarget The event target to get.
   * @returns {Map<string, ListenerNode>} The listeners.
   * @private
   */
  function getListeners(eventTarget) {
      const listeners = listenersMap.get(eventTarget);
      if (listeners == null) {
          throw new TypeError(
              "'this' is expected an EventTarget object, but got another value."
          )
      }
      return listeners
  }

  /**
   * Get the property descriptor for the event attribute of a given event.
   * @param {string} eventName The event name to get property descriptor.
   * @returns {PropertyDescriptor} The property descriptor.
   * @private
   */
  function defineEventAttributeDescriptor(eventName) {
      return {
          get() {
              const listeners = getListeners(this);
              let node = listeners.get(eventName);
              while (node != null) {
                  if (node.listenerType === ATTRIBUTE) {
                      return node.listener
                  }
                  node = node.next;
              }
              return null
          },

          set(listener) {
              if (typeof listener !== "function" && !isObject(listener)) {
                  listener = null; // eslint-disable-line no-param-reassign
              }
              const listeners = getListeners(this);

              // Traverse to the tail while removing old value.
              let prev = null;
              let node = listeners.get(eventName);
              while (node != null) {
                  if (node.listenerType === ATTRIBUTE) {
                      // Remove old value.
                      if (prev !== null) {
                          prev.next = node.next;
                      } else if (node.next !== null) {
                          listeners.set(eventName, node.next);
                      } else {
                          listeners.delete(eventName);
                      }
                  } else {
                      prev = node;
                  }

                  node = node.next;
              }

              // Add new value.
              if (listener !== null) {
                  const newNode = {
                      listener,
                      listenerType: ATTRIBUTE,
                      passive: false,
                      once: false,
                      next: null,
                  };
                  if (prev === null) {
                      listeners.set(eventName, newNode);
                  } else {
                      prev.next = newNode;
                  }
              }
          },
          configurable: true,
          enumerable: true,
      }
  }

  /**
   * Define an event attribute (e.g. `eventTarget.onclick`).
   * @param {Object} eventTargetPrototype The event target prototype to define an event attrbite.
   * @param {string} eventName The event name to define.
   * @returns {void}
   */
  function defineEventAttribute(eventTargetPrototype, eventName) {
      Object.defineProperty(
          eventTargetPrototype,
          `on${eventName}`,
          defineEventAttributeDescriptor(eventName)
      );
  }

  /**
   * Define a custom EventTarget with event attributes.
   * @param {string[]} eventNames Event names for event attributes.
   * @returns {EventTarget} The custom EventTarget.
   * @private
   */
  function defineCustomEventTarget(eventNames) {
      /** CustomEventTarget */
      function CustomEventTarget() {
          EventTarget.call(this);
      }

      CustomEventTarget.prototype = Object.create(EventTarget.prototype, {
          constructor: {
              value: CustomEventTarget,
              configurable: true,
              writable: true,
          },
      });

      for (let i = 0; i < eventNames.length; ++i) {
          defineEventAttribute(CustomEventTarget.prototype, eventNames[i]);
      }

      return CustomEventTarget
  }

  /**
   * EventTarget.
   *
   * - This is constructor if no arguments.
   * - This is a function which returns a CustomEventTarget constructor if there are arguments.
   *
   * For example:
   *
   *     class A extends EventTarget {}
   *     class B extends EventTarget("message") {}
   *     class C extends EventTarget("message", "error") {}
   *     class D extends EventTarget(["message", "error"]) {}
   */
  function EventTarget() {
      /*eslint-disable consistent-return */
      if (this instanceof EventTarget) {
          listenersMap.set(this, new Map());
          return
      }
      if (arguments.length === 1 && Array.isArray(arguments[0])) {
          return defineCustomEventTarget(arguments[0])
      }
      if (arguments.length > 0) {
          const types = new Array(arguments.length);
          for (let i = 0; i < arguments.length; ++i) {
              types[i] = arguments[i];
          }
          return defineCustomEventTarget(types)
      }
      throw new TypeError("Cannot call a class as a function")
      /*eslint-enable consistent-return */
  }

  // Should be enumerable, but class methods are not enumerable.
  EventTarget.prototype = {
      /**
       * Add a given listener to this event target.
       * @param {string} eventName The event name to add.
       * @param {Function} listener The listener to add.
       * @param {boolean|{capture?:boolean,passive?:boolean,once?:boolean}} [options] The options for this listener.
       * @returns {void}
       */
      addEventListener(eventName, listener, options) {
          if (listener == null) {
              return
          }
          if (typeof listener !== "function" && !isObject(listener)) {
              throw new TypeError("'listener' should be a function or an object.")
          }

          const listeners = getListeners(this);
          const optionsIsObj = isObject(options);
          const capture = optionsIsObj
              ? Boolean(options.capture)
              : Boolean(options);
          const listenerType = capture ? CAPTURE : BUBBLE;
          const newNode = {
              listener,
              listenerType,
              passive: optionsIsObj && Boolean(options.passive),
              once: optionsIsObj && Boolean(options.once),
              next: null,
          };

          // Set it as the first node if the first node is null.
          let node = listeners.get(eventName);
          if (node === undefined) {
              listeners.set(eventName, newNode);
              return
          }

          // Traverse to the tail while checking duplication..
          let prev = null;
          while (node != null) {
              if (
                  node.listener === listener &&
                  node.listenerType === listenerType
              ) {
                  // Should ignore duplication.
                  return
              }
              prev = node;
              node = node.next;
          }

          // Add it.
          prev.next = newNode;
      },

      /**
       * Remove a given listener from this event target.
       * @param {string} eventName The event name to remove.
       * @param {Function} listener The listener to remove.
       * @param {boolean|{capture?:boolean,passive?:boolean,once?:boolean}} [options] The options for this listener.
       * @returns {void}
       */
      removeEventListener(eventName, listener, options) {
          if (listener == null) {
              return
          }

          const listeners = getListeners(this);
          const capture = isObject(options)
              ? Boolean(options.capture)
              : Boolean(options);
          const listenerType = capture ? CAPTURE : BUBBLE;

          let prev = null;
          let node = listeners.get(eventName);
          while (node != null) {
              if (
                  node.listener === listener &&
                  node.listenerType === listenerType
              ) {
                  if (prev !== null) {
                      prev.next = node.next;
                  } else if (node.next !== null) {
                      listeners.set(eventName, node.next);
                  } else {
                      listeners.delete(eventName);
                  }
                  return
              }

              prev = node;
              node = node.next;
          }
      },

      /**
       * Dispatch a given event.
       * @param {Event|{type:string}} event The event to dispatch.
       * @returns {boolean} `false` if canceled.
       */
      dispatchEvent(event) {
          if (event == null || typeof event.type !== "string") {
              throw new TypeError('"event.type" should be a string.')
          }

          // If listeners aren't registered, terminate.
          const listeners = getListeners(this);
          const eventName = event.type;
          let node = listeners.get(eventName);
          if (node == null) {
              return true
          }

          // Since we cannot rewrite several properties, so wrap object.
          const wrappedEvent = wrapEvent(this, event);

          // This doesn't process capturing phase and bubbling phase.
          // This isn't participating in a tree.
          let prev = null;
          while (node != null) {
              // Remove this listener if it's once
              if (node.once) {
                  if (prev !== null) {
                      prev.next = node.next;
                  } else if (node.next !== null) {
                      listeners.set(eventName, node.next);
                  } else {
                      listeners.delete(eventName);
                  }
              } else {
                  prev = node;
              }

              // Call this listener
              setPassiveListener(
                  wrappedEvent,
                  node.passive ? node.listener : null
              );
              if (typeof node.listener === "function") {
                  try {
                      node.listener.call(this, wrappedEvent);
                  } catch (err) {
                      if (
                          typeof console !== "undefined" &&
                          typeof console.error === "function"
                      ) {
                          console.error(err);
                      }
                  }
              } else if (
                  node.listenerType !== ATTRIBUTE &&
                  typeof node.listener.handleEvent === "function"
              ) {
                  node.listener.handleEvent(wrappedEvent);
              }

              // Break if `event.stopImmediatePropagation` was called.
              if (isStopped(wrappedEvent)) {
                  break
              }

              node = node.next;
          }
          setPassiveListener(wrappedEvent, null);
          setEventPhase(wrappedEvent, 0);
          setCurrentTarget(wrappedEvent, null);

          return !wrappedEvent.defaultPrevented
      },
  };

  // `constructor` is not enumerable.
  Object.defineProperty(EventTarget.prototype, "constructor", {
      value: EventTarget,
      configurable: true,
      writable: true,
  });

  // Ensure `eventTarget instanceof window.EventTarget` is `true`.
  if (
      typeof window !== "undefined" &&
      typeof window.EventTarget !== "undefined"
  ) {
      Object.setPrototypeOf(EventTarget.prototype, window.EventTarget.prototype);
  }

  var ClassicEditor =
  /*#__PURE__*/
  function (_EventTarget) {
    _inherits(ClassicEditor, _EventTarget);

    function ClassicEditor() {
      var _this;

      _classCallCheck(this, ClassicEditor);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(ClassicEditor).call(this));

      _this.init();

      return _this;
    }

    _createClass(ClassicEditor, [{
      key: "init",
      value: function init() {
        var _this2 = this;

        $(document).on('input', 'input#title,textarea#content,textarea#excerpt', this.get_debounced_change_callback()).on('after-autosave.smartcrawl', function () {
          return _this2.dispatch_autosave_event();
        });
        $(window).on('load', function () {
          return _this2.hook_tinymce_change_listener();
        });
      }
      /**
       * @returns {Post}
       */

    }, {
      key: "get_data",
      value: function get_data() {
        var data = wp.autosave.getPostData(),
            post = new Post(),
            tags = $('#tax-input-post_tag').val();
        return post.set_id(data.post_id).set_type(data.post_type).set_author_id(data.post_author).set_title(data.post_title).set_content(data.content).set_excerpt(data.excerpt).set_category_ids(data.catslist.split(',')).set_tag_ids(tags ? tags.split(',') : []).set_slug(data.post_name).set_date(new Date()).set_modified(new Date()).set_permalink(Config_Values.get('post_url', 'metabox'));
      }
    }, {
      key: "dispatch_content_change_event",
      value: function dispatch_content_change_event() {
        this.dispatchEvent(new Event('content-change'));
      }
    }, {
      key: "hook_tinymce_change_listener",
      value: function hook_tinymce_change_listener() {
        var editor = typeof tinymce !== 'undefined' && tinymce.get('content');

        if (editor) {
          editor.on('change', this.get_debounced_change_callback());
        }
      }
    }, {
      key: "get_debounced_change_callback",
      value: function get_debounced_change_callback() {
        var _this3 = this;

        return _$1.debounce(function () {
          return _this3.dispatch_content_change_event();
        }, 2000);
      }
    }, {
      key: "dispatch_autosave_event",
      value: function dispatch_autosave_event() {
        this.dispatchEvent(new Event('autosave'));
      }
      /**
       * When the classic editor is active and we trigger an autosave programmatically,
       * the heartbeat API is used for the autosave.
       *
       * To provide a seamless experience, this method temporarily removes our usual handler
       * and hooks a handler to the heartbeat event.
       */

    }, {
      key: "autosave",
      value: function autosave() {
        var _this4 = this;

        var handle_heartbeat = function handle_heartbeat() {
          _this4.dispatch_autosave_event(); // Re-hook our regular autosave handler


          $(document).on('after-autosave.smartcrawl', function () {
            return _this4.dispatch_autosave_event();
          });
        }; // We are already hooked to autosave so let's disable our regular autosave handler momentarily to avoid multiple calls ...


        $(document).off('after-autosave.smartcrawl'); // hook a new handler to heartbeat-tick.autosave

        $(document).one('heartbeat-tick.autosave', handle_heartbeat); // Save any changes pending in the editor to the textarea

        this.trigger_tinymce_save(); // Actually trigger the autosave

        wp.autosave.server.triggerSave();
      }
    }, {
      key: "trigger_tinymce_save",
      value: function trigger_tinymce_save() {
        var editorSync = (tinyMCE || {}).triggerSave;

        if (editorSync) {
          editorSync();
        }
      }
    }, {
      key: "is_post_dirty",
      value: function is_post_dirty() {
        return wp.autosave.server.postChanged();
      }
    }]);

    return ClassicEditor;
  }(EventTarget);

  var GutenbergEditor =
  /*#__PURE__*/
  function (_EventTarget) {
    _inherits(GutenbergEditor, _EventTarget);

    function GutenbergEditor() {
      var _this;

      _classCallCheck(this, GutenbergEditor);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(GutenbergEditor).call(this));

      _this.init();

      return _this;
    }

    _createClass(GutenbergEditor, [{
      key: "init",
      value: function init() {
        this.hook_change_listener();
        this.register_api_fetch_middleware();
      }
      /**
       * @returns {Post}
       */

    }, {
      key: "get_data",
      value: function get_data() {
        var post = new Post(),
            editor = this.get_editor();
        var postId = editor.getEditedPostAttribute('id');

        if (!postId) {
          postId = $('#post_ID').val() || 0;
        }

        post = post.set_id(postId).set_type(editor.getEditedPostAttribute('type')).set_author_id(editor.getEditedPostAttribute('author')).set_title(editor.getEditedPostAttribute('title')).set_content(editor.getEditedPostAttribute('content')).set_excerpt(editor.getEditedPostAttribute('excerpt')).set_slug(editor.getEditedPostAttribute('slug')).set_date(new Date(editor.getEditedPostAttribute('date'))).set_modified(new Date(editor.getEditedPostAttribute('modified'))).set_permalink(editor.getPermalink());

        if (this.get_post_type() === 'post') {
          post.set_category_ids(editor.getEditedPostAttribute('categories')).set_tag_ids(editor.getEditedPostAttribute('tags'));
        } else {
          var taxonomies = this.get_taxonomies();
          taxonomies.forEach(function (taxonomy) {
            var taxonomy_terms = editor.getEditedPostAttribute(taxonomy);

            if (taxonomy_terms) {
              post.set_taxonomy_terms(taxonomy, taxonomy_terms);
            }
          });
        }

        return post;
      }
    }, {
      key: "get_post_type",
      value: function get_post_type() {
        return Config_Values.get('post_type', 'metabox');
      }
    }, {
      key: "get_taxonomies",
      value: function get_taxonomies() {
        return Config_Values.get('taxonomies', 'metabox');
      }
    }, {
      key: "get_editor",
      value: function get_editor() {
        return wp.data.select("core/editor");
      }
    }, {
      key: "dispatch_content_change_event",
      value: function dispatch_content_change_event() {
        this.dispatchEvent(new Event('content-change'));
      }
    }, {
      key: "dispatch_editor",
      value: function dispatch_editor() {
        return wp.data.dispatch("core/editor");
      }
    }, {
      key: "hook_change_listener",
      value: function hook_change_listener() {
        var _this2 = this;

        var debounced = _$1.debounce(function () {
          return _this2.dispatch_content_change_event();
        }, 2000);

        wp.data.subscribe(function () {
          if (_this2.is_post_loaded() && _this2.get_editor().isEditedPostDirty() && !_this2.get_editor().isAutosavingPost() && !_this2.get_editor().isSavingPost()) {
            debounced();
          }
        });
      }
    }, {
      key: "register_api_fetch_middleware",
      value: function register_api_fetch_middleware() {
        var _this3 = this;

        wp.apiFetch.use(function (options, next) {
          var result = next(options);
          result.then(function () {
            if (_this3.is_autosave_request(options) || _this3.is_post_save_request(options)) {
              _this3.dispatch_autosave_event();
            }
          })["catch"](function () {
            _this3.dispatch_autosave_event();
          });
          return result;
        });
      }
    }, {
      key: "dispatch_autosave_event",
      value: function dispatch_autosave_event() {
        this.dispatchEvent(new Event('autosave'));
      }
    }, {
      key: "is_autosave_request",
      value: function is_autosave_request(request) {
        return request && request.path && request.path.includes('/autosaves');
      }
    }, {
      key: "is_post_save_request",
      value: function is_post_save_request(request) {
        var post = this.get_data(),
            post_id = post.get_id(),
            post_type = post.get_type();
        return request && request.path && request.method === 'PUT' && request.path.includes('/' + post_id) && request.path.includes('/' + post_type);
      }
    }, {
      key: "autosave",
      value: function autosave() {
        // TODO: Keep track of this error: https://github.com/WordPress/gutenberg/issues/7416
        if (this.get_editor().isEditedPostAutosaveable()) {
          this.dispatch_editor().autosave();
        } else {
          this.dispatch_autosave_event();
        }
      }
    }, {
      key: "is_post_loaded",
      value: function is_post_loaded() {
        return this.get_editor().getCurrentPostId && this.get_editor().getCurrentPostId();
      }
    }, {
      key: "is_post_dirty",
      value: function is_post_dirty() {
        return this.is_post_loaded() && this.get_editor().isEditedPostDirty();
      }
    }]);

    return GutenbergEditor;
  }(EventTarget);

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

        terms = _$1.sortBy(terms, function (term) {
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

  var MetaboxOnpageHelper =
  /*#__PURE__*/
  function () {
    function MetaboxOnpageHelper() {
      _classCallCheck(this, MetaboxOnpageHelper);
    }

    _createClass(MetaboxOnpageHelper, null, [{
      key: "get_title",
      value: function get_title() {
        return $('#wds_title').val();
      }
    }, {
      key: "get_description",
      value: function get_description() {
        return $('#wds_metadesc').val();
      }
    }, {
      key: "preview_loading",
      value: function preview_loading(loading) {
        var $preview = this.get_preview_el().find('.wds-preview-container'),
            loading_class = 'wds-preview-loading';

        if (loading) {
          $preview.addClass(loading_class);
        } else {
          $preview.removeClass(loading_class);
        }
      }
    }, {
      key: "get_preview_el",
      value: function get_preview_el() {
        return $('.wds-metabox-preview');
      }
    }, {
      key: "replace_preview_markup",
      value: function replace_preview_markup(new_markup) {
        this.get_preview_el().replaceWith(new_markup);
      }
    }, {
      key: "set_title_placeholder",
      value: function set_title_placeholder(placeholder) {
        $('#wds_title').prop('placeholder', placeholder);
      }
    }, {
      key: "set_desc_placeholder",
      value: function set_desc_placeholder(placeholder) {
        $('#wds_metadesc').prop('placeholder', placeholder);
      }
    }]);

    return MetaboxOnpageHelper;
  }();

  var MetaboxOnpage =
  /*#__PURE__*/
  function (_EventTarget) {
    _inherits(MetaboxOnpage, _EventTarget);

    /**
     * @param postEditor {ClassicEditor|GutenbergEditor}
     * @param macroReplacement {MacroReplacement}
     */
    function MetaboxOnpage(postEditor, macroReplacement) {
      var _this;

      _classCallCheck(this, MetaboxOnpage);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(MetaboxOnpage).call(this));
      _this.editor = postEditor;
      _this.macroReplacement = macroReplacement;

      _this.init();

      return _this;
    }

    _createClass(MetaboxOnpage, [{
      key: "init",
      value: function init() {
        var _this2 = this;

        this.editor.addEventListener('autosave', function (e) {
          return _this2.handle_autosave_event(e);
        });
        this.editor.addEventListener('content-change', function (e) {
          return _this2.handle_content_change_event(e);
        });
        $(document).on('input propertychange', '.wds-meta-field', _$1.debounce(function (e) {
          return _this2.handle_meta_change(e);
        }, 200)).on('input propertychange', '.wds-meta-field', _$1.debounce(function (e) {
          return _this2.dispatch_meta_change_deferred_event(e);
        }, 2000));
        $(window).on('load', function () {
          return _this2.handle_page_load();
        });
      }
    }, {
      key: "handle_autosave_event",
      value: function handle_autosave_event() {
        this.refresh_preview();
        this.refresh_placeholders();
      }
    }, {
      key: "handle_content_change_event",
      value: function handle_content_change_event() {
        this.refresh_preview();
        this.refresh_placeholders();
      }
    }, {
      key: "handle_meta_change",
      value: function handle_meta_change() {
        this.dispatch_meta_change_event();
        this.refresh_preview();
      }
    }, {
      key: "handle_page_load",
      value: function handle_page_load() {
        this.refresh_preview();
        this.refresh_placeholders();
      }
    }, {
      key: "refresh_preview",
      value: function refresh_preview() {
        MetaboxOnpageHelper.preview_loading(true);
        var title = MetaboxOnpageHelper.get_title() || Config_Values.get('meta_title', 'metabox'),
            description = MetaboxOnpageHelper.get_description() || Config_Values.get('meta_desc', 'metabox'),
            post = this.editor.get_data(),
            promises = [];
        promises.push(this.macroReplacement.replace(title, post));
        promises.push(this.macroReplacement.replace(description, post));
        Promise.all(promises).then(function (values) {
          MetaboxOnpageHelper.preview_loading(false);
          var template = Wds.tpl_compile(Wds.template('metabox', 'preview')),
              title_max_length = Config_Values.get('title_max_length', 'metabox'),
              metadesc_max_length = Config_Values.get('metadesc_max_length', 'metabox'),
              markup = template({
            link: post.get_permalink(),
            title: MetaboxOnpage.prepare_string(values[0], title_max_length),
            description: MetaboxOnpage.prepare_string(values[1], metadesc_max_length)
          });
          MetaboxOnpageHelper.replace_preview_markup(markup);
        })["catch"](function (error) {
          console.log(error);
        });
      }
    }, {
      key: "refresh_placeholders",
      value: function refresh_placeholders() {
        var post = this.editor.get_data();
        Promise.all([this.macroReplacement.replace(Config_Values.get('meta_title', 'metabox'), post), this.macroReplacement.replace(Config_Values.get('meta_desc', 'metabox'), post)]).then(function (values) {
          MetaboxOnpageHelper.set_title_placeholder(MetaboxOnpage.prepare_string(values[0]));
          MetaboxOnpageHelper.set_desc_placeholder(MetaboxOnpage.prepare_string(values[1]));
        })["catch"](function (error) {
          console.log(error);
        });
      }
    }, {
      key: "dispatch_meta_change_event",
      value: function dispatch_meta_change_event() {
        this.dispatchEvent(new Event('meta-change'));
      }
    }, {
      key: "dispatch_meta_change_deferred_event",
      value: function dispatch_meta_change_deferred_event() {
        this.dispatchEvent(new Event('meta-change-deferred'));
      }
    }, {
      key: "post",
      value: function post(action, data) {
        data = $.extend({
          action: action,
          _wds_nonce: Config_Values.get('nonce', 'metabox')
        }, data);
        return $.post(ajaxurl, data);
      }
    }], [{
      key: "prepare_string",
      value: function prepare_string(string) {
        var limit = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
        return String_Utils.process_string(string, limit);
      }
    }]);

    return MetaboxOnpage;
  }(EventTarget);

  var MetaboxAnalysisHelper =
  /*#__PURE__*/
  function () {
    function MetaboxAnalysisHelper() {
      _classCallCheck(this, MetaboxAnalysisHelper);
    }

    _createClass(MetaboxAnalysisHelper, null, [{
      key: "get_focus_keyword_el",
      value: function get_focus_keyword_el() {
        return $('#wds_focus');
      }
    }, {
      key: "get_focus_keyword",
      value: function get_focus_keyword() {
        return this.get_focus_keyword_el().val();
      }
    }, {
      key: "get_title",
      value: function get_title() {
        return $('#wds_title').val();
      }
    }, {
      key: "get_description",
      value: function get_description() {
        return $('#wds_metadesc').val();
      }
    }, {
      key: "get_metabox_el",
      value: function get_metabox_el() {
        return $("#wds-wds-meta-box");
      }
    }, {
      key: "get_seo_report_el",
      value: function get_seo_report_el() {
        return $('.wds-seo-analysis', this.get_seo_analysis_el());
      }
    }, {
      key: "get_readability_report_el",
      value: function get_readability_report_el() {
        return $(".wds-readability-report", this.get_readability_analysis_el());
      }
    }, {
      key: "get_postbox_fields_el",
      value: function get_postbox_fields_el() {
        return $('.wds-post-box-fields');
      }
    }, {
      key: "replace_seo_report",
      value: function replace_seo_report(new_report) {
        this.get_seo_report_el().replaceWith(new_report);
      }
    }, {
      key: "replace_readability_report",
      value: function replace_readability_report(new_report) {
        this.get_readability_report_el().replaceWith(new_report);
      }
    }, {
      key: "replace_post_fields",
      value: function replace_post_fields(new_fields) {
        this.get_postbox_fields_el().replaceWith(new_fields);
      }
    }, {
      key: "get_refresh_button_el",
      value: function get_refresh_button_el() {
        return $(".wds-refresh-analysis", this.get_metabox_el());
      }
    }, {
      key: "update_refresh_button",
      value: function update_refresh_button(enable) {
        this.get_refresh_button_el().prop('disabled', !enable);
      }
    }, {
      key: "get_seo_error_count",
      value: function get_seo_error_count() {
        return this.get_seo_report_el().data('errors');
      }
    }, {
      key: "get_readability_state",
      value: function get_readability_state() {
        return this.get_readability_report_el().data('readabilityState');
      }
    }, {
      key: "get_seo_analysis_el",
      value: function get_seo_analysis_el() {
        return $('.wds-seo-analysis-container', this.get_metabox_el());
      }
    }, {
      key: "get_readability_analysis_el",
      value: function get_readability_analysis_el() {
        return $('.wds-readability-analysis-container', this.get_metabox_el());
      }
    }, {
      key: "block_ui",
      value: function block_ui() {
        var $el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
        var $container = this.get_analysis_containers();

        if ($el) {
          $el.addClass($el.is('button') ? 'sui-button-onload' : 'wds-item-loading');
        } else {
          $('.wds-report-inner', $container).hide();
          $('.wds-analysis-working', $container).show();
        }

        $('.wds-disabled-during-request', $container).prop('disabled', true);
      }
    }, {
      key: "unblock_ui",
      value: function unblock_ui() {
        var $container = this.get_analysis_containers();
        $('.wds-item-loading', $container).removeClass('wds-item-loading');
        $('.sui-button-onload', $container).removeClass('sui-button-onload');
        $('.wds-report-inner', $container).show();
        $('.wds-analysis-working', $container).hide();
        $('.wds-disabled-during-request', $container).prop('disabled', false);
      }
    }, {
      key: "get_analysis_containers",
      value: function get_analysis_containers() {
        return $('.wds-seo-analysis-container, .wds-readability-analysis-container', this.get_metabox_el());
      }
    }, {
      key: "update_focus_field_state",
      value: function update_focus_field_state(focusValid) {
        this.get_focus_container_el().removeClass('wds-focus-keyword-loaded wds-focus-keyword-invalid').addClass(focusValid ? 'wds-focus-keyword-loaded' : 'wds-focus-keyword-invalid');
      }
    }, {
      key: "get_focus_container_el",
      value: function get_focus_container_el() {
        return $('.wds-focus-keyword');
      }
    }]);

    return MetaboxAnalysisHelper;
  }();

  var MetaboxAnalysis =
  /*#__PURE__*/
  function (_EventTarget) {
    _inherits(MetaboxAnalysis, _EventTarget);

    /**
     * @param postEditor {ClassicEditor|GutenbergEditor}
     * @param metaboxOnpage {MetaboxOnpage|false}
     */
    function MetaboxAnalysis(postEditor, metaboxOnpage) {
      var _this;

      _classCallCheck(this, MetaboxAnalysis);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(MetaboxAnalysis).call(this));
      _this.editor = postEditor;
      _this.metaboxOnpage = metaboxOnpage;

      _this.init();

      return _this;
    }

    _createClass(MetaboxAnalysis, [{
      key: "init",
      value: function init() {
        var _this2 = this;

        this.editor.addEventListener('autosave', function () {
          return _this2.refresh_analysis();
        });
        $(document).on('click', '.wds-refresh-analysis', function (e) {
          return _this2.handle_refresh_click(e);
        }).on('click', '.wds-seo-analysis-container .wds-ignore', function (e) {
          return _this2.handle_ignore_click(e);
        }).on('click', '.wds-seo-analysis-container .wds-unignore', function (e) {
          return _this2.handle_unignore_click(e);
        }).on('click', '.wds-readability-analysis-container .wds-ignore', function (e) {
          return _this2.handle_ignore_click(e);
        }).on('click', '.wds-readability-analysis-container .wds-unignore', function (e) {
          return _this2.handle_unignore_click(e);
        }).on('input propertychange', '.wds-focus-keyword input', _$1.debounce(function (e) {
          return _this2.handle_focus_keywords_change(e);
        }, 2000));
        $(window).on('load', function () {
          return _this2.hook_meta_change_listener();
        }) // Hook meta change listener as late as possible
        .on('load', function () {
          return _this2.handle_page_load();
        });
      }
    }, {
      key: "refresh_analysis",
      value: function refresh_analysis() {
        var _this3 = this;

        var focusKeyword = MetaboxAnalysisHelper.get_focus_keyword();
        return this.post('wds-analysis-get-editor-analysis', {
          post_id: this.editor.get_data().get_id(),
          is_dirty: this.editor.is_post_dirty() ? 1 : 0,
          wds_title: MetaboxAnalysisHelper.get_title(),
          wds_description: MetaboxAnalysisHelper.get_description(),
          wds_focus_keywords: focusKeyword
        }).done(function (response) {
          if (!(response || {}).success) {
            return false;
          }

          var data = (response || {}).data,
              seo_report = (data || {}).seo || '',
              readability_report = (data || {}).readability || '',
              post_fields = (data || {}).postbox_fields || '';
          MetaboxAnalysisHelper.replace_seo_report(seo_report);
          MetaboxAnalysisHelper.replace_readability_report(readability_report);
          MetaboxAnalysisHelper.replace_post_fields(post_fields);
          var seo_errors = MetaboxAnalysisHelper.get_seo_error_count(),
              readability_state = MetaboxAnalysisHelper.get_readability_state();

          _this3.dispatch_seo_update_event(seo_errors);

          _this3.dispatch_readability_update_event(readability_state);
        }).always(function () {
          MetaboxAnalysisHelper.unblock_ui();
          var focusValid = !!(focusKeyword && focusKeyword.length);
          MetaboxAnalysisHelper.update_focus_field_state(focusValid);
          MetaboxAnalysisHelper.update_refresh_button(true);
        });
      }
    }, {
      key: "handle_refresh_click",
      value: function handle_refresh_click(e) {
        this.prevent_default(e);
        this.dispatch_event('before-analysis-refresh');
        MetaboxAnalysisHelper.block_ui();
        this.editor.autosave();
      }
    }, {
      key: "handle_ignore_click",
      value: function handle_ignore_click(e) {
        var _this4 = this;

        this.prevent_default(e);
        var $button = $(e.target).closest('button'),
            check_id = $button.attr('data-check_id');
        MetaboxAnalysisHelper.block_ui($button);
        return this.change_ignore_status(check_id, true).done(function () {
          return _this4.refresh_analysis();
        });
      }
    }, {
      key: "handle_unignore_click",
      value: function handle_unignore_click(e) {
        var _this5 = this;

        this.prevent_default(e);
        var $button = $(e.target).closest('button'),
            check_id = $button.attr('data-check_id');
        MetaboxAnalysisHelper.block_ui($button);
        return this.change_ignore_status(check_id, false).done(function () {
          return _this5.refresh_analysis();
        });
      }
    }, {
      key: "handle_focus_keywords_change",
      value: function handle_focus_keywords_change() {
        this.dispatch_event('before-focus-keyword-update');
        MetaboxAnalysisHelper.block_ui(MetaboxAnalysisHelper.get_focus_container_el());
        this.refresh_analysis();
      }
    }, {
      key: "hook_meta_change_listener",
      value: function hook_meta_change_listener() {
        var _this6 = this;

        var metaboxOnpage = this.metaboxOnpage;

        if (metaboxOnpage) {
          metaboxOnpage.addEventListener('meta-change-deferred', function () {
            return _this6.refresh_analysis();
          });
        }
      }
    }, {
      key: "handle_page_load",
      value: function handle_page_load() {
        this.dispatch_event('before-analysis-refresh');
        MetaboxAnalysisHelper.block_ui();
        this.refresh_analysis();
      }
    }, {
      key: "post",
      value: function post(action, data) {
        data = $.extend({
          action: action,
          _wds_nonce: Config_Values.get('nonce', 'metabox')
        }, data);
        return $.post(ajaxurl, data);
      }
    }, {
      key: "change_ignore_status",
      value: function change_ignore_status(check_id, ignore) {
        this.dispatch_event('before-ignore-status-change');
        var action = !!ignore ? 'wds-analysis-ignore-check' : 'wds-analysis-unignore-check';
        return this.post(action, {
          post_id: this.editor.get_data().get_id(),
          check_id: check_id
        });
      }
    }, {
      key: "prevent_default",
      value: function prevent_default(event) {
        if (event && event.preventDefault && event.stopPropagation) {
          event.preventDefault();
          event.stopPropagation();
        }
      }
    }, {
      key: "dispatch_event",
      value: function dispatch_event(event) {
        this.dispatchEvent(new Event(event));
      }
    }, {
      key: "dispatch_seo_update_event",
      value: function dispatch_seo_update_event(error_count) {
        var event = new CustomEvent('after-seo-analysis-update', {
          detail: {
            errors: error_count
          }
        });
        this.dispatchEvent(event);
      }
    }, {
      key: "dispatch_readability_update_event",
      value: function dispatch_readability_update_event(state) {
        var event = new CustomEvent('after-readability-analysis-update', {
          detail: {
            state: state
          }
        });
        this.dispatchEvent(event);
      }
    }]);

    return MetaboxAnalysis;
  }(EventTarget);

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

  (function () {
    var editor;

    if (Config_Values.get_bool('gutenberg_active', 'metabox')) {
      editor = new GutenbergEditor();
    } else {
      editor = new ClassicEditor();
    }

    var postObjectsCache = new PostObjectsCache();
    var postObjectFetcher = new PostObjectFetcher(postObjectsCache);
    var macroReplacement = new MacroReplacement(postObjectFetcher);
    var metaboxOnpage = false;

    if (Config_Values.get_bool('onpage_active', 'metabox')) {
      metaboxOnpage = new MetaboxOnpage(editor, macroReplacement);
    }

    var metaboxAnalysis = false;

    if (Config_Values.get_bool('analysis_active', 'metabox')) {
      metaboxAnalysis = new MetaboxAnalysis(editor, metaboxOnpage);
    }

    window.Wds = window.Wds || {};
    window.Wds.postEditor = editor;
    window.Wds.metaboxAnalysis = metaboxAnalysis;
    window.Wds.metaboxOnpage = metaboxOnpage;
    window.Wds.stringUtils = String_Utils;
    window.Wds.OptimumLengthIndicator = OptimumLengthIndicator;
  })(jQuery);

}(wp, _, jQuery, Wds));

//# sourceMappingURL=wds-metabox-components.js.map