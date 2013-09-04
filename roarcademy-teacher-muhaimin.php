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
								<li><a class="selected" href="roarcademy-teacher-muhaimin.php" id="muhaimin">Muhaimin</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-naim.php" id="naim">Naim</a><img src="images/graphics/roar-drum-icon.png" alt="roar-guitar-icons"/></li>
								<li><a href="roarcademy-teacher-zamir.php" id="zamir">Zamir</a><img src="images/graphics/roar-guitar-icon.png" alt="roar-guitar-icons"/></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="page wrapper">
					<img src="images/roarcademy/muhaimin.jpg" alt="muhaimin" style="float:right; border:1px solid #333; width:400px; margin-bottom:15px"/>		
					<div style="float:left; width:248px; padding-right:50px">
						<h2>Muhaimin</h2>
						<ul>
							<li>He was nine when he was asked by his music teacher in Cempaka Schools to select an instrument to play - he picked guitar. During the first year of his lessons, Abdul Muhaimin Mohamed Azman was very reluctant but as time passed and he became passionate about music, he later grew to love playing the guitar.</li>
							<li>Enrolling himself at Puppetshoulder Music and Danceworks Sdn Bhd, he took up guitar , piano and music theory . In 2009, he took Grade 5 Theory of Music Exam (ABRSM) and passed with distinction. Later, to advance himself further, he took up guitar lessons with Yamaha Music (Ampang Point) and Bentley Music (Mutiara Damansara).</li>
						</ul>
					</div>
					<div style="width:400px;float:right">
						<ul>
							<li>The music theory lessons he took helped him to understand and play other instruments such as piano, drums, violin etc and because of his deepfelt thirst for knowledge in music, may there be gigs or competitions, he will usually offer to perform with his friends.</li>
							<li>He's currently studying at the International College of Music (ICOM) in Setapak, Kuala Lumpur on a Berklee Transfer Programme (BTP) and will be in Semester 3 come January 2013. In his spare time, he teaches basic guitar and piano to primary schoolchildren.</li>
						</ul>					
					</div>
					<div style="border-bottom:1px solid #676767; width:100%; height:1px; clear:both; margin-bottom:20px"></div>
					<div style="width:100%; clear:both">
						<h2>Course content:</h2>
						<ul>
							<li>Chord shape techniques</li>
							<li>Picking technique</li>
							<li>Basic chords and progressions.</li>
							<li>Power chords</li>
							<li>Pentatonic scales</li>
							<li>Finger picking techniques</li>
							<li>Supplementary diatonic chords</li>
							<li>Major and minor scales</li>
							<li>Movable chords</li>
							<li>Arpeggios</li>
							<li>Improvisation (tapping, legato, tremolo picking, palm muting)</li>
							<li>Modulation/modes</li>
							<li>Intermediate and advance improvisation</li>
							<li>Each would have excerpt or a song to demonstrate each lesson.</li>
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