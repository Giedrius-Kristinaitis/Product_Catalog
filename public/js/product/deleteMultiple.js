/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/product/deleteMultiple.js":
/*!************************************************!*\
  !*** ./resources/js/product/deleteMultiple.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var checkboxes;
var deleteButton;
var checkedCheckboxes = [];
window.addEventListener('load', function () {
  initializeDOMElements();
  addCheckboxEventListeners(checkboxes);
  deleteButton.addEventListener('click', deleteButtonCallback);
});
/**
 * Initializes DOM elements
 */

function initializeDOMElements() {
  checkboxes = document.getElementsByClassName('deletion-checkbox');
  deleteButton = document.getElementById('delete-button');
}
/**
 * Adds event listener to multiple checkboxes
 *
 * @param checkboxes
 */


function addCheckboxEventListeners(checkboxes) {
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', checkboxEventListenerCallback);
  }
}
/**
 * Function that gets called when the deletion button is clicked
 */


function deleteButtonCallback() {
  var productsToDelete = getProductsToDelete(checkedCheckboxes);
  sendDeleteRequest(productsToDelete);
}
/**
 * Sends a request to the server to delete products
 *
 * @param productsToDelete
 */


function sendDeleteRequest(productsToDelete) {
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/product/multiple', {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(productsToDelete)
  }).then(function (result) {
    if (result.ok) {
      deletionRequestSucceeded();
    } else {
      deletionRequestFailed();
    }
  })["catch"](function () {
    return deletionRequestFailed();
  });
}
/**
 * Called when product deletion request succeeds
 */


function deletionRequestSucceeded() {
  location.reload(true);
  alert('Product(-s) deleted successfully');
}
/**
 * Called when product deletion request fails
 */


function deletionRequestFailed() {
  alert('An error occurred when trying to delete selected products');
}
/**
 * Gets products to delete based on whether the given checkboxes are checked or not and have product
 * attribute set to product id
 *
 * @param checkboxes
 */


function getProductsToDelete(checkboxes) {
  var productsToDelete = [];

  for (var i = 0; i < checkboxes.length; i++) {
    productsToDelete.push(checkboxes[i].getAttribute('product'));
  }

  return productsToDelete;
}
/**
 * Function that gets called when a checkbox changes from checked to unchecked or vice versa
 */


function checkboxEventListenerCallback(event) {
  addOrRemoveFromCheckedList(event.target);
  changeDeleteButtonVisibility();
}
/**
 * Based on whether the checkbox is checked or not, adds or removes it from the checked checkbox list
 *
 * @param checkbox
 */


function addOrRemoveFromCheckedList(checkbox) {
  if (checkbox.checked) {
    checkedCheckboxes.push(checkbox);
  } else {
    checkedCheckboxes = checkedCheckboxes.filter(function (x) {
      return x.checked;
    });
  }
}
/**
 * Changes the delete button's visibility based on whether any checkboxes are checked or not
 */


function changeDeleteButtonVisibility() {
  if (checkedCheckboxes.length > 0) {
    showDeleteButton();
  } else {
    hideDeleteButton();
  }
}
/**
 * Shows the product deletion button
 */


function showDeleteButton() {
  if (deleteButton.classList.contains('invisible')) {
    deleteButton.classList.remove('invisible');
  }
}
/**
 * Hides the product deletion button
 */


function hideDeleteButton() {
  if (!deleteButton.classList.contains('invisible')) {
    deleteButton.classList.add('invisible');
  }
}

/***/ }),

/***/ 1:
/*!******************************************************!*\
  !*** multi ./resources/js/product/deleteMultiple.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Giedrius\Desktop\Catalog\resources\js\product\deleteMultiple.js */"./resources/js/product/deleteMultiple.js");


/***/ })

/******/ });