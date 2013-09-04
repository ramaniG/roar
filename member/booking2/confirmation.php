<?php 
DEFINE('ROOT', '../../');
$current_page = "booking";
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');
$memberid = safe_input(member_session());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php 
include_once ROOT.'usercontrol/top-scripts.php';
include_once '../member-header.php';
if(isset($_GET['studioid']))
{
	$studio = $_GET['studioid'];
	$timeslotId = $_GET['timeslotid'];
}
?>
<script type="text/javascript">
var studio = getUrlVars()["studioid"];
var time = getUrlVars()["timeslotid"];
var jsontime = convert(time);
var startTime = <?php echo json_encode(select_timeslot_starttime()); ?>;
var endTime = <?php echo json_encode(select_timeslot_endtime()); ?>;
var htmlbuild = "";

$(document).ready(function(){
	for (var i = 0; i < jsontime.length; i++)
	{
		var each = jsontime[i];
		var splitTime = each["id"].split(',');
		var start = "";
		var end = "";

		start = startTime[parseInt(splitTime[0] - 1)];
		end = endTime[parseInt(splitTime[splitTime.length - 1] - 1)];

		htmlbuild = htmlbuild + dateToYMD(each['date'] - 1) + " : " + start + " - " + end + '<br/>';
	}

	$("#timedate").html(htmlbuild);
});

function dateToYMD(add) {
	var date = new Date();
	var newDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() + add);
    
    return newDate.toDateString();
}

function back()
{
	window.location.href = "booking.php?studioid=" + studio + "&timeslotid=" + time;
}

function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function convert(selectedId)
{
	var jsonObj = [];

	if (selectedId != "")
	{
		var splitId = selectedId.split(';');
		var selectedDate = 0;
		var previousId = -1;
		var ids = "";
		for (var i = 0; i < splitId.length; i++) 
  	{
	  	var a = splitId[i].split('_');

	  	if(selectedDate == 0)
	  	{
		  	selectedDate = a[0];
		  	ids = a[1];
		  	previousId = a[1];
	  	}
	  	else if (selectedDate == a[0] && ((++previousId) == parseInt(a[1])))
	  	{
	  		ids = ids + "," + a[1];
	  		previousId = a[1];
	  	}
	  	else
	  	{
		  	jsonObj.push({date:selectedDate, id:ids});
		  	selectedDate = a[0];
		  	previousId = parseInt(a[1]);
		  	ids = a[1];
	  	}
		}

		jsonObj.push({date:selectedDate, id:ids});
  		selectedDate = 0;
  		ids = "";
		var myJSONText = JSON.stringify(jsonObj);
		$("#timeslotid").val(myJSONText);
	}
	
	return jsonObj;
}

function processform()
{
	var bookingnolist = "";
	
	var request_time = $.ajax({
		  url: "processform.php?studioid=" + studio,
		  type: "POST",
		  data: {"time" : JSON.stringify(jsontime), 
			  "roaramount": <?php echo count(explode(';',$timeslotId)) * 50; ?> },
		  processData: true,
		  dataType: "text"
		});
		 
		request_time.done(function(msg) {
			bookingnolist = msg;
			if (bookingnolist.indexOf("R") >= 0)
			{
				alert("Congratulations!!. Your booking have been successfully made. \n Booking Reference:\n" 
						+ bookingnolist + "\n Please keep this number for verification later. \n Thanks!");
				window.location.href = "../index.php";
			}
			else
			{
				alert("Booking failed. Error : " + msg);
				window.location.href = "../index.php";
			}
		});

		request_time.fail(function(jqXHR, textStatus) {
			  alert( "Request failed: " + textStatus + ". Please try again." );
			});
}
</script>
</head>
<body>
	<?php include_once ROOT.'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once ROOT.'usercontrol/nav-main.php';?>
		<?php include_once ROOT.'usercontrol/banner-small.php';?>
		<div id="content">
			<div class="top"></div>
			<div class="middle">
				<div class="left">
					<?php include_once '../member_menu.php';?>
				</div>
				<div class="right">
					<div class="wrapper">
						<span>Booking Details</span> <br /> <label>Studio : </label> <label><?php $a = select_studio($studio); echo $a['description'];?>
						</label> <br /> <label>Dates and Time :</label>
						<div id="timedate"></div>
						<br /> <label>Total Roar Credit Charged : </label> <label>
						<?php
						if ($studio == 1) 
							echo count(explode(';',$timeslotId)) * STUDIOAPRICE;
						else
							echo count(explode(';',$timeslotId)) * STUDIOBPRICE; 
						?>
						</label> <br /> <label>Total Roar Credit Available : </label> <label><?php echo $roaramount; ?>
						</label> <br />

						<button onclick="back();">Back</button>
						<button onclick="processform();">Confirm</button>
					</div>
				</div>
				<div style="clear: both">
					<br>
				</div>
				<div class="end"></div>
			</div>
			<div class="bottom"></div>
		</div>
	</div>
	<?php include_once ROOT.'usercontrol/footer.php';?>
</body>
</html>
