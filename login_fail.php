<?php include('_config.settings.php');
DEFINE('ROOT', '');
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
		<div id="banner-studio"></div>            
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>             
			</div>
			<div class="right">
				<div class="login">
				<img src="images/graphics/login.png"/><h1>Login Failed!</h1>				                       
                    <p>Having problem signing in?<br>
					Please click <a href="login.php" font color="white" >here</a>  to login again<br>					
                    
                    
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