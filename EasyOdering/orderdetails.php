<?php
require_once('conn.php');

$oid = $_GET['serveid'];

$sql = "select * from orders WHERE id = $oid";
$result = mysqli_query($conn,$sql);
$checksum = mysqli_num_rows($result);

if($checksum > 0){
    while($row = mysqli_fetch_assoc($result)){
        $tableno = $row['tableno'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="orderdetails.css">
</head>
<body>
    <h1>ORDER</h1>
    <h1>Table : <?php echo $tableno ?></h1>
    <h3>Order No: <?php echo $oid ?></h3>

    <div id='pending'>


    <?php
    $sql = "select * from orderdetails WHERE orderid = $oid";
    $result = mysqli_query($conn,$sql);
    $checksum = mysqli_num_rows($result);
    
    if($checksum > 0){
        while($row = mysqli_fetch_assoc($result)){

            $sql1 = "select * from menu WHERE id = ".$row['itemid'];
            $result1 = mysqli_query($conn,$sql1);
            $checksum1 = mysqli_num_rows($result1);
            if($checksum1 > 0){
                while($row1 = mysqli_fetch_assoc($result1)){
                    echo"<div class='order'>
                        <h5>".$row1['name']."</h5>
                        <h2>".$row['quantity']."</h2>
                        <h5>".$row1['price'] * $row['quantity']."</h5>
                    </div>";
            }
        }
        }
    }
    ?>
    </div>

    <form action='served.php' method='get'>
        <input type='number' name='serveid' value='<?php echo $oid ?>' hidden>
        <button>
            Serve
        </button>
    </form>

    <form action='del.php' method='get'>
        <input type='number' name='oid' value='<?php echo $oid ?>' hidden>
        <button id="delbutton">
            Delete
        </button>
    </form>


</body>
</html>