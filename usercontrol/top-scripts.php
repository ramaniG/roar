<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Global -->
<link rel="stylesheet" href="<?php echo ROOT; ?>css/1140.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo ROOT; ?>css/style_global.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo ROOT; ?>css/navigation.css" type="text/css" media="screen" />

<!-- Google Web Fonts -->
<link href='http://fonts.googleapis.com/css?family=Scada' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Economica:700' rel='stylesheet' type='text/css'>

<!-- Cuffon -->
<script src="<?php echo ROOT; ?>js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php echo ROOT; ?>js/Agency_FB_400-Agency_FB_700.font.js" type="text/javascript"></script>
    
<!-- Menu highlight -->
<script src="<?php echo ROOT; ?>js/highlight.js" type="text/javascript"></script>

<!-- Image Caption -->
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery-1.8.2.min.js"></script>

<!-- Slide show -->
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery.galleryview-3.0-dev.js"></script>   
<link type="text/css" rel="stylesheet" href="<?php echo ROOT; ?>css/jquery.galleryview-3.0-dev.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<!-- Royal slider-->
<script src="<?php echo ROOT; ?>assets/royalslider/jquery.royalslider.min.js" /></script>
<link href="<?php echo ROOT; ?>assets/royalslider/royalslider.css" rel="stylesheet">
<link href="<?php echo ROOT; ?>assets/royalslider/skins/default/rs-default.css" rel="stylesheet">	
       
<script type="text/javascript">
		<!-- Cufon -->
        Cufon.replace('a.cufon', {hover: {color: '#DDD'}});
		Cufon.replace('a.active', {color: '#FFA800'});
		Cufon.replace('div.cufon', {color: '#FFF'});
		Cufon.replace('span.red', {color: 'red'});
		Cufon.replace('span.orange', {color: '#FF7F00'});
		Cufon.replace('span.blue', {color: '#007FFF'});
		Cufon.replace('a.white', {color: 'white'});

		$.browser.chrome = $.browser.webkit && !!window.chrome;
		$.browser.safari = $.browser.webkit && !window.chrome;
		if ($.browser.opera || $.browser.mozilla || $.browser.msie || $.browser.safari) { document.write("<script src=\"js\/colorup_min.js\"><\/script>")};
		
        $(function(){
            $('#myGallery, #myGallery2').galleryView({
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

		jQuery(document).ready(function($) {
		  $('#content-slider-1').royalSlider({
			autoHeight: true,
			arrowsNav: false,
			fadeinLoadedSlide: false,
			controlNavigationSpacing: 0,
			controlNavigation: 'none',
			imageScaleMode: 'none',
			imageAlignCenter:false,
			loop: false,
			loopRewind: true,
			numImagesToPreload: 6,
			keyboardNavEnabled: true,
			usePreloader: false,
			sliderDrag: false,
			sliderTouch: false,
			navigateByClick: false
		  });
		});		

</script>