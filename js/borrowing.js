document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('borrowing-form').addEventListener('submit', saveDataAndRedirect);
});

function saveDataAndRedirect(event) {
    event.preventDefault();
    const name = document.getElementById('borrower-name').value;
    const amount = document.getElementById('amount').value;
    localStorage.setItem('borrowerName', name);
    localStorage.setItem('borrowAmount', amount);
    window.location.href = 'MainBorrowing.php';
}
