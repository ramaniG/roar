<?php

function booking_cancel($username, $adminname, $email, $studio, $date, $time, $remarks)
{
$subject = "Booking Cancel";

$message = '
<html>
<head>
<title>Booking Cancel</title>
</head>
<body>
	<div>
		<p>
			Dear '.$username.',
		</p>
		<p>Admin ('.$adminname.') have removed a booking that was made by you. Below is the detail of the booking:</p>
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
		<label>Remarks : '.$remarks.'</label>
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