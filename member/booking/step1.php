<?php 
DEFINE('ROOT', '../../');
include('header.php');
$db = new Database();
if(!empty($_GET['studio']))
	$studioid = $db->sqlSafe($_GET['studio']);
if(!empty($_GET['datebooked']))
	$datebooked = $db->sqlSafe($_GET['datebooked']);
?>
<link rel="stylesheet"
	type="text/css" media="all" href="../../css/jsDatePick_ltr.css" />
<script
	type="text/javascript" src="../../js/jsDatePick.full.1.3.js"></script>

<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			cellColorScheme:"beige",
			limitToFutur:true,
			target:"inputField",
			dateFormat:"%d/%m/%Y"			
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
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
	$todays_date = date("Y-m-d");
	$booked_date = str_replace('/', '-', $_POST['datebooked']);
	$booked_date = date("Y-m-d", strtotime($booked_date));

	$todays_date = strtotime($todays_date);
	$booked_date = strtotime($booked_date);

	if(empty($_POST['studioid'])) {
$booking_err_msg .= '[Studio] Please choose the desired studio before proceed.<br/>';
}
if(empty($_POST['datebooked'])) {
$booking_err_msg .= '[Date] Please select the date for booking before proceed.<br/>';
}
elseif(!empty($_POST['datebooked']) && $booked_date < $todays_date) {
$booking_err_msg .= '[Date] Please don\'t select the past date';
}

if(empty($booking_err_msg))
{
	echo "<script>";
	echo "$(window).load(function() {";
	//echo "  setInterval(function(){";
	echo "  	$('#frm_booking').attr('action', 'step2.php');";
	echo "		$('#frm_booking').submit();";
	//echo "	}, 2000);";
	echo "});";
	echo "</script>";
}
}
?>
<fieldset style="height: 320px;">
	<h2 align="center" class="head1">Step 1</h2>
	<br> <br>
	<form id='frm_booking' method="post" action="#booking-section"
		enctype="multipart/form-data">
		<?php
		if(!empty($booking_err_msg))
		{
			echo "<div class='msg error'>".$booking_err_msg."</div>";
			echo "<div style='padding:10px;'></div>";
		}
		?>
		<label>Select Studio:</label> <select id="studio" name="studioid"
			class="box">
			<option value="">Please select</option>
			<?php
			$result = select_all_studio();

			if (count($result) > 0)
			{
				foreach ($result as $row)
				{
					echo "<option value='{$row['id']}'>{$row['description']}</option>";
				}
			}
			?>
		</select> <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
			Select Date:</label>
		<?php

		if(!empty($_POST['datebooked']))
			echo "	<input type='text' size='12' id='inputField' name='datebooked' class='box' value='".$_POST['datebooked']."' /><br><br><br>";
		elseif(!empty($datebooked))
		echo "	<input type='text' size='12' id='inputField' name='datebooked' class='box' value='".$datebooked."' /><br><br><br>";
		else

			echo "	<input type='text' size='12' id='inputField' name='datebooked' class='box'/><br><br><br>";
		?>

		<label>&nbsp;</label><input id="submit_button" type="submit"
			name="submit_button" value="NEXT &nbsp&nbsp&nbsp >>" class="submit" />
		<div class="clear"></div>

	</form>
</fieldset>

<?php 
function addDate($date,$day)//add days
{
	return strtotime(date("d/m/Y", strtotime($date)) . " +{$day} day");
}


//Check time slot availability for 7 days.

$timeslot = array();
$timeslotdesc = array();
$sql = "SELECT id, description FROM timeslot";
$result = $db->query($sql);
if($db->numRows($result) > 0) {
	$i = 0;
	while ($row = mysql_fetch_row($result)) {
		$timeslot[$i] = $row[0];
		$timeslotdesc[$i] = $row[1];
		$i++;
	}
}
$studio = array();
$studiodesc = array();
$sql = "SELECT id, description FROM studio";
$result = $db->query($sql);
if($db->numRows($result) > 0) {
	$i = 0;
	while ($row = mysql_fetch_row($result)) {
		$studio[$i] = $row[0];
		$studiodesc[$i] = $row[1];
		$i++;
	}
}

for($z=0; $z< count($studio); $z++ ){

	echo "<div>";
	echo "<p align='center' class='head1'>$studiodesc[$z]</p><br>";
	echo "<table border=1>";
	echo "<tr><td></td>";
	foreach($timeslotdesc as $desc) {
	echo "<th>{$desc}</th>";
	}
	echo "</tr>";

	$newdate = new DateTime(date('Y-m-d'));
	//$newdate->modify('+1 day');
	for($k=1; $k<=7; $k++) {
	echo "<tr><td>{$newdate->format('d/m/Y')}</td>";
	for($j=0; $j< count($timeslot); $j++ ){
	$status = is_time_slot_exists($newdate->format('d/m/Y'), $timeslot[$j], $studio[$z]);
	if($status != false) {
	if($status == 'new')
		echo "<td style='background:yellow;'>&nbsp;</td>";
	elseif($status == 'approved')
	echo "<td style='background:red;'>&nbsp;</td>";
				}
				else {
					echo "<td style='background:green;'>&nbsp;</td>";
				}
			}
			$newdate->modify('+1 day');
			echo '</tr>';
	}
	echo "</table>";
	echo "</div><br><br>";
	}
	?>

<?php 
$db->close();
$db = null;
?>

<?php include('footer.php'); ?>
