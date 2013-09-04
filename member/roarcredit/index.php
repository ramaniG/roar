<?php 
DEFINE('ROOT', '../../');
$current_page = "roarcredit";
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');
$memberid = safe_input(member_session());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
<?php include_once '../member-header.php';?>
<script type="text/javascript">
jQuery(function($){
	$("#datepicker").datepicker({ maxDate: "0"});
	$("#datepicker").datepicker( "option", "dateFormat", "dd M yy" );
});
</script>
<script type="text/javascript" src="<?php echo _FANCYBOX_JS; ?>"></script>
<link rel="stylesheet" type="text/css"
	href="<?php echo _FANCYBOX_CSS; ?>" media="screen" />
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
						<table>
							<tr>
								<td valign="middle" align="center"><label>ROAR!!! Credit Balance
										: <?php echo $roaramount;?>
								</label></td>
							</tr>

							<tr>
								<td><label>View Transaction : </label> <select id="trans-days">
										<option value="1">Today</option>
										<option value="7" selected="selected">7 Days</option>
										<option value="30">30 Days</option>
										<option value="60">60 Days</option>
										<option value="0">Specify</option>
								</select> <label id="lbl_datepicker" hidden="hidden">End Date :
								</label> <input type="text" id="datepicker" disabled="disabled"
									hidden="hidden" />
								</td>
							</tr>

							<tr>
								<td>
									<div id="trans-table">Trans table</div>
								</td>
							</tr>

							<tr>
								<td>Purchase ROAR Credit</td>
							</tr>
							<tr>
								<td>Available Packages</td>
							</tr>
							<tr>
								<td><?php 
								$result = select_all_active_roarpackage();

								if (count($result) > 0)
								{
									foreach ($result as $row)
									{
										echo "<input type='radio' name='package-type' value='{$row['id']}-{$row['charges']}' />{$row['packagename']} <br />";
									}
								}

								?>
								</td>
							</tr>
							<tr>
								<td><div id='msgerr' class='msgerr'></div></td>
							</tr>
							<tr>
								<td><label>Total Cost : RM </label><label id="package-amount">0.00</label><br />
									<button onclick="packageconformation()">Confirm</button>
								</td>
							</tr>
						</table>
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
<script type="text/javascript">
var packageamount = 0;
var packageid = 0;
var memberid = <?php echo $memberid;?>;
var updated = false;
var curpage = 1;

$(document).ready(function (){
	loadtable(memberid, 7, curpage);
});

function loadtable(member, numdays, page)
{
	var request_time = $.ajax({
		  url: "loadroartrans.php?memberid=" + member + "&numdays=" + numdays + "&page=" + page,
		  type: "POST",
		  processData: true,
		  dataType: "html"
		});
		 
		request_time.done(function(msg) {
		  $("#trans-table").html( msg );
		});

		request_time.fail(function(jqXHR, textStatus) {
			  alert( "Request failed: " + textStatus + ". Please try again." );
			});
}

$("input:radio").change(function(){
	$("input:radio").each(function(){	
		if($(this).is(':checked')){
			packageamount = $(this).val().split('-')[1];
			packageid = $(this).val().split('-')[0];
			$("#package-amount").text(parseInt(packageamount).toFixed(2));
		}
	});
});


		
function packageconformation()
{
	updated = false;
	if(isPackageSelected())
	{
		packageamount = $("#package-amount").text().replace('.', ',');
		$.fancybox.open({
			href : 'conformationdetails.php?amount=' + packageamount + "&memberid=" + memberid + "&packageid=" + packageid,
			type : 'iframe',
			padding : 5,
			width: 650,
			afterClose: function () {
				if(updated)
	            	parent.location.reload(true);
            }
		});
	}
	else
	{
		var booking_err_msg = '[ROAR Credit Package] Please select the wanted Package before proceed.<br/>';
		$("#msgerr").html(booking_err_msg);
	}
}

function isPackageSelected()
{
	isSelected = false;
	$("input:radio").each(function(){	
		if($(this).is(':checked'))
			isSelected = true;
	});

	return isSelected;
}

function attachpayment(orderid)
{
	updated = false;
	$.fancybox.open({
		href : 'addpayment.php?&memberid=' + memberid + "&name=<?php echo $name; ?>&orderid=" + orderid,
		type : 'iframe',
		padding : 5,
		width: 650,
		afterClose: function () {
			if(updated)
            	parent.location.reload(true);
        }
	});
}

function deleteOrder(orderid, string_id)
{
	var result = confirm("Are you sure that you want delete order : "+ string_id +"?");

	if (result)
	{
	var request_time = $.ajax({
		  url: 'deleteorder.php?orderid=' + orderid,
		  type: "POST",
		  processData: true,
		  dataType: "html"
		});
		 
		request_time.done(function(msg) {
			if (orderid == msg)
		  		alert("Order:" + string_id + " successfully deleted.");
			else
				alert("Order:" + string_id + " not successfully deleted.");

			parent.location.reload(true);
		});

		request_time.fail(function(jqXHR, textStatus) {
			  alert( "Request failed: " + textStatus + ". Please try again." );
			});
	}
}

$('#trans-days').change(function() {
	if($(this).val() != 0)
	{
		curpage = 1;
		$("#datepicker").attr("disabled", "disabled");
		$("#datepicker").attr("hidden", "hidden");
		$("#lbl_datepicker").attr("hidden", "hidden");
		loadtable(memberid, $(this).val(), curpage);
	}
	else
	{
		$("#datepicker").removeAttr("disabled");
		$("#datepicker").removeAttr("hidden");
		$("#lbl_datepicker").removeAttr("hidden");
		$("#datepicker").change(function (){
			var firstDate = new Date();
			var raw_date = $(this).val();
			var secondDate = new Date(raw_date);
			curpage = 1;

			var diffDays = parseInt((firstDate - secondDate)/ 86400000);

			loadtable(memberid, diffDays + 1, curpage);
		});
	}
});

</script>
</html>

