<?php
	require_once(ROOT.'_config.settings.php');
	require_once(ROOT.'sso/session.php');

	$memberid = safe_input(member_session());

	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$limit = 50;
	$curr_page = ($page * $limit) - $limit;

	$name = '';
	$db = new Database();

	$sql = "SELECT name FROM member WHERE id = '{$memberid}' LIMIT 0, 1";
	$result = $db->query($sql);
	$row = '';
	while ($row = mysql_fetch_row($result)) {
		$name =  $row[0];
	}
?>




<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title>ROAR!!! Member Area</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- jQuery load -->
	<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>

    <!-- Cuffon -->
    <script src="../../js/cufon-yui.js" type="text/javascript"></script>
	<script src="../../js/Agency_FB_400-Agency_FB_700.font.js" type="text/javascript"></script>

    <!-- Menu highlight -->
    <script src="../../js/highlight.js" type="text/javascript"></script>

    <!-- menu highlight included by Lee -->
    <script src="../../js/script.js" type="text/javascript"></script>

	<script type="text/javascript"><!-- -->
        Cufon.replace('a.cufon', {hover: {color: '#DDD'}});
		Cufon.replace('a.active', {color: '#FFA800'});
		Cufon.replace('div.cufon', {color: '#FFF'});
		Cufon.replace('span.red', {color: 'red'});
		Cufon.replace('span.orange', {color: '#FF7F00'});
		Cufon.replace('span.blue', {color: '#007FFF'});

		Cufon.replace('a.white', {color: 'white'});
    </script>

	<!-- Google Web Fonts fonts js -->
	<link href='http://fonts.googleapis.com/css?family=Scada' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="../../css/1140.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../../css/style_global.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../../css/navigation.css" type="text/css" media="screen" />

    <!--fb-album-->
    <link media="all" href="../../css/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css">
	<link media="all" href="../../css/jquery.fb-album.css" rel="stylesheet" type="text/css">

    <!--- Image Caption -->
	<!--<script type="text/javascript" src="../../js/jquery-1.8.2.js"></script>-->
	<!--<script type="text/javascript" src="../../js/jquery-1.8.2.min.js"></script>-->

   	<!--- Slide show -->
	<script type="text/javascript" src="../../js/jquery.timers-1.2.js"></script>
	<script type="text/javascript" src="../../js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="../../js/jquery.galleryview-3.0-dev.js"></script>

    <link type="text/css" rel="stylesheet" href="../../css/jquery.galleryview-3.0-dev.css" />

    <!-- GalleryView() function on your unordered list(s) -->
    <script type="text/javascript">
        $(function(){
            $('#myGallery').galleryView({
            transition_speed: 1000, 		//INT - duration of panel/frame transition (in milliseconds)
            transition_interval: 2000, 		//INT - delay between panel/frame transitions (in milliseconds)
            easing: 'swing', 				//STRING - easing method to use for animations (jQuery provides 'swing' or 'linear', more available with jQuery UI or Easing plugin)
            show_panels: true, 				//BOOLEAN - flag to show or hide panel portion of gallery
            show_panel_nav: true, 			//BOOLEAN - flag to show or hide panel navigation buttons
            enable_overlays: true, 			//BOOLEAN - flag to show or hide panel overlays

            panel_width: 680, 				//INT - width of gallery panel (in pixels)
            panel_height: 453, 				//INT - height of gallery panel (in pixels)
            panel_animation: 'slide', 		//STRING - animation method for panel transitions (crossfade,fade,slide,none)
            panel_scale: 'fit', 			//STRING - cropping option for panel images (crop = scale image and fit to aspect ratio determined by panel_width and panel_height, fit = scale image and preserve original aspect ratio)
            overlay_position: 'bottom', 	//STRING - position of panel overlay (bottom, top)
            pan_images: true,				//BOOLEAN - flag to allow user to grab/drag oversized images within gallery
            pan_style: 'drag',				//STRING - panning method (drag = user clicks and drags image to pan, track = image automatically pans based on mouse position
            pan_smoothness: 15,				//INT - determines smoothness of tracking pan animation (higher number = smoother)
            start_frame: 1, 				//INT - index of panel/frame to show first when gallery loads
            show_filmstrip: true, 			//BOOLEAN - flag to show or hide filmstrip portion of gallery
            show_filmstrip_nav: false, 		//BOOLEAN - flag indicating whether to display navigation buttons
            enable_slideshow: false,			//BOOLEAN - flag indicating whether to display slideshow play/pause button
            autoplay: false,				//BOOLEAN - flag to start slideshow on gallery load
            show_captions: false, 			//BOOLEAN - flag to show or hide frame captions
            filmstrip_size: 3, 				//INT - number of frames to show in filmstrip-only gallery
            filmstrip_style: 'scroll', 		//STRING - type of filmstrip to use (scroll = display one line of frames, scroll filmstrip if necessary, showall = display multiple rows of frames if necessary)
            filmstrip_position: 'bottom', 	//STRING - position of filmstrip within gallery (bottom, top, left, right)
            frame_width: 132, 				//INT - width of filmstrip frames (in pixels)
            frame_height: 88, 				//INT - width of filmstrip frames (in pixels)
            frame_opacity: 0.5, 			//FLOAT - transparency of non-active frames (1.0 = opaque, 0.0 = transparent)
            frame_scale: 'crop', 			//STRING - cropping option for filmstrip images (same as above)
            frame_gap: 4, 					//INT - spacing between frames within filmstrip (in pixels)
            show_infobar: true,				//BOOLEAN - flag to show or hide infobar
            infobar_opacity: 1				//FLOAT - transparency for info bar
            });
        });
    </script>

</head>

<body>

 <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


<div id="wrapper">
	<div id="top">
		<div id="xtra">
        	<a href="#" class="roarservation"></a>
			<a href="#" class="rock" title="ROAR!!!">Rock Sign</a>
		</div>
		<div id="menu">
        	<ul>
        		<li class="active"><div><div><div><a class="cufon active" href="../../studio.html">Studio</a></div></div></div></li>
            	<li><div><div><div><a class="cufon" href="#">Events</a><span style="margin-left:15px">COMING SOON!!!</span></div></div></div></li>
            	<li><div><div><div><a class="cufon" href="#">Academy</a><span style="margin-left:22px">COMING SOON!!!</span></div></div></div></li>
            	<li><div><div><div><a class="cufon" href="contact.html">Contact Us</a></div></div></div></li>
				<li><div><div><div><a class="cufon" href="#">Login</a><span style="margin-left:10px">COMING SOON!!!</span></div></div></div></li>
        	</ul>
		</div>
    </div>
    <div class="clear"></div>

    <div id="banner-studio"></div>

        <div id="content">
        	<div class="top"></div>
			<div class="middle">
            	<div class="left">
                	<a href="http://www.roar.com.my" class="logo"><img src="../../images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>
                    <div class="menu">
                        <ul>
                            <li id="home-page" ><a class="cufon" href="../../member/index.php">MEMBER HOME</a></li>
							<li id="booking" class="active"><a class="white" href="../../member/booking/step1.php">MAKE A BOOKING</a></li>
                            <li id="change-pwd"><a class="cufon" href="../../member/changepassword.php">CHANGE PASSWORD</a></li>
                            <li id="logout"><a class="cufon" href="../../member/logout.php">LOGOUT</a></li>
                        </ul>
                    </div>
				</div>
			<div class="right">
			<div class="wrapper">

			<style>
				.head1{
					padding: 0;
					margin-bottom: 20px;
					font-family: 'Raleway', sans-serif;
					color: #e79703;
					font-size: 30px;
					font-weight: bold;
				}
			</style>

<?php
	/* function addDate($date,$day)//add days
	{
		return strtotime(date("d/m/Y", strtotime($date)) . " +{$day} day");
	}


	//Check time slot availability for 7 days.

	$timeslot = array();
	$timeslotdesc = array();
	$sql = "SELECT id, description FROM timeslot";
	$result = $db->query($sql);
	if($db->numRows($result) > 0) {
		$i = 0;
		while ($row = mysql_fetch_row($result)) {
			$timeslot[$i] = $row[0];
			$timeslotdesc[$i] = $row[1];
			$i++;
		}
	}
	$studio = array();
	$studiodesc = array();
	$sql = "SELECT id, description FROM studio";
	$result = $db->query($sql);
	if($db->numRows($result) > 0) {
		$i = 0;
		while ($row = mysql_fetch_row($result)) {
			$studio[$i] = $row[0];
			$studiodesc[$i] = $row[1];
			$i++;
		}
	}

	for($z=0; $z< count($studio); $z++ ){

		echo "<div>";
		echo "<p align='center' class='head1'>$studiodesc[$z]</p><br>";
		echo "<table border=1>";
		echo "<tr><td></td>";
		foreach($timeslotdesc as $desc) {
			echo "<th>{$desc}</th>";
		}
		echo "</tr>";

		$newdate = new DateTime(date('Y-m-d'));
		//$newdate->modify('+1 day');
		for($k=1; $k<=7; $k++) {
			echo "<tr><td>{$newdate->format('d/m/Y')}</td>";
			for($j=0; $j< count($timeslot); $j++ ){
				$status = is_time_slot_exists($newdate->format('d/m/Y'), $timeslot[$j], $studio[$z]);
				if($status != false) {
					if($status == 'new')
						echo "<td style='background:yellow;'>&nbsp;</td>";
					elseif($status == 'approved')
						echo "<td style='background:red;'>&nbsp;</td>";
				}
				else {
					echo "<td style='background:green;'>&nbsp;</td>";
				}
			}
			$newdate->modify('+1 day');
			echo '</tr>';
		}
		echo "</table>";
		echo "</div><br><br>";
	} */
?>