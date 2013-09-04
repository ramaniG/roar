<?php

require_once('../../_config.settings.php');

$numdays = 7;
$username = "";

if(!empty($_GET['numdays']))
	$numdays = $_GET['numdays'];

if(!empty($_GET['username']))
	$username = $_GET['username'];

if(!empty($_GET['page']))
	$page = $_GET['page'];

$db = new Database();

$sql = "SELECT a.memberid,d.name,a.id,date_format(a.addeddate, '%d %b %Y') as addeddate,c.packagename,c.roaramount,c.charges,b.description,a.statusid,a.remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
JOIN member d ON d.id=a.memberid
WHERE (DATE_SUB(CURDATE(),INTERVAL $numdays DAY) < a.addeddate) AND d.name LIKE '%$username%'
ORDER BY case
when a.statusid = 2 then 999
else a.statusid
end , a.id DESC;";

$result = $db->query($sql);

$totalrecord = $db->numRows($result);
$maxpage = ceil($totalrecord / 10);

$limit = ($page - 1) * 10;

$sql = "SELECT a.memberid,d.name,a.id,date_format(a.addeddate, '%d %b %Y') as addeddate,c.packagename,c.roaramount,c.charges,b.description,a.statusid,a.remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
JOIN member d ON d.id=a.memberid
WHERE (DATE_SUB(CURDATE(),INTERVAL $numdays DAY) < a.addeddate) AND d.name LIKE '%$username%'
ORDER BY case
when a.statusid = 2 then 999
else a.statusid
end , a.id DESC
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
		<th>User Name</th>
		<th>Order ID</th>
		<th>Package</th>
		<th>Added Date</th>
		<th>ROAR Amount</th>
		<th>Price (RM)</th>
		<th>Status</th>
		<th>Remarks</th>
		<th>Action</th>
	</tr>
	<?php
	while ($row = $db->fetchArray($result))
	{
		echo "<tr>";
		echo "<td>{$row['name']}</td>";
		echo "<td>".sprintf("RC%04s", $row['id'])."</td>";
		echo "<td>{$row['packagename']}</td>";
		echo "<td style='white-space: nowrap;'>{$row['addeddate']}</td>";
		echo "<td>{$row['roaramount']}</td>";
		echo "<td>".sprintf('%0.2f', $row['charges'])."</td>";
		echo "<td>{$row['description']}</td>";
		echo "<td>{$row['remarks']}</td>";

		if ($row['statusid'] == 3)
		{
			echo "<td><button onclick='validatepayment(".$row['id'].")'>Validate Payment</button></td>";
		}
		else
		{
			echo "<td>{$row['description']}</td>";
		}

		echo "</tr>";
	}
	
	echo "</table>";

	if ($page != 1)
	{
		echo '<button id="booking_prev" onclick="curpage = curpage - 1;loadtable( '.$numdays.',\''.$username.'\', curpage);">Prev</button>';
	}
	
	if ($page != $maxpage)
	{
		echo '<button id="booking_next" onclick="curpage = curpage + 1;loadtable('.$numdays.',\''.$username.'\',  curpage);">Next</button>';
	}
	
	echo '&nbsp;&nbsp; Page '.$page.' of '.$maxpage;
	?>
	


