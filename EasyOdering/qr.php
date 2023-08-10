<?php
require_once("url.php");



echo "<div style='width: 90vw;display : flex; flex-wrap:wrap; gap:5rem;'>";


for($i = 1; $i <= 15 ; $i++){
    echo "<div>";
    $tb = $i;
    echo "<img src='https://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=$url/resturant-menu/?tb=$tb'>";
    echo $tb;
    echo "</div>";
}

echo "</div>";