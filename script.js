// script.js

function validateForm() {
    const bookID = document.getElementById('book_id').value;
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');

    const bookIDPattern = /^B\d{3}$/;

    errorMessage.innerHTML = '';
    successMessage.innerHTML = '';

    if (!bookIDPattern.test(bookID)) {
        errorMessage.innerHTML = 'Book ID must start with "B" followed by exactly 3 digits (e.g., B001).';
        return false;
    }

    return true;
}
