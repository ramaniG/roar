<?php
require_once('../../_config.settings.php');

$dates = 0;
$monthId = "";
$studioId = 0;

if(!empty($_GET['dates']))
	$dates = $_GET['dates'];

if($_GET['month'] != "")
	$monthId = $_GET['month'];

if($_GET['studio'] != "")
	$studioId = $_GET['studio'];

if($dates != "" && $monthId != "")
{
	$dateArray = explode(';', $dates);
	
	$successfuldates = "";
	$unsuccessfuldates = "";
	$db = new Database();
	
	foreach($dateArray as $date) 
	{
		$current_month = date("Y-m-".$date);
		if($monthId == 0)
		{
			$newdate = new DateTime(date('Y-m-'.$date, strtotime($current_month)));
		}
		else
		{
			$newdate = new DateTime(date('Y-m-'.$date, strtotime("+$monthId month", strtotime($current_month))));
		}
		
		if ($studioId == 1 || $studioId == 2)
		{
			$sucess = process($newdate, $studioId);
		}
		elseif ($studioId == 3)
		{
			$sucess = process($newdate, 1);
			$sucess = process($newdate, 2);
		}
	}
	
	$db->close();
	echo "Dates successfully set as normal.";
}

function process($newdate, $studioid)
{
	$db = new Database();
	
	$sql = "SELECT * FROM timeslot_close WHERE date='".$newdate->format("Y-m-d")."' and studioid=$studioid";
	$inclose = $db->query($sql);
	
	if ($inclose != null && mysql_num_rows($inclose) > 0) {
		$sql = "DELETE FROM `timeslot_close` WHERE date='".$newdate->format("Y-m-d")."' and studioid=$studioid";
	
		$db->query($sql) or die(mysql_error());
	}
	
	$sql = "SELECT * FROM timeslot_publicholiday WHERE date='".$newdate->format("Y-m-d")."' and studioid=$studioid";
	$inopen = $db->query($sql);
	
	if ($inopen != null && mysql_num_rows($inopen) > 0) {
		$sql = "DELETE FROM `timeslot_publicholiday` WHERE date='".$newdate->format("Y-m-d")."' and studioid=$studioid";
	
		$db->query($sql) or die(mysql_error());
	}

	$db->close();
}

