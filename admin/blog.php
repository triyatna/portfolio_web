<?php 
include "./templates/header.php";

// Get all Articles Data
$stmt = $conn->prepare("SELECT * FROM article, author, category WHERE id_categorie = category_id AND author_id = id_author ORDER BY article_id DESC");
$stmt->execute();
$data = $stmt->fetchAll();

?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Blog</h2>
                    <ul class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="../"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item active">Post</li>
                    </ul>
                </div>            
            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>List Post</h2>
                        <ul class="header-dropdown">
                            <li><a href="add_article.php" class="btn btn-primary">New Post</a></li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Tags</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                <?php  foreach ($data as $row) :
                            echo "<tr>";
                            ?>

                            <td><?= $row['article_id'] ?></td>
                            <td><?= $row['article_title'] ?></td>
                            <td class="text-break"><?php
                            if (strlen($row['article_desc']) > 40) {
                                echo strip_tags(substr($row['article_desc'], 0, 40)) . " ...";
                            } else {
                                echo $row['article_desc'];
                            }?></td>
                            <td><img src="<?= $domain.'assets/img/article/'.$row['article_image'] ?>" style="width: 100px; height: auto;"></td>
                            <td><?= $row['article_created_time'] ?></td>
                            <td><?= $row['article_updated_at'] ?></td>
                            <td><?= $row['category_name'] ?></td>
                            <td><?= $row['author_fullname'] ?></td>
                            <td><?php 
                            if($row['tags']==''){
                                echo "<span class='badge badge-danger'>No Tags!</span>";
                            } else {
                                echo $row['tags'];
                            }
                             ?></td>
                            <td>
                                <div class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle btn btn-primary" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-library"></i> </a>
                                <ul class="dropdown-menu slideUp">
                                    <li><a href="<?= $domain.'article/'.$row['article_slug'] ?> " target="_blank">View</a></li>
                                    <li><a href="edit_article.php?id=<?= $row['article_id'] ?> ">Edit</a></li>
                                    <li><a href="<?= $admin ?>/helper/delete.php?type=article&id=<?= $row['article_id']?>">Delete</a></li>
                                </ul>
                            </div>
                            </td>
                        <?php
                            echo "</tr>";
                        endforeach;
                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples --> 
    </div>
</section>

<script>
       document.getElementById("blog-list").classList.add('active');
       document.getElementById("title").innerHTML = "<?= getSingleValDB('options','id','1','name')  ?> > Article";
</script>
<!-- Jquery Core Js --> 
<script src="<?= $admin ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- Jquery DataTable Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= $admin ?>assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= $admin ?>assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?= $admin ?>assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?= $admin ?>assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?= $admin ?>assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?= $admin ?>assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js --> 
<script src="<?= $admin ?>assets/js/pages/tables/jquery-datatable.js"></script>
</body>
</html>