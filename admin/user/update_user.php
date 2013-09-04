<?php
	DEFINE('ROOT', '../../');	

	require_once(ROOT.'_config.settings.php');
	require_once(ROOT.'sso/session.php');
	require_once(ROOT.'email/user_activated.php');
	require_once(ROOT.'email/user_blacklist.php');
	
	$id = (!isset($_GET["id"]) ? '' : $_GET["id"]);
	$display_msg = false;
	$data = Array();
	
	if(!empty($id)) {
	
		$db = new Database();
		$id = $db->sqlSafe($id);
		$sql = "select name, email, bandname, contact, status from member WHERE id = '{$id}'";
			
		$result = $db->query($sql);
			
		while ($row = mysql_fetch_row($result)) {
			$data['name'] = $row[0];
			$data['email'] = $row[1];
			$data['bandname'] = $row[2];
			$data['contact'] = $row[3];
			$data['status'] = $row[4];
		}
			
		$db->close();
	}
	
	if(isset($_POST['submit'])) {

		$db_obj = new Database();
		$db_obj->query("SET NAMES utf8");
		
		$bandname = $db_obj->sqlSafe($_POST['bandname']);
		$contact = $db_obj->sqlSafe($_POST['contact']);
		$status = $db_obj->sqlSafe($_POST['status']);
		$id = $db_obj->sqlSafe($_POST['id']);
		
		$sql = "UPDATE member SET 
			bandname = '{$bandname}',
			contact = '{$contact}',
			status = '{$status}',
			dateupdated = NOW()
			WHERE ID = '{$id}'";

		$db_obj->query($sql) or die(mysql_error());
		$db_obj->close();
		
		if ($data['status'] == MemberAccount::ACTIVATE && $status == MemberAccount::BLACKLIST)
		{
			user_activated($data['name'], $data['email']);
		}
		elseif ($data['status'] == MemberAccount::BLACKLIST && $status == MemberAccount::ACTIVATE)
		{
			user_blacklist($data['name'], $data['email']);
		}
		
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
				<form method="post" action="update_user.php?id=<?php echo $id; ?>">
					<label>Name</label><input name="name" id="name" type="text" value="<?php echo $data['name']; ?>" disabled="disabled"/>
					<label>Email:</label><input name="email" id="email" type="text" value="<?php echo $data['email']; ?>" disabled="disabled" />
					<label>Band Name:</label><input name="bandname" id="bandname" type="text" value="<?php echo $data['bandname']; ?>" />
					<label>CONTACT:</label><input name="contact" id="contact" type="text" value="<?php echo $data['contact']; ?>" />
					<label>STATUS:</label><select id="status" name="status">
											<option value="<?php echo MemberAccount::ACTIVATE; ?>" <?php if($data['status'] == MemberAccount::ACTIVATE) echo 'selected'; ?>>ACTIVATED</option>
											<option value="<?php echo MemberAccount::BLACKLIST; ?>" <?php if($data['status'] == MemberAccount::BLACKLIST) echo 'selected'; ?>>BLACKLIST</option>
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