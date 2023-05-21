<?php 
require "../../core/db.php"; 
require "../helper/function.php"

?>
<?php
// Initialize the session
session_start();
$ip = checkmyip(); 
if(getCountryIP($ip)==""){
    $country = "Tidak terdeteksi";
   }else {
    $country = getCountryIP($ip);
   }
$username = $_SESSION['username'];
// Unset all of the session variables
mysqli_query($mysqli, "INSERT INTO `history` VALUES (NULL, '$ip','$browser', current_timestamp(), 'logout', 'false', '$username','$country')");
$_SESSION = array();
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
