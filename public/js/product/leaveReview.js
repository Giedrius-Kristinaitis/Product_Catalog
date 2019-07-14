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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/product/leaveReview.js":
/*!*********************************************!*\
  !*** ./resources/js/product/leaveReview.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// DOM elements
var leaveReviewButton;
var reviewerNameInput;
var reviewContentInput;
var ratingInput;
var noReviewsText;
var reviewList; // review information

var reviewerName;
var reviewContent;
var rating;
window.addEventListener('load', function () {
  initializeDOMElements();
  leaveReviewButton.addEventListener('click', reviewButtonCallback);
});
/**
 * Initializes DOM elements
 */

function initializeDOMElements() {
  leaveReviewButton = document.getElementById('leave-review-button');
  reviewerNameInput = document.getElementById('name');
  reviewContentInput = document.getElementById('review');
  ratingInput = document.getElementById('rating');
  noReviewsText = document.getElementById('no-reviews-text');
  reviewList = document.getElementById('reviews');
}
/**
 * Gets called when the 'Leave review' button is clicked
 */


function reviewButtonCallback() {
  extractReviewData();

  if (validateReviewData(reviewerName, rating, reviewContent)) {
    submitReview();
  } else {
    alert('Please fill all fields with valid data before submitting the review');
  }
}
/**
 * Validates review information
 */


function validateReviewData(name, review, rating) {
  if (!validateReviewerName(name) || !validateRating(rating) || !validateReviewText(review)) {
    return false;
  }

  return true;
}
/**
 * Validates reviewers name
 */


function validateReviewerName(name) {
  if (name.length === 0) {
    return false;
  }

  return true;
}
/**
 * Validates rating
 */


function validateRating(rating) {
  if (rating < 1 || rating > 5) {
    return false;
  }

  return true;
}
/**
 * Validates review text
 */


function validateReviewText(review) {
  if (review.length === 0) {
    return false;
  }

  return true;
}
/**
 * Gets review data from the DOM elements
 */


function extractReviewData() {
  reviewerName = reviewerNameInput.value;
  reviewContent = reviewContentInput.value;
  rating = ratingInput.value;
}
/**
 * Submits the entered review to the server
 */


function submitReview() {
  var requestBody = formRequestBody(reviewerName, reviewContent, rating, product_id);
  fetch('/review', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(requestBody)
  }).then(function (result) {
    if (result.ok) {
      successfulSubmit();
    } else {
      failedSubmit();
    }
  })["catch"](function () {
    return failedSubmit();
  });
}
/**
 * Forms request body using review data
 */


function formRequestBody(reviewerName, reviewContent, rating, product_id) {
  return {
    'reviewer': reviewerName,
    'review': reviewContent,
    'rating': rating,
    'product_id': product_id
  };
}
/**
 * Called when review submitting succeeds
 */


function successfulSubmit() {
  removeNoReviewsText();
  addReviewToReviewsList();
  alert('Review submitted');
}
/**
 * Adds submitted review data to product's review list
 */


function addReviewToReviewsList() {
  var divElement = createReviewDiv();
  var reviewerNameElement = createReviewerNameElement(reviewerName);
  var ratingElement = createRatingElement(rating);
  var reviewContentElement = createReviewContentElement(reviewContent);
  divElement.appendChild(reviewerNameElement);
  divElement.appendChild(ratingElement);
  divElement.appendChild(reviewContentElement);
  reviewList.appendChild(divElement);
}
/**
 * Creates a div for the review that will be added to product's review list
 */


function createReviewDiv() {
  var div = document.createElement('div');
  div.classList.add('card');
  div.classList.add('container');
  div.classList.add('m-3');
  return div;
}
/**
 * Creates a header element with reviewers name in it
 */


function createReviewerNameElement() {
  var header = document.createElement('h4');
  header.innerHTML = "Review by: ".concat(reviewerName);
  return header;
}
/**
 * Creates a paragraph element with rating in it
 */


function createRatingElement() {
  var ratingElement = document.createElement('p');
  ratingElement.innerHTML = "Rated ".concat(rating, " out of 5");
  return ratingElement;
}
/**
 * Creates a paragraph element with review's content in it
 */


function createReviewContentElement() {
  var reviewElement = document.createElement('p');
  reviewElement.innerHTML = reviewContent;
  return reviewElement;
}
/**
 * Removes no reviews text header from the DOM
 */


function removeNoReviewsText() {
  if (noReviewsText !== null) {
    noReviewsText.parentNode.removeChild(noReviewsText);
  }
}
/**
 * Called when review submitting fails
 */


function failedSubmit() {
  alert('An error occurred while submitting the review');
}

/***/ }),

/***/ 2:
/*!***************************************************!*\
  !*** multi ./resources/js/product/leaveReview.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Giedrius\Desktop\Catalog\resources\js\product\leaveReview.js */"./resources/js/product/leaveReview.js");


/***/ })

/******/ });