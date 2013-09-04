$(document).ready(function() {

	$('.menu li').each(function() {
		var data = document.location.href.split('/');
		//alert(data[data.length-2]);

		if(data[data.length-2] == 'member' && data[data.length-1] == 'index.php#.UWuetLX-F62')
		{
			$('.menu li').removeClass('active');
			$('.menu #home').addClass('active');
			$('.menu #home').removeClass('cufon');
			$('.menu #home').addClass('white');
		}
		else if(data[data.length-2] == 'booking')
		{
			$('.menu li').removeClass('active');
			$('.menu #booking').addClass('active');
			$('.menu #booking').removeClass('cufon');
			$('.menu #booking').addClass('white');
		}
		else if(data[data.length-1] == 'changepassword.php')
		{
			$('.menu li').removeClass('active');
			$('.menu #change-pwd').addClass('active');
			$('.menu #change-pwd').removeClass('cufon');
			$('.menu #change-pwd').addClass('white');
		}
		else if(data[data.length-2] == 'admin' && data[data.length-1] == 'index.php#.UWvMm7X-F62')
		{
			$('.menu li').removeClass('active');
			$('.menu #booking-mgt').addClass('active');
			$('.menu #booking-mgt').removeClass('cufon');
			$('.menu #booking-mgt').addClass('white');
		}
		else if(data[data.length-2] == 'user' && data[data.length-1] == 'index.php#.UWvMm7X-F62')
		{
			$('.menu li').removeClass('active');
			$('.menu #user-mgt').addClass('active');
			$('.menu #user-mgt').removeClass('cufon');
			$('.menu #user-mgt').addClass('white');
		}
	});
});