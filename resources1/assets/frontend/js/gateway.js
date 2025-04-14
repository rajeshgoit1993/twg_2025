//<!--file size validation script-->
Filevalidation = () => {
	const fi = document.getElementById('file');
	// Check if any file is selected.
	if (fi.files.length > 0) {
		for (const i = 0; i <= fi.files.length - 1; i++) {
			const fsize = fi.files.item(i).size;
			const file = Math.round((fsize / 1024));
			// The size of the file.
			if (file >= 2048) {
				alert(
				"File too Big, please select a file less than 2mb");
				} else if (file < 100) {
				alert(
				"File too small, please select a file greater than 100kb");
				} else {
				document.getElementById('size').innerHTML = '<b>'
				+ file + '</b> KB';
				}
			}
		}
	}


/*************************/

	
//<!--tabs button script-->
// function openTab(evt, contentName) {

//   var i, tabcontent, tablinks;
//   tabcontent = document.getElementsByClassName("tabcontent");
  	
//   for (i = 0; i < tabcontent.length; i++) {

//     tabcontent[i].style.display = "none";
//   }
//   tablinks = document.getElementsByClassName("tablinks");
//   for (i = 0; i < tablinks.length; i++) {
//     tablinks[i].className = tablinks[i].className.replace(" active", "");
//   }
//   	console.log(contentName)
//   document.getElementById(contentName).style.display = "block";
//   evt.currentTarget.className += " active";
// }
// Get the element with id="defaultOpen" and click on it


/*************************/


/*******not in use*******/

/*if(jQuery(window).width()>=992) {
		document.getElementById("defaultOpen").click();
} else {
	document.getElementById("mdefaultOpen").click();
}*/

/*document.addEventListener("DOMContentLoaded", function() {
	if (jQuery(window).width() >= 992) {
		var defaultButton = document.getElementById("defaultOpen");
		if (defaultButton) {
			defaultButton.click();
		} else {
			console.error("Element with ID 'defaultOpen' not found.");
		}
	} else {
		var mobileButton = document.getElementById("mdefaultOpen");
		if (mobileButton) {
			mobileButton.click();
		} else {
			console.error("Element with ID 'mdefaultOpen' not found.");
		}
	}
});*/


/*************************/

//<!--showhide div element script-->
function ShowHideDiv() {
	//Hold until
	{
		var bookingstatus = document.getElementById("bookingstatus");
		var holdingdate = document.getElementById("holdingdate");
		holdingdate.style.display = bookingstatus.value == "onhold" ? "block" : "none";
	}
	//Link with Package ID
	{
		var channel = document.getElementById("channel");
		var tourid = document.getElementById("tourid");
		tourid.style.display = channel.value == "tour" ? "block" : "none";
	}
}

//Password Check (User Profile)
/*function passwordcheck() {
	var newpassword = document.getElementById('changePswrdNew');
	var confirmpassword = document.getElementById('changePswrdConfirm');
	var message = document.getElementById('pwdmessage');
	regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

	if (newpassword.value == confirmpassword.value) {
		message.style.color = '#008cff';
		newpassword.style.borderColor = '#008cff';
		confirmpassword.style.borderColor = '#008cff';
		message.style.fontWeight = '600';
		message.innerHTML = 'Password matched';
		} else {
		message.style.color = 'red';
		newpassword.style.borderColor = 'red';
		confirmpassword.style.borderColor = 'red';
		message.style.fontWeight = '600';
		message.innerHTML = 'Re-enter the New password';
		}
	
	//Reference the Button. Enable Submit Button
	var btnSubmit = document.getElementById("btnSubmit");
	//Verify the TextBox value.
	if (confirmpassword.value == newpassword.value) {
		//Enable the TextBox when TextBox has value.
		btnSubmit.disabled = false;
		btnSubmit.style.backgroundColor = "#008cff";
		btnSubmit.style.borderColor = "#008cff";
		}
	else {
		//Disable the TextBox when TextBox is empty.
		btnSubmit.disabled = true;
		btnSubmit.style.backgroundColor = "lightgray";
		btnSubmit.style.borderColor = "lightgray";
		}														

	//Show Hide Password in text box
	icon = document.getElementById('iconeye');
	
	icon.onclick = function () {
		if(newpassword.className == 'active') {
			newpassword.setAttribute('type', 'text');
			icon.className = 'fa fa-eye';
			newpassword.className = '';
			} 
		else {
			newpassword.setAttribute('type', 'password');
			icon.className = 'fa fa-eye-slash';
			newpassword.className = 'active';
			}
		}
	}*/


/*************************/

// mobile bottom bar (mytrip redirect)
// function showLoginModalAndRedirect(redirectUrl) {
// 	// Open the login modal
// 	$('#user-login').modal('show');

// 	// Store the redirect URL in session storage
// 	sessionStorage.setItem('redirectAfterLogin', redirectUrl);
// }

// document.addEventListener('DOMContentLoaded', function() {
// 	// Add event listener to all elements with the class 'redirect-link'
// 	document.querySelectorAll('.redirect-link').forEach(function(link) {
// 		link.addEventListener('click', function(event) {
// 			// Get the redirect URL from the data attribute
// 			const redirectUrl = event.currentTarget.getAttribute('data-redirect');
// 			showLoginModalAndRedirect(redirectUrl);
// 		});
// 	});

// 	// On successful login, handle redirection
// 	const redirectUrl = sessionStorage.getItem('redirectAfterLogin');
// 	if (redirectUrl) {
// 		// Remove the item from session storage to avoid future redirects
// 		sessionStorage.removeItem('redirectAfterLogin');

// 		// Redirect the user
// 		window.location.href = redirectUrl;
// 	}
// });