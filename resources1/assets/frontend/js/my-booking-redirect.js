//my-booking redirect

function showLoginModalAndRedirect(redirectUrl) {
    // Open the login modal
    $('#user-login').modal('show');

    // Store the redirect URL in session storage
    sessionStorage.setItem('redirectAfterLogin', redirectUrl);
}

document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to all elements with the class 'redirect-link'
    document.querySelectorAll('.redirect-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            // Get the redirect URL from the data attribute
            const redirectUrl = event.currentTarget.getAttribute('data-redirect');
            showLoginModalAndRedirect(redirectUrl);
        });
    });

    // On successful login, handle redirection
    const redirectUrl = sessionStorage.getItem('redirectAfterLogin');
    if (redirectUrl) {
        // Remove the item from session storage to avoid future redirects
        sessionStorage.removeItem('redirectAfterLogin');

        // Redirect the user
        window.location.href = redirectUrl;
    }
});