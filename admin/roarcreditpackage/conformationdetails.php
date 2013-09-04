<?php
require_once('../../_config.settings.php');

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

if($amount != 0 && $packageid != 0 && $memberid != 0)
{
	$db = new Database();

	$sql = "INSERT INTO roarcredit_payment (memberid,packageid,statusid,addeddate) VALUES ($memberid, $packageid, 2, NOW())";

	$db->query($sql) or die(mysql_error());
	$db->close();
	$updateSucessful = true;
}

?>

<!DOCTYPE>
<html>
<head>
<title>Details for Payment</title>
</head>
<body>
	<table>
		<tr>
			<?php if($updateSucessful){ ?>


			<td><label>Please make your payment via any of the following method :</label><br />
				<label>Online Transfer</label><br /> <label>ATM Transfer</label><br />
				<label>Deposit</label><br /> <br /> <label>Payment made must be the
					exact amount whis is : RM <?php echo sprintf("%0.2f", $amount);?>.
			</label><br /> <br /> <label>Payment must be made to :</label><br />
				<label>Bank : Maybank</label><br /> <label>Account Holder : ROAR
					CREDIT Sdn Bhd</label><br /> <label>Acc NO : 1234 - 1234 - 1234</label><br />
				<br /> <label>Once payment made, please attach payment details to
					the made order on next page.</label><br />
				<button onclick="parent.$.fancybox.close();">Understood</button>
			</td>

			<?php }
			else
{?>
			<td><label>Update unsucessful. Please buy again.</label> <?php }?>
		
		</tr>
	</table>
</body>
</html>
