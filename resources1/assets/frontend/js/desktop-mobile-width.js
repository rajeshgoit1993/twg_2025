// desktop-mobile width page
/*if (jQuery(window).width() >= 992) { 
    jQuery(".mobile_test_exp").html(""); // Clears content for mobile
} else { 
    jQuery(".destop_test_exp").html(""); // Clears content for desktop
}*/

jQuery(document).ready(function() {
    function toggleContent() {
        if (jQuery(window).width() >= 992) {
            jQuery(".mobile_test_exp").html(""); // Hide mobile content
        } else {
            jQuery(".destop_test_exp").html(""); // Hide desktop content
        }
    }

    // Run on page load
    toggleContent();

    // Run on window resize
    jQuery(window).resize(function() {
        toggleContent();
    });
});     