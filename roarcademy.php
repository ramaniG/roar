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
						<li class="active"><a href="roarcademy.php" id="studio-a">Course Content</a></li>
						<li>
						<li><a href="roarcademy-gallery.php" id="studio-a">Gallery</a></li>
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
				<div  class="page wrapper roarcademy">
					<div class="roarcademy">
						<div class="col1">
							<h1 class="first">Acoustic & Electric Guitar</h1>
							<ul>
								<li>Basic Chords and Progressions</li>
								<li>Scales</li>
								<li>Picking Technique</li>
								<li>Improvisation (Tapping, Legato, Tremolo, Palm muting, etc.)</li>
								<li>Modulation/Modes <span>and more..</span></li>
							</ul>
						</div>
						<div class="col2">
							<h1 class="first">Basic Concepts</h1>
							<ul>
								<li>Basic Rhythm, Theory, Reading, etc.</li>
								<li>Basic Blues</li>
								<li>Basic Rock</li>
							</ul>

							<h1>Advance Concepts</h1>
							<ul>
								<li>Advance rhythm and theory</li>
								<li>Basic Jazz</li>
								<li>Basic Funk</li>
								<li>Basic Latin</li>
								<li>Special Tecniques (Slap, Pop, Tap, etc.)</li>
								<li>Improvisation</li>
								<li>Grooves<span>and more..</span></li>
							</ul>				
						</div>
						<div class="col3">
							<h1 style="margin-top:40px !important">&nbsp;</h1>
							<ul>
								<li>Strumming</li>
								<li>Scales</li>
								<li>Raags</li>
								<li>Improvisation</li>
								<li>Rhythm Structures<span>and more..</span></li>
							</ul>
						</div>
						<div class="col4">
							<h1 class="first">Module 1 - Rudiments</h1>
							<ul>
								<li>Stroke Rolls</li>
								<li>Paradiddles</li>
								<li>Flams</li>
								<li>Triplets</li>
							</ul>
							<h1>Module 2 - Dynamic Drumming</h1>
							<ul>
								<li>Hihat Technique</li>
								<li>Cymbal Technique</li>
								<li>Ghost Notes</li>
								<li>Cross Sticking</li>
							</ul>
							<h1>Drum Theory</h1>
							<ul>
								<li>Note Counting</li>
							</ul>
							<h1>Bass Drum Lesson</h1>
							<ul>
								<li>Foot Technique</li>
								<li>Heel-toe Technique Single and Double</li>
								<li>Bass Drum fills<span>and more..</span></li>
							</ul>
						</div>
						<span style="color:#d7d7d7">*All instruments provided</span>
						<div style="height:20px; width:100%"></div>
						<div style="background:url(images/roarcademy/explore-your-passion.png) no-repeat right">
							<table class="roarcademyTable">
								<tr>
									<td>Course</td>
									<td>Monthly Fees<br><span>Half an hour per week</span></td>
									<td>Method</td>
								</tr>
								<tr>
									<td>Guitar</td>
									<td>RM 150.00</td>
									<td>Face to Face</td>
								</tr>
								<tr>
									<td>Sitar</td>
									<td>RM 150.00</td>
									<td>Face to Face</td>
								</tr>
								<tr>
									<td>Bass</td>
									<td>RM 150.00</td>
									<td>Face to Face</td>
								</tr>
								<tr>
									<td>Drum</td>
									<td>RM 150.00</td>
									<td>2 Drum Sets<br>Face to Face</td>
								</tr>							
							</table>
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