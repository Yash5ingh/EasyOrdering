<?php
require_once('conn.php');

$grtot = 0;
if (!isset($_GET['billtable']) || empty($_GET['billtable'])) {
  header("location: pending.php");
  exit();
}
$billtable = $_GET['billtable'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="stylesheet" href="bill.css">
</head>
<body>
    <div class="bill-container">
      <h1>Restaurant Bill</h1>
      <table class="bill-table">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
          </tr>
        </thead>


        <tbody>
          <?php

          $sql="SELECT itemid , sum(quantity) as qtt FROM orderdetails WHERE orderid IN (SELECT id FROM orders where tableno = $billtable AND done = 1)  GROUP by itemid;";
          $result = mysqli_query($conn,$sql);

          $checksum = mysqli_num_rows($result);

          if($checksum > 0){
            while($row = mysqli_fetch_assoc($result))
            {

              $sql1="SELECT * FROM menu where id = ".$row['itemid'].";";
              $result1 = mysqli_query($conn,$sql1);

              $checksum1 = mysqli_num_rows($result1);

              if($checksum1 > 0){
                while($row1 = mysqli_fetch_assoc($result1))
                {
                  $grtot += $row['qtt'] * $row1['price'];
                  echo "<tr>
                      <td>".$row1['name']."</td>
                      <td>".$row['qtt']."</td>
                      <td>₹".$row1['price']."</td>
                      <td>₹".$row['qtt'] * $row1['price']."</td>
                    </tr>";
            }
          }
        }
      }
      else{
          header("location: pending.php");
          exit();
      }

          ?>
        </tbody>


      </table>
      <div class="grand-total">
        <span>Grand Total:</span>
        <span>₹<?php echo $grtot ?></span>
      </div>
      <form action="paid.php" method="get">
        <input type="number" name='tableno' value="<?php echo $billtable ?>" hidden >
      <button class="paid-button">Paid</button>
      </form>

     <?php
     require_once("url.php");
     echo "<img src='https://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=$url/resturant-menu/pay.php?amt=$grtot'>"; 
     ?>
     
    </div>
  </body>
</html>