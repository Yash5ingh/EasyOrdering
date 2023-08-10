<?php
require_once('conn.php');

$table = $_GET['tb'];

$sql = "INSERT INTO `orders` (`tableno`, `done`) VALUES ('$table', '0');";
$result = mysqli_query($conn,$sql);
$last_id = mysqli_insert_id($conn);

$sql = "select * from menu";
$result = mysqli_query($conn,$sql);
$checksum = mysqli_num_rows($result);

if($checksum > 0){
    while($row = mysqli_fetch_assoc($result)){
        $currid = $row['id'];
        $qtt = $_GET[$currid];
        if($qtt > 0){
            $sql1 = "INSERT INTO `orderdetails` (`orderid`, `itemid`, `quantity`) VALUES ($last_id, $currid ,$qtt);";
            $result1 = mysqli_query($conn,$sql1);
        }
        
    }
}


header('location: thankyou.html');

?>