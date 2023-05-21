<?php
include "./templates/header.php";

// Get Messages
$stmt = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=? AND `type`='0' ORDER BY `message_date` DESC");
$stmt->execute([$_SESSION['username']]);
$messages = $stmt->fetchAll();
$tr = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=? AND `type`='1' ORDER BY `message_date` DESC");
$tr->execute([$_SESSION['username']]);
$trash = $tr->fetchAll();
$se = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=? AND `type`='2' ORDER BY `message_date` DESC");
$se->execute([$_SESSION['username']]);
$sent = $se->fetchAll();
$dr = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=? AND `type`='3' ORDER BY `message_date` DESC");
$dr->execute([$_SESSION['username']]);
$draft = $dr->fetchAll();

$stmt = $conn->prepare("SELECT * FROM `messages` WHERE `to_by`=? LIMIT 10");
$stmt->execute([$_SESSION['username']]);
$msglimit = $stmt->fetchAll();



?>

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/logo.svg" width="48" height="48" alt="Alpino"></div>
        <p>Please wait...</p>
    </div>
</div>

<div class="overlay"></div>

<?php
include "./templates/mini_sidebar.php";
?>

<aside class="right_menu">
    <div id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info m-b-20">
                        <div class="image">
                            <a><img src="<?= $admin . '/assets/images/' . getSingleValDB('users', 'username', $_SESSION['username'], 'avatar') ?>" alt="User" style="width: 100px;height:100px"></a>
                        </div>
                        <div class="detail">
                            <h6><?= $_SESSION['username'] ?></h6>
                            <p class="m-b-0"><?= getSingleValDB('users', 'username', $_SESSION['username'], 'email') ?></p>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-facebook-box"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-linkedin-box"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-instagram"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-twitter-box"></i></a>
                        </div>
                    </div>
                </li>
                <li><a href="./"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                <?php
                if (get('data') == 'messages') {
                    echo '<li class="active open"><a href="inbox.php?data=messages"><i class="zmdi zmdi-inbox"></i><span>Inbox</span>';
                    if ($count->DBwhereand('messages', 'type', '0', 'status', '1')  > 0) {
                        echo '<span class="badge badge-success float-right">' . $count->DBwhereand('messages', 'type', '0', 'status', '1') . '</span></a></li>';
                    }
                } else {
                    echo '<li><a href="inbox.php?data=messages"><i class="zmdi zmdi-inbox"></i><span>Inbox</span>';
                    if ($count->DBwhereand('messages', 'type', '0', 'status', '1')  > 0) {
                        echo '<span class="badge badge-success float-right">' . $count->DBwhereand('messages', 'type', '0', 'status', '1')  . '</span></a></li>';
                    }
                }

                if (get('data') == 'compose') {
                    echo '<li class="active open"><a href="inbox.php?data=compose" ><i class="zmdi zmdi-plus-circle"></i><span>Compose Mail</span></a></li>';
                } else {
                    echo '<li><a href="inbox.php?data=compose" ><i class="zmdi zmdi-plus-circle"></i><span>Compose Mail</span></a></li>';
                }
                if (get('data') == 'sent') {
                    echo '<li class="active open"><a href="inbox.php?data=sent" ><i class="zmdi zmdi-mail-send"></i><span>Sent</span></a></li>';
                } else {
                    echo '<li><a href="inbox.php?data=sent" ><i class="zmdi zmdi-mail-send"></i><span>Sent</span></a></li>';
                }

                if (get('data') == 'draft') {
                    echo '<li class="active open"><a href="inbox.php?data=draft" ><i class="zmdi zmdi-file"></i><span>Draft</span></a></li>';
                } else {
                    echo '<li><a href="inbox.php?data=draft" ><i class="zmdi zmdi-file"></i><span>Draft</span></a></li>';
                }
                if (get('data') == 'trash') {
                    echo '<li class="active open"><a href="inbox.php?data=trash" ><i class="zmdi zmdi-delete"></i><span>Trash</span></a></li>';
                } else {
                    echo '<li><a href="inbox.php?data=trash" ><i class="zmdi zmdi-delete"></i><span>Trash</span></a></li>';
                }


                ?>
            </ul>
        </div>
    </div>
</aside>
<?php

if (get('data') == 'messages') {
?>
    <section class="content inbox">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Inbox</h2>
                        <ul class="breadcrumb p-l-0 p-b-0 ">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs padding-0">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Primary">Primary</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#All">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="Primary">
                            <div class="card">
                                <?php
                                if ($count->DBwhere('messages', 'type', '0') > 0) {
                                    if ($count->DBmorethan('messages', 'message_date', date('Y-m-d H:i:s', strtotime('-24 hours'))) > 0) {
                                ?>
                                        <div class="header">
                                            <h2><strong>Today</strong></h2>
                                            <ul class="header-dropdown">
                                                <li><a href="javascript:void(0);"><i class="zmdi zmdi-delete"></i></a></li>
                                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                                    <ul class="dropdown-menu slideUp">
                                                        <li><a href="javascript:void(0);">Select All</a></li>
                                                        <li><a href="javascript:void(0);">Another action</a></li>
                                                        <li><a href="javascript:void(0);">Something else</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="body">
                                            <ul class="list-unstyled mail_list">
                                                <?php

                                                foreach ($messages
                                                    as $message) :

                                                    if (strtotime(date('Y-m-d H:i:s', strtotime('-24 hours'))) < strtotime($message['message_date'])) {
                                                        if ($message['status'] == 1) {
                                                            echo '<li class="media unread">';
                                                        } else if ($message['status'] == 2) {
                                                            echo '<li class="media">';
                                                        }
                                                ?>
                                                        <div class="controls">
                                                            <div class="checkbox">
                                                                <input type="checkbox" id="basic_checkbox_<?= $message['id'] ?>">
                                                                <label for="basic_checkbox_<?= $message['id'] ?>"></label>
                                                            </div>
                                                            <?php
                                                            if ($message['status'] == 1) {
                                                                echo '<a href="javascript:void(0);" class="favourite text-muted"><i class="zmdi zmdi-star-outline"></i></a>';
                                                            } else if ($message['status'] == 2) {
                                                                echo '<a href="javascript:void(0);" class="favourite col-amber"><i class="zmdi zmdi-star"></i></a>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="thumb"> <img src="<?= $message['avatar'] ?>" class="rounded-circle" alt=""> </div>
                                                            <div class="media-heading">
                                                                <a href="inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>"><?= $message['name'] ?></a>
                                                                <small class="float-right text-muted"><?php
                                                                                                        $datenow2 = new DateTime($message['message_date']);
                                                                                                        if (date('d M') == $datenow2->format('d M')) {
                                                                                                            echo '<span class="badge badge-success">New</span>';
                                                                                                        } else {
                                                                                                            echo $datenow2->format('d M');
                                                                                                        }
                                                                                                        ?></small>
                                                            </div>
                                                            <p class="msg"><span class="m-r-10">[<?= $message['email'] ?>]</span><?= $message['message'] ?></p>
                                                        </div>
                                                        </li>
                                                <?php
                                                    }

                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                }
                                if ($count->DBwhere('messages', 'type', '0') > 0) {
                                    if ($count->DBmorethan('messages', 'message_date', date('Y-m-d H:i:s', strtotime('-7 day'))) > 0) {

                                    ?>
                                        <div class="header">
                                            <h2><strong>Yesterday</strong></h2>
                                        </div>
                                        <div class="body">
                                            <ul class="list-unstyled mail_list">
                                                <?php
                                                foreach ($messages as $message) :
                                                    if (strtotime(date('Y-m-d H:i:s', strtotime('-7 day'))) <= strtotime($message['message_date'])) {
                                                        if (strtotime(date('Y-m-d H:i:s', strtotime('-24 hours'))) < strtotime($message['message_date'])) {
                                                        } else {

                                                            if ($message['status'] == 1) {
                                                                echo '<li class="media unread">';
                                                            } else if ($message['status'] == 2) {
                                                                echo '<li class="media">';
                                                            }
                                                ?>
                                                            <div class="controls">
                                                                <div class="checkbox">
                                                                    <input type="checkbox" id="basic_checkbox_<?= $message['id'] ?>">
                                                                    <label for="basic_checkbox_<?= $message['id'] ?>"></label>
                                                                </div>
                                                                <?php
                                                                if ($message['status'] == 1) {
                                                                    echo '<a href="javascript:void(0);" class="favourite text-muted"><i class="zmdi zmdi-star-outline"></i></a>';
                                                                } else if ($message['status'] == 2) {
                                                                    echo '<a href="javascript:void(0);" class="favourite col-amber"><i class="zmdi zmdi-star"></i></a>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="thumb"> <img src="<?= $message['avatar'] ?>" class="rounded-circle" alt=""> </div>
                                                                <div class="media-heading">
                                                                    <a href="inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>"><?= $message['name'] ?></a>
                                                                    <small class="float-right text-muted"><?php
                                                                                                            $datenow2 = new DateTime($message['message_date']);
                                                                                                            echo $datenow2->format('d M')
                                                                                                            ?></small>
                                                                </div>
                                                                <p class="msg"><span class="m-r-10">[<?= $message['email'] ?>]</span><?= $message['message'] ?></p>
                                                            </div>
                                                            </li>
                                                <?php
                                                        }
                                                    }
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php
                                    }
                                }
                                if ($count->DBwhere('messages', 'type', '0') > 0) {
                                    if ($count->DBlessthan('messages', 'message_date', $day = date('Y-m-d H:i:s', strtotime('-7 day'))) > 0) {

                                    ?>
                                        <div class="header">
                                            <h2><strong>Week</strong> Ago</h2>
                                        </div>
                                        <div class="body">
                                            <ul class="list-unstyled mail_list">
                                                <div id="list">
                                                    <div class="wrapper mb-3"></div>
                                                </div>
                                            </ul>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="All">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>All</strong></h2>
                                    <ul class="header-dropdown">
                                        <li><a href="javascript:void(0);" class="btn btn-danger"><i class="zmdi zmdi-delete"> Delete All</i></a></li>
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
                                                <?php
                                                $id = 1;
                                                foreach ($messages as $message) :
                                                ?>
                                                    <tr>
                                                        <td><?= $id++ ?></td>
                                                        <td><?= $message['name'] ?></td>
                                                        <td><?= $message['email'] ?></td>
                                                        <td><?= $message['phone'] ?></td>
                                                        <td><?php
                                                            if (strlen($message['message']) > 25) {
                                                                echo substr($message['message'], 0, 25) . '...';
                                                            } else {
                                                                echo $message['message'];
                                                            }
                                                            ?></td>
                                                        <td><?= $message['ip_address'] ?></td>
                                                        <td><?= $message['message_date'] ?></td>
                                                        <td><?php
                                                            if ($message['status'] == 2) {
                                                                echo '<span class="badge badge-info">READ</span>';
                                                            } else if ($message['status'] == 1) {
                                                                echo '<span class="badge badge-success">UNREAD</span>';
                                                            }
                                                            ?></td>
                                                        <td>
                                                            <button onclick="window.location.href='inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>'" class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="VIEW"><i class="zmdi zmdi-eye"></i></button>
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="REMOVE"><i class="zmdi zmdi-delete"></i></button>
                                                        </td>
                                                    </tr>

                                                <?php
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
    <link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css" />

    <script>
        <?php

        $sql = "SELECT * FROM `messages` WHERE `type`= '0' ORDER BY `message_date` DESC"; //script sql select data
        $result = mysqli_query($mysqli, $sql); //melakukan query
        ?>
        var json = {
            "week": [

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    if (strtotime(date('Y-m-d H:i:s', strtotime('-7 day'))) > strtotime($row['message_date'])) {
                        $datenow2 = new DateTime($row['message_date']);
                ?> {
                            "id": '<?= $row['id'] ?>',
                            "name": "<?= $row['name'] ?>",
                            "email": "<?= $row['email'] ?>",
                            "phone": "<?= $row['phone'] ?>",
                            "message": "<?= str_replace(array("\r\n", "\r", "\n", '\r', '\n'), ' ', $row['message']) ?>",
                            "ip": "<?= $row['ip_address'] ?>",
                            "date": "<?= $datenow2->format('d M') ?>",
                            "status": "<?= $row['status'] ?>",
                            "avatar": "<?= $row['avatar'] ?>",
                            "link": "inbox.php?type=view&inbox=<?= $row['msg_unique'] ?>&unique_id=<?= $row['id'] ?>",
                        },
                <?php }
                } ?>

            ]

        }

        $('#list').pagination({ // you call the plugin
            dataSource: json.week, // pass all the data
            pageSize: 5, // put how many items per page you want
            showPageNumbers: false,
            showNavigator: true,
            callback: function(data, pagination) {
                // that you need to display
                var wrapper = $('#list .wrapper').empty();
                $.each(data, function(i, f) {
                    var mediactrl = f.status == 1 ? '<li class="media unread">' : f.status == 2 ? '<li class="media">' : '';
                    $('#list .wrapper').append(
                        mediactrl + `<div class="controls">
                              <div class="checkbox">
                                         <input type="checkbox" id="basic_checkbox_` + f.id + `">
                                                <label for="basic_checkbox_` + f.id + `"></label>
                                            </div>
                                            <a href="javascript:void(0);" class="favourite text-muted"><i class="zmdi zmdi-star-outline"></i></a>
                                            </div>                                        
                                        <div class="media-body">
                                            <div class="thumb"> <img src="` + f.avatar + `" class="rounded-circle" alt=""> </div>
                                            <div class="media-heading">
                                                <a href="#" onclick="readMSG('` + f.id + `','` + f.link + `')">` + f.name + `</a>
                                                <small class="float-right text-muted">` + f.date + `</small>
                                            </div>
                                            <p class="msg"><span class="m-r-10">[` + f.email + `]</span>` + f.message + `</p>                                
                                        </div>
                                    </li>`);
                });
            }
        });
    </script>

    <script>
        document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> > Inbox";

        function readMSG(id, link) {
            $.post("./helper/update.php?type=messages&id=" + id, {
                update: 'yes'
            }, function(data) {
                window.location.href = link;
            });
        }
    </script>
    <?php
} else if (get('type') == 'view') {
    $inbox = get('inbox');
    $id = get('unique_id');
    if (get('inbox') == $inbox && get('unique_id') == $id) {
        $sql = "SELECT * FROM `messages` WHERE `msg_unique` = '$inbox' AND `id` = '$id'"; //script sql select data
        $ins = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($ins) > 0) {
            $mail = mysqli_fetch_assoc($ins);
    ?>
            <section class="content message">
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <h2>View Messages</h2>
                                <ul class="breadcrumb p-l-0 p-b-0 ">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                                    <li class="breadcrumb-item active">View Messages</li>
                                </ul>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="input-group m-b-0">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="header mb-4">
                                    <ul class="header-dropdown">
                                        <li><a href="javascript:void(0);" title="Reply"><i class="zmdi zmdi-mail-reply m-r-5"></i></a></li>
                                        <li class="dropdown" title="More"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="javascript:void(0);">Delete this Message</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body mb-2">
                                    <h6><?= $mail['subject'] ?></h6>
                                </div>
                                <div class="body">
                                    <div class="media margin-0">
                                        <div class="float-left">
                                            <div class="m-r-20"> <img class="rounded" src=" <?= $mail['avatar'] ?>" width="60" alt=""> </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="m-b-0">
                                                <strong class="text-muted m-r-5">From:</strong>
                                                <a href="javascript:void(0);" class="text-default"><?= $mail['name'] ?> [<?= $mail['email'] ?>]</a>
                                            </p>
                                            <p class="m-b-0">
                                                <strong class="text-muted m-r-10">To:</strong>Me
                                            </p>
                                            <small class="float-right text-muted"><?php
                                                                                    $datenow2 = new DateTime($mail['message_date']);
                                                                                    echo $datenow2->format('M d, Y H:i A') . '  (' . cekDate($mail['message_date']) . ')';
                                                                                    ?></small>
                                        </div>
                                    </div>
                                    <p><?= $mail['message'] ?></p>
                                    <hr>
                                    <div class="media margin-0">
                                        <div class="float-left">
                                            <div class="m-r-20"> <img class="rounded" src=" <?= $mail['avatar'] ?>" width="60" alt=""> </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="m-b-0">
                                                <strong class="text-muted m-r-5">From:</strong>
                                                <a href="javascript:void(0);" class="text-default"><?= $mail['name'] ?> [<?= $mail['email'] ?>]</a>
                                            </p>
                                            <p class="m-b-0">
                                                <strong class="text-muted m-r-10">To:</strong>Me
                                            </p>
                                            <small class="float-right text-muted"><?php
                                                                                    $datenow2 = new DateTime($mail['message_date']);
                                                                                    echo $datenow2->format('M d, Y H:i A') . '  (' . cekDate($mail['message_date']) . ')';
                                                                                    ?></small>
                                        </div>
                                    </div>
                                    <p><?= $mail['message'] ?></p>
                                </div>
                                <div class="mt-3 btn-btnan">
                                    <a href="javascript:reply();">
                                        <div class="btn btn-home"><i class="zmdi zmdi-mail-reply m-r-5"></i> Reply</div>
                                    </a>
                                </div>


                                <div class="card reply-compose d-none mt-3">
                                    <!-- <form method="post" enctype="multipart/form-data"> -->
                                    <div class="body">
                                        <div class="ml-2 mb-4"><i class="zmdi zmdi-mail-reply m-r-5"></i> <?= $mail['name'] ?> [<?= $mail['email'] ?>]</div>
                                        <input type="text" class="form-control" placeholder="To:" name="to" value="<?= $mail['email'] ?>" hidden>
                                        <input type="text" class="form-control" placeholder="Subject:" name="subject" value="Re: <?= $mail['subject'] ?>" hidden>
                                        <input type="text" class="form-control" placeholder="To:" name="cc" value="triyatna.my@gmail.com" hidden>
                                        <textarea id="ckeditor" name="message">
                        </textarea>
                                        <button type="submit" onclick="sendMSG('<?= $mail['email'] ?>','<?= $mail['subject'] ?>','<?= $mail['msg_unique'] ?>','<?= $mail['name'] ?>','<?= $mail['phone'] ?>')" class="btn btn-primary btn-round waves-effect m-t-20">Send</button>
                                    </div>
                                    <!-- </form> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="<?= $admin ?>assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
            <script src="<?= $admin ?>assets/js/pages/forms/editortext.js"></script>
            <script>
                document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> | Inbox > Compose";
            </script>
            <script>
                function sendMSG(mail, subj, unique, name, phone) {
                    var text = CKEDITOR.instances['ckeditor'].getData();
                    $.ajax({
                        url: "./helper/_inbox.php?type=mail&query=reply",
                        type: "post",
                        data: {
                            to: mail,
                            subject: subj,
                            text: text,
                            unique: unique,
                            name: name,
                            phone: phone
                        },
                        success: function(d) {
                            setTimeout(function() {
                                swal({
                                        title: "Success!",
                                        text: "Message has been sent!",
                                        type: "success",
                                        showCancelButton: false,
                                    },
                                    function() {
                                        location.reload();
                                    }
                                );
                            }, 2000);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            setTimeout(function() {
                                swal({
                                        title: "Error!",
                                        text: "Request Error!",
                                        type: "error",
                                        showCancelButton: false,
                                    },
                                    function() {
                                        location.reload();
                                    }
                                );
                            }, 2000);
                        },
                    });

                }

                function reply() {
                    $('.reply-compose').removeClass('d-none');
                    $('.btn-btnan').addClass('d-none');
                }
            </script>
    <?php
        }
    }
} else if (get('data') == 'compose') {
    ?>
    <section class="content inbox-msg">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Compose</h2>
                        <ul class="breadcrumb p-l-0 p-b-0 ">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                            <li class="breadcrumb-item active">Compose</li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="input-group m-b-0">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <form method="post" enctype="multipart/form-data">
                            <div class="body m-b-10">
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="To:" name="to">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Subject" name="subject">
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="CC" value="triyatna.my@gmail.com" name="cc">
                                </div>
                            </div>
                            <div class="body">
                                <textarea id="ckeditor" name="message">
                        </textarea>
                                <button type="submit" class="btn btn-primary btn-round waves-effect m-t-20">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="<?= $admin ?>assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
    <script src="<?= $admin ?>assets/js/pages/forms/editortext.js"></script>
    <script>
        document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> | Inbox > Compose";
    </script>
<?php
} else if (get('data') == 'trash') {
?>
    <section class="content inbox-trash">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Trash</h2>
                        <ul class="breadcrumb p-l-0 p-b-0 ">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                            <li class="breadcrumb-item active">Trash</li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="input-group m-b-0">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!-- -->
                            <ul class="header-dropdown">
                                <li title="Delete Forever" class="btn-trash d-none"><a href="javascript:deleteItem();">Delete Forever</a></li>
                                <li> <input type="checkbox" class="checkbox_all" id="checkbox_all">
                                    <label for="checkbox_all"></label>
                                </li>
                                <li title="Refresh"><a href="javascript:location.reload();;"><i class="zmdi zmdi-replay"></i></a></li>
                                <li class="dropdown" title="More"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:changeReadUnread('all','2');">Mark all as read</a></li>
                                        <li class="text-hidden">
                                            <div class="container p-10" style="color:#b0acac;cursor:default;-khtml-user-select:none; -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none; -o-user-select:none; user-select:none;">
                                                <i>Select message to see more actions</i>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if ($count->DBwhere('messages', 'type', '1') > 0) {
                        echo '<div class="alert alert-success rounded text-center" style="background:#e6e6e6;color:#403e3e">
                        Messages that have been in Trash more than <strong>30 days </strong>will be automatically deleted. <a href="#" onclick="DeleteAll()" style="color:#1A73EA;margin-left:11px"><b>Empty Trash now</b></a>
                    </div><ul class="list-group mail-list" ><div id="list" >
                        <div class="wrapper mb-2"></div>
                    </div></ul>';
                    } else {
                        echo '<div class="alert alert-success rounded text-center" style="background:#e6e6e6;color:#403e3e">
                            Messages that have been in Trash more than <strong>30 days </strong>will be automatically deleted.
                        </div><ul class="list-group mail-list"><p class="text-center">No conversations in Trash.</p><hr style="width:100%;margin-top:-10px"></ul>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
    <link rel="stylesheet" href="https://pagination.js.org/dist/2.1.4/pagination.css" />
    <script>
        document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> | Inbox > Trash";
    </script>
    <?php
    if ($count->DBwhere('messages', 'type', '1') > 0) {

    ?>
        <script>
            <?php
            $sql = "SELECT * FROM `messages` WHERE `type`= '1' ORDER BY `message_date` DESC"; //script sql select data
            $result = mysqli_query($mysqli, $sql); //melakukan query
            ?>
            var json = {
                "trash": [
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {

                        $datenow2 = new DateTime($row['message_date']);
                    ?> {
                            "id": '<?= $row['id'] ?>',
                            "name": "<?= substr($row['name'], 0, 15) ?>",
                            "email": "<?= $row['email'] ?>",
                            "phone": "<?= $row['phone'] ?>",
                            "message": "<?= substr(str_replace(array("\r\n", "\r", "\n", '\r', '\n'), ' ', $row['message']), -30) ?>",
                            "ip": "<?= $row['ip_address'] ?>",
                            "date": "<?= $datenow2->format('M d') ?>",
                            "status": "<?= $row['status'] ?>",
                            "subject": "<?= $row['subject'] ?>",
                            "avatar": "<?= $row['avatar'] ?>",
                            "link": "inbox.php?type=view&inbox=<?= $row['msg_unique'] ?>&unique_id=<?= $row['id'] ?>",
                        },
                    <?php
                    }
                    ?>

                ]

            }

            $('#list').pagination({ // you call the plugin
                dataSource: json.trash, // pass all the data
                pageSize: 5, // put how many items per page you want
                showPageNumbers: false,
                showNavigator: true,
                callback: function(data, pagination) {
                    // that you need to display
                    var wrapper = $('#list .wrapper').empty();
                    $.each(data, function(i, f) {
                        var mediactrl = f.status == 1 ? `<li class="list-group-item list-listan list-listan_` + f.id + `" style="cursor:pointer;border-left:#000 1px solid" onmouseover="mouseover('` + f.id + `','` + f.status + `')" onmouseout="mouseout('` + f.id + `','` + f.status + `')" >` : f.status == 2 ? `<li class="list-group-item list-listan read-l read-list_` + f.id + `" style="cursor:pointer;background: #F4F7F6; color: #403e3e;"  onmouseover="mouseover('` + f.id + `','` + f.status + `')" onmouseout="mouseout('` + f.id + `','` + f.status + `')">` : ``;
                        $('#list .wrapper').append(
                            mediactrl + `
                                        <div class="media-body" >
                                            <div class="media-heading">
  <div class="row">
  <div class="col-auto mr-auto">
  <input type="checkbox" class="trash-checkbox_` + f.id + ` checkbox_trash" onchange="checklistItem('` + f.id + `')" id="checkbox_trash" value="` + f.id + `">
                                        <label for="checkbox_trash"></label>
    </div>
    <div class="col-sm-2 mr-auto" onclick="location.href='` + f.link + `';">
    <a href="javascript:void(0);" class="text-muted" style="font-size:17px;"><i class="zmdi zmdi-delete"></i></a>
    ` + f.name + `
    </div>
    <div class="col col-lg" onclick="location.href='` + f.link + `';">
    <small>` + f.subject + ` - <span class="text-muted">` + f.message + `</span></small>
    </div>
    <div class="col-md-auto">
    <small class="float-right text-muted trash-date_` + f.id + `">` + f.date + `</small>
    <div class="float-right trash-icon_` + f.id + ` d-none"><i class="zmdi zmdi-archive text-muted" title="Archive"></i><i class="zmdi zmdi-delete ml-3 text-muted" title="Delete"></i><a href="javascript:changeReadUnread('` + f.id + `','2')" class="unread_` + f.id + ` d-none text-primary"><i class="zmdi zmdi-email-open ml-3" title="Mark us read"></i></a><a href="javascript:changeReadUnread('` + f.id + `','1')" class="reader_` + f.id + ` d-none text-primary"><i class="zmdi zmdi-email ml-3" title="Mark us unread"></i></a></div>
    </div>
  </div>
  </div>  
                                        </div>
                                    </li>
`);
                    });
                }
            });
        </script>
        <script src="<?= $admin ?>helper/function.js"></script>
    <?php
    }
} else if (get('data') == 'sent') {
    ?>
    <section class="content inbox-msg">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Sent</h2>
                        <ul class="breadcrumb p-l-0 p-b-0 ">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                            <li class="breadcrumb-item active">Sent</li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="input-group m-b-0">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <!-- -->
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
                                        <?php
                                        $id = 1;
                                        foreach ($sent as $message) :
                                        ?>
                                            <tr>
                                                <td><?= $id++ ?></td>
                                                <td><?= $message['name'] ?></td>
                                                <td><?= $message['email'] ?></td>
                                                <td><?= $message['phone'] ?></td>
                                                <td><?php
                                                    if (strlen($message['message']) > 25) {
                                                        echo substr($message['message'], 0, 25) . '...';
                                                    } else {
                                                        echo $message['message'];
                                                    }
                                                    ?></td>
                                                <td><?= $message['ip_address'] ?></td>
                                                <td><?= $message['message_date'] ?></td>
                                                <td><?php
                                                    if ($message['status'] == 2) {
                                                        echo '<span class="badge badge-info">READ</span>';
                                                    } else if ($message['status'] == 1) {
                                                        echo '<span class="badge badge-success">UNREAD</span>';
                                                    }
                                                    ?></td>
                                                <td>
                                                    <button onclick="window.location.href='inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>'" class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="VIEW"><i class="zmdi zmdi-eye"></i></button>
                                                    <button class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="REMOVE"><i class="zmdi zmdi-delete"></i></button>
                                                </td>
                                            </tr>

                                        <?php
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> | Inbox > Sent";
    </script>
<?php
} else if (get('data') == 'draft') {
?>
    <section class="content inbox-msg">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <h2>Draft</h2>
                        <ul class="breadcrumb p-l-0 p-b-0 ">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Inbox</a></li>
                            <li class="breadcrumb-item active">Draft</li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="input-group m-b-0">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-addon"><i class="zmdi zmdi-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="alert alert-success bg-blue-grey rounded text-center">
                            You don't have any saved drafts.
                            Saving a draft allows you to keep a message you aren't ready to send yet.
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
                                        <?php
                                        $id = 1;
                                        foreach ($draft as $message) :
                                        ?>
                                            <tr>
                                                <td><?= $id++ ?></td>
                                                <td><?= $message['name'] ?></td>
                                                <td><?= $message['email'] ?></td>
                                                <td><?= $message['phone'] ?></td>
                                                <td><?php
                                                    if (strlen($message['message']) > 25) {
                                                        echo substr($message['message'], 0, 25) . '...';
                                                    } else {
                                                        echo $message['message'];
                                                    }
                                                    ?></td>
                                                <td><?= $message['ip_address'] ?></td>
                                                <td><?= $message['message_date'] ?></td>
                                                <td><?php
                                                    if ($message['status'] == 2) {
                                                        echo '<span class="badge badge-info">READ</span>';
                                                    } else if ($message['status'] == 1) {
                                                        echo '<span class="badge badge-success">UNREAD</span>';
                                                    }
                                                    ?></td>
                                                <td>
                                                    <button onclick="window.location.href='inbox.php?type=view&inbox=<?= $message['msg_unique'] ?>&unique_id=<?= $message['id'] ?>'" class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="VIEW"><i class="zmdi zmdi-eye"></i></button>
                                                    <button class="btn btn-icon btn-neutral btn-icon-mini margin-0" title="REMOVE"><i class="zmdi zmdi-delete"></i></button>
                                                </td>
                                            </tr>

                                        <?php
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        document.getElementById("title").innerHTML = "<?= getSingleValDB('options', 'id', '1', 'name')  ?> | Inbox > Compose";
    </script>
<?php
}
require "./templates/foot_js.php";
?>
<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?= $admin ?>assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="<?= $admin ?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?= $admin ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->

</body>

</html>