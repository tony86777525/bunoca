$(function () {
	$('.fixed-top a[href*="#"]:not([href="#"])').click(function() {
		var target = $(this.hash);
		$('html,body').animate({
			scrollTop: target.offset().top - 100
		}, 500);
		return false;
	 });
});
$(function() {
	$('.navbar-collapse .navbar-nav .nav-item .nav-link').click(function() {
		$('.navbar-collapse.collapse.show').removeClass('show');
	});
});
