<?php 
DEFINE('ROOT', '../../');
$current_page = "booking";
require_once(ROOT.'sso/session.php');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'email/booking_received.php');

$adminid = safe_input(admin_session());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Roar: Admin</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
<?php include_once '../admin-header.php';?>
<?php
if(isset($_GET['studioid']))
{
	$studio = $_GET['studioid'];
	$timeslotId = $_GET['timeslotid'];
}


if(isset($_POST['submit'])) {
	$sql = "";
	$user_timeslotid = json_decode($_POST['user_timeslotid']);
	$user_exist = $_POST['user_exist'];
	$bookingnolist = "";
	$startTime = select_timeslot_starttime();
	$endTime = select_timeslot_endtime();

	if ($user_exist == "yes")
	{
		$user_list = $_POST['user_list'];
		$userid = explode(',', $user_list)[0];
		$username = explode(',', $user_list)[2];
		$useremail = explode(',', $user_list)[3];
		$roar_use = $_POST['roar_use'];

		if ($roar_use == 'yes')
		{
			$totalRoar = 0;
			foreach ($user_timeslotid as $each)
			{
				$bookingno = select_booking_id();
				$datemodifier = $each->date - 1;
				$today = date("Y-m-d");
				$bookeddate = date("Y-m-d H:i:s", strtotime($today." +$datemodifier days"));
				$bookeddate_email = date("d M Y", strtotime($today." +$datemodifier days"));
				$timeslotid = $each->id;
				
				if ($studio == 1)
				{
					$totalRoar = $totalRoar + count(explode(',', $timeslotid)) * STUDIOAPRICE;
					$roarcredit = count(explode(',', $timeslotid)) * STUDIOAPRICE;
				}
				elseif ($studio == 2)
				{
					$totalRoar = $totalRoar + count(explode(',', $timeslotid)) * STUDIOBPRICE;
					$roarcredit = count(explode(',', $timeslotid)) * STUDIOBPRICE;
				}
					
				$bookingid = insert_new_booking($bookingno, $userid, $studio, $bookeddate, $timeslotid);
					
				if($bookingnolist == "")
					$bookingnolist = $bookingno;
				else
					$bookingnolist = $bookingnolist.';'.$bookingno;
					
				$splitId = explode(',', $timeslotid);

				$start = $startTime[$splitId[0] - 1];
				$end = $endTime[$splitId[count($splitId) - 1] - 1];
				$time = $start.' - '.$end;

				booking_received($username, $useremail, select_studio($studio)['description'], $bookeddate_email, $time, $bookingno, $roarcredit);

				update_booking_running_id();
			}

			if($bookingnolist != "")
			{
				update_roar_credit($userid, $totalRoar, false, "'.$bookingnolist.'", 0);
			}
		}
		elseif ($roar_use == 'no')
		{
			$totalRoar = 0;
			foreach ($user_timeslotid as $each)
			{
				$bookingno = select_booking_id();
				$datemodifier = $each->date - 1;
				$today = date("Y-m-d");
				$bookeddate = date("Y-m-d H:i:s", strtotime($today." +$datemodifier days"));
				$bookeddate_email = date("d M Y", strtotime($today." +$datemodifier days"));
				$timeslotid = $each->id;
				
				if ($studio == 1)
				{
					$totalRoar = $totalRoar + count(explode(',', $timeslotid)) * STUDIOAPRICE;
				}
				elseif ($studio == 2)
				{
					$totalRoar = $totalRoar + count(explode(',', $timeslotid)) * STUDIOBPRICE;
				}
					
				$bookingid = insert_new_booking($bookingno, $userid, $studio, $bookeddate, $timeslotid);
					
				if($bookingnolist == "")
					$bookingnolist = $bookingno;
				else
					$bookingnolist = $bookingnolist.';'.$bookingno;

				$splitId = explode(',', $timeslotid);

				$start = $startTime[$splitId[0] - 1];
				$end = $endTime[$splitId[count($splitId) - 1] - 1];
				$time = $start.' - '.$end;

				booking_received($username, $useremail, select_studio($studio)['description'], $bookeddate_email, $time, $bookingno, 0);
					
				update_booking_running_id();
			}
		}
	}
	elseif ($user_exist == "no")
	{
		$user_email = $_POST['user-email'];
		$user_name_nonuser = $_POST['user-name-nonuser'];

		foreach ($user_timeslotid as $each)
		{
			$bookingno = select_booking_id();
			$datemodifier = $each->date - 1;
			$today = date("Y-m-d");
			$bookeddate = date("Y-m-d H:i:s", strtotime($today." +$datemodifier days"));
			$bookeddate_email = date("d M Y", strtotime($today." +$datemodifier days"));
			$timeslotid = $each->id;

			$bookingid = insert_new_booking($bookingno, 0, $studio, $bookeddate, $timeslotid);

			$sql = "INSERT INTO booking_nonuser(bookingid, email, name) VALUES($bookingid, '$user_email', '$user_name_nonuser');";


			$db->query($sql) or die(mysql_error());

			if($bookingnolist == "")
				$bookingnolist = $bookingno;
			else
				$bookingnolist = $bookingnolist.';'.$bookingno;

			$splitId = explode(',', $timeslotid);

			$start = $startTime[$splitId[0] - 1];
			$end = $endTime[$splitId[count($splitId) - 1] - 1];
			$time = $start.' - '.$end;

			booking_received($user_name_nonuser, $user_email, select_studio($studio)['description'], $bookeddate_email, $time, "");

			update_booking_running_id();
		}
	}

	if(!empty($bookingnolist) && $bookingnolist != "")
	{
		echo '<script type="text/javascript">alert("Booking have been sucessfully made. Booking Ref : '.$bookingnolist.'. Please check email.");
					window.location.href = "booking.php";</script>';
	}
	else
	{
		echo '<script type="text/javascript">alert("Booking Failed.");
					window.location.href = "booking.php";</script>';
	}
}
?>
<script type="text/javascript">
var startTime = <?php echo json_encode(select_timeslot_starttime()); ?>;
var endTime = <?php echo json_encode(select_timeslot_endtime()); ?>;
</script>
<script type="text/javascript" src="conformation.js"></script>
</head>

<body>
	<?php include_once ROOT.'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once ROOT.'usercontrol/nav-main.php';?>
		<?php include_once ROOT.'usercontrol/banner-small.php';?>
		<div id="content">
			<div class="top"></div>
			<div class="middle">
				<div class="left">
					<a href="http://roar.com.my" class="logo"><img
						src="<?php echo ROOT; ?>images/logo/roar_music_logo.png"
						alt="roar_music_logo"> </a>
					<?php include_once '../admin_menu.php';?>
				</div>
				<div class="right">
					<div class="wrapper">
						<form method="post"
							action="confirmation.php?&studioid=<?php echo $studio;?>&timeslotid=<?php echo $timeslotId; ?>"
							onsubmit="return validateForm()" id="payment_form"
							enctype="multipart/form-data">
							<span>Booking Details</span> <br /> <label>Studio : </label> <label><?php echo select_studio($studio)['description'];?>
							</label> <br /> <label>Dates and Time :</label>
							<div id="timedate"></div>
							<label>Total Roar Credit Charged : </label> <label
								id="roar_charges"> <?php
								if ($studio == 1)
									echo count(explode(';',$timeslotId)) * STUDIOAPRICE;
								else
									echo count(explode(';',$timeslotId)) * STUDIOBPRICE;
								?>
							</label> <br /> <label>User exist : </label> <input type='radio'
								name='user-exist' value='yes' />YES <input type='radio'
								name='user-exist' value='no' />NO <br />

							<div id="user-do" hidden="hidden">
								<label>User Name : </label> <input type="text" id="user-name" />
								<button onclick="searchUser();return false;">Search</button>
								<div id="roar-info" hidden="hidden">
									<div id="user-list"></div>
									<label>Use Roar Credit : </label> <input type='radio'
										name='roar-use' value='yes' />YES <input type='radio'
										name='roar-use' value='no' checked="checked" />NO<br />
								</div>
							</div>

							<div id="user-dont" hidden="hidden">
								<label>Email : </label> <input type="text" id="user-email"
									name="user-email" /> <label>Name : </label> <input type="text"
									id="user-name-nonuser" name="user-name-nonuser" />
							</div>
							<input type="hidden" id="user_exist" name="user_exist" /> <input
								type="hidden" id="roar_use" name="roar_use" value="no" /> <input
								type="hidden" id="user_list" name="user_list" /> <input
								type="hidden" id="user_timeslotid" name="user_timeslotid">
							<div id="err"></div>
							<button onclick="back();">BACK</button>
							<input id="submit" type="submit" name="submit" value="CONFIRM" />
						</form>
					</div>
				</div>
				<div style="clear: both">
					<br>
				</div>
				<div class="end"></div>
			</div>
			<div class="bottom"></div>
		</div>
	</div>
	<?php include_once ROOT.'usercontrol/footer.php';?>

</body>
</html>
