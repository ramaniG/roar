<?php
DEFINE('ROOT', '../../');
require_once(ROOT.'_config.settings.php');
require_once(ROOT.'sso/session.php');

$name = "";

if(isset($_GET["name"]))
	$name = $_GET["name"];

$db = new Database();

$sql = "SELECT a.id,a.name, a.email, IFNULL(b.amount,0) as amount 
		FROM member a 
		LEFT JOIN roarcredit b ON a.id=b.memberid
		WHERE a.name like '%$name%'
		LIMIT 10";

$result = $db->query($sql);

if (mysql_num_rows($result))
	echo "<label>User List and Roar Credit</label><br/>";

while ($row = $db->fetchArray($result)) {
	echo "<input type='radio' name='user-list' value='{$row['id']},{$row['amount']},{$row['name']},{$row['email']}' />{$row['name']} - {$row['email']} - {$row['amount']} <br />";
}


$db->close();
?>
