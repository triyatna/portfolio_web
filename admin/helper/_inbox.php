<?php
require "../../core/db.php";
require "function.php";
require "../mail.php";
// Inbox POST DELETE GET DATA //

$type = get('type');
$query = get('query');

if (isset($type)) {
    switch ($type) {
        case 'trash':
            // DELETE
            if ($query == 'delete') {
                $data = $_POST['data'];
                if ($data == 'all') {
                    $db->query("DELETE FROM `messages` WHERE `type`= '1';");
                } else {
                    $db->query("DELETE FROM `messages` WHERE `id` IN ($data)");
                }
                // UPDATE
            } else if ($query == 'update') {
                $data = $_POST['data'];
                $stat = $_POST['status'];
                // 1 UNREAD | 2 READ
                if ($data == 'all') {
                    $db->query("UPDATE `messages` SET `status`= '$stat' WHERE `type`= '1';");
                } else {
                    $db->query("UPDATE `messages` SET `status`= '$stat' WHERE `id` IN ($data)");
                }
            } else {
                echo "ERROR";
            }

            exit;
            break;
        case 'mail':
            if ($query == 'reply') {
                $to = $_POST['to'];
                $subject = $_POST['subject'];
                $text = $_POST['text'];
                $cc = 'triyatna.my@gmail.com';
                $a = $_POST['name'];
                $p = $_POST['phone'];
                $unique = $_POST['unique'];
                $ip = checkmyip();
                mailSend($to, $cc, $subject, $text);
                $db->query("INSERT INTO `messages` VALUES (NULL,'$a','$to','$p','$subject','$text','$ip',current_timestamp(),'2','2','$unique','https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1','admin')");
            }
            exit;
            break;
        default:
            echo "ERROR";
            break;
    }
}
