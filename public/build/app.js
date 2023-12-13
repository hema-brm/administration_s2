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
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/*const productCheckboxes = document.querySelectorAll('.product-checkbox');
const checkboxForAllProducts = document.querySelector('.products-checkbox');

const deleteButton = document.getElementById('delete');
const modal_delete = document.getElementById('modal_delete');
const cancelDeleteButton = document.getElementById('cancelDelete');
const confirmDeleteButton = document.getElementById('confirmDelete');
//coche ou decoche les checkbox en fonction de la checkbox qui selectionne tout
*/
var Checkbox = /*#__PURE__*/_createClass(function Checkbox(checkboxForAll, checkboxes) {
  var _this = this;
  _classCallCheck(this, Checkbox);
  _defineProperty(this, "onInit", function () {
    _this.checkboxSelectAll.addEventListener('change', _this.selectAllCheckBoxes);
    _this.checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', _this.selectAllCheckBoxes);
    });
  });
  _defineProperty(this, "selectAllCheckBoxes", function () {
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
  _defineProperty(this, "getProductsID", function () {
    var productsID = [];
    _this.checkboxes.forEach(function (checkbox) {
      if (checkbox.checked) {
        productsID.push(parseInt(checkbox.getAttribute('name')));
        console.log(_typeof(parseInt(checkbox.getAttribute('name'))));
      }
    });
    return productsID;
  });
  this.checkboxSelectAll = document.querySelector(checkboxForAll);
  this.checkboxes = document.querySelectorAll(checkboxes);
  this.onInit();
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Checkbox);

/*
function selectAllCheckBoxes(){
    const clickedCheckBox = event.target;

    if(clickedCheckBox == checkboxForAllProducts){
        
        if(clickedCheckBox.checked){
            //active le bouton supprimer

            productCheckboxes.forEach(checkbox => {
                if(!checkbox.checked){
                    checkbox.checked = true;
                }
            });

        }
        else{

            productCheckboxes.forEach(checkbox => {
                if(checkbox.checked){
                    checkbox.checked = false;
                }
            });
        }
    }
    else{
        if(!clickedCheckBox.checked && checkboxForAllProducts.checked){
            checkboxForAllProducts.checked = false;
        }
    }
    checkDeleteButtonState(clickedCheckBox);

}

function checkDeleteButtonState(clickedCheckBox){
    if(clickedCheckBox.checked){
        deleteButton.disabled = false;
    }
    else if (!clickedCheckBox.checked){
        let cmpt = 0;
        productCheckboxes.forEach(checkbox => {
            if(!checkbox.checked){
                cmpt++;
            }
            if(cmpt === productCheckboxes.length){
                deleteButton.disabled = true;
            }
            else{
                deleteButton.disabled = false;
            }
        }
    )}
      
}

//Mettre dans une liste l'id des produits qui ont ete selectionnes
function getCheckBoxProductID(){
    let productsID = [];

        productCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                productsID.push(checkbox.productId);
            }
        });
        return productsID;
}
// Afficher la modale
deleteButton.addEventListener('click', () => {
    modal_delete.classList.remove('hidden');
});

cancelDeleteButton.addEventListener('click', () => {
    modal_delete.classList.add('hidden');
});


confirmDeleteButton.addEventListener('click', () => {
    const productsID = getCheckBoxProductID();
    fetch('/delete',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({productsID})
    })

    modal_delete.classList.add('hidden');
});

checkboxForAllProducts.addEventListener('change', selectAllCheckBoxes);

productCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', selectAllCheckBoxes);
});

*/

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
var checkboxSelectAllList = [document.querySelector('.products-checkbox')];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
var checkboxesList = [document.querySelectorAll('.product-checkbox')];
//on crée un objet Checkbox
var checkboxObjects = [new _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__["default"]('.products-checkbox', '.product-checkbox')];
checkboxSelectAllList.forEach(function (checkbox, index) {
  checkbox.addEventListener('change', checkboxObjects[index].onInit());
});
checkboxesList.forEach(function (checkboxes, index) {
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('click', function () {
      checkboxObjects[index].onInit();
      checkboxObjects[index].getProductsID();
    });
  });
});

/***************************************************************************** */
/********************************DELETE ACTIONS******************************* */
/***************************************************************************** */

var deleteButtons = [document.getElementById('delete')];
var deleteModals = [document.getElementById('modal_delete')];
var cancelDeleteButtons = [document.getElementById('cancel_delete')];
var confirmDeleteButtons = [document.getElementById('confirm_delete')];
deleteButtons.forEach(function (button, index) {
  button.addEventListener('click', function () {
    deleteModals[index].classList.remove('hidden');
    cancelDeleteButtons[index].addEventListener('click', function () {
      deleteModals[index].classList.add('hidden');
    });
    confirmDeleteButtons[index].addEventListener('click', /*#__PURE__*/_asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
      var list;
      return _regeneratorRuntime().wrap(function _callee$(_context) {
        while (1) switch (_context.prev = _context.next) {
          case 0:
            list = checkboxObjects[index].getProductsID();
            console.log(list);
            _context.next = 4;
            return fetch('/products/delete', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify(list)
            }).then(function (response) {
              if (response.ok) {
                window.location.reload(true);
              } else {
                console.error('Erreur lors de la suppresion des produits.');
              }
            })["catch"](function (error) {
              console.error('Erreur lors de la requête de suppresion : ', error);
            });
          case 4:
            modal_delete.classList.add('hidden');
          case 5:
          case "end":
            return _context.stop();
        }
      }, _callee);
    })));
  });
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUM4QjtBQUNNO0FBQ0Q7QUFDVDtBQUNPOztBQUVqQztBQUMwQjtBQUNIO0FBQ1M7QUFDaEM7O0FBR0EsSUFBTUUsWUFBWSxHQUFHLFNBQWZBLFlBQVlBLENBQUEsRUFBUztFQUN6QixvQkFDRUYsMERBQUEsMkJBQ0VBLDBEQUFBO0lBQUlJLFNBQVMsRUFBQztFQUFnQyxHQUFDLGVBQWlCLENBQzdELENBQUM7QUFFVixDQUFDO0FBR0RILDZDQUFlLGVBQUNELDBEQUFBLENBQUNFLFlBQVksTUFBRSxDQUFDLEVBQUVJLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLGFBQWEsQ0FBQyxDQUFDOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7QUN2QnpFO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQVJBLElBU01DLFFBQVEsZ0JBQUFDLFlBQUEsQ0FDVixTQUFBRCxTQUFZRSxjQUFjLEVBQUVDLFVBQVUsRUFBQztFQUFBLElBQUFDLEtBQUE7RUFBQUMsZUFBQSxPQUFBTCxRQUFBO0VBQUFNLGVBQUEsaUJBTS9CLFlBQUk7SUFDUkYsS0FBSSxDQUFDRyxpQkFBaUIsQ0FBQ0MsZ0JBQWdCLENBQUMsUUFBUSxFQUFFSixLQUFJLENBQUNLLG1CQUFtQixDQUFDO0lBRTNFTCxLQUFJLENBQUNELFVBQVUsQ0FBQ08sT0FBTyxDQUFDLFVBQUFDLFFBQVEsRUFBSTtNQUNoQ0EsUUFBUSxDQUFDSCxnQkFBZ0IsQ0FBQyxRQUFRLEVBQUVKLEtBQUksQ0FBQ0ssbUJBQW1CLENBQUM7SUFDakUsQ0FBQyxDQUFDO0VBRU4sQ0FBQztFQUFBSCxlQUFBLDhCQUVvQixZQUFJO0lBQ3JCLElBQU1NLGVBQWUsR0FBR0MsS0FBSyxDQUFDQyxNQUFNO0lBRXBDLElBQUdGLGVBQWUsSUFBSVIsS0FBSSxDQUFDRyxpQkFBaUIsSUFBSUssZUFBZSxDQUFDRyxPQUFPLEVBQUM7TUFDcEVYLEtBQUksQ0FBQ0QsVUFBVSxDQUFDTyxPQUFPLENBQUMsVUFBQ0MsUUFBUSxFQUFLO1FBQ2xDLElBQUcsQ0FBQ0EsUUFBUSxDQUFDSSxPQUFPLEVBQUM7VUFDakJKLFFBQVEsQ0FBQ0ksT0FBTyxHQUFHLElBQUk7UUFDM0I7TUFDSixDQUFDLENBQUM7SUFDTixDQUFDLE1BQ0ksSUFBR0gsZUFBZSxJQUFJUixLQUFJLENBQUNHLGlCQUFpQixJQUFJLENBQUNLLGVBQWUsQ0FBQ0csT0FBTyxFQUFDO01BQzFFWCxLQUFJLENBQUNELFVBQVUsQ0FBQ08sT0FBTyxDQUFDLFVBQUNDLFFBQVEsRUFBSztRQUNsQyxJQUFHQSxRQUFRLENBQUNJLE9BQU8sRUFBQztVQUNoQkosUUFBUSxDQUFDSSxPQUFPLEdBQUcsS0FBSztRQUM1QjtNQUNKLENBQUMsQ0FBQztJQUNOLENBQUMsTUFDSSxJQUFHSCxlQUFlLElBQUlSLEtBQUksQ0FBQ0csaUJBQWlCLElBQUksQ0FBQ0ssZUFBZSxDQUFDRyxPQUFPLEVBQUM7TUFDMUUsSUFBR1gsS0FBSSxDQUFDRyxpQkFBaUIsQ0FBQ1EsT0FBTyxFQUFDO1FBQzlCWCxLQUFJLENBQUNHLGlCQUFpQixDQUFDUSxPQUFPLEdBQUcsS0FBSztNQUMxQztJQUNKO0VBRUosQ0FBQztFQUFBVCxlQUFBLHdCQUVjLFlBQUk7SUFDZixJQUFJVSxVQUFVLEdBQUcsRUFBRTtJQUNuQlosS0FBSSxDQUFDRCxVQUFVLENBQUNPLE9BQU8sQ0FBQyxVQUFDQyxRQUFRLEVBQUs7TUFDbEMsSUFBR0EsUUFBUSxDQUFDSSxPQUFPLEVBQUM7UUFDZkMsVUFBVSxDQUFDQyxJQUFJLENBQUNDLFFBQVEsQ0FBQ1AsUUFBUSxDQUFDUSxZQUFZLENBQUMsTUFBTSxDQUFDLENBQUMsQ0FBQztRQUN4REMsT0FBTyxDQUFDQyxHQUFHLENBQUFDLE9BQUEsQ0FBUUosUUFBUSxDQUFDUCxRQUFRLENBQUNRLFlBQVksQ0FBQyxNQUFNLENBQUMsQ0FBQyxFQUFDO01BQ2hFO0lBQ0osQ0FBQyxDQUFDO0lBRUYsT0FBT0gsVUFBVTtFQUNyQixDQUFDO0VBakRHLElBQUksQ0FBQ1QsaUJBQWlCLEdBQUdULFFBQVEsQ0FBQ3lCLGFBQWEsQ0FBQ3JCLGNBQWMsQ0FBQztFQUMvRCxJQUFJLENBQUNDLFVBQVUsR0FBR0wsUUFBUSxDQUFDMEIsZ0JBQWdCLENBQUNyQixVQUFVLENBQUM7RUFDdkQsSUFBSSxDQUFDc0IsTUFBTSxDQUFDLENBQUM7QUFDakIsQ0FBQztBQWtETCxpRUFBZXpCLFFBQVEsRUFBQzs7QUFFeEI7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7O0lDbEtNMEIsSUFBSTtFQUNOLFNBQUFBLEtBQVlDLFFBQVEsRUFBa0I7SUFBQSxJQUFoQkMsTUFBTSxHQUFBQyxTQUFBLENBQUFDLE1BQUEsUUFBQUQsU0FBQSxRQUFBRSxTQUFBLEdBQUFGLFNBQUEsTUFBRyxLQUFLO0lBQUF4QixlQUFBLE9BQUFxQixJQUFBO0lBQ2hDLElBQUksQ0FBQ00sSUFBSSxHQUFHbEMsUUFBUSxDQUFDMEIsZ0JBQWdCLENBQUNHLFFBQVEsQ0FBQztJQUMvQyxJQUFJLENBQUNDLE1BQU0sR0FBR0EsTUFBTTtJQUNwQixJQUFJLENBQUNLLElBQUksQ0FBQyxDQUFDO0VBQ2Y7RUFBQ2hDLFlBQUEsQ0FBQXlCLElBQUE7SUFBQVEsR0FBQTtJQUFBQyxLQUFBLEVBRUQsU0FBQUYsS0FBQSxFQUFPO01BQ0gsSUFBSSxDQUFDRyxXQUFXLENBQUMsQ0FBQztNQUNsQixJQUFJLENBQUNDLFdBQVcsQ0FBQyxDQUFDO0lBQ3RCO0VBQUM7SUFBQUgsR0FBQTtJQUFBQyxLQUFBLEVBRUQsU0FBQUMsWUFBQSxFQUFjO01BQ1YsSUFBSSxDQUFDSixJQUFJLENBQUN0QixPQUFPLENBQUMsVUFBQXNCLElBQUksRUFBSTtRQUN0QkEsSUFBSSxDQUFDTSxTQUFTLENBQUNDLEdBQUcsQ0FBQyxnQkFBZ0IsQ0FBQztNQUN4QyxDQUFDLENBQUM7SUFDTjtFQUFDO0lBQUFMLEdBQUE7SUFBQUMsS0FBQSxFQUVELFNBQUFFLFlBQUEsRUFBYztNQUFBLElBQUFqQyxLQUFBO01BQ1YsSUFBSSxDQUFDNEIsSUFBSSxDQUFDdEIsT0FBTyxDQUFDLFVBQUFzQixJQUFJLEVBQUk7UUFDdEJBLElBQUksQ0FBQ3hCLGdCQUFnQixDQUFDLE9BQU8sRUFBRTtVQUFBLE9BQU1KLEtBQUksQ0FBQ29DLFFBQVEsQ0FBQ1IsSUFBSSxDQUFDO1FBQUEsRUFBQztNQUM3RCxDQUFDLENBQUM7SUFDTjtFQUFDO0lBQUFFLEdBQUE7SUFBQUMsS0FBQSxFQUVELFNBQUFLLFNBQVNDLENBQUMsRUFBRTtNQUNSLElBQU1DLEdBQUcsR0FBR0QsQ0FBQyxDQUFDRSxPQUFPLENBQUNDLElBQUk7TUFDMUIsSUFBSSxJQUFJLENBQUNoQixNQUFNLEVBQUU7UUFDYixPQUFPaUIsTUFBTSxDQUFDQyxJQUFJLENBQUNKLEdBQUcsRUFBRSxRQUFRLENBQUM7TUFDckM7TUFDQUcsTUFBTSxDQUFDRSxRQUFRLEdBQUdMLEdBQUc7SUFDekI7RUFBQztFQUFBLE9BQUFoQixJQUFBO0FBQUE7QUFHTCxpRUFBZUEsSUFBSTs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUNqQ2JzQixTQUFTO0VBQ1gsU0FBQUEsVUFBWUMsY0FBYyxFQUFFQyxXQUFXLEVBQUU7SUFBQSxJQUFBOUMsS0FBQTtJQUFBQyxlQUFBLE9BQUEyQyxTQUFBO0lBQ3JDLElBQUksQ0FBQ0csU0FBUyxHQUFHckQsUUFBUSxDQUFDeUIsYUFBYSxDQUFDMEIsY0FBYyxDQUFDO0lBQ3ZELElBQUksQ0FBQ0csR0FBRyxHQUFHdEQsUUFBUSxDQUFDeUIsYUFBYSxDQUFDMkIsV0FBVyxDQUFDO0lBQzlDLElBQUksQ0FBQ0MsU0FBUyxDQUFDM0MsZ0JBQWdCLENBQUMsT0FBTyxFQUFFO01BQUEsT0FBTUosS0FBSSxDQUFDaUQsTUFBTSxDQUFDLENBQUM7SUFBQSxFQUFDO0VBQ2pFO0VBQUNwRCxZQUFBLENBQUErQyxTQUFBO0lBQUFkLEdBQUE7SUFBQUMsS0FBQSxFQUVELFNBQUFrQixPQUFBLEVBQVM7TUFDTCxJQUFNQyxNQUFNLEdBQUcsSUFBSSxDQUFDRixHQUFHLENBQUNqQyxZQUFZLENBQUMsV0FBVyxDQUFDLEtBQUssTUFBTTtNQUM1RCxJQUFJLENBQUNpQyxHQUFHLENBQUNHLFlBQVksQ0FBQyxXQUFXLEVBQUUsQ0FBQ0QsTUFBTSxDQUFDO01BQzNDLElBQUlBLE1BQU0sRUFBRTtRQUNSLElBQUksQ0FBQ0YsR0FBRyxDQUFDZCxTQUFTLENBQUNrQixNQUFNLENBQUMsTUFBTSxDQUFDO1FBQ2pDLElBQUksQ0FBQ0osR0FBRyxDQUFDZCxTQUFTLENBQUNDLEdBQUcsQ0FBQyxhQUFhLENBQUM7TUFDekMsQ0FBQyxNQUFNO1FBQ0gsSUFBSSxDQUFDYSxHQUFHLENBQUNkLFNBQVMsQ0FBQ0MsR0FBRyxDQUFDLE1BQU0sQ0FBQztRQUM5QixJQUFJLENBQUNhLEdBQUcsQ0FBQ2QsU0FBUyxDQUFDa0IsTUFBTSxDQUFDLGFBQWEsQ0FBQztNQUM1QztJQUNKO0VBQUM7RUFBQSxPQUFBUixTQUFBO0FBQUE7QUFHTCxpRUFBZUEsU0FBUzs7Ozs7Ozs7Ozs7OzsrQ0NuQnhCLHFKQUFBUyxtQkFBQSxZQUFBQSxvQkFBQSxXQUFBaEIsQ0FBQSxTQUFBaUIsQ0FBQSxFQUFBakIsQ0FBQSxPQUFBa0IsQ0FBQSxHQUFBQyxNQUFBLENBQUFDLFNBQUEsRUFBQUMsQ0FBQSxHQUFBSCxDQUFBLENBQUFJLGNBQUEsRUFBQUMsQ0FBQSxHQUFBSixNQUFBLENBQUFLLGNBQUEsY0FBQVAsQ0FBQSxFQUFBakIsQ0FBQSxFQUFBa0IsQ0FBQSxJQUFBRCxDQUFBLENBQUFqQixDQUFBLElBQUFrQixDQUFBLENBQUF4QixLQUFBLEtBQUErQixDQUFBLHdCQUFBQyxNQUFBLEdBQUFBLE1BQUEsT0FBQUMsQ0FBQSxHQUFBRixDQUFBLENBQUFHLFFBQUEsa0JBQUFDLENBQUEsR0FBQUosQ0FBQSxDQUFBSyxhQUFBLHVCQUFBQyxDQUFBLEdBQUFOLENBQUEsQ0FBQU8sV0FBQSw4QkFBQUMsT0FBQWhCLENBQUEsRUFBQWpCLENBQUEsRUFBQWtCLENBQUEsV0FBQUMsTUFBQSxDQUFBSyxjQUFBLENBQUFQLENBQUEsRUFBQWpCLENBQUEsSUFBQU4sS0FBQSxFQUFBd0IsQ0FBQSxFQUFBZ0IsVUFBQSxNQUFBQyxZQUFBLE1BQUFDLFFBQUEsU0FBQW5CLENBQUEsQ0FBQWpCLENBQUEsV0FBQWlDLE1BQUEsbUJBQUFoQixDQUFBLElBQUFnQixNQUFBLFlBQUFBLE9BQUFoQixDQUFBLEVBQUFqQixDQUFBLEVBQUFrQixDQUFBLFdBQUFELENBQUEsQ0FBQWpCLENBQUEsSUFBQWtCLENBQUEsZ0JBQUFtQixLQUFBcEIsQ0FBQSxFQUFBakIsQ0FBQSxFQUFBa0IsQ0FBQSxFQUFBRyxDQUFBLFFBQUFJLENBQUEsR0FBQXpCLENBQUEsSUFBQUEsQ0FBQSxDQUFBb0IsU0FBQSxZQUFBa0IsU0FBQSxHQUFBdEMsQ0FBQSxHQUFBc0MsU0FBQSxFQUFBWCxDQUFBLEdBQUFSLE1BQUEsQ0FBQW9CLE1BQUEsQ0FBQWQsQ0FBQSxDQUFBTCxTQUFBLEdBQUFTLENBQUEsT0FBQVcsT0FBQSxDQUFBbkIsQ0FBQSxnQkFBQUUsQ0FBQSxDQUFBSSxDQUFBLGVBQUFqQyxLQUFBLEVBQUErQyxnQkFBQSxDQUFBeEIsQ0FBQSxFQUFBQyxDQUFBLEVBQUFXLENBQUEsTUFBQUYsQ0FBQSxhQUFBZSxTQUFBekIsQ0FBQSxFQUFBakIsQ0FBQSxFQUFBa0IsQ0FBQSxtQkFBQXlCLElBQUEsWUFBQUMsR0FBQSxFQUFBM0IsQ0FBQSxDQUFBNEIsSUFBQSxDQUFBN0MsQ0FBQSxFQUFBa0IsQ0FBQSxjQUFBRCxDQUFBLGFBQUEwQixJQUFBLFdBQUFDLEdBQUEsRUFBQTNCLENBQUEsUUFBQWpCLENBQUEsQ0FBQXFDLElBQUEsR0FBQUEsSUFBQSxNQUFBUyxDQUFBLHFCQUFBQyxDQUFBLHFCQUFBQyxDQUFBLGdCQUFBQyxDQUFBLGdCQUFBQyxDQUFBLGdCQUFBWixVQUFBLGNBQUFhLGtCQUFBLGNBQUFDLDJCQUFBLFNBQUFDLENBQUEsT0FBQXBCLE1BQUEsQ0FBQW9CLENBQUEsRUFBQTFCLENBQUEscUNBQUEyQixDQUFBLEdBQUFuQyxNQUFBLENBQUFvQyxjQUFBLEVBQUFDLENBQUEsR0FBQUYsQ0FBQSxJQUFBQSxDQUFBLENBQUFBLENBQUEsQ0FBQUcsTUFBQSxRQUFBRCxDQUFBLElBQUFBLENBQUEsS0FBQXRDLENBQUEsSUFBQUcsQ0FBQSxDQUFBd0IsSUFBQSxDQUFBVyxDQUFBLEVBQUE3QixDQUFBLE1BQUEwQixDQUFBLEdBQUFHLENBQUEsT0FBQUUsQ0FBQSxHQUFBTiwwQkFBQSxDQUFBaEMsU0FBQSxHQUFBa0IsU0FBQSxDQUFBbEIsU0FBQSxHQUFBRCxNQUFBLENBQUFvQixNQUFBLENBQUFjLENBQUEsWUFBQU0sc0JBQUExQyxDQUFBLGdDQUFBaEQsT0FBQSxXQUFBK0IsQ0FBQSxJQUFBaUMsTUFBQSxDQUFBaEIsQ0FBQSxFQUFBakIsQ0FBQSxZQUFBaUIsQ0FBQSxnQkFBQTJDLE9BQUEsQ0FBQTVELENBQUEsRUFBQWlCLENBQUEsc0JBQUE0QyxjQUFBNUMsQ0FBQSxFQUFBakIsQ0FBQSxhQUFBOEQsT0FBQTVDLENBQUEsRUFBQUssQ0FBQSxFQUFBRSxDQUFBLEVBQUFFLENBQUEsUUFBQUUsQ0FBQSxHQUFBYSxRQUFBLENBQUF6QixDQUFBLENBQUFDLENBQUEsR0FBQUQsQ0FBQSxFQUFBTSxDQUFBLG1CQUFBTSxDQUFBLENBQUFjLElBQUEsUUFBQVosQ0FBQSxHQUFBRixDQUFBLENBQUFlLEdBQUEsRUFBQUUsQ0FBQSxHQUFBZixDQUFBLENBQUFyQyxLQUFBLFNBQUFvRCxDQUFBLGdCQUFBakUsT0FBQSxDQUFBaUUsQ0FBQSxLQUFBekIsQ0FBQSxDQUFBd0IsSUFBQSxDQUFBQyxDQUFBLGVBQUE5QyxDQUFBLENBQUErRCxPQUFBLENBQUFqQixDQUFBLENBQUFrQixPQUFBLEVBQUFDLElBQUEsV0FBQWhELENBQUEsSUFBQTZDLE1BQUEsU0FBQTdDLENBQUEsRUFBQVEsQ0FBQSxFQUFBRSxDQUFBLGdCQUFBVixDQUFBLElBQUE2QyxNQUFBLFVBQUE3QyxDQUFBLEVBQUFRLENBQUEsRUFBQUUsQ0FBQSxRQUFBM0IsQ0FBQSxDQUFBK0QsT0FBQSxDQUFBakIsQ0FBQSxFQUFBbUIsSUFBQSxXQUFBaEQsQ0FBQSxJQUFBYyxDQUFBLENBQUFyQyxLQUFBLEdBQUF1QixDQUFBLEVBQUFRLENBQUEsQ0FBQU0sQ0FBQSxnQkFBQWQsQ0FBQSxXQUFBNkMsTUFBQSxVQUFBN0MsQ0FBQSxFQUFBUSxDQUFBLEVBQUFFLENBQUEsU0FBQUEsQ0FBQSxDQUFBRSxDQUFBLENBQUFlLEdBQUEsU0FBQTFCLENBQUEsRUFBQUssQ0FBQSxvQkFBQTdCLEtBQUEsV0FBQUEsTUFBQXVCLENBQUEsRUFBQUksQ0FBQSxhQUFBNkMsMkJBQUEsZUFBQWxFLENBQUEsV0FBQUEsQ0FBQSxFQUFBa0IsQ0FBQSxJQUFBNEMsTUFBQSxDQUFBN0MsQ0FBQSxFQUFBSSxDQUFBLEVBQUFyQixDQUFBLEVBQUFrQixDQUFBLGdCQUFBQSxDQUFBLEdBQUFBLENBQUEsR0FBQUEsQ0FBQSxDQUFBK0MsSUFBQSxDQUFBQywwQkFBQSxFQUFBQSwwQkFBQSxJQUFBQSwwQkFBQSxxQkFBQXpCLGlCQUFBekMsQ0FBQSxFQUFBa0IsQ0FBQSxFQUFBRyxDQUFBLFFBQUFFLENBQUEsR0FBQXVCLENBQUEsbUJBQUFyQixDQUFBLEVBQUFFLENBQUEsUUFBQUosQ0FBQSxLQUFBeUIsQ0FBQSxZQUFBbUIsS0FBQSxzQ0FBQTVDLENBQUEsS0FBQTBCLENBQUEsb0JBQUF4QixDQUFBLFFBQUFFLENBQUEsV0FBQWpDLEtBQUEsRUFBQXVCLENBQUEsRUFBQW1ELElBQUEsZUFBQS9DLENBQUEsQ0FBQWdELE1BQUEsR0FBQTVDLENBQUEsRUFBQUosQ0FBQSxDQUFBdUIsR0FBQSxHQUFBakIsQ0FBQSxVQUFBRSxDQUFBLEdBQUFSLENBQUEsQ0FBQWlELFFBQUEsTUFBQXpDLENBQUEsUUFBQUUsQ0FBQSxHQUFBd0MsbUJBQUEsQ0FBQTFDLENBQUEsRUFBQVIsQ0FBQSxPQUFBVSxDQUFBLFFBQUFBLENBQUEsS0FBQW1CLENBQUEsbUJBQUFuQixDQUFBLHFCQUFBVixDQUFBLENBQUFnRCxNQUFBLEVBQUFoRCxDQUFBLENBQUFtRCxJQUFBLEdBQUFuRCxDQUFBLENBQUFvRCxLQUFBLEdBQUFwRCxDQUFBLENBQUF1QixHQUFBLHNCQUFBdkIsQ0FBQSxDQUFBZ0QsTUFBQSxRQUFBOUMsQ0FBQSxLQUFBdUIsQ0FBQSxRQUFBdkIsQ0FBQSxHQUFBMEIsQ0FBQSxFQUFBNUIsQ0FBQSxDQUFBdUIsR0FBQSxFQUFBdkIsQ0FBQSxDQUFBcUQsaUJBQUEsQ0FBQXJELENBQUEsQ0FBQXVCLEdBQUEsdUJBQUF2QixDQUFBLENBQUFnRCxNQUFBLElBQUFoRCxDQUFBLENBQUFzRCxNQUFBLFdBQUF0RCxDQUFBLENBQUF1QixHQUFBLEdBQUFyQixDQUFBLEdBQUF5QixDQUFBLE1BQUFLLENBQUEsR0FBQVgsUUFBQSxDQUFBMUMsQ0FBQSxFQUFBa0IsQ0FBQSxFQUFBRyxDQUFBLG9CQUFBZ0MsQ0FBQSxDQUFBVixJQUFBLFFBQUFwQixDQUFBLEdBQUFGLENBQUEsQ0FBQStDLElBQUEsR0FBQW5CLENBQUEsR0FBQUYsQ0FBQSxFQUFBTSxDQUFBLENBQUFULEdBQUEsS0FBQU0sQ0FBQSxxQkFBQXhELEtBQUEsRUFBQTJELENBQUEsQ0FBQVQsR0FBQSxFQUFBd0IsSUFBQSxFQUFBL0MsQ0FBQSxDQUFBK0MsSUFBQSxrQkFBQWYsQ0FBQSxDQUFBVixJQUFBLEtBQUFwQixDQUFBLEdBQUEwQixDQUFBLEVBQUE1QixDQUFBLENBQUFnRCxNQUFBLFlBQUFoRCxDQUFBLENBQUF1QixHQUFBLEdBQUFTLENBQUEsQ0FBQVQsR0FBQSxtQkFBQTJCLG9CQUFBdkUsQ0FBQSxFQUFBa0IsQ0FBQSxRQUFBRyxDQUFBLEdBQUFILENBQUEsQ0FBQW1ELE1BQUEsRUFBQTlDLENBQUEsR0FBQXZCLENBQUEsQ0FBQTRCLFFBQUEsQ0FBQVAsQ0FBQSxPQUFBRSxDQUFBLEtBQUFOLENBQUEsU0FBQUMsQ0FBQSxDQUFBb0QsUUFBQSxxQkFBQWpELENBQUEsSUFBQXJCLENBQUEsQ0FBQTRCLFFBQUEsZUFBQVYsQ0FBQSxDQUFBbUQsTUFBQSxhQUFBbkQsQ0FBQSxDQUFBMEIsR0FBQSxHQUFBM0IsQ0FBQSxFQUFBc0QsbUJBQUEsQ0FBQXZFLENBQUEsRUFBQWtCLENBQUEsZUFBQUEsQ0FBQSxDQUFBbUQsTUFBQSxrQkFBQWhELENBQUEsS0FBQUgsQ0FBQSxDQUFBbUQsTUFBQSxZQUFBbkQsQ0FBQSxDQUFBMEIsR0FBQSxPQUFBZ0MsU0FBQSx1Q0FBQXZELENBQUEsaUJBQUE2QixDQUFBLE1BQUF6QixDQUFBLEdBQUFpQixRQUFBLENBQUFuQixDQUFBLEVBQUF2QixDQUFBLENBQUE0QixRQUFBLEVBQUFWLENBQUEsQ0FBQTBCLEdBQUEsbUJBQUFuQixDQUFBLENBQUFrQixJQUFBLFNBQUF6QixDQUFBLENBQUFtRCxNQUFBLFlBQUFuRCxDQUFBLENBQUEwQixHQUFBLEdBQUFuQixDQUFBLENBQUFtQixHQUFBLEVBQUExQixDQUFBLENBQUFvRCxRQUFBLFNBQUFwQixDQUFBLE1BQUF2QixDQUFBLEdBQUFGLENBQUEsQ0FBQW1CLEdBQUEsU0FBQWpCLENBQUEsR0FBQUEsQ0FBQSxDQUFBeUMsSUFBQSxJQUFBbEQsQ0FBQSxDQUFBbEIsQ0FBQSxDQUFBNkUsVUFBQSxJQUFBbEQsQ0FBQSxDQUFBakMsS0FBQSxFQUFBd0IsQ0FBQSxDQUFBNEQsSUFBQSxHQUFBOUUsQ0FBQSxDQUFBK0UsT0FBQSxlQUFBN0QsQ0FBQSxDQUFBbUQsTUFBQSxLQUFBbkQsQ0FBQSxDQUFBbUQsTUFBQSxXQUFBbkQsQ0FBQSxDQUFBMEIsR0FBQSxHQUFBM0IsQ0FBQSxHQUFBQyxDQUFBLENBQUFvRCxRQUFBLFNBQUFwQixDQUFBLElBQUF2QixDQUFBLElBQUFULENBQUEsQ0FBQW1ELE1BQUEsWUFBQW5ELENBQUEsQ0FBQTBCLEdBQUEsT0FBQWdDLFNBQUEsc0NBQUExRCxDQUFBLENBQUFvRCxRQUFBLFNBQUFwQixDQUFBLGNBQUE4QixhQUFBL0QsQ0FBQSxRQUFBakIsQ0FBQSxLQUFBaUYsTUFBQSxFQUFBaEUsQ0FBQSxZQUFBQSxDQUFBLEtBQUFqQixDQUFBLENBQUFrRixRQUFBLEdBQUFqRSxDQUFBLFdBQUFBLENBQUEsS0FBQWpCLENBQUEsQ0FBQW1GLFVBQUEsR0FBQWxFLENBQUEsS0FBQWpCLENBQUEsQ0FBQW9GLFFBQUEsR0FBQW5FLENBQUEsV0FBQW9FLFVBQUEsQ0FBQTdHLElBQUEsQ0FBQXdCLENBQUEsY0FBQXNGLGNBQUFyRSxDQUFBLFFBQUFqQixDQUFBLEdBQUFpQixDQUFBLENBQUFzRSxVQUFBLFFBQUF2RixDQUFBLENBQUEyQyxJQUFBLG9CQUFBM0MsQ0FBQSxDQUFBNEMsR0FBQSxFQUFBM0IsQ0FBQSxDQUFBc0UsVUFBQSxHQUFBdkYsQ0FBQSxhQUFBd0MsUUFBQXZCLENBQUEsU0FBQW9FLFVBQUEsTUFBQUosTUFBQSxhQUFBaEUsQ0FBQSxDQUFBaEQsT0FBQSxDQUFBK0csWUFBQSxjQUFBUSxLQUFBLGlCQUFBL0IsT0FBQXpELENBQUEsUUFBQUEsQ0FBQSxXQUFBQSxDQUFBLFFBQUFrQixDQUFBLEdBQUFsQixDQUFBLENBQUEyQixDQUFBLE9BQUFULENBQUEsU0FBQUEsQ0FBQSxDQUFBMkIsSUFBQSxDQUFBN0MsQ0FBQSw0QkFBQUEsQ0FBQSxDQUFBOEUsSUFBQSxTQUFBOUUsQ0FBQSxPQUFBeUYsS0FBQSxDQUFBekYsQ0FBQSxDQUFBWCxNQUFBLFNBQUFrQyxDQUFBLE9BQUFFLENBQUEsWUFBQXFELEtBQUEsYUFBQXZELENBQUEsR0FBQXZCLENBQUEsQ0FBQVgsTUFBQSxPQUFBZ0MsQ0FBQSxDQUFBd0IsSUFBQSxDQUFBN0MsQ0FBQSxFQUFBdUIsQ0FBQSxVQUFBdUQsSUFBQSxDQUFBcEYsS0FBQSxHQUFBTSxDQUFBLENBQUF1QixDQUFBLEdBQUF1RCxJQUFBLENBQUFWLElBQUEsT0FBQVUsSUFBQSxTQUFBQSxJQUFBLENBQUFwRixLQUFBLEdBQUF1QixDQUFBLEVBQUE2RCxJQUFBLENBQUFWLElBQUEsT0FBQVUsSUFBQSxZQUFBckQsQ0FBQSxDQUFBcUQsSUFBQSxHQUFBckQsQ0FBQSxnQkFBQW1ELFNBQUEsQ0FBQS9GLE9BQUEsQ0FBQW1CLENBQUEsa0NBQUFtRCxpQkFBQSxDQUFBL0IsU0FBQSxHQUFBZ0MsMEJBQUEsRUFBQTdCLENBQUEsQ0FBQW1DLENBQUEsbUJBQUFoRSxLQUFBLEVBQUEwRCwwQkFBQSxFQUFBakIsWUFBQSxTQUFBWixDQUFBLENBQUE2QiwwQkFBQSxtQkFBQTFELEtBQUEsRUFBQXlELGlCQUFBLEVBQUFoQixZQUFBLFNBQUFnQixpQkFBQSxDQUFBdUMsV0FBQSxHQUFBekQsTUFBQSxDQUFBbUIsMEJBQUEsRUFBQXJCLENBQUEsd0JBQUEvQixDQUFBLENBQUEyRixtQkFBQSxhQUFBMUUsQ0FBQSxRQUFBakIsQ0FBQSx3QkFBQWlCLENBQUEsSUFBQUEsQ0FBQSxDQUFBMkUsV0FBQSxXQUFBNUYsQ0FBQSxLQUFBQSxDQUFBLEtBQUFtRCxpQkFBQSw2QkFBQW5ELENBQUEsQ0FBQTBGLFdBQUEsSUFBQTFGLENBQUEsQ0FBQTZGLElBQUEsT0FBQTdGLENBQUEsQ0FBQThGLElBQUEsYUFBQTdFLENBQUEsV0FBQUUsTUFBQSxDQUFBNEUsY0FBQSxHQUFBNUUsTUFBQSxDQUFBNEUsY0FBQSxDQUFBOUUsQ0FBQSxFQUFBbUMsMEJBQUEsS0FBQW5DLENBQUEsQ0FBQStFLFNBQUEsR0FBQTVDLDBCQUFBLEVBQUFuQixNQUFBLENBQUFoQixDQUFBLEVBQUFjLENBQUEseUJBQUFkLENBQUEsQ0FBQUcsU0FBQSxHQUFBRCxNQUFBLENBQUFvQixNQUFBLENBQUFtQixDQUFBLEdBQUF6QyxDQUFBLEtBQUFqQixDQUFBLENBQUFpRyxLQUFBLGFBQUFoRixDQUFBLGFBQUErQyxPQUFBLEVBQUEvQyxDQUFBLE9BQUEwQyxxQkFBQSxDQUFBRSxhQUFBLENBQUF6QyxTQUFBLEdBQUFhLE1BQUEsQ0FBQTRCLGFBQUEsQ0FBQXpDLFNBQUEsRUFBQVMsQ0FBQSxpQ0FBQTdCLENBQUEsQ0FBQTZELGFBQUEsR0FBQUEsYUFBQSxFQUFBN0QsQ0FBQSxDQUFBa0csS0FBQSxhQUFBakYsQ0FBQSxFQUFBQyxDQUFBLEVBQUFHLENBQUEsRUFBQUUsQ0FBQSxFQUFBRSxDQUFBLGVBQUFBLENBQUEsS0FBQUEsQ0FBQSxHQUFBMEUsT0FBQSxPQUFBeEUsQ0FBQSxPQUFBa0MsYUFBQSxDQUFBeEIsSUFBQSxDQUFBcEIsQ0FBQSxFQUFBQyxDQUFBLEVBQUFHLENBQUEsRUFBQUUsQ0FBQSxHQUFBRSxDQUFBLFVBQUF6QixDQUFBLENBQUEyRixtQkFBQSxDQUFBekUsQ0FBQSxJQUFBUyxDQUFBLEdBQUFBLENBQUEsQ0FBQW1ELElBQUEsR0FBQWIsSUFBQSxXQUFBaEQsQ0FBQSxXQUFBQSxDQUFBLENBQUFtRCxJQUFBLEdBQUFuRCxDQUFBLENBQUF2QixLQUFBLEdBQUFpQyxDQUFBLENBQUFtRCxJQUFBLFdBQUFuQixxQkFBQSxDQUFBRCxDQUFBLEdBQUF6QixNQUFBLENBQUF5QixDQUFBLEVBQUEzQixDQUFBLGdCQUFBRSxNQUFBLENBQUF5QixDQUFBLEVBQUEvQixDQUFBLGlDQUFBTSxNQUFBLENBQUF5QixDQUFBLDZEQUFBMUQsQ0FBQSxDQUFBb0csSUFBQSxhQUFBbkYsQ0FBQSxRQUFBakIsQ0FBQSxHQUFBbUIsTUFBQSxDQUFBRixDQUFBLEdBQUFDLENBQUEsZ0JBQUFHLENBQUEsSUFBQXJCLENBQUEsRUFBQWtCLENBQUEsQ0FBQTFDLElBQUEsQ0FBQTZDLENBQUEsVUFBQUgsQ0FBQSxDQUFBbUYsT0FBQSxhQUFBdkIsS0FBQSxXQUFBNUQsQ0FBQSxDQUFBN0IsTUFBQSxTQUFBNEIsQ0FBQSxHQUFBQyxDQUFBLENBQUFvRixHQUFBLFFBQUFyRixDQUFBLElBQUFqQixDQUFBLFNBQUE4RSxJQUFBLENBQUFwRixLQUFBLEdBQUF1QixDQUFBLEVBQUE2RCxJQUFBLENBQUFWLElBQUEsT0FBQVUsSUFBQSxXQUFBQSxJQUFBLENBQUFWLElBQUEsT0FBQVUsSUFBQSxRQUFBOUUsQ0FBQSxDQUFBeUQsTUFBQSxHQUFBQSxNQUFBLEVBQUFqQixPQUFBLENBQUFwQixTQUFBLEtBQUF3RSxXQUFBLEVBQUFwRCxPQUFBLEVBQUFnRCxLQUFBLFdBQUFBLE1BQUF4RixDQUFBLGFBQUF1RyxJQUFBLFdBQUF6QixJQUFBLFdBQUFOLElBQUEsUUFBQUMsS0FBQSxHQUFBeEQsQ0FBQSxPQUFBbUQsSUFBQSxZQUFBRSxRQUFBLGNBQUFELE1BQUEsZ0JBQUF6QixHQUFBLEdBQUEzQixDQUFBLE9BQUFvRSxVQUFBLENBQUFwSCxPQUFBLENBQUFxSCxhQUFBLElBQUF0RixDQUFBLFdBQUFrQixDQUFBLGtCQUFBQSxDQUFBLENBQUFzRixNQUFBLE9BQUFuRixDQUFBLENBQUF3QixJQUFBLE9BQUEzQixDQUFBLE1BQUF1RSxLQUFBLEVBQUF2RSxDQUFBLENBQUF1RixLQUFBLGNBQUF2RixDQUFBLElBQUFELENBQUEsTUFBQXlGLElBQUEsV0FBQUEsS0FBQSxTQUFBdEMsSUFBQSxXQUFBbkQsQ0FBQSxRQUFBb0UsVUFBQSxJQUFBRSxVQUFBLGtCQUFBdEUsQ0FBQSxDQUFBMEIsSUFBQSxRQUFBMUIsQ0FBQSxDQUFBMkIsR0FBQSxjQUFBK0QsSUFBQSxLQUFBakMsaUJBQUEsV0FBQUEsa0JBQUExRSxDQUFBLGFBQUFvRSxJQUFBLFFBQUFwRSxDQUFBLE1BQUFrQixDQUFBLGtCQUFBMEYsT0FBQXZGLENBQUEsRUFBQUUsQ0FBQSxXQUFBSSxDQUFBLENBQUFnQixJQUFBLFlBQUFoQixDQUFBLENBQUFpQixHQUFBLEdBQUE1QyxDQUFBLEVBQUFrQixDQUFBLENBQUE0RCxJQUFBLEdBQUF6RCxDQUFBLEVBQUFFLENBQUEsS0FBQUwsQ0FBQSxDQUFBbUQsTUFBQSxXQUFBbkQsQ0FBQSxDQUFBMEIsR0FBQSxHQUFBM0IsQ0FBQSxLQUFBTSxDQUFBLGFBQUFBLENBQUEsUUFBQThELFVBQUEsQ0FBQWhHLE1BQUEsTUFBQWtDLENBQUEsU0FBQUEsQ0FBQSxRQUFBRSxDQUFBLFFBQUE0RCxVQUFBLENBQUE5RCxDQUFBLEdBQUFJLENBQUEsR0FBQUYsQ0FBQSxDQUFBOEQsVUFBQSxpQkFBQTlELENBQUEsQ0FBQXdELE1BQUEsU0FBQTJCLE1BQUEsYUFBQW5GLENBQUEsQ0FBQXdELE1BQUEsU0FBQXNCLElBQUEsUUFBQTFFLENBQUEsR0FBQVIsQ0FBQSxDQUFBd0IsSUFBQSxDQUFBcEIsQ0FBQSxlQUFBTSxDQUFBLEdBQUFWLENBQUEsQ0FBQXdCLElBQUEsQ0FBQXBCLENBQUEscUJBQUFJLENBQUEsSUFBQUUsQ0FBQSxhQUFBd0UsSUFBQSxHQUFBOUUsQ0FBQSxDQUFBeUQsUUFBQSxTQUFBMEIsTUFBQSxDQUFBbkYsQ0FBQSxDQUFBeUQsUUFBQSxnQkFBQXFCLElBQUEsR0FBQTlFLENBQUEsQ0FBQTBELFVBQUEsU0FBQXlCLE1BQUEsQ0FBQW5GLENBQUEsQ0FBQTBELFVBQUEsY0FBQXRELENBQUEsYUFBQTBFLElBQUEsR0FBQTlFLENBQUEsQ0FBQXlELFFBQUEsU0FBQTBCLE1BQUEsQ0FBQW5GLENBQUEsQ0FBQXlELFFBQUEscUJBQUFuRCxDQUFBLFlBQUFvQyxLQUFBLHFEQUFBb0MsSUFBQSxHQUFBOUUsQ0FBQSxDQUFBMEQsVUFBQSxTQUFBeUIsTUFBQSxDQUFBbkYsQ0FBQSxDQUFBMEQsVUFBQSxZQUFBUixNQUFBLFdBQUFBLE9BQUExRCxDQUFBLEVBQUFqQixDQUFBLGFBQUFrQixDQUFBLFFBQUFtRSxVQUFBLENBQUFoRyxNQUFBLE1BQUE2QixDQUFBLFNBQUFBLENBQUEsUUFBQUssQ0FBQSxRQUFBOEQsVUFBQSxDQUFBbkUsQ0FBQSxPQUFBSyxDQUFBLENBQUEwRCxNQUFBLFNBQUFzQixJQUFBLElBQUFsRixDQUFBLENBQUF3QixJQUFBLENBQUF0QixDQUFBLHdCQUFBZ0YsSUFBQSxHQUFBaEYsQ0FBQSxDQUFBNEQsVUFBQSxRQUFBMUQsQ0FBQSxHQUFBRixDQUFBLGFBQUFFLENBQUEsaUJBQUFSLENBQUEsbUJBQUFBLENBQUEsS0FBQVEsQ0FBQSxDQUFBd0QsTUFBQSxJQUFBakYsQ0FBQSxJQUFBQSxDQUFBLElBQUF5QixDQUFBLENBQUEwRCxVQUFBLEtBQUExRCxDQUFBLGNBQUFFLENBQUEsR0FBQUYsQ0FBQSxHQUFBQSxDQUFBLENBQUE4RCxVQUFBLGNBQUE1RCxDQUFBLENBQUFnQixJQUFBLEdBQUExQixDQUFBLEVBQUFVLENBQUEsQ0FBQWlCLEdBQUEsR0FBQTVDLENBQUEsRUFBQXlCLENBQUEsU0FBQTRDLE1BQUEsZ0JBQUFTLElBQUEsR0FBQXJELENBQUEsQ0FBQTBELFVBQUEsRUFBQWpDLENBQUEsU0FBQTJELFFBQUEsQ0FBQWxGLENBQUEsTUFBQWtGLFFBQUEsV0FBQUEsU0FBQTVGLENBQUEsRUFBQWpCLENBQUEsb0JBQUFpQixDQUFBLENBQUEwQixJQUFBLFFBQUExQixDQUFBLENBQUEyQixHQUFBLHFCQUFBM0IsQ0FBQSxDQUFBMEIsSUFBQSxtQkFBQTFCLENBQUEsQ0FBQTBCLElBQUEsUUFBQW1DLElBQUEsR0FBQTdELENBQUEsQ0FBQTJCLEdBQUEsZ0JBQUEzQixDQUFBLENBQUEwQixJQUFBLFNBQUFnRSxJQUFBLFFBQUEvRCxHQUFBLEdBQUEzQixDQUFBLENBQUEyQixHQUFBLE9BQUF5QixNQUFBLGtCQUFBUyxJQUFBLHlCQUFBN0QsQ0FBQSxDQUFBMEIsSUFBQSxJQUFBM0MsQ0FBQSxVQUFBOEUsSUFBQSxHQUFBOUUsQ0FBQSxHQUFBa0QsQ0FBQSxLQUFBNEQsTUFBQSxXQUFBQSxPQUFBN0YsQ0FBQSxhQUFBakIsQ0FBQSxRQUFBcUYsVUFBQSxDQUFBaEcsTUFBQSxNQUFBVyxDQUFBLFNBQUFBLENBQUEsUUFBQWtCLENBQUEsUUFBQW1FLFVBQUEsQ0FBQXJGLENBQUEsT0FBQWtCLENBQUEsQ0FBQWlFLFVBQUEsS0FBQWxFLENBQUEsY0FBQTRGLFFBQUEsQ0FBQTNGLENBQUEsQ0FBQXFFLFVBQUEsRUFBQXJFLENBQUEsQ0FBQWtFLFFBQUEsR0FBQUUsYUFBQSxDQUFBcEUsQ0FBQSxHQUFBZ0MsQ0FBQSx5QkFBQTZELE9BQUE5RixDQUFBLGFBQUFqQixDQUFBLFFBQUFxRixVQUFBLENBQUFoRyxNQUFBLE1BQUFXLENBQUEsU0FBQUEsQ0FBQSxRQUFBa0IsQ0FBQSxRQUFBbUUsVUFBQSxDQUFBckYsQ0FBQSxPQUFBa0IsQ0FBQSxDQUFBK0QsTUFBQSxLQUFBaEUsQ0FBQSxRQUFBSSxDQUFBLEdBQUFILENBQUEsQ0FBQXFFLFVBQUEsa0JBQUFsRSxDQUFBLENBQUFzQixJQUFBLFFBQUFwQixDQUFBLEdBQUFGLENBQUEsQ0FBQXVCLEdBQUEsRUFBQTBDLGFBQUEsQ0FBQXBFLENBQUEsWUFBQUssQ0FBQSxnQkFBQTRDLEtBQUEsOEJBQUE2QyxhQUFBLFdBQUFBLGNBQUFoSCxDQUFBLEVBQUFrQixDQUFBLEVBQUFHLENBQUEsZ0JBQUFpRCxRQUFBLEtBQUExQyxRQUFBLEVBQUE2QixNQUFBLENBQUF6RCxDQUFBLEdBQUE2RSxVQUFBLEVBQUEzRCxDQUFBLEVBQUE2RCxPQUFBLEVBQUExRCxDQUFBLG9CQUFBZ0QsTUFBQSxVQUFBekIsR0FBQSxHQUFBM0IsQ0FBQSxHQUFBaUMsQ0FBQSxPQUFBbEQsQ0FBQTtBQUFBLFNBQUFpSCxtQkFBQUMsR0FBQSxFQUFBbkQsT0FBQSxFQUFBb0QsTUFBQSxFQUFBQyxLQUFBLEVBQUFDLE1BQUEsRUFBQTVILEdBQUEsRUFBQW1ELEdBQUEsY0FBQTBFLElBQUEsR0FBQUosR0FBQSxDQUFBekgsR0FBQSxFQUFBbUQsR0FBQSxPQUFBbEQsS0FBQSxHQUFBNEgsSUFBQSxDQUFBNUgsS0FBQSxXQUFBNkgsS0FBQSxJQUFBSixNQUFBLENBQUFJLEtBQUEsaUJBQUFELElBQUEsQ0FBQWxELElBQUEsSUFBQUwsT0FBQSxDQUFBckUsS0FBQSxZQUFBeUcsT0FBQSxDQUFBcEMsT0FBQSxDQUFBckUsS0FBQSxFQUFBdUUsSUFBQSxDQUFBbUQsS0FBQSxFQUFBQyxNQUFBO0FBQUEsU0FBQUcsa0JBQUFDLEVBQUEsNkJBQUFDLElBQUEsU0FBQUMsSUFBQSxHQUFBdkksU0FBQSxhQUFBK0csT0FBQSxXQUFBcEMsT0FBQSxFQUFBb0QsTUFBQSxRQUFBRCxHQUFBLEdBQUFPLEVBQUEsQ0FBQUcsS0FBQSxDQUFBRixJQUFBLEVBQUFDLElBQUEsWUFBQVAsTUFBQTFILEtBQUEsSUFBQXVILGtCQUFBLENBQUFDLEdBQUEsRUFBQW5ELE9BQUEsRUFBQW9ELE1BQUEsRUFBQUMsS0FBQSxFQUFBQyxNQUFBLFVBQUEzSCxLQUFBLGNBQUEySCxPQUFBUSxHQUFBLElBQUFaLGtCQUFBLENBQUFDLEdBQUEsRUFBQW5ELE9BQUEsRUFBQW9ELE1BQUEsRUFBQUMsS0FBQSxFQUFBQyxNQUFBLFdBQUFRLEdBQUEsS0FBQVQsS0FBQSxDQUFBOUgsU0FBQTtBQUQrQzs7QUFFL0M7QUFDQSxJQUFNd0kscUJBQXFCLEdBQUcsQ0FBQ3pLLFFBQVEsQ0FBQ3lCLGFBQWEsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFFO0FBQzdFO0FBQ0EsSUFBTWlKLGNBQWMsR0FBRyxDQUFDMUssUUFBUSxDQUFDMEIsZ0JBQWdCLENBQUMsbUJBQW1CLENBQUMsQ0FBQztBQUN2RTtBQUNBLElBQU1pSixlQUFlLEdBQUcsQ0FBQyxJQUFJekssOERBQVEsQ0FBQyxvQkFBb0IsRUFBQyxtQkFBbUIsQ0FBQyxDQUFDO0FBRWhGdUsscUJBQXFCLENBQUM3SixPQUFPLENBQUMsVUFBQ0MsUUFBUSxFQUFFK0osS0FBSyxFQUFHO0VBQzdDL0osUUFBUSxDQUFDSCxnQkFBZ0IsQ0FBQyxRQUFRLEVBQUVpSyxlQUFlLENBQUNDLEtBQUssQ0FBQyxDQUFDakosTUFBTSxDQUFDLENBQUMsQ0FBQztBQUN4RSxDQUFDLENBQUM7QUFFRitJLGNBQWMsQ0FBQzlKLE9BQU8sQ0FBQyxVQUFDUCxVQUFVLEVBQUV1SyxLQUFLLEVBQUs7RUFDMUN2SyxVQUFVLENBQUNPLE9BQU8sQ0FBQyxVQUFDQyxRQUFRLEVBQUc7SUFDM0JBLFFBQVEsQ0FBQ0gsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQU07TUFDckNpSyxlQUFlLENBQUNDLEtBQUssQ0FBQyxDQUFDakosTUFBTSxDQUFDLENBQUM7TUFDL0JnSixlQUFlLENBQUNDLEtBQUssQ0FBQyxDQUFDQyxhQUFhLENBQUMsQ0FBQztJQUMxQyxDQUFDLENBQUM7RUFDTixDQUFDLENBQUM7QUFDTixDQUFDLENBQUM7O0FBRUY7QUFDQTtBQUNBOztBQUVBLElBQU1DLGFBQWEsR0FBRyxDQUFDOUssUUFBUSxDQUFDQyxjQUFjLENBQUMsUUFBUSxDQUFDLENBQUM7QUFDekQsSUFBTThLLFlBQVksR0FBRyxDQUFDL0ssUUFBUSxDQUFDQyxjQUFjLENBQUMsY0FBYyxDQUFDLENBQUM7QUFDOUQsSUFBTStLLG1CQUFtQixHQUFHLENBQUNoTCxRQUFRLENBQUNDLGNBQWMsQ0FBQyxlQUFlLENBQUMsQ0FBQztBQUN0RSxJQUFNZ0wsb0JBQW9CLEdBQUcsQ0FBQ2pMLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLGdCQUFnQixDQUFDLENBQUM7QUFFeEU2SyxhQUFhLENBQUNsSyxPQUFPLENBQUMsVUFBQ3NLLE1BQU0sRUFBRU4sS0FBSyxFQUFHO0VBQ25DTSxNQUFNLENBQUN4SyxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUMsWUFBSztJQUNqQ3FLLFlBQVksQ0FBQ0gsS0FBSyxDQUFDLENBQUNwSSxTQUFTLENBQUNrQixNQUFNLENBQUMsUUFBUSxDQUFDO0lBRTlDc0gsbUJBQW1CLENBQUNKLEtBQUssQ0FBQyxDQUFDbEssZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQU07TUFDbkRxSyxZQUFZLENBQUNILEtBQUssQ0FBQyxDQUFDcEksU0FBUyxDQUFDQyxHQUFHLENBQUMsUUFBUSxDQUFDO0lBQ25ELENBQUMsQ0FBQztJQUVGd0ksb0JBQW9CLENBQUNMLEtBQUssQ0FBQyxDQUFDbEssZ0JBQWdCLENBQUMsT0FBTyxlQUFBeUosaUJBQUEsZUFBQXhHLG1CQUFBLEdBQUE4RSxJQUFBLENBQUUsU0FBQTBDLFFBQUE7TUFBQSxJQUFBQyxJQUFBO01BQUEsT0FBQXpILG1CQUFBLEdBQUFxQixJQUFBLFVBQUFxRyxTQUFBQyxRQUFBO1FBQUEsa0JBQUFBLFFBQUEsQ0FBQXBDLElBQUEsR0FBQW9DLFFBQUEsQ0FBQTdELElBQUE7VUFBQTtZQUN4QzJELElBQUksR0FBR1QsZUFBZSxDQUFDQyxLQUFLLENBQUMsQ0FBQ0MsYUFBYSxDQUFDLENBQUM7WUFDbkR2SixPQUFPLENBQUNDLEdBQUcsQ0FBQzZKLElBQUksQ0FBQztZQUFDRSxRQUFBLENBQUE3RCxJQUFBO1lBQUEsT0FDWjhELEtBQUssQ0FBQyxrQkFBa0IsRUFBQztjQUMzQnZFLE1BQU0sRUFBRSxNQUFNO2NBQ2R3RSxPQUFPLEVBQUU7Z0JBQ0wsY0FBYyxFQUFFO2NBQ3BCLENBQUM7Y0FFREMsSUFBSSxFQUFFQyxJQUFJLENBQUNDLFNBQVMsQ0FBQ1AsSUFBSTtZQUM3QixDQUFDLENBQUMsQ0FDRHhFLElBQUksQ0FBQyxVQUFBZ0YsUUFBUSxFQUFJO2NBQ2QsSUFBR0EsUUFBUSxDQUFDQyxFQUFFLEVBQUM7Z0JBQ1g5SSxNQUFNLENBQUNFLFFBQVEsQ0FBQzZJLE1BQU0sQ0FBQyxJQUFJLENBQUM7Y0FDaEMsQ0FBQyxNQUNHO2dCQUNBeEssT0FBTyxDQUFDNEksS0FBSyxDQUFDLDRDQUE0QyxDQUFDO2NBQy9EO1lBQ0osQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFBQSxLQUFLLEVBQUc7Y0FDWDVJLE9BQU8sQ0FBQzRJLEtBQUssQ0FBQyw0Q0FBNEMsRUFBRUEsS0FBSyxDQUFDO1lBQ3RFLENBQUMsQ0FBQztVQUFBO1lBRUY2QixZQUFZLENBQUN2SixTQUFTLENBQUNDLEdBQUcsQ0FBQyxRQUFRLENBQUM7VUFBQztVQUFBO1lBQUEsT0FBQTZJLFFBQUEsQ0FBQWpDLElBQUE7UUFBQTtNQUFBLEdBQUE4QixPQUFBO0lBQUEsQ0FFNUMsR0FBQztFQUNOLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7QUNsRUYsU0FBU2EsY0FBY0EsQ0FBQ0MsVUFBVSxFQUFFO0VBQ2hDbkksTUFBTSxDQUFDaUYsSUFBSSxDQUFDa0QsVUFBVSxDQUFDLENBQUNyTCxPQUFPLENBQUMsVUFBQ3dCLEdBQUcsRUFBSztJQUNyQ1csTUFBTSxDQUFDWCxHQUFHLENBQUMsR0FBRzZKLFVBQVUsQ0FBQzdKLEdBQUcsQ0FBQztFQUNqQyxDQUFDLENBQUM7QUFDTjs7Ozs7Ozs7Ozs7Ozs7O0FDSjBDOztBQUUxQztBQUM4QztBQUNWO0FBRXBDOEosMERBQXFCLENBQUM7RUFDbEJoSixTQUFTLEVBQVRBLDREQUFTO0VBQ1R0QixJQUFJLEVBQUpBLHVEQUFJQTtBQUNSLENBQUMsQ0FBQzs7Ozs7Ozs7Ozs7QUNURiIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudC9DaGVja2JveC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L0xpbmsuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2NvbXBvbmVudC9OYXZUb2dnbGUuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2hhbmRsZUNoZWNrYm94LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9oZWxwZXIvZ2xvYmFsLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3MiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gYXNzZXRzL2FwcC5qc1xuaW1wb3J0ICd0YWlsd2luZGNzcy9iYXNlLmNzcyc7XG5pbXBvcnQgJ3RhaWx3aW5kY3NzL2NvbXBvbmVudHMuY3NzJztcbmltcG9ydCAndGFpbHdpbmRjc3MvdXRpbGl0aWVzLmNzcyc7XG5pbXBvcnQgUmVhY3QgZnJvbSAncmVhY3QnO1xuaW1wb3J0IFJlYWN0RE9NIGZyb20gJ3JlYWN0LWRvbSc7XG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XG5pbXBvcnQgJy4vanMvaW5kZXguanMnO1xuaW1wb3J0ICcuL2pzL2hhbmRsZUNoZWNrYm94LmpzJztcbi8vaW1wb3J0ICcvanMvaGFuZGxlTW9kYWwuanM7J1xuXG5cbmNvbnN0IFBheW1lbnRzTGlzdCA9ICgpID0+IHtcbiAgcmV0dXJuIChcbiAgICA8ZGl2PlxuICAgICAgPGgxIGNsYXNzTmFtZT1cInRleHQtNHhsIGZvbnQtYm9sZCB0ZXh0LWNlbnRlclwiPlBheW1lbnRzIExpc3Q8L2gxPlxuICAgIDwvZGl2PlxuICApO1xufTtcblxuXG5SZWFjdERPTS5yZW5kZXIoPFBheW1lbnRzTGlzdCAvPiwgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3BheW1lbnRyb290JykpO1xuXG5cbiIsIi8qY29uc3QgcHJvZHVjdENoZWNrYm94ZXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcucHJvZHVjdC1jaGVja2JveCcpO1xuY29uc3QgY2hlY2tib3hGb3JBbGxQcm9kdWN0cyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5wcm9kdWN0cy1jaGVja2JveCcpO1xuXG5jb25zdCBkZWxldGVCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGVsZXRlJyk7XG5jb25zdCBtb2RhbF9kZWxldGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbW9kYWxfZGVsZXRlJyk7XG5jb25zdCBjYW5jZWxEZWxldGVCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY2FuY2VsRGVsZXRlJyk7XG5jb25zdCBjb25maXJtRGVsZXRlQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbmZpcm1EZWxldGUnKTtcbi8vY29jaGUgb3UgZGVjb2NoZSBsZXMgY2hlY2tib3ggZW4gZm9uY3Rpb24gZGUgbGEgY2hlY2tib3ggcXVpIHNlbGVjdGlvbm5lIHRvdXRcbiovXG5jbGFzcyBDaGVja2JveHtcbiAgICBjb25zdHJ1Y3RvcihjaGVja2JveEZvckFsbCwgY2hlY2tib3hlcyl7XG4gICAgICAgIHRoaXMuY2hlY2tib3hTZWxlY3RBbGwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKGNoZWNrYm94Rm9yQWxsKTtcbiAgICAgICAgdGhpcy5jaGVja2JveGVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChjaGVja2JveGVzKTtcbiAgICAgICAgdGhpcy5vbkluaXQoKTtcbiAgICB9XG5cbiAgICBvbkluaXQgPSgpPT57XG4gICAgICAgIHRoaXMuY2hlY2tib3hTZWxlY3RBbGwuYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgdGhpcy5zZWxlY3RBbGxDaGVja0JveGVzKTtcblxuICAgICAgICB0aGlzLmNoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgICAgICAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCB0aGlzLnNlbGVjdEFsbENoZWNrQm94ZXMpO1xuICAgICAgICB9KTtcblxuICAgIH1cblxuICAgIHNlbGVjdEFsbENoZWNrQm94ZXMgPSgpPT57XG4gICAgICAgIGNvbnN0IGNsaWNrZWRDaGVja0JveCA9IGV2ZW50LnRhcmdldDtcblxuICAgICAgICBpZihjbGlja2VkQ2hlY2tCb3ggPT0gdGhpcy5jaGVja2JveFNlbGVjdEFsbCAmJiBjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgICAgICB0aGlzLmNoZWNrYm94ZXMuZm9yRWFjaCgoY2hlY2tib3gpID0+IHtcbiAgICAgICAgICAgICAgICBpZighY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgICAgIGNoZWNrYm94LmNoZWNrZWQgPSB0cnVlO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgICAgIGVsc2UgaWYoY2xpY2tlZENoZWNrQm94ID09IHRoaXMuY2hlY2tib3hTZWxlY3RBbGwgJiYgIWNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgICAgIGlmKGNoZWNrYm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgICAgICBjaGVja2JveC5jaGVja2VkID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICAgICAgZWxzZSBpZihjbGlja2VkQ2hlY2tCb3ggIT0gdGhpcy5jaGVja2JveFNlbGVjdEFsbCAmJiAhY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgaWYodGhpcy5jaGVja2JveFNlbGVjdEFsbC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICB0aGlzLmNoZWNrYm94U2VsZWN0QWxsLmNoZWNrZWQgPSBmYWxzZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgIFxuICAgIH1cblxuICAgIGdldFByb2R1Y3RzSUQgPSgpPT57XG4gICAgICAgIGxldCBwcm9kdWN0c0lEID0gW107XG4gICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgIHByb2R1Y3RzSUQucHVzaChwYXJzZUludChjaGVja2JveC5nZXRBdHRyaWJ1dGUoJ25hbWUnKSkpO1xuICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyh0eXBlb2YgcGFyc2VJbnQoY2hlY2tib3guZ2V0QXR0cmlidXRlKCduYW1lJykpKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgcmV0dXJuIHByb2R1Y3RzSUQ7XG4gICAgfVxuXG59XG5cbmV4cG9ydCBkZWZhdWx0IENoZWNrYm94O1xuXG4vKlxuZnVuY3Rpb24gc2VsZWN0QWxsQ2hlY2tCb3hlcygpe1xuICAgIGNvbnN0IGNsaWNrZWRDaGVja0JveCA9IGV2ZW50LnRhcmdldDtcblxuICAgIGlmKGNsaWNrZWRDaGVja0JveCA9PSBjaGVja2JveEZvckFsbFByb2R1Y3RzKXtcbiAgICAgICAgXG4gICAgICAgIGlmKGNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgICAgIC8vYWN0aXZlIGxlIGJvdXRvbiBzdXBwcmltZXJcblxuICAgICAgICAgICAgcHJvZHVjdENoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgICAgICAgICAgICAgaWYoIWNoZWNrYm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgICAgICBjaGVja2JveC5jaGVja2VkID0gdHJ1ZTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICB9XG4gICAgICAgIGVsc2V7XG5cbiAgICAgICAgICAgIHByb2R1Y3RDaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgICAgIGlmKGNoZWNrYm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgICAgICBjaGVja2JveC5jaGVja2VkID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICB9XG4gICAgZWxzZXtcbiAgICAgICAgaWYoIWNsaWNrZWRDaGVja0JveC5jaGVja2VkICYmIGNoZWNrYm94Rm9yQWxsUHJvZHVjdHMuY2hlY2tlZCl7XG4gICAgICAgICAgICBjaGVja2JveEZvckFsbFByb2R1Y3RzLmNoZWNrZWQgPSBmYWxzZTtcbiAgICAgICAgfVxuICAgIH1cbiAgICBjaGVja0RlbGV0ZUJ1dHRvblN0YXRlKGNsaWNrZWRDaGVja0JveCk7XG5cbn1cblxuZnVuY3Rpb24gY2hlY2tEZWxldGVCdXR0b25TdGF0ZShjbGlja2VkQ2hlY2tCb3gpe1xuICAgIGlmKGNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgZGVsZXRlQnV0dG9uLmRpc2FibGVkID0gZmFsc2U7XG4gICAgfVxuICAgIGVsc2UgaWYgKCFjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgIGxldCBjbXB0ID0gMDtcbiAgICAgICAgcHJvZHVjdENoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgICAgICAgICBpZighY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgY21wdCsrO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYoY21wdCA9PT0gcHJvZHVjdENoZWNrYm94ZXMubGVuZ3RoKXtcbiAgICAgICAgICAgICAgICBkZWxldGVCdXR0b24uZGlzYWJsZWQgPSB0cnVlO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgZWxzZXtcbiAgICAgICAgICAgICAgICBkZWxldGVCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICl9XG4gICAgICBcbn1cblxuLy9NZXR0cmUgZGFucyB1bmUgbGlzdGUgbCdpZCBkZXMgcHJvZHVpdHMgcXVpIG9udCBldGUgc2VsZWN0aW9ubmVzXG5mdW5jdGlvbiBnZXRDaGVja0JveFByb2R1Y3RJRCgpe1xuICAgIGxldCBwcm9kdWN0c0lEID0gW107XG5cbiAgICAgICAgcHJvZHVjdENoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgICAgICAgICBpZiAoY2hlY2tib3guY2hlY2tlZCkge1xuICAgICAgICAgICAgICAgIHByb2R1Y3RzSUQucHVzaChjaGVja2JveC5wcm9kdWN0SWQpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgICAgcmV0dXJuIHByb2R1Y3RzSUQ7XG59XG4vLyBBZmZpY2hlciBsYSBtb2RhbGVcbmRlbGV0ZUJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICBtb2RhbF9kZWxldGUuY2xhc3NMaXN0LnJlbW92ZSgnaGlkZGVuJyk7XG59KTtcblxuY2FuY2VsRGVsZXRlQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgIG1vZGFsX2RlbGV0ZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbn0pO1xuXG5cbmNvbmZpcm1EZWxldGVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgY29uc3QgcHJvZHVjdHNJRCA9IGdldENoZWNrQm94UHJvZHVjdElEKCk7XG4gICAgZmV0Y2goJy9kZWxldGUnLHtcbiAgICAgICAgbWV0aG9kOiAnUE9TVCcsXG4gICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICdDb250ZW50LVR5cGUnOiAnYXBwbGljYXRpb24vanNvbidcbiAgICAgICAgfSxcblxuICAgICAgICBib2R5OiBKU09OLnN0cmluZ2lmeSh7cHJvZHVjdHNJRH0pXG4gICAgfSlcblxuICAgIG1vZGFsX2RlbGV0ZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbn0pO1xuXG5jaGVja2JveEZvckFsbFByb2R1Y3RzLmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHNlbGVjdEFsbENoZWNrQm94ZXMpO1xuXG5wcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBzZWxlY3RBbGxDaGVja0JveGVzKTtcbn0pO1xuXG4qLyIsImNsYXNzIExpbmsge1xuICAgIGNvbnN0cnVjdG9yKHNlbGVjdG9yLCBuZXdUYWIgPSBmYWxzZSkge1xuICAgICAgICB0aGlzLmxpbmsgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKHNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uZXdUYWIgPSBuZXdUYWI7XG4gICAgICAgIHRoaXMuaW5pdCgpO1xuICAgIH1cblxuICAgIGluaXQoKSB7XG4gICAgICAgIHRoaXMuaW5pdENsYXNzZXMoKTtcbiAgICAgICAgdGhpcy5hdHRhY2hFdmVudCgpO1xuICAgIH1cblxuICAgIGluaXRDbGFzc2VzKCkge1xuICAgICAgICB0aGlzLmxpbmsuZm9yRWFjaChsaW5rID0+IHtcbiAgICAgICAgICAgIGxpbmsuY2xhc3NMaXN0LmFkZCgnY3Vyc29yLXBvaW50ZXInKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgYXR0YWNoRXZlbnQoKSB7XG4gICAgICAgIHRoaXMubGluay5mb3JFYWNoKGxpbmsgPT4ge1xuICAgICAgICAgICAgbGluay5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHRoaXMub3BlbkxpbmsobGluaykpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBvcGVuTGluayhlKSB7XG4gICAgICAgIGNvbnN0IHVybCA9IGUuZGF0YXNldC5ocmVmO1xuICAgICAgICBpZiAodGhpcy5uZXdUYWIpIHtcbiAgICAgICAgICAgIHJldHVybiB3aW5kb3cub3Blbih1cmwsICdfYmxhbmsnKTtcbiAgICAgICAgfVxuICAgICAgICB3aW5kb3cubG9jYXRpb24gPSB1cmw7XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBMaW5rOyIsImNsYXNzIE5hdlRvZ2dsZSB7XG4gICAgY29uc3RydWN0b3IodG9nZ2xlU2VsZWN0b3IsIG5hdlNlbGVjdG9yKSB7XG4gICAgICAgIHRoaXMubmF2VG9nZ2xlID0gZG9jdW1lbnQucXVlcnlTZWxlY3Rvcih0b2dnbGVTZWxlY3Rvcik7XG4gICAgICAgIHRoaXMubmF2ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihuYXZTZWxlY3Rvcik7XG4gICAgICAgIHRoaXMubmF2VG9nZ2xlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4gdGhpcy50b2dnbGUoKSk7XG4gICAgfVxuXG4gICAgdG9nZ2xlKCkge1xuICAgICAgICBjb25zdCBpc09wZW4gPSB0aGlzLm5hdi5nZXRBdHRyaWJ1dGUoJ2RhdGEtb3BlbicpID09PSAndHJ1ZSc7XG4gICAgICAgIHRoaXMubmF2LnNldEF0dHJpYnV0ZSgnZGF0YS1vcGVuJywgIWlzT3Blbik7XG4gICAgICAgIGlmIChpc09wZW4pIHtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5yZW1vdmUoJ21sLTAnKTtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5hZGQoJ21sLVstMThyZW1dJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QuYWRkKCdtbC0wJyk7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QucmVtb3ZlKCdtbC1bLTE4cmVtXScpO1xuICAgICAgICB9XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBOYXZUb2dnbGU7IiwiaW1wb3J0IENoZWNrYm94IGZyb20gJy4vY29tcG9uZW50L0NoZWNrYm94LmpzJztcblxuLy9vbiByw6ljdXDDqHJlIGxhIGNhc2UgcGVybWV0dGFudCBkZSBjb2NoZXIgdG91dGVzIGxlcyBhdXRyZXMgY2FzZXMgZXQgb24gbGUgbWV0IGRhbnMgbGUgdGFibGVhdVxuY29uc3QgY2hlY2tib3hTZWxlY3RBbGxMaXN0ID0gW2RvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5wcm9kdWN0cy1jaGVja2JveCcpIF07XG4vL29uIHLDqWN1cMOocmUgbGVzIGNhc2VzIMOgIGNvY2hlciAobGllciBhIHVuIGVsZW1lbnQpIGV0IG9uIGxlIG1ldCBkYW5zIGxlIHRhYmxlYXVcbmNvbnN0IGNoZWNrYm94ZXNMaXN0ID0gW2RvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5wcm9kdWN0LWNoZWNrYm94JyldO1xuLy9vbiBjcsOpZSB1biBvYmpldCBDaGVja2JveFxuY29uc3QgY2hlY2tib3hPYmplY3RzID0gW25ldyBDaGVja2JveCgnLnByb2R1Y3RzLWNoZWNrYm94JywnLnByb2R1Y3QtY2hlY2tib3gnKV07XG5cbmNoZWNrYm94U2VsZWN0QWxsTGlzdC5mb3JFYWNoKChjaGVja2JveCwgaW5kZXgpPT57XG4gICAgY2hlY2tib3guYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgY2hlY2tib3hPYmplY3RzW2luZGV4XS5vbkluaXQoKSk7XG59KVxuXG5jaGVja2JveGVzTGlzdC5mb3JFYWNoKChjaGVja2JveGVzLCBpbmRleCkgPT4ge1xuICAgIGNoZWNrYm94ZXMuZm9yRWFjaCgoY2hlY2tib3gpPT57XG4gICAgICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICAgICAgY2hlY2tib3hPYmplY3RzW2luZGV4XS5vbkluaXQoKTtcbiAgICAgICAgICAgIGNoZWNrYm94T2JqZWN0c1tpbmRleF0uZ2V0UHJvZHVjdHNJRCgpO1xuICAgICAgICB9KTtcbiAgICB9KVxufSlcblxuLyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqICovXG4vKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKipERUxFVEUgQUNUSU9OUyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiogKi9cbi8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiAqL1xuXG5jb25zdCBkZWxldGVCdXR0b25zID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkZWxldGUnKV07XG5jb25zdCBkZWxldGVNb2RhbHMgPSBbZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21vZGFsX2RlbGV0ZScpXTtcbmNvbnN0IGNhbmNlbERlbGV0ZUJ1dHRvbnMgPSBbZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NhbmNlbF9kZWxldGUnKV07XG5jb25zdCBjb25maXJtRGVsZXRlQnV0dG9ucyA9IFtkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY29uZmlybV9kZWxldGUnKV07XG5cbmRlbGV0ZUJ1dHRvbnMuZm9yRWFjaCgoYnV0dG9uLCBpbmRleCk9PntcbiAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCgpID0+e1xuICAgICAgICBkZWxldGVNb2RhbHNbaW5kZXhdLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xuICAgICAgICBcbiAgICAgICAgY2FuY2VsRGVsZXRlQnV0dG9uc1tpbmRleF0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgICAgICAgICAgICAgZGVsZXRlTW9kYWxzW2luZGV4XS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgY29uZmlybURlbGV0ZUJ1dHRvbnNbaW5kZXhdLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgYXN5bmMgKCkgPT4ge1xuICAgICAgICAgICAgICAgIGNvbnN0IGxpc3QgPSBjaGVja2JveE9iamVjdHNbaW5kZXhdLmdldFByb2R1Y3RzSUQoKTtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhsaXN0KTtcbiAgICAgICAgICAgICAgICBhd2FpdCBmZXRjaCgnL3Byb2R1Y3RzL2RlbGV0ZScse1xuICAgICAgICAgICAgICAgICAgICBtZXRob2Q6ICdQT1NUJyxcbiAgICAgICAgICAgICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgXG4gICAgICAgICAgICAgICAgICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KGxpc3QpXG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAudGhlbihyZXNwb25zZSA9PiB7XG4gICAgICAgICAgICAgICAgICAgIGlmKHJlc3BvbnNlLm9rKXtcbiAgICAgICAgICAgICAgICAgICAgICAgIHdpbmRvdy5sb2NhdGlvbi5yZWxvYWQodHJ1ZSk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgZWxzZXtcbiAgICAgICAgICAgICAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoJ0VycmV1ciBsb3JzIGRlIGxhIHN1cHByZXNpb24gZGVzIHByb2R1aXRzLicpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICAuY2F0Y2goZXJyb3IgPT57XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoJ0VycmV1ciBsb3JzIGRlIGxhIHJlcXXDqnRlIGRlIHN1cHByZXNpb24gOiAnLCBlcnJvcik7XG4gICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICBtb2RhbF9kZWxldGUuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG5cbiAgICAgICAgfSk7XG4gICAgfSk7XG59KVxuXG5cbiIsImZ1bmN0aW9uIGF0dGFjaFRvV2luZG93KGNvbXBvbmVudHMpIHtcbiAgICBPYmplY3Qua2V5cyhjb21wb25lbnRzKS5mb3JFYWNoKChrZXkpID0+IHtcbiAgICAgICAgd2luZG93W2tleV0gPSBjb21wb25lbnRzW2tleV07XG4gICAgfSk7XG59XG5cbmV4cG9ydCB7IFxuICAgIGF0dGFjaFRvV2luZG93LFxufTsiLCJpbXBvcnQgKiBhcyBoZWxwZXIgZnJvbSBcIi4vaGVscGVyL2dsb2JhbFwiO1xuXG4vLyBJbXBvcnQgYWxsIGF2YWlsYWJsZSBjb21wb25lbnRzXG5pbXBvcnQgTmF2VG9nZ2xlIGZyb20gXCIuL2NvbXBvbmVudC9OYXZUb2dnbGVcIjtcbmltcG9ydCBMaW5rIGZyb20gXCIuL2NvbXBvbmVudC9MaW5rXCI7XG5cbmhlbHBlci5hdHRhY2hUb1dpbmRvdyh7XG4gICAgTmF2VG9nZ2xlLFxuICAgIExpbmssXG59KTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiXSwibmFtZXMiOlsiUmVhY3QiLCJSZWFjdERPTSIsIlBheW1lbnRzTGlzdCIsImNyZWF0ZUVsZW1lbnQiLCJjbGFzc05hbWUiLCJyZW5kZXIiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwiQ2hlY2tib3giLCJfY3JlYXRlQ2xhc3MiLCJjaGVja2JveEZvckFsbCIsImNoZWNrYm94ZXMiLCJfdGhpcyIsIl9jbGFzc0NhbGxDaGVjayIsIl9kZWZpbmVQcm9wZXJ0eSIsImNoZWNrYm94U2VsZWN0QWxsIiwiYWRkRXZlbnRMaXN0ZW5lciIsInNlbGVjdEFsbENoZWNrQm94ZXMiLCJmb3JFYWNoIiwiY2hlY2tib3giLCJjbGlja2VkQ2hlY2tCb3giLCJldmVudCIsInRhcmdldCIsImNoZWNrZWQiLCJwcm9kdWN0c0lEIiwicHVzaCIsInBhcnNlSW50IiwiZ2V0QXR0cmlidXRlIiwiY29uc29sZSIsImxvZyIsIl90eXBlb2YiLCJxdWVyeVNlbGVjdG9yIiwicXVlcnlTZWxlY3RvckFsbCIsIm9uSW5pdCIsIkxpbmsiLCJzZWxlY3RvciIsIm5ld1RhYiIsImFyZ3VtZW50cyIsImxlbmd0aCIsInVuZGVmaW5lZCIsImxpbmsiLCJpbml0Iiwia2V5IiwidmFsdWUiLCJpbml0Q2xhc3NlcyIsImF0dGFjaEV2ZW50IiwiY2xhc3NMaXN0IiwiYWRkIiwib3BlbkxpbmsiLCJlIiwidXJsIiwiZGF0YXNldCIsImhyZWYiLCJ3aW5kb3ciLCJvcGVuIiwibG9jYXRpb24iLCJOYXZUb2dnbGUiLCJ0b2dnbGVTZWxlY3RvciIsIm5hdlNlbGVjdG9yIiwibmF2VG9nZ2xlIiwibmF2IiwidG9nZ2xlIiwiaXNPcGVuIiwic2V0QXR0cmlidXRlIiwicmVtb3ZlIiwiX3JlZ2VuZXJhdG9yUnVudGltZSIsInQiLCJyIiwiT2JqZWN0IiwicHJvdG90eXBlIiwibiIsImhhc093blByb3BlcnR5IiwibyIsImRlZmluZVByb3BlcnR5IiwiaSIsIlN5bWJvbCIsImEiLCJpdGVyYXRvciIsImMiLCJhc3luY0l0ZXJhdG9yIiwidSIsInRvU3RyaW5nVGFnIiwiZGVmaW5lIiwiZW51bWVyYWJsZSIsImNvbmZpZ3VyYWJsZSIsIndyaXRhYmxlIiwid3JhcCIsIkdlbmVyYXRvciIsImNyZWF0ZSIsIkNvbnRleHQiLCJtYWtlSW52b2tlTWV0aG9kIiwidHJ5Q2F0Y2giLCJ0eXBlIiwiYXJnIiwiY2FsbCIsImgiLCJsIiwiZiIsInMiLCJ5IiwiR2VuZXJhdG9yRnVuY3Rpb24iLCJHZW5lcmF0b3JGdW5jdGlvblByb3RvdHlwZSIsInAiLCJkIiwiZ2V0UHJvdG90eXBlT2YiLCJ2IiwidmFsdWVzIiwiZyIsImRlZmluZUl0ZXJhdG9yTWV0aG9kcyIsIl9pbnZva2UiLCJBc3luY0l0ZXJhdG9yIiwiaW52b2tlIiwicmVzb2x2ZSIsIl9fYXdhaXQiLCJ0aGVuIiwiY2FsbEludm9rZVdpdGhNZXRob2RBbmRBcmciLCJFcnJvciIsImRvbmUiLCJtZXRob2QiLCJkZWxlZ2F0ZSIsIm1heWJlSW52b2tlRGVsZWdhdGUiLCJzZW50IiwiX3NlbnQiLCJkaXNwYXRjaEV4Y2VwdGlvbiIsImFicnVwdCIsIlR5cGVFcnJvciIsInJlc3VsdE5hbWUiLCJuZXh0IiwibmV4dExvYyIsInB1c2hUcnlFbnRyeSIsInRyeUxvYyIsImNhdGNoTG9jIiwiZmluYWxseUxvYyIsImFmdGVyTG9jIiwidHJ5RW50cmllcyIsInJlc2V0VHJ5RW50cnkiLCJjb21wbGV0aW9uIiwicmVzZXQiLCJpc05hTiIsImRpc3BsYXlOYW1lIiwiaXNHZW5lcmF0b3JGdW5jdGlvbiIsImNvbnN0cnVjdG9yIiwibmFtZSIsIm1hcmsiLCJzZXRQcm90b3R5cGVPZiIsIl9fcHJvdG9fXyIsImF3cmFwIiwiYXN5bmMiLCJQcm9taXNlIiwia2V5cyIsInJldmVyc2UiLCJwb3AiLCJwcmV2IiwiY2hhckF0Iiwic2xpY2UiLCJzdG9wIiwicnZhbCIsImhhbmRsZSIsImNvbXBsZXRlIiwiZmluaXNoIiwiX2NhdGNoIiwiZGVsZWdhdGVZaWVsZCIsImFzeW5jR2VuZXJhdG9yU3RlcCIsImdlbiIsInJlamVjdCIsIl9uZXh0IiwiX3Rocm93IiwiaW5mbyIsImVycm9yIiwiX2FzeW5jVG9HZW5lcmF0b3IiLCJmbiIsInNlbGYiLCJhcmdzIiwiYXBwbHkiLCJlcnIiLCJjaGVja2JveFNlbGVjdEFsbExpc3QiLCJjaGVja2JveGVzTGlzdCIsImNoZWNrYm94T2JqZWN0cyIsImluZGV4IiwiZ2V0UHJvZHVjdHNJRCIsImRlbGV0ZUJ1dHRvbnMiLCJkZWxldGVNb2RhbHMiLCJjYW5jZWxEZWxldGVCdXR0b25zIiwiY29uZmlybURlbGV0ZUJ1dHRvbnMiLCJidXR0b24iLCJfY2FsbGVlIiwibGlzdCIsIl9jYWxsZWUkIiwiX2NvbnRleHQiLCJmZXRjaCIsImhlYWRlcnMiLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsInJlc3BvbnNlIiwib2siLCJyZWxvYWQiLCJtb2RhbF9kZWxldGUiLCJhdHRhY2hUb1dpbmRvdyIsImNvbXBvbmVudHMiLCJoZWxwZXIiXSwic291cmNlUm9vdCI6IiJ9
