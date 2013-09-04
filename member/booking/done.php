<?php
DEFINE('ROOT', '../../');
include('header.php');


if(isset($_POST['submit_button']))
{
	$db = new Database();
	$studioid = $db->sqlSafe($_POST['studioid']);
	$datebooked = $db->sqlSafe($_POST['datebooked']);
	$timeslotid = $db->sqlSafe($_POST['timeslotid']);

	$id = explode(';', $timeslotid);
	$bookingno = select_booking_id();

	foreach ($id as $eachid)
	{
		if(!is_time_slot_exists($datebooked, $eachid, $studioid))
		{
			$sql="INSERT INTO booking (bookingno, memberid, datebooked, timeslotid, studioid, status, dateinserted)
			VALUES ('$bookingno', '$memberid', '$datebooked', '$eachid','$studioid', '".BookingStatus::NEWBOOKING."', now())";

			$db->query($sql);

			/*
			 * Send email to user
			* */
		}
		else
		{
			header('Location: step1.php?error=true');
		}
	}
	
	update_booking_running_id();
	?>




<fieldset align="center">
	<h2 class="head1">Booking Completed</h2>
	<br> <br> <br>
	<p>
		Your Booking No is:
		<?php echo $bookingno; ?>
	</p>
</fieldset>
<br>
<br>
<br>

<?php
$db->close();
$db = null;


include('footer.php');
}
else {
		header('Location: step1.php?error=true');
	}
	?>
