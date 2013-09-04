<?php 
DEFINE('ROOT', '../../');
$current_page = "studiomanage";
require_once(ROOT.'sso/session.php');
require_once(ROOT.'_config.settings.php');

$adminid = safe_input(admin_session());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Roar: Admin</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
<?php include_once '../admin-header.php';?>
<script type="text/javascript" src="<?php echo _FANCYBOX_JS; ?>"></script>
<link rel="stylesheet" type="text/css"
	href="<?php echo _FANCYBOX_CSS; ?>" media="screen" />
<style>
.table1 {
	margin: 0px;
	padding: 0px;
	width: 100%;
	background-color: rgb(81, 88, 87);
	border: 1px solid #000000;
	font-size: 14px;
	font-family: Arial;
	font-weight: bold;
}

.trx {
	border: 1px solid rgb(77, 72, 61);
	background-color: black;
}

.head1 {
	padding: 0;
	margin-bottom: 20px;
	font-family: 'Raleway', sans-serif;
	color: #e79703;
	font-size: 30px;
	font-weight: bold;
}
</style>
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
					<a href="http://roar.com.my" class="logo"><img
						src="<?php echo ROOT; ?>images/logo/roar_music_logo.png"
						alt="roar_music_logo"> </a>
					<?php include_once '../admin_menu.php';?>
				</div>
				<div class="right">
					<div class="wrapper">
						<div class="master-container member">
							<div class="body">
								<div class="right-col">
									<table>
										<tr>
											<td><h2>STUDIO MANAGEMENT</h2></td>
										</tr>
										<tr>
											<td><label>Studio : </label> <select id="studio">
													<?php 
													$result = select_all_studio();

													if (count($result) > 0)
													{
														foreach ($result as $row)
														{
															if (!empty($studio) && $studio==$row['id']) {
											echo "<option value='{$row['id']}' selected='selected'>{$row['description']}</option>";
										}
										else
											echo "<option value='{$row['id']}'>{$row['description']}</option>";
														}
													}

													?>
											</select> <label>Month : </label> <?php 
											$current_month = date("Y-m-d");
											echo '<select id="month">';
											for ($i = 0; $i <= 5; $i++)
											{
												echo '<option value="'.$i.'"';
												if ($i == 0)
												{
													echo "selected='selected'";
													$mon = date("F Y", strtotime($current_month));
												}
												else
												{
													$mon = date("F Y", strtotime("+$i month", strtotime($current_month)));
												}

												echo '>'.$mon.'</option>';
											}
											echo '</select>'
			?>
											</td>
										</tr>

										<tr>
											<td>
												<div id="trans-table">Trans table</div>
												<div id="trans-table-not" style="display: none;">Trans table</div>
											</td>
										</tr>
										<tr>
											<td><label>Set selected timeslot as : </label>
												<button id="btn_public">Open All Day</button>
												<button id="btn_normal">Normal</button>
												<button id="btn_notpublic">Close All Day</button> <br />
												<button id="btn_available">Time Slot Available</button>
												<button id="btn_notavailable">Time Slot Not Available</button>
											</td>
										</tr>
									</table>
								</div>
								<!-- end of right col -->
							</div>
							<!-- end of body -->

						</div>
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
var updated = false;
var adminid = <?php echo $adminid; ?>;

$(document).ready(function (){
	loadtable($("#month").val(),$("#studio").val());
});

function loadtable(month, studio)
{
	var request_time = $.ajax({
		  url: "loadtimeslot.php?month=" + month + "&studio=" + studio,
		  type: "POST",
		  processData: true,
		  dataType: "html"
		});
		 
		request_time.done(function(msg) {
		  $("#trans-table").html( msg );
		  addClick();
		});

		request_time.fail(function(jqXHR, textStatus) {
			  alert( "Request failed: " + textStatus + ". Please try again." );
			});

		var studionot = studio == 1 ? 2 : 1;

		var request_time_not = $.ajax({
			  url: "loadtimeslot.php?month=" + month + "&studio=" + studionot,
			  type: "POST",
			  processData: true,
			  dataType: "html"
			});
			 
		request_time_not.done(function(msg) {
			  $("#trans-table-not").html( msg );
			});

		request_time_not.fail(function(jqXHR, textStatus) {
				  alert( "Request failed: " + textStatus + ". Please try again." );
				});
}

$('#studio').change(function() {
	loadtable($("#month").val(),$("#studio").val());
});

$('#month').change(function() {
	loadtable($("#month").val(),$("#studio").val());
});

$('#btn_public').click(function() {
	if(selectedId != "")
	{
		var result = confirm("Are you sure that you want to set the whole day as to Open?");
	
		if (result == true)
		{
			var studioText = $("#studio").val() == 1 ? "Studio A" : "Studio B";
			var studioTextNot = $("#studio").val() == 2 ? "Studio A" : "Studio B";
			var result = confirm("Applying changes to " + studioText +". \n Do you want to apply the changes to " + studioTextNot +" also?");
		
			var selectedStudio = result ? 3 : $("#studio").val();

			var splitId = selectedId.split(';');
			var datelist = "";
			var dateArray = new Array();
			var arrayCount = 0;
			
			for (var i = 0; i < splitId.length; i++)
			{
				var a = splitId[i].split('_');

				if (dateArray.indexOf(a[1]) == -1)
				{
					if (datelist == "")
						datelist = a[1];
					else
						datelist = datelist + ";" + a[1];

					dateArray[arrayCount] = a[1];	
					arrayCount++;
				}
				
			}

			var request_time = $.ajax({
				  url: "openallday.php?dates=" + datelist + "&month=" + $("#month").val() + "&studio=" + selectedStudio,
				  type: "POST",
				  processData: true,
				  dataType: "html"
				});
				 
				request_time.done(function(msg) {
				  alert( msg );
				  loadtable($("#month").val(),$("#studio").val());
				});

				request_time.fail(function(jqXHR, textStatus) {
					  alert( "Request failed: " + textStatus + ". Please try again." );
				});

			
		}
	}
	else
	{
		alert("Please select the timeslot first.");
	}
});

$('#btn_notpublic').click(function() {
	if(selectedId != "")
	{
		var result = confirm("Are you sure that you want to set the whole day as Close?");
	
		if (result == true)
		{
			var studioText = $("#studio").val() == 1 ? "Studio A" : "Studio B";
			var studioTextNot = $("#studio").val() == 1 ? "Studio B" : "Studio A";
			var result = confirm("Applying changes to " + studioText +". \n Do you want to apply the changes to " + studioTextNot +" also?");
		
			var selectedStudio = result ? 3 : $("#studio").val();

			var splitId = selectedId.split(';');
			var datelist = "";
			var dateArray = new Array();
			var arrayCount = 0;
			var update = true;
			
			for (var i = 0; i < splitId.length; i++)
			{
				var a = splitId[i].split('_');

				if (dateArray.indexOf(a[1]) == -1)
				{
					if (datelist == "")
						datelist = a[1];
					else
						datelist = datelist + ";" + a[1];

					dateArray[arrayCount] = a[1];	
					arrayCount++;
				}

				$("#trans-table > div > #booking_timeslot > tbody > tr > td[id*='_"+ a[1] +"_']" ).each(function(){
					if($(this).hasClass('confirmed'))
					{
						update = false;
						return;
					}
				});

				if (selectedStudio == 3)
				{
					$("#trans-table-not > div > #booking_timeslot > tbody > tr > td[id*='_"+ a[1] +"_']" ).each(function(){
						if($(this).hasClass('confirmed'))
						{
							update = false;
							return;
						}
					});
				}
			}

			if(update)
			{
				var request_time = $.ajax({
					  url: "closeallday.php?dates=" + datelist + "&month=" + $("#month").val() + "&studio=" + selectedStudio,
					  type: "POST",
					  processData: true,
					  dataType: "html"
					});
					 
					request_time.done(function(msg) {
					  alert( msg );
					  loadtable($("#month").val(),$("#studio").val());
					});

					request_time.fail(function(jqXHR, textStatus) {
						  alert( "Request failed: " + textStatus + ". Please try again." );
					});
			}
			else
			{
				alert('Please remove the booked date before closing for the whole day.');
			}
		}
	}
	else
	{
		alert("Please select the timeslot first.");
	}
});

$('#btn_normal').click(function() {
	if(selectedId != "")
	{
		var result = confirm("Are you sure that you want to set the whole day as Normal?");
	
		if (result == true)
		{
			var studioText = $("#studio").val() == 1 ? "Studio A" : "Studio B";
			var studioTextNot = $("#studio").val() == 2 ? "Studio A" : "Studio B";
			var result = confirm("Applying changes to " + studioText +". \n Do you want to apply the changes to " + studioTextNot +" also?");
		
			var selectedStudio = result ? 3 : $("#studio").val();

			var splitId = selectedId.split(';');
			var datelist = "";
			var dateArray = new Array();
			var arrayCount = 0;
			
			for (var i = 0; i < splitId.length; i++)
			{
				var a = splitId[i].split('_');

				if (dateArray.indexOf(a[1]) == -1)
				{
					if (datelist == "")
						datelist = a[1];
					else
						datelist = datelist + ";" + a[1];

					dateArray[arrayCount] = a[1];	
					arrayCount++;
				}
				
			}

			var request_time = $.ajax({
				  url: "normal.php?dates=" + datelist + "&month=" + $("#month").val() + "&studio=" + selectedStudio,
				  type: "POST",
				  processData: true,
				  dataType: "html"
				});
				 
				request_time.done(function(msg) {
				  alert( msg );
				  loadtable($("#month").val(),$("#studio").val());
				});

				request_time.fail(function(jqXHR, textStatus) {
					  alert( "Request failed: " + textStatus + ". Please try again." );
				});

			
		}
	}
	else
	{
		alert("Please select the timeslot first.");
	}
});

$('#btn_notavailable').click(function() {
	if(selectedId != "")
	{
		var studioText = $("#studio").val() == 1 ? "Studio A" : "Studio B";
		var studioTextNot = $("#studio").val() == 2 ? "Studio A" : "Studio B";
		var result = confirm("Applying changes to " + studioText +". \n Do you want to apply the changes to " + studioTextNot +" also?");
	
		var selectedStudio = result ? 3 : $("#studio").val();

		var splitId = selectedId.split(';');
		var datelist = "";
		var dateArray = new Array();
		var arrayCount = 0;
		
		for (var i = 0; i < splitId.length; i++)
		{
			var a = splitId[i].split('_');

			if (dateArray.indexOf(a[1]) == -1)
			{
				if (datelist == "")
					datelist = a[1] + "_" + a[2];
				else
					datelist = datelist + ";" + a[1] + "_" + a[2];

				dateArray[arrayCount] = a[1] + "_" + a[2];	
				arrayCount++;
			}

			var request_time = $.ajax({
				  url: "timeslotnotavailable.php?dates=" + datelist + "&month=" + $("#month").val() + "&studio=" + selectedStudio,
				  type: "POST",
				  processData: true,
				  dataType: "html"
				});
				 
				request_time.done(function(msg) {
				  loadtable($("#month").val(),$("#studio").val());
				});

				request_time.fail(function(jqXHR, textStatus) {
					  alert( "Request failed: " + textStatus + ". Please try again." );
				});
			
		}
		alert( "Changes was done." );
	}
	else
	{
		alert("Please select the timeslot first.");
	}
});

$('#btn_available').click(function() {
	if(selectedId != "")
	{
		var studioText = $("#studio").val() == 1 ? "Studio A" : "Studio B";
		var studioTextNot = $("#studio").val() == 2 ? "Studio A" : "Studio B";
		var result = confirm("Applying changes to " + studioText +". \n Do you want to apply the changes to " + studioTextNot +" also?");
	
		var selectedStudio = result ? 3 : $("#studio").val();
		var splitId = selectedId.split(';');
		var datelist = "";
		var dateArray = new Array();
		var arrayCount = 0;
		
		for (var i = 0; i < splitId.length; i++)
		{
			var a = splitId[i].split('_');

			if (dateArray.indexOf(a[1]) == -1)
			{
				if (datelist == "")
					datelist = a[1] + "_" + a[2];
				else
					datelist = datelist + ";" + a[1] + "_" + a[2];

				dateArray[arrayCount] = a[1] + "_" + a[2];	
				arrayCount++;
			}

			var request_time = $.ajax({
				  url: "timeslotavailable.php?dates=" + datelist + "&month=" + $("#month").val() + "&studio=" + selectedStudio,
				  type: "POST",
				  processData: true,
				  dataType: "html"
				});
				 
				request_time.done(function(msg) {
				  loadtable($("#month").val(),$("#studio").val());
				});

				request_time.fail(function(jqXHR, textStatus) {
					  alert( "Request failed: " + textStatus + ". Please try again." );
				});
			
		}

		alert( "Changes was done." );
	}
	else
	{
		alert("Please select the timeslot first.");
	}
});

function addClick()
{
	$("#trans-table > div > #booking_timeslot > tbody > tr > td").click(function()
			{	  
					if ($(this).hasClass("available") == true)
				  	{
					  	$(this).removeClass("available");
					  	$(this).addClass("selected");
				  	}
				  	else if ($(this).hasClass("selected") == true)
				  	{
					 	$(this).removeClass("selected");
					 	
					 	if($(this).attr('id').split('_')[0] == "0")
					  		$(this).addClass("available");
					 	else if($(this).attr('id').split('_')[0] == "1")
					 		$(this).addClass("notavailable");
				  	}
				  	else if ($(this).hasClass("notavailable") == true)
				  	{
				  		$(this).removeClass("notavailable");
					  	$(this).addClass("selected");
				  	}

				  	selectedId = "";

				  	$("#trans-table > div > #booking_timeslot > tbody > tr > td").each(function(){
					  	if ($(this).hasClass("selected") == true)
					  	{
						  	if(selectedId == "")
							  	selectedId = $(this)[0].id;
						  	else
						  		selectedId = selectedId + ";" + $(this)[0].id;				  
					  	}			  
					});
	  		});
}

</script>
</html>
