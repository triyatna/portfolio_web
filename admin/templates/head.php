<?php
require "../core/db.php";
require "./helper/function.php"

?>

<?php
// Initialize the session
session_start();
$loggedin = false;
// DBCount
$count = new CountDB();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $loggedin = true;
}
if (!$loggedin) {
    header("location: auth/login.php");
    exit;
}
?>
<!DOCTYPE HTML>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Panel Admin for control Personal portfolio by <?= getSingleValDB('options', 'id', '1', 'name')  ?>">
    <title id="title"></title>
    <link rel="icon" href="<?= $domain ?>assets/img/favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= $admin ?>assets/css/main.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/css/color_skins.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/css/toastr.min.css">
    <!-- JQuery DataTable Css -->
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <!-- Multi Select Css -->
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" />

    <!-- Blog post -->
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/css/blog.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/css/inbox.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/js/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="<?= $admin ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">

</head>

<body class="theme-black">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="<?= $domain ?>assets/img/logo.png" width="48" height="48" alt="Alpino"></div>
        <p>Please wait...</p>        
    </div>
</div> -->