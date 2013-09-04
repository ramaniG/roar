<?php
DEFINE('ROOT', '../../');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');
require_once(ROOT.'email/booking_received.php');

$memberid = safe_input(member_session());
$name = select_username($memberid);

$db = new Database();
$sql = "SELECT email FROM member WHERE id = '{$memberid}' LIMIT 0, 1";
$result = $db->query($sql);
$row = '';
while ($row = mysql_fetch_row($result)) {
	$user_email =  $row[0];
}

if(isset($_GET["studioid"]))
	$getstudioid = $_GET["studioid"];

if(isset($_POST["time"]))
	$posttime = json_decode($_POST["time"]);

if(isset($_POST["roaramount"]))
	$postroaramount= $_POST["roaramount"];

$bookingnolist = "";
$startTime = select_timeslot_starttime();
$endTime = select_timeslot_endtime();

foreach ($posttime as $each)
{
	$bookingno = select_booking_id();
	$datemodifier = $each->date - 1;
	$today = date("Y-m-d");
	$bookeddate = date("Y-m-d H:i:s", strtotime($today." +$datemodifier days"));
	$bookeddate_email = date("d M Y", strtotime($today." +$datemodifier days"));
	$timeslotid = $each->id;
	
	insert_new_booking($bookingno, $memberid, $getstudioid, $bookeddate, $timeslotid);
	
	if($bookingnolist == "")
		$bookingnolist = $bookingno;
	else
		$bookingnolist = $bookingnolist.';'.$bookingno;
		
	$splitId = explode(',', $timeslotid);

	$start = $startTime[$splitId[0] - 1];
	$end = $endTime[$splitId[count($splitId) - 1] - 1];
	$time = $start.' to '.$end;
	
	if ($getstudioid == 1)
	{
		$roarcredit = count(explode(',', $timeslotid)) * STUDIOAPRICE;
	}
	elseif ($getstudioid == 2)
	{
		$roarcredit = count(explode(',', $timeslotid)) * STUDIOBPRICE;
	}
	
	$a = select_studio($getstudioid);

	booking_received($name, $user_email, $a['description'], $bookeddate_email, $time, "", $roarcredit);
	
	update_booking_running_id();
}

if($bookingnolist != "")
	update_roar_credit($memberid, $postroaramount, false, "'.$bookingnolist.'", 0);

echo $bookingnolist;

?>
