//collapsible

    // Get all elements with the class "collapsible"
    var coll = document.getElementsByClassName("collapsible");
    var i;

    // Loop through each collapsible element
    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            // Toggle the "active" class to highlight the button that controls the content
            this.classList.toggle("active");

            // Get the content element immediately following the clicked collapsible
            var contents = this.nextElementSibling;

            // If the content is already expanded, collapse it by setting maxHeight to null
            if (contents.style.maxHeight) {
                contents.style.maxHeight = null;
            } 
            // Otherwise, expand the content by setting its maxHeight to its scrollHeight
            else {
                contents.style.maxHeight = contents.scrollHeight + "px";
            }
        });
    }

