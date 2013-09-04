<?php 
DEFINE('ROOT', '../');
include(ROOT.'_config.settings.php');

$errors = '';

if(isset($_POST['submit'])) {
	
		$db = new Database();
		$email = $db->sqlSafe(safe_input($_POST['email']));
				
		$sql2 = "SELECT email, username, password FROM admin WHERE (email = '{$email}')";
		
		$result2 = $db->query($sql2);
		$row2 = $db->fetchArray($result2);
    	$em = $row2[0];
		$un = $row2[1];
		$pw = $row2[2];
		$un2 = var_export($un, true);
		$pw2 = var_export($pw, true);
		//echo $pw2;
		
		$db->close();
		
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		
		if ($email == NULL || $email == "")
		{$errors .= "<span class=\"err\">Enter your email!\n<span/>";}	
		else if (!preg_match($regex, $email)) 
		{$errors .= "<span class=\"err\">Email is not in correct format!\n<span/>";}				
		else if (empty($em))
		{$errors .= "<span class=\"err\">Sorry, we’ve no record of this email!\n<span/>";}
		else {
		$subject="Roar.com.my - Password Request"; 
		$header="From: kevin_cca84@hotmail.com"; 
		$content="Your username is ".$un2." and password is ".$pw2; 
		mail($email, $subject, $content, $header); 
		$errors .= "<span style='color:green;' class=\"err\">Your password have been sent to your email!\n<span/>";}
			
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
						<form class="form-signin" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">						
							<img src="../images/graphics/login.png" /><h1>Forgot your password?</h1>
						<p>It happens to all of us. Just enter your email below and we’ll send your password there.</p>
						<div class="orange"></div><div class="grey"></div>
						<input id="email" name="email" type="text" placeholder="Email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"><br>
						<?php
						if(!empty($errors))
						{ echo "<div class='err' style='clear:both'>".nl2br($errors)."</div>"; }
						?>						
						<button name="submit" id="submit" type="submit" style="margin:10px 0 ">Submit</button>
					</form>
                    
				</div>   
			</div>
			<div style="clear:both"><br/></div>
			<div class="end"></div>
		</div>
		<div class="bottom"></div>
	</div>
	</div>
	<?php include_once ROOT.'usercontrol/footer.php';?>
</body>
</html>