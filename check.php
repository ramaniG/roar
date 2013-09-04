<?php
include('_config.settings.php');

$email = "";

if(isset($_GET['email']))
{
	$email = $_GET['email'];
}

$db = new Database();

$sql = "SELECT email FROM member WHERE email='$email'";

$result = $db->query($sql);
$check_num_rows = mysql_num_rows($result);

$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

if ($email == NULL)
{
	echo "Email";
}
else if (preg_match($regex, $email)){
	if ($check_num_rows==0)
	{
		echo "Email<img src='images/graphics/available.png' style='float: right; width:20px;'>";
	}
	else
	{
		echo "Email<img src='images/graphics/not_available.png' style='float: right; width:20px;'>";
	}
}
else
{
	echo "Email<img src='images/graphics/loading.gif' style='float: right; width:20px;height:20px;'>";
}
?>