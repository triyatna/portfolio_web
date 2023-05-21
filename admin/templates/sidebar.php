<?php 
include 'mini_sidebar.php';
?>
<!-- Aside in Mini Sidebar-->
    <div id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info m-b-20">
                        <div class="image">
                            <a><img src="<?= $admin.'/assets/images/'.getSingleValDB('users','username',$_SESSION['username'],'avatar') ?>" alt="User" style="width: 100px;height:100px"></a>
                        </div>
                        <div class="detail">
                            <h6><?= $_SESSION['username'] ?></h6>
                            <p class="m-b-0"><?= getSingleValDB('users','username',$_SESSION['username'],'email') ?></p>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-facebook-box"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-linkedin-box"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-instagram"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-twitter-box"></i></a>                            
                        </div>
                    </div>
                </li>
                <li class="header">MAIN</li>
                <li class="sm_menu_btm open" id="dashboard"> <a href="./"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                <li class="sm_menu_btm open" id="inbox"> <a href="inbox.php?data=messages"><i class="zmdi zmdi-inbox"></i><span>Inbox</span></a></li>
                </li>
                <li class="header">BLOG</li>
                <li class="sm_menu_btm open" id="blog-list"> <a href="blog.php"><i class="zmdi zmdi-home"></i><span>Post</span></a></li>
                <li class="sm_menu_btm open" id="category"><a href="categories.php" class="menu-toggle"><i class="zmdi zmdi-archive"></i><span>Category</span></a>
                </li>
                <li class="header">APPLICATION</li>
                <li class="sm_menu_btm open" id="filemanage"> <a href="filemanager.php"><i class="zmdi zmdi-folder-person"></i><span>File Manager</span></a></li>
                <li class="header">PERSONAL OPTIONS</li>
                <li class="sm_menu_btm open" id="cover"> <a href="blog.php"><i class="zmdi zmdi-image-o"></i><span>Cover Page</span></a></li>
                <li class="sm_menu_btm open" id="aboutme"><a href="categories.php" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>About Page</span></a>
                <li class="sm_menu_btm open" id="resumeme"><a href="categories.php" class="menu-toggle"><i class="zmdi zmdi-view-list"></i><span>Resume Page</span></a>
                <li class="sm_menu_btm open" id="portfoliome"><a href="categories.php" class="menu-toggle"><i class="zmdi zmdi-view-compact"></i><span>Portfolio Page</span></a>
                <li class="sm_menu_btm open" id="contactme"><a href="categories.php" class="menu-toggle"><i class="zmdi zmdi-account-box-phone"></i><span>Contact Page</span></a>
                </li>
                <li class="header">SETTINGS</li>                    
                <li class="sm_menu_btm open" id="general"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>General Settings</span></a>
                </li>
                <li class="sm_menu_btm open" id="setting"> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-calendar"></i><span>Personal Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
</aside>
