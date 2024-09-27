const tabbedContent = () => {
    const tabs = document.querySelectorAll("[data-tab-target]");
    const tabContents = document.querySelectorAll("[data-tab-content]");
    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
            const target = document.querySelector(tab.dataset.tabTarget);
            tabContents.forEach(tabContent => {
                tabContent.classList.remove("active");
            });
            target.classList.add("active");
        });
    }
    );
};

jQuery(document).ready(function ($) {

    var current = 0,
        slides = document.getElementsByClassName("logo-group");

    setInterval(function () {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.opacity = 0;
        }
        current = (current != slides.length - 1) ? current + 1 : 0;
        slides[current].style.opacity = 1;
    }, 5000);
    tabbedContent();

    if (matchMedia('(min-width: 768px)').matches) {
        $('.course .post-title').equalizeHeights();
        $('.course .product-price').equalizeHeights();
    }

})


