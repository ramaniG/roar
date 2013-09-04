<?php 
DEFINE('ROOT', '');
include('_config.settings.php');
session_start();
?>

<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';?>
<script type="text/javascript" src="<?php echo _JQUERY; ?>"></script>
<script type="text/javascript" src="<?php echo _JQUERYVALIDATION; ?>"></script>
<script type="text/javascript" src="<?php echo _COREJS; ?>"></script>

</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main_2.php';?>
		<div id="banner-studio"></div>            
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>             
			</div>
			<div class="right">
            
            <div class="register">
	<section class="row-fluid registerform">
			<img src="images/graphics/login.png"/><h1>Registration successful</h1>	
            <div class="orange"></div><div class="grey"></div>
			Please click <a href="login.php" font color="white">here</a> to login</p>
			</section>
        </div> 
        </div>  
			<div style="clear:both"><br/></div>
			<div class="end"></div>
		</div>
		<div class="bottom"></div>
	</div>
	</div>
	</div>
	<?php include_once 'usercontrol/footer.php';?>
</body>
<script type='text/javascript'>
	function refreshCaptcha()
	{
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
</script>
</html>