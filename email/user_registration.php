<?php

function user_registration($username, $email)
{
$subject = "Welcome to ROAR!!! MUSIC. _\m/ ROAR!!! \m/_";

$message = '
<html>
<head>
<title>Welcome to ROAR!!! MUSIC. _\m/ ROAR!!! \m/_</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.',
		</p>
		<p>Thank you for registrating under ROAR.</p>
		<p>Please purchase ROAR credit to perform booking.</p>
		<h3>Let KEEP Rocking!!!</h3>
	</div>
</body>
</html>
';


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <donotreply@agilistechno.com>' . "\r\n";

mail($email,$subject,$message,$headers);

$message = '
<html>
<head>
<title>New User Registration</title>
</head>
<body>
	<div>
		<p>
			Dear Admin,
		</p>
		<p>The following user,'.$username.'('.$email.') have registered to our System.</p>
	</div>
</body>
</html>';

mail(ADMINEMAIL, $subject, $message, $headers);

}

?>