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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
	<script src="bootstrap/js/bootstrap-dropdown.js"></script>
	<script src="bootstrap/js/bootstrap-tooltip.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css"/>
	
	<link rel="stylesheet" href="css/prettyPhoto.css"/>
	<script type="text/javascript" charset="utf-8">
	$(function () {
		$("a[rel^='prettyPhoto']").prettyPhoto({theme: 'dark_rounded',social_tools: '',deeplinking: false});
		$("[rel=tooltip]").tooltip();
	});
	</script>

</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main.php';?>
    <div id="banner-roarcademy"></div>            
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul>
						<li><a href="roarcademy.php" id="studio-a">Course Content</a></li>
						<li class="active"><a href="roarcademy-gallery.php" id="studio-a">Gallery</a></li>
						<li>						
						
							<a href="#" id="roarcademy-teacher" style="color:white">Roarcademy Teachers</a>
							<ul class="submenu">
								<li><a href="roarcademy-teacher-chino.php" id="chino">Chino</a><img src="images/graphics/roar-bass-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-haris.php" id="haris">Haris</a><img src="images/graphics/roar-sitar-icon.png" alt="roar-guitar-icons"/></li>	
								<li><a href="roarcademy-teacher-mazz.php" id="mazz">Mazz</a><img src="images/graphics/roar-bass-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-muhaimin.php" id="muhaimin">Muhaimin</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-naim.php" id="naim">Naim</a><img src="images/graphics/roar-drum-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-zamir.php" id="zamir">Zamir</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="wrapper">
				


<!-- GALLERY -->
<div class="container-fluid">
	<?php
	$include= "AND aid = '121083117929683_1073741825'";
	
	require('class.facebook-gallery.php');
	$cache = array('permission' => 'n',
					'location' => 'cache', // ensure this directory has permission to read and write
					'time' => 777);
	$gallery = new FBGallery('121083117929683','y',$cache, $include);
	?>
</div>		
 
				

				</div>
			</div>
			<div style="clear:both"><br/></div>
			<div class="end"></div>
		</div>
		<div class="bottom"></div>
	</div>

 </div>
	
<?php include 'footer.php' ?>

<script>

	<!-- highlight -->
	setPage();
				
</script>