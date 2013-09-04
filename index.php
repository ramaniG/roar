<?php 
DEFINE('ROOT', '');
$current_page = "home-page";
require_once('_config.settings.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';
?>


</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main.php';?>
		<div id="banner">
			<div class="box b1">
				<a href="studio.php"><img src="images/banner/home-studio.jpg"
					id="test" class="sepia colorup" effect="mono" inverse="true"
					speed="900" /> </a>
				<div class="description">
					<div class="cufon title">
						<span class="orange">S</span><span>TUDIO</span>
					</div>
					<p class="d1">An environment engineered to be comfortable enough to
						let you feel at home, yet professionally equipped to allow top
						performance.</p>
				</div>
			</div>
			<div class="box b2">
				<a href="#"><img src="images/banner/home-events.jpg"
					class="sepia colorup" effect="mono" inverse="true" speed="900" /> </a>
				<div class="description">
					<div class="cufon title">
						<span class="red">E</span><span>VENTS</span>
					</div>
					<p class="d2">From private parties to corporate events, ROAR!!! has
						the right equipment to make your event an unforgettable occasion.</p>
				</div>
			</div>
			<div class="box b3">
				<a href="roarcademy.php"><img src="images/banner/home-academy.jpg"
					class="sepia colorup" effect="mono" inverse="true" speed="900" /> </a>
				<div class="description">
					<div class="cufon title">
						<span class="blue">A</span><span>CADEMY</span>
					</div>
					<p class="d3">Lessons beyond syllables with experienced and
						approachable instructors in a studio environment.</p>
				</div>
			</div>
		</div>
		<div id="home">
			<div style="height: 216px">
				<a href="/" onmouseover="mouseoversound.playclip()"><img
					src="images/logo/roar_music_logo.png" alt="roar studio logo"
					width="540" height="208" class="edgeLoad-EDGE-3437074" /> </a>
			</div>
			<p>Founded in 2009, ROAR!!! MUSIC was born from the vision of
				stimulating the local music industry through long-term hierarchical
				strategies starting from the fundamentals of providing quality
				rehearsal space for budding local artists, and hiring out sound
				systems in conjunction with event planning. The studio strives to
				provide the best experience by constantly maintaining and upgrading
				the studio and sound system facilities.</p>
			<div class="passion">
				Explore your passion<br />_\m/ ROAR!!! \m/_
			</div>
			<div class="end"></div>
		</div>
	</div>
	<?php include_once 'usercontrol/footer.php';?>
</body>
<script>
	<!-- highlight -->
	setAll();
</script>

<!--[if IE]>
<script>			
	$('#home img').animate({width: "540px"}, 500)	
	$('#home img').hover(
		function () {$(this).animate({width: "598px",marginTop:"-8px"}, 500);},
		function () {$('#home img').animate({width: "540px",marginTop:"0px"}, 500);}
		);	
</script>
<![endif]-->
</html>