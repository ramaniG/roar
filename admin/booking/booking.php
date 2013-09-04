<?php 
DEFINE('ROOT', '../../');
$current_page = "booking";
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
<script type="text/javascript">
var selectedId = "";
var studio = "0";
</script>

<?php 
if(isset($_GET['studioid']))
{
	$studio = $_GET['studioid'];
	$timeslotId = $_GET['timeslotid'];
}
?>
<style>
.overlay {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: rgba(0, 0, 0, 0.85);
	background:
		url(data:;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABl0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuNUmK/OAAAAATSURBVBhXY2RgYNgHxGAAYuwDAA78AjwwRoQYAAAAAElFTkSuQmCC)
		repeat scroll transparent\9; /* ie fallback png background image */
	z-index: 9999;
	color: white;
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
						<div class="overlay" hidden="true">processing!!</div>


						<div id='msgerr' class='msgerr'></div>

						<label>Select Studio:</label> <select id="studio" name="studio"
							class="box">
							<option value="0">Please select</option>
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
						</select> <label id="lbl_msg" hidden="true">Please click on the
							timeslot above to select it. Each slot is 50 ROAR credit.</label>
						<div id="timetable" class="timetable"></div>
						<input id="timeslotid" type="text" name="timeslotid"
							style="display: none;" />
						<button onclick="processform();" id="submit_button"
							name="submit_button" hidden="true">Next</button>
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
$(document).ready(function (){
		if(getUrlVars().length > 1)
		{
			studio = getUrlVars()["studioid"];
			selectedId = getUrlVars()["timeslotid"];
			updateTable(studio, selectedId);
			addClick();
			$("#submit_button").attr("hidden", false);
		}
		else
			updateTable("0","");
	});

function processform()
{
	$(".overlay").attr("hidden", false);

	var studio = $("select[id='studio']").val();
	var booking_err_msg = "";

	if (studio == "0")
	{
		booking_err_msg = '[Studio] Please select the Studio before proceed.<br/>';
	}

	if (selectedId == "")
	{
		booking_err_msg = booking_err_msg + '[Time Slot] Please select the time slot before proceed.<br/>';
	}

	if (booking_err_msg != "")
	{
		$("#msgerr").html(booking_err_msg);
	}
	else
	{
		window.location.href = "confirmation.php?studioid=" + studio + "&timeslotid=" + selectedId;
	}
	
	$(".overlay").attr("hidden", true);
}

$("select[id='studio']").change(function () 
	{
		$("msgerr").html("");
		 studio = $(this).val();
		 updateTable(studio);
		 if($(this).val() > 0)
		 {
		 	$("#submit_button").attr("hidden", false);
		 	$("#lbl_msg").attr("hidden", false);
		 	if ($(this).val() == 1)
		 		$("#lbl_msg").html("Please click on the timeslot above to select it. Each slot is <?php echo STUDIOAPRICE;?> ROAR credit.");
		 	else
		 		$("#lbl_msg").html("Please click on the timeslot above to select it. Each slot is <?php echo STUDIOBPRICE;?> ROAR credit.");
		 }
		 else
		 {
			 $("#submit_button").attr("hidden", true);
			 $("#lbl_msg").attr("hidden", true);
		 }
	});

function updateTable(id, time)
{
	$(".overlay").attr("hidden", false);
	var request_time = $.ajax({
			  url: "../../functions/timeslottable.php?studioid=" + id + "&timeslotid=" + time,
			  type: "POST",
			  processData: true,
			  dataType: "html"
			});
			 
			request_time.done(function(msg) {
			  $("#timetable").html( msg );
			  addClick();
			  $(".overlay").attr("hidden", true);
			});

			request_time.fail(function(jqXHR, textStatus) {
				$(".overlay").attr("hidden", true);
				  alert( "Request failed: " + textStatus + ". Please try again." );
				});
}

function addClick()
{
	$("td").click(function()
			{
				if(studio != "0")
	  			{		  
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

				  	selectedId = "";

				  	$("#booking_timeslot > tbody > tr > td").each(function(){
					  	if ($(this).hasClass("selected") == true)
					  	{
						  	if(selectedId == "")
							  	selectedId = $(this)[0].id;
						  	else
						  		selectedId = selectedId + ";" + $(this)[0].id;				  
					  	}			  
					});
				}
				else
	  			{
		  			alert("Please select studio before choosing time.")
	  			}
	  		});
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

</script>
</html>