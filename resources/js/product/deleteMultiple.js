const checkboxes = document.getElementsByClassName('deletion-checkbox');
const deleteButton = document.getElementById('delete-button');
let checkedCheckboxes = [];

addCheckboxEventListeners(checkboxes);
deleteButton.addEventListener('click', deleteButtonCallback);

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
 * Function that gets called when the deletion button is clicked
 */
function deleteButtonCallback() {
    const productsToDelete = getProductsToDelete(checkedCheckboxes);
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
        checkedCheckboxes = checkedCheckboxes.filter(x => x.checked);
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