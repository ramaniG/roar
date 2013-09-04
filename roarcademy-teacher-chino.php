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
								<li><a class="selected" href="roarcademy-teacher-chino.php" id="chino">Chino</a><img src="images/graphics/roar-bass-icon.png" alt="roar-guitar-icons"/></li>
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
				<div  class="page wrapper">
					<img src="images/roarcademy/chino.jpg" alt="chino" style="float:left; border:1px solid #333; width:400px; margin-bottom:10px"/>		
					<div style="float:right; width:248px; padding-left:50px">
						<h2>Mohd Hafriz Aizat Dzamri (Chino)</h2>
						<ul>
							<li>27 years Old</li>
							<li>Currently a bass player for ‘F.I.A’ band</li>
							<li>Listened to Classic rock, Blues, jazz, funky, soul, pop, acid and all the grooves</li>
							<li>Grown up with a very music-lover father</li>
							<li>Played bass and drums since young age</li>
							<li>Currently on a project in studying music of the American pop rock band called TOTO and doing some sessions on recordings</li>
						</ul>																							
					</div>
					<div style="width:100%; clear:both">
						<h2>Experiences</h2>
						<ul>
							<li>Played in various bands since school days</li>
							<li>Get a basic music lessons in one of the music school in Penang (Hamley Music School)</li>
							<li>Experienced with lots of Malaysian legends such as (Heavy Machine band, Aces band, Purple Haze, Freedom and many more)</li>
							<li>Aiming to let student know what is the beauty and the importance of the bass in music. Without music, life would be a mistake.</li>							
						</ul>						
							
					</div>
					<div style="border-bottom:1px solid #676767; width:100%; height:1px; clear:both; margin-bottom:20px"></div>
					<img src="images/roarcademy/chino2.jpg" alt="chino" style="float:left; border:1px solid #333; width:400px; margin-bottom:10px"/>
					<div style="float:right; width:248px; padding-left:50px">
						<h3>Scales</h3>
						<ul>
							<li>Minor</li>
							<li>Major</li>
							<li>Pentatonic</li>
						</ul>					
						<h3>Octaves</h3>
						<ul>
							<li>Introduction to varieties of Octave</li>
							<li>All notes octave</li>
						</ul>
						<h3>Tabs</h3>
						<ul>
							<li>How to read tabs</li>
						</ul>
						<h3>Music Genres and its playing (intermediate)</h3>
						<ul>
							<li>Introduction to bass playing in Rock, Classic rock, Jazz, Blues Pop &amp; etc.</li>
							<li>Techniques improvisations</li>
							<li>Groove (the importance of it and how to apply)</li>
							<li>Blues bass (the roots)</li>
							<li>Rock, metal, jazz and funk concept.</li>
						</ul>
						<h3>One to One session (intermediate)</h3>
						<ul>
							<li>Knowing what is your ‘favourite’ genres?</li>
							<li>What are your capabilities?</li>
						</ul>
						<h3>Jam session with a band</h3>
					</div>
	
					<div style="width:400px;float:left">
						<h2>Bass Lessons For Beginners</h2>
						<h3>Bass Basic</h3>
						<ul>
							<li>What is bass guitar? (role of the bass)</li>
							<li>‘Foreplay’ (how to tune, to know standard tunes, sounds)</li>
							<li>Notes introduction (standard notes, sharps and flats etc.)</li>
							<li>Fretboards</li>
							<li>The Elements of Music</li>
						</ul>
						<h3>Basic Bass Technique</h3>						
						<ul>
							<li>Introduction</li>
							<li>Open Strings and notes playing</li>
							<li>Fingering</li>
						</ul>
						<h3>Rhythms</h3>
						<ul>
							<li>The role of a bass player in the rhythm section</li>
							<li>Metronomes introduction</li>
							<li>Tempo,counting</li>
							<li>Keeping the beat (to keep steady in different tempo)</li>
							<li>Playing a steady pulse</li>							
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