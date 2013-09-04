<?php
function roar_remove_credit($username, $adminname, $email, $roarcredit, $paymentdate, $remarks)
{
$subject = "ROAR Credit Added";

$message = '
<html>
<head>
<title>ROAR Credit Added</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.',
		</p>
		<p>Admin ('.$adminname.') have removed '.$roarcredit.' ROAR Credit to your account with remarks:</p>
		<h3>'.$remarks.'</h3>
		<p>at '.$paymentdate.'.</p>
		<br /><br />
		<label>Please verify the ROAR credit is removed from your account.</label>
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