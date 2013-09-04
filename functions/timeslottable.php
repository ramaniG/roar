<?php
DEFINE('ROOT', '../');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');

$getstudioid = null;
$gettimeslotId = null;

if(isset($_GET["studioid"]))
{
	$getstudioid = $_GET["studioid"];
	$gettimeslotId = $_GET['timeslotid'];
}

loadtimetables($getstudioid, $gettimeslotId);

function loadtimetables($studioid, $timeid)
{
	if ($studioid == 0)
	{
		loadtimetable(1, null);
		loadtimetable(2, null);
	}
	else
	{
		loadtimetable($studioid, $timeid);
	}
}

function loadtimetable($studioid, $selectedId)
{
	$selectedIdsplit = array();
	if(!empty($selectedId))
	{
		$selectedIdsplit = explode(';', $selectedId);
	}
	$result = select_studio($studioid);
	echo "<div>";
	echo "<p align='center' class='head1'>".$result['description']."</p><br>";
	echo "<table border=1 id='booking_timeslot'>";
	echo "<tr><td></td>";

	$timeslot = select_all_timeslot();
	if (count($timeslot) > 0)
	{
		for ($i = 0; $i < count($timeslot); $i++)
		{
			$row = $timeslot[$i];
			echo "<th colspan='2'><img width='50px' height='50px' src='".ROOT."images/timeslot/timeslot_{$row['id']}.jpg'></th>";
		}

	}
	echo "</tr>";

	$newdate = new DateTime(date('Y-m-d'));
	for($k=1; $k<=14; $k++) {
		echo "<tr><td>{$newdate->format('d M Y')}</td>";
		foreach ($timeslot as $row)
		{
			$cellId = $k."_".$row['id'];
			$status = is_time_slot_exists($newdate->format("Y-m-d H:i:s"), $row['id'], $studioid);
			
			if ($status == 'Confirmed'){
				echo "<td class='confirmed' id='".$cellId."'>&nbsp;</td>";
			}
			elseif ($status == 'notavailable'){
				echo "<td class='notavailable' id='".$cellId."'>&nbsp;</td>";
			}
			elseif($status == 'available') {
				if(in_array($cellId, explode(';', $selectedId)))
					echo "<td class='selected' id='".$cellId."'>&nbsp;</td>";
				else
					echo "<td class='available' id='".$cellId."'>&nbsp;</td>";
			}
		}
		$newdate->modify('+1 day');
		echo '</tr>';
	}


	echo "</table>";
	echo "</div><br><br>";
}
?>

<style>
/* Table */
.selected {
	background-color: blue;
}

.confirmed {
	background-color: yellow;
}

.notavailable {
	background-color: red;
}

.available {
	background-color: green;
}

table {
	line-height: normal;
	font-size: medium;
}

#booking_timeslot > tbody > tr > td {
	white-space: nowrap;
	height: 20px;
	width: 50px;
}
</style>
