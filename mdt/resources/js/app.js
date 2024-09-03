import "./bootstrap";
const navbarToggle = document.querySelector(".navbar-toggle");
const navbarContainer = document.querySelector(".navbar-container");

navbarToggle.addEventListener("click", () => {
    navbarContainer.classList.toggle("active");
});

document.addEventListener("DOMContentLoaded", function () {
    const pelayanan = document.querySelector(".pelayanan");

    pelayanan.addEventListener("click", function () {
        pelayanan.classList.toggle("active");
    });
    // Optional: Click outside to close dropdown
    document.addEventListener("click", function (event) {
        if (!pelayanan.contains(event.target)) {
            pelayanan.classList.remove("active");
        }
    });
    const arrowRight = document.querySelector(".arrow-right");
    const arrowLeft = document.querySelector(".arrow-left");
    const footer1 = document.querySelector(".footer-1");
    const footer2 = document.querySelector(".footer-2");
    const mainBody1 = document.querySelector(".main-body-1");
    const mainBody2 = document.querySelector(".main-body-2");

    // Initially show the first body and hide the second body
    mainBody1.style.display = "flex";
    mainBody2.style.display = "none";

    // Function to show main-body-2 and hide main-body-1
    function showMainBody2() {
        mainBody1.style.display = "none";
        mainBody2.style.display = "flex";

        // Swap width and color for footer-1 and footer-2
        footer1.style.width = "25px";
        footer1.style.backgroundColor = "#D9D9D9";
        footer2.style.width = "60px";
        footer2.style.backgroundColor = "#A6A6A6";
    }

    // Function to show main-body-1 and hide main-body-2
    function showMainBody1() {
        mainBody1.style.display = "flex";
        mainBody2.style.display = "none";

        // Swap width and color back for footer-1 and footer-2
        footer1.style.width = "60px";
        footer1.style.backgroundColor = "#A6A6A6";
        footer2.style.width = "25px";
        footer2.style.backgroundColor = "#D9D9D9";
    }

    // Event listeners for arrow-right and footer-2
    arrowRight.addEventListener("click", showMainBody2);
    footer2.addEventListener("click", showMainBody2);

    // Event listeners for arrow-left and footer-1
    arrowLeft.addEventListener("click", showMainBody1);
    footer1.addEventListener("click", showMainBody1);
});

document.addEventListener("DOMContentLoaded", function () {
    const images = [
        "./img/dompet1.png",
        "./img/dompet2.png",
        "./img/dompet3.png",
        "./img/profile.png",
    ];
    let currentIndex = 0;

    function updateImage(imageElement, index) {
        imageElement.src = images[index];
    }

    function initializeImageNavigation(imageContainer) {
        const imageElement = imageContainer.querySelector("img");
        const arrowLeft = imageContainer.querySelector(".arrow-left");
        const arrowRight = imageContainer.querySelector(".arrow-right");

        function updateNavigationButtons() {
            arrowLeft.style.display = currentIndex === 0 ? "none" : "block";
            arrowRight.style.display =
                currentIndex === images.length - 1 ? "none" : "block";
        }

        updateImage(imageElement, currentIndex);
        updateNavigationButtons();

        arrowRight.onclick = function () {
            if (currentIndex < images.length - 1) {
                currentIndex++;
                updateImage(imageElement, currentIndex);
                updateNavigationButtons();
            }
        };

        arrowLeft.onclick = function () {
            if (currentIndex > 0) {
                currentIndex--;
                updateImage(imageElement, currentIndex);
                updateNavigationButtons();
            }
        };
    }

    const laporanItems = document.querySelectorAll(".main-laporan");
    laporanItems.forEach(function (item) {
        const imageContainer = item.querySelector(".image-laporan");
        initializeImageNavigation(imageContainer);

        const footerLaporan = item.querySelector(".footer-laporan");

        footerLaporan.addEventListener("click", function () {
            const title = item.querySelector(".title").textContent;
            const user = item.querySelector(".user").innerHTML;
            const date = item.querySelector(".date").textContent;
            const time = item.querySelector(".time").textContent;
            const lastSeen = item.querySelector(
                ".terakhir-dilihat span"
            ).textContent;
            const status = item.querySelector(".status span").textContent;
            const detail = item.querySelector(".content-detail").innerHTML;
            const imageSrc = item
                .querySelector(".image-laporan img")
                .getAttribute("src");

            const popUp = document.querySelector(".popup");
            popUp.querySelector(".title").textContent = title;
            popUp.querySelector(".user").innerHTML = user;
            popUp.querySelector(".date").textContent = date;
            popUp.querySelector(".time").textContent = time;
            popUp.querySelector(".terakhir-dilihat span").textContent =
                lastSeen;
            popUp.querySelector(".status span").textContent = status;
            popUp.querySelector(".content-detail").innerHTML = detail;
            popUp
                .querySelector(".image-laporan img")
                .setAttribute("src", imageSrc);
            currentIndex = images.indexOf(imageSrc);
            const imageContainerPopup = popUp.querySelector(".image-laporan");
            initializeImageNavigation(imageContainerPopup);

            popUp.style.display = "flex";
        });
    });

    const buttonClose = document.querySelector(".button-close");
    buttonClose.addEventListener("click", function () {
        const popUp = document.querySelector(".popup");
        popUp.style.display = "none";
    });
});


