<?php
function roar_payment_resit($username, $adminname, $email, $packagename, $roarcredit, $price, $paymentdate, $approveddate, $remarks)
{
$subject = "ROAR Credit Ordering - Resit";

$message = '
<html>
<head>
<title>ROAR Credit Ordering - Resit</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.',
		</p>
		<p>Admin ('.$adminname.') have approved your payment and credited the ROAR Credit. Below is the order detail:</p>

		<table border="1">
			<tr>
				<th>No</th>
				<th>ROAR Credit Package</th>
				<th>ROAR Credit</th>
				<th>Total Price (RM)</th>
				<th>Payment Date</th>
				<th>Approved Date</th>
				<th>Remarks</th>
			</tr>
			<tr>
				<td>1</td>
				<td>'.$packagename.'</td>
				<td>'.$roarcredit.'</td>
				<td>'.$price.'</td>
				<td>'.$paymentdate.'</td>
				<td>'.$approveddate.'</td>
				<td>'.$remarks.'</td>
			</tr>
			<tr>
				<td colspan="3">TOTAL Price</td>
				<td>'.$price.'</td>
			</tr>
		</table>
		<br /><br />
		<label>Please verify the ROAR credit is added to you account.</label>
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