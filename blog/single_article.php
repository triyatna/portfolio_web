<?php include "assest/dbb.php"; 

?>

<?php
$article_id = $_GET['id'];



// Get Article Info
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN `author` ON `article`.id_author = `author`.author_id  WHERE `article_slug` = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

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


// Get Tags articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN `tags` WHERE `article`.`article_id`= `tags`.`article_id` AND `article`.`article_slug` = ? ORDER BY tags_id DESC");
$stmt->execute([$article_id]);
$tags = $stmt->fetchAll();


?>

<title><?= $article['article_title'] ?> - Blog</title>

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

		<div class="header-mobile">
        	<a class="header-toggle"><i class="fas fa-bars"></i></a>
        	<h2>Tri Yatna - BLOG</h2>
        </div>

		<!-- Left Block -->
		<nav class="header-main" data-simplebar>

			<!-- Logo -->
			<div class="logo">
            	<img src="img/logo.png" alt="">
            </div>

          	<ul>
				<li data-tooltip="home" data-position="top">
            		<a href="/" class="fas fa-house-damage"></a>
				</li>
				<li>
            		<span class="active fas fa-receipt"></span>
				</li>
				<li data-tooltip="back to blog" data-position="top">
            		<a href="blog-list.html" class="fas fa-long-arrow-alt-left"></a>
				</li>
          	</ul>

		 </nav>

		<!--Blog Page-->
		<div class="blog-page" data-simplebar>
			<nav class="blog-nav">
            	<a href="#" data-tooltip="prev" data-position="left">
					<i class="fas fa-long-arrow-alt-left"></i>
				</a>
            	<a href="/#blog">
					<i class="fas fa-bars"></i>
				</a>
            	<a href="#" data-tooltip="next" data-position="right">
					<i class="fas fa-long-arrow-alt-right"></i>
				</a>
            </nav>
	
			<div class="row blog-container">
				<div class="col-md-10 offset-md-1">
                <div class="blog-image pt-70 ">
				<img src="http://localhost/mypersonal/blog/img/article/<?= $article["article_image"] ?>" style="width: 700px;display: block; margin-left: auto; margin-right: auto;" alt="">
			</div>
					<!-- Heading -->
					<div class="blog-heading pt-20 pb-10">
						<h2><?= $article["article_title"] ?></h2>
						<span><i class="fas fa-home"></i><a href="#"><?= $category['category_name'] ?></a></span>
						<span><i class="fas fa-comment"></i><a href="#"><?php echo $avg_comments ?> comments</a></span>
						<span><i class="fas fa-calendar-alt"></i><?= date_format(date_create($article["article_created_time"]), "F d, Y ") ?></span>
					</div>
                    <div class="blog-heading pb-100">
                    <p>TAGS: <?php foreach ($tags as $tag) : ?>
                        <?php 
                        echo '<a href="tags/'.$tag['tags'].'" >'.$tag['tags'].',</a>';
                    endforeach; ?> all tags
                    </p>
                    </div>

					<!-- Content -->
					<div class="blog-content">
					<?= $article["article_content"] ?>
					</div>

					<!-- Comments -->
					<div class="blog-comments mt-100 mb-100">
						<div class="header-box mb-50">
							<h3>Comments</h3>
						</div>
						<ul>
							<li>
								<div class="author-img">
									<img src="http://localhost/mypersonal/assets/img/logo.png" alt="">
								</div>
								<div class="comment-text">
									<h4>Disable Comments!</h4>
									<span>Aug 15, 2022 at 8:11 am</span>
									<p>to avoid spam</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- All Script -->
		<script src="http://localhost/mypersonal/assets/js/jquery.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/isotope.pkgd.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/bootstrap.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/simplebar.js"></script>
		<script src="http://localhost/mypersonal/assets/js/owl.carousel.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/jquery.magnific-popup.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/jquery.animatedheadline.min.js"></script>
		<script src="http://localhost/mypersonal/assets/js/jquery.easypiechart.js"></script>
		<script src="http://localhost/mypersonal/assets/js/jquery.validation.js"></script>
		<script src="http://localhost/mypersonal/assets/js/tilt.js"></script>
        <script src="http://localhost/mypersonal/assets/js/main.js"></script>
        <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
		
		<script src="http://localhost/mypersonal/assets/setting/main-demo.js"></script>
		
    </body>
</html>