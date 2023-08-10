<?php
if(isset($_GET['tb']))
{
    $table = $_GET['tb'];

    header('Location: ordering.php?tb='.$table);
}
else{
    echo "Scan a QR code";
}
