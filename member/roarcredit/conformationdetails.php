<?php
require_once('../../_config.settings.php');
require_once ('../../email/roar_select_package.php');

$amount = 0;
$packageid = 0;
$memberid = 0;
$updateSucessful = false;

if(!empty($_GET['amount']))
	$amount = str_replace(",", ".", $_GET['amount']);

if(!empty($_GET['packageid']))
	$packageid = $_GET['packageid'];

if(!empty($_GET['memberid']))
	$memberid = $_GET['memberid'];


if(isset($_POST['submit'])) {
	if($amount != 0 && $packageid != 0 && $memberid != 0)
	{
		$db = new Database();

		$sql = "INSERT INTO roarcredit_payment (memberid,packageid,statusid,addeddate) VALUES ($memberid, $packageid, 2, NOW())";

		$db->query($sql) or die(mysql_error());
		$id = mysql_insert_id();

		$sql = "SELECT a.name, a.email, b.packagename, b.roaramount FROM
		roarcredit_payment c
		JOIN member a ON c.memberid = a.id
		JOIN roarcredit_packages b ON c.packageid = b.id
		WHERE c.id = $id";

		$result = $db->query($sql);

		$row = '';
		$row = mysql_fetch_row($result);

		if(roar_select_package($row[0], $row[1], $row[2], $row[3], $amount))
			$updateSucessful = true;

		$db->close();
		$updateSucessful = true;
	}
}

if(isset($_POST['cancel'])) {
	echo '<script type="text/javascript">parent.updated = false;parent.$.fancybox.close();</script>';
}

if(isset($_POST['close'])) {
	echo '<script type="text/javascript">parent.updated = true;parent.$.fancybox.close();</script>';
}
?>

<!DOCTYPE>
<html>
<head>
<title>Details for Payment</title>
</head>
<body>
	<?php if(!$updateSucessful){ ?>
	<form method="post"
		action="conformationdetails.php?&memberid=<?php echo $memberid;?>&packageid=<?php echo $packageid; ?>&amount=<?php echo $amount; ?>"
		id="payment_form" enctype="multipart/form-data">
		<table>
			<tr>
				<td><label>Please make your payment via any of the
						following method :</label><br /> <label>Online Transfer</label><br />
					<label>ATM Transfer</label><br /> <label>Deposit</label><br /> <br />
					<label>Payment made must be the exact amount which is : RM <?php echo sprintf("%0.2f", $amount);?>.
				</label><br /> <br /> <label>Payment must be made to :</label><br />
					<label>Bank : Maybank</label><br /> <label>Account Holder : ROAR
						MUSIC SDN. BHD.</label><br /> <label>Acc NO : 5127 5451 0311</label><br />
					<br /> <label>Come back and attach your payment when it is done.</label><br />
					<label>Thank you.</label><br />
					<input id="submit" type="submit" name="submit" value="Confirm" />
					<input id="cancel" type="submit" name="cancel" value="Cancel" />
				</td>
			</tr>
		</table>
	</form>
	<?php }
	else
{?>
	<form method="post"
		action="conformationdetails.php?&memberid=<?php echo $memberid;?>&packageid=<?php echo $packageid; ?>&amount=<?php echo $amount; ?>"
		id="payment_form" enctype="multipart/form-data">
	<label>Purchase successfully added. Your Order ID is : <?php echo sprintf("RC%04s", $id); ?></label><br />
	<input id="close" type="submit" name="close" value="Close" />
	</form>
	<?php }?>
</body>
</html>
