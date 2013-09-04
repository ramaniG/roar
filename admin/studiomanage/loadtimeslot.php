<?php
DEFINE('ROOT', '../../');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');

$month = "";
$studio = "";

if(!empty($_GET['month']))
	$month = $_GET['month'];

if(!empty($_GET['studio']))
	$studio = $_GET['studio'];

loadtimetable($studio, $month);

function loadtimetable($studioid, $monthId)
{
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

			$splitandjoin = implode("\n", str_split($row['starttime']));
			echo "<th><div>$splitandjoin</div></th>";
		}

	}
	echo "</tr>";
	
	
	$current_month = date("Y-m-1");
	if($monthId == 0)
	{
		$newdate = new DateTime(date('Y-m-1', strtotime($current_month)));
	}
	else
	{
		$newdate = new DateTime(date('Y-m-1', strtotime("+$monthId month", strtotime($current_month))));
	}
	
	for($k=1; $k<=cal_days_in_month(CAL_GREGORIAN, $newdate->format("m"), $newdate->format('Y')); $k++) {
		echo "<tr><td style='white-space: nowrap;'>{$newdate->format('d M Y')}</td>";
		foreach ($timeslot as $row)
		{
			$cellId = $k."_".$row['id'];
			$status = is_time_slot_exists($newdate->format("Y-m-d H:i:s"), $row['id'], $studioid);
			
			if ($status == 'Confirmed'){
				echo "<td class='confirmed' id='2_".$cellId."'>&nbsp;</td>";
			}
			elseif ($status == 'notavailable'){
				echo "<td class='notavailable' id='1_".$cellId."'>&nbsp;</td>";
			}
			elseif($status == 'available') {
				echo "<td class='available' id='0_".$cellId."'>&nbsp;</td>";
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

th div {
	writing-mode: lr-tb;
	height: 80px;
	width: 5px;
}

th {
	writing-mode: lr-tb;
	height: 80px;
	width: 21px;
}
</style>
