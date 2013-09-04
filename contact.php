<?php 
DEFINE('ROOT', '');
$current_page = "home-page";
require_once(ROOT.'_config.settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';?>

</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main.php';?>
		<div id="banner-contact"></div>
		<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://www.roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul><li class="active"><a href="#">Contact Us</a></li></ul>
				</div>
			</div>
			<div class="right">
				<div class="wrapper">
					<h1>Contact Us</h1>			
					<div class="map" style="float:right;">
						<iframe width="396" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.my/maps?hl=en&amp;ie=UTF8&amp;q=roar+studio+maps&amp;fb=1&amp;gl=my&amp;hq=roar+studio&amp;hnear=0x31cc4ececc1c7c97:0x524c8e31e929bc76,Petaling+Jaya,+Selangor&amp;cid=0,0,2883671557501421517&amp;ll=3.154624,101.594223&amp;spn=0.006295,0.006295&amp;t=m&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com.my/maps?hl=en&amp;ie=UTF8&amp;q=roar+studio+maps&amp;fb=1&amp;gl=my&amp;hq=roar+studio&amp;hnear=0x31cc4ececc1c7c97:0x524c8e31e929bc76,Petaling+Jaya,+Selangor&amp;cid=0,0,2883671557501421517&amp;ll=3.154624,101.594223&amp;spn=0.006295,0.006295&amp;t=m&amp;iwloc=A&amp;source=embed">View Larger Map</a></small>
					</div>	
					<p class="contact">     
						Studio Phone: 03-6141 0860<br />
						Mobile: 012-207 8918 (Kevin)<br />
						Email: <a href="mailto:roarstudio53@gmail.com">roarstudio53@gmail.com</a><br/><br/>
					</p>
					<div class="social"><a href="https://www.facebook.com/roarstudio"><img src="images/graphics/facebook.png"/></a>Facebook<br><a href="https://www.facebook.com/roarstudio">facebook.com/roarstudio</a></div>
					<div class="social"><a href="https://twitter.com"><img src="images/graphics/twitter.png"/></a>Twitter<br><a href="https://twitter.com">@roarstudio53</a></div>
					<div class="social"><a href="https://instagram.com"><img src="images/graphics/instagram.png"/></a>Instagram<br><a href="https://instagram.com">@roarstudio53</a></div>		
				</div>
			</div>
			<div style="clear:both"><br/></div>
			<div class="end"></div>
		</div>
		<div class="bottom"></div>
	</div>
	</div>
	<?php include_once 'usercontrol/footer.php';?>
</body>
<script>
	<!-- highlight -->
	setPage();
</script>
</html>