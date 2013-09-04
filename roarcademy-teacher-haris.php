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
		<div id="banner-roarcademy"></div> 
		<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul>
						<li><a href="roarcademy.php" id="studio-a">Course Content</a></li>
						<li><a href="roarcademy-gallery.php" id="studio-a">Gallery</a></li>
						<li class="active" style="height:60px">&nbsp;</li>
						<li style="margin-top:-80px">
							<a href="#" id="roarcademy-teacher" style="color:white; font-size:28px">Roarcademy Teachers</a>
							<ul class="submenu">
								<li><a href="roarcademy-teacher-chino.php" id="chino">Chino</a><img src="images/graphics/roar-bass-icon.png" alt="roar-guitar-icons"/></li>
								<li><a class="selected" href="roarcademy-teacher-haris.php" id="haris">Haris</a><img src="images/graphics/roar-sitar-icon.png" alt="roar-guitar-icons"/></li>	
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
				<div  class="page wrapper">
					<img src="images/roarcademy/haris.jpg" alt="haris" style="float:right; border:1px solid #333; width:400px; margin-bottom:13px"/>		
					<div style="float:left; width:248px; padding-right:50px">
						<h2>Haris Ali Khan</h2>
						<p>Started learning to play the sitar from one of the most prominent sitar players of our generation Ustad Nafees Ahmed Khan from Napa (national academy of performing arts <a href=" http://www.napa.org.pk/">http://www.napa.org.pk/</a>) in the mid 2004. Over there he was introduced to both eastern classical music as well as western classical music that helped him to play with jazz musicians like Mike Del Ferro and more. Also hold the prestige of performing in front of the president and prime minister of Pakistan on two separate occasions. Haris Ali Khan has been performing in Malaysia with different people from different backgrounds. He has played with traditional musicians as well as with jazz and fusion music.</p>																							
					</div>
					<div style="width:400px;float:right">
						<h3>Sitar Course content:</h3>
						<ul>
							<li>Knowing about sitar as professional</li>
							<li>Strumming</li>
							<li>Scales</li>
							<li>Raags</li>
							<li>Improvisation</li>
							<li>Rhythm structures </li>
							<li>Do’s and don’ts of performing</li>
							<li>Sitar maintenance </li>
							<li>How to use sitar for genre other than eastern classical music</li>
							<li>Students will be taught to play sitar in eastern and western styles of music</li>
						</ul>					
					</div>											
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