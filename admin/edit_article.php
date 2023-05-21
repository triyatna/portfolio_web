<?php 
include "./templates/header.php";

$article_id = $_GET["id"];

$stmt = $conn->prepare("SELECT category_id, category_name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get article Data to display
$stmt = $conn->prepare("SELECT * FROM `article` WHERE article_id = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN `category` WHERE `article`.`id_categorie`= `category`.`category_id` AND `article`.`article_id` = ? ORDER BY category_id DESC");
$stmt->execute([$article_id]);
$viewcate = $stmt->fetch();

if(post('imgbefore')){
   unlink("../assets/img/article/".$_POST['imgbefore']);
   mysqli_query($mysqli, "UPDATE `article` SET `article_image` = '' WHERE `article_id` = $article_id");
   redirect("edit_article.php?id=".$article_id);
}
?>
<section class="content blog-page">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>New Post</h2>
                    <ul class="breadcrumb p-l-0 p-b-0">
                        <li class="breadcrumb-item"><a href="<?=$domain?>"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?=$domain?>admin/blog.php">Blog</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" enctype="multipart/form-data">
                    <?php if($article["article_image"]!=""){
                    ?>
                <div class="card">
                    <div class="body">
                        <div class="body mb-2 text-center"><strong>Preview Image</strong></div>
                    <img src="<?= $domain.'assets/img/article/'.$article["article_image"] ?>" alt="Cover Article" class="mt-2 mb-2" style="height:200px;display:block;margin-left:auto;margin-right:auto;border-radius:10px">
                    <input type="text" name="imgbefore" value="<?=$article["article_image"]?>" hidden>    
                    <button type="submit" class="btn btn-danger mt-2 text-center">Delete</button>
                </div>
                </div>
                <?php 
                    }
                    ?>
                </form>
            <form action="./helper/update.php?type=article&id=<?= $article_id ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <label for="title-content" style="margin-left: 10px;">Title</label>
                            <input type="text" class="form-control" name="title-content" placeholder="Enter Blog title" value="<?= $article["article_title"] ?>" required/>
                        </div>
                        <input type="text" name="img" value="<?=$article["article_image"]?>" hidden>
                        <label for="title-content" style="margin-left: 10px;">Category</label>
                        <select class="form-control show-tick" name="category" required>
                            <option hidden value="<?= $viewcate['category_id'] ?>"><?= $viewcate['category_name'] ?></option>
                            <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="card">
                    <div class="header">
                    <label for="title-content" style="margin-left: 10px;">Tags</label>
                    </div>
                    <div class="body">
                        <div class="form-group demo-tagsinput-area m-b-0">
                            <div class="form-line">
                                <input type="text" class="form-control" name="tags" data-role="tagsinput" value="<?= $article["tags"] ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="row">
                    <div class="col">
                    <div class="form-group">
                    <span>Resolution 1920 x 1080</span>
                            <br>
                        <input type="file" id="input-file-now" name="mediaimg" id="mediaimg" class="dropify" accept=".jpg, .jpeg, .png" value="<?= $article["article_image"] ?>"/>
                        </div>  
                     </div>
                     <?php if($article["article_image"]!=""){
                    ?>
                        <div class="col" >
                            <img src="<?= $domain.'assets/img/article/'.$article["article_image"] ?>" alt="Cover Article">
                    </div>
                    <?php 
                    }
                    ?>
                    </div>             
                    </div>
                </div>
                <input type="text" name="author" hidden value="2">
                <div class="card">
                    <div class="body">
                        <textarea name="content" id="content" required>
                            <?= $article["article_content"] ?>
                        </textarea>
                        <button type="submit" name="update" class="btn btn-primary btn-round waves-effect m-t-20">Post</button>
                        <button onclick="history.back()" class="btn btn-danger btn-round waves-effect m-t-20">Cancel</button>
                    </div>
                </div>
                <div class="header">
                        <h4> <strong>SEO</strong> Input</h4>
                    </div>
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <label for="subs">Description</label>
                        <textarea name="subs" class="form-control" id="subs" cols="30" rows="10" placeholder="Description .." maxlength="160"><?= $article["article_desc"] ?></textarea>
                        </div>
                    </div>
                </div>
                </form>
            </div>            
        </div>
    </div>
</section>
<script>
       document.getElementById("blog-list").classList.add('active');
       document.getElementById("title").innerHTML = "<?= getSingleValDB('options','id','1','name')  ?> > Edit Article";
</script>
<!-- Jquery Core Js --> 
<script src="<?= $domain ?>assets/js/jquery.min.js"></script>
<script src="<?= $admin ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="<?= $admin ?>assets/js/dropify/dist/js/dropify.min.js"></script>
<script src="<?= $admin ?>assets/js/form-file-upload-data.js"></script>
<script src="<?= $admin ?>assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
<script src="<?= $admin ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script>
    $(function () {
  //CKEditor
  CKEDITOR.replace("content");
  CKEDITOR.config.height = 300;
  CKEDITOR.instances['content'].on('key', function(e) {
    var self = this;
    $('#subs').val(self.getData().replace(/<[^>]*>/g, '').replace(/(?:\r\n|\r|\n)/g, ' ').substr(0, 160));
  })
});
</script>
</body>
</html>
