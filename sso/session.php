<?php
function admin_session() {
	session_start();
	if (empty($_SESSION["roar_admin"]))
	{
		header('Location: '.ROOT.'admin/logout.php');
	}
	elseif (($_SESSION['timeout']  + 20 * 60) < time())
	{
		header('Location: '.ROOT.'admin/logout.php');
	}
	else
	{
		return $_SESSION["roar_admin"];
		$_SESSION['timeout'] = time();
	}
}
function member_session() {
	session_start();
	if (empty($_SESSION["roar_member"]))
	{
		header('Location: '.ROOT.'member/logout.php');
	}
	elseif (($_SESSION['timeout']  + 20 * 60) < time())
	{
		header('Location: '.ROOT.'member/logout.php');
	}
	else
	{
		return $_SESSION["roar_member"];
		$_SESSION['timeout'] = time();
	}
}
?>