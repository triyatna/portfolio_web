<?php
require "../core/db.php"; 
require "./helper/function.php";
header('Content-Type: application/json');

$sql = "SELECT * FROM `messages`"; //script sql select data
$result = mysqli_query($mysqli, $sql); //melakukan query
$hasil = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($hasil, array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "phone" => $row['phone'],
        "message" => $row['message'],
        "ip" => $row['ip_address'],
        "date" => $row['message_date'],
        "status" => $row['status'],
    ));
}
echo json_encode(array(
    "data" => $hasil,
),JSON_PRETTY_PRINT);
