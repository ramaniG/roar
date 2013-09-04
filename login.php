<?php include('_config.settings.php');
DEFINE('ROOT', '');

$errors = '';
$errors1 = '';

if(isset($_POST['submit'])) {
		session_start();
		$db = new Database();
		$email = $db->sqlSafe(safe_input($_POST['email']));
		$password = $db->sqlSafe(safe_input($_POST['password']));
		
		$sql = "SELECT id FROM member WHERE (email = '{$email}') 
				and (password = '{$password}') and (status = '".MemberAccount::ACTIVATE."')";
		
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
    	$id = $row[0];
		
		$sql2 = "SELECT email, password FROM member WHERE (email = '{$email}')";
		
		$result2 = $db->query($sql2);
		$row2 = $db->fetchArray($result2);
    	$em = $row2[0];
		$pw = $row2[1];
		
		$db->close();
		
		if(!empty($id)) {
			session_start();
			$_SESSION['roar_member'] = $id;
			$_SESSION['timeout'] = time();
			header('Location: '.BASE.'/member/index.php');
		}
		else {
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		
		if (($email == NULL || $email == "") && ($password == NULL || $password == ""))
		{$errors1 .= "<span class=\"err\">Enter your email!\n<span/>";}	
		else if ($email == NULL || $email == "")
		{$errors .= "<span class=\"err\">Enter your email!\n<span/>";}
		else if (!preg_match($regex, $email)) 
		{$errors1 .= "<span class=\"err\">Email is not in correct format!\n<span/>";}			
		else if ($password == NULL || $password == "")
		{$errors .= "<span class=\"err\">Enter your password!\n<span/>";}			
		else if (empty($em))
		{$errors .= "<span class=\"err\">The username and password you entered is incorrrect!\n<span/>";}
		else if ($pw != $password)
		{$errors .= "<span class=\"err\">The username and password you entered is incorrrect!\n<span/>";}
		}
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';?>
</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main.php';?>
		<div id="banner-studio"></div>            
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>             
			</div>
			<div class="right">
				<div class="login">
				   <form class="form-signin" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">				   
						<img src="images/graphics/login.png"/><h1>Login</h1>
						<div class="orange"></div><div class="grey"></div>
						<input id="email" name="email" type="text" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"><br>
						<?php
						if(!empty($errors1))
						{ echo "<div class='err' style='clear:both'>".nl2br($errors1)."</div>"; }
						?>
						<input id="password" name="password" type="password" placeholder="Password"><br>
						<?php
						if(!empty($errors))
						{ echo "<div class='err' style='clear:both'>".nl2br($errors)."</div>"; }
						?>		
						<a href="forgetpassword.php" tabindex = "-1" style="margin:10px 70px "><u>Forgot Password?</u></a><br>
						<button name="submit" id="submit" type="submit" style="margin:10px 70px ">Sign in</button>
					</form>
                    
                    <p>Not a member yet?<br>
                    Please click <a href="register.php" font color="white">here</a>  to become a member</p>
                    
				</div>   
			</div>
			<div style="clear:both"><br/></div>
			<div class="end"></div>
		</div>
		<div class="bottom"></div>
	</div>
	</div>
	<?php include_once 'usercontrol/footer.php';?>
</body>
<script>
	<!-- highlight -->
	setPage();
</script>
</html>