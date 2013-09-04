<?php
	DEFINE('ROOT', '../../');	

	require_once(ROOT.'_config.settings.php');
	require_once(ROOT.'sso/session.php');
	
	$display_msg = false;
	
	if(isset($_POST['submit'])) {

		$db_obj = new Database();
		$db_obj->query("SET NAMES utf8");
		
		$name = $db_obj->sqlSafe($_POST['name']);
		$password = $db_obj->sqlSafe($_POST['password']);
		$email = $db_obj->sqlSafe($_POST['email']);
		$status = $db_obj->sqlSafe($_POST['status']);
		
		$sql = "INSERT INTO admin (username, password, email, dateinserted, dateupdated, status) VALUES
			('$name', '$password', '$email', NOW(), NOW(), $status)";

		$db_obj->query($sql) or die(mysql_error());
		$db_obj->close();
		
		$display_msg = true;
	}
?>
<!DOCTYPE>
<html>
	<head>
		<title>ROAR: Admin</title>
	</head>
	<body>
		<?php if (!$display_msg) {?>
			<fieldset>
				<h1>EDIT USER</h1>
				<form method="post" action="add_user.php">
					<label>User Name (login) :</label><input name="name" id="name" type="text" />
					<label>Email:</label><input name="email" id="email" type="text" />
					<label>Password:</label><input name="password" id="password" type="text" />
					<label>STATUS:</label><select id="status" name="status">
											<option value="1">ACTIVATE</option>
											<option value="0">NOT ACTIVE</option>
											</select>
					<label>&nbsp;</label><input id="submit" type="submit" name="submit" value="Submit" />
					<div class="clear"></div>
				</form>
			</fieldset>
		<?php } else { ?>
			 	<p><?php echo "Admin added successfully"; ?></p>
		<?php } ?>
	</body>
</html>