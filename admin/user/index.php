<?php 
DEFINE('ROOT', '../../');
$current_page = "usermanagement";
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
<link rel="stylesheet" type="text/css" href="<?php echo _MEMBERCSS; ?>" media="screen" />
<style>
.table1 {
	margin: 0px;
	padding: 0px;
	background-color: rgb(81, 88, 87);;
	border: 1px solid #000000;
	font-size: 14px;
	font-family: Arial;
	font-weight: bold;
}

.head1 {
	padding: 0;
	margin-bottom: 20px;
	font-family: 'Raleway', sans-serif;
	color: #e79703 !important;
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
							<div class="header"></div>
							<div class="body">

								<div class="right-col">
									<table>
										<tr>
											<td><h1 class="head1">USER MANAGEMENT</h1></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<div class="list">
													<?php
													$db = new Database();
													$sql = "SELECT id, name, email, bandname, contact, status, dateinserted FROM member ORDER BY dateinserted DESC";
													$result = $db->query($sql);
													if($db->numRows($result) > 0) {
					?>
													<table width="700px" class="table1">
														<tr>
															<th width="100">Name</th>
															<th width="100">EMAIL</th>
															<th width="70">BAND NAME</th>
															<th width="70">CONTACT</th>
															<th width="70">STATUS</th>
															<th width="60">DATE INSERTED</th>
															<th width="60"></th>
															<th width="60"></th>
														</tr>
														<?php 
														$i = 0;
														while ($row = mysql_fetch_row($result)) {
								echo "<tr>".
									 "<td>{$row[1]}</td>".
									 "<td>{$row[2]}</td>".
									 "<td>{$row[3]}</td>".
									 "<td>{$row[4]}</td>".
									 "<td>{$row[5]}</td>".
									 "<td>{$row[6]}</td>".
									 "<td><a id='chg-password{$i}'>change password</a></td>".
									 "<td><a id='edit-status{$i}' href='javascript:;'>edit</a></td>".
									 "</tr>";

								echo "<script type='text/javascript'>
								$('#chg-password{$i}').click(function() {
								$.fancybox.open({
								href : 'update_password.php?id={$row[0]}',
								type : 'iframe',
								padding : 5,
								width: 650,
								afterClose: function () {
								parent.location.reload(true);
									            }
											});
										});
										$('#edit-status{$i}').click(function() {
										$.fancybox.open({
										href : 'update_user.php?id={$row[0]}',
										type : 'iframe',
										padding : 5,
										width: 650,
										afterClose: function () {
										parent.location.reload(true);
									            }
											});
										});
										</script>";
								$i++;
							}
							?>
														<tr></tr>
													</table>
													<?php
													//echo $db->createPagination('Investor',$limit,$page);
													$db->close();
													$db = null;
						}
						else {
							echo '<p style="color:#ff0000; font-weight:700;">No Transactions</p>';
						}
						?>
												</div>
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
</html>
