<?php
	DEFINE('ROOT', '../../');	

	require_once(ROOT.'_config.settings.php');
	require_once(ROOT.'sso/session.php');
	
	$id = (!isset($_GET["id"]) ? '' : $_GET["id"]);
	$display_msg = false;
	$data = Array();
	
	if(isset($_POST['submit'])) {

		$db_obj = new Database();
		$db_obj->query("SET NAMES utf8");
		
		$name = $db_obj->sqlSafe($_POST['name']);
		$email = $db_obj->sqlSafe($_POST['email']);
		$status = $db_obj->sqlSafe($_POST['status']);
		$id = $db_obj->sqlSafe($_POST['id']);
		
		$sql = "UPDATE admin SET 
			username = '{$name}',
			email = '{$email}',
			status = '{$status}',
			dateupdated = NOW()
			WHERE ID = '{$id}'";

		$db_obj->query($sql) or die(mysql_error());
		$db_obj->close();
		
		$display_msg = true;
	} else {
		if(!empty($id)) {
	
			$db = new Database();
			$id = $db->sqlSafe($id);
			$sql = "select username, email, status from admin WHERE id = '{$id}'";
			
			$result = $db->query($sql);
			
			while ($row = mysql_fetch_row($result)) {
				$data['name'] = $row[0];
				$data['email'] = $row[1];
				$data['status'] = $row[2];
			}
			
			$db->close();
		}
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
				<form method="post" action="update_user.php">
					<label>Name</label><input name="name" id="name" type="text" value="<?php echo $data['name']; ?>" />
					<label>Email:</label><input name="email" id="email" type="text" value="<?php echo $data['email']; ?>" />
					<label>STATUS:</label><select id="status" name="status">
						<option value="1" <?php if($data['status'] == 1) echo "selected='selected'" ?>>ACTIVATE</option>
						<option value="0" <?php if($data['status'] == 0) echo "selected='selected'" ?>>NOT ACTIVE</option>
						</select>
					<label>&nbsp;</label><input id="submit" type="submit" name="submit" value="Submit" />
					<input id="id" type="hidden" name="id" value="<?php echo $id; ?>" /> 
					<div class="clear"></div>
				</form>
			</fieldset>
		<?php } else { ?>
			 	<p><?php echo "Update User successfully"; ?></p>
		<?php } ?>
	</body>
</html>