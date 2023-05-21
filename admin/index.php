
<?php 
include "./templates/header.php";

// Get Messages
$stmt = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=?");
$stmt->execute([$_SESSION['username']]);
$messages = $stmt->fetchAll();

?>

<!-- Main Content -->
<section class="content home">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Main</h2>
                    <ul class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="../"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>            
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-3 col-md-6">
                <div class="card text-center">
                    <div class="body">
                        <p class="m-b-20"><i class="zmdi zmdi-assignment-account zmdi-hc-3x col-amber"></i></p>
                        <span>View CV</span>
                        <h3 class="m-b-10"><span class="number count-to" data-from="0" data-to="<?= $count -> DBwhere('history','view_cv','true')?>" data-speed="2000" data-fresh-interval="700"><?= $count -> DBwhere('history','view_cv','true')?></span></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-center">
                    <div class="body">
                        <p class="m-b-20"><i class="zmdi zmdi-comments zmdi-hc-3x col-blue"></i></p>
                        <span>Messages</span>
                        <h3 class="m-b-10 number count-to" data-from="0" data-to="<?= $count -> DBwhere('messages')?>" data-speed="2000" data-fresh-interval="700"><?= $count -> DBwhere('messages')?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-center">
                    <div class="body">
                        <p class="m-b-20"><i class="zmdi zmdi-time zmdi-hc-3x col-blue"></i></p>
                        <span>History</span>
                        <h3 class="m-b-10 number count-to" data-from="0" data-to="<?= $count -> DBwhere('history','view_cv','false')?>" data-speed="2000" data-fresh-interval="700"><?= $count -> DBwhere('history','view_cv','false')?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card text-center">
                    <div class="body">
                        <p class="m-b-20"><i class="zmdi zmdi-archive zmdi-hc-3x col-blue"></i></p>
                        <span>Article</span>
                        <h3 class="m-b-10 number count-to" data-from="0" data-to="<?= $count -> DBwhere('article','id_author',2)?>" data-speed="2000" data-fresh-interval="700"><?= $count -> DBwhere('history','view_cv','false')?></h3>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Support</strong> & Ticket List</h2>
                        <ul class="header-dropdown">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Messages</th>
                                        <th>IP Addr</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                                
                                <tbody>
                                <?php foreach ($messages as $message) : ?>
                                    <tr>
                                        <td><?= $message['id'] ?></td>
                                        <td><?= $message['name'] ?></td>
                                        <td><?= $message['email'] ?></td>
                                        <td><?= $message['phone'] ?></td>
                                        <td><?php
                                        if(strlen($message['message']) > 25) {
                                            echo substr($message['message'], 0, 25) . '...';
                                        } else {
                                            echo $message['message'];
                                        }
                                        ?></td>
                                        <td><?= $message['ip_address'] ?></td>
                                        <td><?= $message['message_date'] ?></td>
                                        <td><?php
                                        if($message['status'] == 1){
                                            echo '<span class="badge badge-info">PENDING</span>';
                                        }else if($message['status'] == 2){
                                            echo '<span class="badge badge-warning">NEW</span>';
                                        } else {
                                            echo '<span class="badge badge-success">COMPLETE</span>';
                                        }
                                        ?></td>
                                        <td>
                                            <button onclick="window.location.href='inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>'" class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="VIEW"><i class="zmdi zmdi-eye"></i></button>
                                            <button class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="REMOVE"><i class="zmdi zmdi-delete"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>
<script>
       document.getElementById("dashboard").classList.add('active');
       document.getElementById("title").innerHTML = "<?= getSingleValDB('options','id','1','name')  ?> > Dashboard";
</script>
<!-- Jquery Core Js -->
<script src="<?= $admin ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="<?= $admin ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="<?= $admin ?>assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="<?= $admin ?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?= $admin ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= $admin ?>assets/bundles/mainscripts.bundle.js"></script>

</body>
</html>