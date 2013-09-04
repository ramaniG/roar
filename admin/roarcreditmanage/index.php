<?php 
DEFINE('ROOT', '../../');
$current_page = "roarcreditmanage";
require_once(ROOT.'sso/session.php');
require_once(ROOT.'_config.settings.php');

$adminid = safe_input(admin_session());
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Roar: Member</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
<?php include_once '../admin-header.php';?>
<script type="text/javascript" src="<?php echo _FANCYBOX_JS; ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo _FANCYBOX_CSS; ?>" media="screen" />
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
											<td><h2>ROAR CREDIT AMOUNT MANAGEMENT</h2></td>
										</tr>
										<tr>
											<td><label>User Name : </label> <input id="trans-username"
												type="text" /> <button type="button" id="search">Search</button>
											</td>
										</tr>

										<tr>
											<td>
												<div id="trans-table"></div>
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

$("#search").click(function (){
	loadtable($("#trans-username").val());
});

function loadtable(username)
{
	var request_time = $.ajax({
		  url: "loadroartrans.php?username=" + username,
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

function editamount(userid)
{
	updated = false;
	$.fancybox.open({
		href : 'editamount.php?userid=' + userid + '&adminid=' + adminid + '&adminname=<?php echo $name; ?>',
		type : 'iframe',
		padding : 5,
		width: 650,
		length: 450,
		afterClose: function () {
			if(updated)
            	parent.location.reload(true);
        }
	});
}

</script>
</html>