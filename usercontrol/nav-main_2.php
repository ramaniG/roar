	<div id="top">
		<div id="xtra">
        	<a href="#" class="roarservation"></a>
			<a href="#" class="rock" title="ROAR!!!">Rock Sign</a>

		</div>
		<script src="<?php echo ROOT; ?>js/jquery.modern-blink.js"></script>
		<script>
			jQuery(function($) {
				$('.js-blink-infinite').modernBlink();

				$('.js-blink-5').modernBlink({
					iterationCount: 5
				});

				$('.js-blink-manual').modernBlink({
					auto: false
				});
				$('.js-btn-start').on( 'click', function() {
					$('.js-blink-manual').modernBlink('start');
				});
				$('.js-btn-stop').on( 'click', function() {
					$('.js-blink-manual').modernBlink('stop');
				});

				$('.js-blink-furiously').modernBlink({
					duration: '300'
				});
			});
		</script>
<?php include('_config.settings.php'); 

?>





		<div id='cssmenu'>
<ul>
	
   <?php echo "<li class='has-sub'><a href='".BASE."/index.php'><span>HOME</span></a></li>"; ?>
   <?php echo "<li class='has-sub'><a href='".BASE."/studio.php'><span>STUDIO</span></a>"; ?>
      <ul>
         <?php echo "<li class='has-sub'><a href='".BASE."/studio.php'><span>STUDIO A</span></a>
         </li>"; ?>
         <?php echo "<li class='has-sub'><a href='".BASE."/studio-b.php'><span>STUDIO B</span></a>
         </li>"; ?>
         <?php echo "<li class='has-sub'><a href='".BASE."/studio-gallery.php'><span>GALLERY</span></a>
         </li>"; ?>
      </ul>
   </li>
   <li><a href='#'><span>EVENTS</span></a></li>
   <?php echo "<li><a href='".BASE."/roarcademy.php'><span>ROARCADEMY</span></a></li>"; ?>
   <?php echo "<li><a href='".BASE."/contact.php'><span>CONTACT US</span></a></li>"; ?>
      <li class='has-sub'><a href='#'><span>GALLERY</span></a>
      <ul>
         <?php echo "<li class='has-sub'><a href='".BASE."/studio-gallery.php'><span>STUDIO</span></a>
         </li>"; ?>
         <?php echo "<li class='has-sub'><a href='".BASE."/events-gallery.php'><span>EVENTS</span></a>
         </li>"; ?>
         <?php echo "<li class='has-sub'><a href='".BASE."/roarcademy-gallery.php'><span>ROARCADEMY</span></a>
         </li>"; ?>
      </ul>
      <?php echo "<li><a href='".BASE."/login.php'><span>LOGIN</span></a></li>"; ?>
   </li>
   
</ul>
</div>
	</div>

    <div class="clear"></div>