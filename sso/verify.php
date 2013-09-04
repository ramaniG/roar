<?php
	DEFINE('ROOT','../');
	
	require_once(ROOT.'/_config.settings.php');

	if(isset($_POST['submit'])) {
	
		$db = new Database();
		$email = $db->sqlSafe(safe_input($_POST['email']));
		$password = $db->sqlSafe(safe_input($_POST['password']));
		
		$sql = "SELECT id FROM member WHERE (email = '{$email}') 
				and (password = '{$password}') and (status = '".MemberAccount::ACTIVATE."')";
		
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
    	$id = $row[0];
		
		$db->close();
		
		if(!empty($id)) {
			session_start();
			$_SESSION['roar_member'] = $id;
			header('Location: ../member/index.php');
		}
		else {
			header('Location: ../login_fail.php');
		}
		
	}
	else {
		header('Location: ../login.php?error=fail');
	}
?>