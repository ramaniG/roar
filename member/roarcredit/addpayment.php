<script src="../../js/jquery-1.7.1.min.js" type="text/javascript"></script>

<?php
DEFINE('ROOT', '../../');
require_once('../../_config.settings.php');
require_once('../../email/roar_payment_made.php');
$display_msg = false;

$orderid = 0;
$memberid = 0;

if(!empty($_GET['orderid']))
	$orderid = $_GET['orderid'];

if(!empty($_GET['memberid']))
	$memberid = $_GET['memberid'];

if(!empty($_GET['name']))
	$name = $_GET['name'];

$db = new Database();

$sql = "SELECT a.id,date_format(a.addeddate, '%d %b %Y') as addeddate,c.packagename,c.roaramount,c.charges,b.description,a.statusid,a.remarks
FROM roarcredit_payment a
JOIN roarcredit_status b ON a.statusid=b.id
JOIN roarcredit_packages c ON a.packageid=c.id
WHERE memberid=$memberid AND a.id=$orderid";

$result = $db->query($sql);
$row = $db->fetchArray($result);

if(isset($_POST['submit'])) {

	$db = new Database();

	$payment_type = $db->sqlSafe($_POST['payment_type']);
	$payment_bank = $db->sqlSafe($_POST['payment_bank']);
	$payment_ref = $db->sqlSafe($_POST['payment_ref']);
	$payment_date = $db->sqlSafe($_POST['payment_date']);
	$payment_time = $db->sqlSafe($_POST['payment_time']);
	$payment_amount = $db->sqlSafe($_POST['payment_amount']);
	$payment_remarks = $db->sqlSafe($_POST['payment_remarks']);

	$datetime = date_create_from_format('d M Y h:i a', $payment_date.' '.$payment_time);

	$payment_attach = "";

	if(!empty($_FILES["payment_attach"]['tmp_name']))
	{
		$allowedExts = array("pdf", "jpeg", "jpg", "png");
		$filename = $_FILES["payment_attach"]["name"];
		$temp = explode(".", $filename);
		$extension = end($temp);
		if ((($_FILES["payment_attach"]["type"] == "application/pdf")
				|| ($_FILES["payment_attach"]["type"] == "image/jpeg")
				|| ($_FILES["payment_attach"]["type"] == "image/jpg")
				|| ($_FILES["payment_attach"]["type"] == "image/pjpeg")
				|| ($_FILES["payment_attach"]["type"] == "image/x-png")
				|| ($_FILES["payment_attach"]["type"] == "image/png"))
				&& ($_FILES["payment_attach"]["size"] < 2000000)
				&& in_array($extension, $allowedExts))
		{
			if ($_FILES["payment_attach"]["error"] > 0)
			{
				$booking_err_msg .= "[Attachment] " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{

				move_uploaded_file($_FILES["payment_attach"]['tmp_name'], ROOT.'attachment/'.$name.date("Ymdgi").'.'.$extension);
				$payment_attach = ROOT.'attachment/'.$name.date("Ymdgi").'.'.$extension;
			}
		}
	}

	if($payment_type == 4)
	{
		$sql = "UPDATE roarcredit_payment SET
		paymentdate='{$datetime->format('Y/m/d H:i:s')}', updateddate=CURDATE(),
		paymentamount=$payment_amount, remarks='$payment_remarks', refno='$payment_ref',
		statusid=3, paymenttypeid=$payment_type, attachment='$payment_attach'
		WHERE id=$orderid";
	}
	else
	{
		$sql = "UPDATE roarcredit_payment SET
		paymentdate='{$datetime->format('Y/m/d H:i:s')}', updateddate=CURDATE(),
		paymentamount=$payment_amount, remarks='$payment_remarks', refno='$payment_ref',
		statusid=3, bankid=$payment_bank,
		paymenttypeid=$payment_type, attachment='$payment_attach'
		WHERE id=$orderid";
	}
	
	if (roar_payment_made($name, $row['packagename'], $row['roaramount'], $payment_amount, $datetime->format('d M Y H:i:s'), $payment_remarks))
		$display_msg = true;

	$db->query($sql) or die(mysql_error());
	$db->close();

	$display_msg = true;
}
?>

<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="<?php echo ROOT; ?>js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript">
jQuery(function($){
	$("#payment_date").datepicker();
	$("#payment_date").datepicker( "option", "dateFormat", "dd M yy" );
	$("#payment_time").timepicker({
		timeFormat: "hh:mm tt"
	});
});
</script>

<style>
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style>

<div>
	<?php if (!$display_msg) {?>
	<form method="post"
		action="addpayment.php?&memberid=<?php echo $memberid;?>&name=<?php echo $name; ?>&orderid=<?php echo $orderid; ?>"
		onsubmit="return validateForm()" id="payment_form"
		enctype="multipart/form-data">
		<label>ROAR Package : </label><span><?php echo $row['packagename'];?>
		</span> <br> <label>Total Charges : RM </label><span><?php echo sprintf("%0.2f", $row['charges']);?>
		</span> <br> <br> <span>Payment Channel: </span>
		<?php 
		$result = select_all_paymenttype();

		if (count($result) > 0)
		{
			foreach ($result as $each)
			{
				if($each['id'] != 1)
				{
					echo "<input type='radio' name='payment' value='{$each['id']}' />{$each['description']}";
				}
			}
		}
		?>
		<br>
		<div id="payment">
			<div id="bank">
				<label>Bank :</label><select id="payment_bank" name="payment_bank">
					<option value="">Please select..</option>
					<?php 
					$result = select_all_bank();

					if (count($result) > 0)
					{
						foreach ($result as $each)
						{
							echo "<option value='{$each['id']}'>{$each['description']}</option>";
						}
					}
					?>
				</select><br>
			</div>
			<label>Amount (RM) :</label><input type="text" onkeypress="return isNumberKey(event)" value='<?php echo sprintf("%0.2f", $row['charges']); ?>' disabled="disabled"/> <label>Reference No :</label><input
				type="text" id="payment_ref" name="payment_ref" /><br> <label>Transaction
				Date:</label><input type="text" id="payment_date"
				name="payment_date" /><br> <label>Transaction Time :</label><input
				type="text" id="payment_time" name="payment_time" class="ui-timepicker-input"/><br> <label>Attachment
				:</label><input type="file" id="payment_attach"
				name="payment_attach" /><br> <label>Remarks :</label><input type="text"
				id="payment_remarks" name="payment_remarks" /><br><br>

			<div id="payment_err"></div>
			<!-- Hidden Fields -->
			<input type="hidden" id="payment_type" name="payment_type" />
			<input type="hidden" id="payment_amount" name="payment_amount" value="<?php echo sprintf("%0.2f", $row['charges']); ?>"/>
			<input id="submit" type="submit" name="submit" value="Confirm" />
		</div><button onclick="javascript:parent.$.fancybox.close();preventDefault();">Cancel</button>
	</form>
	<?php } else { ?>
	<script type="text/javascript">
		parent.updated = true;
	</script>
	<p>
		<?php echo 'Payment Information Updated successfully. Please wait for ADMIN approval to update the ROAR credit.'; ?>
	</p>
	<button onclick="javascript:parent.$.fancybox.close();">Close</button>
	<?php } ?>
</div>
<div class="clear"></div>

<script type="text/javascript">
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;

    if (charCode == 46 && $("#payment_amount").val().indexOf('.') == -1)
        return true;
    
    if (charCode > 31 && ((charCode < 48) || (charCode > 57)))
        return false;
    
    return true;
}
	
function validateForm()
{
	var payment_amount = document.forms["payment_form"]["payment_amount"].value;
	var payment_type = document.forms["payment_form"]["payment_type"].value;
	var payment_bank = document.forms["payment_form"]["payment_bank"].value;
	var payment_ref = document.forms["payment_form"]["payment_ref"].value;
	var payment_date = document.forms["payment_form"]["payment_date"].value;
	var payment_time = document.forms["payment_form"]["payment_time"].value;
	var payment_attach = document.forms["payment_form"]["payment_attach"].value;

	var booking_err = "";
	
	if (payment_type == null || payment_type == "")
  	{
	  	booking_err = booking_err + "[Payment Type] Please select Payment Type. <br/>";
  	}
  	
	if(payment_type != "4"){
		if (payment_bank == null || payment_bank == "")
  		{
			booking_err = booking_err + "[Bank] Please select Bank. <br/>";
  		}
	}

	if (payment_amount == null || payment_amount == "")
  	{
	  	booking_err = booking_err + "[Payment Amount] Please insert paid amount. <br/>";
  	}
  	
  	if (payment_ref == null || payment_ref =="")
  	{
		booking_err = booking_err + "[Reference No] Please insert Reference no. <br/>";
  	}
  	
  	if (payment_date == null || payment_date == "")
  	{
		booking_err = booking_err + "[Payment Date] Please select Payment Date. <br/>";
  	}
  	
	if (payment_time ==null || payment_time =="")
  	{
		booking_err = booking_err + "[Payment Time] Please select Payment Time. <br/>";
  	}
  	
	if (payment_attach != null && payment_attach != "")
  	{
		var splitattach = payment_attach.split('.');
		var type = splitattach[splitattach.length-1].toUpperCase();
		var arr = [ "JPEG", "JPG", "PNG", "PDF"];

		if ($.inArray(type, arr) == -1)
		{
			booking_err = booking_err + "[Attachment] Allowed attachments are jpeg, jpg, png and pdf. <br/>";
		}
	}
	
	if (booking_err != "")
  	{
  		$("#payment_err").html(booking_err);
 		return false;
  	}
}

				
$("input:radio").change(function(){
	$("#payment_type").val($(this).val());
	$("#payment").show(100);
	
	if($(this).val() == "4"){
		$("#bank").hide();
	}
	else
	{
		$("#bank").show(100);
	}
});

$('#payment_attach').bind('change', function() {
    if(this.files[0].size > (2 * 1024 * 1024))
    {
		alert("Max allowed file size is 2MB.");
		$(this).val("");
    }
});

$(document).ready(function(){
	$("#payment").hide();
});	
</script>
