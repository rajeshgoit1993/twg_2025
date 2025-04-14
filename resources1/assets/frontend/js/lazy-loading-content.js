/* Title: Lazy-Load-Scroll Content */

/*document.addEventListener('DOMContentLoaded', function() {
	var myDiv = document.getElementById('myScrollDiv');
	myDiv.addEventListener("scroll", myPageScroll);

	function myPageScroll() {
		var myScrollTop = myDiv.scrollTop;
		var myScrollHeight = myDiv.scrollHeight;
		var diff = myScrollHeight - myScrollTop;
		console.log(myScrollTop + " " + myScrollHeight);
		var height = myDiv.clientHeight;
		var offPageHeight = 100;
		if (diff < (height + offPageHeight)) {
			console.log("Call Ajax to Refresh")
			}
		}
});*/