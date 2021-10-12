(function webpackUniversalModuleDefinition(root, factory) {
  if (typeof exports === 'object' && typeof module === 'object')
    module.exports = factory();
  else if (typeof define === 'function' && define.amd)
    define([], factory);
  else if (typeof exports === 'object')
    exports["SwupFormPlugin"] = factory();
  else
    root["SwupFormPlugin"] = factory();
})(window, function() {
  return /******/ (function(modules) { // webpackBootstrap
    /******/ // The module cache
    /******/
    var installedModules = {};
    /******/
    /******/ // The require function
    /******/
    function __webpack_require__(moduleId) {
      /******/
      /******/ // Check if module is in cache
      /******/
      if (installedModules[moduleId]) {
        /******/
        return installedModules[moduleId].exports;
        /******/
      }
      /******/ // Create a new module (and put it into the cache)
      /******/
      var module = installedModules[moduleId] = {
        /******/
        i: moduleId,
        /******/
        l: false,
        /******/
        exports: {}
        /******/
      };
      /******/
      /******/ // Execute the module function
      /******/
      modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
      /******/
      /******/ // Flag the module as loaded
      /******/
      module.l = true;
      /******/
      /******/ // Return the exports of the module
      /******/
      return module.exports;
      /******/
    }
    /******/
    /******/
    /******/ // expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/ // expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/ // define getter function for harmony exports
    /******/
    __webpack_require__.d = function(exports, name, getter) {
      /******/
      if (!__webpack_require__.o(exports, name)) {
        /******/
        Object.defineProperty(exports, name, {
          /******/
          configurable: false,
          /******/
          enumerable: true,
          /******/
          get: getter
          /******/
        });
        /******/
      }
      /******/
    };
    /******/
    /******/ // define __esModule on exports
    /******/
    __webpack_require__.r = function(exports) {
      /******/
      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      /******/
    };
    /******/
    /******/ // getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function(module) {
      /******/
      var getter = module && module.__esModule ?
        /******/
        function getDefault() {
          return module['default'];
        } :
        /******/
        function getModuleExports() {
          return module;
        };
      /******/
      __webpack_require__.d(getter, 'a', getter);
      /******/
      return getter;
      /******/
    };
    /******/
    /******/ // Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function(object, property) {
      return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ // __webpack_public_path__
    /******/
    __webpack_require__.p = "";
    /******/
    /******/
    /******/ // Load entry module and return exports
    /******/
    return __webpack_require__(__webpack_require__.s = 14);
    /******/
  })
  /************************************************************************/
  /******/
  ([
    /* 0 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      var query = exports.query = function query(selector) {
        var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

        if (typeof selector !== 'string') {
          return selector;
        }

        return context.querySelector(selector);
      };

      var queryAll = exports.queryAll = function queryAll(selector) {
        var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

        if (typeof selector !== 'string') {
          return selector;
        }

        return Array.prototype.slice.call(context.querySelectorAll(selector));
      };

      /***/
    }),
    /* 1 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });

      var _createClass = function() {
        function defineProperties(target, props) {
          for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ('value' in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor);
          }
        }
        return function(Constructor, protoProps, staticProps) {
          if (protoProps) defineProperties(Constructor.prototype, protoProps);
          if (staticProps) defineProperties(Constructor, staticProps);
          return Constructor;
        };
      }();

      function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
          throw new TypeError('Cannot call a class as a function');
        }
      }

      var Link = function() {
        function Link(elementOrUrl) {
          _classCallCheck(this, Link);

          if (elementOrUrl instanceof Element || elementOrUrl instanceof SVGElement) {
            this.link = elementOrUrl;
          } else {
            this.link = document.createElement('a');
            this.link.href = elementOrUrl;
          }
        }

        _createClass(Link, [{
          key: 'getPath',
          value: function getPath() {
            var path = this.link.pathname;
            if (path[0] !== '/') {
              path = '/' + path;
            }
            return path;
          }
        }, {
          key: 'getAddress',
          value: function getAddress() {
            var path = this.link.pathname + this.link.search;

            if (this.link.getAttribute('xlink:href')) {
              path = this.link.getAttribute('xlink:href');
            }

            if (path[0] !== '/') {
              path = '/' + path;
            }
            return path;
          }
        }, {
          key: 'getHash',
          value: function getHash() {
            return this.link.hash;
          }
        }]);

        return Link;
      }();

      exports.default = Link;

      /***/
    }),
    /* 2 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });

      var _utils = __webpack_require__(0);

      var markSwupElements = function markSwupElements(element, containers) {
        var blocks = 0;

        var _loop = function _loop(i) {
          if (element.querySelector(containers[i]) == null) {
            console.warn('Element ' + containers[i] + ' is not in current page.');
          } else {
            (0, _utils.queryAll)(containers[i]).forEach(function(item, index) {
              (0, _utils.queryAll)(containers[i], element)[index].dataset.swup = blocks;
              blocks++;
            });
          }
        };

        for (var i = 0; i < containers.length; i++) {
          _loop(i);
        }
      };

      exports.default = markSwupElements;

      /***/
    }),
    /* 3 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      var getCurrentUrl = function getCurrentUrl() {
        return window.location.pathname + window.location.search;
      };

      exports.default = getCurrentUrl;

      /***/
    }),
    /* 4 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      var transitionEnd = function transitionEnd() {
        var el = document.createElement('div');

        var transEndEventNames = {
          WebkitTransition: 'webkitTransitionEnd',
          MozTransition: 'transitionend',
          OTransition: 'oTransitionEnd otransitionend',
          transition: 'transitionend'
        };

        for (var name in transEndEventNames) {
          if (el.style[name] !== undefined) {
            return transEndEventNames[name];
          }
        }

        return false;
      };

      exports.default = transitionEnd;

      /***/
    }),
    /* 5 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });

      var _extends = Object.assign || function(target) {
        for (var i = 1; i < arguments.length; i++) {
          var source = arguments[i];
          for (var key in source) {
            if (Object.prototype.hasOwnProperty.call(source, key)) {
              target[key] = source[key];
            }
          }
        }
        return target;
      };

      var fetch = function fetch(options) {
        var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

        var defaults = {
          url: window.location.pathname + window.location.search,
          method: 'GET',
          data: null
        };

        var data = _extends({}, defaults, options);

        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
          if (request.readyState === 4) {
            if (request.status !== 500) {
              callback(request.responseText, request);
            } else {
              callback(null, request);
            }
          }
        };

        request.open(data.method, data.url, true);
        request.setRequestHeader('X-Requested-With', 'swup');
        request.send(data.data);
        return request;
      };

      exports.default = fetch;

      /***/
    }),
    /* 6 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      var _typeof2 = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function(obj) {
        return typeof obj;
      } : function(obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
      };

      Object.defineProperty(exports, '__esModule', {
        value: true
      });

      var _typeof = typeof Symbol === 'function' && _typeof2(Symbol.iterator) === 'symbol' ? function(obj) {
        return typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
      } : function(obj) {
        return obj && typeof Symbol === 'function' && obj.constructor === Symbol && obj !== Symbol.prototype ? 'symbol' : typeof obj === 'undefined' ? 'undefined' : _typeof2(obj);
      };

      var _utils = __webpack_require__(0);

      var getDataFromHTML = function getDataFromHTML(html, request, containers) {
        var content = html.replace('<body', '<div id="swupBody"').replace('</body>', '</div>');
        var fakeDom = document.createElement('div');
        fakeDom.innerHTML = content;
        var blocks = [];

        var _loop = function _loop(i) {
          if (fakeDom.querySelector(containers[i]) == null) {
            console.warn('Element ' + containers[i] + ' is not found in cached page.');
            return {
              v: null
            };
          } else {
            (0, _utils.queryAll)(containers[i]).forEach(function(item, index) {
              (0, _utils.queryAll)(containers[i], fakeDom)[index].dataset.swup = blocks.length;
              blocks.push((0, _utils.queryAll)(containers[i], fakeDom)[index].outerHTML);
            });
          }
        };

        for (var i = 0; i < containers.length; i++) {
          var _ret = _loop(i);

          if ((typeof _ret === 'undefined' ? 'undefined' : _typeof(_ret)) === 'object') return _ret.v;
        }

        var json = {
          title: fakeDom.querySelector('title').innerText,
          pageClass: fakeDom.querySelector('#swupBody').className,
          originalContent: html,
          blocks: blocks,
          responseURL: request != null ? request.responseURL : window.location.href
        };
        return json;
      };

      exports.default = getDataFromHTML;

      /***/
    }),
    /* 7 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      var createHistoryRecord = function createHistoryRecord(url) {
        window.history.pushState({
          url: url || window.location.href.split(window.location.hostname)[1],
          random: Math.random(),
          source: 'swup'
        }, document.getElementsByTagName('title')[0].innerText, url || window.location.href.split(window.location.hostname)[1]);
      };

      exports.default = createHistoryRecord;

      /***/
    }),
    /* 8 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      var classify = function classify(text) {
        var output = text.toString().toLowerCase().replace(/\s+/g, '-') // Replace spaces with -
          .replace(/\//g, '-') // Replace / with -
          .replace(/[^\w\-]+/g, '') // Remove all non-word chars
          .replace(/\-\-+/g, '-') // Replace multiple - with single -
          .replace(/^-+/, '') // Trim - from start of text
          .replace(/-+$/, ''); // Trim - from end of text
        if (output[0] === '/') output = output.splice(1);
        if (output === '') output = 'homepage';
        return output;
      };

      exports.default = classify;

      /***/
    }),
    /* 9 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, '__esModule', {
        value: true
      });
      exports.Link = exports.markSwupElements = exports.getCurrentUrl = exports.transitionEnd = exports.fetch = exports.getDataFromHTML = exports.createHistoryRecord = exports.classify = undefined;

      var _classify = __webpack_require__(8);

      var _classify2 = _interopRequireDefault(_classify);

      var _createHistoryRecord = __webpack_require__(7);

      var _createHistoryRecord2 = _interopRequireDefault(_createHistoryRecord);

      var _getDataFromHTML = __webpack_require__(6);

      var _getDataFromHTML2 = _interopRequireDefault(_getDataFromHTML);

      var _fetch = __webpack_require__(5);

      var _fetch2 = _interopRequireDefault(_fetch);

      var _transitionEnd = __webpack_require__(4);

      var _transitionEnd2 = _interopRequireDefault(_transitionEnd);

      var _getCurrentUrl = __webpack_require__(3);

      var _getCurrentUrl2 = _interopRequireDefault(_getCurrentUrl);

      var _markSwupElements = __webpack_require__(2);

      var _markSwupElements2 = _interopRequireDefault(_markSwupElements);

      var _Link = __webpack_require__(1);

      var _Link2 = _interopRequireDefault(_Link);

      function _interopRequireDefault(obj) {
        return obj && obj.__esModule ? obj : {
          default: obj
        };
      }

      var classify = exports.classify = _classify2.default;
      var createHistoryRecord = exports.createHistoryRecord = _createHistoryRecord2.default;
      var getDataFromHTML = exports.getDataFromHTML = _getDataFromHTML2.default;
      var fetch = exports.fetch = _fetch2.default;
      var transitionEnd = exports.transitionEnd = _transitionEnd2.default;
      var getCurrentUrl = exports.getCurrentUrl = _getCurrentUrl2.default;
      var markSwupElements = exports.markSwupElements = _markSwupElements2.default;
      var Link = exports.Link = _Link2.default;

      /***/
    }),
    /* 10 */
    /***/
    (function(module, exports) {

      var DOCUMENT_NODE_TYPE = 9;

      /**
       * A polyfill for Element.matches()
       */
      if (typeof Element !== 'undefined' && !Element.prototype.matches) {
        var proto = Element.prototype;

        proto.matches = proto.matchesSelector ||
          proto.mozMatchesSelector ||
          proto.msMatchesSelector ||
          proto.oMatchesSelector ||
          proto.webkitMatchesSelector;
      }

      /**
       * Finds the closest parent that matches a selector.
       *
       * @param {Element} element
       * @param {String} selector
       * @return {Function}
       */
      function closest(element, selector) {
        while (element && element.nodeType !== DOCUMENT_NODE_TYPE) {
          if (typeof element.matches === 'function' &&
            element.matches(selector)) {
            return element;
          }
          element = element.parentNode;
        }
      }

      module.exports = closest;


      /***/
    }),
    /* 11 */
    /***/
    (function(module, exports, __webpack_require__) {

      var closest = __webpack_require__(10);

      /**
       * Delegates event to a selector.
       *
       * @param {Element} element
       * @param {String} selector
       * @param {String} type
       * @param {Function} callback
       * @param {Boolean} useCapture
       * @return {Object}
       */
      function delegate(element, selector, type, callback, useCapture) {
        var listenerFn = listener.apply(this, arguments);

        element.addEventListener(type, listenerFn, useCapture);

        return {
          destroy: function() {
            element.removeEventListener(type, listenerFn, useCapture);
          }
        }
      }

      /**
       * Finds closest match and invokes callback.
       *
       * @param {Element} element
       * @param {String} selector
       * @param {String} type
       * @param {Function} callback
       * @return {Function}
       */
      function listener(element, selector, type, callback) {
        return function(e) {
          e.delegateTarget = closest(e.target, selector);

          if (e.delegateTarget) {
            callback.call(element, e);
          }
        }
      }

      module.exports = delegate;


      /***/
    }),
    /* 12 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, "__esModule", {
        value: true
      });

      var _createClass = function() {
        function defineProperties(target, props) {
          for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor);
          }
        }
        return function(Constructor, protoProps, staticProps) {
          if (protoProps) defineProperties(Constructor.prototype, protoProps);
          if (staticProps) defineProperties(Constructor, staticProps);
          return Constructor;
        };
      }();

      function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
          throw new TypeError("Cannot call a class as a function");
        }
      }

      var Plugin = function() {
        function Plugin() {
          _classCallCheck(this, Plugin);

          this.isSwupPlugin = true;
        }

        _createClass(Plugin, [{
          key: "mount",
          value: function mount() {
            // this is mount method rewritten by class extending
            // and is executed when swup is enabled with plugin
          }
        }, {
          key: "unmount",
          value: function unmount() {}
          // this is unmount method rewritten by class extending
          // and is executed when swup with plugin is disabled


          // this is here so we can tell if plugin was created by extending this class

        }]);

        return Plugin;
      }();

      exports.default = Plugin;

      /***/
    }),
    /* 13 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      Object.defineProperty(exports, "__esModule", {
        value: true
      });

      var _extends = Object.assign || function(target) {
        for (var i = 1; i < arguments.length; i++) {
          var source = arguments[i];
          for (var key in source) {
            if (Object.prototype.hasOwnProperty.call(source, key)) {
              target[key] = source[key];
            }
          }
        }
        return target;
      };

      var _createClass = function() {
        function defineProperties(target, props) {
          for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || false;
            descriptor.configurable = true;
            if ("value" in descriptor) descriptor.writable = true;
            Object.defineProperty(target, descriptor.key, descriptor);
          }
        }
        return function(Constructor, protoProps, staticProps) {
          if (protoProps) defineProperties(Constructor.prototype, protoProps);
          if (staticProps) defineProperties(Constructor, staticProps);
          return Constructor;
        };
      }();

      var _plugin = __webpack_require__(12);

      var _plugin2 = _interopRequireDefault(_plugin);

      var _delegate = __webpack_require__(11);

      var _delegate2 = _interopRequireDefault(_delegate);

      var _utils = __webpack_require__(0);

      var _helpers = __webpack_require__(9);

      function _interopRequireDefault(obj) {
        return obj && obj.__esModule ? obj : {
          default: obj
        };
      }

      function _classCallCheck(instance, Constructor) {
        if (!(instance instanceof Constructor)) {
          throw new TypeError("Cannot call a class as a function");
        }
      }

      function _possibleConstructorReturn(self, call) {
        if (!self) {
          throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        }
        return call && (typeof call === "object" || typeof call === "function") ? call : self;
      }

      function _inherits(subClass, superClass) {
        if (typeof superClass !== "function" && superClass !== null) {
          throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);
        }
        subClass.prototype = Object.create(superClass && superClass.prototype, {
          constructor: {
            value: subClass,
            enumerable: false,
            writable: true,
            configurable: true
          }
        });
        if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;
      }

      var FormPlugin = function(_Plugin) {
        _inherits(FormPlugin, _Plugin);

        function FormPlugin(options) {
          _classCallCheck(this, FormPlugin);

          var _this = _possibleConstructorReturn(this, (FormPlugin.__proto__ || Object.getPrototypeOf(FormPlugin)).call(this));

          _this.name = "SwupFormPlugin";


          var defaultOptions = {
            formSelector: 'form[data-swup-form]'
          };

          _this.options = _extends({}, defaultOptions, options);
          return _this;
        }

        _createClass(FormPlugin, [{
          key: 'mount',
          value: function mount() {
            var swup = this.swup;

            // add empty handlers array for submitForm event
            swup._handlers.submitForm = [];

            // register handler
            swup.delegatedListeners.formSubmit = (0, _delegate2.default)(document, this.options.formSelector, 'submit', this.onFormSubmit.bind(this));
          }
        }, {
          key: 'unmount',
          value: function unmount() {
            swup.delegatedListeners.formSubmit.destroy();
          }
        }, {
          key: 'onFormSubmit',
          value: function onFormSubmit(event) {
            var swup = this.swup;

            // no control key pressed
            if (!event.metaKey) {
              var form = event.target;
              var formData = new FormData(form);
              var link = new _helpers.Link(form.action);

              // fomr
              swup.triggerEvent('submitForm', event);

              event.preventDefault();

              if (link.getHash() != '') {
                swup.scrollToElement = link.getHash();
              }

              if (form.method.toLowerCase() != 'get') {
                // remove page from cache
                swup.cache.remove(link.getAddress());

                // send data
                swup.loadPage({
                  url: link.getAddress(),
                  method: form.method,
                  data: formData
                });
              } else {
                // create base url
                var url = link.getAddress() || window.location.href;
                var inputs = (0, _utils.queryAll)('input, select', form);
                if (url.indexOf('?') == -1) {
                  url += '?';
                } else {
                  url += '&';
                }

                // add form data to url
                inputs.forEach(function(input) {
                  if (input.type == 'checkbox' || input.type == 'radio') {
                    if (input.checked) {
                      url += encodeURIComponent(input.name) + '=' + encodeURIComponent(input.value) + '&';
                    }
                  } else {
                    url += encodeURIComponent(input.name) + '=' + encodeURIComponent(input.value) + '&';
                  }
                });

                // remove last "&"
                url = url.slice(0, -1);

                // remove page from cache
                swup.cache.remove(url);

                // send data
                swup.loadPage({
                  url: url
                });
              }
            } else {
              swup.triggerEvent('openFormSubmitInNewTab', event);
            }
          }
        }]);

        return FormPlugin;
      }(_plugin2.default);

      exports.default = FormPlugin;

      /***/
    }),
    /* 14 */
    /***/
    (function(module, exports, __webpack_require__) {

      "use strict";


      var _index = __webpack_require__(13);

      var _index2 = _interopRequireDefault(_index);

      function _interopRequireDefault(obj) {
        return obj && obj.__esModule ? obj : {
          default: obj
        };
      }

      module.exports = _index2.default; // this is here for webpack to expose SwupPlugin as window.SwupPlugin

      /***/
    })
    /******/
  ]);
});