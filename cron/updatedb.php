<?php 
require "../core/db.php";
$date = date('H:i:s');
$queryUp = md5('CRONJOBRUNNING' . rand(0, 1000) . $date);
mysqli_query($db,"UPDATE `document` SET `unique_query` = '$queryUp'");
echo "Success";
?>