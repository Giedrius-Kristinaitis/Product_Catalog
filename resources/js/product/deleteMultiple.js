const checkboxes = document.getElementsByClassName('deletion-checkbox');
const deleteButton = document.getElementById('delete-button');

addCheckboxEventListeners(checkboxes);

deleteButton.addEventListener('click', deleteButtonCallback);

/**
 * Function that gets called when the deletion button is clicked
 */
function deleteButtonCallback() {
    const productsToDelete = getProductsToDelete(checkboxes);
    sendDeleteRequest(productsToDelete);
}

/**
 * Sends a request to the server to delete products
 *
 * @param productsToDelete
 */
function sendDeleteRequest(productsToDelete) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/product/multiple', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(productsToDelete)
    }).then(result => {
        if (result.ok) {
            deletionRequestSucceeded()
        } else {
            deletionRequestFailed();
        }
    }).catch(() => deletionRequestFailed());
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
    const productsToDelete = [];

    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            productsToDelete.push(checkboxes[i].getAttribute('product'));
        }
    }

    return productsToDelete;
}

/**
 * Adds event listener to multiple checkboxes
 *
 * @param checkboxes
 */
function addCheckboxEventListeners(checkboxes) {
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', checkboxEventListenerCallback);
    }
}

/**
 * Function that gets called when a checkbox changes from checked to unchecked or vice versa
 */
function checkboxEventListenerCallback() {
    if (anyCheckboxChecked(checkboxes)) {
        showDeleteButton();
    } else {
        hideDeleteButton();
    }
}

/**
 * Checks if any of the given checkboxes is checked
 *
 * @param checkboxes
 */
function anyCheckboxChecked(checkboxes) {
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            return true;
        }
    }

    return false;
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