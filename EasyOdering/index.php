<?php
if(isset($_GET['tb']))
{
    $table = $_GET['tb'];

    header('Location: ordering.php?tb='.$table);
}
else{
    echo "<script>alert('Scan the QR code on your table')</script>";
    exit();
}
