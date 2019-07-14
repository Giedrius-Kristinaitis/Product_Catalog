// DOM elements
let leaveReviewButton;
let reviewerNameInput;
let reviewContentInput;
let ratingInput;
let noReviewsText;
let reviewList;

// review information
let reviewerName;
let reviewContent;
let rating;

window.addEventListener('load', function() {
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
    const requestBody = formRequestBody(reviewerName, reviewContent, rating, product_id);

    fetch('/review', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
    }).then(result => {
        if (result.ok) {
            successfulSubmit();
        } else {
            failedSubmit();
        }
    }).catch(() => failedSubmit());
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
    const divElement = createReviewDiv();
    const reviewerNameElement = createReviewerNameElement(reviewerName);
    const ratingElement = createRatingElement(rating);
    const reviewContentElement = createReviewContentElement(reviewContent);

    divElement.appendChild(reviewerNameElement);
    divElement.appendChild(ratingElement);
    divElement.appendChild(reviewContentElement);

    reviewList.appendChild(divElement);
}

/**
 * Creates a div for the review that will be added to product's review list
 */
function createReviewDiv() {
    const div = document.createElement('div');

    div.classList.add('card');
    div.classList.add('container');
    div.classList.add('m-3');

    return div;
}

/**
 * Creates a header element with reviewers name in it
 */
function createReviewerNameElement() {
    const header = document.createElement('h4');

    header.innerHTML = `Review by: ${reviewerName}`;

    return header;
}

/**
 * Creates a paragraph element with rating in it
 */
function createRatingElement() {
    const ratingElement = document.createElement('p');

    ratingElement.innerHTML = `Rated ${rating} out of 5`;

    return ratingElement;
}

/**
 * Creates a paragraph element with review's content in it
 */
function createReviewContentElement() {
    const reviewElement = document.createElement('p');

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