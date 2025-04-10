/*slider starts*/
document.addEventListener("DOMContentLoaded", function() {
    var slideIndex_second = 0;
    showSlides_second();

    function showSlides_second() {
        var i;
        var slides = document.getElementsByClassName("theSlides");

        // var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "block";
            }

        slideIndex_second++;
        if (slideIndex_second > slides.length) {
            slideIndex_second = 1 // Reset index if it exceeds the number of slides
            }
        // for (i = 0; i < dots.length; i++) {
        //   dots[i].className = dots[i].className.replace(" active", "");
        // }
        slides[slideIndex_second-1].style.display = "none";
        // slides[slideIndex_second-1].style.display = "block"; // Show the current slide
        // dots[slideIndex_second-1].className += " active";
        setTimeout(showSlides_second, 2000); // Change image every 2 seconds
        }
    });
/*slider ends*/