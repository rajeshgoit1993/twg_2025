/* Lazy-loading images (working)*/
/*document.addEventListener("DOMContentLoaded", function () {
    //to check if lazy-load is working
    // new IntersectionObserver((entries) => {
    //     entries.forEach(entry => console.log(entry.target, entry.isIntersecting));
    // }).observe(document.querySelector("img.lazy-load"));

    let lazyloadImages = document.querySelectorAll("img.lazy-load");

    if ("IntersectionObserver" in window) {
        let observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    let img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove("lazy-load");
                    observer.unobserve(img);
                }
            });
        });

        lazyloadImages.forEach(function (img) {
            observer.observe(img);
        });
    } else {
        // Fallback for older browsers
        function lazyload() {
            let scrollTop = window.pageYOffset;
            lazyloadImages.forEach(function (img) {
                if (img.offsetTop < window.innerHeight + scrollTop) {
                    img.src = img.dataset.src;
                    img.classList.remove("lazy-load");
                }
            });
            if (lazyloadImages.length == 0) {
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
            }
        }

        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
    }
});*/


//******************************

/*lazy-loading images for domcontent*/
document.addEventListener("DOMContentLoaded", function () {
    let lazyloadImages = document.querySelectorAll("img.lazy-load");

    if ("IntersectionObserver" in window) {
        let observer = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    let img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove("lazy-load");
                    observer.unobserve(img);
                }
            });
        });

        function observeNewLazyImages() {
            document.querySelectorAll("img.lazy-load").forEach(img => observer.observe(img));
        }

        // Observe existing images
        lazyloadImages.forEach(img => observer.observe(img));

        // Re-observe images when new content is added
        document.addEventListener("click", function (event) {
            if (event.target.matches("#addMoreContentBtn")) { // Replace with actual button ID
                setTimeout(observeNewLazyImages, 500); // Allow new images to load in DOM
            }
        });

    } else {
        // Fallback for older browsers
        function lazyload() {
            let scrollTop = window.pageYOffset;
            lazyloadImages.forEach(function (img) {
                if (img.offsetTop < window.innerHeight + scrollTop) {
                    img.src = img.dataset.src;
                    img.classList.remove("lazy-load");
                }
            });
            if (lazyloadImages.length == 0) {
                document.removeEventListener("scroll", lazyload);
                window.removeEventListener("resize", lazyload);
                window.removeEventListener("orientationChange", lazyload);
            }
        }

        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
    }
});