<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<?php
DEFINE('ROOT', '../../');
require_once('../../_config.settings.php');
require_once('../../email/roar_add_credit.php');
require_once('../../email/roar_remove_credit.php');
$display_msg = false;

$userid = 0;
$adminid = 0;
$adminname = "";

if(!empty($_GET['userid']))
	$userid = $_GET['userid'];

if(!empty($_GET['adminid']))
	$adminid = $_GET['adminid'];

if(!empty($_GET['adminname']))
	$adminname = $_GET['adminname'];

$db = new Database();

$sql = "SELECT a.id,a.name,a.email, b.amount
FROM member a
JOIN roarcredit b ON a.id = b.memberid
WHERE a.id = $userid
ORDER BY a.id;";

$result = $db->query($sql);
$row = $db->fetchArray($result);

if(isset($_POST['submit'])) {

	$db = new Database();

	$hidupdatetype = $db->sqlSafe($_POST['hidupdatetype']);
	$updateamount = $db->sqlSafe($_POST['updateamount']);
	$remarks = $db->sqlSafe($_POST['remarks']);


	if($hidupdatetype == "add")
	{
		update_roar_credit($userid, $updateamount, true, "'.{$remarks}.'", $adminid);
		roar_add_credit($row['name'], $adminname, $row['email'], $updateamount, date('d M Y'), $remarks);
	}
	else if($hidupdatetype == "remove")
	{
		update_roar_credit($userid, $updateamount, false, "'.{$remarks}.'", $adminid);
		roar_remove_credit($row['name'], $adminname, $row['email'], $updateamount, date('d M Y'), $remarks);
	}
	
	$display_msg = true;

}
?>

<div>
	<?php if (!$display_msg) {?>
	<form method="post"
		action="editamount.php?userid=<?php echo $userid; ?>&adminid=<?php echo $adminid; ?>&adminname=<?php echo $adminname; ?>"
		id="payment_form" enctype="multipart/form-data"
		onsubmit="return validateForm()">
		<label>Member : </label><span><?php echo $row['name'];?> </span> <br />
		<label>Current Roar Amount : </label><span><?php echo $row['amount']; ?>
		</span><br /> <label>Update Amout : </label><input type="radio"
			name="updatetype" value="add" />&nbsp;Add&nbsp;<input type="radio"
			name="updatetype" value="remove" />&nbsp;Deduct <br/>RM<input
			disabled="disabled" type="text" id="updateamount" name="updateamount"
			onkeypress="return isNumberKey(event)" /><br> <label>Remarks : </label><input
			type="text" id="remarks" name="remarks" /><br> <input type="hidden"
			id="hidupdatetype" name="hidupdatetype" />
		<div id="payment_err"></div>
		<input id="submit" type="submit" name="submit" value="UPDATE" />
	</form>
	<?php } else { ?>
	<script type="text/javascript">
		parent.updated = true;
	</script>
	<p>
		<?php echo 'Update successful. ROAR Credit have been updated to User.'; ?>
	</p>
	<?php } ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
$('input:radio').change(function(){
	        $("#updateamount").removeAttr("disabled");
	        $("#hidupdatetype").val($(this).val());
	    });

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    
    return true;
};

function validateForm()
{
	var updateamount = document.forms["payment_form"]["updateamount"].value;
	var remarks = document.forms["payment_form"]["remarks"].value;

	var booking_err = "";

	if (updateamount == null || updateamount == "")
  	{
	  	booking_err = booking_err + "[Amount] Plese insert update amount. <br/>";
  	}
	
	if (booking_err != "")
  	{
  		$("#payment_err").html(booking_err);
 		return false;
  	}
};
</script>
