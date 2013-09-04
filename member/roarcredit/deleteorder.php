<?php
DEFINE('ROOT', '../../');
require_once('../../_config.settings.php');

$orderid = 0;

if($_GET['orderid'] != "")
	$orderid = $_GET['orderid'];

$db = new Database();

$sql = "DELETE FROM roarcredit_payment WHERE id = $orderid";

$db->query($sql) or die(mysql_error());
$db->close();

echo $orderid;
?>