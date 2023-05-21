<?php require "db.php"; ?>

<?php
// Initialize the session
session_start();
$loggedin = false;

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
   $loggedin = true;
    
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>

		<!-- Meta -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSS Plugins -->
        <link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/font-awesome.css">
		<link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/magnific-popup.css">
		<link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/simplebar.css">
		<link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/owl.carousel.min.css">
		<link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/owl.theme.default.min.css">
		<link rel="stylesheet" href="http://localhost/mypersonal/assets/css/plugins/jquery.animatedheadline.css">

		<!-- CSS Base -->
        <link rel="stylesheet" class="theme-st" href="http://localhost/mypersonal/assets/css/style-dark.css">

		<!-- Settings Style -->
		<link rel="stylesheet" class="pos-nav" href="http://localhost/mypersonal/assets/css/settings/left-nav.css" />
		<link rel="stylesheet" class="box-bd" href="http://localhost/mypersonal/assets/css/settings/box/box.css">
		<link rel="stylesheet" class="box-st" href="http://localhost/mypersonal/assets/css/settings/box/circle.css" />
		<link rel="stylesheet" class="box-tl" href="http://localhost/mypersonal/assets/css/settings/title/title.css">
		<link rel="stylesheet" class="style-cl" href="http://localhost/mypersonal/assets/css/settings/color/green-color.css" />

		<link rel="stylesheet" href="http://localhost/mypersonal/assets/setting/style-demo.css">