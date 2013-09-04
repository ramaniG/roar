<?php 
DEFINE('ROOT', '');
include('_config.settings.php');
include('email/user_registration.php');

session_start();

$errorsemail = '';
$errorsname = '';
$errorspass = '';
$errorsrepass = '';
$errorscont = '';
$errorscap = '';
$errors = '';

if(isset($_POST['submit']))
{

$db = new Database();

		$password = $db->sqlSafe($_POST["password"]);
		$reenterpassword = $db->sqlSafe($_POST["reenterpassword"]);
		$name = $db->sqlSafe($_POST["name"]);
		$email = $db->sqlSafe($_POST["email"]);
		$contact = $db->sqlSafe($_POST["contact"]);
		$bandname = $db->sqlSafe($_POST["bandname"]);
		$captcha = $db->sqlSafe($_POST["6_letters_code"]);
		
		$sql = "SELECT email FROM member WHERE email='$email'";
		$result = $db->query($sql);
		$check_num_rows = mysql_num_rows($result);
		
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		$passregex = '/^[a-zA-Z0-9!@#$%^&*]*$/';
		$checkno = '/^[0-9\+\-]*$/';
		
	if ($email == NULL || $email == "")
	{$errorsemail .= "<span class=\"err\">Enter your email!\n<span/>";}
	else if (!preg_match($regex, $email)) 
	{$errorsemail .= "<span class=\"err\">Email is not in correct format!\n<span/>";}
	else if ($check_num_rows!=0)
	{$errorsemail .= "<span class=\"err\">Email already registered!\n<span/>";}
	else if ($name == NULL || $name == "")
	{$errorsname .= "<span class=\"err\">Enter your name!\n<span/>";}
	else if (strlen($name) < 3)
	{$errorsname .= "<span class=\"err\">Name must be 3 or more characters!\n<span/>";}	
	else if ($password == NULL || $password == "")
	{$errorspass .= "<span class=\"err\">Enter your password!\n<span/>";}
	else if (strlen($password) < 6 || strlen($password) > 16)
	{$errorspass .= "<span class=\"err\">Password must be between 6 to 16 characters!\n<span/>";}
	else if (!preg_match($passregex, $password))
	{$errorspass .= "<span class=\"err\">Password should be either number string or known characters only!\n<span/>";}
	else if ($reenterpassword == NULL || $reenterpassword == "")
	{$errorsrepass .= "<span class=\"err\">Re-enter your password!\n<span/>";}
	else if ($password != $reenterpassword)
	{$errorsrepass .= "<span class=\"err\">Password does not match!\n<span/>";}
	else if ($contact == NULL || $contact == "")
	{$errorscont .= "<span class=\"err\">Enter contact number!\n<span/>";}	
	else if (!preg_match($checkno, $contact))
	{$errorscont .= "<span class=\"err\">No characters are allowed except + and - !\n<span/>";}
	else if ($captcha == NULL || $captcha == "")
	{$errorscap .= "<span class=\"err\">Enter Captcha!\n<span/>";}	
	
	if(empty($_SESSION['6_letters_code'] ) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	$errors .= "<span class=\"err\">The captcha code does not match!<span/>";
	}
	
	$db->close();
	$db = null;

	if(empty($errors))
	{
		$db = new Database();
		
		if(!empty($password) && !empty($name) && !empty($email) && !empty($contact)) {

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
				VALUES ('$name', '$password', '$email', '$contact','$bandname', '".MemberAccount::ACTIVATE."', now())";
					
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
			user_registration($name, $email);
			header("LOCATION: register_success.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>ROAR!!! MUSIC</title>
<?php include_once 'usercontrol/top-scripts.php';?>
<script type="text/javascript" src="<?php echo _JQUERYVALIDATION; ?>"></script>
<script type="text/javascript" src="<?php echo _COREJS; ?>"></script>

</head>

<body>
	<?php include_once 'usercontrol/fb-loader.php';?>
	<div id="wrapper">
		<?php include_once 'usercontrol/nav-main_2.php';?>
		<div id="banner-studio"></div>
		<div id="content">
			<div class="top"></div>
			<div class="middle">
				<div class="left">
					<a href="http://roar.com.my" class="logo"><img
						src="images/logo/roar_music_logo.png" alt="roar_music_logo" /> </a>
				</div>
				<div class="right">
					<div class="register">
						<section class="row-fluid registerform">
							<img src="images/graphics/login.png" />
							<h1>Register</h1>
							<div class="orange"></div>
							<div class="grey"></div>
							<div style="clear: both"></div>
							<form id="register-form" name="regForm" class="form-horizontal"
								action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
								method="post" onSubmit="return validateForm()">
								<table style="border: none; margin-top: 10px">
									<tr>
										<td style="width: 180px"><label class="control-label"
											for="email"></label>
											<div id="feedback"></div></td>
										<td><input type="text" id="email" class="required email"
											name="email" placeholder="Email" autocomplete="off"
											style="width: 222px;"
											value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
											<?php
											if(!empty($errorsemail)){
											echo "<div class='err' style='clear:both'>".nl2br($errorsemail)."</div>";
											} ?>
										</td>
									</tr>
									<tr>
										<td><label class="control-label" for="name">Name</label></td>
										<td><input type="text" class="required" id="name" name="name"
											placeholder="Name" autocomplete="off" style="width: 222px;"
											value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
											<?php
											if(!empty($errorsname)){
											echo "<div class='err' style='clear:both'>".nl2br($errorsname)."</div>";
											} ?>
										</td>
									</tr>
									<tr>
										<td><label class="control-label">Password</label></td>
										<td><input type="password" class="required" id="password"
											name="password" placeholder="Password" style="width: 222px;"
											value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
											<?php
											if(!empty($errorspass)){
											echo "<div class='err' style='clear:both'>".nl2br($errorspass)."</div>";
											} ?>
										</td>
									</tr>
									<tr>
										<td><label class="control-label" for="reenterpassword">Re-Enter
												Password</label></td>
										<td><input type="password" class="required"
											id="reenterpassword" name="reenterpassword"
											placeholder="Re enter Password" style="width: 222px;"
											value="<?php echo isset($_POST['reenterpassword']) ? $_POST['reenterpassword'] : '' ?>">
											<?php
											if(!empty($errorsrepass)){
											echo "<div class='err' style='clear:both'>".nl2br($errorsrepass)."</div>";
											} ?>
										</td>
									</tr>
									<tr>
										<td><label class="control-label" for="contact">Contact</label>
										</td>
										<td><input type="text" id="contact" class="required"
											name="contact" placeholder="Contact" autocomplete="off"
											style="width: 222px;"
											value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : '' ?>">
											<?php
											if(!empty($errorscont)){
											echo "<div class='err' style='clear:both'>".nl2br($errorscont)."</div>";
											} ?>
										</td>
									</tr>
									<tr>
										<td><label class="control-label" for="bandname">Band Name</label>
										</td>
										<td><input type="text" id="bandname" class="required"
											name="bandname" placeholder="Band Name" autocomplete="off"
											style="width: 222px;"
											value="<?php echo isset($_POST['bandname']) ? $_POST['bandname'] : '' ?>">
										</td>
									</tr>
									<tr>
										<td><label class="control-label" for="captcha">Captcha</label>
											<div id="feedback2"></div></td>
										<td><input id="6_letters_code" name="6_letters_code"
											class="required" type="text"
											placeholder="Enter the code below here" autocomplete="off"
											style="width: 222px;">
											<?php
											if(!empty($errorscap)){
											echo "<div class='err' style='clear:both'>".nl2br($errorscap)."</div>";
											} ?>
											</td>
									</tr>
									<tr>
										<td></td>
										<td><img src="<?php echo _CAPTCHA.'?rand='.rand(); ?>"
											id='captchaimg'
											style="width: 124px; padding: 1px; margin: 10px 70px; border: 1px solid #595959;">
											<?php
											if (empty($errorsemail)&&empty($errorsname)&&empty($errorspass)&&empty($errorsrepass)&&empty($errorscont)&&empty($errorscap))
											{if(!empty($errors)){
											echo "<div class='err' style='clear:both'>".nl2br($errors)."</div>";}
											} ?>
										</td>

									</tr>
								</table>
								<div class="captcha">
									<label for='message'></label> Can't read the image? <br>Click <a
										href='javascript: refreshCaptcha()'
										target="_blank">here</a> to refresh<br>
									<button name="submit" id="submit" type="submit"
										class="btn btn-primary" style="margin: 10px 0 0 0">REGISTER</button>
								</div>
							</form>
						</section>
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
	<?php include_once 'usercontrol/footer.php';?>
</body>
<script type='text/javascript'>
var emailNotAvailable = false;

function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}

$(document).ready(function()
{
	$('#feedback').load('check.php').show();

	$('#email').keyup(function()
	{
		$.post('check.php?email=' + regForm.email.value, function(result)
		{
			$('#feedback').html(result).show();

			if (result.indexOf("not_available") >= 0)
			{
				emailNotAvailable = true;
			}
			else
			{
				emailNotAvailable = false;
			}
		});
	});
});


</script>
</html>
