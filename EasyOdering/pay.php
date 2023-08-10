<?php

$amt = $_GET['amt'];

header("location:upi://pay?pn=with%20Upilink.in%20&pa=yashs8572@oksbi&cu=INR&am=$amt");
exit();