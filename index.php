<?php
require "core/db.php";
require "admin/helper/function.php";
// Get Latest articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id ORDER BY `article_created_time` DESC  LIMIT 6");
$stmt->execute();
$articles = $stmt->fetchAll();

// Get Categories
$stmt = $conn->prepare("SELECT *,COUNT(*) as article_count FROM `article` INNER JOIN category ON id_categorie=category_id GROUP BY id_categorie");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get Most Read Articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id order by RAND() LIMIT 4");
$stmt->execute();
$most_read_articles = $stmt->fetchAll();

// Get CV
$stmt = $conn->prepare("SELECT * FROM `document` WHERE `type`= 1");
$stmt->execute();
$get_cv = $stmt->fetchAll();

$checkAr = mysqli_query($mysqli, "SELECT * FROM `article`");
$validAr = mysqli_num_rows($checkAr);
$ip = checkmyip();
if (getCountryIP($ip) == "") {
  $country = "Tidak terdeteksi";
} else {
  $country = getCountryIP($ip);
}

if (post('name')) {
  $name = post('name');
  $email = post('email');
  $subject = post('subject');
  $phone = post('phone');
  $note = post('note');
  $unique = randomString(20);
  $color = substr(md5(rand()), 0, 6);
  $sql = "SELECT * FROM `messages` WHERE `email` = '$email'";
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
    if (getSingleValDB('messages', 'email', $email, 'avatar') == '') {
      $avatar = 'https://ui-avatars.com/api/?background=' . $color . '&color=fff&size=200&name=' . $name;
      // $avatar = 'https://avatars.abstractapi.com/v1/?api_key=0e2d4b7ae5de4248801823519c55845c&image_size=200&background_color='.$color.'&name='.$name;
      mysqli_query($mysqli, "UPDATE `messages` SET `avatar` = '$avatar' WHERE `messages`.`email`= '$email'");
    } else {
      $avatar = getSingleValDB('messages', 'email', $email, 'avatar');
    }
  } else {
    $avatar = 'https://ui-avatars.com/api/?background=' . $color . '&color=fff&size=200&name=' . $name;
    // $avatar = 'https://avatars.abstractapi.com/v1/?api_key=0e2d4b7ae5de4248801823519c55845c&image_size=200&background_color='.$color.'&name='.$name;
  }
  mysqli_query($mysqli, "INSERT INTO `messages`(`id`, `name`, `email`, `phone`, `subject`, `message`, `ip_address`, `message_date`, `status`, `msg_unique`, `avatar`, `to_by`) VALUES (NULL,'$name','$email','$phone', '$subject','$note','$ip',CURRENT_TIMESTAMP,'1','$unique','$avatar','admin')");
}
// Download CV Count DB
if (post('db')) {
  mysqli_query($db, "INSERT INTO `history` VALUES (NULL, '$ip','$browser', current_timestamp(), 'Download CV', 'true', 'Guest','$country')");
}

?>

<!DOCTYPE html>
<html class="no-js" lang="id">

<head>
  <!-- Meta -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />

  <!-- Title -->
  <title>Tri Yatna - Website Portfolio</title>

  <!-- Meta -->

  <!-- Basic TAG -->
  <meta name="keywords" content="triyatna, tri,tri,tri yatna, portfolio, blog, coding, html, personal porfolio, yatna, triyatna my" />
  <meta name="description" content="Selamat datang di website personal portfolio Tri Yatna, website ini berisi portfolio dan kumpulan blog personal dengan niche programmer, teknologi, keseharian, lifestyle, fiksi, dan lainnya. websitei ini bertujuan untuk mempermudah mengakses informasi keahlian dan juga pengalaman yang berbasis website." />
  <meta name="subject" content="Triyatna's Portfolio Personal">
  <meta name="language" content="ID, EN">
  <meta name="robots" content="index, follow">
  <meta name="Classification" content="Portfolio Personal">
  <meta name="author" content="Tri Yatna">
  <meta name="designer" content="GG2019">
  <meta name="copyright" content="TY CORP 2022">
  <meta name="owner" content="Tri Yatna">
  <meta name="category" content="Blog, Personal, Portfolio, Website Pribadi">
  <meta name="coverage" content="Worldwide">
  <meta name="distribution" content="Global">
  <meta name="rating" content="General">
  <meta name="revisit-after" content="7 days">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!--open graph meta tags for social sites and search engines-->
  <meta property="og:locale" content="id_ID" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Triyatna's Personal Portfolio Sites" />
  <meta property="og:description" content="Selamat datang di website personal portfolio Tri Yatna, website ini berisi portfolio dan kumpulan blog personal dengan niche programmer, teknologi, keseharian, lifestyle, fiksi, dan lainnya. websitei ini bertujuan untuk mempermudah mengakses informasi keahlian dan juga pengalaman yang berbasis website." />
  <meta property="og:url" content="" />
  <meta property="og:site_name" content="Tri Yatna" />
  <!-- <meta property="og:image" content="images//hom-banner-compressed.jpg" />
        <meta property="og:image:secure_url" content="images//hom-banner-compressed.jpg" /> -->
  <meta property="og:image:width" content="1200" />
  <meta property="og:image:height" content="660" />
  <!--twitter description-->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:description" content="Selamat datang di website personal portfolio Tri Yatna, website ini berisi portfolio dan kumpulan blog personal dengan niche programmer, teknologi, keseharian, lifestyle, fiksi, dan lainnya. websitei ini bertujuan untuk mempermudah mengakses informasi keahlian dan juga pengalaman yang berbasis website." />
  <meta name="twitter:title" content="Triyatna's Personal Portfolio Sites" />
  <meta name="twitter:site" content="@Triyatna" />
  <meta name="twitter:image" content="images/hom-banner-compressed.jpg" />
  <meta name="twitter:creator" content="@triyatna30" />
  <!--search engine verification-->
  <meta name="google-site-verification" content="dByf0UgzPbyK1aUN4LbR_ayEPVTQ1O1vDGf7tRzpNvQ" />
  <meta name="yandex-verification" content="" />

  <!-- Site fevicon icons -->
  <!-- <link rel="icon" href="images/icon/cropped-cropped-favicon-1-1-32x32.png" sizes="32x32" />
        <link rel="icon" href="images/icon/cropped-cropped-favicon-1-1-192x192.png" sizes="192x192" />
        <link rel="apple-touch-icon-precomposed" href="images/icon/cropped-cropped-favicon-1-1-180x180.png" />
        <meta name="msapplication-TileImage" content="images/icon/cropped-cropped-favicon-1-1-270x270.png" /> -->

  <!-- Meta's Close -->

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= $domain ?>assets/img/favicon.ico" type="image/x-icon" />

  <!-- CSS Plugins -->
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/bootstrap.min.css" />
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/magnific-popup.css" />
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/simplebar.css" />
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/owl.carousel.min.css" />
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/owl.theme.default.min.css" />
  <link rel="stylesheet" href="<?= $domain ?>assets/css/plugins/jquery.animatedheadline.css" />

  <!-- CSS Base -->
  <link rel="stylesheet" class="theme-st" href="<?= $domain ?>assets/css/style-dark.css" />

  <!-- Settings Style -->
  <link rel="stylesheet" class="pos-nav" href="<?= $domain ?>assets/css/settings/left-nav.css" />
  <link rel="stylesheet" class="box-bd" href="<?= $domain ?>assets/css/settings/box/box.css" />
  <link rel="stylesheet" class="box-st" href="<?= $domain ?>assets/css/settings/box/circle.css" />
  <link rel="stylesheet" class="box-tl" href="<?= $domain ?>assets/css/settings/title/title.css" />
  <link rel="stylesheet" class="style-cl" href="<?= $domain ?>assets/css/settings/color/green-color.css" />

  <link rel="stylesheet" href="<?= $domain ?>assets/setting/style-demo.css" />
</head>

<body>
  <!-- Preloader -->
  <div id="preloader">
    <div class="loading-area">
      <div class="circle"></div>
    </div>
    <div class="left-side"></div>
    <div class="right-side"></div>
  </div>

  <!-- Main Site -->
  <div id="home">
    <div id="about">
      <div id="resume">
        <div id="portfolio">
          <div id="blog">
            <div id="contact">
              <div class="header-mobile">
                <a class="header-toggle"><i class="fas fa-bars"></i></a>
              </div>

              <!-- Left Block -->
              <nav class="header-main" data-simplebar>
                <!-- Logo -->
                <div class="logo">
                  <img src="<?= $domain ?>assets/img/logo.png" alt="" />

                </div>
                <ul>
                  <li data-tooltip="home" data-position="top">
                    <a href="#home" class="icon-h fas fa-house-damage"></a>
                  </li>
                  <li data-tooltip="about" data-position="top">
                    <a href="#about" class="icon-a fas fa-user-tie"></a>
                  </li>
                  <li data-tooltip="resume" data-position="top">
                    <a href="#resume" class="icon-r fas fa-address-book"></a>
                  </li>
                  <li data-tooltip="portfolio" data-position="top">
                    <a href="#portfolio" class="icon-p fas fa-briefcase"></a>
                  </li>
                  <li data-tooltip="blog" data-position="top">
                    <a href="#blog" class="icon-b fas fa-receipt"></a>
                  </li>
                  <li data-tooltip="contact" data-position="bottom">
                    <a href="#contact" class="icon-c fas fa-envelope"></a>
                  </li>
                </ul>
                <div style="font-size:9px ;margin-bottom:10px" class="text-center">Copyright&#x00A9;2022<br>TY Corp<br>Allright reserved</div>
                <!-- Sound wave -->
                <a class="music-bg">
                  <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                  <p>Sound</p>
                </a>
              </nav>

              <!-- Home Section -->
              <div class="pt-home" style="
                    background-image: url('<?= $domain ?>assets/img/IMG_20210529_144603.jpg');
                  ">

                <section>
                  <!-- Banner -->
                  <div class="banner">
                    <h1>Tri Yatna</h1>
                    <p class="cd-headline rotate-1">
                      <span>I am a</span>
                      <span class="cd-words-wrapper">
                        <b class="is-visible">Developer</b>
                        <b>Businessman</b>
                        <b>Designer</b>
                        <b>Freelancer</b>
                      </span>
                    </p>
                  </div>

                  <!-- Language -->
                  <div class="lang">
                    <ul>
                      <!-- <li><a href="#" class="active">eng</a></li> -->
                      <li><a href="#">ind</a></li>
                    </ul>
                  </div>

                  <!-- Social -->
                  <div class="social">
                    <ul>
                      <!-- <li>
                          <a href="#"><i class="fab fa-facebook-f"></i></a>
                        </li> -->
                      <li>
                        <a href="https://github.com/triyatna" target="_blank"><i class="fab fa-github"></i></a>
                      </li>
                      <li>
                        <a href="https://instagram.com/triyatna_lesmana" target="_blank"><i class="fab fa-instagram"></i></a>
                      </li>
                      <li>
                        <a href="https://www.youtube.com/channel/UCs_0JIfJ3BiUPvVfWmVAH6A/" target="_blank"><i class="fab fa-youtube"></i></a>
                      </li>
                    </ul>
                  </div>

                </section>
              </div>

              <!-- About Section -->
              <div class="page pt-about" data-simplebar>
                <section class="container">
                  <!-- Section Title -->
                  <div class="header-page mt-70 mob-mt">
                    <h2>About Me</h2>
                    <span></span>
                  </div>
                  <!-- Personal Info Start -->
                  <div class="row mt-100">
                    <!-- Information Block -->
                    <div class="col-lg-12 col-sm-12">
                      <div class="info box-1">
                        <div class="row">
                          <div class="col-lg-3 col-sm-4">
                            <div class="photo">
                              <img alt="" src="<?= $domain ?>assets/img/IMG-20211005-WA0030.jpg" />
                            </div>
                          </div>
                          <div class="col-lg-9 col-sm-8">
                            <h4>Tri Yatna</h4>
                            <div class="loc">
                              <i class="fas fa-map-marked-alt"></i> Jawabarat,
                              Indonesia
                            </div>
                            <p>
                              Halo! saya Tri Yatna, seorang freelancer web yang sangat bersemangat dan kompeten dengan rekam jejak yang terbukti dalam merancang situs web, membangun jaringan, dan mengelola basis data. Selain itu saya merupakan seorang digital marketer dan SEO Analysis, dan juga seorang pengusaha tingkat awal. Saya memiliki keterampilan teknis yang kuat serta keterampilan interpersonal yang sangat baik, memungkinkan saya untuk berinteraksi dengan berbagai klien
                            </p>
                          </div>

                          <!-- Icon Info -->
                          <div class="col-lg-3 col-sm-4">
                            <div class="info-icon">
                              <i class="fas fa-award"></i>
                              <div class="desc-icon">
                                <h6>2 Years Job</h6>
                                <p>Experience</p>
                              </div>
                            </div>
                          </div>

                          <!-- Icon Info -->
                          <div class="col-lg-3 col-sm-4">
                            <div class="info-icon">
                              <i class="fas fa-certificate"></i>
                              <div class="desc-icon">
                                <h6>50+ Projects</h6>
                                <p>Completed</p>
                              </div>
                            </div>
                          </div>

                          <!-- Icon Info -->
                          <div class="col-lg-3 col-sm-4">
                            <div class="info-icon">
                              <i class="fas fa-user-astronaut"></i>
                              <div class="desc-icon">
                                <h6>Freelance</h6>
                                <p>Available</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-sm-12 pt-50">
                            <button type="button" id="downloadCV" data-loading-text="Loading..." class="btn-st downloadCV">Download CV</button>
                            <button id="loadingV" hidden class="btn-st loadingCV"><i class="fa fa-spinner fa-spin"></i> Loading ..</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Interests Row Start -->
                  <div class="row mt-100">
                    <!-- Header Block -->
                    <div class="col-md-12">
                      <div class="header-box mb-50">
                        <h3>My Interests</h3>
                      </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                      <div class="box-2">
                        <div class="row">
                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-music"></i>
                              <div class="desc-inter">
                                <h6>Music</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-route"></i>
                              <div class="desc-inter">
                                <h6>Travelling</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-camera"></i>
                              <div class="desc-inter">
                                <h6>Photography</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-film"></i>
                              <div class="desc-inter">
                                <h6>Movies</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="far fa-life-ring"></i>
                              <div class="desc-inter">
                                <h6>Badminton</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-book"></i>
                              <div class="desc-inter">
                                <h6>Books</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-gamepad"></i>
                              <div class="desc-inter">
                                <h6>Video games</h6>
                              </div>
                            </div>
                          </div>

                          <!-- Interests Item -->
                          <div class="col-lg-3 col-sm-6">
                            <div class="inter-icon">
                              <i class="fas fa-futbol"></i>
                              <div class="desc-inter">
                                <h6>Mini soccer</h6>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Service Row Start -->
                  <div class="row mt-100">
                    <!-- Header Block -->
                    <div class="col-md-12">
                      <div class="header-box mb-50">
                        <h3>Services</h3>
                      </div>
                    </div>

                    <!-- Service Item -->
                    <div class="col-lg-6 col-sm-6">
                      <div class="service box-1 mb-40">
                        <i class="fas fa-desktop"></i>
                        <h4>Design</h4>
                      </div>
                    </div>

                    <!-- Service Item -->
                    <div class="col-lg-6 col-sm-6">
                      <div class="service box-2 mb-40">
                        <i class="fas fa-cogs"></i>
                        <h4>Web Development</h4>
                      </div>
                    </div>

                    <!-- Service Item -->
                    <div class="col-lg-6 col-sm-6">
                      <div class="service box-2 mb-40">
                        <i class="fas fa-bullseye"></i>
                        <h4>SEO Analysis</h4>
                      </div>
                    </div>

                    <!-- Service Item -->
                    <div class="col-lg-6 col-sm-6">
                      <div class="service box-1 mb-40">
                        <i class="fas fa-bullhorn"></i>
                        <h4>Digital Marketer</h4>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <!-- Resume Section -->
              <div class="page pt-resume" data-simplebar>
                <section class="container">
                  <!-- Section Title -->
                  <div class="header-page mt-70 mob-mt">
                    <h2>Resume</h2>
                    <span></span>
                  </div>

                  <!-- Experience & Education Row Start -->
                  <div class="row mt-100">
                    <!-- Experience Column Start -->
                    <div class="col-lg-6 col-sm-12">
                      <!-- Header Block -->
                      <div class="header-box mb-50">
                        <h3>Experience</h3>
                      </div>

                      <div class="experience box-1">
                        <!-- Experience Item -->
                        <div class="item">
                          <div class="main">
                            <h4>Businessman</h4>
                            <p>
                              <i class="far fa-calendar-alt"></i>2017 - Now |
                              Founder of TY Corp
                            </p>
                          </div>
                          <p>
                            Menjajal di dunia wirausaha di bidang makanan, minuman, hingga bidang digital. Masih dalam tahap awal sebagai seorang pengusaha kecil, banyak untung rugi yang di dapatkan.
                          </p>
                        </div>

                        <!-- Experience Item -->
                        <div class="item">
                          <div class="main">
                            <h4>Web Development</h4>
                            <p>
                              <i class="far fa-calendar-alt"></i>2019 - 2021 |
                              Karyaped Media
                            </p>
                          </div>
                          <p>
                            Menjadi Web development di beberapa projek website bersama karyaped, hingga ±40 projek Web development yang sudah di buat, menggunakan php native, framework Laravel dan codeigniter, dan juga beberapa projek menggunakan bahasa nodejs.
                          </p>
                        </div>
                      </div>
                    </div>

                    <!-- Education Column Start -->
                    <div class="col-lg-6 col-sm-12">
                      <!-- Header Block -->
                      <div class="header-box mb-50 mob-box-mt">
                        <h3>Education</h3>
                      </div>

                      <div class="experience box-2">
                        <!-- Education Item -->
                        <div class="item">
                          <div class="main">
                            <h4>Widyatama University</h4>
                            <p>
                              <i class="far fa-calendar-alt"></i>2020 - |
                              Manajemen Business
                            </p>
                          </div>
                          <p>
                          </p>
                        </div>
                        <!-- Education Item -->
                        <div class="item">
                          <div class="main">
                            <h4>Senior High School 1 Lemahabang</h4>
                            <p>
                              <i class="far fa-calendar-alt"></i>2017-2019 |
                              Social Science
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Skills Row Start -->
                  <div class="row mt-100">
                    <!-- Header Block -->
                    <div class="col-md-12">
                      <div class="header-box mb-50">
                        <h3>Skills</h3>
                      </div>
                    </div>
                  </div>

                  <div class="box-1 skills">
                    <div class="row">
                      <div class="col-lg-6 col-sm-6">
                        <!-- Skill Item -->
                        <div class="skill-item">
                          <h4 class="progress-title">Phyton</h4>
                          <div class="progress">
                            <div class="progress-bar" style="width: 58%">
                              <div class="progress-value">58%</div>
                            </div>
                          </div>
                        </div>

                        <!-- Skill Item -->
                        <div class="skill-item">
                          <h4 class="progress-title">JS</h4>
                          <div class="progress">
                            <div class="progress-bar" style="width: 85%">
                              <div class="progress-value">85%</div>
                            </div>
                          </div>
                        </div>

                        <!-- Skill Item -->
                        <div class="skill-item">
                          <h4 class="progress-title">Ms. Office</h4>
                          <div class="progress">
                            <div class="progress-bar" style="width: 95%">
                              <div class="progress-value">95%</div>
                            </div>
                          </div>
                        </div>

                        <!-- Skill Item -->
                        <div class="skill-item">
                          <h4 class="progress-title">UI/UX designer</h4>
                          <div class="progress">
                            <div class="progress-bar" style="width: 77%">
                              <div class="progress-value">77%</div>
                            </div>
                          </div>
                        </div>
                        <!-- Skill Item -->
                        <div class="skill-item">
                          <h4 class="progress-title">SAP ERP(Certificate Skill)</h4>
                          <div class="progress">
                            <div class="progress-bar" style="width: 90%">
                              <div class="progress-value">91%</div>
                            </div>
                          </div>
                        </div>


                      </div>

                      <div class="col-lg-6 col-sm-6">
                        <div class="row">
                          <!-- Skill Item -->
                          <div class="col-lg-6 col-sm-6">
                            <div class="chart" data-percent="80" data-bar-color="#fff">
                              80%
                              <p>PHP & MySQL</p>
                            </div>
                          </div>

                          <!-- Skill Item -->
                          <div class="col-lg-6 col-sm-6">
                            <div class="chart" data-percent="82" data-bar-color="#fff">
                              82%
                              <p>Illustrator</p>
                            </div>
                          </div>

                          <!-- Skill Item -->
                          <div class="col-lg-6 col-sm-6">
                            <div class="chart" data-percent="79" data-bar-color="#fff">
                              79%
                              <p>Photoshop</p>
                            </div>
                          </div>

                          <!-- Skill Item -->
                          <div class="col-lg-6 col-sm-6">
                            <div class="chart" data-percent="67" data-bar-color="#fff">
                              67%
                              <p>NodeJS</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Work Process Row Start -->
                  <div class="row mt-100">
                    <!-- Header Block -->
                    <div class="col-md-12">
                      <div class="header-box mb-50">
                        <h3>My Working Process</h3>
                      </div>
                    </div>
                  </div>

                  <div class="box-2 work-process mb-100">
                    <div class="row">
                      <div class="col-lg-4 col-sm-12 ltr">
                        <!-- Working Process Item-->
                        <div class="single-wp width-sm process-1">
                          <p class="wp-step">01</p>
                          <h4 class="wp-title">Discuss idea</h4>
                          <p>
                            Menentukan Ide suatu projek yang akan di garap
                          </p>
                        </div>

                        <!-- Working Process Item-->
                        <div class="single-wp width-sm process-2">
                          <p class="wp-step">02</p>
                          <h4 class="wp-title">Creative concept</h4>
                          <p>
                            Mendapatkan cara dengan konsep yang kreatif
                          </p>
                        </div>
                      </div>

                      <div class="col-lg-4 hidden-sm">
                        <!-- Working Process Circle-->
                        <div class="wp-circle">
                          <h4>Working Process</h4>
                          <span class="dots top-l"></span>
                          <span class="dots bottom-l"></span>
                          <span class="dots top-r"></span>
                          <span class="dots bottom-r"></span>
                        </div>
                      </div>

                      <div class="col-lg-4 col-sm-12 rtl">
                        <!-- Working Process Item-->
                        <div class="single-wp width-sm process-3">
                          <p class="wp-step">03</p>
                          <h4 class="wp-title">Web concept</h4>
                          <p>
                            Konsepkan suatu web yang dibuat
                          </p>
                        </div>

                        <!-- Working Process Item-->
                        <div class="single-wp width-sm process-4">
                          <p class="wp-step">04</p>
                          <h4 class="wp-title">Final concept</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </div>

              <!-- Portfolio Section -->
              <div class="page pt-portfolio" data-simplebar>
                <section class="container">
                  <!-- Section Title -->
                  <div class="header-page mt-70 mob-mt">
                    <h2>Portfolio</h2>
                    <span></span>
                  </div>

                  <!-- Portfolio Filter Row Start -->
                  <div class="row mt-100">
                    <div class="col-lg-12 col-sm-12 portfolio-filter">
                      <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".brand">Brand</li>
                        <li data-filter=".design">Design</li>
                        <li data-filter=".graphic">Graphic</li>
                      </ul>
                    </div>
                  </div>

                  <!-- Portfolio Item Row Start -->
                  <div class="row portfolio-items mt-100 mb-100">
                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 graphic">
                      <figure>
                        <img alt="" src="img/portfolio/img-1.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Graphic</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-1.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 design">
                      <figure>
                        <img alt="" src="img/portfolio/img-2.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Design</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-2.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 brand">
                      <figure>
                        <img alt="" src="img/portfolio/img-3.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Graphic</p>
                          <i class="fas fa-video"></i>
                          <a class="video-link" href="https://www.youtube.com/watch?v=k_okcNVZqqI"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 graphic">
                      <figure>
                        <img alt="" src="img/portfolio/img-4.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Design</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-4.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 design">
                      <figure>
                        <img alt="" src="img/portfolio/img-5.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Design</p>
                          <i class="fas fa-video"></i>
                          <a class="video-link" href="https://www.youtube.com/watch?v=k_okcNVZqqI"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 brand">
                      <figure>
                        <img alt="" src="img/portfolio/img-6.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Brand</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-6.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 graphic">
                      <figure>
                        <img alt="" src="img/portfolio/img-7.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Brand</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-7.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 design">
                      <figure>
                        <img alt="" src="img/portfolio/img-8.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Brand</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-8.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>

                    <!-- Portfolio Item -->
                    <div class="item col-lg-4 col-sm-6 brand">
                      <figure>
                        <img alt="" src="img/portfolio/img-9.jpg" />
                        <figcaption>
                          <h3>Project Name</h3>
                          <p>Graphic</p>
                          <i class="fas fa-image"></i>
                          <a class="image-link" href="img/portfolio/img-9.jpg"></a>
                        </figcaption>
                      </figure>
                    </div>
                  </div>
                </section>
              </div>
              <!-- Blog Section -->
              <div class="page pt-blog" data-simplebar>
                <section class="container">
                  <!-- Section Title -->
                  <div class="header-page mt-70 mob-mt">
                    <h2>Blog</h2>
                    <span></span>
                  </div>

                  <!-- Blog Row Start -->
                  <div class="row blog-masonry mt-100 mb-50">
                    <!-- Blog Item -->
                    <?php foreach ($articles as $article) : ?>
                      <div class="col-lg-4 col-sm-6">
                        <div class="blog-item">
                          <div class="thumbnail">
                            <div class="card">
                              <a href="<?= $domain . 'article/' . $article['article_slug']  ?>"><img alt="" src="<?= $domain . 'assets/img/article/' . $article['article_image'] ?>" /></a>
                            </div>
                          </div>
                          <h4>
                            <a href="<?= $domain . 'article/' . $article['article_slug']  ?>"><?= $article['article_title'] ?></a>
                          </h4>
                          <ul>
                            <li><a href="#"><?= date_format(date_create($article['article_created_time']), "F d, Y ") ?></a></li>
                            <li><a href="#"><?= $article['category_name'] ?></a></li>
                          </ul>
                          <div class="blog-btn">
                            <a href="<?= $domain . 'article/' . $article['article_slug']  ?>" class="btn-st">Read More</a>
                          </div>
                        </div>
                      </div>
                    <?php endforeach;
                    ?>
                  </div>

                  <?php
                  if ($validAr < 1) {
                  ?>
                    <div class="row mt-100 mb-90">
                      <div class="col-lg-12 col-sm-12 text-center">
                        <div class="btn-st">Article Not Found!</div>
                      </div>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="row mt-100 mb-90">
                      <div class="col-lg-12 col-sm-12 text-center">
                        <a href="#" class="btn-st">My Blog</a>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                </section>
              </div>

              <!-- Contact Section -->
              <div class="page pt-contact" data-simplebar>
                <section class="container">
                  <!-- Section Title -->
                  <div class="header-page mt-70 mob-mt">
                    <h2>Contact</h2>
                    <span></span>
                  </div>

                  <!-- Form Start -->
                  <div class="row mt-100">
                    <div class="col-lg-12 col-sm-12">
                      <div class="contact-form">
                        <form method="post" class="box-1 contact-valid" id="contact-form">
                          <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <input type="text" name="name" id="name" class="form-control" placeholder="Name *" required />
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone *" required />
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <input type="email" name="email" id="email" class="form-control" placeholder="Email *" required />
                            </div>
                            <div class="col-lg-6 col-sm-12">
                              <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject *" required />
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <textarea class="form-control" name="note" id="note" placeholder="Your Message *"></textarea>
                            </div>
                            <div class="col-lg-12 col-sm-12 text-center">
                              <button type="submit" class="btn-st">
                                Send Message
                              </button>
                              <div id="loader">
                                <i class="fa fa-spinner fa-spin"></i>
                              </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                              <div class="error-messages">
                                <div id="success">
                                  <i class="far fa-check-circle"></i>Thank
                                  you, your message has been sent.
                                </div>
                                <div id="error">
                                  <i class="far fa-times-circle"></i>Error
                                  occurred while sending email. Please try
                                  again later.
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Contact Info -->
                  <div class="box-2 contact-info">
                    <div class="row">
                      <div class="col-lg-4 col-sm-12 info">
                        <i class="fas fa-paper-plane"></i>
                        <p>contact.tri@triyatna.me</p>
                        <span>Email</span>
                      </div>
                      <div class="col-lg-4 col-sm-12 info">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>41383 Jawabarat, ID</p>
                        <span>Addres</span>
                      </div>
                      <div class="col-lg-4 col-sm-12 info">
                        <i class="fas fa-phone"></i>
                        <p>+62 8953 4908 6103</p>
                        <span>Phone</span>
                      </div>
                    </div>
                  </div>
                </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- All Script -->
  <script src="<?= $domain ?>assets/js/jquery.min.js"></script>
  <script src="<?= $domain ?>assets/js/isotope.pkgd.min.js"></script>
  <script src="<?= $domain ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= $domain ?>assets/js/simplebar.js"></script>
  <script src="<?= $domain ?>assets/js/owl.carousel.min.js"></script>
  <script src="<?= $domain ?>assets/js/jquery.magnific-popup.min.js"></script>
  <script src="<?= $domain ?>assets/js/jquery.animatedheadline.min.js"></script>
  <script src="<?= $domain ?>assets/js/jquery.easypiechart.js"></script>
  <script src="<?= $domain ?>assets/js/jquery.validation.js"></script>
  <script src="<?= $domain ?>assets/js/tilt.js"></script>
  <script src="<?= $domain ?>assets/js/main.js"></script>
  <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
  <script>
    const site = "<?= $domain ?>"
    const loading = document.getElementById('loadingV');
    const download = document.getElementById('downloadCV');
    $(document).ready(function() {
      $("#downloadCV").click(function() {
        let confirm = prompt("Please confirm by typing 'YES':");
        let text;
        if (confirm == null || confirm == "") {
          alert("Cancelled success!");
        } else if (confirm != 'YES') {
          alert("Try Again! You didn't type 'YES'");
        } else {
          loading.removeAttribute("hidden");
          download.setAttribute("hidden", "true");
          setTimeout(function() {
            <?php
            foreach ($get_cv as $get) :
              if (isset($get['unique_query'])) {
            ?>
                $.get("<?= $domain ?>download.php?id=<?= $get['unique_query'] ?>&type=<?= $get['type'] ?>", function() {});
                $.post("<?= $domain ?>index.php", {
                  db: "i"
                });
                alert('Done!! Successfully Downloading CV');
            <?php
              } else {
                echo 'alert("Failed Download, CV Not Found")';
              }
            endforeach;
            ?>
            download.removeAttribute("hidden");
            loading.setAttribute("hidden", "true");
          }, 10000);
        }
      });
    });
  </script>
  <!-- Page Script -->
  <script src="<?= $domain ?>assets/js/jquery.ripples-min.js"></script>
  <script>
    $(".pt-home").ripples({
      resolution: 1000,
      dropRadius: 15,
      perturbance: 0.02,
    });

    /* -----------------------------------
	    13. Validate Contact Form
	----------------------------------- */
    if ($("#contact-form").length) {
      $("#contact-form").validate({
        rules: {
          name: {
            required: true,
            minlength: 2,
          },

          email: "required",
          phone: "required",
        },

        messages: {
          name: "Please enter your name",
          email: "Please enter your email address",
          phone: "Please enter your phone number",
        },

        submitHandler: function(form) {
          $.ajax({
            type: "POST",
            url: "",
            data: $(form).serialize(),
            success: function() {
              $("#loader").hide();
              $("#success").slideDown("slow");
              setTimeout(function() {
                $("#success").slideUp("slow");
              }, 7000);
              form.reset();
            },
            error: function() {
              $("#loader").hide();
              $("#error").slideDown("slow");
              setTimeout(function() {
                $("#error").slideUp("slow");
              }, 7000);
            },
          });
          return false;
        },
      });
    }
  </script>
  <script src="<?= $domain ?>assets/setting/main-demo.js"></script>
</body>

</html>