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
								<li><a class="selected" href="roarcademy-teacher-naim.php" id="naim">Naim</a><img src="images/graphics/roar-drum-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-zamir.php" id="zamir">Zamir</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="page wrapper">
					<img src="images/roarcademy/naim.jpg" alt="naim" style="float:right; border:1px solid #333; width:400px; margin-bottom:14px"/>		
					<div style="float:left; width:248px; padding-right:50px">
						<h2>Muhammad Naim b. Jelani</h2>
						<p>Talented drummer withover 7 years exposure in progressive, jazz, latin and contemporary music. Self-taught when he initially discovered his passion for music, Naim later received formal training at the PlayByEarMusic InstituteSubang Jayafrom the established professional drummer, Jerry Felix  whose work had been showcased in concerts for Air Supply, Kris Dayanti, RamliSarip and Jaclyn Victor. Naim had performed at the battle of the bands at the.</p>																							
					</div>
					
					<div style="width:400px; float:right;">
					   Malaysian International Music Festival (MIME), and as sessionist atprivate events at UKMBangiand Stamford College. Naim also composes his own music which has won him an award at the Limelight Talent Competition.
					</div>
					<div style="border-bottom:1px solid #676767; width:100%; height:1px; clear:both; margin-bottom:20px"></div>
					<div style="float:left; width:248px; padding-right:50px; clear:both">		
						<h2>Drum Modules:</h2>
						<h3>Module 1 (rudiments)</h3>
						<ul>
							<li>Single stroke roll</li>
							<li>Double stroke roll</li>
							<li>Triple stroke roll</li>
							<li>Five stroke roll</li>
							<li>Six stroke roll</li>
							<li>Single stroke seven</li>
							<li>Paradiddle-diddle</li>
							<li>Double paradiddle</li>
							<li>Triple paradiddle</li>
							<li>Flams</li>
							<li>Flam accent</li>
							<li>Flam tap</li>
							<li>Unknown special rudiment</li>
							<li>Single stroke roll speed</li>
							<li>Single paradiddle applications</li>
							<li>Single ratamacue</li>
							<li>Triplet applications</li>
						</ul>
					</div>
					<div style="width:400px; float:right; margin-top:32px">
						<h3>Module 2</h3>
						<ul>
							<li>Dynamic Drumming:
								<ul style="margin-left:20px">
									<li>Beginner Opening- Closing Hats</li>
									<li>Beginner Ghost notes</li>
									<li>Beginner Cross Sticking</li>
									<li>Beginner Cross Sticking</li>
									<li>Cymbal Choking</li>
									<li>Hi-Hat Barking</li>
								</ul>
							</li>
							<li>Drum Theory:
								<ul style="margin-left:20px">
									<li>How to count quarter notes</li>
									<li>How to count eighth notes</li>
									<li>How to count sixteenth notes</li>
									<li>How to count 32nd notes</li>
									<li>How to count quarter note Triplets</li>
									<li>How to count 8th note Triplets</li>
									<li>How to count 16th note Triplets </li>
								</ul>
							</li>
							<li>Bass Drum Lessons:
								<ul style="margin-left:20px">
									<li>Flat Foot Technique</li>
									<li>Heel-Toe Technique</li>
									<li>Heel -Toe Technique Fills</li>
									<li>Essential Bass Drum Techniques (Heel down/Heel up)</li>
									<li>Beginner Single Bass Drum Speed</li>
									<li>Double Bass Warm Ups</li>
									<li>Beginner Double Bass Drum Fills</li>
								</ul>					
							</li>
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