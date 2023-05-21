<?php 
require "core/db.php";
require "admin/helper/function.php";
// Get CV
error_reporting(0);
$query = $_GET['id'];
$type = $_GET['type'];
$date = date('H:i:s');
header('Content-Type: application/json');
// Get download Info
$stmt = $conn->prepare("SELECT * FROM `document` WHERE `unique_query`=?");
$stmt->execute([$query]);
$doc = $stmt->fetch();

if($type ==''){
    echo 'Not Allowed';
    exit;
} else if ($query == ''){
    echo 'Not Allowed';
    exit;
}

if(!isset($query) && !isset($type)){
    echo 'Not Allowed';
    exit;
} else if(!isset($type)){
    echo 'Not Allowed';
    exit;
} else if(!isset($query)){
    echo 'Not Allowed';
    exit;
}


if(isset($doc['unique_query'])){
if($type == $doc['type'] && $query == $doc['unique_query']){
    $link = $doc['url'];
    $id = $doc['id'];
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$doc['filename'].'"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($doc['url'])); //Absolute URL
readfile($link);

} else {
    $ret['status'] = false;
    $ret['error_code'] = 400;
    $ret['message'] = "Bad Request";
    echo json_encode($ret, true);
    exit;
}} else {
    echo 'Not Allowed';
    exit;
}

?>