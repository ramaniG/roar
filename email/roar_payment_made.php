<?php
function roar_payment_made($username, $packagename, $roarcredit, $price, $paymentdate, $remarks)
{
$subject = "ROAR Credit Ordering - Payment Paid";

$message = '
<html>
<head>
<title>ROAR Credit Ordering - Payment Paid</title>
</head>
<body>
	<div>
		<p>
			Dear Admin,
		</p>
		<p>Payment have been made by '.$username.'. Below is the order detail:</p>

		<table border="1">
			<tr>
				<th>No</th>
				<th>ROAR Credit Package</th>
				<th>ROAR!! Credit (RM)</th>
				<th>Payment Date</th>
				<th>Remarks</th>
			</tr>
			<tr>
				<td>1</td>
				<td>'.$packagename.'</td>
				<td>'.$roarcredit.'</td>
				<td>'.$paymentdate.'</td>
				<td>'.$remarks.'</td>
			</tr>
		</table>
		<br /><br />
		<label>Please verify the payment and make the appropriate changes.</label>
	</div>
</body>
</html>
';


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <donotreply@agilistechno.com>' . "\r\n";

require_once(ROOT.'_config.settings.php');

$mailsent = mail(ADMINEMAIL,$subject,$message,$headers);

return $mailsent;
}
?>