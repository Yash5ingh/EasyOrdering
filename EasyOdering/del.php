<?php

require_once("conn.php");

$oid = $_GET['oid'];

$sql="DELETE FROM orderdetails WHERE orderid = $oid;";
$result = mysqli_query($conn,$sql);

$sql="DELETE FROM orders WHERE id = $oid;";
$result = mysqli_query($conn,$sql);

header("location: pending.php");