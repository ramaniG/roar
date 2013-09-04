<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php
require_once('../_config.settings.php');
require_once('../email/booking_cancel.php');

$id = (!isset($_GET["id"]) ? '' : $_GET["id"]);
$adminid = (!isset($_GET["adminid"]) ? '' : $_GET["adminid"]);
$starttime = (!isset($_GET["starttime"]) ? '' : $_GET["starttime"]);
$endtime = (!isset($_GET["endtime"]) ? '' : $_GET["endtime"]);

$adminname = '';
$db = new Database();

$sql = "SELECT username FROM admin WHERE id = '{$adminid}' LIMIT 0, 1";
$result = $db->query($sql);
$row = '';
while ($row = mysql_fetch_row($result)) {
	$adminname =  $row[0];
}

$display_msg = false;
$data = Array();

if(!empty($id)) {

	$db = new Database();
	$id = $db->sqlSafe($id);
	$sql = "SELECT a.id, a.name, a.email, c.description, b.amount, 
	b.bookingno, d.name as nonusername, d.email as nonuseremail,
	date_format(b.datebooked, '%d %b %Y') as datebooked, b.studioid
	FROM booking b
	LEFT JOIN member a ON a.id = b.memberid
	LEFT JOIN status c ON b.statusid = c.id
	LEFT JOIN booking_nonuser d ON d.bookingid = b.id
	WHERE b.id = '{$id}'";
		
	$result = $db->query($sql);
		
	while ($row = mysql_fetch_row($result)) {
	$data['memberid'] = $row[0];
	$data['name'] = $row[1];
	$data['email'] = $row[2];
	$data['status'] = $row[3];
	$data['amount'] = $row[4];
	$data['bookingno'] = $row[5];
	$data['nonusername'] = $row[6];
	$data['nonuseremail'] = $row[7];
	$data['datebooked'] = $row[8];
	$data['studioid'] = $row[9];
	}
		
	$db->close();
}

if(isset($_POST['submit'])) {

	$db = new Database();
	$db->query("SET NAMES utf8");

	$status = $db->sqlSafe($_POST['status']);
	$id = $db->sqlSafe($_POST['id']);
	$adminid = $db->sqlSafe($_POST['adminid']);
	$remarks = $db->sqlSafe($_POST['remarks']);
	$amount = $db->sqlSafe($_POST['roar-credit-return']);
	$bookingno = $db->sqlSafe($_POST['bookingno']);
	$memberid = $db->sqlSafe($_POST['memberid']);
		
	if ($status == 3)
	{
		// Update Status to reject
		$sql = "UPDATE booking SET statusid=$status, adminid=$adminid, dateupdated=CURDATE(), remarks='{$remarks}' WHERE id=$id";
		$db->query($sql) or die(mysql_error());
		
		// Remove booking
		$sql = "DELETE FROM booking_timeslot where bookingno = '$bookingno' ";
		$db->query($sql) or die(mysql_error());
		
		// Return Roar Credit
		if (!($memberid == NULL || empty($memberid) || $memberid == ""))
		{
			update_roar_credit($memberid, $amount, true, "'Add back credit for canceled booking : $bookingno'", $adminid);
			booking_cancel($data['name'], $adminname, $data['email'], select_studio($data['studioid'])['description'], $data['datebooked'], $starttime.' - '.$endtime, $remarks);
		}
		else
		{
			booking_cancel($data['nonusername'], $adminname, $data['nonuseremail'], select_studio($data['studioid'])['description'], $data['datebooked'], $starttime.' - '.$endtime, $remarks);
		}
		$display_msg = true;
	}
	
	$db->close();
	
}
?>
<!DOCTYPE>
<html>
<head>
<title>ROAR: ADMIN</title>
</head>
<body>
	<?php if (!$display_msg) {?>
	<fieldset>
		<p>
			UPDATE STATUS, Booking No : 
			<?php echo $data['bookingno']; ?>
		</p>
		<form method="post" action="update_booking_status.php?id=<?php echo $id; ?>&adminid=<?php echo $adminid; ?>&starttime=<?php echo $starttime; ?>&endtime=<?php echo $endtime; ?>">
			<label>Status : </label> <select name="status" id="status"
				onchange="selectChange()">
				<?php 
				$result = select_all_status();
				foreach ($result as $row)
				{
					if (!empty($data['status']) && $data['status']==$row['description']) {
									echo "<option value='{$row['id']}' selected='selected'>{$row['description']}</option>";
								}
								else
									echo "<option value='{$row['id']}'>{$row['description']}</option>";
				}
				?>
			</select><br /> 
			<div id="roarcredit" hidden="hidden">
			<label>Roar Credit Return : </label><input type="text" id="roar-credit-return" name="roar-credit-return" value="<?php echo $data['amount']; ?>"/>
			</div>
			<label>Remark :</label>
			<textarea id="remarks" name="remarks" cols="40" rows="5"
				style="vertical-align: top;"></textarea>
			<br /> <label>&nbsp;</label><input id="submit" type="submit"
				name="submit" value="UPDATE" /> <input id="id" type="hidden"
				name="id" value="<?php echo $id; ?>" /> <input id="adminid"
				type="hidden" name="adminid" value="<?php echo $adminid; ?>" />
				<input id="bookingno" type="hidden" name="bookingno" value="<?php echo $data['bookingno']; ?>" />
				<input id="memberid" type="hidden" name="memberid" value="<?php echo $data['memberid']; ?>" />
			<div class="clear"></div>
		</form>
	</fieldset>
	<?php } else { ?>
	<script type="text/javascript">
		parent.updated = true;
	</script>
	<p>
		<?php echo 'Status Updated successfully'; ?>
	</p>
	<?php } ?>
</body>
<script type="text/javascript">
$("#status").change(function(){
	if($(this).val() == 3)
	{
		$("#roarcredit").removeAttr('hidden');
	}
	else
	{
		$("#roarcredit").attr('hidden', 'hidden');
	}
});
</script>
</html>
