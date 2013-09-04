<?php 
DEFINE('ROOT', '');
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
				<a href="http://www.roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul>
					<li class="active"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Gallery</a></li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div class="wrapper">


<!-- GALLERY -->
<div class="container-fluid">
	<?php
	$include = "AND aid = '121083117929683_1073741830' OR aid = '121083117929683_1073741829' OR aid = '121083117929683_1073741828' OR aid = '121083117929683_96410' OR aid = '121083117929683_96390' OR aid = '121083117929683_96389' OR aid = '121083117929683_95724' OR aid = '121083117929683_95724' OR aid = '121083117929683_94515' OR aid = '121083117929683_94078' OR aid = '121083117929683_91613' OR aid = '121083117929683_92678' OR aid = '121083117929683_92004' OR aid = '121083117929683_91741' OR aid = '121083117929683_91553' OR aid = '121083117929683_90899' OR aid = '121083117929683_90896' OR aid = '121083117929683_90490' OR aid = '121083117929683_89721' OR aid = '121083117929683_87918' OR aid = '121083117929683_87255' OR aid = '121083117929683_86376' OR aid = '121083117929683_85909' OR aid = '121083117929683_85898' OR aid = '121083117929683_13535' OR aid = '121083117929683_83742' OR aid = '121083117929683_82948' OR aid = '121083117929683_82947' OR aid = '121083117929683_82936' OR aid = '121083117929683_82935' OR aid = '121083117929683_80309' OR aid = '121083117929683_79887' OR aid = '121083117929683_79781' OR aid = '121083117929683_79780' OR aid = '121083117929683_78265' OR aid = '121083117929683_77687' OR aid = '121083117929683_75266' OR aid = '121083117929683_74521' OR aid = '121083117929683_72750' OR aid = '121083117929683_69497' OR aid = '121083117929683_69262' OR aid = '121083117929683_68606' OR aid = '121083117929683_67230' OR aid = '121083117929683_90899' OR aid = '121083117929683_66302' OR aid = '121083117929683_65595' OR aid = '121083117929683_59405' OR aid = '121083117929683_58657' OR aid = '121083117929683_57772' OR aid = '121083117929683_57593' OR aid = '121083117929683_56494' OR aid = '121083117929683_53023' OR aid = '121083117929683_50450' OR aid = '121083117929683_50520' OR aid = '121083117929683_50506' OR aid = '121083117929683_51827' OR aid = '121083117929683_51801' OR aid = '121083117929683_51721' OR aid = '121083117929683_51639' OR aid = '121083117929683_51609' OR aid = '121083117929683_51450' OR aid = '121083117929683_51325' OR aid = '121083117929683_51170' OR aid = '121083117929683_50966' OR aid = '121083117929683_50530' OR aid = '121083117929683_50073' OR aid = '121083117929683_48963' OR aid = '121083117929683_46965' OR aid = '121083117929683_46047' OR aid = '121083117929683_45997' OR aid = '121083117929683_36908' OR aid = '121083117929683_36470' OR aid = '121083117929683_36062' OR aid = '121083117929683_35372' OR aid = '121083117929683_34967' OR aid = '121083117929683_27101' OR aid = '121083117929683_28367' OR aid = '121083117929683_31068' OR aid = '121083117929683_11701' OR aid = '121083117929683_11678' OR aid = '121083117929683_10776' OR aid = '121083117929683_10595' OR aid = '121083117929683_9987'";
	
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
</html>