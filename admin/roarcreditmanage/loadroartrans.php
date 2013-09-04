<?php

require_once('../../_config.settings.php');

$username = "";

if(!empty($_GET['username']))
	$username = $_GET['username'];

$db = new Database();

$sql = "SELECT a.id,a.name, b.amount, a.email
		FROM member a
		JOIN roarcredit b ON a.id = b.memberid
		WHERE a.name LIKE '%$username%'
		ORDER BY a.id;";

$result = $db->query($sql);

$db->close();

?>
<style>
#trans-table > table
{
border-collapse:collapse;
}

#trans-table > table > tbody > tr > th
{
border: 1px solid white!important;
}

#trans-table > table > tbody > tr > td
{
border: 1px solid white!important;
}
</style>

<table id="trans-table">
<tr>
<th>User Name</th>
<th>Email</th>
<th>ROAR Amount</th>
<th>Action</th>
</tr>
<?php 
while ($row = $db->fetchArray($result)) {
	echo "<tr>";
	echo "<td>{$row['name']}</td>";
	echo "<td>{$row['email']}</td>";
	echo "<td>{$row['amount']}</td>";
	echo "<td><button onclick='editamount(".$row['id'].")'>Edit Amount</button></td>";
	echo "</tr>";
}


?>
</table>