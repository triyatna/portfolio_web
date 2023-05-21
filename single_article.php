<?php
require "core/db.php";
require "admin/helper/function.php";
?>
<?php
// error_reporting(0);
$article_id = $_GET['id'];

// Get Article Info
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN `author` ON `article`.id_author = `author`.author_id  WHERE `article_slug` = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

$before_article = $conn->prepare("SELECT * FROM `article` WHERE `article_id` < ? ORDER BY `article_id` DESC LIMIT 1");
$before_article->execute([$article["article_id"]]);
$_before = $before_article->fetch();

$after_article = $conn->prepare("SELECT * FROM `article` WHERE `article_id` > ? ORDER BY `article_id` DESC LIMIT 1");
$after_article->execute([$article["article_id"]]);
$_after = $after_article->fetch();

if ($article_id != $article['article_slug']) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="robots" content="noindex">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Page Not Found!</title>
        <meta name="keywords" content="404, error, 404 error, 404 error page design, design, html, css" />
        <meta name="description" content="Page not found by Tri Yatna" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= $domain ?>assets/img/favicon.ico" type="image/x-icon" />
        <style>
            * {
                padding: 0;
                margin: 0;
            }

            body {
                background: radial-gradient(circle, rgb(28, 27, 90) 0%, rgb(15, 18, 44) 30%, rgb(15, 13, 31) 100%);
                height: 100vh;
                color: #efefef;
            }

            .particles {
                position: fixed;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
            }

            .particles span {
                position: absolute;
                top: 10%;
                left: 10%;
                display: block;
                content: '';
                width: 6px;
                height: 6px;
                background: rgba(255, 255, 255, 0.6);
                border-radius: 0.5rem;
                filter: blur(5px);

            }

            .particles span:nth-child(2) {
                top: 15%;
                left: 70%;
                filter: blur(3px);
            }

            .particles span:nth-child(3) {
                top: 70%;
                left: 40%;
                filter: blur(5px);
            }

            .particles span:nth-child(4) {
                top: 52%;
                left: 20%;
                filter: blur(4px);
            }

            .particles span:nth-child(5) {
                top: 74%;
                left: 90%;
                filter: blur(5px);
            }

            .particles span:nth-child(6) {
                top: 85%;
                left: 10%;
                filter: blur(7px);
            }

            .particles span:nth-child(7) {
                top: 67%;
                left: 79%;
                filter: blur(3px);
            }

            .particles span:nth-child(8) {
                top: 48%;
                left: 40%;
                filter: blur(4px);
            }

            .particles span:nth-child(9) {
                top: 45%;
                left: 30%;
                filter: blur(5px);
            }

            .particles span:nth-child(10) {
                top: 96%;
                left: 29%;
                filter: blur(4px);
            }

            .particles span:nth-child(11) {
                top: 55%;
                left: 89%;
                filter: blur(6px);
            }

            .particles span:nth-child(12) {
                top: 55%;
                left: 60%;
                filter: blur(7px);
            }

            @media (max-height:800px) {
                footer {
                    position: static;
                }
            }

            .copyright-alerts {
                display: inline-block;
                position: relative;
                ;
                background-color: white;
                width: 100px;
                height: 70px;
                margin: 0 5px;
                -webkit-box-shadow: 0 10px 5px -4px rgba(0, 0, 0, .2);
                -moz-box-shadow: 0 10px 5px -4px rgba(0, 0, 0, .2);
                box-shadow: 0 10px 5px -4px rgba(0, 0, 0, .2);
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                font: normal normal 30px/70px "Comic Sans MS", Verdana, Arial, Sans-Serif;
                text-align: center;
                color: #888;
                cursor: default;
                z-index: 9999;
            }

            .copyright-alerts:hover {
                -webkit-box-shadow: 0 2px 2px rgba(0, 0, 0, .2);
                -moz-box-shadow: 0 2px 2px rgba(0, 0, 0, .2);
                box-shadow: 0 2px 2px rgba(0, 0, 0, .2);
            }

            .copyright-alerts:active {
                -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
                box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
            }

            .footer-distributed {
                background-color: #2c292f;
                box-sizing: border-box;
                width: 100%;
                text-align: left;
                font: bold 16px sans-serif;
                padding: 50px 50px 60px 50px;
                margin-top: 80px;
            }

            .footer-distributed .footer-left,
            .footer-distributed .footer-center,
            .footer-distributed .footer-right {
                display: inline-block;
                vertical-align: top;
            }

            .footer-distributed .footer-company-name {
                color: #8f9296;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
            }

            main {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-family: cursive;
            }

            main h1 {
                font-weight: normal;
            }

            main h1 {
                text-align: center;
                text-shadow: 0 0 5px #c3d168a2;
            }

            main div {
                margin-top: 2rem;
                text-align: center;
            }

            main div span {
                font-size: 5rem;
                line-height: 6rem;
                text-shadow: 0 0 7px #c3d168a2;
            }

            .circle {
                user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -webkit-user-select: none;
                display: inline-block;
                position: relative;
                width: 6rem;
                height: 6rem;
                text-shadow: none;
                background: #e6f1a3 radial-gradient(#f9ffd2, #ecff70);
                color: rgba(0, 0, 0, 0);
                border-radius: 50%;
                box-shadow: 0 0 7px #e7f1a3a2;
            }

            .circle:after {
                display: block;
                position: absolute;
                content: '';
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-45deg);
                width: 10rem;
                height: 4rem;
                border-radius: 50%;
                border: 2px solid #fafafa;
                border-top: 0px solid #fafafa;
                border-bottom: 4px solid #fafafa;
                z-index: 2
            }

            .circle:before {
                display: block;
                position: absolute;
                content: '';
                top: 50%;
                left: 50%;
                background: #124;
                border-radius: 50%;
                width: 4px;
                height: 4px;
                transform-origin: 2.5rem 0;
                transform: translate(-2.5rem, 0) rotate(0deg);
                animation: circle-around 5s infinite linear;
            }

            @keyframes circle-around {
                0% {
                    transform: translate(-2.5rem, 0) rotate(0deg);
                }

                100% {
                    transform: translate(-2.5rem, 0) rotate(360deg);
                }
            }

            main p {
                margin-top: 3rem;
                text-align: center;
                text-shadow: 0 0 5px #c3d168a2;
            }

            main button {
                padding: 0.55rem 1.2rem;
                border: none;
                outline: none;
                appearance: none;
                border-radius: 1rem;
                background: rgb(17, 141, 44);
                color: #fafafa;
                box-shadow: 0 0 4px #e1f17859;
            }

            main button:hover {
                cursor: pointer;
            }
        </style>

    </head>

    <body onclick="play()">

        <div id="particles" class="particles">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

        <main>
            <section>
                <audio id="audio" autoplay loop>
                    <source src="<?= $domain ?>assets/audio/notfound.mp3" type="audio/mp3">
                </audio>
                <h1 onclick="play()">Page Not Found!</h1>
                <div>
                    <span onclick="play()">4</span>
                    <span onclick="play()" class="circle">0</span>
                    <span onclick="play()">4</span>
                </div>
                <p onclick="play()">We are unable to find the page<br>you're looking for.</p>
                <div>
                    <button onclick="history.back()">Back to Home Page</button>
                </div>
            </section>
        </main>
        <script>
            var myaudio = document.getElementById("audio")

            function play() {
                return myaudio.play();
            };

            function stop() {
                return myaudio.pause();
            };
        </script>
    </body>

    </html>
<?php
} else {

    $id_ = $article["article_id"];
    $q_bef = mysqli_query($mysqli, "SELECT * FROM `article` WHERE `article_id` < $id_ ORDER BY `article_id` DESC LIMIT 1");
    $a_bef = mysqli_query($mysqli, "SELECT * FROM `article` WHERE `article_id` > $id_ ORDER BY `article_id` DESC LIMIT 1");
    $row_bef = mysqli_num_rows($q_bef);
    $row_af = mysqli_num_rows($a_bef);

    // Get Category of article
    $stmt = $conn->prepare("SELECT * FROM `category` WHERE `category_id` = ?");
    $stmt->execute([$article["id_categorie"]]);
    $category = $stmt->fetch();

    // Get Author's articles
    $stmt = $conn->prepare("SELECT article_title, article_id FROM `article` WHERE id_author = ? LIMIT 4");
    $stmt->execute([$article["id_author"]]);
    $articles = $stmt->fetchAll();

    // Get Comments
    $stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN `comment` WHERE `article`.`article_id`= `comment`.`id_article` AND `article`.`article_slug` = ? ORDER BY comment_id DESC");
    $stmt->execute([$article_id]);
    $comments = $stmt->fetchAll();
    $result = $mysqli->query("SELECT * FROM `comment` WHERE `id_article`=6");
    $avg_comments = $result->num_rows;

    // Get Recent Posts
    $recent = mysqli_query($mysqli, "SELECT * FROM `article` ORDER BY `article_id` DESC LIMIT 5");
    $category = mysqli_query($mysqli, "SELECT * FROM `category`");
    $_tags = mysqli_query($mysqli, "SELECT * FROM `tags`");

    // Get Tags articles
    $stmt = $conn->prepare("SELECT * FROM `tags` WHERE `article_slug` = ?");
    $stmt->execute([$article_id]);
    $tags = $stmt->fetchAll();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- // Meta Seo -->
        <meta name="title" content="<?= $article["article_title"] ?>">
        <meta name="description" content="<?= $article["article_desc"] ?>">
        <meta name="keywords" content="<?= $article["tags"] ?>">
        <meta name="robots" content="index, follow">
        <meta name="language" content="English, Indonesian">
        <meta name="author" content="Tri Yatna">
        <title><?= $article['article_title'] ?> - Blog</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?= $domain ?>assets/img/favicon.ico" type="image/x-icon" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/bootstrap.min.css">
        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/d2fc94afb7.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Righteous%7CMerriweather:300,300i,400,400i,700,700i" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="<?= $domain ?>assets/css/mediumish.css" rel="stylesheet">
    </head>

    <body>

        <!-- Begin Nav
================================================== -->
        <nav class="navbar navbar-toggleable-md navbar-light fixed-top mediumnavigation">
            <div class="container">
                <!-- Begin Logo -->
                <a class="navbar-brand" href="index.html">
                    <img src="<?= $domain ?>assets/img/logo.png" alt="Logo">
                </a>
                <!-- End Logo -->
            </div>
        </nav>
        <!-- End Nav
================================================== -->
        <!-- Begin Article
================================================== -->
        <div class="container">
            <div class="row">
                <!-- Begin Fixed Left Share -->
                <div class="col-md-1 col-xs-12" style="z-index: 1000;">
                    <div class="share">
                        <p>
                            Share
                        </p>
                        <ul>
                            <li>
                                <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
                                <a target="_blank" class="twitter-share-button" href="https://twitter.com/share?url=<?= urlencode($domain . 'article/' . $article["article_slug"]) ?>">
                                    <svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29">
                                        <path d="M21.967 11.8c.018 5.93-4.607 11.18-11.177 11.18-2.172 0-4.25-.62-6.047-1.76l-.268.422-.038.5.186.013.168.012c.3.02.44.032.6.046 2.06-.026 3.95-.686 5.49-1.86l1.12-.85-1.4-.048c-1.57-.055-2.92-1.08-3.36-2.51l-.48.146-.05.5c.22.03.48.05.75.08.48-.02.87-.07 1.25-.15l2.33-.49-2.32-.49c-1.68-.35-2.91-1.83-2.91-3.55 0-.05 0-.01-.01.03l-.49-.1-.25.44c.63.36 1.35.57 2.07.58l1.7.04L7.4 13c-.978-.662-1.59-1.79-1.618-3.047a4.08 4.08 0 0 1 .524-1.8l-.825.07a12.188 12.188 0 0 0 8.81 4.515l.59.033-.06-.59v-.02c-.05-.43-.06-.63-.06-.87a3.617 3.617 0 0 1 6.27-2.45l.2.21.28-.06c1.01-.22 1.94-.59 2.73-1.09l-.75-.56c-.1.36-.04.89.12 1.36.23.68.58 1.13 1.17.85l-.21-.45-.42-.27c-.52.8-1.17 1.48-1.92 2L22 11l.016.28c.013.2.014.35 0 .52v.04zm.998.038c.018-.22.017-.417 0-.66l-.498.034.284.41a8.183 8.183 0 0 0 2.2-2.267l.97-1.48-1.6.755c.17-.08.3-.02.34.03a.914.914 0 0 1-.13-.292c-.1-.297-.13-.64-.1-.766l.36-1.254-1.1.695c-.69.438-1.51.764-2.41.963l.48.15a4.574 4.574 0 0 0-3.38-1.484 4.616 4.616 0 0 0-4.61 4.613c0 .29.02.51.08.984l.01.02.5-.06.03-.5c-3.17-.18-6.1-1.7-8.08-4.15l-.48-.56-.36.64c-.39.69-.62 1.48-.65 2.28.04 1.61.81 3.04 2.06 3.88l.3-.92c-.55-.02-1.11-.17-1.6-.45l-.59-.34-.14.67c-.02.08-.02.16 0 .24-.01 2.12 1.55 4.01 3.69 4.46l.1-.49-.1-.49c-.33.07-.67.12-1.03.14-.18-.02-.43-.05-.64-.07l-.76-.09.23.73c.57 1.84 2.29 3.14 4.28 3.21l-.28-.89a8.252 8.252 0 0 1-4.85 1.66c-.12-.01-.26-.02-.56-.05l-.17-.01-.18-.01L2.53 21l1.694 1.07a12.233 12.233 0 0 0 6.58 1.917c7.156 0 12.2-5.73 12.18-12.18l-.002.04z"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0&appId=278968774360574&autoLogAppEvents=1" nonce="ZNhTDSVD"></script>
                                <div class="fb-share-button" data-href="<?= $domain ?>article/<?= $article["article_slug"] ?>" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($domain . 'article/' . $article["article_slug"]) ?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send?text=<?= urlencode($domain . 'article/' . $article["article_slug"]) ?>" target="_blank"><svg id="Layer_1" width="60" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 38.7">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: #25d366;
                                                    fill-rule: evenodd;
                                                }

                                                .cls-2 {
                                                    fill: #fff;
                                                }

                                                .cls-3 {
                                                    fill: #21be5c;
                                                    stroke: #25d366;
                                                    stroke-miterlimit: 2.61;
                                                    stroke-width: 0.22px;
                                                }
                                            </style>
                                        </defs>
                                        <title>whatsapp-share-button</title>
                                        <path class="cls-1" d="M118.69.11H4.19A4.2,4.2,0,0,0,0,4.3V34.4a4.2,4.2,0,0,0,4.19,4.19h114.5a4.2,4.2,0,0,0,4.19-4.19V4.3A4.2,4.2,0,0,0,118.69.11Z" />
                                        <path class="cls-2" d="M52,21.45l3.13-.23a3,3,0,0,0,.42,1.34,1.65,1.65,0,0,0,1.45.75,1.45,1.45,0,0,0,1.09-.38,1.26,1.26,0,0,0,.38-.89,1.21,1.21,0,0,0-.36-.86,3.7,3.7,0,0,0-1.68-.72A6.63,6.63,0,0,1,53.33,19a3.19,3.19,0,0,1-.94-2.38,3.57,3.57,0,0,1,.48-1.8,3.32,3.32,0,0,1,1.43-1.34A6,6,0,0,1,56.93,13a4.81,4.81,0,0,1,3.12.88,4,4,0,0,1,1.27,2.81l-3.1.22a2.07,2.07,0,0,0-.52-1.23,1.52,1.52,0,0,0-1.09-.38,1.2,1.2,0,0,0-.87.28.94.94,0,0,0-.29.69.72.72,0,0,0,.24.53,2.35,2.35,0,0,0,1.1.46,12.34,12.34,0,0,1,3.09,1.09,3.46,3.46,0,0,1,1.36,1.38,3.92,3.92,0,0,1,.43,1.83,4.4,4.4,0,0,1-.57,2.2,3.7,3.7,0,0,1-1.59,1.52,5.56,5.56,0,0,1-2.56.52c-1.82,0-3.08-.4-3.77-1.21A5.18,5.18,0,0,1,52,21.45Zm-26.7-.14c-.24-.13-1.44-.72-1.67-.8s-.38-.12-.55.13-.63.79-.77.95-.28.19-.53.07a7,7,0,0,1-2-1.22,7.21,7.21,0,0,1-1.36-1.69c-.14-.24,0-.37.11-.49s.24-.29.37-.43a1.52,1.52,0,0,0,.24-.41.44.44,0,0,0,0-.42c-.06-.13-.55-1.33-.75-1.82s-.4-.41-.55-.42h-.47a.92.92,0,0,0-.65.3,2.74,2.74,0,0,0-.85,2,4.79,4.79,0,0,0,1,2.52A10.91,10.91,0,0,0,21,23.3c.58.25,1,.4,1.39.52a3.49,3.49,0,0,0,1.54.1,2.49,2.49,0,0,0,1.64-1.16,2,2,0,0,0,.15-1.16c-.06-.11-.22-.17-.47-.3Zm2.46-8.95A9.77,9.77,0,0,0,12.38,24.14L11,29.2l5.17-1.36A9.77,9.77,0,0,0,20.84,29h0a9.77,9.77,0,0,0,6.9-16.67Zm-6.91,15a8.07,8.07,0,0,1-4.13-1.14l-.3-.17-3.07.8.82-3L14,23.58a8,8,0,0,1-1.25-4.32,8.12,8.12,0,0,1,13.86-5.74A8,8,0,0,1,29,19.26a8.15,8.15,0,0,1-8.12,8.13ZM63.13,13.15h3.3v4.33H70V13.15h3.31V25.54H70v-5h-3.6v5h-3.3V13.15Zm19,10.35H78.37l-.54,2H74.46l4-12.39h3.61l4,12.39H82.64l-.54-2Zm-.69-2.68-1.17-4.45-1.17,4.45Zm5.77,4.72V13.15h5.5a6.91,6.91,0,0,1,2.33.31,2.55,2.55,0,0,1,1.31,1.13,3.84,3.84,0,0,1,.49,2,3.93,3.93,0,0,1-.38,1.78,3.25,3.25,0,0,1-1,1.22,3.85,3.85,0,0,1-1.16.49,3.18,3.18,0,0,1,.86.45,3.6,3.6,0,0,1,.52.66,5,5,0,0,1,.46.77l1.61,3.57H94l-1.76-3.77a3,3,0,0,0-.6-1,1.25,1.25,0,0,0-.81-.28h-.29v5Zm3.31-7.35h1.39a4.59,4.59,0,0,0,.88-.17.83.83,0,0,0,.53-.39,1.27,1.27,0,0,0,.21-.72,1.22,1.22,0,0,0-.33-.92,1.74,1.74,0,0,0-1.23-.33H90.49v2.53Zm8.24-5h8.83V15.8H102v2h5.12V20.3H102v2.44h5.68v2.8h-9V13.15Z" />
                                        <polygon class="cls-3" points="40.66 0.11 40.66 38.59 38.27 38.59 38.27 0.11 40.66 0.11 40.66 0.11" />
                                    </svg></a>
                            </li>
                        </ul>
                        <div class="sep">
                        </div>
                        <p>
                            Talk
                        </p>
                        <ul>
                            <li>
                                <a href="#comments">
                                    0<br />
                                    <svg class="svgIcon-use" width="29" height="29" viewbox="0 0 29 29">
                                        <path d="M21.27 20.058c1.89-1.826 2.754-4.17 2.754-6.674C24.024 8.21 19.67 4 14.1 4 8.53 4 4 8.21 4 13.384c0 5.175 4.53 9.385 10.1 9.385 1.007 0 2-.14 2.95-.41.285.25.592.49.918.7 1.306.87 2.716 1.31 4.19 1.31.276-.01.494-.14.6-.36a.625.625 0 0 0-.052-.65c-.61-.84-1.042-1.71-1.282-2.58a5.417 5.417 0 0 1-.154-.75zm-3.85 1.324l-.083-.28-.388.12a9.72 9.72 0 0 1-2.85.424c-4.96 0-8.99-3.706-8.99-8.262 0-4.556 4.03-8.263 8.99-8.263 4.95 0 8.77 3.71 8.77 8.27 0 2.25-.75 4.35-2.5 5.92l-.24.21v.32c0 .07 0 .19.02.37.03.29.1.6.19.92.19.7.49 1.4.89 2.08-.93-.14-1.83-.49-2.67-1.06-.34-.22-.88-.48-1.16-.74z"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <div class="sep">
                        </div>
                        <ul>
                            <a href="<?= $domain ?>#blog" style="text-decoration: none;">
                                <li><i class="fa-solid fa-long-arrow-alt-left"></i></li>
                                <li>Back</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <!-- End Fixed Left Share -->

                <!-- Begin Post -->
                <div class="col-md-9 col-md-offset-2 col-xs-12">
                    <div class="mainheading">

                        <!-- Begin Top Meta -->
                        <div class="row post-top-meta">
                            <div class="col-md-2">
                                <a href="#"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
                            </div>
                            <div class="col-md-10">
                                <?php
                                $author = getSingleValDB('article', 'article_slug', $article_id, 'id_author');
                                $cat = getSingleValDB('article', 'article_slug', $article_id, 'id_categorie');
                                $dd = new DateTime($article["article_updated_at"]);
                                ?>
                                <h5><a class="link-dark" href="#"><?= getSingleValDB('author', 'author_id', $author, 'author_username') ?></a></h5>
                                <span class="author-description"><?= getSingleValDB('author', 'author_id', $author, 'author_desc') ?></span>
                                <br>
                                <span class="post-date"><?= $dd->format('D, d F Y') ?></span><span class="dot"></span><span class="post-read"><?= getSingleValDB('category', 'category_id', $cat, 'category_name') ?></span>
                            </div>
                        </div>
                        <!-- End Top Menta -->
                        <!-- Begin Featured Image -->
                        <div class="card">
                            <img class="featured-image img-fluid" src="<?= $domain ?>assets/img/article/<?= $article["article_image"] ?>" alt="">
                        </div>
                        <!-- End Featured Image -->
                        <br>
                        <h1 class="posttitle"><?= $article["article_title"] ?></h1>
                    </div>
                    <!-- Begin Post Content -->
                    <div class="article-post">
                        <div class="card" style="background-color: #000 !important; color : #fff">
                            <?= $article["article_content"] ?>
                        </div>
                    </div>
                    <!-- End Post Content -->

                    <!-- Begin Tags -->
                    <div class="after-post-tags">
                        <p>TAGS:</p>
                        <ul class="tags">
                            <?php foreach ($tags as $tag) : ?>
                            <?php
                                echo '<li><a href="#">' . $tag['tags'] . '</a></li>';
                            endforeach; ?>
                        </ul>
                    </div>
                    <!-- End Tags -->

                </div>
                <!-- End Post -->
                <div class="col-md-2 col-xs-12">
                    <div class="disbar">
                        <h5 class="ml-2"><strong>Recent Posts</strong></h5>
                        <ul>
                            <?php foreach ($recent as $post) : ?>
                                <li><?= $post['article_title'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="disbar">
                        <h5 class="ml-2"><strong>Category</strong></h5>
                        <ul>
                            <?php foreach ($category as $post) : ?>
                                <li><?= $post['category_name'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="disbar">
                        <h5 class="ml-2"><strong>Tag</strong></h5>
                        <ul>
                            <?php foreach ($_tags as $post) : ?>
                                <li><?= $post['tags'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="hideshare"></div>

        <div class="graybg">
            <div class="container">
                <div class="row listrecent listrelated">
                    <!-- begin post -->
                    <div class="col-md-1">
                        <div class="arrow">

                        </div>
                    </div>
                    <!-- end post -->

                    <!-- begin post -->

                    <div class="col-md-3">
                        <?php
                        if ($row_bef == 1) {
                        ?>
                            <div class="continue-blog">
                                <div class="card mt-2 mb-2">
                                    <a href="<?= $domain ?>article/<?= $_before["article_slug"] ?>">
                                        <img class="img-fluid img-thumb" src="<?= $domain ?>assets/img/article/<?= $_before["article_image"] ?>" alt="">
                                    </a>
                                    <div class="card-block">
                                        <h2 class="card-title"><a href="<?= $domain ?>article/<?= $_before["article_slug"] ?>"><?= $_before["article_title"] ?></a></h2>
                                        <div class="metafooter">
                                            <div class="wrapfooter">
                                                <span class="meta-footer-thumb">
                                                    <a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
                                                </span>
                                                <span class="author-meta">
                                                    <span class="post-name"><a href="author.html">Sal</a></span><br />
                                                    <span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
                                                </span>
                                                <span class="post-read-more"><a href="post.html" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                            <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                                        </svg></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- end post -->

                    <!-- begin post -->
                    <div class="col-md-4" style="cursor: not-allowed;">
                        <div class="card mt-2 mb-2">
                            <img class="img-fluid img-thumb" src="<?= $domain ?>assets/img/article/<?= $article["article_image"] ?>" alt="">
                            <div class="card-block">
                                <h2 class="card-title" style="color: #000;"><?= $article["article_title"] ?></h2>
                                <div class="metafooter">
                                    <div class="wrapfooter">
                                        <span class="meta-footer-thumb">
                                            <a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
                                        </span>
                                        <span class="author-meta">
                                            <span class="post-name"><a href="author.html">Sal</a></span><br />
                                            <span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
                                        </span>
                                        <span class="post-read-more"><a href="post.html" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                    <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                                </svg></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end post -->

                    <!-- begin post -->
                    <div class="col-md-3">
                        <?php
                        if ($row_af == 1) {
                        ?>
                            <div class="continue-blog">
                                <div class="card mt-2 mb-2">
                                    <a href="<?= $domain ?>article/<?= $_after["article_slug"] ?>">
                                        <img class="img-fluid img-thumb" src="<?= $domain ?>assets/img/article/<?= $_after["article_image"] ?>" alt="">
                                    </a>
                                    <div class="card-block">
                                        <h2 class="card-title"><a href="<?= $domain ?>article/<?= $_after["article_slug"] ?>"><?= $_after["article_title"] ?></a></h2>
                                        <div class="metafooter">
                                            <div class="wrapfooter">
                                                <span class="meta-footer-thumb">
                                                    <a href="author.html"><img class="author-thumb" src="https://www.gravatar.com/avatar/e56154546cf4be74e393c62d1ae9f9d4?s=250&amp;d=mm&amp;r=x" alt="Sal"></a>
                                                </span>
                                                <span class="author-meta">
                                                    <span class="post-name"><a href="author.html">Sal</a></span><br />
                                                    <span class="post-date">22 July 2017</span><span class="dot"></span><span class="post-read">6 min read</span>
                                                </span>
                                                <span class="post-read-more"><a href="post.html" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                                                            <path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path>
                                                        </svg></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="alertbar">
	<div class="container text-center">
		<img src="assets/img/logo.png" alt=""> &nbsp; Never miss a <b>story</b> from us, get weekly updates in your inbox. <a href="#" class="btn subscribe">Get Updates</a>
	</div>
</div> -->

        <div class="container">
            <div class="footer">
                <h4 class="text-center" style="font-size:20px;margin-bottom:40px;padding:5px">
                    Copyright &copy; 2022 Tri Yatna. All rights reserved.
                </h4>
                <div class="clearfix">
                </div>
            </div>
        </div>
        <script src="<?= $domain ?>assets/js/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="<?= $domain ?>assets/js/bootstrap.min.js"></script>
        <script src="<?= $domain ?>assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="<?= $domain ?>assets/js/mediumish.js"></script>
    </body>

    </html>
<?php
}
?>