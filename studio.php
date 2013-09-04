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
		<div id="banner-studio"></div>           
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
				<div class="menu">
					<ul id="main-menu">
						<li><a href="#" id="studio-a">Studio A</a></li>
						<li><a href="#" id="studio-b">Studio B</a></li>
						<li><a href="studio-gallery.php">Gallery</a></li>
					</ul>
				</div>
			</div>
			<div class="right">
				<div  class="page wrapper">    
					<iframe width="640" height="360" src="http://www.youtube.com/embed/kD6aDIYaCuo" frameborder="0" style="margin:0 auto; display:block" allowfullscreen></iframe>
					<!-- slider code start -->
					<div class="row clearfix">
						<div class="wrapper">	
							<div id="content-slider-1" class="royalSlider contentSlider rsDefault">     
								<div class="wrapper_a">	
									<h1>Studio A</h1>
									<p>What is the colour of your music? At Studio A, your tune ROARS in the colour of passion. Fully equipped for a 7-piece band in an environment engineered to let your music soar, this is the room that witnessed the beginning of quite a few budding bands. Explore and hone your skills with your band mates and join the bevy of renegades in a music revolution of your own.</p>
									<ul id="myGallery">
										<li><img data-frame="images/studio/a/01.jpg" src="images/studio/a/01.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/02.jpg" src="images/studio/a/02.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/03.jpg" src="images/studio/a/03.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/04.jpg" src="images/studio/a/04.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/05.jpg" src="images/studio/a/05.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/06.jpg" src="images/studio/a/06.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/07.jpg" src="images/studio/a/07.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/08.jpg" src="images/studio/a/08.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/09.jpg" src="images/studio/a/09.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/a/10.jpg" src="images/studio/a/10.jpg" alt="studio_a"/></li>
									</ul>
								</div>
								<div class="wrapper_b">
									<h1>Studio B</h1>
									<p>If a cosy setting is more to your liking, Studio B would be the perfect place to put your guitar act together. Take a minuet and the treble to put your tune together and make it your forte. The ambiance of the studio alone would be enough to stir anyone’s fervour into a crescendo!</p>
									<ul id="myGallery2">
										<li><img data-frame="images/studio/b/01.jpg" src="images/studio/b/01.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/02.jpg" src="images/studio/b/02.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/03.jpg" src="images/studio/b/03.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/04.jpg" src="images/studio/b/04.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/05.jpg" src="images/studio/b/05.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/06.jpg" src="images/studio/b/06.jpg" alt="studio_a"/></li>
										<li><img data-frame="images/studio/b/07.jpg" src="images/studio/b/07.jpg" alt="studio_a"/></li>
									</ul>
								</div>
							</div>
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

var abc= getUrlVars()["studio"];

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

	<!-- highlight -->
	setPage();
	if (abc.substring(0,1) == "a"){
		$('#content-slider-1').prepend($('.wrapper_a'));
		$('#studio-b').parent().removeClass('active');
		$('#studio-a').parent().addClass('active');
		
		$('#studio-a').click(function() {
		$('.royalSlider').royalSlider('goTo', 0);
		$('#studio-b').parent().removeClass('active');
		$('#studio-a').parent().addClass('active');		
	});

	$('#studio-b').click(function() {
		$('.royalSlider').royalSlider('goTo', 1);	
		$('#studio-b').parent().addClass('active');
		$('#studio-a').parent().removeClass('active');		
	});	

	} else {
		$('#content-slider-1').prepend($('.wrapper_b'));
		$('#studio-a').parent().removeClass('active');
		$('#studio-b').parent().addClass('active');
		
		$('#studio-a').click(function() {
		$('.royalSlider').royalSlider('goTo', 1);
		$('#studio-b').parent().removeClass('active');
		$('#studio-a').parent().addClass('active');		
	});

	$('#studio-b').click(function() {
		$('.royalSlider').royalSlider('goTo', 0);	
		$('#studio-b').parent().addClass('active');
		$('#studio-a').parent().removeClass('active');		
	});		

	}

</script>
</html>