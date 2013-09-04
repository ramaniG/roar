<?php 
DEFINE('ROOT', '../');
$current_page = "change-pwd";
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');
$memberid = safe_input(member_session());
$errors = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Roar: Member Change Password</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
<?php include_once 'member-header.php';

$name = '';
$db = new Database();
$db->query("SET NAMES utf8");

$sql = "SELECT name, password FROM member WHERE id = '{$memberid}' LIMIT 0, 1";
$result = $db->query($sql);
$row = '';
while ($row = mysql_fetch_row($result)) {
	$name =  $row[0];
	$password =  $row[1];
}

$display_msg = false;
$passwod_match = true;

if(isset($_POST['submit'])) {
	$oldpassword = $_POST['oldpassword'];
	$newpassword = $_POST['newpassword'];
	$confirmpassword = $_POST['confirmpassword'];
	$id = $_POST['memberid'];

	if ($oldpassword == $password)
	{
		if($newpassword == $confirmpassword)
		{
			$confirmpassword = $db->sqlSafe($confirmpassword);
			$id = $db->sqlSafe($memberid);

			$sql = "UPDATE member SET
			password = '{$confirmpassword}',
			dateupdated = NOW()
			WHERE id = '{$memberid}'";

			$db->query($sql) or die(mysql_error());

			$display_msg = true;
		}
		else
		{
		$errors .= "<span class=\"err\">New password and confirm new password does not match!\n<span/>";
		}
	}
	else
	{
		$errors .= "<span class=\"err\">Wrong old password! Please try again!\n<span/>";
	}
}

?>

<script type="text/javascript">
			$(document).ready(function(){
				$('#submit').click(function() {
					var oldpassword = escape($('#oldpassword').val());
					var newpassword = escape($('#newpassword').val()),
					cpassword = escape($('#confirmpassword').val());
					var minNumberofChars = 6;
					var maxNumberofChars = 16;
					var regularExpression = /[a-zA-Z0-9!@#$%^&*]/;
	
					//Validation Input
					if(oldpassword == ''|| oldpassword == null) {
						alert('Old password must be filled out!');
						return false;
					}					
					if(newpassword == ''|| newpassword == null) {
						alert('New password must be filled out!');
						return false;
					}
					if((newpassword.length < minNumberofChars) || (newpassword.length > maxNumberofChars)){
						alert("New password must be more than 6 characters and smaller than 16 characters");
						return false;
					}
					if(!regularExpression.test(newpassword)) {
						alert("New password should be either number string or known characters only");
						return false;
					}
					if(cpassword == '' || cpassword == null) {
						alert('Confirm new password must be filled out!');
						return false;
					}
				});
			});
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

.head1 {
	padding: 0;
	margin-bottom: 20px;
	font-family: 'Raleway', sans-serif;
	color: #e79703 !important;
	font-size: 30px;
	font-weight: bold;
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
						<?php if (!$display_msg) {?>
						<fieldset style="height: 250px;">
							<h1 class="head1">
								RESET PASSWORD: (
								<?php echo $name; ?>
								)
							</h1>
							<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
								<label>Old Password:</label><input class="box"
									name="oldpassword" id="oldpassword" type="password" value="<?php echo isset($_POST['oldpassword']) ? $_POST['oldpassword'] : '' ?>" /><br>
								<label>New Password:</label><input class="box"
									name="newpassword" id="newpassword" type="password" value="" /><br>
								<label>Confirm Password:</label><input class="box"
									name="confirmpassword" id="confirmpassword" type="password"
									value="" /><br> 
									<?php
						if(!empty($errors))
						{ echo "<div class='err' style='clear:both'>".nl2br($errors)."</div>"; }
						?>						
									<input id="submit" type="submit" name="submit"
									value="Change Password" class="submit" /> <input id="memberid"
									type="hidden" name="memberid" value="<?php echo $memberid; ?>" />
								<div class="clear"></div>
							</form>
						</fieldset>
						<?php } else { ?>
						<p>
							<?php echo UPDATECHANGEPASSWORDMSG; ?>
							<?php echo "<p>You may login to your account using <a href='".BASE."/login.php'>THIS</a> link</p>"; ?>
						</p>
						<?php } ?>
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
