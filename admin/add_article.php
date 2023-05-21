<?php 
include "./templates/header.php";
$stmt = $conn->prepare("SELECT category_id, category_name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll();

?>
<section class="content blog-page">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>New Post</h2>
                    <ul class="breadcrumb p-l-0 p-b-0">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="blog-dashboard.html">Blog</a></li>
                        <li class="breadcrumb-item active">New Post</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <form action="./helper/insert.php?type=article" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <label for="title-content" style="margin-left: 10px;">Title</label>
                            <input type="text" class="form-control" name="title-content" autocomplete="off" placeholder="Enter Blog title" required/>
                        </div>
                        <label for="title-content" style="margin-left: 10px;">Category</label>
                        <select class="form-control show-tick" name="category" required>
                            <option hidden value="">Select Category --</option>
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
                                <input type="text" class="form-control" name="tags" data-role="tagsinput" required>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="form-group">
                            <span>Resolution 1920 x 1080</span>
                            <br>
                        <input type="file" id="input-file-now" name="mediaimg" class="dropify" accept=".jpg, .jpeg, .png" required/>
                        </div>                     
                    </div>
                </div>
                <input type="text" name="author" hidden value="2">
                <div class="card">
                    <div class="body">
                        <textarea name="content" required>
                        </textarea>
                        <button type="submit" name="submit" class="btn btn-primary btn-round waves-effect m-t-20">Submit</button>
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
                        <textarea name="subs" class="form-control" id="subs" cols="30" rows="10" placeholder="Description .."></textarea>
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
       document.getElementById("title").innerHTML = "<?= getSingleValDB('options','id','1','name')  ?> > Dashboard";
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