document.addEventListener("DOMContentLoaded", function() {
  // Get buttons that open modals
  var openModalButtons = {
    testmonial_gallery: document.getElementById("addModal_testmonial_gallery_d"),
    review_content: document.getElementById("addModal_review_content_d"),
    review_photo: document.getElementById("addModal_review_photo_d"),
  };

  // Get modals
  var modals = {
    testmonial_gallery: document.getElementById("myModal_testmonial_gallery_d"),
    review_content: document.getElementById("myModal_review_content_d"),
    review_photo: document.getElementById("myModal_review_photo_d"),
  };

  // Get close buttons
  var closeButtons = {
    testmonial_gallery: document.querySelector(".closeModal_testmonial_gallery_d"),
    review_content: document.querySelector(".closeModal_review_content_d"),
    review_photo: document.querySelector(".closeModal_review_photo_d"),
    cancel_review_photo: document.querySelector(".cancelModal_review_photo_d"), // Cancel button
  };

  // Open modal event
  Object.keys(openModalButtons).forEach(function(key) {
    if (openModalButtons[key] && modals[key]) {
      openModalButtons[key].addEventListener("click", function() {
        modals[key].style.display = "block";
      });
    }
  });

  // Close modal event
  Object.keys(closeButtons).forEach(function(key) {
    if (closeButtons[key] && modals[key.replace("close_", "").replace("cancel_", "")]) {
      closeButtons[key].addEventListener("click", function() {
        modals[key.replace("close_", "").replace("cancel_", "")].style.display = "none";
      });
    }
  });

  // Close modal when clicking outside of it
  window.addEventListener("click", function(event) {
    Object.values(modals).forEach(function(modal) {
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  });
});

/**********************/

// Photo Tabs
function openTab(evt, openTab) {
    // Hide all tab contents
    let tabcontent = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove active class from all tab links
    let tablinks = document.getElementsByClassName("tablinks");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Show the selected tab and mark it as active
    let selectedTab = document.getElementById(openTab);
    if (selectedTab) {
        selectedTab.style.display = "block";
    } else {
        console.warn(`Tab "${openTab}" not found.`);
    }

    if (evt && evt.currentTarget) {
        evt.currentTarget.classList.add("active");
    }
}

/**********************/

document.addEventListener("DOMContentLoaded", function () {
    // Add event listener to the upload button
    let uploadBtn = document.getElementById("uploadBtn");
    if (uploadBtn) {
        uploadBtn.addEventListener("click", uploadFiles);
    }
});

// Function to upload images
function uploadFiles() {
    let input = document.createElement("input");
    input.type = "file";
    input.accept = "image/x-png,image/jpeg";
    input.multiple = true;

    input.addEventListener("change", function () {
        let files = Array.from(input.files);
        console.log(files); // Handle uploaded files here
    });

    input.click();
}


/**********************/

function adjustHeight(element) {
    let value = element.innerText.trim();  
    let maxLength = 1250;  
    let charCountElement = document.getElementById("charCount");

    // Trim text if it exceeds max length
    if (value.length > maxLength) {
        element.innerText = value.substring(0, maxLength);
        
        // Move cursor to the end after trimming
        let range = document.createRange();
        let selection = window.getSelection();
        range.selectNodeContents(element);
        range.collapse(false);
        selection.removeAllRanges();
        selection.addRange(range);
    }

    let numberOfLineBreaks = (value.match(/\n/g) || []).length;
    let newHeight = 20 + numberOfLineBreaks * 20 + 12 + 2;  

    // Ensure min-height is always 100px
    element.style.minHeight = "100px";
    element.style.height = Math.max(newHeight, 100) + "px";  

    // Update character counter text
    charCountElement.innerText = value.length + " / " + maxLength;

    // Change character counter color when exceeding max length
    if (value.length > maxLength) {
        charCountElement.innerHTML = `<span style="color:red;">${value.length} / ${maxLength} (maximum allowed characters)</span>`;
    } else {
        charCountElement.innerHTML = `${value.length} / ${maxLength} (maximum allowed characters)`; // Reset to default color
    }
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".textarea").forEach(textarea => {
        textarea.addEventListener("focus", function() {
            if (this.innerText.trim() === this.dataset.placeholder) {
                this.innerText = "";
            }
        });

        textarea.addEventListener("blur", function() {
            if (this.innerText.trim() === "") {
                this.innerText = this.dataset.placeholder;
            }
        });

        // Set initial placeholder
        if (textarea.innerText.trim() === "") {
            textarea.innerText = textarea.dataset.placeholder;
        }
    });
});