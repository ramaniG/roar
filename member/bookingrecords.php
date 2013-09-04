<?php
DEFINE('ROOT', '../');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');
$memberid = safe_input(member_session());

$page = $_GET['page'];

$db = new Database();
$sql = "SELECT a.bookingno, date_format(a.datebooked, '%d %b %Y') as datebooked, GROUP_CONCAT(b.description) as description,
c.description, e.description, a.remarks FROM booking a
LEFT JOIN studio c ON a.studioid = c.id
LEFT JOIN booking_timeslot d ON a.bookingno = d.bookingno
LEFT JOIN timeslot b ON d.timeslotid = b.id
LEFT JOIN status e ON a.statusid = e.id
WHERE a.memberid = '{$memberid}'
GROUP BY a.bookingno
ORDER BY a.bookingno DESC";

$result = $db->query($sql);

$totalrecord = $db->numRows($result);
$maxpage = ceil($totalrecord / 10);

$limit = ($page - 1) * 10;

$sql = "SELECT a.bookingno, date_format(a.datebooked, '%d %b %Y') as datebooked, GROUP_CONCAT(b.description) as description,
c.description, e.description, a.remarks FROM booking a
LEFT JOIN studio c ON a.studioid = c.id
LEFT JOIN booking_timeslot d ON a.bookingno = d.bookingno
LEFT JOIN timeslot b ON d.timeslotid = b.id
LEFT JOIN status e ON a.statusid = e.id
WHERE a.memberid = '{$memberid}'
GROUP BY a.bookingno
ORDER BY a.bookingno DESC
LIMIT ".$limit.",10;";

$result = $db->query($sql);

if($db->numRows($result) > 0)
{

	echo '<table width="762" class="table1"><tr>
			<th width="100">BOOKING NO</th>
			<th width="100">BOOKING DATE</th>
			<th width="200">TIME</th>
			<th width="150">STUDIO</th>
			<th width="150">STATUS</th>
			<th width="150">REMARKS</th>
			</tr>';


	while ($row = mysql_fetch_row($result)) {
		echo "<tr align='center'><td>{$row[0]}</td>".
				"<td>{$row[1]}</td>".
				"<td>".substr($row[2], 0, 4)." - ".substr($row[2], -4, 4)."</td>".
				"<td>{$row[3]}</td>".
				"<td>{$row[4]}</td>".
				"<td>{$row[5]}</td></tr>";
	}

	echo '<tr></tr>
			</table>';

	if ($page != 1)
	{
		echo '<button id="booking_prev" onclick="curpage = curpage - 1;loadtrans(curpage);">Prev</button>';
	}

	if ($page != $maxpage)
	{
		echo '<button id="booking_next" onclick="curpage = curpage + 1;loadtrans(curpage);">Next</button>';
	}

	echo '&nbsp;&nbsp; Page '.$page.' of '.$maxpage;




	$db->close();
	$db = null;
}
else
{
	echo '<p style="color:#ff0000; font-weight:700;">No Records</p>';
}
?>