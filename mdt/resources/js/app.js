import './bootstrap';
const navbarToggle = document.querySelector('.navbar-toggle');
const navbarContainer = document.querySelector('.navbar-container');

navbarToggle.addEventListener('click', () => {
    navbarContainer.classList.toggle('active');
});

document.addEventListener('DOMContentLoaded', function () {
    const pelayanan = document.querySelector('.pelayanan');

    pelayanan.addEventListener('click', function () {
        pelayanan.classList.toggle('active');
    });
    // Optional: Click outside to close dropdown
    document.addEventListener('click', function (event) {
        if (!pelayanan.contains(event.target)) {
            pelayanan.classList.remove('active');
        }
    });
    const arrowRight = document.querySelector('.arrow-right');
    const arrowLeft = document.querySelector('.arrow-left');
    const footer1 = document.querySelector('.footer-1');
    const footer2 = document.querySelector('.footer-2');
    const mainBody1 = document.querySelector('.main-body-1');
    const mainBody2 = document.querySelector('.main-body-2');

    // Initially show the first body and hide the second body
    mainBody1.style.display = 'flex';
    mainBody2.style.display = 'none';

    // Function to show main-body-2 and hide main-body-1
    function showMainBody2() {
        mainBody1.style.display = 'none';
        mainBody2.style.display = 'flex';

        // Swap width and color for footer-1 and footer-2
        footer1.style.width = '25px';
        footer1.style.backgroundColor = '#D9D9D9';
        footer2.style.width = '60px';
        footer2.style.backgroundColor = '#A6A6A6';
    }

    // Function to show main-body-1 and hide main-body-2
    function showMainBody1() {
        mainBody1.style.display = 'flex';
        mainBody2.style.display = 'none';

        // Swap width and color back for footer-1 and footer-2
        footer1.style.width = '60px';
        footer1.style.backgroundColor = '#A6A6A6';
        footer2.style.width = '25px';
        footer2.style.backgroundColor = '#D9D9D9';
    }

    // Event listeners for arrow-right and footer-2
    arrowRight.addEventListener('click', showMainBody2);
    footer2.addEventListener('click', showMainBody2);

    // Event listeners for arrow-left and footer-1
    arrowLeft.addEventListener('click', showMainBody1);
    footer1.addEventListener('click', showMainBody1);
});
