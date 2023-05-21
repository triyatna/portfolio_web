<?php 
require "core/db.php";
require "admin/helper/function.php";
$color = substr(md5(rand()), 0, 6);
// echo $color;
$sql = "SELECT * FROM `messages` WHERE `email` = 'triyatna372@gmail.com'";
$result = mysqli_query($mysqli, $sql);
$email = 'triyatna372@gmail.com';
if(getSingleValDB('messages', 'email', $email, 'avatar') == ''){
 $avatar = 'true';
} else {
    $avatar = 'false';
}
echo $avatar;
?>

<!-- <img src="https://avatars.abstractapi.com/v1/?api_key=0e2d4b7ae5de4248801823519c55845c&image_size=200&background_color=<?=$color?>&name=Tri%20Yatna" alt=""> -->