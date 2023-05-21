<!-- INSERT INTO `tags`(`tags`) VALUES ('casdasd'),('asdsada'),('gas');UPDATE `tags` SET `article_id`=49 WHERE `tags`='casdasd';UPDATE `tags` SET `article_id`=49 WHERE `tags`='asdsada';UPDATE `tags` SET `article_id`=49 WHERE `tags`='gas' -->
<?php 
require "../core/db.php"; 
require "helper/function.php";
$count = new CountDB;
?>
<?php
$new = "<a href='test'>Test</a>";
$arg = array('ew','sad');
 echo count($arg)-1;
 $cc = $count -> DBwhere('tags','article_slug','sadadsasdasda2');
 if($cc == 0){
  echo "ada";
 } else {
    echo "tidak ada";
 }

echo strtotime(date('Y-m-d H:i:s',strtotime('-7 day')));

echo '<br>';

echo strtotime('2022-07-15 13:46:41
');

if(strtotime(date('Y-m-d H:i:s',strtotime('-7 day'))) > strtotime('2022-07-15 13:46:41')){
    echo "true";
} else {
    echo "false";
}


?>
<form method="POST">
<input type="text" class="form-control" name="tags" data-role="tagsinput" value="adsa,asdasd" required>
<button type="submit">Submit</button>
</form>
<script src="<?= $domain ?>assets/js/jquery.min.js"></script>
<script src="<?= $admin ?>assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="<?= $admin ?>assets/js/dropify/dist/js/dropify.min.js"></script>
<script src="<?= $admin ?>assets/js/form-file-upload-data.js"></script>
<script src="<?= $admin ?>assets/plugins/ckeditor/ckeditor.js"></script> <!-- Ckeditor -->
<script src="<?= $admin ?>assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js --> 
<script src="<?= $admin ?>assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
