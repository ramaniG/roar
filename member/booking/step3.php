<?php
DEFINE('ROOT', '../../');
include('header.php');

$payment_amount = "";
$payment_type = "";
$payment_bank = "";
$payment_date = "";
$payment_time = "";
$payment_ref = "";
$payment_attach = "";

$db = new Database();
if(!empty($_POST['studioid']))
	$studioid = $db->sqlSafe($_POST['studioid']);
if(!empty($_POST['datebooked']))
	$datebooked = $db->sqlSafe($_POST['datebooked']);
if(!empty($_POST['timeslotid']))
	$timeslotid = $db->sqlSafe($_POST['timeslotid']);
if(!empty($_POST['payment_amount']))
	$payment_amount = $db->sqlSafe($_POST['payment_amount']);
if(!empty($_POST['payment_type']))
	$payment_type = $db->sqlSafe($_POST['payment_type']);
if(!empty($_POST['payment_bank']))
	$payment_bank = $db->sqlSafe($_POST['payment_bank']);
if(!empty($_POST['payment_date']))
	$payment_date = $db->sqlSafe($_POST['payment_date']);
if(!empty($_POST['payment_time']))
	$payment_time = $db->sqlSafe($_POST['payment_time']);
if(!empty($_POST['payment_ref']))
	$payment_ref = $db->sqlSafe($_POST['payment_ref']);


if(!empty($_GET['studioid']))
	$studioid = $db->sqlSafe($_GET['studioid']);
if(!empty($_GET['datebooked']))
	$datebooked = $db->sqlSafe($_GET['datebooked']);
if(!empty($_GET['timeslotid']))
	$timeslotid = $db->sqlSafe($_GET['timeslotid']);
if(!empty($_GET['payment_amount']))
	$payment_amount = $db->sqlSafe($_GET['payment_amount']);
if(!empty($_GET['payment_type']))
	$payment_type = $db->sqlSafe($_GET['payment_type']);
if(!empty($_GET['payment_bank']))
	$payment_bank = $db->sqlSafe($_GET['payment_bank']);
if(!empty($_GET['payment_date']))
	$payment_date = $db->sqlSafe($_GET['payment_date']);
if(!empty($_GET['payment_time']))
	$payment_time = $db->sqlSafe($_GET['payment_time']);
if(!empty($_GET['payment_ref']))
	$payment_ref = $db->sqlSafe($_GET['payment_ref']);
if(!empty($_GET['payment_attach']))
	$payment_attach = $db->sqlSafe($_GET['payment_attach']);


//Process form before submission
$booking_err_msg = '';
if(isset($_POST['submit_button']))
{
	if(!empty($_POST['payment_type']))
		$payment_type = $_POST['payment_type'];
	else
		$booking_err_msg .= '[Payment Type] Please select the Payment Type before proceed.<br/>';

	if(!empty($_POST['payment_amount']))
		$payment_amount = $_POST['payment_amount'];

	if(!empty($_POST['payment_bank']))
		$payment_bank = $_POST['payment_bank'];

	if(!empty($_POST['payment_date']))
		$payment_date = $_POST['payment_date'];
	else
		$booking_err_msg .= '[Payment Date] Please select the Payment Date before proceed.<br/>';

	if(!empty($_POST['payment_time']))
		$payment_time = $_POST['payment_time'];
	else
		$booking_err_msg .= '[Payment Time] Please select the Payment Time before proceed.<br/>';

	if(!empty($_POST['payment_ref']))
		$payment_ref = $_POST['payment_ref'];
	else
		$booking_err_msg .= '[Payment Refference] Please insert the Payment Refference before proceed.<br/>';

	if(!empty($_POST['payment_attach']))
		$payment_attach = $_POST['payment_attach'];


	if(!empty($_FILES[$payment_type."_payment_attach"]['tmp_name']))
	{
		$allowedExts = array("pdf", "jpeg", "jpg", "png");
		$filename = $_FILES[$payment_type."_payment_attach"]["name"];
		$temp = explode(".", $filename);
		$extension = end($temp);
		if ((($_FILES[$payment_type."_payment_attach"]["type"] == "application/pdf")
				|| ($_FILES[$payment_type."_payment_attach"]["type"] == "image/jpeg")
				|| ($_FILES[$payment_type."_payment_attach"]["type"] == "image/jpg")
				|| ($_FILES[$payment_type."_payment_attach"]["type"] == "image/pjpeg")
				|| ($_FILES[$payment_type."_payment_attach"]["type"] == "image/x-png")
				|| ($_FILES[$payment_type."_payment_attach"]["type"] == "image/png"))
				&& ($_FILES[$payment_type."_payment_attach"]["size"] < 1000000)
				&& in_array($extension, $allowedExts))
		{
			if ($_FILES[$payment_type."_payment_attach"]["error"] > 0)
			{
				$booking_err_msg .= "[Attachment] " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				move_uploaded_file($_FILES[$payment_type."_payment_attach"]['tmp_name'], ROOT.'attachment/'.$name.date("Ymdgi").'.'.$extension);
				$payment_attach = ROOT.'attachment/'.$name.date("Ymdgi").'.'.$extension;
			}
		}
		else
		{
			$booking_err_msg .= "[Attachment] Invalid file extension uploaded!<br>";
		}
	}



	if(empty($booking_err_msg))
	{
		echo "<script>";
		echo "$(window).load(function() {";
		echo "  	$('#frm_booking2').attr('action', 'confirm.php');";
		echo "		$('#frm_booking2').submit();";
		echo "});";
		echo "</script>";
	}
}

?>
<style>
.tran-date {
	margin-top: 0;
}

.add-on {
	float: left;
}

.controls {
	float: left;
	margin: 0 0 10px 0;
}
</style>


<style>
.box {
	margin: 0 0 20px;
	padding: 20px 0 0;
	border: 3px solid #8a8a8a;
	background: #747474;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 0 0 1px #fff;
	box-shadow: inset 0 0 0 1px #747474;
	padding: 8px;
	font-size: 15px;
	color: #9f9f9f;
}

.submit {
	background: #222 url(/images/alert-overlay.png) repeat-x;
	display: inline-block;
	padding: 5px 10px 6px;
	color: #fff;
	text-decoration: none;
	font-weight: bold;
	line-height: 1;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
	text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
	cursor: pointer;
	width: 30%;
	margin-left: 25%;
	margin-right: 25%;
}

.submit:hover {
	background: #feba2c;
}

.msg {
	padding: 10px;
	padding-left: 35px;
}

.msg.error {
	background: url("../../images/booking/ico-delete.gif") 10px 50%
		no-repeat;
}

.msg.error {
	border: 2px solid #FFAEAE;
	background-color: #FEEBEB;
}
</style>

<fieldset id="booking-section">
	<h2 align="center" class="head1">Step 3</h2>
	<br> <br>
	<form id="frm_booking2" method="post" action="#booking-section"
		enctype="multipart/form-data">

		<?php
		if(!empty($booking_err_msg))
		{
			echo "<div class='msg error'>".$booking_err_msg."</div>";
			echo "<div style='padding:10px;'></div>";
		}
		?>

		<label>Studio:</label> <span> <?php
		$sql = "SELECT description FROM studio WHERE id = {$studioid} LIMIT 0,1";
		$result = $db->query($sql);
		$studiodesc = '';
		if($db->numRows($result) > 0)
		{
			while ($row = mysql_fetch_row($result))
			{
				$studiodesc = $row[0];
			}
		}
		echo $studiodesc; ?>
		</span><br /> <label>Booking Date:</label> <span><?php echo $datebooked; ?>
		</span><br /> <label>Time Slot: </label> <span class="booking_desc"> <?php
		$id = explode(';', $timeslotid);
		foreach ($id as $eachid)
		{
			$sql = "SELECT description FROM timeslot WHERE id = '{$eachid}' LIMIT 0,1";
			$result = $db->query($sql);
			$desc = '';
			if($db->numRows($result) > 0)
			{
				while ($row = mysql_fetch_row($result))
				{
					$desc = $row[0];
				}
			}
			echo $desc;
			echo "; ";
		}

		?>
		</span> <br> <label>Booking Fees : RM </label> <span><?php echo sprintf("%0.2f",(count($id)*3.50));?>
		</span> <br> <br> <span>Payment Channel: </span> <br> <input
			type="radio" name="payment" value="online" />Online Fund Transfer <br>
		<input type="radio" name="payment" value="atm" />ATM Transfer <br> <input
			type="radio" name="payment" value="deposit" />Cash Deposit <br> <input
			type="radio" name="payment" value="roar" disabled="disabled" />ROAR!
		Credit (coming soon)<br> <br> <br>
		<div id="payment">
			<div id="online" class="payment_method">
				<label>Bank :</label><select id="online_payment_bank">
					<option>Please select..</option>
					<option value="1">Maybank</option>
					<option value="2">CIMB</option>
					<option value="3">Public</option>
				</select><br> <label>Refence No :</label><input type="text"
					id="online_payment_ref" /><br> <label>Transaction Date:</label><input
					type="date" id="online_payment_date" /><br> <label>Transaction Time
					:</label><input type="time" id="online_payment_time" /><br> <label>Attachment
					:</label><input type="file" id="online_payment_attach"
					name="online_payment_attach" />
			</div>
			<div id="atm" class="payment_method">
				<label>Bank :</label><input type="hidden" /> <select
					id="atm_payment_bank">
					<option>Please select..</option>
					<option value="1">Maybank</option>
					<option value="2">CIMB</option>
					<option value="3">Public</option>
				</select><br> <label>Refence No :</label><input type="text"
					id="atm_payment_ref" /><br> <label>Transaction Date:</label><input
					type="date" id="atm_payment_date" name="atm_payment_date" /><br> <label>Transaction
					Time :</label><input type="time" id="atm_payment_time" /><br> <label>Attachment
					:</label><input type="file" id="atm_payment_attach"
					name="atm_payment_attach" />
			</div>
			<div id="deposit" class="payment_method">
				<label>Refence No :</label><input type="text"
					id="deposit_payment_ref" /><br> <label>Transaction Date:</label><input
					type="date" id="deposit_payment_date" /><br> <label>Transaction
					Time :</label><input type="time" id="deposit_payment_time" /><br> <label>Attachment
					(max 1MB) :</label><input type="file" id="deposit_payment_attach"
					name="deposit_payment_attach" />
			</div>

		</div>


		<br> <label>&nbsp;</label> <a
			href="step2.php?studio=<?php echo $studioid ?>&datebooked=<?php echo $datebooked ?>&timeslotid=<?php echo $timeslotid ?>"
			style="float: left;"> <input id="back_button" type="button"
			name="back_button" value="BACK &nbsp&nbsp&nbsp <<" class="
			submit" 
			style="width: 200px; margin-left: 90px;" />
		</a> <input id="submit_button" type="submit" name="submit_button"
			value="NEXT &nbsp&nbsp&nbsp >>" class="submit"
			style="float: left; margin-left: 15px;" /> <br> <br> <br>
		<div class="clear"></div>


		<!-- Hidden Field -->
		<input id="studioid" type="hidden" name="studioid"
			value="<?php echo $studioid; ?>" /> <input id="datebooked"
			type="hidden" name="datebooked" value="<?php echo $datebooked; ?>" />
		<input id="timeslotid" type="hidden" name="timeslotid"
			value="<?php echo $timeslotid; ?>" /> <input id="payment_amount"
			type="hidden" name="total_payment"
			value="<?php echo sprintf("%0.2f",(count($id)*3.50)); ?>" /> <input
			id="payment_type" type="hidden" name="payment_type"
			value="<?php echo $payment_type; ?>" /> <input id="payment_bank"
			type="hidden" name="payment_bank"
			value="<?php echo $payment_bank; ?>" /> <input id="payment_date"
			type="hidden" name="payment_date"
			value="<?php echo $payment_date; ?>" /> <input id="payment_time"
			type="hidden" name="payment_time"
			value="<?php echo $payment_time; ?>" /> <input id="payment_ref"
			type="hidden" name="payment_ref" value="<?php echo $payment_ref; ?>" />
		<input id="payment_attach" type="hidden" name="payment_attach"
			value="<?php echo $payment_attach; ?>" /> <input type="hidden"
			name="MAX_FILE_SIZE" value="1000000" />

	</form>
</fieldset>

<script type="text/javascript">
$("input:radio").change(function() 
		{
    		$("div.payment_method").hide();
    		$("#" + $(this).val()).show(100);
    		$("#payment_type")[0].value = $(this).val();
    		$("#payment_date")[0].value = "";
    		$("#payment_time")[0].value = "";
    		$("#payment_ref")[0].value = "";
    		$("#payment_bank")[0].value = "";
    		
		<?php 
				$payment_bank = "";
				$payment_date = "";
				$payment_time = "";
				$payment_ref = "";
				$payment_attach = "";
			?>


		$("input[id='"+ $("#payment_type")[0].value +"_payment_date']").change(function () 
				{
					var bfdate = $(this).val().split("-");		
					$("#payment_date")[0].value = bfdate[2] + "-" + bfdate[1] + "-" + bfdate[0];
		});

		$("input[id='"+ $("#payment_type")[0].value +"_payment_time']").change(function () 
				{	
			$("#payment_time")[0].value = $(this).val();
		});

		$("input[id='"+ $("#payment_type")[0].value +"_payment_ref']").change(function () 
				{	
			$("#payment_ref")[0].value = $(this).val();
		});

		if($("#payment_type")[0].value != "deposit"){
		$("select[id='"+ $("#payment_type")[0].value +"_payment_bank']").change(function () 
				{
			$("select[id='"+ $("#payment_type")[0].value +"_payment_bank'] option:selected").each(function () 
					{
	        			$("#payment_bank")[0].value = $(this).val();
	      			});
		});
		}
		
	});

	$(document).ready(function()
		{
			$("div.payment_method").hide();
			
			if ($("#payment_type")[0].value != "")
			{
				if ($("#payment_attach")[0].value == "")
					alert("Please re-upload attachement.");
				
				var type = $("#payment_type")[0].value;
				
				$("#" + $("#payment_type")[0].value).show(100);
				$("input:radio").each(function()
						{
							if ($(this).val() == type)
								$(this).prop('checked', true);
						});


				var date = $("#payment_date")[0].value.split('-');
				var day = ("0" + date[0]).slice(-2);
    			var month = ("0" + date[1]).slice(-2);

    			var today = date[2]+"-"+(month)+"-"+(day) ;
    			$("#"+ type +"_payment_date").val(today);

				
				$("input[id='"+ type +"_payment_time']")[0].value = $("#payment_time")[0].value;
				$("input[id='"+ type +"_payment_ref']")[0].value = $("#payment_ref")[0].value;

				
				if(type != "deposit")
				{
				$("select[id='"+ type +"_payment_bank'] option").each(function () 
						{
							if ($(this).val() == $("#payment_bank")[0].value)
		        				$(this).prop("selected", true);
		      			});


				}
				$("input[id='"+ type +"_payment_date']").change(function () 
						{
							var bfdate = new Date($(this).val());		
							$("#payment_date")[0].value = bfdate.getDate() + "-" + (bfdate.getMonth() + 1) + "-" + bfdate.getFullYear();
				});

				$("input[id='"+ type +"_payment_time']").change(function () 
						{	
							$("#payment_time")[0].value = $(this).val();
				});

				$("input[id='"+ type +"_payment_ref']").change(function () 
						{	
							$("#payment_ref")[0].value = $(this).val();
				});

				$("select[id='"+ type +"_payment_bank']").change(function () 
						{
					$("select[id='"+ type +"_payment_bank'] option:selected").each(function () 
							{
			        			$("#payment_bank")[0].value = $(this).val();
			      			});
				});
			}
		}
	);	
</script>


​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​


<?php
$db->close();
$db = null;

include('footer.php');

?>