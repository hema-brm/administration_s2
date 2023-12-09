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
/* harmony import */ var _js_modal_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./js/modal.js */ "./assets/js/modal.js");
/* harmony import */ var _js_modal_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_js_modal_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _js_handle_checkbox_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./js/handle_checkbox.js */ "./assets/js/handle_checkbox.js");
/* harmony import */ var _js_handle_checkbox_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_js_handle_checkbox_js__WEBPACK_IMPORTED_MODULE_8__);
// assets/app.js






// any CSS you import will output into a single css file (app.css in this case)




var PaymentsList = function PaymentsList() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("div", null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement("h1", {
    className: "text-4xl font-bold text-center"
  }, "Payments List"));
};
react_dom__WEBPACK_IMPORTED_MODULE_4__.render( /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_3___default().createElement(PaymentsList, null), document.getElementById('paymentroot'));

/***/ }),

/***/ "./assets/js/component/Link.js":
/*!*************************************!*\
  !*** ./assets/js/component/Link.js ***!
  \*************************************/
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

/***/ "./assets/js/handle_checkbox.js":
/*!**************************************!*\
  !*** ./assets/js/handle_checkbox.js ***!
  \**************************************/
/***/ (() => {

// Récupérer toutes les cases à cocher des produits
var productCheckboxes = document.querySelectorAll('.product-checkbox');
var checkboxForAllProducts = document.querySelector('.products-checkbox');
var deleteButton = document.getElementById('delete');
var modal_delete = document.getElementById('modal_delete');
var cancelDeleteButton = document.getElementById('cancelDelete');
var confirmDeleteButton = document.getElementById('confirmDelete');
//coche ou decoche les checkbox en fonction de la checkbox qui selectionne tout
function selectAllCheckBoxes() {
  var clickedCheckBox = event.target;
  if (clickedCheckBox == checkboxForAllProducts) {
    if (clickedCheckBox.checked) {
      //active le bouton supprimer

      productCheckboxes.forEach(function (checkbox) {
        if (!checkbox.checked) {
          checkbox.checked = true;
        }
      });
    } else {
      productCheckboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          checkbox.checked = false;
        }
      });
    }
  } else {
    if (!clickedCheckBox.checked && checkboxForAllProducts.checked) {
      checkboxForAllProducts.checked = false;
    }
  }
  checkDeleteButtonState(clickedCheckBox);
}
function checkDeleteButtonState(clickedCheckBox) {
  if (clickedCheckBox.checked) {
    deleteButton.disabled = false;
  } else if (!clickedCheckBox.checked) {
    var cmpt = 0;
    productCheckboxes.forEach(function (checkbox) {
      if (!checkbox.checked) {
        cmpt++;
      }
      if (cmpt === productCheckboxes.length) {
        deleteButton.disabled = true;
      } else {
        deleteButton.disabled = false;
      }
    });
  }
}

//Mettre dans une liste l'id des produits qui ont ete selectionnes
function getCheckBoxProductID() {
  var productsID = [];
  productCheckboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      productsID.push(checkbox.productId);
    }
  });
  return productsID;
}
// Afficher la modale
deleteButton.addEventListener('click', function () {
  modal_delete.classList.remove('hidden');
});
cancelDeleteButton.addEventListener('click', function () {
  modal_delete.classList.add('hidden');
});
confirmDeleteButton.addEventListener('click', function () {
  var productsID = getCheckBoxProductID();
  fetch('/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      productsID: productsID
    })
  });
  modal_delete.classList.add('hidden');
});
checkboxForAllProducts.addEventListener('change', selectAllCheckBoxes);
productCheckboxes.forEach(function (checkbox) {
  checkbox.addEventListener('change', selectAllCheckBoxes);
});

/***/ }),

/***/ "./assets/js/helper/global.js":
/*!************************************!*\
  !*** ./assets/js/helper/global.js ***!
  \************************************/
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
/* harmony import */ var _helper_global__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./helper/global */ "./assets/js/helper/global.js");
/* harmony import */ var _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./component/NavToggle */ "./assets/js/component/NavToggle.js");
/* harmony import */ var _component_Link__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./component/Link */ "./assets/js/component/Link.js");


// Import all available components


_helper_global__WEBPACK_IMPORTED_MODULE_0__.attachToWindow({
  NavToggle: _component_NavToggle__WEBPACK_IMPORTED_MODULE_1__["default"],
  Link: _component_Link__WEBPACK_IMPORTED_MODULE_2__["default"]
});

/***/ }),

/***/ "./assets/js/modal.js":
/*!****************************!*\
  !*** ./assets/js/modal.js ***!
  \****************************/
/***/ (() => {

// Récupérer les éléments HTML de la modale et des boutons
var openModalButton = document.getElementById('category_open_button');
var closeModalButton = document.getElementById('category_close_button');
var modal = document.getElementById('category_modal');

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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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Q0FBQ3dCLE1BQU0sQ0FBQyxRQUFRLENBQUM7QUFDcEM7O0FBRUE7QUFDQSxTQUFTa0MsVUFBVUEsQ0FBQSxFQUFHO0VBQ2xCRixLQUFLLENBQUN4RCxTQUFTLENBQUNDLEdBQUcsQ0FBQyxRQUFRLENBQUM7QUFDakM7O0FBRUE7QUFDQXFELGVBQWUsQ0FBQ25ELGdCQUFnQixDQUFDLE9BQU8sRUFBRXNELFNBQVMsQ0FBQzs7QUFFcEQ7QUFDQUYsZ0JBQWdCLENBQUNwRCxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUV1RCxVQUFVLENBQUM7Ozs7Ozs7Ozs7OztBQ25CdEQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnQvTGluay5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L05hdlRvZ2dsZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGFuZGxlX2NoZWNrYm94LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9oZWxwZXIvZ2xvYmFsLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbW9kYWwuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuY3NzPzZiZTYiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gYXNzZXRzL2FwcC5qc1xuaW1wb3J0ICd0YWlsd2luZGNzcy9iYXNlLmNzcyc7XG5pbXBvcnQgJ3RhaWx3aW5kY3NzL2NvbXBvbmVudHMuY3NzJztcbmltcG9ydCAndGFpbHdpbmRjc3MvdXRpbGl0aWVzLmNzcyc7XG5pbXBvcnQgUmVhY3QgZnJvbSAncmVhY3QnO1xuaW1wb3J0IFJlYWN0RE9NIGZyb20gJ3JlYWN0LWRvbSc7XG5cbi8vIGFueSBDU1MgeW91IGltcG9ydCB3aWxsIG91dHB1dCBpbnRvIGEgc2luZ2xlIGNzcyBmaWxlIChhcHAuY3NzIGluIHRoaXMgY2FzZSlcbmltcG9ydCAnLi9zdHlsZXMvYXBwLmNzcyc7XG5pbXBvcnQgJy4vanMvaW5kZXguanMnO1xuaW1wb3J0ICcuL2pzL21vZGFsLmpzJztcbmltcG9ydCAnLi9qcy9oYW5kbGVfY2hlY2tib3guanMnO1xuXG5jb25zdCBQYXltZW50c0xpc3QgPSAoKSA9PiB7XG4gIHJldHVybiAoXG4gICAgPGRpdj5cbiAgICAgIDxoMSBjbGFzc05hbWU9XCJ0ZXh0LTR4bCBmb250LWJvbGQgdGV4dC1jZW50ZXJcIj5QYXltZW50cyBMaXN0PC9oMT5cbiAgICA8L2Rpdj5cbiAgKTtcbn07XG5cblxuUmVhY3RET00ucmVuZGVyKDxQYXltZW50c0xpc3QgLz4sIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwYXltZW50cm9vdCcpKTtcblxuXG4iLCJjbGFzcyBMaW5rIHtcbiAgICBjb25zdHJ1Y3RvcihzZWxlY3RvciwgbmV3VGFiID0gZmFsc2UpIHtcbiAgICAgICAgdGhpcy5saW5rID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbChzZWxlY3Rvcik7XG4gICAgICAgIHRoaXMubmV3VGFiID0gbmV3VGFiO1xuICAgICAgICB0aGlzLmluaXQoKTtcbiAgICB9XG5cbiAgICBpbml0KCkge1xuICAgICAgICB0aGlzLmluaXRDbGFzc2VzKCk7XG4gICAgICAgIHRoaXMuYXR0YWNoRXZlbnQoKTtcbiAgICB9XG5cbiAgICBpbml0Q2xhc3NlcygpIHtcbiAgICAgICAgdGhpcy5saW5rLmZvckVhY2gobGluayA9PiB7XG4gICAgICAgICAgICBsaW5rLmNsYXNzTGlzdC5hZGQoJ2N1cnNvci1wb2ludGVyJyk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIGF0dGFjaEV2ZW50KCkge1xuICAgICAgICB0aGlzLmxpbmsuZm9yRWFjaChsaW5rID0+IHtcbiAgICAgICAgICAgIGxpbmsuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBlID0+IHtcbiAgICAgICAgICAgICAgICBpZiAoZS50YXJnZXQubm9kZU5hbWUgPT09ICdUUicgfHwgZS50YXJnZXQubm9kZU5hbWUgPT09ICdURCcpIHtcbiAgICAgICAgICAgICAgICAgICAgdGhpcy5vcGVuTGluayhsaW5rKTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgb3BlbkxpbmsoZSkge1xuICAgICAgICBjb25zdCB1cmwgPSBlLmRhdGFzZXQuaHJlZjtcbiAgICAgICAgaWYgKHRoaXMubmV3VGFiKSB7XG4gICAgICAgICAgICByZXR1cm4gd2luZG93Lm9wZW4odXJsLCAnX2JsYW5rJyk7XG4gICAgICAgIH1cbiAgICAgICAgd2luZG93LmxvY2F0aW9uID0gdXJsO1xuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgTGluazsiLCJjbGFzcyBOYXZUb2dnbGUge1xuICAgIGNvbnN0cnVjdG9yKHRvZ2dsZVNlbGVjdG9yLCBuYXZTZWxlY3Rvcikge1xuICAgICAgICB0aGlzLm5hdlRvZ2dsZSA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IodG9nZ2xlU2VsZWN0b3IpO1xuICAgICAgICB0aGlzLm5hdiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IobmF2U2VsZWN0b3IpO1xuICAgICAgICB0aGlzLm5hdlRvZ2dsZS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHRoaXMudG9nZ2xlKCkpO1xuICAgIH1cblxuICAgIHRvZ2dsZSgpIHtcbiAgICAgICAgY29uc3QgaXNPcGVuID0gdGhpcy5uYXYuZ2V0QXR0cmlidXRlKCdkYXRhLW9wZW4nKSA9PT0gJ3RydWUnO1xuICAgICAgICB0aGlzLm5hdi5zZXRBdHRyaWJ1dGUoJ2RhdGEtb3BlbicsICFpc09wZW4pO1xuICAgICAgICBpZiAoaXNPcGVuKSB7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QucmVtb3ZlKCdtbC0wJyk7XG4gICAgICAgICAgICB0aGlzLm5hdi5jbGFzc0xpc3QuYWRkKCdtbC1bLTE4cmVtXScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LmFkZCgnbWwtMCcpO1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LnJlbW92ZSgnbWwtWy0xOHJlbV0nKTtcbiAgICAgICAgfVxuICAgIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgTmF2VG9nZ2xlOyIsIi8vIFLDqWN1cMOpcmVyIHRvdXRlcyBsZXMgY2FzZXMgw6AgY29jaGVyIGRlcyBwcm9kdWl0c1xuY29uc3QgcHJvZHVjdENoZWNrYm94ZXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCcucHJvZHVjdC1jaGVja2JveCcpO1xuY29uc3QgY2hlY2tib3hGb3JBbGxQcm9kdWN0cyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5wcm9kdWN0cy1jaGVja2JveCcpO1xuXG5jb25zdCBkZWxldGVCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGVsZXRlJyk7XG5jb25zdCBtb2RhbF9kZWxldGUgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbW9kYWxfZGVsZXRlJyk7XG5jb25zdCBjYW5jZWxEZWxldGVCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY2FuY2VsRGVsZXRlJyk7XG5jb25zdCBjb25maXJtRGVsZXRlQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbmZpcm1EZWxldGUnKTtcbi8vY29jaGUgb3UgZGVjb2NoZSBsZXMgY2hlY2tib3ggZW4gZm9uY3Rpb24gZGUgbGEgY2hlY2tib3ggcXVpIHNlbGVjdGlvbm5lIHRvdXRcbmZ1bmN0aW9uIHNlbGVjdEFsbENoZWNrQm94ZXMoKXtcbiAgICBjb25zdCBjbGlja2VkQ2hlY2tCb3ggPSBldmVudC50YXJnZXQ7XG5cbiAgICBpZihjbGlja2VkQ2hlY2tCb3ggPT0gY2hlY2tib3hGb3JBbGxQcm9kdWN0cyl7XG4gICAgICAgIFxuICAgICAgICBpZihjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgICAgICAvL2FjdGl2ZSBsZSBib3V0b24gc3VwcHJpbWVyXG5cbiAgICAgICAgICAgIHByb2R1Y3RDaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgICAgIGlmKCFjaGVja2JveC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICAgICAgY2hlY2tib3guY2hlY2tlZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG5cbiAgICAgICAgfVxuICAgICAgICBlbHNle1xuXG4gICAgICAgICAgICBwcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICAgICAgICAgICAgICBpZihjaGVja2JveC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICAgICAgY2hlY2tib3guY2hlY2tlZCA9IGZhbHNlO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfVxuICAgIGVsc2V7XG4gICAgICAgIGlmKCFjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCAmJiBjaGVja2JveEZvckFsbFByb2R1Y3RzLmNoZWNrZWQpe1xuICAgICAgICAgICAgY2hlY2tib3hGb3JBbGxQcm9kdWN0cy5jaGVja2VkID0gZmFsc2U7XG4gICAgICAgIH1cbiAgICB9XG4gICAgY2hlY2tEZWxldGVCdXR0b25TdGF0ZShjbGlja2VkQ2hlY2tCb3gpO1xuXG59XG5cbmZ1bmN0aW9uIGNoZWNrRGVsZXRlQnV0dG9uU3RhdGUoY2xpY2tlZENoZWNrQm94KXtcbiAgICBpZihjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgIGRlbGV0ZUJ1dHRvbi5kaXNhYmxlZCA9IGZhbHNlO1xuICAgIH1cbiAgICBlbHNlIGlmICghY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICBsZXQgY21wdCA9IDA7XG4gICAgICAgIHByb2R1Y3RDaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgaWYoIWNoZWNrYm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgIGNtcHQrKztcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmKGNtcHQgPT09IHByb2R1Y3RDaGVja2JveGVzLmxlbmd0aCl7XG4gICAgICAgICAgICAgICAgZGVsZXRlQnV0dG9uLmRpc2FibGVkID0gdHJ1ZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGVsc2V7XG4gICAgICAgICAgICAgICAgZGVsZXRlQnV0dG9uLmRpc2FibGVkID0gZmFsc2U7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICApfVxuICAgICAgXG59XG5cbi8vTWV0dHJlIGRhbnMgdW5lIGxpc3RlIGwnaWQgZGVzIHByb2R1aXRzIHF1aSBvbnQgZXRlIHNlbGVjdGlvbm5lc1xuZnVuY3Rpb24gZ2V0Q2hlY2tCb3hQcm9kdWN0SUQoKXtcbiAgICBsZXQgcHJvZHVjdHNJRCA9IFtdO1xuXG4gICAgICAgIHByb2R1Y3RDaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgaWYgKGNoZWNrYm94LmNoZWNrZWQpIHtcbiAgICAgICAgICAgICAgICBwcm9kdWN0c0lELnB1c2goY2hlY2tib3gucHJvZHVjdElkKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgIHJldHVybiBwcm9kdWN0c0lEO1xuICAgIFxuXG59XG4vLyBBZmZpY2hlciBsYSBtb2RhbGVcbmRlbGV0ZUJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICBtb2RhbF9kZWxldGUuY2xhc3NMaXN0LnJlbW92ZSgnaGlkZGVuJyk7XG59KTtcblxuY2FuY2VsRGVsZXRlQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgIG1vZGFsX2RlbGV0ZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbn0pO1xuXG5cbmNvbmZpcm1EZWxldGVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgY29uc3QgcHJvZHVjdHNJRCA9IGdldENoZWNrQm94UHJvZHVjdElEKCk7XG4gICAgZmV0Y2goJy9kZWxldGUnLHtcbiAgICAgICAgbWV0aG9kOiAnUE9TVCcsXG4gICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICdDb250ZW50LVR5cGUnOiAnYXBwbGljYXRpb24vanNvbidcbiAgICAgICAgfSxcblxuICAgICAgICBib2R5OiBKU09OLnN0cmluZ2lmeSh7cHJvZHVjdHNJRH0pXG4gICAgfSlcblxuICAgIG1vZGFsX2RlbGV0ZS5jbGFzc0xpc3QuYWRkKCdoaWRkZW4nKTtcbn0pO1xuXG5jaGVja2JveEZvckFsbFByb2R1Y3RzLmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHNlbGVjdEFsbENoZWNrQm94ZXMpO1xuXG5wcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBzZWxlY3RBbGxDaGVja0JveGVzKTtcbn0pO1xuXG4iLCJmdW5jdGlvbiBhdHRhY2hUb1dpbmRvdyhjb21wb25lbnRzKSB7XG4gICAgT2JqZWN0LmtleXMoY29tcG9uZW50cykuZm9yRWFjaCgoa2V5KSA9PiB7XG4gICAgICAgIHdpbmRvd1trZXldID0gY29tcG9uZW50c1trZXldO1xuICAgIH0pO1xufVxuXG5leHBvcnQgeyBcbiAgICBhdHRhY2hUb1dpbmRvdyxcbn07IiwiaW1wb3J0ICogYXMgaGVscGVyIGZyb20gXCIuL2hlbHBlci9nbG9iYWxcIjtcblxuLy8gSW1wb3J0IGFsbCBhdmFpbGFibGUgY29tcG9uZW50c1xuaW1wb3J0IE5hdlRvZ2dsZSBmcm9tIFwiLi9jb21wb25lbnQvTmF2VG9nZ2xlXCI7XG5pbXBvcnQgTGluayBmcm9tIFwiLi9jb21wb25lbnQvTGlua1wiO1xuXG5oZWxwZXIuYXR0YWNoVG9XaW5kb3coe1xuICAgIE5hdlRvZ2dsZSxcbiAgICBMaW5rLFxufSk7IiwiLy8gUsOpY3Vww6lyZXIgbGVzIMOpbMOpbWVudHMgSFRNTCBkZSBsYSBtb2RhbGUgZXQgZGVzIGJvdXRvbnNcbmNvbnN0IG9wZW5Nb2RhbEJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjYXRlZ29yeV9vcGVuX2J1dHRvbicpO1xuY29uc3QgY2xvc2VNb2RhbEJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjYXRlZ29yeV9jbG9zZV9idXR0b24nKTtcbmNvbnN0IG1vZGFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NhdGVnb3J5X21vZGFsJyk7XG5cbi8vIEZvbmN0aW9uIHBvdXIgb3V2cmlyIGxhIG1vZGFsZVxuZnVuY3Rpb24gb3Blbk1vZGFsKCkge1xuICAgIG1vZGFsLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xufVxuXG4vLyBGb25jdGlvbiBwb3VyIGZlcm1lciBsYSBtb2RhbGVcbmZ1bmN0aW9uIGNsb3NlTW9kYWwoKSB7XG4gICAgbW9kYWwuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG59XG5cbi8vIMOJY291dGVyIGxlcyBjbGljcyBzdXIgbGUgYm91dG9uIFwiT3V2cmlyIGxhIG1vZGFsZVwiIHBvdXIgYWZmaWNoZXIgbGEgbW9kYWxlXG5vcGVuTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBvcGVuTW9kYWwpO1xuXG4vLyDDiWNvdXRlciBsZXMgY2xpY3Mgc3VyIGxlIGJvdXRvbiBcIkZlcm1lciBsYSBtb2RhbGVcIiBwb3VyIGNhY2hlciBsYSBtb2RhbGVcbmNsb3NlTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBjbG9zZU1vZGFsKTtcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJSZWFjdCIsIlJlYWN0RE9NIiwiUGF5bWVudHNMaXN0IiwiY3JlYXRlRWxlbWVudCIsImNsYXNzTmFtZSIsInJlbmRlciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJMaW5rIiwic2VsZWN0b3IiLCJuZXdUYWIiLCJhcmd1bWVudHMiLCJsZW5ndGgiLCJ1bmRlZmluZWQiLCJfY2xhc3NDYWxsQ2hlY2siLCJsaW5rIiwicXVlcnlTZWxlY3RvckFsbCIsImluaXQiLCJfY3JlYXRlQ2xhc3MiLCJrZXkiLCJ2YWx1ZSIsImluaXRDbGFzc2VzIiwiYXR0YWNoRXZlbnQiLCJmb3JFYWNoIiwiY2xhc3NMaXN0IiwiYWRkIiwiX3RoaXMiLCJhZGRFdmVudExpc3RlbmVyIiwiZSIsInRhcmdldCIsIm5vZGVOYW1lIiwib3BlbkxpbmsiLCJ1cmwiLCJkYXRhc2V0IiwiaHJlZiIsIndpbmRvdyIsIm9wZW4iLCJsb2NhdGlvbiIsIk5hdlRvZ2dsZSIsInRvZ2dsZVNlbGVjdG9yIiwibmF2U2VsZWN0b3IiLCJuYXZUb2dnbGUiLCJxdWVyeVNlbGVjdG9yIiwibmF2IiwidG9nZ2xlIiwiaXNPcGVuIiwiZ2V0QXR0cmlidXRlIiwic2V0QXR0cmlidXRlIiwicmVtb3ZlIiwicHJvZHVjdENoZWNrYm94ZXMiLCJjaGVja2JveEZvckFsbFByb2R1Y3RzIiwiZGVsZXRlQnV0dG9uIiwibW9kYWxfZGVsZXRlIiwiY2FuY2VsRGVsZXRlQnV0dG9uIiwiY29uZmlybURlbGV0ZUJ1dHRvbiIsInNlbGVjdEFsbENoZWNrQm94ZXMiLCJjbGlja2VkQ2hlY2tCb3giLCJldmVudCIsImNoZWNrZWQiLCJjaGVja2JveCIsImNoZWNrRGVsZXRlQnV0dG9uU3RhdGUiLCJkaXNhYmxlZCIsImNtcHQiLCJnZXRDaGVja0JveFByb2R1Y3RJRCIsInByb2R1Y3RzSUQiLCJwdXNoIiwicHJvZHVjdElkIiwiZmV0Y2giLCJtZXRob2QiLCJoZWFkZXJzIiwiYm9keSIsIkpTT04iLCJzdHJpbmdpZnkiLCJhdHRhY2hUb1dpbmRvdyIsImNvbXBvbmVudHMiLCJPYmplY3QiLCJrZXlzIiwiaGVscGVyIiwib3Blbk1vZGFsQnV0dG9uIiwiY2xvc2VNb2RhbEJ1dHRvbiIsIm1vZGFsIiwib3Blbk1vZGFsIiwiY2xvc2VNb2RhbCJdLCJzb3VyY2VSb290IjoiIn0=