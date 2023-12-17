"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tailwindcss_base_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tailwindcss/base.css */ "./node_modules/tailwindcss/base.css");
/* harmony import */ var tailwindcss_components_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tailwindcss/components.css */ "./node_modules/tailwindcss/components.css");
/* harmony import */ var tailwindcss_utilities_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tailwindcss/utilities.css */ "./node_modules/tailwindcss/utilities.css");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_index_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./js/index.js */ "./assets/js/index.js");
/* harmony import */ var _js_handleCheckbox_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/handleCheckbox.js */ "./assets/js/handleCheckbox.js");
// assets/app.js






// any CSS you import will output into a single css file (app.css in this case)



//import '/js/handleModal.js;'

var PaymentsList = function PaymentsList() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("h1", {
    className: "text-4xl font-bold text-center"
  }, "Payments List"));
};
react_dom__WEBPACK_IMPORTED_MODULE_4__.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(PaymentsList, null), document.getElementById('paymentroot'));

/***/ }),

/***/ "./assets/js/component/Checkbox.js":
/*!*****************************************!*\
  !*** ./assets/js/component/Checkbox.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var Checkbox = /*#__PURE__*/_createClass(function Checkbox(checkboxForAll, checkboxes) {
  var _this = this;
  _classCallCheck(this, Checkbox);
  _defineProperty(this, "onInit", function () {
    if (_this.checkboxSelectAll) {
      _this.checkboxSelectAll.addEventListener('change', _this.selectAllCheckboxes);
    }
    if (_this.checkboxes) {
      _this.checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', _this.selectAllCheckboxes);
      });
    }
  });
  _defineProperty(this, "disableButton", function () {
    var _iterator = _createForOfIteratorHelper(_this.checkboxes),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var checkbox = _step.value;
        if (checkbox.checked) {
          return "block";
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    return "none";
  });
  _defineProperty(this, "selectAllCheckboxes", function () {
    var clickedCheckBox = event.target;
    if (clickedCheckBox == _this.checkboxSelectAll && clickedCheckBox.checked) {
      _this.checkboxes.forEach(function (checkbox) {
        if (!checkbox.checked) {
          checkbox.checked = true;
        }
      });
    } else if (clickedCheckBox == _this.checkboxSelectAll && !clickedCheckBox.checked) {
      _this.checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          checkbox.checked = false;
        }
      });
    } else if (clickedCheckBox != _this.checkboxSelectAll && !clickedCheckBox.checked) {
      if (_this.checkboxSelectAll.checked) {
        _this.checkboxSelectAll.checked = false;
      }
    }
  });
  _defineProperty(this, "getlistID", function () {
    var listID = [];
    _this.checkboxes.forEach(function (checkbox) {
      if (checkbox.checked) {
        listID.push(parseInt(checkbox.getAttribute('name')));
      }
    });
    return listID;
  });
  this.checkboxSelectAll = document.querySelector(checkboxForAll);
  this.checkboxes = document.querySelectorAll(checkboxes);
  this.onInit();
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Checkbox);

/***/ }),

/***/ "./assets/js/component/Link.js":
/*!*************************************!*\
  !*** ./assets/js/component/Link.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var Link = /*#__PURE__*/function () {
  function Link(selector) {
    var newTab = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    _classCallCheck(this, Link);
    this.link = document.querySelectorAll(selector);
    this.newTab = newTab;
    this.init();
  }
  _createClass(Link, [{
    key: "init",
    value: function init() {
      this.initClasses();
      this.attachEvent();
    }
  }, {
    key: "initClasses",
    value: function initClasses() {
      this.link.forEach(function (link) {
        link.classList.add('cursor-pointer');
      });
    }
  }, {
    key: "attachEvent",
    value: function attachEvent() {
      var _this = this;
      this.link.forEach(function (link) {
        link.addEventListener('click', function (e) {
          if (e.target.nodeName === 'TR' || e.target.nodeName === 'TD') {
            _this.openLink(link);
          }
        });
      });
    }
  }, {
    key: "openLink",
    value: function openLink(e) {
      var url = e.dataset.href;
      if (this.newTab) {
        return window.open(url, '_blank');
      }
      window.location = url;
    }
  }]);
  return Link;
}();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Link);

/***/ }),

/***/ "./assets/js/component/NavToggle.js":
/*!******************************************!*\
  !*** ./assets/js/component/NavToggle.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var NavToggle = /*#__PURE__*/function () {
  function NavToggle(toggleSelector, navSelector) {
    var _this = this;
    _classCallCheck(this, NavToggle);
    this.navToggle = document.querySelector(toggleSelector);
    this.nav = document.querySelector(navSelector);
    this.navToggle.addEventListener('click', function () {
      return _this.toggle();
    });
  }
  _createClass(NavToggle, [{
    key: "toggle",
    value: function toggle() {
      var isOpen = this.nav.getAttribute('data-open') === 'true';
      this.nav.setAttribute('data-open', !isOpen);
      if (isOpen) {
        this.nav.classList.remove('ml-0');
        this.nav.classList.add('ml-[-18rem]');
      } else {
        this.nav.classList.add('ml-0');
        this.nav.classList.remove('ml-[-18rem]');
      }
    }
  }]);
  return NavToggle;
}();
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (NavToggle);

/***/ }),

/***/ "./assets/js/handleCheckbox.js":
/*!*************************************!*\
  !*** ./assets/js/handleCheckbox.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./component/Checkbox.js */ "./assets/js/component/Checkbox.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw new Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw new Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }


//on récupère la case permettant de cocher toutes les autres cases et on le met dans le tableau
var checkboxSelectAllList = [document.querySelector('.products-checkbox'), document.querySelector('.categories-checkbox')];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
var checkboxesList = [document.querySelectorAll('.product-checkbox'), document.querySelectorAll('.category-checkbox')];
//on crée un objet Checkbox
var checkboxObjects = [new _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__["default"]('.products-checkbox', '.product-checkbox'), new _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__["default"]('.categories-checkbox', '.category-checkbox')];
//ID des boutons à désactiver/activer
var disableButton = document.getElementById('disable_buttons');
checkboxSelectAllList.forEach(function (checkbox, index) {
  if (checkbox) {
    checkbox.addEventListener('change', function () {
      checkboxObjects[index].onInit();
      disableButton.style.display = checkboxObjects[index].disableButton();
    });
  }
});
checkboxesList.forEach(function (checkboxes, index) {
  if (checkboxes) {
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        checkboxObjects[index].onInit();
        disableButton.style.display = checkboxObjects[index].disableButton();
      });
    });
  }
});

/***************************************************************************** */
/********************************DELETE ACTIONS******************************* */
/***************************************************************************** */

var deleteButtons = [document.getElementById('delete_products'), document.getElementById('delete_categories')];
var deleteModals = [document.getElementById('modal_delete')];
var cancelDeleteButtons = [document.getElementById('cancel_delete')];
var confirmDeleteButtons = [document.getElementById('confirm_delete')];
var route = ['/products/delete', '/products/category/delete'];
deleteButtons.forEach(function (button, index) {
  if (button) {
    button.addEventListener('click', function () {
      deleteModals[0].classList.remove('hidden');
      cancelDeleteButtons[0].addEventListener('click', function () {
        deleteModals[0].classList.add('hidden');
      });
      confirmDeleteButtons[0].addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var list;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              list = checkboxObjects[index].getlistID();
              console.log(list);
              console.log('list en json');
              console.log(JSON.stringify(list));
              _context.next = 6;
              return fetch(route[index], {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify(list)
              }).then(function (response) {
                if (response.ok) {
                  window.location.reload(true);
                } else {
                  console.error('Erreur lors de la suppresion.');
                }
              })["catch"](function (error) {
                console.error('Erreur lors de la requête de suppresion : ', error);
              });
            case 6:
              modal_delete.classList.add('hidden');
            case 7:
            case "end":
              return _context.stop();
          }
        }, _callee);
      })));
    });
  }
});

/***/ }),

/***/ "./assets/js/helper/global.js":
/*!************************************!*\
  !*** ./assets/js/helper/global.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   attachToWindow: () => (/* binding */ attachToWindow)
/* harmony export */ });
function attachToWindow(components) {
  Object.keys(components).forEach(function (key) {
    window[key] = components[key];
  });
}


/***/ }),

/***/ "./assets/js/index.js":
/*!****************************!*\
  !*** ./assets/js/index.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helper_global__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helper/global */ "./assets/js/helper/global.js");
/* harmony import */ var _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./component/NavToggle */ "./assets/js/component/NavToggle.js");
/* harmony import */ var _component_Link__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./component/Link */ "./assets/js/component/Link.js");


// Import all available components


_helper_global__WEBPACK_IMPORTED_MODULE_0__.attachToWindow({
  NavToggle: _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__["default"],
  Link: _component_Link__WEBPACK_IMPORTED_MODULE_2__["default"]
});

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_tailwindcss_base_css-node_modules_tailwindcss_components_css-node_module-99a4e9"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUM4QjtBQUNNO0FBQ0Q7QUFDVDtBQUNPOztBQUVqQztBQUMwQjtBQUNIO0FBQ1M7QUFDaEM7O0FBR0EsSUFBTUUsWUFBWSxHQUFHLFNBQWZBLFlBQVlBLENBQUEsRUFBUztFQUN6QixvQkFDRUYsMERBQUEsMkJBQ0VBLDBEQUFBO0lBQUlJLFNBQVMsRUFBQztFQUFnQyxHQUFDLGVBQWlCLENBQzdELENBQUM7QUFFVixDQUFDO0FBR0RILDZDQUFlLGVBQUNELDBEQUFBLENBQUNFLFlBQVksTUFBRSxDQUFDLEVBQUVJLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLGFBQWEsQ0FBQyxDQUFDOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUN2Qm5FQyxRQUFRLGdCQUFBQyxZQUFBLENBQ1YsU0FBQUQsU0FBWUUsY0FBYyxFQUFFQyxVQUFVLEVBQUM7RUFBQSxJQUFBQyxLQUFBO0VBQUFDLGVBQUEsT0FBQUwsUUFBQTtFQUFBTSxlQUFBLGlCQU0vQixZQUFJO0lBQ1IsSUFBR0YsS0FBSSxDQUFDRyxpQkFBaUIsRUFBQztNQUNyQkgsS0FBSSxDQUFDRyxpQkFBaUIsQ0FBQ0MsZ0JBQWdCLENBQUMsUUFBUSxFQUFFSixLQUFJLENBQUNLLG1CQUFtQixDQUFDO0lBQ2hGO0lBQ0QsSUFBR0wsS0FBSSxDQUFDRCxVQUFVLEVBQUM7TUFDZEMsS0FBSSxDQUFDRCxVQUFVLENBQUNPLE9BQU8sQ0FBQyxVQUFBQyxRQUFRLEVBQUk7UUFDaENBLFFBQVEsQ0FBQ0gsZ0JBQWdCLENBQUMsUUFBUSxFQUFFSixLQUFJLENBQUNLLG1CQUFtQixDQUFDO01BQ2pFLENBQUMsQ0FBQztJQUNQO0VBR0gsQ0FBQztFQUFBSCxlQUFBLHdCQUVjLFlBQUk7SUFBQSxJQUFBTSxTQUFBLEdBQUFDLDBCQUFBLENBQ0tULEtBQUksQ0FBQ0QsVUFBVTtNQUFBVyxLQUFBO0lBQUE7TUFBbkMsS0FBQUYsU0FBQSxDQUFBRyxDQUFBLE1BQUFELEtBQUEsR0FBQUYsU0FBQSxDQUFBSSxDQUFBLElBQUFDLElBQUEsR0FBb0M7UUFBQSxJQUE1Qk4sUUFBUSxHQUFBRyxLQUFBLENBQUFJLEtBQUE7UUFDWixJQUFHUCxRQUFRLENBQUNRLE9BQU8sRUFBQztVQUNoQixPQUFPLE9BQU87UUFDbEI7TUFDSjtJQUFDLFNBQUFDLEdBQUE7TUFBQVIsU0FBQSxDQUFBUyxDQUFBLENBQUFELEdBQUE7SUFBQTtNQUFBUixTQUFBLENBQUFVLENBQUE7SUFBQTtJQUNELE9BQU8sTUFBTTtFQUVqQixDQUFDO0VBQUFoQixlQUFBLDhCQUVvQixZQUFJO0lBQ3JCLElBQU1pQixlQUFlLEdBQUdDLEtBQUssQ0FBQ0MsTUFBTTtJQUVwQyxJQUFHRixlQUFlLElBQUluQixLQUFJLENBQUNHLGlCQUFpQixJQUFJZ0IsZUFBZSxDQUFDSixPQUFPLEVBQUM7TUFDcEVmLEtBQUksQ0FBQ0QsVUFBVSxDQUFDTyxPQUFPLENBQUMsVUFBQ0MsUUFBUSxFQUFLO1FBQ2xDLElBQUcsQ0FBQ0EsUUFBUSxDQUFDUSxPQUFPLEVBQUM7VUFDakJSLFFBQVEsQ0FBQ1EsT0FBTyxHQUFHLElBQUk7UUFDM0I7TUFDSixDQUFDLENBQUM7SUFDTixDQUFDLE1BQ0ksSUFBR0ksZUFBZSxJQUFJbkIsS0FBSSxDQUFDRyxpQkFBaUIsSUFBSSxDQUFDZ0IsZUFBZSxDQUFDSixPQUFPLEVBQUM7TUFDMUVmLEtBQUksQ0FBQ0QsVUFBVSxDQUFDTyxPQUFPLENBQUMsVUFBQ0MsUUFBUSxFQUFLO1FBQ2xDLElBQUdBLFFBQVEsQ0FBQ1EsT0FBTyxFQUFDO1VBQ2hCUixRQUFRLENBQUNRLE9BQU8sR0FBRyxLQUFLO1FBQzVCO01BQ0osQ0FBQyxDQUFDO0lBQ04sQ0FBQyxNQUNJLElBQUdJLGVBQWUsSUFBSW5CLEtBQUksQ0FBQ0csaUJBQWlCLElBQUksQ0FBQ2dCLGVBQWUsQ0FBQ0osT0FBTyxFQUFDO01BQzFFLElBQUdmLEtBQUksQ0FBQ0csaUJBQWlCLENBQUNZLE9BQU8sRUFBQztRQUM5QmYsS0FBSSxDQUFDRyxpQkFBaUIsQ0FBQ1ksT0FBTyxHQUFHLEtBQUs7TUFDMUM7SUFDSjtFQUVKLENBQUM7RUFBQWIsZUFBQSxvQkFFVSxZQUFJO0lBQ1gsSUFBSW9CLE1BQU0sR0FBRyxFQUFFO0lBQ2Z0QixLQUFJLENBQUNELFVBQVUsQ0FBQ08sT0FBTyxDQUFDLFVBQUNDLFFBQVEsRUFBSztNQUNsQyxJQUFHQSxRQUFRLENBQUNRLE9BQU8sRUFBQztRQUNoQk8sTUFBTSxDQUFDQyxJQUFJLENBQUNDLFFBQVEsQ0FBQ2pCLFFBQVEsQ0FBQ2tCLFlBQVksQ0FBQyxNQUFNLENBQUMsQ0FBQyxDQUFDO01BQ3hEO0lBQ0osQ0FBQyxDQUFDO0lBRUYsT0FBT0gsTUFBTTtFQUNqQixDQUFDO0VBOURHLElBQUksQ0FBQ25CLGlCQUFpQixHQUFHVCxRQUFRLENBQUNnQyxhQUFhLENBQUM1QixjQUFjLENBQUM7RUFDL0QsSUFBSSxDQUFDQyxVQUFVLEdBQUdMLFFBQVEsQ0FBQ2lDLGdCQUFnQixDQUFDNUIsVUFBVSxDQUFDO0VBQ3ZELElBQUksQ0FBQzZCLE1BQU0sQ0FBQyxDQUFDO0FBQ2pCLENBQUM7QUErREwsaUVBQWVoQyxRQUFROzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztJQ3BFakJpQyxJQUFJO0VBQ04sU0FBQUEsS0FBWUMsUUFBUSxFQUFrQjtJQUFBLElBQWhCQyxNQUFNLEdBQUFDLFNBQUEsQ0FBQUMsTUFBQSxRQUFBRCxTQUFBLFFBQUFFLFNBQUEsR0FBQUYsU0FBQSxNQUFHLEtBQUs7SUFBQS9CLGVBQUEsT0FBQTRCLElBQUE7SUFDaEMsSUFBSSxDQUFDTSxJQUFJLEdBQUd6QyxRQUFRLENBQUNpQyxnQkFBZ0IsQ0FBQ0csUUFBUSxDQUFDO0lBQy9DLElBQUksQ0FBQ0MsTUFBTSxHQUFHQSxNQUFNO0lBQ3BCLElBQUksQ0FBQ0ssSUFBSSxDQUFDLENBQUM7RUFDZjtFQUFDdkMsWUFBQSxDQUFBZ0MsSUFBQTtJQUFBUSxHQUFBO0lBQUF2QixLQUFBLEVBRUQsU0FBQXNCLEtBQUEsRUFBTztNQUNILElBQUksQ0FBQ0UsV0FBVyxDQUFDLENBQUM7TUFDbEIsSUFBSSxDQUFDQyxXQUFXLENBQUMsQ0FBQztJQUN0QjtFQUFDO0lBQUFGLEdBQUE7SUFBQXZCLEtBQUEsRUFFRCxTQUFBd0IsWUFBQSxFQUFjO01BQ1YsSUFBSSxDQUFDSCxJQUFJLENBQUM3QixPQUFPLENBQUMsVUFBQTZCLElBQUksRUFBSTtRQUN0QkEsSUFBSSxDQUFDSyxTQUFTLENBQUNDLEdBQUcsQ0FBQyxnQkFBZ0IsQ0FBQztNQUN4QyxDQUFDLENBQUM7SUFDTjtFQUFDO0lBQUFKLEdBQUE7SUFBQXZCLEtBQUEsRUFFRCxTQUFBeUIsWUFBQSxFQUFjO01BQUEsSUFBQXZDLEtBQUE7TUFDVixJQUFJLENBQUNtQyxJQUFJLENBQUM3QixPQUFPLENBQUMsVUFBQTZCLElBQUksRUFBSTtRQUN0QkEsSUFBSSxDQUFDL0IsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFVBQUFhLENBQUMsRUFBSTtVQUNoQyxJQUFJQSxDQUFDLENBQUNJLE1BQU0sQ0FBQ3FCLFFBQVEsS0FBSyxJQUFJLElBQUl6QixDQUFDLENBQUNJLE1BQU0sQ0FBQ3FCLFFBQVEsS0FBSyxJQUFJLEVBQUU7WUFDMUQxQyxLQUFJLENBQUMyQyxRQUFRLENBQUNSLElBQUksQ0FBQztVQUN2QjtRQUNKLENBQUMsQ0FBQztNQUNOLENBQUMsQ0FBQztJQUNOO0VBQUM7SUFBQUUsR0FBQTtJQUFBdkIsS0FBQSxFQUVELFNBQUE2QixTQUFTMUIsQ0FBQyxFQUFFO01BQ1IsSUFBTTJCLEdBQUcsR0FBRzNCLENBQUMsQ0FBQzRCLE9BQU8sQ0FBQ0MsSUFBSTtNQUMxQixJQUFJLElBQUksQ0FBQ2YsTUFBTSxFQUFFO1FBQ2IsT0FBT2dCLE1BQU0sQ0FBQ0MsSUFBSSxDQUFDSixHQUFHLEVBQUUsUUFBUSxDQUFDO01BQ3JDO01BQ0FHLE1BQU0sQ0FBQ0UsUUFBUSxHQUFHTCxHQUFHO0lBQ3pCO0VBQUM7RUFBQSxPQUFBZixJQUFBO0FBQUE7QUFHTCxpRUFBZUEsSUFBSTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUNyQ2JxQixTQUFTO0VBQ1gsU0FBQUEsVUFBWUMsY0FBYyxFQUFFQyxXQUFXLEVBQUU7SUFBQSxJQUFBcEQsS0FBQTtJQUFBQyxlQUFBLE9BQUFpRCxTQUFBO0lBQ3JDLElBQUksQ0FBQ0csU0FBUyxHQUFHM0QsUUFBUSxDQUFDZ0MsYUFBYSxDQUFDeUIsY0FBYyxDQUFDO0lBQ3ZELElBQUksQ0FBQ0csR0FBRyxHQUFHNUQsUUFBUSxDQUFDZ0MsYUFBYSxDQUFDMEIsV0FBVyxDQUFDO0lBQzlDLElBQUksQ0FBQ0MsU0FBUyxDQUFDakQsZ0JBQWdCLENBQUMsT0FBTyxFQUFFO01BQUEsT0FBTUosS0FBSSxDQUFDdUQsTUFBTSxDQUFDLENBQUM7SUFBQSxFQUFDO0VBQ2pFO0VBQUMxRCxZQUFBLENBQUFxRCxTQUFBO0lBQUFiLEdBQUE7SUFBQXZCLEtBQUEsRUFFRCxTQUFBeUMsT0FBQSxFQUFTO01BQ0wsSUFBTUMsTUFBTSxHQUFHLElBQUksQ0FBQ0YsR0FBRyxDQUFDN0IsWUFBWSxDQUFDLFdBQVcsQ0FBQyxLQUFLLE1BQU07TUFDNUQsSUFBSSxDQUFDNkIsR0FBRyxDQUFDRyxZQUFZLENBQUMsV0FBVyxFQUFFLENBQUNELE1BQU0sQ0FBQztNQUMzQyxJQUFJQSxNQUFNLEVBQUU7UUFDUixJQUFJLENBQUNGLEdBQUcsQ0FBQ2QsU0FBUyxDQUFDa0IsTUFBTSxDQUFDLE1BQU0sQ0FBQztRQUNqQyxJQUFJLENBQUNKLEdBQUcsQ0FBQ2QsU0FBUyxDQUFDQyxHQUFHLENBQUMsYUFBYSxDQUFDO01BQ3pDLENBQUMsTUFBTTtRQUNILElBQUksQ0FBQ2EsR0FBRyxDQUFDZCxTQUFTLENBQUNDLEdBQUcsQ0FBQyxNQUFNLENBQUM7UUFDOUIsSUFBSSxDQUFDYSxHQUFHLENBQUNkLFNBQVMsQ0FBQ2tCLE1BQU0sQ0FBQyxhQUFhLENBQUM7TUFDNUM7SUFDSjtFQUFDO0VBQUEsT0FBQVIsU0FBQTtBQUFBO0FBR0wsaUVBQWVBLFNBQVM7Ozs7Ozs7Ozs7Ozs7K0NDbkJ4QixxSkFBQVMsbUJBQUEsWUFBQUEsb0JBQUEsV0FBQTFDLENBQUEsU0FBQTJDLENBQUEsRUFBQTNDLENBQUEsT0FBQTRDLENBQUEsR0FBQUMsTUFBQSxDQUFBQyxTQUFBLEVBQUFuRCxDQUFBLEdBQUFpRCxDQUFBLENBQUFHLGNBQUEsRUFBQUMsQ0FBQSxHQUFBSCxNQUFBLENBQUFJLGNBQUEsY0FBQU4sQ0FBQSxFQUFBM0MsQ0FBQSxFQUFBNEMsQ0FBQSxJQUFBRCxDQUFBLENBQUEzQyxDQUFBLElBQUE0QyxDQUFBLENBQUEvQyxLQUFBLEtBQUFxRCxDQUFBLHdCQUFBQyxNQUFBLEdBQUFBLE1BQUEsT0FBQUMsQ0FBQSxHQUFBRixDQUFBLENBQUFHLFFBQUEsa0JBQUFDLENBQUEsR0FBQUosQ0FBQSxDQUFBSyxhQUFBLHVCQUFBQyxDQUFBLEdBQUFOLENBQUEsQ0FBQU8sV0FBQSw4QkFBQUMsT0FBQWYsQ0FBQSxFQUFBM0MsQ0FBQSxFQUFBNEMsQ0FBQSxXQUFBQyxNQUFBLENBQUFJLGNBQUEsQ0FBQU4sQ0FBQSxFQUFBM0MsQ0FBQSxJQUFBSCxLQUFBLEVBQUErQyxDQUFBLEVBQUFlLFVBQUEsTUFBQUMsWUFBQSxNQUFBQyxRQUFBLFNBQUFsQixDQUFBLENBQUEzQyxDQUFBLFdBQUEwRCxNQUFBLG1CQUFBZixDQUFBLElBQUFlLE1BQUEsWUFBQUEsT0FBQWYsQ0FBQSxFQUFBM0MsQ0FBQSxFQUFBNEMsQ0FBQSxXQUFBRCxDQUFBLENBQUEzQyxDQUFBLElBQUE0QyxDQUFBLGdCQUFBa0IsS0FBQW5CLENBQUEsRUFBQTNDLENBQUEsRUFBQTRDLENBQUEsRUFBQWpELENBQUEsUUFBQXVELENBQUEsR0FBQWxELENBQUEsSUFBQUEsQ0FBQSxDQUFBOEMsU0FBQSxZQUFBaUIsU0FBQSxHQUFBL0QsQ0FBQSxHQUFBK0QsU0FBQSxFQUFBWCxDQUFBLEdBQUFQLE1BQUEsQ0FBQW1CLE1BQUEsQ0FBQWQsQ0FBQSxDQUFBSixTQUFBLEdBQUFRLENBQUEsT0FBQVcsT0FBQSxDQUFBdEUsQ0FBQSxnQkFBQXFELENBQUEsQ0FBQUksQ0FBQSxlQUFBdkQsS0FBQSxFQUFBcUUsZ0JBQUEsQ0FBQXZCLENBQUEsRUFBQUMsQ0FBQSxFQUFBVSxDQUFBLE1BQUFGLENBQUEsYUFBQWUsU0FBQXhCLENBQUEsRUFBQTNDLENBQUEsRUFBQTRDLENBQUEsbUJBQUF3QixJQUFBLFlBQUFDLEdBQUEsRUFBQTFCLENBQUEsQ0FBQTJCLElBQUEsQ0FBQXRFLENBQUEsRUFBQTRDLENBQUEsY0FBQUQsQ0FBQSxhQUFBeUIsSUFBQSxXQUFBQyxHQUFBLEVBQUExQixDQUFBLFFBQUEzQyxDQUFBLENBQUE4RCxJQUFBLEdBQUFBLElBQUEsTUFBQVMsQ0FBQSxxQkFBQUMsQ0FBQSxxQkFBQXZFLENBQUEsZ0JBQUFQLENBQUEsZ0JBQUErRSxDQUFBLGdCQUFBVixVQUFBLGNBQUFXLGtCQUFBLGNBQUFDLDJCQUFBLFNBQUFDLENBQUEsT0FBQWxCLE1BQUEsQ0FBQWtCLENBQUEsRUFBQXhCLENBQUEscUNBQUF5QixDQUFBLEdBQUFoQyxNQUFBLENBQUFpQyxjQUFBLEVBQUFDLENBQUEsR0FBQUYsQ0FBQSxJQUFBQSxDQUFBLENBQUFBLENBQUEsQ0FBQUcsTUFBQSxRQUFBRCxDQUFBLElBQUFBLENBQUEsS0FBQW5DLENBQUEsSUFBQWpELENBQUEsQ0FBQTJFLElBQUEsQ0FBQVMsQ0FBQSxFQUFBM0IsQ0FBQSxNQUFBd0IsQ0FBQSxHQUFBRyxDQUFBLE9BQUFFLENBQUEsR0FBQU4sMEJBQUEsQ0FBQTdCLFNBQUEsR0FBQWlCLFNBQUEsQ0FBQWpCLFNBQUEsR0FBQUQsTUFBQSxDQUFBbUIsTUFBQSxDQUFBWSxDQUFBLFlBQUFNLHNCQUFBdkMsQ0FBQSxnQ0FBQXRELE9BQUEsV0FBQVcsQ0FBQSxJQUFBMEQsTUFBQSxDQUFBZixDQUFBLEVBQUEzQyxDQUFBLFlBQUEyQyxDQUFBLGdCQUFBd0MsT0FBQSxDQUFBbkYsQ0FBQSxFQUFBMkMsQ0FBQSxzQkFBQXlDLGNBQUF6QyxDQUFBLEVBQUEzQyxDQUFBLGFBQUFxRixPQUFBekMsQ0FBQSxFQUFBSSxDQUFBLEVBQUFFLENBQUEsRUFBQUUsQ0FBQSxRQUFBRSxDQUFBLEdBQUFhLFFBQUEsQ0FBQXhCLENBQUEsQ0FBQUMsQ0FBQSxHQUFBRCxDQUFBLEVBQUFLLENBQUEsbUJBQUFNLENBQUEsQ0FBQWMsSUFBQSxRQUFBWixDQUFBLEdBQUFGLENBQUEsQ0FBQWUsR0FBQSxFQUFBRSxDQUFBLEdBQUFmLENBQUEsQ0FBQTNELEtBQUEsU0FBQTBFLENBQUEsZ0JBQUFlLE9BQUEsQ0FBQWYsQ0FBQSxLQUFBNUUsQ0FBQSxDQUFBMkUsSUFBQSxDQUFBQyxDQUFBLGVBQUF2RSxDQUFBLENBQUF1RixPQUFBLENBQUFoQixDQUFBLENBQUFpQixPQUFBLEVBQUFDLElBQUEsV0FBQTlDLENBQUEsSUFBQTBDLE1BQUEsU0FBQTFDLENBQUEsRUFBQU8sQ0FBQSxFQUFBRSxDQUFBLGdCQUFBVCxDQUFBLElBQUEwQyxNQUFBLFVBQUExQyxDQUFBLEVBQUFPLENBQUEsRUFBQUUsQ0FBQSxRQUFBcEQsQ0FBQSxDQUFBdUYsT0FBQSxDQUFBaEIsQ0FBQSxFQUFBa0IsSUFBQSxXQUFBOUMsQ0FBQSxJQUFBYSxDQUFBLENBQUEzRCxLQUFBLEdBQUE4QyxDQUFBLEVBQUFPLENBQUEsQ0FBQU0sQ0FBQSxnQkFBQWIsQ0FBQSxXQUFBMEMsTUFBQSxVQUFBMUMsQ0FBQSxFQUFBTyxDQUFBLEVBQUFFLENBQUEsU0FBQUEsQ0FBQSxDQUFBRSxDQUFBLENBQUFlLEdBQUEsU0FBQXpCLENBQUEsRUFBQUksQ0FBQSxvQkFBQW5ELEtBQUEsV0FBQUEsTUFBQThDLENBQUEsRUFBQWhELENBQUEsYUFBQStGLDJCQUFBLGVBQUExRixDQUFBLFdBQUFBLENBQUEsRUFBQTRDLENBQUEsSUFBQXlDLE1BQUEsQ0FBQTFDLENBQUEsRUFBQWhELENBQUEsRUFBQUssQ0FBQSxFQUFBNEMsQ0FBQSxnQkFBQUEsQ0FBQSxHQUFBQSxDQUFBLEdBQUFBLENBQUEsQ0FBQTZDLElBQUEsQ0FBQUMsMEJBQUEsRUFBQUEsMEJBQUEsSUFBQUEsMEJBQUEscUJBQUF4QixpQkFBQWxFLENBQUEsRUFBQTRDLENBQUEsRUFBQWpELENBQUEsUUFBQXFELENBQUEsR0FBQXVCLENBQUEsbUJBQUFyQixDQUFBLEVBQUFFLENBQUEsUUFBQUosQ0FBQSxLQUFBL0MsQ0FBQSxZQUFBMEYsS0FBQSxzQ0FBQTNDLENBQUEsS0FBQXRELENBQUEsb0JBQUF3RCxDQUFBLFFBQUFFLENBQUEsV0FBQXZELEtBQUEsRUFBQThDLENBQUEsRUFBQS9DLElBQUEsZUFBQUQsQ0FBQSxDQUFBaUcsTUFBQSxHQUFBMUMsQ0FBQSxFQUFBdkQsQ0FBQSxDQUFBMEUsR0FBQSxHQUFBakIsQ0FBQSxVQUFBRSxDQUFBLEdBQUEzRCxDQUFBLENBQUFrRyxRQUFBLE1BQUF2QyxDQUFBLFFBQUFFLENBQUEsR0FBQXNDLG1CQUFBLENBQUF4QyxDQUFBLEVBQUEzRCxDQUFBLE9BQUE2RCxDQUFBLFFBQUFBLENBQUEsS0FBQWlCLENBQUEsbUJBQUFqQixDQUFBLHFCQUFBN0QsQ0FBQSxDQUFBaUcsTUFBQSxFQUFBakcsQ0FBQSxDQUFBb0csSUFBQSxHQUFBcEcsQ0FBQSxDQUFBcUcsS0FBQSxHQUFBckcsQ0FBQSxDQUFBMEUsR0FBQSxzQkFBQTFFLENBQUEsQ0FBQWlHLE1BQUEsUUFBQTVDLENBQUEsS0FBQXVCLENBQUEsUUFBQXZCLENBQUEsR0FBQXRELENBQUEsRUFBQUMsQ0FBQSxDQUFBMEUsR0FBQSxFQUFBMUUsQ0FBQSxDQUFBc0csaUJBQUEsQ0FBQXRHLENBQUEsQ0FBQTBFLEdBQUEsdUJBQUExRSxDQUFBLENBQUFpRyxNQUFBLElBQUFqRyxDQUFBLENBQUF1RyxNQUFBLFdBQUF2RyxDQUFBLENBQUEwRSxHQUFBLEdBQUFyQixDQUFBLEdBQUEvQyxDQUFBLE1BQUEyRSxDQUFBLEdBQUFULFFBQUEsQ0FBQW5FLENBQUEsRUFBQTRDLENBQUEsRUFBQWpELENBQUEsb0JBQUFpRixDQUFBLENBQUFSLElBQUEsUUFBQXBCLENBQUEsR0FBQXJELENBQUEsQ0FBQUMsSUFBQSxHQUFBRixDQUFBLEdBQUE4RSxDQUFBLEVBQUFJLENBQUEsQ0FBQVAsR0FBQSxLQUFBSSxDQUFBLHFCQUFBNUUsS0FBQSxFQUFBK0UsQ0FBQSxDQUFBUCxHQUFBLEVBQUF6RSxJQUFBLEVBQUFELENBQUEsQ0FBQUMsSUFBQSxrQkFBQWdGLENBQUEsQ0FBQVIsSUFBQSxLQUFBcEIsQ0FBQSxHQUFBdEQsQ0FBQSxFQUFBQyxDQUFBLENBQUFpRyxNQUFBLFlBQUFqRyxDQUFBLENBQUEwRSxHQUFBLEdBQUFPLENBQUEsQ0FBQVAsR0FBQSxtQkFBQXlCLG9CQUFBOUYsQ0FBQSxFQUFBNEMsQ0FBQSxRQUFBakQsQ0FBQSxHQUFBaUQsQ0FBQSxDQUFBZ0QsTUFBQSxFQUFBNUMsQ0FBQSxHQUFBaEQsQ0FBQSxDQUFBcUQsUUFBQSxDQUFBMUQsQ0FBQSxPQUFBcUQsQ0FBQSxLQUFBTCxDQUFBLFNBQUFDLENBQUEsQ0FBQWlELFFBQUEscUJBQUFsRyxDQUFBLElBQUFLLENBQUEsQ0FBQXFELFFBQUEsZUFBQVQsQ0FBQSxDQUFBZ0QsTUFBQSxhQUFBaEQsQ0FBQSxDQUFBeUIsR0FBQSxHQUFBMUIsQ0FBQSxFQUFBbUQsbUJBQUEsQ0FBQTlGLENBQUEsRUFBQTRDLENBQUEsZUFBQUEsQ0FBQSxDQUFBZ0QsTUFBQSxrQkFBQWpHLENBQUEsS0FBQWlELENBQUEsQ0FBQWdELE1BQUEsWUFBQWhELENBQUEsQ0FBQXlCLEdBQUEsT0FBQThCLFNBQUEsdUNBQUF4RyxDQUFBLGlCQUFBOEUsQ0FBQSxNQUFBdkIsQ0FBQSxHQUFBaUIsUUFBQSxDQUFBbkIsQ0FBQSxFQUFBaEQsQ0FBQSxDQUFBcUQsUUFBQSxFQUFBVCxDQUFBLENBQUF5QixHQUFBLG1CQUFBbkIsQ0FBQSxDQUFBa0IsSUFBQSxTQUFBeEIsQ0FBQSxDQUFBZ0QsTUFBQSxZQUFBaEQsQ0FBQSxDQUFBeUIsR0FBQSxHQUFBbkIsQ0FBQSxDQUFBbUIsR0FBQSxFQUFBekIsQ0FBQSxDQUFBaUQsUUFBQSxTQUFBcEIsQ0FBQSxNQUFBckIsQ0FBQSxHQUFBRixDQUFBLENBQUFtQixHQUFBLFNBQUFqQixDQUFBLEdBQUFBLENBQUEsQ0FBQXhELElBQUEsSUFBQWdELENBQUEsQ0FBQTVDLENBQUEsQ0FBQW9HLFVBQUEsSUFBQWhELENBQUEsQ0FBQXZELEtBQUEsRUFBQStDLENBQUEsQ0FBQXlELElBQUEsR0FBQXJHLENBQUEsQ0FBQXNHLE9BQUEsZUFBQTFELENBQUEsQ0FBQWdELE1BQUEsS0FBQWhELENBQUEsQ0FBQWdELE1BQUEsV0FBQWhELENBQUEsQ0FBQXlCLEdBQUEsR0FBQTFCLENBQUEsR0FBQUMsQ0FBQSxDQUFBaUQsUUFBQSxTQUFBcEIsQ0FBQSxJQUFBckIsQ0FBQSxJQUFBUixDQUFBLENBQUFnRCxNQUFBLFlBQUFoRCxDQUFBLENBQUF5QixHQUFBLE9BQUE4QixTQUFBLHNDQUFBdkQsQ0FBQSxDQUFBaUQsUUFBQSxTQUFBcEIsQ0FBQSxjQUFBOEIsYUFBQTVELENBQUEsUUFBQTNDLENBQUEsS0FBQXdHLE1BQUEsRUFBQTdELENBQUEsWUFBQUEsQ0FBQSxLQUFBM0MsQ0FBQSxDQUFBeUcsUUFBQSxHQUFBOUQsQ0FBQSxXQUFBQSxDQUFBLEtBQUEzQyxDQUFBLENBQUEwRyxVQUFBLEdBQUEvRCxDQUFBLEtBQUEzQyxDQUFBLENBQUEyRyxRQUFBLEdBQUFoRSxDQUFBLFdBQUFpRSxVQUFBLENBQUF0RyxJQUFBLENBQUFOLENBQUEsY0FBQTZHLGNBQUFsRSxDQUFBLFFBQUEzQyxDQUFBLEdBQUEyQyxDQUFBLENBQUFtRSxVQUFBLFFBQUE5RyxDQUFBLENBQUFvRSxJQUFBLG9CQUFBcEUsQ0FBQSxDQUFBcUUsR0FBQSxFQUFBMUIsQ0FBQSxDQUFBbUUsVUFBQSxHQUFBOUcsQ0FBQSxhQUFBaUUsUUFBQXRCLENBQUEsU0FBQWlFLFVBQUEsTUFBQUosTUFBQSxhQUFBN0QsQ0FBQSxDQUFBdEQsT0FBQSxDQUFBa0gsWUFBQSxjQUFBUSxLQUFBLGlCQUFBL0IsT0FBQWhGLENBQUEsUUFBQUEsQ0FBQSxXQUFBQSxDQUFBLFFBQUE0QyxDQUFBLEdBQUE1QyxDQUFBLENBQUFvRCxDQUFBLE9BQUFSLENBQUEsU0FBQUEsQ0FBQSxDQUFBMEIsSUFBQSxDQUFBdEUsQ0FBQSw0QkFBQUEsQ0FBQSxDQUFBcUcsSUFBQSxTQUFBckcsQ0FBQSxPQUFBZ0gsS0FBQSxDQUFBaEgsQ0FBQSxDQUFBZ0IsTUFBQSxTQUFBZ0MsQ0FBQSxPQUFBRSxDQUFBLFlBQUFtRCxLQUFBLGFBQUFyRCxDQUFBLEdBQUFoRCxDQUFBLENBQUFnQixNQUFBLE9BQUFyQixDQUFBLENBQUEyRSxJQUFBLENBQUF0RSxDQUFBLEVBQUFnRCxDQUFBLFVBQUFxRCxJQUFBLENBQUF4RyxLQUFBLEdBQUFHLENBQUEsQ0FBQWdELENBQUEsR0FBQXFELElBQUEsQ0FBQXpHLElBQUEsT0FBQXlHLElBQUEsU0FBQUEsSUFBQSxDQUFBeEcsS0FBQSxHQUFBOEMsQ0FBQSxFQUFBMEQsSUFBQSxDQUFBekcsSUFBQSxPQUFBeUcsSUFBQSxZQUFBbkQsQ0FBQSxDQUFBbUQsSUFBQSxHQUFBbkQsQ0FBQSxnQkFBQWlELFNBQUEsQ0FBQWIsT0FBQSxDQUFBdEYsQ0FBQSxrQ0FBQTBFLGlCQUFBLENBQUE1QixTQUFBLEdBQUE2QiwwQkFBQSxFQUFBM0IsQ0FBQSxDQUFBaUMsQ0FBQSxtQkFBQXBGLEtBQUEsRUFBQThFLDBCQUFBLEVBQUFmLFlBQUEsU0FBQVosQ0FBQSxDQUFBMkIsMEJBQUEsbUJBQUE5RSxLQUFBLEVBQUE2RSxpQkFBQSxFQUFBZCxZQUFBLFNBQUFjLGlCQUFBLENBQUF1QyxXQUFBLEdBQUF2RCxNQUFBLENBQUFpQiwwQkFBQSxFQUFBbkIsQ0FBQSx3QkFBQXhELENBQUEsQ0FBQWtILG1CQUFBLGFBQUF2RSxDQUFBLFFBQUEzQyxDQUFBLHdCQUFBMkMsQ0FBQSxJQUFBQSxDQUFBLENBQUF3RSxXQUFBLFdBQUFuSCxDQUFBLEtBQUFBLENBQUEsS0FBQTBFLGlCQUFBLDZCQUFBMUUsQ0FBQSxDQUFBaUgsV0FBQSxJQUFBakgsQ0FBQSxDQUFBb0gsSUFBQSxPQUFBcEgsQ0FBQSxDQUFBcUgsSUFBQSxhQUFBMUUsQ0FBQSxXQUFBRSxNQUFBLENBQUF5RSxjQUFBLEdBQUF6RSxNQUFBLENBQUF5RSxjQUFBLENBQUEzRSxDQUFBLEVBQUFnQywwQkFBQSxLQUFBaEMsQ0FBQSxDQUFBNEUsU0FBQSxHQUFBNUMsMEJBQUEsRUFBQWpCLE1BQUEsQ0FBQWYsQ0FBQSxFQUFBYSxDQUFBLHlCQUFBYixDQUFBLENBQUFHLFNBQUEsR0FBQUQsTUFBQSxDQUFBbUIsTUFBQSxDQUFBaUIsQ0FBQSxHQUFBdEMsQ0FBQSxLQUFBM0MsQ0FBQSxDQUFBd0gsS0FBQSxhQUFBN0UsQ0FBQSxhQUFBNkMsT0FBQSxFQUFBN0MsQ0FBQSxPQUFBdUMscUJBQUEsQ0FBQUUsYUFBQSxDQUFBdEMsU0FBQSxHQUFBWSxNQUFBLENBQUEwQixhQUFBLENBQUF0QyxTQUFBLEVBQUFRLENBQUEsaUNBQUF0RCxDQUFBLENBQUFvRixhQUFBLEdBQUFBLGFBQUEsRUFBQXBGLENBQUEsQ0FBQXlILEtBQUEsYUFBQTlFLENBQUEsRUFBQUMsQ0FBQSxFQUFBakQsQ0FBQSxFQUFBcUQsQ0FBQSxFQUFBRSxDQUFBLGVBQUFBLENBQUEsS0FBQUEsQ0FBQSxHQUFBd0UsT0FBQSxPQUFBdEUsQ0FBQSxPQUFBZ0MsYUFBQSxDQUFBdEIsSUFBQSxDQUFBbkIsQ0FBQSxFQUFBQyxDQUFBLEVBQUFqRCxDQUFBLEVBQUFxRCxDQUFBLEdBQUFFLENBQUEsVUFBQWxELENBQUEsQ0FBQWtILG1CQUFBLENBQUF0RSxDQUFBLElBQUFRLENBQUEsR0FBQUEsQ0FBQSxDQUFBaUQsSUFBQSxHQUFBWixJQUFBLFdBQUE5QyxDQUFBLFdBQUFBLENBQUEsQ0FBQS9DLElBQUEsR0FBQStDLENBQUEsQ0FBQTlDLEtBQUEsR0FBQXVELENBQUEsQ0FBQWlELElBQUEsV0FBQW5CLHFCQUFBLENBQUFELENBQUEsR0FBQXZCLE1BQUEsQ0FBQXVCLENBQUEsRUFBQXpCLENBQUEsZ0JBQUFFLE1BQUEsQ0FBQXVCLENBQUEsRUFBQTdCLENBQUEsaUNBQUFNLE1BQUEsQ0FBQXVCLENBQUEsNkRBQUFqRixDQUFBLENBQUEySCxJQUFBLGFBQUFoRixDQUFBLFFBQUEzQyxDQUFBLEdBQUE2QyxNQUFBLENBQUFGLENBQUEsR0FBQUMsQ0FBQSxnQkFBQWpELENBQUEsSUFBQUssQ0FBQSxFQUFBNEMsQ0FBQSxDQUFBdEMsSUFBQSxDQUFBWCxDQUFBLFVBQUFpRCxDQUFBLENBQUFnRixPQUFBLGFBQUF2QixLQUFBLFdBQUF6RCxDQUFBLENBQUE1QixNQUFBLFNBQUEyQixDQUFBLEdBQUFDLENBQUEsQ0FBQWlGLEdBQUEsUUFBQWxGLENBQUEsSUFBQTNDLENBQUEsU0FBQXFHLElBQUEsQ0FBQXhHLEtBQUEsR0FBQThDLENBQUEsRUFBQTBELElBQUEsQ0FBQXpHLElBQUEsT0FBQXlHLElBQUEsV0FBQUEsSUFBQSxDQUFBekcsSUFBQSxPQUFBeUcsSUFBQSxRQUFBckcsQ0FBQSxDQUFBZ0YsTUFBQSxHQUFBQSxNQUFBLEVBQUFmLE9BQUEsQ0FBQW5CLFNBQUEsS0FBQXFFLFdBQUEsRUFBQWxELE9BQUEsRUFBQThDLEtBQUEsV0FBQUEsTUFBQS9HLENBQUEsYUFBQThILElBQUEsV0FBQXpCLElBQUEsV0FBQU4sSUFBQSxRQUFBQyxLQUFBLEdBQUFyRCxDQUFBLE9BQUEvQyxJQUFBLFlBQUFpRyxRQUFBLGNBQUFELE1BQUEsZ0JBQUF2QixHQUFBLEdBQUExQixDQUFBLE9BQUFpRSxVQUFBLENBQUF2SCxPQUFBLENBQUF3SCxhQUFBLElBQUE3RyxDQUFBLFdBQUE0QyxDQUFBLGtCQUFBQSxDQUFBLENBQUFtRixNQUFBLE9BQUFwSSxDQUFBLENBQUEyRSxJQUFBLE9BQUExQixDQUFBLE1BQUFvRSxLQUFBLEVBQUFwRSxDQUFBLENBQUFvRixLQUFBLGNBQUFwRixDQUFBLElBQUFELENBQUEsTUFBQXNGLElBQUEsV0FBQUEsS0FBQSxTQUFBckksSUFBQSxXQUFBK0MsQ0FBQSxRQUFBaUUsVUFBQSxJQUFBRSxVQUFBLGtCQUFBbkUsQ0FBQSxDQUFBeUIsSUFBQSxRQUFBekIsQ0FBQSxDQUFBMEIsR0FBQSxjQUFBNkQsSUFBQSxLQUFBakMsaUJBQUEsV0FBQUEsa0JBQUFqRyxDQUFBLGFBQUFKLElBQUEsUUFBQUksQ0FBQSxNQUFBNEMsQ0FBQSxrQkFBQXVGLE9BQUF4SSxDQUFBLEVBQUFxRCxDQUFBLFdBQUFJLENBQUEsQ0FBQWdCLElBQUEsWUFBQWhCLENBQUEsQ0FBQWlCLEdBQUEsR0FBQXJFLENBQUEsRUFBQTRDLENBQUEsQ0FBQXlELElBQUEsR0FBQTFHLENBQUEsRUFBQXFELENBQUEsS0FBQUosQ0FBQSxDQUFBZ0QsTUFBQSxXQUFBaEQsQ0FBQSxDQUFBeUIsR0FBQSxHQUFBMUIsQ0FBQSxLQUFBSyxDQUFBLGFBQUFBLENBQUEsUUFBQTRELFVBQUEsQ0FBQTVGLE1BQUEsTUFBQWdDLENBQUEsU0FBQUEsQ0FBQSxRQUFBRSxDQUFBLFFBQUEwRCxVQUFBLENBQUE1RCxDQUFBLEdBQUFJLENBQUEsR0FBQUYsQ0FBQSxDQUFBNEQsVUFBQSxpQkFBQTVELENBQUEsQ0FBQXNELE1BQUEsU0FBQTJCLE1BQUEsYUFBQWpGLENBQUEsQ0FBQXNELE1BQUEsU0FBQXNCLElBQUEsUUFBQXhFLENBQUEsR0FBQTNELENBQUEsQ0FBQTJFLElBQUEsQ0FBQXBCLENBQUEsZUFBQU0sQ0FBQSxHQUFBN0QsQ0FBQSxDQUFBMkUsSUFBQSxDQUFBcEIsQ0FBQSxxQkFBQUksQ0FBQSxJQUFBRSxDQUFBLGFBQUFzRSxJQUFBLEdBQUE1RSxDQUFBLENBQUF1RCxRQUFBLFNBQUEwQixNQUFBLENBQUFqRixDQUFBLENBQUF1RCxRQUFBLGdCQUFBcUIsSUFBQSxHQUFBNUUsQ0FBQSxDQUFBd0QsVUFBQSxTQUFBeUIsTUFBQSxDQUFBakYsQ0FBQSxDQUFBd0QsVUFBQSxjQUFBcEQsQ0FBQSxhQUFBd0UsSUFBQSxHQUFBNUUsQ0FBQSxDQUFBdUQsUUFBQSxTQUFBMEIsTUFBQSxDQUFBakYsQ0FBQSxDQUFBdUQsUUFBQSxxQkFBQWpELENBQUEsWUFBQW1DLEtBQUEscURBQUFtQyxJQUFBLEdBQUE1RSxDQUFBLENBQUF3RCxVQUFBLFNBQUF5QixNQUFBLENBQUFqRixDQUFBLENBQUF3RCxVQUFBLFlBQUFSLE1BQUEsV0FBQUEsT0FBQXZELENBQUEsRUFBQTNDLENBQUEsYUFBQTRDLENBQUEsUUFBQWdFLFVBQUEsQ0FBQTVGLE1BQUEsTUFBQTRCLENBQUEsU0FBQUEsQ0FBQSxRQUFBSSxDQUFBLFFBQUE0RCxVQUFBLENBQUFoRSxDQUFBLE9BQUFJLENBQUEsQ0FBQXdELE1BQUEsU0FBQXNCLElBQUEsSUFBQW5JLENBQUEsQ0FBQTJFLElBQUEsQ0FBQXRCLENBQUEsd0JBQUE4RSxJQUFBLEdBQUE5RSxDQUFBLENBQUEwRCxVQUFBLFFBQUF4RCxDQUFBLEdBQUFGLENBQUEsYUFBQUUsQ0FBQSxpQkFBQVAsQ0FBQSxtQkFBQUEsQ0FBQSxLQUFBTyxDQUFBLENBQUFzRCxNQUFBLElBQUF4RyxDQUFBLElBQUFBLENBQUEsSUFBQWtELENBQUEsQ0FBQXdELFVBQUEsS0FBQXhELENBQUEsY0FBQUUsQ0FBQSxHQUFBRixDQUFBLEdBQUFBLENBQUEsQ0FBQTRELFVBQUEsY0FBQTFELENBQUEsQ0FBQWdCLElBQUEsR0FBQXpCLENBQUEsRUFBQVMsQ0FBQSxDQUFBaUIsR0FBQSxHQUFBckUsQ0FBQSxFQUFBa0QsQ0FBQSxTQUFBMEMsTUFBQSxnQkFBQVMsSUFBQSxHQUFBbkQsQ0FBQSxDQUFBd0QsVUFBQSxFQUFBakMsQ0FBQSxTQUFBMkQsUUFBQSxDQUFBaEYsQ0FBQSxNQUFBZ0YsUUFBQSxXQUFBQSxTQUFBekYsQ0FBQSxFQUFBM0MsQ0FBQSxvQkFBQTJDLENBQUEsQ0FBQXlCLElBQUEsUUFBQXpCLENBQUEsQ0FBQTBCLEdBQUEscUJBQUExQixDQUFBLENBQUF5QixJQUFBLG1CQUFBekIsQ0FBQSxDQUFBeUIsSUFBQSxRQUFBaUMsSUFBQSxHQUFBMUQsQ0FBQSxDQUFBMEIsR0FBQSxnQkFBQTFCLENBQUEsQ0FBQXlCLElBQUEsU0FBQThELElBQUEsUUFBQTdELEdBQUEsR0FBQTFCLENBQUEsQ0FBQTBCLEdBQUEsT0FBQXVCLE1BQUEsa0JBQUFTLElBQUEseUJBQUExRCxDQUFBLENBQUF5QixJQUFBLElBQUFwRSxDQUFBLFVBQUFxRyxJQUFBLEdBQUFyRyxDQUFBLEdBQUF5RSxDQUFBLEtBQUE0RCxNQUFBLFdBQUFBLE9BQUExRixDQUFBLGFBQUEzQyxDQUFBLFFBQUE0RyxVQUFBLENBQUE1RixNQUFBLE1BQUFoQixDQUFBLFNBQUFBLENBQUEsUUFBQTRDLENBQUEsUUFBQWdFLFVBQUEsQ0FBQTVHLENBQUEsT0FBQTRDLENBQUEsQ0FBQThELFVBQUEsS0FBQS9ELENBQUEsY0FBQXlGLFFBQUEsQ0FBQXhGLENBQUEsQ0FBQWtFLFVBQUEsRUFBQWxFLENBQUEsQ0FBQStELFFBQUEsR0FBQUUsYUFBQSxDQUFBakUsQ0FBQSxHQUFBNkIsQ0FBQSx5QkFBQTZELE9BQUEzRixDQUFBLGFBQUEzQyxDQUFBLFFBQUE0RyxVQUFBLENBQUE1RixNQUFBLE1BQUFoQixDQUFBLFNBQUFBLENBQUEsUUFBQTRDLENBQUEsUUFBQWdFLFVBQUEsQ0FBQTVHLENBQUEsT0FBQTRDLENBQUEsQ0FBQTRELE1BQUEsS0FBQTdELENBQUEsUUFBQWhELENBQUEsR0FBQWlELENBQUEsQ0FBQWtFLFVBQUEsa0JBQUFuSCxDQUFBLENBQUF5RSxJQUFBLFFBQUFwQixDQUFBLEdBQUFyRCxDQUFBLENBQUEwRSxHQUFBLEVBQUF3QyxhQUFBLENBQUFqRSxDQUFBLFlBQUFJLENBQUEsZ0JBQUEyQyxLQUFBLDhCQUFBNEMsYUFBQSxXQUFBQSxjQUFBdkksQ0FBQSxFQUFBNEMsQ0FBQSxFQUFBakQsQ0FBQSxnQkFBQWtHLFFBQUEsS0FBQXhDLFFBQUEsRUFBQTJCLE1BQUEsQ0FBQWhGLENBQUEsR0FBQW9HLFVBQUEsRUFBQXhELENBQUEsRUFBQTBELE9BQUEsRUFBQTNHLENBQUEsb0JBQUFpRyxNQUFBLFVBQUF2QixHQUFBLEdBQUExQixDQUFBLEdBQUE4QixDQUFBLE9BQUF6RSxDQUFBO0FBQUEsU0FBQXdJLG1CQUFBQyxHQUFBLEVBQUFsRCxPQUFBLEVBQUFtRCxNQUFBLEVBQUFDLEtBQUEsRUFBQUMsTUFBQSxFQUFBeEgsR0FBQSxFQUFBaUQsR0FBQSxjQUFBd0UsSUFBQSxHQUFBSixHQUFBLENBQUFySCxHQUFBLEVBQUFpRCxHQUFBLE9BQUF4RSxLQUFBLEdBQUFnSixJQUFBLENBQUFoSixLQUFBLFdBQUFpSixLQUFBLElBQUFKLE1BQUEsQ0FBQUksS0FBQSxpQkFBQUQsSUFBQSxDQUFBakosSUFBQSxJQUFBMkYsT0FBQSxDQUFBMUYsS0FBQSxZQUFBNkgsT0FBQSxDQUFBbkMsT0FBQSxDQUFBMUYsS0FBQSxFQUFBNEYsSUFBQSxDQUFBa0QsS0FBQSxFQUFBQyxNQUFBO0FBQUEsU0FBQUcsa0JBQUFDLEVBQUEsNkJBQUFDLElBQUEsU0FBQUMsSUFBQSxHQUFBbkksU0FBQSxhQUFBMkcsT0FBQSxXQUFBbkMsT0FBQSxFQUFBbUQsTUFBQSxRQUFBRCxHQUFBLEdBQUFPLEVBQUEsQ0FBQUcsS0FBQSxDQUFBRixJQUFBLEVBQUFDLElBQUEsWUFBQVAsTUFBQTlJLEtBQUEsSUFBQTJJLGtCQUFBLENBQUFDLEdBQUEsRUFBQWxELE9BQUEsRUFBQW1ELE1BQUEsRUFBQUMsS0FBQSxFQUFBQyxNQUFBLFVBQUEvSSxLQUFBLGNBQUErSSxPQUFBN0ksR0FBQSxJQUFBeUksa0JBQUEsQ0FBQUMsR0FBQSxFQUFBbEQsT0FBQSxFQUFBbUQsTUFBQSxFQUFBQyxLQUFBLEVBQUFDLE1BQUEsV0FBQTdJLEdBQUEsS0FBQTRJLEtBQUEsQ0FBQTFILFNBQUE7QUFEK0M7O0FBRS9DO0FBQ0EsSUFBTW1JLHFCQUFxQixHQUFHLENBQUMzSyxRQUFRLENBQUNnQyxhQUFhLENBQUMsb0JBQW9CLENBQUMsRUFBRWhDLFFBQVEsQ0FBQ2dDLGFBQWEsQ0FBQyxzQkFBc0IsQ0FBQyxDQUFFO0FBQzdIO0FBQ0EsSUFBTTRJLGNBQWMsR0FBRyxDQUFDNUssUUFBUSxDQUFDaUMsZ0JBQWdCLENBQUMsbUJBQW1CLENBQUMsRUFBRWpDLFFBQVEsQ0FBQ2lDLGdCQUFnQixDQUFDLG9CQUFvQixDQUFDLENBQUM7QUFDeEg7QUFDQSxJQUFNNEksZUFBZSxHQUFHLENBQUMsSUFBSTNLLDhEQUFRLENBQUMsb0JBQW9CLEVBQUMsbUJBQW1CLENBQUMsRUFBRSxJQUFJQSw4REFBUSxDQUFDLHNCQUFzQixFQUFDLG9CQUFvQixDQUFDLENBQUM7QUFDM0k7QUFDQSxJQUFNNEssYUFBYSxHQUFHOUssUUFBUSxDQUFDQyxjQUFjLENBQUMsaUJBQWlCLENBQUM7QUFFaEUwSyxxQkFBcUIsQ0FBQy9KLE9BQU8sQ0FBQyxVQUFDQyxRQUFRLEVBQUVrSyxLQUFLLEVBQUc7RUFDN0MsSUFBR2xLLFFBQVEsRUFBQztJQUNSQSxRQUFRLENBQUNILGdCQUFnQixDQUFDLFFBQVEsRUFBRSxZQUFJO01BQ3hDbUssZUFBZSxDQUFDRSxLQUFLLENBQUMsQ0FBQzdJLE1BQU0sQ0FBQyxDQUFDO01BQy9CNEksYUFBYSxDQUFDRSxLQUFLLENBQUNDLE9BQU8sR0FBR0osZUFBZSxDQUFDRSxLQUFLLENBQUMsQ0FBQ0QsYUFBYSxDQUFDLENBQUM7SUFDcEUsQ0FBQyxDQUFDO0VBQ047QUFFSixDQUFDLENBQUM7QUFFRkYsY0FBYyxDQUFDaEssT0FBTyxDQUFDLFVBQUNQLFVBQVUsRUFBRTBLLEtBQUssRUFBSztFQUMxQyxJQUFHMUssVUFBVSxFQUFDO0lBQ1ZBLFVBQVUsQ0FBQ08sT0FBTyxDQUFDLFVBQUNDLFFBQVEsRUFBRztNQUMvQkEsUUFBUSxDQUFDSCxnQkFBZ0IsQ0FBQyxRQUFRLEVBQUUsWUFBTTtRQUN0Q21LLGVBQWUsQ0FBQ0UsS0FBSyxDQUFDLENBQUM3SSxNQUFNLENBQUMsQ0FBQztRQUMvQjRJLGFBQWEsQ0FBQ0UsS0FBSyxDQUFDQyxPQUFPLEdBQUdKLGVBQWUsQ0FBQ0UsS0FBSyxDQUFDLENBQUNELGFBQWEsQ0FBQyxDQUFDO01BQ3hFLENBQUMsQ0FBQztJQUNOLENBQUMsQ0FBQztFQUNGO0FBRUosQ0FBQyxDQUFDOztBQUVGO0FBQ0E7QUFDQTs7QUFFQSxJQUFNSSxhQUFhLEdBQUcsQ0FBQ2xMLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLGlCQUFpQixDQUFDLEVBQUVELFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLG1CQUFtQixDQUFDLENBQUM7QUFDaEgsSUFBTWtMLFlBQVksR0FBRyxDQUFDbkwsUUFBUSxDQUFDQyxjQUFjLENBQUMsY0FBYyxDQUFDLENBQUM7QUFDOUQsSUFBTW1MLG1CQUFtQixHQUFHLENBQUNwTCxRQUFRLENBQUNDLGNBQWMsQ0FBQyxlQUFlLENBQUMsQ0FBQztBQUN0RSxJQUFNb0wsb0JBQW9CLEdBQUcsQ0FBQ3JMLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLGdCQUFnQixDQUFDLENBQUM7QUFDeEUsSUFBTXFMLEtBQUssR0FBRyxDQUFDLGtCQUFrQixFQUFFLDJCQUEyQixDQUFDO0FBRS9ESixhQUFhLENBQUN0SyxPQUFPLENBQUMsVUFBQzJLLE1BQU0sRUFBRVIsS0FBSyxFQUFHO0VBQ25DLElBQUdRLE1BQU0sRUFBQztJQUNOQSxNQUFNLENBQUM3SyxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUMsWUFBSztNQUNqQ3lLLFlBQVksQ0FBQyxDQUFDLENBQUMsQ0FBQ3JJLFNBQVMsQ0FBQ2tCLE1BQU0sQ0FBQyxRQUFRLENBQUM7TUFFMUNvSCxtQkFBbUIsQ0FBQyxDQUFDLENBQUMsQ0FBQzFLLGdCQUFnQixDQUFDLE9BQU8sRUFBRSxZQUFNO1FBQy9DeUssWUFBWSxDQUFDLENBQUMsQ0FBQyxDQUFDckksU0FBUyxDQUFDQyxHQUFHLENBQUMsUUFBUSxDQUFDO01BQy9DLENBQUMsQ0FBQztNQUVGc0ksb0JBQW9CLENBQUMsQ0FBQyxDQUFDLENBQUMzSyxnQkFBZ0IsQ0FBQyxPQUFPLGVBQUE0SixpQkFBQSxlQUFBckcsbUJBQUEsR0FBQTJFLElBQUEsQ0FBRSxTQUFBNEMsUUFBQTtRQUFBLElBQUFDLElBQUE7UUFBQSxPQUFBeEgsbUJBQUEsR0FBQW9CLElBQUEsVUFBQXFHLFNBQUFDLFFBQUE7VUFBQSxrQkFBQUEsUUFBQSxDQUFBdEMsSUFBQSxHQUFBc0MsUUFBQSxDQUFBL0QsSUFBQTtZQUFBO2NBQ3BDNkQsSUFBSSxHQUFHWixlQUFlLENBQUNFLEtBQUssQ0FBQyxDQUFDYSxTQUFTLENBQUMsQ0FBQztjQUMvQ0MsT0FBTyxDQUFDQyxHQUFHLENBQUNMLElBQUksQ0FBQztjQUNqQkksT0FBTyxDQUFDQyxHQUFHLENBQUMsY0FBYyxDQUFDO2NBQzNCRCxPQUFPLENBQUNDLEdBQUcsQ0FBQ0MsSUFBSSxDQUFDQyxTQUFTLENBQUNQLElBQUksQ0FBQyxDQUFDO2NBQUNFLFFBQUEsQ0FBQS9ELElBQUE7Y0FBQSxPQUM1QnFFLEtBQUssQ0FBQ1gsS0FBSyxDQUFDUCxLQUFLLENBQUMsRUFBQztnQkFDckI1RCxNQUFNLEVBQUUsTUFBTTtnQkFDZCtFLE9BQU8sRUFBRTtrQkFDTCxjQUFjLEVBQUU7Z0JBQ3BCLENBQUM7Z0JBRURDLElBQUksRUFBRUosSUFBSSxDQUFDQyxTQUFTLENBQUNQLElBQUk7Y0FDN0IsQ0FBQyxDQUFDLENBQ0R6RSxJQUFJLENBQUMsVUFBQW9GLFFBQVEsRUFBSTtnQkFDZCxJQUFHQSxRQUFRLENBQUNDLEVBQUUsRUFBQztrQkFDWGhKLE1BQU0sQ0FBQ0UsUUFBUSxDQUFDK0ksTUFBTSxDQUFDLElBQUksQ0FBQztnQkFDaEMsQ0FBQyxNQUNHO2tCQUNBVCxPQUFPLENBQUN4QixLQUFLLENBQUMsK0JBQStCLENBQUM7Z0JBQ2xEO2NBQ0osQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFBQSxLQUFLLEVBQUc7Z0JBQ1h3QixPQUFPLENBQUN4QixLQUFLLENBQUMsNENBQTRDLEVBQUVBLEtBQUssQ0FBQztjQUN0RSxDQUFDLENBQUM7WUFBQTtjQUVGa0MsWUFBWSxDQUFDekosU0FBUyxDQUFDQyxHQUFHLENBQUMsUUFBUSxDQUFDO1lBQUM7WUFBQTtjQUFBLE9BQUE0SSxRQUFBLENBQUFuQyxJQUFBO1VBQUE7UUFBQSxHQUFBZ0MsT0FBQTtNQUFBLENBRTVDLEdBQUM7SUFDTixDQUFDLENBQUM7RUFDTjtBQUVKLENBQUMsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7QUNuRkYsU0FBU2dCLGNBQWNBLENBQUNDLFVBQVUsRUFBRTtFQUNoQ3JJLE1BQU0sQ0FBQzhFLElBQUksQ0FBQ3VELFVBQVUsQ0FBQyxDQUFDN0wsT0FBTyxDQUFDLFVBQUMrQixHQUFHLEVBQUs7SUFDckNVLE1BQU0sQ0FBQ1YsR0FBRyxDQUFDLEdBQUc4SixVQUFVLENBQUM5SixHQUFHLENBQUM7RUFDakMsQ0FBQyxDQUFDO0FBQ047Ozs7Ozs7Ozs7Ozs7OztBQ0owQzs7QUFFMUM7QUFDOEM7QUFDVjtBQUVwQytKLDBEQUFxQixDQUFDO0VBQ2xCbEosU0FBUyxFQUFUQSw0REFBUztFQUNUckIsSUFBSSxFQUFKQSx1REFBSUE7QUFDUixDQUFDLENBQUM7Ozs7Ozs7Ozs7O0FDVEYiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnQvQ2hlY2tib3guanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudC9MaW5rLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnQvTmF2VG9nZ2xlLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9oYW5kbGVDaGVja2JveC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGVscGVyL2dsb2JhbC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaW5kZXguanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuY3NzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGFzc2V0cy9hcHAuanNcbmltcG9ydCAndGFpbHdpbmRjc3MvYmFzZS5jc3MnO1xuaW1wb3J0ICd0YWlsd2luZGNzcy9jb21wb25lbnRzLmNzcyc7XG5pbXBvcnQgJ3RhaWx3aW5kY3NzL3V0aWxpdGllcy5jc3MnO1xuaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcbmltcG9ydCBSZWFjdERPTSBmcm9tICdyZWFjdC1kb20nO1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuaW1wb3J0ICcuL2pzL2luZGV4LmpzJztcbmltcG9ydCAnLi9qcy9oYW5kbGVDaGVja2JveC5qcyc7XG4vL2ltcG9ydCAnL2pzL2hhbmRsZU1vZGFsLmpzOydcblxuXG5jb25zdCBQYXltZW50c0xpc3QgPSAoKSA9PiB7XG4gIHJldHVybiAoXG4gICAgPGRpdj5cbiAgICAgIDxoMSBjbGFzc05hbWU9XCJ0ZXh0LTR4bCBmb250LWJvbGQgdGV4dC1jZW50ZXJcIj5QYXltZW50cyBMaXN0PC9oMT5cbiAgICA8L2Rpdj5cbiAgKTtcbn07XG5cblxuUmVhY3RET00ucmVuZGVyKDxQYXltZW50c0xpc3QgLz4sIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwYXltZW50cm9vdCcpKTtcblxuIiwiY2xhc3MgQ2hlY2tib3h7XG4gICAgY29uc3RydWN0b3IoY2hlY2tib3hGb3JBbGwsIGNoZWNrYm94ZXMpe1xuICAgICAgICB0aGlzLmNoZWNrYm94U2VsZWN0QWxsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihjaGVja2JveEZvckFsbCk7XG4gICAgICAgIHRoaXMuY2hlY2tib3hlcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoY2hlY2tib3hlcyk7XG4gICAgICAgIHRoaXMub25Jbml0KCk7XG4gICAgfVxuXG4gICAgb25Jbml0ID0oKT0+e1xuICAgICAgICBpZih0aGlzLmNoZWNrYm94U2VsZWN0QWxsKXtcbiAgICAgICAgICAgICB0aGlzLmNoZWNrYm94U2VsZWN0QWxsLmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHRoaXMuc2VsZWN0QWxsQ2hlY2tib3hlcyk7XG4gICAgICAgIH1cbiAgICAgICBpZih0aGlzLmNoZWNrYm94ZXMpe1xuICAgICAgICAgICAgdGhpcy5jaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHRoaXMuc2VsZWN0QWxsQ2hlY2tib3hlcyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICB9XG4gICAgICAgIFxuXG4gICAgfVxuXG4gICAgZGlzYWJsZUJ1dHRvbiA9KCk9PntcbiAgICAgICAgZm9yKGxldCBjaGVja2JveCBvZiB0aGlzLmNoZWNrYm94ZXMpe1xuICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwiYmxvY2tcIjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gXCJub25lXCI7XG4gICAgXG4gICAgfVxuXG4gICAgc2VsZWN0QWxsQ2hlY2tib3hlcyA9KCk9PntcbiAgICAgICAgY29uc3QgY2xpY2tlZENoZWNrQm94ID0gZXZlbnQudGFyZ2V0O1xuXG4gICAgICAgIGlmKGNsaWNrZWRDaGVja0JveCA9PSB0aGlzLmNoZWNrYm94U2VsZWN0QWxsICYmIGNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgICAgIGlmKCFjaGVja2JveC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICAgICAgY2hlY2tib3guY2hlY2tlZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICAgICAgZWxzZSBpZihjbGlja2VkQ2hlY2tCb3ggPT0gdGhpcy5jaGVja2JveFNlbGVjdEFsbCAmJiAhY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgdGhpcy5jaGVja2JveGVzLmZvckVhY2goKGNoZWNrYm94KSA9PiB7XG4gICAgICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgICAgIGNoZWNrYm94LmNoZWNrZWQgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgICAgICBlbHNlIGlmKGNsaWNrZWRDaGVja0JveCAhPSB0aGlzLmNoZWNrYm94U2VsZWN0QWxsICYmICFjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgICAgICBpZih0aGlzLmNoZWNrYm94U2VsZWN0QWxsLmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgIHRoaXMuY2hlY2tib3hTZWxlY3RBbGwuY2hlY2tlZCA9IGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgXG4gICAgfVxuXG4gICAgZ2V0bGlzdElEID0oKT0+e1xuICAgICAgICBsZXQgbGlzdElEID0gW107XG4gICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgbGlzdElELnB1c2gocGFyc2VJbnQoY2hlY2tib3guZ2V0QXR0cmlidXRlKCduYW1lJykpKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgcmV0dXJuIGxpc3RJRDtcbiAgICB9XG5cbn1cblxuZXhwb3J0IGRlZmF1bHQgQ2hlY2tib3g7IiwiY2xhc3MgTGluayB7XG4gICAgY29uc3RydWN0b3Ioc2VsZWN0b3IsIG5ld1RhYiA9IGZhbHNlKSB7XG4gICAgICAgIHRoaXMubGluayA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3IpO1xuICAgICAgICB0aGlzLm5ld1RhYiA9IG5ld1RhYjtcbiAgICAgICAgdGhpcy5pbml0KCk7XG4gICAgfVxuXG4gICAgaW5pdCgpIHtcbiAgICAgICAgdGhpcy5pbml0Q2xhc3NlcygpO1xuICAgICAgICB0aGlzLmF0dGFjaEV2ZW50KCk7XG4gICAgfVxuXG4gICAgaW5pdENsYXNzZXMoKSB7XG4gICAgICAgIHRoaXMubGluay5mb3JFYWNoKGxpbmsgPT4ge1xuICAgICAgICAgICAgbGluay5jbGFzc0xpc3QuYWRkKCdjdXJzb3ItcG9pbnRlcicpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhdHRhY2hFdmVudCgpIHtcbiAgICAgICAgdGhpcy5saW5rLmZvckVhY2gobGluayA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0Lm5vZGVOYW1lID09PSAnVFInIHx8IGUudGFyZ2V0Lm5vZGVOYW1lID09PSAnVEQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMub3BlbkxpbmsobGluayk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIG9wZW5MaW5rKGUpIHtcbiAgICAgICAgY29uc3QgdXJsID0gZS5kYXRhc2V0LmhyZWY7XG4gICAgICAgIGlmICh0aGlzLm5ld1RhYikge1xuICAgICAgICAgICAgcmV0dXJuIHdpbmRvdy5vcGVuKHVybCwgJ19ibGFuaycpO1xuICAgICAgICB9XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9IHVybDtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IExpbms7IiwiY2xhc3MgTmF2VG9nZ2xlIHtcbiAgICBjb25zdHJ1Y3Rvcih0b2dnbGVTZWxlY3RvciwgbmF2U2VsZWN0b3IpIHtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHRvZ2dsZVNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKG5hdlNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB0aGlzLnRvZ2dsZSgpKTtcbiAgICB9XG5cbiAgICB0b2dnbGUoKSB7XG4gICAgICAgIGNvbnN0IGlzT3BlbiA9IHRoaXMubmF2LmdldEF0dHJpYnV0ZSgnZGF0YS1vcGVuJykgPT09ICd0cnVlJztcbiAgICAgICAgdGhpcy5uYXYuc2V0QXR0cmlidXRlKCdkYXRhLW9wZW4nLCAhaXNPcGVuKTtcbiAgICAgICAgaWYgKGlzT3Blbikge1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LnJlbW92ZSgnbWwtMCcpO1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LmFkZCgnbWwtWy0xOHJlbV0nKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5hZGQoJ21sLTAnKTtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5yZW1vdmUoJ21sLVstMThyZW1dJyk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IE5hdlRvZ2dsZTsiLCJpbXBvcnQgQ2hlY2tib3ggZnJvbSAnLi9jb21wb25lbnQvQ2hlY2tib3guanMnO1xuXG4vL29uIHLDqWN1cMOocmUgbGEgY2FzZSBwZXJtZXR0YW50IGRlIGNvY2hlciB0b3V0ZXMgbGVzIGF1dHJlcyBjYXNlcyBldCBvbiBsZSBtZXQgZGFucyBsZSB0YWJsZWF1XG5jb25zdCBjaGVja2JveFNlbGVjdEFsbExpc3QgPSBbZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnByb2R1Y3RzLWNoZWNrYm94JyksIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jYXRlZ29yaWVzLWNoZWNrYm94JykgXTtcbi8vb24gcsOpY3Vww6hyZSBsZXMgY2FzZXMgw6AgY29jaGVyIChsaWVyIGEgdW4gZWxlbWVudCkgZXQgb24gbGUgbWV0IGRhbnMgbGUgdGFibGVhdVxuY29uc3QgY2hlY2tib3hlc0xpc3QgPSBbZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnByb2R1Y3QtY2hlY2tib3gnKSwgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmNhdGVnb3J5LWNoZWNrYm94JyldO1xuLy9vbiBjcsOpZSB1biBvYmpldCBDaGVja2JveFxuY29uc3QgY2hlY2tib3hPYmplY3RzID0gW25ldyBDaGVja2JveCgnLnByb2R1Y3RzLWNoZWNrYm94JywnLnByb2R1Y3QtY2hlY2tib3gnKSwgbmV3IENoZWNrYm94KCcuY2F0ZWdvcmllcy1jaGVja2JveCcsJy5jYXRlZ29yeS1jaGVja2JveCcpXTtcbi8vSUQgZGVzIGJvdXRvbnMgw6AgZMOpc2FjdGl2ZXIvYWN0aXZlclxuY29uc3QgZGlzYWJsZUJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXNhYmxlX2J1dHRvbnMnKTtcblxuY2hlY2tib3hTZWxlY3RBbGxMaXN0LmZvckVhY2goKGNoZWNrYm94LCBpbmRleCk9PntcbiAgICBpZihjaGVja2JveCl7XG4gICAgICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsICgpPT57XG4gICAgICAgIGNoZWNrYm94T2JqZWN0c1tpbmRleF0ub25Jbml0KCk7XG4gICAgICAgIGRpc2FibGVCdXR0b24uc3R5bGUuZGlzcGxheSA9IGNoZWNrYm94T2JqZWN0c1tpbmRleF0uZGlzYWJsZUJ1dHRvbigpO1xuICAgICAgICB9KTtcbiAgICB9XG4gICAgXG59KVxuXG5jaGVja2JveGVzTGlzdC5mb3JFYWNoKChjaGVja2JveGVzLCBpbmRleCkgPT4ge1xuICAgIGlmKGNoZWNrYm94ZXMpe1xuICAgICAgICBjaGVja2JveGVzLmZvckVhY2goKGNoZWNrYm94KT0+e1xuICAgICAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCAoKSA9PiB7XG4gICAgICAgICAgICBjaGVja2JveE9iamVjdHNbaW5kZXhdLm9uSW5pdCgpO1xuICAgICAgICAgICAgZGlzYWJsZUJ1dHRvbi5zdHlsZS5kaXNwbGF5ID0gY2hlY2tib3hPYmplY3RzW2luZGV4XS5kaXNhYmxlQnV0dG9uKCk7XG4gICAgICAgIH0pO1xuICAgIH0pXG4gICAgfVxuICAgIFxufSlcblxuLyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqICovXG4vKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKipERUxFVEUgQUNUSU9OUyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiogKi9cbi8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiAqL1xuXG5jb25zdCBkZWxldGVCdXR0b25zID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkZWxldGVfcHJvZHVjdHMnKSwgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlbGV0ZV9jYXRlZ29yaWVzJyldO1xuY29uc3QgZGVsZXRlTW9kYWxzID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtb2RhbF9kZWxldGUnKV07XG5jb25zdCBjYW5jZWxEZWxldGVCdXR0b25zID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjYW5jZWxfZGVsZXRlJyldO1xuY29uc3QgY29uZmlybURlbGV0ZUJ1dHRvbnMgPSBbZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbmZpcm1fZGVsZXRlJyldO1xuY29uc3Qgcm91dGUgPSBbJy9wcm9kdWN0cy9kZWxldGUnLCAnL3Byb2R1Y3RzL2NhdGVnb3J5L2RlbGV0ZSddXG5cbmRlbGV0ZUJ1dHRvbnMuZm9yRWFjaCgoYnV0dG9uLCBpbmRleCk9PntcbiAgICBpZihidXR0b24pe1xuICAgICAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCgpID0+e1xuICAgICAgICAgICAgZGVsZXRlTW9kYWxzWzBdLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xuICAgICAgICAgICAgXG4gICAgICAgICAgICBjYW5jZWxEZWxldGVCdXR0b25zWzBdLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBkZWxldGVNb2RhbHNbMF0uY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG4gICAgICAgICAgICB9KTtcbiAgICBcbiAgICAgICAgICAgIGNvbmZpcm1EZWxldGVCdXR0b25zWzBdLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgYXN5bmMgKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBjb25zdCBsaXN0ID0gY2hlY2tib3hPYmplY3RzW2luZGV4XS5nZXRsaXN0SUQoKTtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2cobGlzdCk7XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKCdsaXN0IGVuIGpzb24nKTtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coSlNPTi5zdHJpbmdpZnkobGlzdCkpO1xuICAgICAgICAgICAgICAgICAgICBhd2FpdCBmZXRjaChyb3V0ZVtpbmRleF0se1xuICAgICAgICAgICAgICAgICAgICAgICAgbWV0aG9kOiAnUE9TVCcsXG4gICAgICAgICAgICAgICAgICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KGxpc3QpXG4gICAgICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAgICAgICAgIC50aGVuKHJlc3BvbnNlID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKHJlc3BvbnNlLm9rKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24ucmVsb2FkKHRydWUpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgZWxzZXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgbG9ycyBkZSBsYSBzdXBwcmVzaW9uLicpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICAuY2F0Y2goZXJyb3IgPT57XG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgbG9ycyBkZSBsYSByZXF1w6p0ZSBkZSBzdXBwcmVzaW9uIDogJywgZXJyb3IpO1xuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgbW9kYWxfZGVsZXRlLmNsYXNzTGlzdC5hZGQoJ2hpZGRlbicpO1xuICAgIFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cbiAgICBcbn0pIiwiZnVuY3Rpb24gYXR0YWNoVG9XaW5kb3coY29tcG9uZW50cykge1xuICAgIE9iamVjdC5rZXlzKGNvbXBvbmVudHMpLmZvckVhY2goKGtleSkgPT4ge1xuICAgICAgICB3aW5kb3dba2V5XSA9IGNvbXBvbmVudHNba2V5XTtcbiAgICB9KTtcbn1cblxuZXhwb3J0IHsgXG4gICAgYXR0YWNoVG9XaW5kb3csXG59OyIsImltcG9ydCAqIGFzIGhlbHBlciBmcm9tIFwiLi9oZWxwZXIvZ2xvYmFsXCI7XG5cbi8vIEltcG9ydCBhbGwgYXZhaWxhYmxlIGNvbXBvbmVudHNcbmltcG9ydCBOYXZUb2dnbGUgZnJvbSBcIi4vY29tcG9uZW50L05hdlRvZ2dsZVwiO1xuaW1wb3J0IExpbmsgZnJvbSBcIi4vY29tcG9uZW50L0xpbmtcIjtcblxuaGVscGVyLmF0dGFjaFRvV2luZG93KHtcbiAgICBOYXZUb2dnbGUsXG4gICAgTGluayxcbn0pOyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJSZWFjdCIsIlJlYWN0RE9NIiwiUGF5bWVudHNMaXN0IiwiY3JlYXRlRWxlbWVudCIsImNsYXNzTmFtZSIsInJlbmRlciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJDaGVja2JveCIsIl9jcmVhdGVDbGFzcyIsImNoZWNrYm94Rm9yQWxsIiwiY2hlY2tib3hlcyIsIl90aGlzIiwiX2NsYXNzQ2FsbENoZWNrIiwiX2RlZmluZVByb3BlcnR5IiwiY2hlY2tib3hTZWxlY3RBbGwiLCJhZGRFdmVudExpc3RlbmVyIiwic2VsZWN0QWxsQ2hlY2tib3hlcyIsImZvckVhY2giLCJjaGVja2JveCIsIl9pdGVyYXRvciIsIl9jcmVhdGVGb3JPZkl0ZXJhdG9ySGVscGVyIiwiX3N0ZXAiLCJzIiwibiIsImRvbmUiLCJ2YWx1ZSIsImNoZWNrZWQiLCJlcnIiLCJlIiwiZiIsImNsaWNrZWRDaGVja0JveCIsImV2ZW50IiwidGFyZ2V0IiwibGlzdElEIiwicHVzaCIsInBhcnNlSW50IiwiZ2V0QXR0cmlidXRlIiwicXVlcnlTZWxlY3RvciIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJvbkluaXQiLCJMaW5rIiwic2VsZWN0b3IiLCJuZXdUYWIiLCJhcmd1bWVudHMiLCJsZW5ndGgiLCJ1bmRlZmluZWQiLCJsaW5rIiwiaW5pdCIsImtleSIsImluaXRDbGFzc2VzIiwiYXR0YWNoRXZlbnQiLCJjbGFzc0xpc3QiLCJhZGQiLCJub2RlTmFtZSIsIm9wZW5MaW5rIiwidXJsIiwiZGF0YXNldCIsImhyZWYiLCJ3aW5kb3ciLCJvcGVuIiwibG9jYXRpb24iLCJOYXZUb2dnbGUiLCJ0b2dnbGVTZWxlY3RvciIsIm5hdlNlbGVjdG9yIiwibmF2VG9nZ2xlIiwibmF2IiwidG9nZ2xlIiwiaXNPcGVuIiwic2V0QXR0cmlidXRlIiwicmVtb3ZlIiwiX3JlZ2VuZXJhdG9yUnVudGltZSIsInQiLCJyIiwiT2JqZWN0IiwicHJvdG90eXBlIiwiaGFzT3duUHJvcGVydHkiLCJvIiwiZGVmaW5lUHJvcGVydHkiLCJpIiwiU3ltYm9sIiwiYSIsIml0ZXJhdG9yIiwiYyIsImFzeW5jSXRlcmF0b3IiLCJ1IiwidG9TdHJpbmdUYWciLCJkZWZpbmUiLCJlbnVtZXJhYmxlIiwiY29uZmlndXJhYmxlIiwid3JpdGFibGUiLCJ3cmFwIiwiR2VuZXJhdG9yIiwiY3JlYXRlIiwiQ29udGV4dCIsIm1ha2VJbnZva2VNZXRob2QiLCJ0cnlDYXRjaCIsInR5cGUiLCJhcmciLCJjYWxsIiwiaCIsImwiLCJ5IiwiR2VuZXJhdG9yRnVuY3Rpb24iLCJHZW5lcmF0b3JGdW5jdGlvblByb3RvdHlwZSIsInAiLCJkIiwiZ2V0UHJvdG90eXBlT2YiLCJ2IiwidmFsdWVzIiwiZyIsImRlZmluZUl0ZXJhdG9yTWV0aG9kcyIsIl9pbnZva2UiLCJBc3luY0l0ZXJhdG9yIiwiaW52b2tlIiwiX3R5cGVvZiIsInJlc29sdmUiLCJfX2F3YWl0IiwidGhlbiIsImNhbGxJbnZva2VXaXRoTWV0aG9kQW5kQXJnIiwiRXJyb3IiLCJtZXRob2QiLCJkZWxlZ2F0ZSIsIm1heWJlSW52b2tlRGVsZWdhdGUiLCJzZW50IiwiX3NlbnQiLCJkaXNwYXRjaEV4Y2VwdGlvbiIsImFicnVwdCIsIlR5cGVFcnJvciIsInJlc3VsdE5hbWUiLCJuZXh0IiwibmV4dExvYyIsInB1c2hUcnlFbnRyeSIsInRyeUxvYyIsImNhdGNoTG9jIiwiZmluYWxseUxvYyIsImFmdGVyTG9jIiwidHJ5RW50cmllcyIsInJlc2V0VHJ5RW50cnkiLCJjb21wbGV0aW9uIiwicmVzZXQiLCJpc05hTiIsImRpc3BsYXlOYW1lIiwiaXNHZW5lcmF0b3JGdW5jdGlvbiIsImNvbnN0cnVjdG9yIiwibmFtZSIsIm1hcmsiLCJzZXRQcm90b3R5cGVPZiIsIl9fcHJvdG9fXyIsImF3cmFwIiwiYXN5bmMiLCJQcm9taXNlIiwia2V5cyIsInJldmVyc2UiLCJwb3AiLCJwcmV2IiwiY2hhckF0Iiwic2xpY2UiLCJzdG9wIiwicnZhbCIsImhhbmRsZSIsImNvbXBsZXRlIiwiZmluaXNoIiwiX2NhdGNoIiwiZGVsZWdhdGVZaWVsZCIsImFzeW5jR2VuZXJhdG9yU3RlcCIsImdlbiIsInJlamVjdCIsIl9uZXh0IiwiX3Rocm93IiwiaW5mbyIsImVycm9yIiwiX2FzeW5jVG9HZW5lcmF0b3IiLCJmbiIsInNlbGYiLCJhcmdzIiwiYXBwbHkiLCJjaGVja2JveFNlbGVjdEFsbExpc3QiLCJjaGVja2JveGVzTGlzdCIsImNoZWNrYm94T2JqZWN0cyIsImRpc2FibGVCdXR0b24iLCJpbmRleCIsInN0eWxlIiwiZGlzcGxheSIsImRlbGV0ZUJ1dHRvbnMiLCJkZWxldGVNb2RhbHMiLCJjYW5jZWxEZWxldGVCdXR0b25zIiwiY29uZmlybURlbGV0ZUJ1dHRvbnMiLCJyb3V0ZSIsImJ1dHRvbiIsIl9jYWxsZWUiLCJsaXN0IiwiX2NhbGxlZSQiLCJfY29udGV4dCIsImdldGxpc3RJRCIsImNvbnNvbGUiLCJsb2ciLCJKU09OIiwic3RyaW5naWZ5IiwiZmV0Y2giLCJoZWFkZXJzIiwiYm9keSIsInJlc3BvbnNlIiwib2siLCJyZWxvYWQiLCJtb2RhbF9kZWxldGUiLCJhdHRhY2hUb1dpbmRvdyIsImNvbXBvbmVudHMiLCJoZWxwZXIiXSwic291cmNlUm9vdCI6IiJ9