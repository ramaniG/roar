<?php
function booking_received($username, $email, $studio, $date, $time, $remarks, $deductedcredit)
{
$subject = "Studio Booking";

$message = '
<html>
<head>
<title>Studio Booking</title>
</head>
<body>
	<div>
		<p>Dear '.$username.',</p>
		<p>Thanks for booking our Studio. Below is the booking detail:</p>

		<table border="1">
			<tr>
				<th>No</th>
				<th>Studio</th>
				<th>Date</th>
				<th>Time</th>
				<th>Remarks</th>
			</tr>
			<tr>
				<td>1</td>
				<td>'.$studio.'</td>
				<td>'.$date.'</td>
				<td>'.$time.'</td>
				<td>'.$remarks.'</td>
			</tr>
		</table>
		<br /><br />
		<label>The following booking is confirmed. Total deducted credit : '.$deductedcredit.'</label><br />
				<br /><br /><br />

	</div>
</body>
</html>
';


// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <donotreply@agilistechno.com>' . "\r\n";

mail($email,$subject,$message,$headers);

$subject = "Studio Booking by $username";

$message = '
<html>
<head>
<title>Studio Booking</title>
</head>
<body>
	<div>
		<p>Dear Admin,</p>
		<p>User : '.$username.' have made booking. Below is the booking detail:</p>

		<table border="1">
			<tr>
				<th>No</th>
				<th>Studio</th>
				<th>Date</th>
				<th>Time</th>
				<th>Remarks</th>
			</tr>
			<tr>
				<td>1</td>
				<td>'.$studio.'</td>
				<td>'.$date.'</td>
				<td>'.$time.'</td>
				<td>'.$remarks.'</td>
			</tr>
		</table>
		<br /><br />
		<label>The following booking is confirmed.</label><br />
				<br /><br /><br />

	</div>
</body>
</html>
';

return mail(ADMINEMAIL,$subject,$message,$headers);
}
?>