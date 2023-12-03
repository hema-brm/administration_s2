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
        link.addEventListener('click', function () {
          return _this.openLink(link);
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUFDQW9ELGVBQWUsQ0FBQ2xELGdCQUFnQixDQUFDLE9BQU8sRUFBRXFELFNBQVMsQ0FBQzs7QUFFcEQ7QUFDQUYsZ0JBQWdCLENBQUNuRCxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUVzRCxVQUFVLENBQUM7Ozs7Ozs7Ozs7OztBQ25CdEQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnQvTGluay5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L05hdlRvZ2dsZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGFuZGxlX2NoZWNrYm94LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9oZWxwZXIvZ2xvYmFsLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9pbmRleC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvbW9kYWxfcHJvZHVjdC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/NmJlNiJdLCJzb3VyY2VzQ29udGVudCI6WyIvLyBhc3NldHMvYXBwLmpzXG5pbXBvcnQgJ3RhaWx3aW5kY3NzL2Jhc2UuY3NzJztcbmltcG9ydCAndGFpbHdpbmRjc3MvY29tcG9uZW50cy5jc3MnO1xuaW1wb3J0ICd0YWlsd2luZGNzcy91dGlsaXRpZXMuY3NzJztcbmltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5pbXBvcnQgUmVhY3RET00gZnJvbSAncmVhY3QtZG9tJztcblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcbmltcG9ydCAnLi9qcy9pbmRleC5qcyc7XG5pbXBvcnQgJy4vanMvbW9kYWxfcHJvZHVjdC5qcyc7XG5pbXBvcnQgJy4vanMvaGFuZGxlX2NoZWNrYm94LmpzJztcblxuY29uc3QgUGF5bWVudHNMaXN0ID0gKCkgPT4ge1xuICByZXR1cm4gKFxuICAgIDxkaXY+XG4gICAgICA8aDEgY2xhc3NOYW1lPVwidGV4dC00eGwgZm9udC1ib2xkIHRleHQtY2VudGVyXCI+UGF5bWVudHMgTGlzdDwvaDE+XG4gICAgPC9kaXY+XG4gICk7XG59O1xuXG5cblJlYWN0RE9NLnJlbmRlcig8UGF5bWVudHNMaXN0IC8+LCBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncGF5bWVudHJvb3QnKSk7XG5cblxuIiwiY2xhc3MgTGluayB7XG4gICAgY29uc3RydWN0b3Ioc2VsZWN0b3IsIG5ld1RhYiA9IGZhbHNlKSB7XG4gICAgICAgIHRoaXMubGluayA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3IpO1xuICAgICAgICB0aGlzLm5ld1RhYiA9IG5ld1RhYjtcbiAgICAgICAgdGhpcy5pbml0KCk7XG4gICAgfVxuXG4gICAgaW5pdCgpIHtcbiAgICAgICAgdGhpcy5pbml0Q2xhc3NlcygpO1xuICAgICAgICB0aGlzLmF0dGFjaEV2ZW50KCk7XG4gICAgfVxuXG4gICAgaW5pdENsYXNzZXMoKSB7XG4gICAgICAgIHRoaXMubGluay5mb3JFYWNoKGxpbmsgPT4ge1xuICAgICAgICAgICAgbGluay5jbGFzc0xpc3QuYWRkKCdjdXJzb3ItcG9pbnRlcicpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhdHRhY2hFdmVudCgpIHtcbiAgICAgICAgdGhpcy5saW5rLmZvckVhY2gobGluayA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4gdGhpcy5vcGVuTGluayhsaW5rKSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIG9wZW5MaW5rKGUpIHtcbiAgICAgICAgY29uc3QgdXJsID0gZS5kYXRhc2V0LmhyZWY7XG4gICAgICAgIGlmICh0aGlzLm5ld1RhYikge1xuICAgICAgICAgICAgcmV0dXJuIHdpbmRvdy5vcGVuKHVybCwgJ19ibGFuaycpO1xuICAgICAgICB9XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9IHVybDtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IExpbms7IiwiY2xhc3MgTmF2VG9nZ2xlIHtcbiAgICBjb25zdHJ1Y3Rvcih0b2dnbGVTZWxlY3RvciwgbmF2U2VsZWN0b3IpIHtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHRvZ2dsZVNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKG5hdlNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB0aGlzLnRvZ2dsZSgpKTtcbiAgICB9XG5cbiAgICB0b2dnbGUoKSB7XG4gICAgICAgIGNvbnN0IGlzT3BlbiA9IHRoaXMubmF2LmdldEF0dHJpYnV0ZSgnZGF0YS1vcGVuJykgPT09ICd0cnVlJztcbiAgICAgICAgdGhpcy5uYXYuc2V0QXR0cmlidXRlKCdkYXRhLW9wZW4nLCAhaXNPcGVuKTtcbiAgICAgICAgaWYgKGlzT3Blbikge1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LnJlbW92ZSgnbWwtMCcpO1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LmFkZCgnbWwtWy0xOHJlbV0nKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5hZGQoJ21sLTAnKTtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5yZW1vdmUoJ21sLVstMThyZW1dJyk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IE5hdlRvZ2dsZTsiLCIvLyBSw6ljdXDDqXJlciB0b3V0ZXMgbGVzIGNhc2VzIMOgIGNvY2hlciBkZXMgcHJvZHVpdHNcbmNvbnN0IHByb2R1Y3RDaGVja2JveGVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnByb2R1Y3QtY2hlY2tib3gnKTtcbmNvbnN0IGNoZWNrYm94Rm9yQWxsUHJvZHVjdHMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcucHJvZHVjdHMtY2hlY2tib3gnKTtcblxuY29uc3QgZGVsZXRlQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlbGV0ZScpO1xuY29uc3QgbW9kYWxfZGVsZXRlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21vZGFsX2RlbGV0ZScpO1xuY29uc3QgY2FuY2VsRGVsZXRlQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NhbmNlbERlbGV0ZScpO1xuY29uc3QgY29uZmlybURlbGV0ZUJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjb25maXJtRGVsZXRlJyk7XG4vL2NvY2hlIG91IGRlY29jaGUgbGVzIGNoZWNrYm94IGVuIGZvbmN0aW9uIGRlIGxhIGNoZWNrYm94IHF1aSBzZWxlY3Rpb25uZSB0b3V0XG5mdW5jdGlvbiBzZWxlY3RBbGxDaGVja0JveGVzKCl7XG4gICAgY29uc3QgY2xpY2tlZENoZWNrQm94ID0gZXZlbnQudGFyZ2V0O1xuXG4gICAgaWYoY2xpY2tlZENoZWNrQm94ID09IGNoZWNrYm94Rm9yQWxsUHJvZHVjdHMpe1xuICAgICAgICBcbiAgICAgICAgaWYoY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgLy9hY3RpdmUgbGUgYm91dG9uIHN1cHByaW1lclxuXG4gICAgICAgICAgICBwcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICAgICAgICAgICAgICBpZighY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgICAgIGNoZWNrYm94LmNoZWNrZWQgPSB0cnVlO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgIH1cbiAgICAgICAgZWxzZXtcblxuICAgICAgICAgICAgcHJvZHVjdENoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgICAgIGNoZWNrYm94LmNoZWNrZWQgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgIH1cbiAgICBlbHNle1xuICAgICAgICBpZighY2xpY2tlZENoZWNrQm94LmNoZWNrZWQgJiYgY2hlY2tib3hGb3JBbGxQcm9kdWN0cy5jaGVja2VkKXtcbiAgICAgICAgICAgIGNoZWNrYm94Rm9yQWxsUHJvZHVjdHMuY2hlY2tlZCA9IGZhbHNlO1xuICAgICAgICB9XG4gICAgfVxuICAgIGNoZWNrRGVsZXRlQnV0dG9uU3RhdGUoY2xpY2tlZENoZWNrQm94KTtcblxufVxuXG5mdW5jdGlvbiBjaGVja0RlbGV0ZUJ1dHRvblN0YXRlKGNsaWNrZWRDaGVja0JveCl7XG4gICAgaWYoY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICBkZWxldGVCdXR0b24uZGlzYWJsZWQgPSBmYWxzZTtcbiAgICB9XG4gICAgZWxzZSBpZiAoIWNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgbGV0IGNtcHQgPSAwO1xuICAgICAgICBwcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICAgICAgICAgIGlmKCFjaGVja2JveC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICBjbXB0Kys7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZihjbXB0ID09PSBwcm9kdWN0Q2hlY2tib3hlcy5sZW5ndGgpe1xuICAgICAgICAgICAgICAgIGRlbGV0ZUJ1dHRvbi5kaXNhYmxlZCA9IHRydWU7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBlbHNle1xuICAgICAgICAgICAgICAgIGRlbGV0ZUJ1dHRvbi5kaXNhYmxlZCA9IGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgKX1cbiAgICAgIFxufVxuXG4vL01ldHRyZSBkYW5zIHVuZSBsaXN0ZSBsJ2lkIGRlcyBwcm9kdWl0cyBxdWkgb250IGV0ZSBzZWxlY3Rpb25uZXNcbmZ1bmN0aW9uIGdldENoZWNrQm94UHJvZHVjdElEKCl7XG4gICAgbGV0IHByb2R1Y3RzSUQgPSBbXTtcblxuICAgICAgICBwcm9kdWN0Q2hlY2tib3hlcy5mb3JFYWNoKGNoZWNrYm94ID0+IHtcbiAgICAgICAgICAgIGlmIChjaGVja2JveC5jaGVja2VkKSB7XG4gICAgICAgICAgICAgICAgcHJvZHVjdHNJRC5wdXNoKGNoZWNrYm94LnByb2R1Y3RJZCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICByZXR1cm4gcHJvZHVjdHNJRDtcbiAgICBcblxufVxuLy8gQWZmaWNoZXIgbGEgbW9kYWxlXG5kZWxldGVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB7XG4gICAgbW9kYWxfZGVsZXRlLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xufSk7XG5cbmNhbmNlbERlbGV0ZUJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsICgpID0+IHtcbiAgICBtb2RhbF9kZWxldGUuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG59KTtcblxuXG5jb25maXJtRGVsZXRlQnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgIGNvbnN0IHByb2R1Y3RzSUQgPSBnZXRDaGVja0JveFByb2R1Y3RJRCgpO1xuICAgIGZldGNoKCcvZGVsZXRlJyx7XG4gICAgICAgIG1ldGhvZDogJ1BPU1QnLFxuICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAnQ29udGVudC1UeXBlJzogJ2FwcGxpY2F0aW9uL2pzb24nXG4gICAgICAgIH0sXG5cbiAgICAgICAgYm9keTogSlNPTi5zdHJpbmdpZnkoe3Byb2R1Y3RzSUR9KVxuICAgIH0pXG5cbiAgICBtb2RhbF9kZWxldGUuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG59KTtcblxuY2hlY2tib3hGb3JBbGxQcm9kdWN0cy5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBzZWxlY3RBbGxDaGVja0JveGVzKTtcblxucHJvZHVjdENoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XG4gICAgY2hlY2tib3guYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgc2VsZWN0QWxsQ2hlY2tCb3hlcyk7XG59KTtcblxuIiwiZnVuY3Rpb24gYXR0YWNoVG9XaW5kb3coY29tcG9uZW50cykge1xuICAgIE9iamVjdC5rZXlzKGNvbXBvbmVudHMpLmZvckVhY2goKGtleSkgPT4ge1xuICAgICAgICB3aW5kb3dba2V5XSA9IGNvbXBvbmVudHNba2V5XTtcbiAgICB9KTtcbn1cblxuZXhwb3J0IHsgXG4gICAgYXR0YWNoVG9XaW5kb3csXG59OyIsImltcG9ydCAqIGFzIGhlbHBlciBmcm9tIFwiLi9oZWxwZXIvZ2xvYmFsXCI7XG5cbi8vIEltcG9ydCBhbGwgYXZhaWxhYmxlIGNvbXBvbmVudHNcbmltcG9ydCBOYXZUb2dnbGUgZnJvbSBcIi4vY29tcG9uZW50L05hdlRvZ2dsZVwiO1xuaW1wb3J0IExpbmsgZnJvbSBcIi4vY29tcG9uZW50L0xpbmtcIjtcblxuaGVscGVyLmF0dGFjaFRvV2luZG93KHtcbiAgICBOYXZUb2dnbGUsXG4gICAgTGluayxcbn0pOyIsIi8vIFLDqWN1cMOpcmVyIGxlcyDDqWzDqW1lbnRzIEhUTUwgZGUgbGEgbW9kYWxlIGV0IGRlcyBib3V0b25zXG5jb25zdCBvcGVuTW9kYWxCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnb3Blbk1vZGFsJyk7XG5jb25zdCBjbG9zZU1vZGFsQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nsb3NlTW9kYWwnKTtcbmNvbnN0IG1vZGFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21vZGFsJyk7XG5cbi8vIEZvbmN0aW9uIHBvdXIgb3V2cmlyIGxhIG1vZGFsZVxuZnVuY3Rpb24gb3Blbk1vZGFsKCkge1xuICAgIG1vZGFsLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xufVxuXG4vLyBGb25jdGlvbiBwb3VyIGZlcm1lciBsYSBtb2RhbGVcbmZ1bmN0aW9uIGNsb3NlTW9kYWwoKSB7XG4gICAgbW9kYWwuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG59XG5cbi8vIMOJY291dGVyIGxlcyBjbGljcyBzdXIgbGUgYm91dG9uIFwiT3V2cmlyIGxhIG1vZGFsZVwiIHBvdXIgYWZmaWNoZXIgbGEgbW9kYWxlXG5vcGVuTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBvcGVuTW9kYWwpO1xuXG4vLyDDiWNvdXRlciBsZXMgY2xpY3Mgc3VyIGxlIGJvdXRvbiBcIkZlcm1lciBsYSBtb2RhbGVcIiBwb3VyIGNhY2hlciBsYSBtb2RhbGVcbmNsb3NlTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBjbG9zZU1vZGFsKTtcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJSZWFjdCIsIlJlYWN0RE9NIiwiUGF5bWVudHNMaXN0IiwiY3JlYXRlRWxlbWVudCIsImNsYXNzTmFtZSIsInJlbmRlciIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJMaW5rIiwic2VsZWN0b3IiLCJuZXdUYWIiLCJhcmd1bWVudHMiLCJsZW5ndGgiLCJ1bmRlZmluZWQiLCJfY2xhc3NDYWxsQ2hlY2siLCJsaW5rIiwicXVlcnlTZWxlY3RvckFsbCIsImluaXQiLCJfY3JlYXRlQ2xhc3MiLCJrZXkiLCJ2YWx1ZSIsImluaXRDbGFzc2VzIiwiYXR0YWNoRXZlbnQiLCJmb3JFYWNoIiwiY2xhc3NMaXN0IiwiYWRkIiwiX3RoaXMiLCJhZGRFdmVudExpc3RlbmVyIiwib3BlbkxpbmsiLCJlIiwidXJsIiwiZGF0YXNldCIsImhyZWYiLCJ3aW5kb3ciLCJvcGVuIiwibG9jYXRpb24iLCJOYXZUb2dnbGUiLCJ0b2dnbGVTZWxlY3RvciIsIm5hdlNlbGVjdG9yIiwibmF2VG9nZ2xlIiwicXVlcnlTZWxlY3RvciIsIm5hdiIsInRvZ2dsZSIsImlzT3BlbiIsImdldEF0dHJpYnV0ZSIsInNldEF0dHJpYnV0ZSIsInJlbW92ZSIsInByb2R1Y3RDaGVja2JveGVzIiwiY2hlY2tib3hGb3JBbGxQcm9kdWN0cyIsImRlbGV0ZUJ1dHRvbiIsIm1vZGFsX2RlbGV0ZSIsImNhbmNlbERlbGV0ZUJ1dHRvbiIsImNvbmZpcm1EZWxldGVCdXR0b24iLCJzZWxlY3RBbGxDaGVja0JveGVzIiwiY2xpY2tlZENoZWNrQm94IiwiZXZlbnQiLCJ0YXJnZXQiLCJjaGVja2VkIiwiY2hlY2tib3giLCJjaGVja0RlbGV0ZUJ1dHRvblN0YXRlIiwiZGlzYWJsZWQiLCJjbXB0IiwiZ2V0Q2hlY2tCb3hQcm9kdWN0SUQiLCJwcm9kdWN0c0lEIiwicHVzaCIsInByb2R1Y3RJZCIsImZldGNoIiwibWV0aG9kIiwiaGVhZGVycyIsImJvZHkiLCJKU09OIiwic3RyaW5naWZ5IiwiYXR0YWNoVG9XaW5kb3ciLCJjb21wb25lbnRzIiwiT2JqZWN0Iiwia2V5cyIsImhlbHBlciIsIm9wZW5Nb2RhbEJ1dHRvbiIsImNsb3NlTW9kYWxCdXR0b24iLCJtb2RhbCIsIm9wZW5Nb2RhbCIsImNsb3NlTW9kYWwiXSwic291cmNlUm9vdCI6IiJ9