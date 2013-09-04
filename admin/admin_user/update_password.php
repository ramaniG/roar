<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php
	DEFINE('ROOT', '../../');	

	require_once(ROOT.'_config.settings.php');
	require_once(ROOT.'sso/session.php');
	$errors = '';
	
	$id = (!isset($_GET["id"]) ? '' : $_GET["id"]);
	
	$name = ''; 
	$db = new Database();
	$db->query("SET NAMES utf8");
	
	$sql = "SELECT username FROM admin WHERE id = '{$id}' LIMIT 0, 1";
	$result = $db->query($sql);
	$row = '';
	while ($row = mysql_fetch_row($result)) {
		$name =  $row[0];
	}
	
	$display_msg = false;
	
	if(isset($_POST['submit'])) {
		$newpassword = $_POST['newpassword'];
		$confirmpassword = $_POST['confirmpassword'];
		$regex = '/[a-zA-Z0-9!@#$%^&*]/';
		$id = $_POST['id'];
		
		if($newpassword == "" || $newpassword == NULL) {
		$errors .= "<span class=\"err\">Please enter new password!\n<span/>";
		}
		else if (strlen($newpassword) < 6 || strlen($newpassword) > 16){
		$errors .= "<span class=\"err\">Password must be more than 6 characters and smaller than 16 characters!\n<span/>";
		}
		else if (!preg_match($regex, $newpassword)) {
		$errors .= "<span class=\"err\">Password should be either number string or known characters only!\n<span/>";
		}
		else if ($confirmpassword == "" || $confirmpassword == NULL){
		$errors .= "<span class=\"err\">Please re-enter a confirmed password!\n<span/>";
		}
		else if ($newpassword != $confirmpassword){
		$errors .= "<span class=\"err\">New password and confirmed password does not match!\n<span/>";
		}
		else if ($newpassword != $confirmpassword){
		$errors .= "<span class=\"err\">New password and confirmed password does not match!\n<span/>";
		}
		else {

			$confirmpassword = $db->sqlSafe($confirmpassword);   
			$id = $db->sqlSafe($id);  
			
			$sql = "UPDATE admin SET 
				password = '{$confirmpassword}',
				dateupdated = NOW()
				WHERE id = '{$id}'";
	
			$db->query($sql) or die(mysql_error());

			$display_msg = true;
		}
	}
?>
<!DOCTYPE>
<html>
	<head>
		<title>Roar: Member Change Password</title>
		
	</head>
	<body>
		<?php if (!$display_msg) {?>
			<fieldset>
				<h1>RESET PASSWORD: (<?php echo $name; ?>)</h1>
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>New Password:</label><input name="newpassword" id="newpassword" type="password" value="" />
					<label>Confirm Password:</label><input name="confirmpassword" id="confirmpassword" type="password" value="" />								
					<label>&nbsp;</label><input id="submit" type="submit" name="submit" value="Submit" />
					<input id="id" type="hidden" name="id" value="<?php echo $id; ?>" /> 
					<?php
						if(!empty($errors))
						{ echo "<div class='err' style='clear:both; color:red;'>".nl2br($errors)."</div>"; }
						?>		
					<div class="clear"></div>
				</form>
			</fieldset>
		<?php } else { ?>
			 	<p><?php echo "Password changed successfully"; ?></p>
		<?php } ?>
	</body>
<?php 
	$db->close();
	$db = null;
?>
</html>