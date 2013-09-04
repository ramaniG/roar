<div class="menu">
	<ul>
		<li id="home-page"><a class="cufon"
			href="<?php echo ROOT.''?>admin/index.php"><?php echo $name; ?> HOME</a>
		</li>
		<li id="usermanagement"><a class="cufon"
			href="<?php echo ROOT;?>admin/user/index.php">MEMBERS</a></li>
		<?php if ($adminid == 1){?>
		<li id="adminuser"><a class="cufon"
			href="<?php echo ROOT;?>admin/admin_user/index.php">ADMINISTRATOR</a></li>
		<?php }?>
		<li id="roarcreditmanage"><a class="cufon"
			href="<?php echo ROOT;?>admin/roarcreditmanage/index.php">ROAR CREDIT</a>
		</li>
		<li id="roarcreditpackage"><a class="cufon"
			href="<?php echo ROOT;?>admin/roarcreditpackage/index.php">TRANSACTION</a>
		</li>
		<li id="studiomanage"><a class="cufon"
			href="<?php echo ROOT;?>admin/studiomanage/index.php">STUDIO TIME SLOT</a>
		</li>
		<li id="booking"><a class="cufon"
			href="<?php echo ROOT;?>admin/booking/booking.php">ROARSERVATION</a></li>
		<li id="logout"><a class="cufon"
			href="<?php echo ROOT;?>admin/logout.php">LOGOUT</a>
		</li>
	</ul>
</div>
