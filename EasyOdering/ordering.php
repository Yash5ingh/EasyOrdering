<?php

require_once('conn.php');

$table = $_GET['tb'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="ordering.css">
</head>
<body>
    <h1>ORDER SOMETHING</h1>
    <form action="orderprocessing.php" method="get">
        <input type="text" name="tb" value="<?php echo $table ?>" hidden>
    <div id="menu">
        

        <?php
        $sql = "select * from menu";
        $result = mysqli_query($conn, $sql);
        $checkresult = mysqli_num_rows($result);
        if($checkresult > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                   echo "<div class='item'>
                   <img src='images/" . $row["name"] . ".jpg' alt='img'>
                   <div class='desc'>
                       <h2>" . $row["name"] . "</h2>

                       <h3>₹" . $row["price"] . "</h3>
                       <div class='quantity'>
                           <button type='button' class='add'>+</button>
                           <span class='qtc'>0</span>
                           
                           <button type='button' class='subtract'>-</button>
                           <input type='text' class='qtinput' name='" . $row["id"] . "' value='0' hidden>
                       </div>
                   </div>
               </div>";
                };
            }

        ?>
    
    </div>

    <input id="order" type="submit" value="Order">
</form>
    <script>

        const quantities = document.querySelectorAll('.quantity');
        quantities.forEach(quantity => {

            quantity.querySelector(".add").addEventListener('click', () => {
                const qt = parseInt(quantity.querySelector(".qtc").innerText);
                quantity.querySelector(".qtc").innerText = qt + 1;
                quantity.querySelector(".qtinput").value = quantity.querySelector(".qtc").innerText;
            });

            quantity.querySelector(".subtract").addEventListener('click', () => {
                const qt = parseInt(quantity.querySelector(".qtc").innerText);
                if(qt > 0){
                    quantity.querySelector(".qtc").innerText = qt - 1;
                    quantity.querySelector(".qtinput").value = quantity.querySelector(".qtc").innerText;
                }
            });
            
        });

    </script>
</body>
</html>