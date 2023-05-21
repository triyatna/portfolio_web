<?php 
require "../../core/db.php"; 
require "function.php"
?>
<?php

// Get type from header
$type = $_GET['type'];


if ($conn) {

    if (isset($_POST["submit"])) {

        switch ($type) {
            case "article":

                // PREPARE DATA TO INSERT INTO DB
                            if (strlen($_POST["subs"]) > 250) {
                                $desc = strip_tags(substr($_POST["subs"], 0, 250)) . " ...";
                            } else {
                                $desc = $_POST["subs"];
                            }
                            $contentc= $_POST["title-content"];
                $data = array(
                    "article_title" => test_input($contentc),
                    "article_content" => $_POST["content"],
                    "article_desc" => test_input($desc),
                    "article_image" => test_input($_FILES["mediaimg"]["name"]),
                    "article_created_time" => date('Y-m-d H:i:s'),
                    "id_categorie" => test_input($_POST["category"]),
                    "id_author" => test_input($_POST["author"]),
                    "article_slug" => test_input(slugify($contentc)),
                    "tags" => test_input($_POST["tags"]),
                   
                );
              echo "<script>console.log('".$_POST["content"]."')</script>";
                // Insert Tags
                $array = explode(',' , $_POST["tags"]);
                $co = count($array)-1;
            for ($x = 0; $x <= $co; $x++) {
              $dat = $x;
             $arr = "('".slugify($contentc)."','".$array[$dat]."')";
             print_r($arr);
           $sql = "INSERT INTO `tags`(`article_slug`, `tags`) VALUES $arr;";
               $query = mysqli_query($mysqli, $sql);
             }

             $filename = test_input(slugify($contentc)).'_'.date('Ymd_Hi');
               // Upload Image
               uploadImage1("mediaimg", "../../assets/img/article/", $filename);
                
                // $tableName = 'article';

                // Call insert function
                insertToDB($conn, $type, $data);
                sendWAMSG('6285162830081','0895349086103','Pesan anda yang di tulis di https://triyatna.my.id telah berhasil masuk ke antrian');
                // Go to show.php
                header("Location: ../blog.php", true, 301);
                exit;
                break;

            case "category":

                // Upload Image
                uploadImage2("catImage", "../../assets/img/category/");

                // PREPARE DATA TO INSERT INTO DB
                $data = array(
                    "category_name"  => test_input($_POST["catName"]),
                    "category_image" => test_input($_FILES["catImage"]["name"]),
                    "category_color" => test_input($_POST["catColor"]),
                );

                // $tableName = 'category';

                // Call insert function
                insertToDB($conn, $type, $data);

                // Go to show.php
                header("Location: ../categories.php", true, 301);
                exit;
                break;

            case "author":

                // Upload Image
                uploadImage2("authImage", "../../assets/img/avatar/");

                // PREPARE DATA TdO INSERT INTO DB
                $data = array(
                    "author_fullname" => test_input($_POST["authName"]),
                    "author_desc" => test_input($_POST["authDesc"]),
                    "author_email" =>  test_input($_POST["authEmail"]),
                    "author_twitter" =>  test_input($_POST["authTwitter"]),
                    "author_github" => test_input($_POST["authGithub"]),
                    "author_link" => test_input($_POST["authLinkedin"]),
                    "author_avatar" => test_input($_FILES["authImage"]["name"])
                );

                $tableName = 'author';

                // Call insert function
                insertToDB($conn, $tableName, $ata);

                // Go to show.php
                header("Location: ../author.php", true, 301);
                exit;
                break;

            case "comment":

                $id = test_input($_POST["id_article"]);

                // PREPARE DATA TO INSERT INTO DB
                $data = array(
                    "comment_username" => test_input($_POST["username"]),
                    // "comment_avatar" => test_input($_POST["comment_avatar"]),
                    "comment_content" => test_input($_POST["comment"]),
                    "comment_date" => date('Y-m-d H:i:s'),
                    "id_article" =>  test_input($_POST["id_article"]),
                    "article_slug" =>  test_input($_POST["article_slug"])
                );

                $tableName = 'comment';

                // Call insert function
                insertToDB($conn, $tableName, $data);

                // Go to show.php
                header("Location: ../article/$id", true, 301);
                exit;
                break;

            default:
                echo "ERROR";
                break;
        }
    }
} else {
    echo 'Error: ' . $e->getMessage();
}


?>