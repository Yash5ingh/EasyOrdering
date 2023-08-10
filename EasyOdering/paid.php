<?php

require_once("conn.php");

$tableno = $_GET['tableno'];

$sql="DELETE FROM orderdetails WHERE orderid IN (SELECT id FROM orders WHERE tableno = $tableno);";
$result = mysqli_query($conn,$sql);

$sql="DELETE FROM orders WHERE tableno = $tableno;";
$result = mysqli_query($conn,$sql);

header("location: pending.php");