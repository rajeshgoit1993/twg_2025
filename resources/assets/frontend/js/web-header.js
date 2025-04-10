/*------------web-header------------------*/

//sticky web header
document.addEventListener("DOMContentLoaded", function() {
    var header = document.querySelector(".navHeaderWrapper");
    var fixedHeader = document.querySelector(".dNavCont");
    var stickyPosition = 87;

    window.onscroll = function() {
        if (window.pageYOffset > stickyPosition) {
            header.style.display = "block";
            header.classList.remove("navClass");
            header.classList.add("makeStickyHeader");
            fixedHeader.classList.add("stickyHeaderAdded");
            } else {
                header.classList.remove("makeStickyHeader");
                header.classList.add("navClass");
                fixedHeader.classList.remove("stickyHeaderAdded");
            }
        };
    });


//scroll to top
document.addEventListener("DOMContentLoaded", function () {
    var scrollButton = document.getElementById("scroll-to-top");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 100) {
            scrollButton.style.display = "block";
            } else {
            scrollButton.style.display = "none";
            }
        });

    scrollButton.addEventListener("click", function () {
        smoothScroll("#scrollToTopContent", 500); // Adjust the duration as needed
        });
    });

function smoothScroll(target, duration) {
    var targetElement = document.querySelector(target);
    var targetPosition = targetElement.offsetTop - 40;
    var startPosition = window.pageYOffset;
    var distance = targetPosition - startPosition;
    var startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        var timeElapsed = currentTime - startTime;
        var run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
        }

    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return (c / 2) * t * t + b;
        t--;
        return (-c / 2) * (t * (t - 2) - 1) + b;
        }

    requestAnimationFrame(animation);
    }