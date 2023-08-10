<?php
require_once('conn.php');

$serveid = $_GET['serveid'];

$sql = "UPDATE `orders` SET `done` = '1' WHERE `orders`.`id` = $serveid;";
$result = mysqli_query($conn,$sql);
$last_id = mysqli_insert_id($conn);


header('location: pending.php');

?>