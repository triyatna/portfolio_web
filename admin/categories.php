<?php 
include "./templates/header.php";

// Get all Category
$stmt = $conn->prepare("SELECT * FROM `category`");
$stmt->execute();
$categories = $stmt->fetchAll();

if(post('idCat')){
    $name = test_input($_POST["nameCat"]);
    $slug = test_input(slugify($_POST["Cattname"]));
    $id = test_input($_POST["idCat"]);
    $query = mysqli_query($mysqli,"UPDATE `category` SET `category_name`='$name',`category_slug`='$slug' WHERE `category_id`=$id");
    redirect('categories.php');
} else if (post('Cattname')){
    $name = test_input($_POST["Cattname"]);
    $slug = test_input(slugify($_POST["Cattname"]));
    $query = mysqli_query($mysqli,"INSERT INTO `category`(`category_name`, `category_slug`) VALUES ('$name','$slug')");
    redirect('categories.php');
}


?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Blog</h2>
                    <ul class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="../"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ul>
                </div>            
            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                <div class="alert-editS"></div>
                    <div class="header" style="margin-bottom: 20px;">
                        <h2>List Category </h2>
                        <ul class="header-dropdown">
                            <li><button data-toggle="modal" data-target="#addCate" class="btn btn-primary">Add Category</button></li>
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
                                        <th class="col">Name</th>
                                        <th class="col">Article</th>
                                        <th class="col">Actions</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                <?php
                                $no = 0;
                        foreach ($categories as $category) :
                            echo "<tr>";
                            // Get Category for count article
                            $query = "SELECT * FROM `article` WHERE `id_categorie` = $category[category_id]";
                            $check = mysqli_query($mysqli, $query);
                            $count = mysqli_num_rows($check);
                            $no++;
                            ?>

                            <td><?= $no ?></td>
                            <td><?= $category['category_name'] ?></td>
                            <td><?= $count ?></td>
                            <td>
                            <button data-toggle="modal" data-target="#editBy_<?= $category['category_id'] ?>" class="btn bg-teal"><i class="zmdi zmdi-edit"></i></button>
                            <a href="helper/delete.php?type=category&id=<?= $category['category_id'] ?>" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></a>
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
<!-- Modal -->
<?php 
       foreach ($categories as $category) :
?>
<div class="modal fade" id="editBy_<?= $category['category_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="title" id="editModalLabel">Edit Category by ID <?= $category['category_id'] ?></h5>
      </div>
      <form action="" method="POST" >
      <div class="modal-body">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <label for="title-content" style="margin-left: 10px;">ID Category</label>
                            <input type="text" class="form-control" name="idCat" readonly value="<?= $category["category_id"] ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="title-content" style="margin-left: 10px;">Name</label>
                            <input type="text" class="form-control" name="nameCat" autocomplete="off" placeholder="Enter Category Name" value="<?= $category["category_name"] ?>"/>
                        </div>
                    </div>
                </div>
                
            </div>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
  endforeach;
   ?>
   <div class="modal fade" id="addCate" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="title" id="addModalLabel">Add Category</h5>
      </div>
      <form action="" method="POST" >
      <div class="modal-body">
      <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="form-group">
                            <label for="title-content" style="margin-left: 10px;">Name</label>
                            <input type="text" class="form-control" name="Cattname" autocomplete="off" placeholder="Enter Category Name"/>
                        </div>
                    </div>
                </div>
                
            </div>            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
       document.getElementById("category").classList.add('active');
       document.getElementById("title").innerHTML = "<?= getSingleValDB('options','id','1','name')  ?> > Blog Category";
</script>

<script src="<?= $admin ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?= $admin ?>assets/js/toastr.min.js"></script>
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