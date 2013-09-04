<?php 
DEFINE('ROOT', '../');
$current_page = "home-page";
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
<?php include_once 'member-header.php';?>
<style>
.table1 {
	margin: 0px;
	padding: 0px;
	width: 100%;
	border: 1px solid #000000;
	-moz-border-radius-bottomleft: 0px;
	-webkit-border-bottom-left-radius: 0px;
	border-bottom-left-radius: 0px;
	-moz-border-radius-bottomright: 0px;
	-webkit-border-bottom-right-radius: 0px;
	border-bottom-right-radius: 0px;
	-moz-border-radius-topright: 0px;
	-webkit-border-top-right-radius: 0px;
	border-top-right-radius: 0px;
	-moz-border-radius-topleft: 0px;
	-webkit-border-top-left-radius: 0px;
	border-top-left-radius: 0px;
	font-size: 14px;
	font-family: Arial;
	font-weight: bold;
	color: #ffffff;
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
					<?php include_once 'member_menu.php';?>
				</div>
				<div class="right">
					<div class="wrapper">
						<table>
							<tr>
								<td><h2 align="center" class="head1">BOOKING HISTORY</h2></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									<div class="list">
										
									</div>
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
var curpage = 1;
$(document).ready(function (){
	loadtrans(curpage);
});

function loadtrans(currentpage)
{
	var request_time = $.ajax({
			  url: "bookingrecords.php?page=" + currentpage,
			  type: "POST",
			  processData: true,
			  dataType: "html"
			});
			 
			request_time.done(function(msg) {
			  $(".list").html( msg );
			});

			request_time.fail(function(jqXHR, textStatus) {
				  alert( "Request failed: " + textStatus + ". Please try again." );
				});
}
</script>
</html>
