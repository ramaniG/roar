<?php

function user_blacklist($username, $email)
{
$subject = "User Blacklised";

$message = '
<html>
<head>
<title>User Blacklised</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.',
		</p>
		<p>Your account have been blacklisted by the admin.</p>
		<p>Please contact admin for further details.</p>
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
}
?>