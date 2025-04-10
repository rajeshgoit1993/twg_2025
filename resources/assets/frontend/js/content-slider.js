// /*
//  * Title:   Image-slider
//  */

// var slideIndex = 1;
// var myTimer;
// var slideshowContainer;
// window.addEventListener("load",function() {
//     showSlides(slideIndex);
//     myTimer = setInterval(function(){plusSlides(1)}, 2000);

//     //COMMENT OUT THE LINE BELOW TO KEEP ARROWS PART OF MOUSEENTER PAUSE/RESUME
//     slideshowContainer = document.getElementsByClassName('slideshow-inner')[0];

//     //UNCOMMENT OUT THE LINE BELOW TO KEEP ARROWS PART OF MOUSEENTER PAUSE/RESUME
//     // slideshowContainer = document.getElementsByClassName('slideshow-container')[0];

//     slideshowContainer.addEventListener('mouseenter', pause)
//     slideshowContainer.addEventListener('mouseleave', resume)
// 	})

// // NEXT AND PREVIOUS CONTROL
// function plusSlides(n){
//   clearInterval(myTimer);
//   if (n < 0){
//     showSlides(slideIndex -= 1);
// 	} else {
//    showSlides(slideIndex += 1);
//    }

//   //COMMENT OUT THE LINES BELOW TO KEEP ARROWS PART OF MOUSEENTER PAUSE/RESUME
//   if (n === -1){
//     myTimer = setInterval(function(){plusSlides(n + 2)}, 3000);
// 	} else {
//     myTimer = setInterval(function(){plusSlides(n + 1)}, 3000);
// 	}
//   }

// //Controls the current slide and resets interval if needed
// function currentSlide(n){
//   clearInterval(myTimer);
//   myTimer = setInterval(function(){plusSlides(n + 1)}, 3000);
//   showSlides(slideIndex = n);
//   }

// function showSlides(n){
//   var i;
//   var slides = document.getElementsByClassName("mySlides");
//   /*var dots = document.getElementsByClassName("dot");*/
//   if (n > slides.length) {slideIndex = 1}
//   if (n < 1) {slideIndex = slides.length}
//   for (i = 0; i < slides.length; i++) {
//       slides[i].style.display = "none";
//   }
//   /*for (i = 0; i < dots.length; i++) {
//       dots[i].className = dots[i].className.replace("dotActive", "");
//   }*/
//   slides[slideIndex-1].style.display = "block";
//   /*dots[slideIndex-1].className += " dotActive";*/
//   }

// pause = () => {
//   clearInterval(myTimer);
//   }

// resume = () =>{
//   clearInterval(myTimer);
//   myTimer = setInterval(function(){plusSlides(slideIndex)}, 4000);
//   }

// *************************

// /* Title:   Image-slider (d-tour-gallery) */

// // new code
// var slideIndex = 1;
// var myTimer;
// var slideshowContainer;

// // window.addEventListener("load", function () {
// document.addEventListener("DOMContentLoaded", function () {
//     // Ensure the container class matches your HTML
//     slideshowContainer = document.getElementsByClassName('modal_img_gallery_cont_box')[0];
    
//     if (!slideshowContainer) {
//         console.error("Element with class 'modal_img_gallery_cont_box' not found!");
//         return;
//     }

//     showSlides(slideIndex);

//     // COMMENTED OUT AUTOMATIC SLIDESHOW
//     //myTimer = setInterval(function () { plusSlides(1); }, 2000);

//     slideshowContainer.addEventListener('mouseenter', pause);
//     slideshowContainer.addEventListener('mouseleave', resume);
// });

// // Navigate to the next/previous slide
// function plusSlides(n) {
//     clearInterval(myTimer);
//     if (n < 0) {
//         showSlides(slideIndex -= 1);
//     } else {
//         showSlides(slideIndex += 1);
//     }

//     // COMMENTED OUT AUTOMATIC SLIDESHOW RESET
//     //myTimer = setInterval(function () { plusSlides(1); }, 3000);
// }

// // Display the selected slide and reset interval
// function currentSlide(n) {
//     clearInterval(myTimer);

//     // COMMENTED OUT AUTOMATIC SLIDESHOW RESET
//     //myTimer = setInterval(function () { plusSlides(1); }, 3000);

//     // COMMENTED DOT NAVIGATION
//     //showSlides(slideIndex = n);
// }

// // Display the appropriate slide
// function showSlides(n) {
//     var slides = document.getElementsByClassName("mySlides");

//     // COMMENTED OUT DOT FUNCTIONALITY
//     //var dots = document.getElementsByClassName("dot");

//     if (n > slides.length) { slideIndex = 1; }
//     if (n < 1) { slideIndex = slides.length; }

//     // Hide all slides
//     for (var i = 0; i < slides.length; i++) {
//         slides[i].style.display = "none";
//     }

//     // Remove active state from all dots
//     // COMMENTED OUT DOT ACTIVE STATE RESET
//     // for (var i = 0; i < dots.length; i++) {
//     //     dots[i].className = dots[i].className.replace(" active", "");
//     // }

//     // Show the current slide and set the active dot
//     slides[slideIndex - 1].style.display = "block";

//     // COMMENTED OUT SETTING DOT ACTIVE STATE
//     //dots[slideIndex - 1].className += " active";
// }

// function pause() {
//     clearInterval(myTimer);
// }

// function resume() {
//     clearInterval(myTimer);

//     // COMMENTED OUT AUTOMATIC SLIDESHOW RESET
//     //myTimer = setInterval(function () { plusSlides(1); }, 3000);
// }


//*******************************************************

var slideIndex = 1; // Current slide index
var myTimer;
var imagesLoaded = 0; // Start with 0 images loaded

document.addEventListener("DOMContentLoaded", function () {
    slideshowContainer = document.getElementsByClassName('modal_img_gallery_cont_box')[0];

    if (!slideshowContainer) {
        console.error("Element with class 'modal_img_gallery_cont_box' not found!");
        return;
    }

    // Ensure the first 3 images are loaded immediately
    loadNextImages(true);

    // Show the first slide
    showSlides(slideIndex);

    // Initialize automatic slideshow (optional)
    // myTimer = setInterval(function () {
    //     plusSlides(1);
    // }, 3000); // Change slide every 3 seconds

    slideshowContainer.addEventListener('mouseenter', pause);
    slideshowContainer.addEventListener('mouseleave', resume);
});

// Navigate to the next/previous slide
function plusSlides(n) {
    if (n < 0) {
        showSlides(slideIndex -= 1);
    } else {
        showSlides(slideIndex += 1);
    }

    loadNextImages(false); // Load the next set of images lazily

    // Restart the timer after manual navigation
    // myTimer = setInterval(function () {
    //     plusSlides(1);
    // }, 3000);
}

// Show the current slide
function showSlides(n) {
    var slides = document.getElementsByClassName("mySlides");

    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }

    // Hide all slides
    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    // Show the current slide
    slides[slideIndex - 1].style.display = "block";
}

// Lazy load images (and load initial images when needed)
function loadNextImages(isInitialLoad) {
    var slides = document.getElementsByClassName("mySlides");
    var batchSize = isInitialLoad ? 3 : 3; // Load 3 images at a time

    for (var i = imagesLoaded; i < Math.min(imagesLoaded + batchSize, slides.length); i++) {
        var img = slides[i];
        if (img && img.getAttribute('data-src') && img.getAttribute('src') === "data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=") {
            // Replace placeholder with the actual image
            img.setAttribute('src', img.getAttribute('data-src'));
            img.removeAttribute('data-src'); // Optional cleanup
        }
    }

    imagesLoaded += batchSize;
}

function pause() {
    clearInterval(myTimer);
}

function resume() {
    clearInterval(myTimer);
}

// Resume the slideshow (for automatic slide show)
// function resume() {
//     clearInterval(myTimer);
//     myTimer = setInterval(function () {
//         plusSlides(1);
//     }, 3000);
// }