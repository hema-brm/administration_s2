(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var tailwindcss_base_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tailwindcss/base.css */ "./node_modules/tailwindcss/base.css");
/* harmony import */ var tailwindcss_components_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tailwindcss/components.css */ "./node_modules/tailwindcss/components.css");
/* harmony import */ var tailwindcss_utilities_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tailwindcss/utilities.css */ "./node_modules/tailwindcss/utilities.css");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-dom */ "./node_modules/react-dom/index.js");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_index_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./js/index.js */ "./assets/js/index.js");
/* harmony import */ var _js_modal_product_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/modal_product.js */ "./assets/js/modal_product.js");
/* harmony import */ var _js_modal_product_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_js_modal_product_js__WEBPACK_IMPORTED_MODULE_7__);
// assets/app.js






// any CSS you import will output into a single css file (app.css in this case)



var PaymentsList = function PaymentsList() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("h1", {
    className: "text-4xl font-bold text-center"
  }, "Payments List"));
};
react_dom__WEBPACK_IMPORTED_MODULE_4__.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(PaymentsList, null), document.getElementById('paymentroot'));

/***/ }),

/***/ "./assets/js/component/NavToggle.js":
/*!******************************************!*\
  !*** ./assets/js/component/NavToggle.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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

/***/ "./assets/js/helper.js":
/*!*****************************!*\
  !*** ./assets/js/helper.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _helper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helper */ "./assets/js/helper.js");
/* harmony import */ var _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./component/NavToggle */ "./assets/js/component/NavToggle.js");


// Import all available components

_helper__WEBPACK_IMPORTED_MODULE_0__.attachToWindow({
  NavToggle: _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__["default"]
});

/***/ }),

/***/ "./assets/js/modal_product.js":
/*!************************************!*\
  !*** ./assets/js/modal_product.js ***!
  \************************************/
/***/ (() => {

// Récupérer les éléments HTML de la modale et des boutons
var openModalButton = document.getElementById('openModal');
var closeModalButton = document.getElementById('closeModal');
var modal = document.getElementById('modal');

// Fonction pour ouvrir la modale
function openModal() {
  modal.classList.remove('hidden');
}

// Fonction pour fermer la modale
function closeModal() {
  modal.classList.add('hidden');
}

// Écouter les clics sur le bouton "Ouvrir la modale" pour afficher la modale
openModalButton.addEventListener('click', openModal);

// Écouter les clics sur le bouton "Fermer la modale" pour cacher la modale
closeModalButton.addEventListener('click', closeModal);

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LENBQUNaLFNBQVMsQ0FBQ0UsR0FBRyxDQUFDLFFBQVEsQ0FBQztBQUNqQzs7QUFFQTtBQUNBUSxlQUFlLENBQUNsQixnQkFBZ0IsQ0FBQyxPQUFPLEVBQUVxQixTQUFTLENBQUM7O0FBRXBEO0FBQ0FGLGdCQUFnQixDQUFDbkIsZ0JBQWdCLENBQUMsT0FBTyxFQUFFc0IsVUFBVSxDQUFDOzs7Ozs7Ozs7Ozs7QUNuQnREIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L05hdlRvZ2dsZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGVscGVyLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbW9kYWxfcHJvZHVjdC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/NmJlNiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBhc3NldHMvYXBwLmpzXG5pbXBvcnQgJ3RhaWx3aW5kY3NzL2Jhc2UuY3NzJztcbmltcG9ydCAndGFpbHdpbmRjc3MvY29tcG9uZW50cy5jc3MnO1xuaW1wb3J0ICd0YWlsd2luZGNzcy91dGlsaXRpZXMuY3NzJztcbmltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5pbXBvcnQgUmVhY3RET00gZnJvbSAncmVhY3QtZG9tJztcblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcbmltcG9ydCAnLi9qcy9pbmRleC5qcyc7XG5pbXBvcnQgJy4vanMvbW9kYWxfcHJvZHVjdC5qcyc7XG5cbmNvbnN0IFBheW1lbnRzTGlzdCA9ICgpID0+IHtcbiAgcmV0dXJuIChcbiAgICA8ZGl2PlxuICAgICAgPGgxIGNsYXNzTmFtZT1cInRleHQtNHhsIGZvbnQtYm9sZCB0ZXh0LWNlbnRlclwiPlBheW1lbnRzIExpc3Q8L2gxPlxuICAgIDwvZGl2PlxuICApO1xufTtcblxuXG5SZWFjdERPTS5yZW5kZXIoPFBheW1lbnRzTGlzdCAvPiwgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3BheW1lbnRyb290JykpO1xuXG5cbiIsImNsYXNzIE5hdlRvZ2dsZSB7XG4gICAgY29uc3RydWN0b3IodG9nZ2xlU2VsZWN0b3IsIG5hdlNlbGVjdG9yKSB7XG4gICAgICAgIHRoaXMubmF2VG9nZ2xlID0gZG9jdW1lbnQucXVlcnlTZWxlY3Rvcih0b2dnbGVTZWxlY3Rvcik7XG4gICAgICAgIHRoaXMubmF2ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihuYXZTZWxlY3Rvcik7XG4gICAgICAgIHRoaXMubmF2VG9nZ2xlLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4gdGhpcy50b2dnbGUoKSk7XG4gICAgfVxuXG4gICAgdG9nZ2xlKCkge1xuICAgICAgICBjb25zdCBpc09wZW4gPSB0aGlzLm5hdi5nZXRBdHRyaWJ1dGUoJ2RhdGEtb3BlbicpID09PSAndHJ1ZSc7XG4gICAgICAgIHRoaXMubmF2LnNldEF0dHJpYnV0ZSgnZGF0YS1vcGVuJywgIWlzT3Blbik7XG4gICAgICAgIGlmIChpc09wZW4pIHtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5yZW1vdmUoJ21sLTAnKTtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5hZGQoJ21sLVstMThyZW1dJyk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QuYWRkKCdtbC0wJyk7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QucmVtb3ZlKCdtbC1bLTE4cmVtXScpO1xuICAgICAgICB9XG4gICAgfVxufVxuXG5leHBvcnQgZGVmYXVsdCBOYXZUb2dnbGU7IiwiZnVuY3Rpb24gYXR0YWNoVG9XaW5kb3coY29tcG9uZW50cykge1xuICAgIE9iamVjdC5rZXlzKGNvbXBvbmVudHMpLmZvckVhY2goKGtleSkgPT4ge1xuICAgICAgICB3aW5kb3dba2V5XSA9IGNvbXBvbmVudHNba2V5XTtcbiAgICB9KTtcbn1cblxuZXhwb3J0IHsgXG4gICAgYXR0YWNoVG9XaW5kb3csXG59OyIsImltcG9ydCAqIGFzIGhlbHBlciBmcm9tIFwiLi9oZWxwZXJcIjtcblxuLy8gSW1wb3J0IGFsbCBhdmFpbGFibGUgY29tcG9uZW50c1xuaW1wb3J0IE5hdlRvZ2dsZSBmcm9tIFwiLi9jb21wb25lbnQvTmF2VG9nZ2xlXCI7XG5cbmhlbHBlci5hdHRhY2hUb1dpbmRvdyh7XG4gICAgTmF2VG9nZ2xlLFxufSk7IiwiLy8gUsOpY3Vww6lyZXIgbGVzIMOpbMOpbWVudHMgSFRNTCBkZSBsYSBtb2RhbGUgZXQgZGVzIGJvdXRvbnNcbmNvbnN0IG9wZW5Nb2RhbEJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvcGVuTW9kYWwnKTtcbmNvbnN0IGNsb3NlTW9kYWxCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY2xvc2VNb2RhbCcpO1xuY29uc3QgbW9kYWwgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbW9kYWwnKTtcblxuLy8gRm9uY3Rpb24gcG91ciBvdXZyaXIgbGEgbW9kYWxlXG5mdW5jdGlvbiBvcGVuTW9kYWwoKSB7XG4gICAgbW9kYWwuY2xhc3NMaXN0LnJlbW92ZSgnaGlkZGVuJyk7XG59XG5cbi8vIEZvbmN0aW9uIHBvdXIgZmVybWVyIGxhIG1vZGFsZVxuZnVuY3Rpb24gY2xvc2VNb2RhbCgpIHtcbiAgICBtb2RhbC5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbn1cblxuLy8gw4ljb3V0ZXIgbGVzIGNsaWNzIHN1ciBsZSBib3V0b24gXCJPdXZyaXIgbGEgbW9kYWxlXCIgcG91ciBhZmZpY2hlciBsYSBtb2RhbGVcbm9wZW5Nb2RhbEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIG9wZW5Nb2RhbCk7XG5cbi8vIMOJY291dGVyIGxlcyBjbGljcyBzdXIgbGUgYm91dG9uIFwiRmVybWVyIGxhIG1vZGFsZVwiIHBvdXIgY2FjaGVyIGxhIG1vZGFsZVxuY2xvc2VNb2RhbEJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGNsb3NlTW9kYWwpO1xuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbIlJlYWN0IiwiUmVhY3RET00iLCJQYXltZW50c0xpc3QiLCJjcmVhdGVFbGVtZW50IiwiY2xhc3NOYW1lIiwicmVuZGVyIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIk5hdlRvZ2dsZSIsInRvZ2dsZVNlbGVjdG9yIiwibmF2U2VsZWN0b3IiLCJfdGhpcyIsIl9jbGFzc0NhbGxDaGVjayIsIm5hdlRvZ2dsZSIsInF1ZXJ5U2VsZWN0b3IiLCJuYXYiLCJhZGRFdmVudExpc3RlbmVyIiwidG9nZ2xlIiwiX2NyZWF0ZUNsYXNzIiwia2V5IiwidmFsdWUiLCJpc09wZW4iLCJnZXRBdHRyaWJ1dGUiLCJzZXRBdHRyaWJ1dGUiLCJjbGFzc0xpc3QiLCJyZW1vdmUiLCJhZGQiLCJhdHRhY2hUb1dpbmRvdyIsImNvbXBvbmVudHMiLCJPYmplY3QiLCJrZXlzIiwiZm9yRWFjaCIsIndpbmRvdyIsImhlbHBlciIsIm9wZW5Nb2RhbEJ1dHRvbiIsImNsb3NlTW9kYWxCdXR0b24iLCJtb2RhbCIsIm9wZW5Nb2RhbCIsImNsb3NlTW9kYWwiXSwic291cmNlUm9vdCI6IiJ9