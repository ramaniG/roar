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
		<div id="banner-studio"></div>           
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul>
						<li ><a href="studio.php" id="studio-a">Studio A</a></li>
						<li><a href="studio-b.php" id="studio-b">Studio B</a></li>
						<li class="active"><a href="studio-gallery.php">Gallery</a></li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="page wrapper">    

<!-- GALLERY -->
<div class="container-fluid">
	<?php
	$include = "AND aid = '121083117929683_26873' OR aid = '121083117929683_72415' OR aid = '121083117929683_61768' OR aid = '121083117929683_1073741826' OR aid = '121083117929683_59843' OR aid = '121083117929683_84618' OR aid = '121083117929683_77143' OR aid = '121083117929683_77058' OR aid = '121083117929683_75247' OR aid = '121083117929683_75181' OR aid = '121083117929683_71210' OR aid = '121083117929683_70463' OR aid = '121083117929683_70181' OR aid = '121083117929683_35782' OR aid = '121083117929683_68852' OR aid = '121083117929683_67350' OR aid = '121083117929683_65594' OR aid = '121083117929683_35650' OR aid = '121083117929683_57646' OR aid = '121083117929683_57257' OR aid = '121083117929683_36177' OR aid = '121083117929683_56049' OR aid = '121083117929683_47499' OR aid = '121083117929683_55852' OR aid = '121083117929683_53118' OR aid = '121083117929683_53116' OR aid = '121083117929683_45634' OR aid = '121083117929683_50529' OR aid = '121083117929683_48959' OR aid = '121083117929683_48596' OR aid = '121083117929683_48591' OR aid = '121083117929683_48589' OR aid = '121083117929683_27541' OR aid = '121083117929683_46964' OR aid = '121083117929683_45997' OR aid = '121083117929683_46047' OR aid = '121083117929683_45312' OR aid = '121083117929683_44600' OR aid = '121083117929683_44956' OR aid = '121083117929683_42814' OR aid = '121083117929683_43639' OR aid = '121083117929683_43039' OR aid = '121083117929683_9471' OR aid = '121083117929683_36051' OR aid = '121083117929683_35302' OR aid = '121083117929683_35290' OR aid = '121083117929683_34873' OR aid = '121083117929683_34125' OR aid = '121083117929683_8883' OR aid = '121083117929683_33886' OR aid = '121083117929683_30421' OR aid = '121083117929683_13909' OR aid = '121083117929683_28015' OR aid = '121083117929683_25965' OR aid = '121083117929683_22766' OR aid = '121083117929683_12961' OR aid = '121083117929683_13229' OR aid = '121083117929683_13228' OR aid = '121083117929683_9323' OR aid = '121083117929683_11538' OR aid = '121083117929683_10459' OR aid = '121083117929683_10260' OR aid = '121083117929683_10207' OR aid = '121083117929683_10121' OR aid = '121083117929683_9866' OR aid = '121083117929683_9128' OR aid = '121083117929683_9017' OR aid = '121083117929683_9112' OR aid = '121083117929683_8874' OR aid = '121083117929683_44953'";
	
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