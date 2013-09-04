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
								<li><a href="roarcademy-teacher-haris.php" id="haris">Haris</a><img src="images/graphics/roar-sitar-icon.png" alt="roar-guitar-icons"/></li>	
								<li><a href="roarcademy-teacher-mazz.php" id="mazz">Mazz</a><img src="images/graphics/roar-bass-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-muhaimin.php" id="muhaimin">Muhaimin</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-naim.php" id="naim">Naim</a><img src="images/graphics/roar-drum-icon.png" alt="roar-guitar-icons"/></li>
								<li><a class="selected" href="roarcademy-teacher-zamir.php" id="zamir">Zamir</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="page wrapper">
					<div>
						<img src="images/roarcademy/zamir.jpg" alt="zamir" style="float:left; border:1px solid #333"/>
						<div style="float:left; width:348px; padding-left:50px">
							<h2>Zamir Abdul Kayum</h2>
							<ul style="float:left">
								<li>21 years old</li>
								<li>I primarily listen to rock and metal (though I'm open to a multitude of music styles)</li>
								<li>I've grown up around music from a very young age</li>
								<li>Active participant in music related endeavours</li>
							</ul>
							<h2>Experiences</h2>
							<ul style="float:left">
								<li>Played guitar since 11 years old</li>
								<li>Have played in a multitude of bands in an out of the Malaysian music scene, I currently play in local Alternative/Metal band 'Time & Tide'</li>
							</ul>
							<h2>Qualifications:</h2>
							<ul style="float:left">
								<li>Currently pursuing my Bachelor's in Professional Music at the International College of Music Kuala Lumpur while majoring in Guitar as my principal instrument.</li>
							</ul>				
						</div>
						<div style="border-bottom:1px solid #676767; width:100%; height:1px; clear:both; margin-bottom:20px"></div>
						<div style="width:100%; clear:both">
							<h2>Lesson Details:</h2>
							<p>I aim to teach the casual player, be it young, teenage or even old, if you want to learn guitar for yourself and aren't looking for pesky exams and certifications, if you just want to learn how to rock, that's my job. I teach standard playing techniques for both Acoustic and Electric guitar, plucking, strumming, different genre styles, even basic scale exercises that will help a player progress as a guitarist as well as a musician. By employing the use of songs to teach the fundamentals of music, students will develop a naturalistic and innovative feel that will encourage them to develop their own style and in time, discover their musical identity. I teach different techniques, as well as different genre's to help the player achieve a better understanding of the instrument.</p>
						</div>
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