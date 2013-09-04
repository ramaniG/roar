<?php
DEFINE('ROOT', '../../');
include('header.php');

//if(isset($_POST['submit_button'])) {

$db = new Database();
if(!empty($_POST['studioid']))
	$studioid = $db->sqlSafe($_POST['studioid']);
if(!empty($_POST['datebooked']))
	$datebooked = $db->sqlSafe($_POST['datebooked']);
if(!empty($_POST['timeslotid']))
	$timeslotid = $db->sqlSafe($_POST['timeslotid']);

if(!empty($_GET['studio']))
	$studioid = $db->sqlSafe($_GET['studio']);
if(!empty($_GET['datebooked']))
	$datebooked = $db->sqlSafe($_GET['datebooked']);
if(!empty($_GET['timeslotid']))
	$timeslotid = $db->sqlSafe($_GET['timeslotid']);
?>


<script type="text/javascript">
			$(document).ready(function(){
			//	$('#dp').datepicker();
			});
		</script>

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

<?php

//Process form before submission
$booking_err_msg = '';

if(isset($_POST['submit_button']))
{
	//if(empty($_POST['studio'])) { $booking_err_msg .= '[Studio] Please choose the desired studio before proceed.<br/>'; }
	//if(empty($_POST['datebooked'])) { $booking_err_msg .= '[Date] Please select the date for booking before proceed.<br/>'; }
	//elseif(!empty($_POST['datebooked']) && $booked_date < $todays_date) { $booking_err_msg .= '[Date] Please don\'t select the past date'; }
	if(empty($_POST['timeslotid']))
	{
		$booking_err_msg .= '[Time Slot] Please select the time slot before proceed.<br/>';
	}

	if(!empty($_POST['timeslotid']))
	{
		$timeslotid = $_POST['timeslotid'];
	}

	if(empty($booking_err_msg))
	{
		echo "<script>";
		echo "$(window).load(function() {";
		//echo "  setTimeout(function(){";
		echo "  	$('#frm_booking2').attr('action', 'step3.php');";
		echo "		$('#frm_booking2').submit();";
		//echo "	}, 1000);";
		echo "});";
		echo "</script>";
	}
}
?>
<fieldset id="booking-section">
	<h2 align="center" class="head1">Step 2</h2>
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
		</span> <label>Booking Date:</label> <span><?php echo $datebooked; ?>
		</span><br />

		<?php 

		$timeslot = array();
		$timeslotdesc = array();
		$sql = "SELECT id, description FROM timeslot";
		$result = $db->query($sql);
		if($db->numRows($result) > 0)
		{
			$i = 0;
			while ($row = mysql_fetch_row($result))
			{
				$timeslot[$i] = $row[0];
				$timeslotdesc[$i] = $row[1];
				$i++;
			}
		}

		echo "<div>";
		echo "<p align='center' class='head1'>$studiodesc</p><br>";
		echo "<table border=1 id='booking_timeslot'>";
		echo "<tr><td></td>";
		foreach($timeslotdesc as $desc)
		{
			echo "<th>{$desc}</th>";
		}
		echo "</tr>";

		echo "<tr><td>{$datebooked}</td>";


		for($j=0; $j< count($timeslot); $j++ )
		{
			$created = false;
			if (!empty($timeslotid))
			{
				$id = explode(';', $timeslotid);
				foreach ($id as $eachid)
				{
					if($eachid == $timeslot[$j])
					{
						echo "<td class='selected' id='$timeslot[$j]'>&nbsp;</td>";
						$created = true;
						break;
					}
				}

			}

			if (!$created)
			{
				$status = is_time_slot_exists($datebooked, $timeslot[$j], $studioid);
				if($status != false)
				{
					if($status == 'new')
					{
						echo "<td style='background:yellow;' class='pending' id='$timeslot[$j]'>&nbsp;</td>";
					}
					elseif($status == 'approved')
					{
						echo "<td style='background:red;' class='notavailable' id='$timeslot[$j]'>&nbsp;</td>";
					}
				}
				else
				{
					echo "<td class='available' id='$timeslot[$j]'>&nbsp;</td>";
				}
			}
		}


		echo '</tr>';
		echo "</table>";
		echo "</div><br><br>";

		?>


		<label>&nbsp;</label> <a
			href="step1.php?studio=<?php echo $studioid ?>&datebooked=<?php echo $datebooked ?>"
			style="float: left;"> <input id="back_button" type="button"
			name="back_button" value="BACK &nbsp&nbsp&nbsp <<" class="
			submit" style="width: 200px;" />
		</a> <input id="submit_button" type="submit" name="submit_button"
			value="NEXT &nbsp&nbsp&nbsp >>" class="submit"
			style="float: left; margin-left: 105px;" />
		<div class="clear"></div>

		<!-- Hidden Field -->
		<input id="studioid" type="hidden" name="studioid"
			value="<?php echo $studioid; ?>" /> <input id="datebooked"
			type="hidden" name="datebooked" value="<?php echo $datebooked; ?>" />
		<input id="timeslotid" type="hidden" name="timeslotid"
			value="<?php echo $timeslotid; ?>" />


	</form>
</fieldset>

<script type="text/javascript">
$(function(){
	  $("td").click(function(){
		  if ($(this).hasClass("available") == true)
		  {
			  $(this).removeClass("available");
			  $(this).addClass("selected");
		  }
		  else if ($(this).hasClass("selected") == true)
		  {
			  $(this).removeClass("selected");
			  $(this).addClass("available");
		  }

		  var selectedId = "";

		  $("#booking_timeslot > tbody > tr > td").each(function(){
			  if ($(this).hasClass("selected") == true)
			  {
				  selectedId = selectedId + ";" + $(this)[0].id;				  
			  }			  
			});

			if (selectedId != "")
		  		$("#timeslotid")[0].value = selectedId.substring(1);
	  });
	});
</script>

<style>
.selected {
	background-color: blue;
}

.pending {
	background-color: yellow;
}

.notavailable {
	background-color: red;
}

.available {
	background-color: green;
}
</style>

<?php
$db->close();
$db = null;

include('footer.php');

?>