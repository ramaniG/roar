<?php 
DEFINE('ROOT', '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';?>

<?php
require_once('email/roar_select_package.php');

$subject="Test mail";
$to="ramani_g@hotmail.com";
$body="This is a test mail";
if (roar_select_package("Ramani", "ramani_g@hotmail.com", "sample package", 100, 10))
	echo "Mail sent successfully!";
else
	echo"Mail not sent!";
?>
</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main.php';?>
		<?php include_once 'usercontrol/banner-small.php';?>
		<div id="content">
			<div class="top"></div>
			<div class="middle">
				<div class="left">
					<a href="http://roar.com.my" class="logo"><img
						src="images/logo/roar_music_logo.png" alt="roar_music_logo"> </a>
				</div>
				<div class="right"></div>
				<div style="clear: both">
					<br>
				</div>
				<div class="end"></div>
			</div>
			<div class="bottom"></div>
		</div>
	</div>
	<?php include_once 'usercontrol/footer.php';?>
</body>
</html>
