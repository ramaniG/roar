<?php
require_once('../../_config.settings.php');

$dates = 0;
$monthId = "";
$studio = 0;

if(!empty($_GET['dates']))
	$dates = $_GET['dates'];

if($_GET['month'] != "")
	$monthId = $_GET['month'];

if(!empty($_GET['studio']))
	$studio = $_GET['studio'];

if($dates != "" && $monthId != "")
{
	$dateArray = explode(';', $dates);

	$successfuldates = "";
	$unsuccessfuldates = "";
	$db = new Database();

	foreach($dateArray as $dateslot)
	{
		$date = explode('_', $dateslot)[0];
		$timeslotid = explode('_', $dateslot)[1];

		$current_month = date("Y-m-".$date);
		if($monthId == 0)
		{
			$newdate = new DateTime(date('Y-m-'.$date, strtotime($current_month)));
		}
		else
		{
			$newdate = new DateTime(date('Y-m-'.$date, strtotime("+$monthId month", strtotime($current_month))));
		}

		if ($studio == 3)
		{
			addnotavailable($newdate->format('Y-m-d'), $timeslotid, 1);
			addnotavailable($newdate->format('Y-m-d'), $timeslotid, 2);
		}
		else
		{
			addnotavailable($newdate->format('Y-m-d'), $timeslotid, $studio);
		}
	}
	
	echo "Changes Successfully Made.";
}

function addnotavailable($date, $timeslotid, $studioid)
{
	$db = new Database();
	
	$sql = "SELECT * FROM timeslot_available WHERE date='".$date."' AND studioid=$studioid AND timeslotid=$timeslotid";
	$inclose = $db->query($sql);

	if ($inclose != null && mysql_num_rows($inclose) > 0) {
		$sql = "DELETE FROM timeslot_available WHERE date='".$date."' AND studioid=$studioid AND timeslotid=$timeslotid";

		$db->query($sql) or die(mysql_error());
	}

	$sql = "SELECT * FROM timeslot_notavailable WHERE date='".$date."' AND studioid=$studioid AND timeslotid=$timeslotid";

	$duperaw = $db->query($sql);

	if ($duperaw != null && mysql_num_rows($duperaw) == 0) {
		$sql = "INSERT INTO timeslot_notavailable (date, timeslotid, studioid) VALUES ('".$date."', $timeslotid, $studioid)";

		$db->query($sql) or die(mysql_error());
	}
	
	$db->close();
}

