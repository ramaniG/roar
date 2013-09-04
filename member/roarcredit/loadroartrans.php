<?php

require_once('../../_config.settings.php');

$numdays = 7;
$memberid = 0;

if(!empty($_GET['numdays']))
	$numdays = $_GET['numdays'];

if(!empty($_GET['memberid']))
	$memberid = $_GET['memberid'];

if(!empty($_GET['page']))
	$page = $_GET['page'];

$db = new Database();

$sql = "SELECT a.id,date_format(a.addeddate, '%d %b %Y') as addeddate,c.packagename,c.roaramount,c.charges,b.description,a.statusid,a.remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
WHERE memberid=$memberid AND DATE_SUB(CURDATE(),INTERVAL $numdays DAY) < a.addeddate
ORDER BY a.statusid, a.id DESC;";

$result = $db->query($sql);

$totalrecord = $db->numRows($result);
$maxpage = ceil($totalrecord / 10);

$limit = ($page - 1) * 10;

$sql = "SELECT a.id,date_format(a.addeddate, '%d %b %Y') as addeddate,c.packagename,c.roaramount,c.charges,b.description,a.statusid,a.remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
WHERE memberid=$memberid AND DATE_SUB(CURDATE(),INTERVAL $numdays DAY) < a.addeddate
ORDER BY a.statusid, a.id DESC
LIMIT ".$limit.",10;";



$result = $db->query($sql);

$db->close();

?>
<style>
#trans-table>table {
	border-collapse: collapse;
}

#trans-table>table>tbody>tr>th {
	border: 1px solid white !important;
}

#trans-table>table>tbody>tr>td {
	border: 1px solid white !important;
}
</style>

<table id="trans-table">
	<tr>
		<th>Order ID</th>
		<th>Package</th>
		<th>Order Date</th>
		<th>ROAR!!! Credit (RM)</th>
		<th>Status</th>
		<th>Remarks</th>
		<th>Action</th>
	</tr>
	<?php 
	while ($row = $db->fetchArray($result))
	{
		echo "<tr>";
		echo "<td>".sprintf("RC%04s", $row['id'])."</td>";
		echo "<td>{$row['packagename']}</td>";
		echo "<td  style='white-space: nowrap;'>{$row['addeddate']}</td>";
		echo "<td>{$row['roaramount']}</td>";
		echo "<td>{$row['description']}</td>";
		echo "<td>{$row['remarks']}</td>";

		if ($row['statusid'] == 2)
		{
			echo "<td><button onclick='attachpayment(".$row['id'].")'>Attach</button><br>
		<button onclick='deleteOrder(".$row['id'].", \"".sprintf("RC%04s", $row['id'])."\")'>Delete</button></td>";
		}
		else
		{
			echo "<td><p>&nbsp; </p></td>";
		}

		echo "</tr>";


	}

	echo "</table>";

	if ($page != 1)
	{
		echo '<button id="booking_prev" onclick="curpage = curpage - 1;loadtable('.$memberid.','.$numdays.',curpage);">Prev</button>';
	}

	if ($page != $maxpage)
	{
		echo '<button id="booking_next" onclick="curpage = curpage + 1;loadtable('.$memberid.','.$numdays.',curpage);">Next</button>';
	}

	echo '&nbsp;&nbsp; Page '.$page.' of '.$maxpage;
	?>