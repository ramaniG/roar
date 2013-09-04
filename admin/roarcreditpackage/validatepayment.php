<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<?php
DEFINE('ROOT', '../../');
require_once('../../_config.settings.php');
require_once('../../email/roar_payment_resit.php');
$display_msg = false;

$orderid = 0;
$adminid = 0;
$adminname = "";

if(!empty($_GET['orderid']))
	$orderid = $_GET['orderid'];

if(!empty($_GET['adminid']))
	$adminid = $_GET['adminid'];

if(!empty($_GET['adminname']))
	$adminname = $_GET['adminname'];

$db = new Database();

$sql = "SELECT c.packagename,c.charges,d.description as paymenttypedesc,e.description as bankdesc,
a.paymentamount, a.refno, date_format(a.paymentdate, '%d %b %Y %h:%i %p') as paymentdate, a.remarks, a.attachment,a.memberid, f.name, f.email, a.statusid, c.roaramount, a.admin_remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
JOIN paymenttype d ON d.id=a.paymenttypeid
JOIN bank e ON e.id=a.bankid
JOIN member f ON f.id=a.memberid
WHERE a.id=$orderid";

$result = $db->query($sql);
$row = $db->fetchArray($result);

if(isset($_POST['submit'])) {

	$db = new Database();

	$payment_status = $db->sqlSafe($_POST['payment_status']);
	$payment_remarks = $db->sqlSafe($_POST['payment_remarks']);
	
	if($payment_status != $row['statusid'])
	{
		if($payment_status == 4)
		{
			update_roar_credit($row['memberid'], $row['roaramount'], true, "'.{$row['packagename']}.'", $adminid);
			$sql = "UPDATE roarcredit_payment SET
			updateddate=CURDATE(), admin_remarks='$payment_remarks', statusid=4, adminid=$adminid
			WHERE id=$orderid";
		}
		else if($payment_status == 5)
		{
			$sql = "UPDATE roarcredit_payment SET
			updateddate=CURDATE(), admin_remarks='$payment_remarks', statusid=5, adminid=$adminid
			WHERE id=$orderid";
		}
		
		roar_payment_resit($row['name'], $adminname, $row['email'], $row['packagename'], $row['roaramount'], $row['paymentamount'], $row['paymentdate'], date("d M Y"), $payment_remarks);
		
		$db->query($sql) or die(mysql_error());
		$db->close();
		$display_msg = true;
	}
}
?>

<div>
	<?php if (!$display_msg) {?>
	<form method="post"
		action="validatepayment.php?orderid=<?php echo $orderid; ?>&adminid=<?php echo $adminid; ?>&adminname=<?php echo $adminname; ?>" id="payment_form"
		enctype="multipart/form-data">
		<label>Member : </label><span><?php echo $row['name'];?></span> <br> 
		<label>ROAR Package : </label><span><?php echo $row['packagename'];?></span> <br> 
		<label>Total Charges : RM </label><span><?php echo sprintf("%0.2f", $row['charges']);?></span> <br>
		<label>Roar Amount : </label><span><?php echo $row['roaramount']; ?></span> <br>
		<label>Payment Channel : </label><span><?php echo $row['paymenttypedesc']; ?></span> <br>
		<label>Bank : </label><span><?php echo $row['bankdesc']; ?></span><br>
		<label>Amount : RM </label><span><?php echo sprintf("%0.2f", $row['paymentamount']); ?></span><br>
		<label>Refence No : </label><span><?php echo $row['refno']; ?></span><br>
		<label>Transaction Date Time : </label><span><?php echo $row['paymentdate']; ?></span><br>  
		<label>Attachment : </label><a href="<?php echo $row['attachment']; ?>" target="_tab">Click to Open</a> <br>
		<label>User Remarks : </label><label><?php echo $row['remarks']; ?></label><br>
		<label>Admin Remarks : </label><input type="text" id="payment_remarks" name="payment_remarks" value="<?php echo $row['admin_remarks']; ?>" /><br>
		<label>Status : </label> 
		<select id="payment_status" name="payment_status">
					<?php 
					$result = select_all_roar_status();

					if (count($result) > 0)
					{
						foreach ($result as $row)
						{
							if ($row['id'] > 2)
							{
								echo "<option value='{$row['id']}'>{$row['description']}</option>";
							}
						}
					}
					?>
		</select><br>
		<input id="submit" type="submit" name="submit" value="UPDATE" />
	</form>
	<?php } else { ?>
	<script type="text/javascript">
		parent.updated = true;
	</script>
	<p>
		<?php echo 'Update successful. ROAR Credit have been added to User.'; ?>
	</p>
	<button onclick="javascript:parent.$.fancybox.close();">Close</button>
	<?php } ?>
</div>
<div class="clear"></div>

<script type="text/javascript">

</script>
