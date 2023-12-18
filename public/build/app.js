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
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");
/* harmony import */ var _js_index_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./js/index.js */ "./assets/js/index.js");
/* harmony import */ var _js_handleCheckbox_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./js/handleCheckbox.js */ "./assets/js/handleCheckbox.js");
// import tailwind utilities




// import custom styles


// import custom js



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
class Checkbox {
  constructor(checkboxForAll, checkboxes) {
    this.checkboxSelectAll = document.querySelector(checkboxForAll);
    this.checkboxes = document.querySelectorAll(checkboxes);
    this.onInit();
  }
  onInit = () => {
    if (this.checkboxSelectAll) {
      this.checkboxSelectAll.addEventListener('change', this.selectAllCheckboxes);
    }
    if (this.checkboxes) {
      this.checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', this.selectAllCheckboxes);
      });
    }
  };
  disableButton = () => {
    for (let checkbox of this.checkboxes) {
      if (checkbox.checked) {
        return "block";
      }
    }
    return "none";
  };
  selectAllCheckboxes = () => {
    const clickedCheckBox = event.target;
    if (clickedCheckBox == this.checkboxSelectAll && clickedCheckBox.checked) {
      this.checkboxes.forEach(checkbox => {
        if (!checkbox.checked) {
          checkbox.checked = true;
        }
      });
    } else if (clickedCheckBox == this.checkboxSelectAll && !clickedCheckBox.checked) {
      this.checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
          checkbox.checked = false;
        }
      });
    } else if (clickedCheckBox != this.checkboxSelectAll && !clickedCheckBox.checked) {
      if (this.checkboxSelectAll.checked) {
        this.checkboxSelectAll.checked = false;
      }
    }
  };
  getlistID = () => {
    let listID = [];
    this.checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        listID.push(parseInt(checkbox.getAttribute('name')));
      }
    });
    return listID;
  };
}
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
class Link {
  constructor(selector, newTab = false) {
    this.link = document.querySelectorAll(selector);
    this.newTab = newTab;
    this.init();
  }
  init() {
    this.initClasses();
    this.attachEvent();
  }
  initClasses() {
    this.link.forEach(link => {
      link.classList.add('cursor-pointer');
    });
  }
  attachEvent() {
    this.link.forEach(link => {
      link.addEventListener('click', e => {
        if (e.target.nodeName === 'TR' || e.target.nodeName === 'TD') {
          this.openLink(link);
        }
      });
    });
  }
  openLink(e) {
    const url = e.dataset.href;
    if (this.newTab) {
      return window.open(url, '_blank');
    }
    window.location = url;
  }
}
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
class NavToggle {
  constructor(toggleSelector, navSelector) {
    this.navToggle = document.querySelector(toggleSelector);
    this.nav = document.querySelector(navSelector);
    this.navToggle.addEventListener('click', () => this.toggle());
  }
  toggle() {
    const isOpen = this.nav.getAttribute('data-open') === 'true';
    this.nav.setAttribute('data-open', !isOpen);
    if (isOpen) {
      this.nav.classList.remove('ml-0');
      this.nav.classList.add('ml-[-18rem]');
    } else {
      this.nav.classList.add('ml-0');
      this.nav.classList.remove('ml-[-18rem]');
    }
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (NavToggle);

/***/ }),

/***/ "./assets/js/handleCheckbox.js":
/*!*************************************!*\
  !*** ./assets/js/handleCheckbox.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./component/Checkbox.js */ "./assets/js/component/Checkbox.js");


//on récupère la case permettant de cocher toutes les autres cases et on le met dans le tableau
const checkboxSelectAllList = [document.querySelector('.products-checkbox'), document.querySelector('.categories-checkbox')];
//on récupère les cases à cocher (lier a un element) et on le met dans le tableau
const checkboxesList = [document.querySelectorAll('.product-checkbox'), document.querySelectorAll('.category-checkbox')];
//on crée un objet Checkbox
const checkboxObjects = [new _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__["default"]('.products-checkbox', '.product-checkbox'), new _component_Checkbox_js__WEBPACK_IMPORTED_MODULE_0__["default"]('.categories-checkbox', '.category-checkbox')];
//ID des boutons à désactiver/activer
const disableButton = document.getElementById('disable_buttons');
checkboxSelectAllList.forEach((checkbox, index) => {
  if (checkbox) {
    checkbox.addEventListener('change', () => {
      checkboxObjects[index].onInit();
      disableButton.style.display = checkboxObjects[index].disableButton();
    });
  }
});
checkboxesList.forEach((checkboxes, index) => {
  if (checkboxes) {
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', () => {
        checkboxObjects[index].onInit();
        disableButton.style.display = checkboxObjects[index].disableButton();
      });
    });
  }
});

/***************************************************************************** */
/********************************DELETE ACTIONS******************************* */
/***************************************************************************** */

const deleteButtons = [document.getElementById('delete_products'), document.getElementById('delete_categories')];
const deleteModals = [document.getElementById('modal_delete')];
const cancelDeleteButtons = [document.getElementById('cancel_delete')];
const confirmDeleteButtons = [document.getElementById('confirm_delete')];
const route = ['/products/delete', '/products/category/delete'];
deleteButtons.forEach((button, index) => {
  if (button) {
    button.addEventListener('click', () => {
      deleteModals[0].classList.remove('hidden');
      cancelDeleteButtons[0].addEventListener('click', () => {
        deleteModals[0].classList.add('hidden');
      });
      confirmDeleteButtons[0].addEventListener('click', async () => {
        const list = checkboxObjects[index].getlistID();
        console.log(list);
        console.log('list en json');
        console.log(JSON.stringify(list));
        await fetch(route[index], {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(list)
        }).then(response => {
          if (response.ok) {
            window.location.reload(true);
          } else {
            console.error('Erreur lors de la suppresion.');
          }
        }).catch(error => {
          console.error('Erreur lors de la requête de suppresion : ', error);
        });
        modal_delete.classList.add('hidden');
      });
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
  Object.keys(components).forEach(key => {
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


/***/ }),

/***/ "./node_modules/tailwindcss/base.css":
/*!*******************************************!*\
  !*** ./node_modules/tailwindcss/base.css ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/tailwindcss/components.css":
/*!*************************************************!*\
  !*** ./node_modules/tailwindcss/components.css ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/tailwindcss/utilities.css":
/*!************************************************!*\
  !*** ./node_modules/tailwindcss/utilities.css ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_tailwindcss_base_css-node_modules_tailwindcss_components_css-node_module-c47e6e"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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LEdBQUdILFVBQVUsQ0FBQ0csR0FBRyxDQUFDO0VBQ2pDLENBQUMsQ0FBQztBQUNOOzs7Ozs7Ozs7Ozs7Ozs7QUNKMEM7O0FBRTFDO0FBQzhDO0FBQ1Y7QUFFcENDLDBEQUFxQixDQUFDO0VBQ2xCM0MsU0FBUztFQUNUbEIsSUFBSUEseURBQUFBO0FBQ1IsQ0FBQyxDQUFDOzs7Ozs7Ozs7OztBQ1RGOzs7Ozs7Ozs7Ozs7QUNBQTs7Ozs7Ozs7Ozs7O0FDQUE7Ozs7Ozs7Ozs7OztBQ0FBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2FwcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L0NoZWNrYm94LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy9jb21wb25lbnQvTGluay5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvY29tcG9uZW50L05hdlRvZ2dsZS5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvaGFuZGxlQ2hlY2tib3guanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2hlbHBlci9nbG9iYWwuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2luZGV4LmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zdHlsZXMvYXBwLmNzcyIsIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvdGFpbHdpbmRjc3MvYmFzZS5jc3MiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL3RhaWx3aW5kY3NzL2NvbXBvbmVudHMuY3NzIiwid2VicGFjazovLy8uL25vZGVfbW9kdWxlcy90YWlsd2luZGNzcy91dGlsaXRpZXMuY3NzIl0sInNvdXJjZXNDb250ZW50IjpbIi8vIGltcG9ydCB0YWlsd2luZCB1dGlsaXRpZXNcbmltcG9ydCAndGFpbHdpbmRjc3MvYmFzZS5jc3MnO1xuaW1wb3J0ICd0YWlsd2luZGNzcy9jb21wb25lbnRzLmNzcyc7XG5pbXBvcnQgJ3RhaWx3aW5kY3NzL3V0aWxpdGllcy5jc3MnO1xuXG4vLyBpbXBvcnQgY3VzdG9tIHN0eWxlc1xuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcblxuLy8gaW1wb3J0IGN1c3RvbSBqc1xuaW1wb3J0ICcuL2pzL2luZGV4LmpzJztcbmltcG9ydCAnLi9qcy9oYW5kbGVDaGVja2JveC5qcyc7IiwiY2xhc3MgQ2hlY2tib3h7XG4gICAgY29uc3RydWN0b3IoY2hlY2tib3hGb3JBbGwsIGNoZWNrYm94ZXMpe1xuICAgICAgICB0aGlzLmNoZWNrYm94U2VsZWN0QWxsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcihjaGVja2JveEZvckFsbCk7XG4gICAgICAgIHRoaXMuY2hlY2tib3hlcyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoY2hlY2tib3hlcyk7XG4gICAgICAgIHRoaXMub25Jbml0KCk7XG4gICAgfVxuXG4gICAgb25Jbml0ID0oKT0+e1xuICAgICAgICBpZih0aGlzLmNoZWNrYm94U2VsZWN0QWxsKXtcbiAgICAgICAgICAgICB0aGlzLmNoZWNrYm94U2VsZWN0QWxsLmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHRoaXMuc2VsZWN0QWxsQ2hlY2tib3hlcyk7XG4gICAgICAgIH1cbiAgICAgICBpZih0aGlzLmNoZWNrYm94ZXMpe1xuICAgICAgICAgICAgdGhpcy5jaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIHRoaXMuc2VsZWN0QWxsQ2hlY2tib3hlcyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICB9XG4gICAgICAgIFxuXG4gICAgfVxuXG4gICAgZGlzYWJsZUJ1dHRvbiA9KCk9PntcbiAgICAgICAgZm9yKGxldCBjaGVja2JveCBvZiB0aGlzLmNoZWNrYm94ZXMpe1xuICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgcmV0dXJuIFwiYmxvY2tcIjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgICByZXR1cm4gXCJub25lXCI7XG4gICAgXG4gICAgfVxuXG4gICAgc2VsZWN0QWxsQ2hlY2tib3hlcyA9KCk9PntcbiAgICAgICAgY29uc3QgY2xpY2tlZENoZWNrQm94ID0gZXZlbnQudGFyZ2V0O1xuXG4gICAgICAgIGlmKGNsaWNrZWRDaGVja0JveCA9PSB0aGlzLmNoZWNrYm94U2VsZWN0QWxsICYmIGNsaWNrZWRDaGVja0JveC5jaGVja2VkKXtcbiAgICAgICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgICAgIGlmKCFjaGVja2JveC5jaGVja2VkKXtcbiAgICAgICAgICAgICAgICAgICAgY2hlY2tib3guY2hlY2tlZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICAgICAgZWxzZSBpZihjbGlja2VkQ2hlY2tCb3ggPT0gdGhpcy5jaGVja2JveFNlbGVjdEFsbCAmJiAhY2xpY2tlZENoZWNrQm94LmNoZWNrZWQpe1xuICAgICAgICAgICAgdGhpcy5jaGVja2JveGVzLmZvckVhY2goKGNoZWNrYm94KSA9PiB7XG4gICAgICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgICAgIGNoZWNrYm94LmNoZWNrZWQgPSBmYWxzZTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfVxuICAgICAgICBlbHNlIGlmKGNsaWNrZWRDaGVja0JveCAhPSB0aGlzLmNoZWNrYm94U2VsZWN0QWxsICYmICFjbGlja2VkQ2hlY2tCb3guY2hlY2tlZCl7XG4gICAgICAgICAgICBpZih0aGlzLmNoZWNrYm94U2VsZWN0QWxsLmNoZWNrZWQpe1xuICAgICAgICAgICAgICAgIHRoaXMuY2hlY2tib3hTZWxlY3RBbGwuY2hlY2tlZCA9IGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgXG4gICAgfVxuXG4gICAgZ2V0bGlzdElEID0oKT0+e1xuICAgICAgICBsZXQgbGlzdElEID0gW107XG4gICAgICAgIHRoaXMuY2hlY2tib3hlcy5mb3JFYWNoKChjaGVja2JveCkgPT4ge1xuICAgICAgICAgICAgaWYoY2hlY2tib3guY2hlY2tlZCl7XG4gICAgICAgICAgICAgICAgbGlzdElELnB1c2gocGFyc2VJbnQoY2hlY2tib3guZ2V0QXR0cmlidXRlKCduYW1lJykpKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgcmV0dXJuIGxpc3RJRDtcbiAgICB9XG5cbn1cblxuZXhwb3J0IGRlZmF1bHQgQ2hlY2tib3g7IiwiY2xhc3MgTGluayB7XG4gICAgY29uc3RydWN0b3Ioc2VsZWN0b3IsIG5ld1RhYiA9IGZhbHNlKSB7XG4gICAgICAgIHRoaXMubGluayA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoc2VsZWN0b3IpO1xuICAgICAgICB0aGlzLm5ld1RhYiA9IG5ld1RhYjtcbiAgICAgICAgdGhpcy5pbml0KCk7XG4gICAgfVxuXG4gICAgaW5pdCgpIHtcbiAgICAgICAgdGhpcy5pbml0Q2xhc3NlcygpO1xuICAgICAgICB0aGlzLmF0dGFjaEV2ZW50KCk7XG4gICAgfVxuXG4gICAgaW5pdENsYXNzZXMoKSB7XG4gICAgICAgIHRoaXMubGluay5mb3JFYWNoKGxpbmsgPT4ge1xuICAgICAgICAgICAgbGluay5jbGFzc0xpc3QuYWRkKCdjdXJzb3ItcG9pbnRlcicpO1xuICAgICAgICB9KTtcbiAgICB9XG5cbiAgICBhdHRhY2hFdmVudCgpIHtcbiAgICAgICAgdGhpcy5saW5rLmZvckVhY2gobGluayA9PiB7XG4gICAgICAgICAgICBsaW5rLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZSA9PiB7XG4gICAgICAgICAgICAgICAgaWYgKGUudGFyZ2V0Lm5vZGVOYW1lID09PSAnVFInIHx8IGUudGFyZ2V0Lm5vZGVOYW1lID09PSAnVEQnKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMub3BlbkxpbmsobGluayk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cblxuICAgIG9wZW5MaW5rKGUpIHtcbiAgICAgICAgY29uc3QgdXJsID0gZS5kYXRhc2V0LmhyZWY7XG4gICAgICAgIGlmICh0aGlzLm5ld1RhYikge1xuICAgICAgICAgICAgcmV0dXJuIHdpbmRvdy5vcGVuKHVybCwgJ19ibGFuaycpO1xuICAgICAgICB9XG4gICAgICAgIHdpbmRvdy5sb2NhdGlvbiA9IHVybDtcbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IExpbms7IiwiY2xhc3MgTmF2VG9nZ2xlIHtcbiAgICBjb25zdHJ1Y3Rvcih0b2dnbGVTZWxlY3RvciwgbmF2U2VsZWN0b3IpIHtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHRvZ2dsZVNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXYgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKG5hdlNlbGVjdG9yKTtcbiAgICAgICAgdGhpcy5uYXZUb2dnbGUuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoKSA9PiB0aGlzLnRvZ2dsZSgpKTtcbiAgICB9XG5cbiAgICB0b2dnbGUoKSB7XG4gICAgICAgIGNvbnN0IGlzT3BlbiA9IHRoaXMubmF2LmdldEF0dHJpYnV0ZSgnZGF0YS1vcGVuJykgPT09ICd0cnVlJztcbiAgICAgICAgdGhpcy5uYXYuc2V0QXR0cmlidXRlKCdkYXRhLW9wZW4nLCAhaXNPcGVuKTtcbiAgICAgICAgaWYgKGlzT3Blbikge1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LnJlbW92ZSgnbWwtMCcpO1xuICAgICAgICAgICAgdGhpcy5uYXYuY2xhc3NMaXN0LmFkZCgnbWwtWy0xOHJlbV0nKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5hZGQoJ21sLTAnKTtcbiAgICAgICAgICAgIHRoaXMubmF2LmNsYXNzTGlzdC5yZW1vdmUoJ21sLVstMThyZW1dJyk7XG4gICAgICAgIH1cbiAgICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IE5hdlRvZ2dsZTsiLCJpbXBvcnQgQ2hlY2tib3ggZnJvbSAnLi9jb21wb25lbnQvQ2hlY2tib3guanMnO1xuXG4vL29uIHLDqWN1cMOocmUgbGEgY2FzZSBwZXJtZXR0YW50IGRlIGNvY2hlciB0b3V0ZXMgbGVzIGF1dHJlcyBjYXNlcyBldCBvbiBsZSBtZXQgZGFucyBsZSB0YWJsZWF1XG5jb25zdCBjaGVja2JveFNlbGVjdEFsbExpc3QgPSBbZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnByb2R1Y3RzLWNoZWNrYm94JyksIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5jYXRlZ29yaWVzLWNoZWNrYm94JykgXTtcbi8vb24gcsOpY3Vww6hyZSBsZXMgY2FzZXMgw6AgY29jaGVyIChsaWVyIGEgdW4gZWxlbWVudCkgZXQgb24gbGUgbWV0IGRhbnMgbGUgdGFibGVhdVxuY29uc3QgY2hlY2tib3hlc0xpc3QgPSBbZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnByb2R1Y3QtY2hlY2tib3gnKSwgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmNhdGVnb3J5LWNoZWNrYm94JyldO1xuLy9vbiBjcsOpZSB1biBvYmpldCBDaGVja2JveFxuY29uc3QgY2hlY2tib3hPYmplY3RzID0gW25ldyBDaGVja2JveCgnLnByb2R1Y3RzLWNoZWNrYm94JywnLnByb2R1Y3QtY2hlY2tib3gnKSwgbmV3IENoZWNrYm94KCcuY2F0ZWdvcmllcy1jaGVja2JveCcsJy5jYXRlZ29yeS1jaGVja2JveCcpXTtcbi8vSUQgZGVzIGJvdXRvbnMgw6AgZMOpc2FjdGl2ZXIvYWN0aXZlclxuY29uc3QgZGlzYWJsZUJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkaXNhYmxlX2J1dHRvbnMnKTtcblxuY2hlY2tib3hTZWxlY3RBbGxMaXN0LmZvckVhY2goKGNoZWNrYm94LCBpbmRleCk9PntcbiAgICBpZihjaGVja2JveCl7XG4gICAgICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsICgpPT57XG4gICAgICAgIGNoZWNrYm94T2JqZWN0c1tpbmRleF0ub25Jbml0KCk7XG4gICAgICAgIGRpc2FibGVCdXR0b24uc3R5bGUuZGlzcGxheSA9IGNoZWNrYm94T2JqZWN0c1tpbmRleF0uZGlzYWJsZUJ1dHRvbigpO1xuICAgICAgICB9KTtcbiAgICB9XG4gICAgXG59KVxuXG5jaGVja2JveGVzTGlzdC5mb3JFYWNoKChjaGVja2JveGVzLCBpbmRleCkgPT4ge1xuICAgIGlmKGNoZWNrYm94ZXMpe1xuICAgICAgICBjaGVja2JveGVzLmZvckVhY2goKGNoZWNrYm94KT0+e1xuICAgICAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCAoKSA9PiB7XG4gICAgICAgICAgICBjaGVja2JveE9iamVjdHNbaW5kZXhdLm9uSW5pdCgpO1xuICAgICAgICAgICAgZGlzYWJsZUJ1dHRvbi5zdHlsZS5kaXNwbGF5ID0gY2hlY2tib3hPYmplY3RzW2luZGV4XS5kaXNhYmxlQnV0dG9uKCk7XG4gICAgICAgIH0pO1xuICAgIH0pXG4gICAgfVxuICAgIFxufSlcblxuLyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqICovXG4vKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKipERUxFVEUgQUNUSU9OUyoqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiogKi9cbi8qKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKioqKiAqL1xuXG5jb25zdCBkZWxldGVCdXR0b25zID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkZWxldGVfcHJvZHVjdHMnKSwgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlbGV0ZV9jYXRlZ29yaWVzJyldO1xuY29uc3QgZGVsZXRlTW9kYWxzID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdtb2RhbF9kZWxldGUnKV07XG5jb25zdCBjYW5jZWxEZWxldGVCdXR0b25zID0gW2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdjYW5jZWxfZGVsZXRlJyldO1xuY29uc3QgY29uZmlybURlbGV0ZUJ1dHRvbnMgPSBbZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbmZpcm1fZGVsZXRlJyldO1xuY29uc3Qgcm91dGUgPSBbJy9wcm9kdWN0cy9kZWxldGUnLCAnL3Byb2R1Y3RzL2NhdGVnb3J5L2RlbGV0ZSddXG5cbmRlbGV0ZUJ1dHRvbnMuZm9yRWFjaCgoYnV0dG9uLCBpbmRleCk9PntcbiAgICBpZihidXR0b24pe1xuICAgICAgICBidXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCgpID0+e1xuICAgICAgICAgICAgZGVsZXRlTW9kYWxzWzBdLmNsYXNzTGlzdC5yZW1vdmUoJ2hpZGRlbicpO1xuICAgICAgICAgICAgXG4gICAgICAgICAgICBjYW5jZWxEZWxldGVCdXR0b25zWzBdLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBkZWxldGVNb2RhbHNbMF0uY2xhc3NMaXN0LmFkZCgnaGlkZGVuJyk7XG4gICAgICAgICAgICB9KTtcbiAgICBcbiAgICAgICAgICAgIGNvbmZpcm1EZWxldGVCdXR0b25zWzBdLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgYXN5bmMgKCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICBjb25zdCBsaXN0ID0gY2hlY2tib3hPYmplY3RzW2luZGV4XS5nZXRsaXN0SUQoKTtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2cobGlzdCk7XG4gICAgICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKCdsaXN0IGVuIGpzb24nKTtcbiAgICAgICAgICAgICAgICAgICAgY29uc29sZS5sb2coSlNPTi5zdHJpbmdpZnkobGlzdCkpO1xuICAgICAgICAgICAgICAgICAgICBhd2FpdCBmZXRjaChyb3V0ZVtpbmRleF0se1xuICAgICAgICAgICAgICAgICAgICAgICAgbWV0aG9kOiAnUE9TVCcsXG4gICAgICAgICAgICAgICAgICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICAgICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgICAgIGJvZHk6IEpTT04uc3RyaW5naWZ5KGxpc3QpXG4gICAgICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAgICAgICAgIC50aGVuKHJlc3BvbnNlID0+IHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGlmKHJlc3BvbnNlLm9rKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB3aW5kb3cubG9jYXRpb24ucmVsb2FkKHRydWUpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICAgICAgZWxzZXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgbG9ycyBkZSBsYSBzdXBwcmVzaW9uLicpO1xuICAgICAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICAuY2F0Y2goZXJyb3IgPT57XG4gICAgICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmVycm9yKCdFcnJldXIgbG9ycyBkZSBsYSByZXF1w6p0ZSBkZSBzdXBwcmVzaW9uIDogJywgZXJyb3IpO1xuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICAgICAgbW9kYWxfZGVsZXRlLmNsYXNzTGlzdC5hZGQoJ2hpZGRlbicpO1xuICAgIFxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgIH1cbiAgICBcbn0pIiwiZnVuY3Rpb24gYXR0YWNoVG9XaW5kb3coY29tcG9uZW50cykge1xuICAgIE9iamVjdC5rZXlzKGNvbXBvbmVudHMpLmZvckVhY2goKGtleSkgPT4ge1xuICAgICAgICB3aW5kb3dba2V5XSA9IGNvbXBvbmVudHNba2V5XTtcbiAgICB9KTtcbn1cblxuZXhwb3J0IHsgXG4gICAgYXR0YWNoVG9XaW5kb3csXG59OyIsImltcG9ydCAqIGFzIGhlbHBlciBmcm9tIFwiLi9oZWxwZXIvZ2xvYmFsXCI7XG5cbi8vIEltcG9ydCBhbGwgYXZhaWxhYmxlIGNvbXBvbmVudHNcbmltcG9ydCBOYXZUb2dnbGUgZnJvbSBcIi4vY29tcG9uZW50L05hdlRvZ2dsZVwiO1xuaW1wb3J0IExpbmsgZnJvbSBcIi4vY29tcG9uZW50L0xpbmtcIjtcblxuaGVscGVyLmF0dGFjaFRvV2luZG93KHtcbiAgICBOYXZUb2dnbGUsXG4gICAgTGluayxcbn0pOyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyIsIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpblxuZXhwb3J0IHt9OyJdLCJuYW1lcyI6WyJDaGVja2JveCIsImNvbnN0cnVjdG9yIiwiY2hlY2tib3hGb3JBbGwiLCJjaGVja2JveGVzIiwiY2hlY2tib3hTZWxlY3RBbGwiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJxdWVyeVNlbGVjdG9yQWxsIiwib25Jbml0IiwiYWRkRXZlbnRMaXN0ZW5lciIsInNlbGVjdEFsbENoZWNrYm94ZXMiLCJmb3JFYWNoIiwiY2hlY2tib3giLCJkaXNhYmxlQnV0dG9uIiwiY2hlY2tlZCIsImNsaWNrZWRDaGVja0JveCIsImV2ZW50IiwidGFyZ2V0IiwiZ2V0bGlzdElEIiwibGlzdElEIiwicHVzaCIsInBhcnNlSW50IiwiZ2V0QXR0cmlidXRlIiwiTGluayIsInNlbGVjdG9yIiwibmV3VGFiIiwibGluayIsImluaXQiLCJpbml0Q2xhc3NlcyIsImF0dGFjaEV2ZW50IiwiY2xhc3NMaXN0IiwiYWRkIiwiZSIsIm5vZGVOYW1lIiwib3BlbkxpbmsiLCJ1cmwiLCJkYXRhc2V0IiwiaHJlZiIsIndpbmRvdyIsIm9wZW4iLCJsb2NhdGlvbiIsIk5hdlRvZ2dsZSIsInRvZ2dsZVNlbGVjdG9yIiwibmF2U2VsZWN0b3IiLCJuYXZUb2dnbGUiLCJuYXYiLCJ0b2dnbGUiLCJpc09wZW4iLCJzZXRBdHRyaWJ1dGUiLCJyZW1vdmUiLCJjaGVja2JveFNlbGVjdEFsbExpc3QiLCJjaGVja2JveGVzTGlzdCIsImNoZWNrYm94T2JqZWN0cyIsImdldEVsZW1lbnRCeUlkIiwiaW5kZXgiLCJzdHlsZSIsImRpc3BsYXkiLCJkZWxldGVCdXR0b25zIiwiZGVsZXRlTW9kYWxzIiwiY2FuY2VsRGVsZXRlQnV0dG9ucyIsImNvbmZpcm1EZWxldGVCdXR0b25zIiwicm91dGUiLCJidXR0b24iLCJsaXN0IiwiY29uc29sZSIsImxvZyIsIkpTT04iLCJzdHJpbmdpZnkiLCJmZXRjaCIsIm1ldGhvZCIsImhlYWRlcnMiLCJib2R5IiwidGhlbiIsInJlc3BvbnNlIiwib2siLCJyZWxvYWQiLCJlcnJvciIsImNhdGNoIiwibW9kYWxfZGVsZXRlIiwiYXR0YWNoVG9XaW5kb3ciLCJjb21wb25lbnRzIiwiT2JqZWN0Iiwia2V5cyIsImtleSIsImhlbHBlciJdLCJzb3VyY2VSb290IjoiIn0=