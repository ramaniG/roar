<?php
DEFINE('ROOT', '../');
require_once(ROOT.'sso/session.php');
require_once(ROOT.'_config.settings.php');

$adminid = $_GET["adminid"];
$page = $_GET['page'];

$db = new Database();
$sql = "SELECT IFNULL(f.name, g.name), f.bandname, a.bookingno, GROUP_CONCAT(b.description) as description,
		c.description, e.description,date_format(a.datebooked, '%d %b %Y') as datebooked, a.id, count(a.id) as total
		FROM booking a
		LEFT JOIN booking_timeslot d ON a.bookingno = d.bookingno
		LEFT JOIN studio c ON a.studioid = c.id
		LEFT JOIN timeslot b ON d.timeslotid = b.id
		LEFT JOIN status e ON a.statusid = e.id
		LEFT JOIN member f on a.memberid = f.id
		LEFT JOIN booking_nonuser g on g.bookingid = a.id
		GROUP BY a.bookingno
		ORDER BY a.bookingno DESC";
$result = $db->query($sql);

$totalrecord = $db->numRows($result);
$maxpage = ceil($totalrecord / 10);

$limit = ($page - 1) * 10;

$sql = "SELECT IFNULL(f.name, g.name), f.bandname, a.bookingno, GROUP_CONCAT(b.description) as description,
		c.description, e.description,date_format(a.datebooked, '%d %b %Y') as datebooked, a.id, count(a.id) as total
		FROM booking a
		LEFT JOIN booking_timeslot d ON a.bookingno = d.bookingno
		LEFT JOIN studio c ON a.studioid = c.id
		LEFT JOIN timeslot b ON d.timeslotid = b.id
		LEFT JOIN status e ON a.statusid = e.id
		LEFT JOIN member f on a.memberid = f.id
		LEFT JOIN booking_nonuser g on g.bookingid = a.id
		GROUP BY a.bookingno
		ORDER BY a.bookingno DESC
		LIMIT ".$limit.",10;";
$result = $db->query($sql);

if($db->numRows($result) > 0) {
	echo
	'<table class="table1" width="762" style="white-space: nowrap;">
			<tr>
			<th width="60" class="trx">DATE</th>
			<th width="70" class="trx">STUDIO</th>
			<th width="70" class="trx">TIME SLOT</th>
			<th width="70" class="trx">BOOKING NO</th>
			<th width="100" class="trx">NAME</th>
			<th width="100" class="trx">BAND</th>
			<th width="70" class="trx">ACTION</th>
			</tr>';
	while ($row = mysql_fetch_row($result)) {
		echo "<tr align='center'>".
				"<td class='trx'>{$row[6]}</td>".
				"<td class='trx'>{$row[4]}</td>".
				"<td class='trx'>".substr($row[3], 0, 4)." - ".substr($row[3], -4, 4)."</td>".
				"<td class='trx'>{$row[2]}</td>".
				"<td class='trx'>{$row[0]}</td>".
				"<td class='trx'>{$row[1]}</td>".
				"<td class='trx'><a id='edit-status{$row[7]}' href='javascript:;'>{$row[5]}</a></td></tr>";
				

		if ($row[5] == "Confirmed")
		{
			echo "<script type='text/javascript'>
			$('#edit-status{$row[7]}').click(function() {
			updated = false;
			$.fancybox.open({
			href : 'update_booking_status.php?id=".$row[7]."&adminid=".$adminid."&starttime=".substr($row[3], 0, 4)."&endtime=".substr($row[3], -4, 4)."',
					type : 'iframe',
					padding : 5,
					width: 650,
					afterClose: function () {
					if(updated)
					{
					parent.location.reload(true);
		}
		}
		});
		});
					</script>";
		}

	}
	echo '<tr></tr></table>';
	if ($page != 1)
	{
		echo '<button id="booking_prev" onclick="curpage = curpage - 1;loadtrans(curpage, '.$adminid.');">Prev</button>';
	}
	
	if ($page != $maxpage)
	{
		echo '<button id="booking_next" onclick="curpage = curpage + 1;loadtrans(curpage, '.$adminid.');">Next</button>';
	}
	
	echo '&nbsp;&nbsp; Page '.$page.' of '.$maxpage; 
}
else
{
	echo '<p style="color:#ff0000; font-weight:700;">No Transactions</p>';
}

$db->close();
$db = null;
?>