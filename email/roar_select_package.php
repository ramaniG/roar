<?php
function roar_select_package($username, $email, $packagename, $roarcredit, $price)
{
$subject = "ROAR Credit Ordering";

$message = '
<html>
<head>
<title>ROAR Credit Ordering</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.'
			,
		</p>
		<p>Thanks for ordering ROAR Credit. Below is the order detail:</p>

		<table border="1">
			<tr>
				<th>No</th>
				<th>ROAR Credit Package</th>
				<th>ROAR!! Credit (RM)</th>
			</tr>
			<tr>
				<td>1</td>
				<td>'.$packagename.'</td>
				<td>'.$roarcredit.'</td>
			</tr>
			<tr>
				<td colspan="2">TOTAL Price</td>
				<td>'.$roarcredit.'</td>
			</tr>
		</table>
		<br /><br />
		<label>Please make your payment via any of the following method :</label><br />
				<label>Online Transfer</label><br /> <label>ATM Transfer</label><br />
				<label>Deposit</label><br /> <br /> <label>Payment made must be the
					exact amount which is : RM '.sprintf("%0.2f", $price).'.
			</label><br /> <br /> <label>Payment must be made to :</label><br />
				<label>Bank : Maybank</label><br /> <label>Account Holder : ROAR MUSIC SDN. BHD.</label><br /> 
							<label>Acc NO : 5127 5451 0311</label><br />
				<br /><br /><br />

	</div>
</body>
</html>
';


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <donotreply@agilistechno.com>' . "\r\n";

return mail($email,$subject,$message,$headers);
}
?>