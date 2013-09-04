<?php 
DEFINE('ROOT', '../');
include(ROOT.'_config.settings.php');

$errors = '';
$errors1 = '';

if(isset($_POST['submit'])) {
	session_start();

	$db = new Database();
	$username = $db->sqlSafe(safe_input($_POST['username']));
	$password = $db->sqlSafe(safe_input($_POST['password']));

	$sql = "SELECT id FROM admin WHERE password = '{$password}' AND username = '{$username}'";

	$result = $db->query($sql);
	$row = $db->fetchArray($result);
	$id = $row[0];
	
	$sql2 = "SELECT username, password FROM admin WHERE (username = '{$username}')";
		
		$result2 = $db->query($sql2);
		$row2 = $db->fetchArray($result2);
    	$em = $row2[0];
		$pw = $row2[1];

	if(!empty($id)) {
		$_SESSION['roar_admin'] = $id;
		$_SESSION['timeout'] = time();
		header('Location: '.BASE.'/admin/index.php');
	}
	else {
		if (($username == NULL || $username == "") && ($password == NULL || $password == ""))
		{$errors1 .= "<span class=\"err\">Enter your username!\n<span/>";}	
		else if ($username == NULL || $username == "")
		{$errors1 .= "<span class=\"err\">Enter your username!\n<span/>";}			
		else if ($password == NULL || $password == "")
		{$errors .= "<span class=\"err\">Enter your password!\n<span/>";}
		else if (empty($em))
		{$errors .= "<span class=\"err\">The username and password you entered is incorrrect!\n<span/>";}
		else if ($pw != $password)
		{$errors .= "<span class=\"err\">The username and password you entered is incorrrect!\n<span/>";}
	}

	$db->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Roar: Admin</title>
<?php include_once ROOT.'usercontrol/top-scripts.php';?>
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
						src="<?php echo ROOT; ?>images/logo/roar_music_logo.png" alt="roar_music_logo">
					</a>
				</div>
				<div class="right">
					<div class="login">
						<form class="form-signin" method="POST" action="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">						
							<img src="../images/graphics/login.png" />							
							<h1>Admin Login</h1>
							<div class="orange"></div>
							<div class="grey"></div>
							<input id="username" name="username" placeholder="Username" type="text" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"><br> 
							<?php
						if(!empty($errors1))
						{ echo "<div class='err' style='clear:both'>".nl2br($errors1)."</div>"; }
						?>
							<input id="password" name="password" type="password" placeholder="Password"><br>
							<?php
							if(!empty($errors))
							{ echo "<div class='err' style='clear:both'>".nl2br($errors)."</div>"; }
							?>
							<a href="adminforgetpassword.php" font color="white"><u>Forgot Password?</u></a><br>
							<button name="submit" id="submit" type="submit">Sign in</button>
						</form>
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
