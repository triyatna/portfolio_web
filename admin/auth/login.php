<?php
require "../../core/db.php";
require "../helper/function.php"

?>

<?php
// Initialize the session
session_start();
$loggedin = false;

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $loggedin = true;
}
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();
                            $ip = checkmyip();
                            if (getCountryIP($ip) == "") {
                                $country = "Tidak terdeteksi";
                            } else {
                                $country = getCountryIP($ip);
                            }
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            mysqli_query($mysqli, "INSERT INTO `history` VALUES (NULL, '$ip','$browser', current_timestamp(), 'login', 'false', '$username','$country')");
                            // Redirect user to welcome page
                            header("location: ../");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>


<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title><?= getSingleValDB('options', 'id', '1', 'name'); ?> - Login Admin</title>
    <!-- Favicon-->
    <link rel="icon" href="<?= $domain ?>assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= $domain ?>admin/assets/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= $domain ?>admin/assets/css/main.css">
    <link rel="stylesheet" href="<?= $domain ?>admin/assets/css/color_skins.css">
</head>

<body class="theme-black">
    <div class="authentication">
        <div class="container">
            <div class="col-md-12 content-center">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="company_detail">
                            <h4 class="logo"><img src="<?= $domain ?>assets/img/logo.png" alt="" style="width: 100px;"></h4>
                            <h3><?= getSingleValDB('options', 'id', '1', 'name'); ?> - Personal Portfolio</h3>
                            <p>Access to Panel portfolio by <?= getSingleValDB('options', 'id', '1', 'name'); ?></p>
                            <div class="footer">
                                <ul class="social_link list-unstyled">
                                    <li><a href="https://thememakker.com" title="ThemeMakker"><i class="zmdi zmdi-globe"></i></a></li>
                                    <li><a href="https://themeforest.net/user/thememakker" title="Themeforest"><i class="zmdi zmdi-shield-check"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/thememakker/" title="LinkedIn"><i class="zmdi zmdi-linkedin"></i></a></li>
                                    <li><a href="https://www.facebook.com/thememakkerteam" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="http://twitter.com/thememakker" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="http://plus.google.com/+thememakker" title="Google plus"><i class="zmdi zmdi-google-plus"></i></a></li>
                                    <li><a href="https://www.behance.net/thememakker" title="Behance"><i class="zmdi zmdi-behance"></i></a></li>
                                </ul>
                                <hr>
                                <ul>
                                    <li><a href="http://thememakker.com/contact/" target="_blank">Contact Us</a></li>
                                    <li><a href="http://thememakker.com/about/" target="_blank">About Us</a></li>
                                    <li><a href="http://thememakker.com/services/" target="_blank">Services</a></li>
                                    <li><a href="javascript:void(0);">FAQ</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 offset-lg-1">
                        <div class="card-plain">
                            <div class="header">
                                <h5>Log in</h5>
                            </div>
                            <!-- <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> -->
                            <form class="form" method="POST">
                                <div class="input-group">
                                    <input type="text" placeholder="User Name" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" autocomplete="off" value="">
                                    <span class="input-group-addon"><i class="zmdi zmdi-account-circle"></i></span>
                                    <span class="invalid-feedback"><?= $username_err; ?></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="Password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>" autocomplete="off" value="">
                                    <span class="input-group-addon"><i class="zmdi zmdi-lock"></i></span>
                                    <span class="invalid-feedback"><?= $password_err; ?></span>
                                </div>
                                <div class="footer">
                                    <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                                    <a href="sign-up.html" class="btn btn-primary btn-simple btn-round btn-block">SIGN UP</a>
                                </div>
                            </form>

                            <a href="forgot-password.html" class="link">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="<?= $domain ?>admin/assets/bundles/libscripts.bundle.js"></script>
    <script src="<?= $domain ?>admin/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>

</html>