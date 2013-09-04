<?PHP
	include('../_config.settings.php');

	session_start();
	session_unset();
	header('Location: '.BASE.'/login.php');
?>