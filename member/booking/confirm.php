<?php
	DEFINE('ROOT', '../../');
	include('header.php');

	//if(isset($_POST['submit'])) {

		$db = new Database();
		$studioid = $db->sqlSafe($_POST['studioid']);
		$datebooked = $db->sqlSafe($_POST['datebooked']);
		$timeslotid = $db->sqlSafe($_POST['timeslotid']);
		$total_payment = $db->sqlSafe($_POST['total_payment']);
		$payment_type = $db->sqlSafe($_POST['payment_type']);
		$payment_bank = $db->sqlSafe($_POST['payment_bank']);
		$payment_date = $db->sqlSafe($_POST['payment_date']);
		$payment_time = $db->sqlSafe($_POST['payment_time']);
		$payment_ref = $db->sqlSafe($_POST['payment_ref']);
		$payment_attach = $db->sqlSafe($_POST['payment_attach']);
		
		$backURL = "&studioid=$studioid&datebooked=$datebooked&timeslotid=$timeslotid&total_payment=$total_payment&payment_type=$payment_type&payment_bank=$payment_bank&payment_date=$payment_date&payment_time=$payment_time&payment_ref=$payment_ref";
?>



<style>

.box{
margin: 0 0 20px; 
padding: 20px 0 0; 
border: 3px solid #8a8a8a; 
background: #747474; 
-webkit-border-radius: 4px; 
border-radius: 4px; 
-webkit-box-shadow: inset 0 0 0 1px #fff;
box-shadow: inset 0 0 0 1px #747474; 
padding:8px;
font-size: 15px;
color: #9f9f9f;
 }
 
 .submit{
	background: #222 url(/images/alert-overlay.png) repeat-x;
	display: inline-block;
	padding: 5px 10px 6px ;
	color: #fff;
	text-decoration: none;
	font-weight: bold;
	line-height: 1;	
	-webkit-border-radius: 5px;	
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	text-shadow: 0 -1px 1px rgba(0,0,0,0.25);	
	cursor: pointer;
	width: 30%;
	margin-left: 25%;
	margin-right: 25%;
 }

 .submit:hover{
 background: #feba2c;
 }

.booking_desc {
	color: #FFA800;
}

</style>


		<fieldset>
			<h2 align="center" class="head1">You Are Almost Done here!</h2><br><br><br>
			<form method="post" action="done.php" enctype="multipart/form-data">
				<label>Your booking description is: </label><br>
				<label>Studio:</label>
				<span class="booking_desc">
				<?php
					$sql = "SELECT description FROM studio WHERE id = '{$studioid}' LIMIT 0,1";
					$result = $db->query($sql);
					$studiodesc = '';
					if($db->numRows($result) > 0) {
						while ($row = mysql_fetch_row($result)) {
							$studiodesc = $row[0];
						}
					}
					echo $studiodesc; ?>
				</span><br>

				<label>Booking Date:</label> <span class="booking_desc"><?php echo $datebooked; ?></span><br>

			    <label>Time Slot: </label>
			    <span class="booking_desc">
				 <?php
				 	$id = explode(';', $timeslotid);
				 	foreach ($id as $eachid)
				 	{
				 		$sql = "SELECT description FROM timeslot WHERE id = '{$eachid}' LIMIT 0,1";
				 		$result = $db->query($sql);
				 		$desc = '';
				 		if($db->numRows($result) > 0) {
				 			while ($row = mysql_fetch_row($result)) {
				 				$desc = $row[0];
				 			}
				 		}
				 		echo $desc;
				 		echo "; ";
				 	}
				 	
					?> 
				</span> <br>
				
				<label>Payment Type : </label><span class="booking_desc"><?php echo ucwords($payment_type); ?></span><br>
				<label>Total Amount : </label><span class="booking_desc">RM <?php echo $total_payment; ?></span><br>
				<?php if($payment_type != "deposit"){?>
				<label>Payment Bank : </label><span class="booking_desc"><?php echo $payment_bank; ?></span><br>
				<?php }?>
				<label>Payment Date : </label><span class="booking_desc">
				<?php

				$date = explode('-', $payment_date);
				
				echo sprintf("%02s", $date[0]).'-'.sprintf("%02s", $date[1]).'-'.sprintf("%02s", $date[2]);
				
				?>
				
				</span><br>
				<label>Payment Time : </label><span class="booking_desc"><?php echo $payment_time; ?></span><br>
				<label>Payment Ref No : </label><span class="booking_desc"><?php echo $payment_ref; ?></span><br>
				
				<br><br>

				<label>&nbsp;</label>
				<a href="step3.php?<?php echo $backURL ?>" style="float:left;"><input id="back_button" type="button" name="back_button" value="BACK &nbsp&nbsp&nbsp <<" class="submit" style="width:200px; margin-left:90px;" /></a>
				<input id="confirm_button" type="submit" name="submit_button" value="CONFIRM !!!" class="submit" style="float:left; margin-left:385px; margin-top:-30px;" /><br><br><br>
				<div class="clear"></div>


				<!-- Hidden Field -->
				<input id="studioid" type="hidden" name="studioid" value="<?php echo $studioid; ?>" />
				<input id="datebooked" type="hidden" name="datebooked" value="<?php echo $datebooked; ?>" />
				<input id="timeslotid" type="hidden" name="timeslotid" value="<?php echo $timeslotid; ?>" />
				<input id="total_payment" type="hidden" name="total_payment" value="<?php echo $total_payment; ?>" /> 
				<input id="payment_type" type="hidden" name="payment_type" value="<?php echo $payment_type; ?>" /> 
				<input id="payment_bank" type="hidden" name="payment_bank" value="<?php echo $payment_bank; ?>" /> 
				<input id="payment_date" type="hidden" name="payment_date" value="<?php echo $payment_date; ?>" /> 
				<input id="payment_time" type="hidden" name="payment_time" value="<?php echo $payment_time; ?>" /> 
				<input id="payment_ref" type="hidden" name="payment_ref" value="<?php echo $payment_ref; ?>" />
				<input id="payment_attach" type="hidden" name="payment_attach" value="<?php echo $payment_attach; ?>" />

			</form>

		</fieldset>

<?php
		$db->close();
		$db = null;

		include('footer.php');
	//}
	//else {
	//	header('Location: step1.php?error=true');
	//}
?>
