(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_modal_product_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/modal_product.js */ "./assets/js/modal_product.js");
/* harmony import */ var _js_modal_product_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_modal_product_js__WEBPACK_IMPORTED_MODULE_1__);
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)



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
/******/ var __webpack_exports__ = (__webpack_exec__("./assets/app.js"));
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDMEI7Ozs7Ozs7Ozs7O0FDUjFCO0FBQ0EsSUFBTUEsZUFBZSxHQUFHQyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxXQUFXLENBQUM7QUFDNUQsSUFBTUMsZ0JBQWdCLEdBQUdGLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLFlBQVksQ0FBQztBQUM5RCxJQUFNRSxLQUFLLEdBQUdILFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLE9BQU8sQ0FBQzs7QUFFOUM7QUFDQSxTQUFTRyxTQUFTQSxDQUFBLEVBQUc7RUFDakJELEtBQUssQ0FBQ0UsU0FBUyxDQUFDQyxNQUFNLENBQUMsUUFBUSxDQUFDO0FBQ3BDOztBQUVBO0FBQ0EsU0FBU0MsVUFBVUEsQ0FBQSxFQUFHO0VBQ2xCSixLQUFLLENBQUNFLFNBQVMsQ0FBQ0csR0FBRyxDQUFDLFFBQVEsQ0FBQztBQUNqQzs7QUFFQTtBQUNBVCxlQUFlLENBQUNVLGdCQUFnQixDQUFDLE9BQU8sRUFBRUwsU0FBUyxDQUFDOztBQUVwRDtBQUNBRixnQkFBZ0IsQ0FBQ08sZ0JBQWdCLENBQUMsT0FBTyxFQUFFRixVQUFVLENBQUM7Ozs7Ozs7Ozs7OztBQ25CdEQiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9tb2RhbF9wcm9kdWN0LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcz82YmU2Il0sInNvdXJjZXNDb250ZW50IjpbIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgJy4vc3R5bGVzL2FwcC5jc3MnO1xuaW1wb3J0ICcuL2pzL21vZGFsX3Byb2R1Y3QuanMnOyIsIi8vIFLDqWN1cMOpcmVyIGxlcyDDqWzDqW1lbnRzIEhUTUwgZGUgbGEgbW9kYWxlIGV0IGRlcyBib3V0b25zXG5jb25zdCBvcGVuTW9kYWxCdXR0b24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnb3Blbk1vZGFsJyk7XG5jb25zdCBjbG9zZU1vZGFsQnV0dG9uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Nsb3NlTW9kYWwnKTtcbmNvbnN0IG1vZGFsID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ21vZGFsJyk7XG5cbi8vIEZvbmN0aW9uIHBvdXIgb3V2cmlyIGxhIG1vZGFsZVxuZnVuY3Rpb24gb3Blbk1vZGFsKCkge1xuICAgIG1vZGFsLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xufVxuXG4vLyBGb25jdGlvbiBwb3VyIGZlcm1lciBsYSBtb2RhbGVcbmZ1bmN0aW9uIGNsb3NlTW9kYWwoKSB7XG4gICAgbW9kYWwuY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG59XG5cbi8vIMOJY291dGVyIGxlcyBjbGljcyBzdXIgbGUgYm91dG9uIFwiT3V2cmlyIGxhIG1vZGFsZVwiIHBvdXIgYWZmaWNoZXIgbGEgbW9kYWxlXG5vcGVuTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBvcGVuTW9kYWwpO1xuXG4vLyDDiWNvdXRlciBsZXMgY2xpY3Mgc3VyIGxlIGJvdXRvbiBcIkZlcm1lciBsYSBtb2RhbGVcIiBwb3VyIGNhY2hlciBsYSBtb2RhbGVcbmNsb3NlTW9kYWxCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBjbG9zZU1vZGFsKTtcbiIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJvcGVuTW9kYWxCdXR0b24iLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIiwiY2xvc2VNb2RhbEJ1dHRvbiIsIm1vZGFsIiwib3Blbk1vZGFsIiwiY2xhc3NMaXN0IiwicmVtb3ZlIiwiY2xvc2VNb2RhbCIsImFkZCIsImFkZEV2ZW50TGlzdGVuZXIiXSwic291cmNlUm9vdCI6IiJ9