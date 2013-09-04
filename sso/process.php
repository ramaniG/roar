<?php
	DEFINE('ROOT','../');
	include(ROOT.'_config.settings.php');
	
	session_start();
	
	$error = '';
	
	//write your validation rule here
	
	$letterscode = safe_input($_POST['6_letters_code']);
	
	if($_SESSION['6_letters_code'] == $letterscode)
		{
		//Do your coding here.
	  	$db = new Database();

		$password = $db->sqlSafe($_POST["password"]);
		$name = $db->sqlSafe($_POST["name"]);
		$email = $db->sqlSafe($_POST["email"]);
		$contact = $db->sqlSafe($_POST["contact"]);
		$bandname = $db->sqlSafe($_POST["bandname"]);
		
		if(!empty($password) && !empty($name) && !empty($email) && !empty($contact) && !empty($bandname)) {
			
			$sql = "SELECT id FROM member WHERE (email = '{$email}') 
					and (password = '{$password}') and (status = '1')";
			
			$result = $db->query($sql);
			$row = $db->fetchArray($result);
	    	$id = $row[0];
			
	    	if(!empty($id)) {
	    		header("LOCATION: ../register.php?error=email");
	    	}
	    	else {
				$sql="INSERT INTO member (name, password, email, contact, bandname,status, dateinserted)
				VALUES ('$name', '$password', '$email', '$contact','$bandname', '".MemberAccount::ACTIVATE."', now());";
					
				$db->query($sql);
				
				$id = mysql_insert_id();
				$sql = "INSERT INTO roarcredit (memberid, amount, dateupdated) VALUES ($id, 0, now())";
				$db->query($sql);
	    	}
	    	
			$db->close();
			$db = null;
			
			/*
			 * Send notification Email to the user for successful registration
			 * */
			
			header("LOCATION: ../register_success.php");
		}
		else
		{
			header("LOCATION: ../register.php?error=validation");
		}
	} else {
	
	?>

<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once '../usercontrol/top-scripts.php';?>
<script type="text/javascript" src="<?php echo _JQUERY; ?>"></script>
<script type="text/javascript" src="<?php echo _JQUERYVALIDATION; ?>"></script>
<script type="text/javascript" src="<?php echo _COREJS; ?>"></script>

</head>

<body>
	<?php include_once '../usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once '../usercontrol/nav-main_2.php';?>
		<div id="banner-studio"></div>            
	<div id="content">
		<div class="top"></div>
		<div class="middle">
			<div class="left">
				<a href="http://roar.com.my" class="logo"><img src="../images/logo/roar_music_logo.png" alt="roar_music_logo"/></a>             
			</div>
			<div class="right">
            
            <div class="register">
	<section class="row-fluid registerform">
			<img src="../images/graphics/login.png"/><h1>Wrong Captcha</h1>	
            <div class="orange"></div><div class="grey"></div>
			
                    Please click <a href="../register.php" font color="white">here</a> redo registration</p>
			</section>
        </div>   
			<div style="clear:both"><br/></div>
			<div class="end2"></div>
		</div>
		<div class="bottom"></div>
	</div>
	</div>
	</div>
	<?php include_once '../usercontrol/footer.php';?>
</body>
<script type='text/javascript'>
	function refreshCaptcha()
	{
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
</script>
</html>
<?php
	}
?>