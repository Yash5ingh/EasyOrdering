<?php
require_once('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10">
    <title>Pending orders</title>
    <link rel="stylesheet" href="pending.css">
</head>
<body>
    <h1>PENDING ORDERS</h1>

    <div id="pending">

    <?php
        $sql = "select * from orders ORDER BY done";
        $result = mysqli_query($conn,$sql);
        $checksum = mysqli_num_rows($result);
        
        if($checksum > 0){
            while($row = mysqli_fetch_assoc($result)){
                
               echo "<div class='order'>
                    <h5>Order no: ".$row['id']."</h5>
                    <h2>".$row['tableno']."</h2>
                    <form action='orderdetails.php' method='get'>
                        <input type='text' name='serveid' value='".$row['id']."' hidden>";
                        if($row['done']){
                            $status = "Done";
                            echo"<button style='background-color: var(--button);'>".$status."</button>";
                        }else{
                            $status = "Pending";
                            echo"<button>".$status."</button>";
                        }
                    echo"</form>
                </div>";
            }
        }
    ?>
    </div>
    <form id="formg" action='bill.php' method='get'>
        <input id="billtable" type='number' name='billtable' value='' placeholder="Table No.">
        <button id="buttong">
            Bill
        </button>
    </form>
</body>
</html>