<?php
require "../../core/db.php";
require "function.php"
?>
<?php

$count = new CountDB;
// Get type from header
$type = $_GET['type'];
$urlId = $_GET['id'];

if ($conn) {

    if (isset($_POST["update"])) {

        switch ($type) {
            case "article":
                $getImg = $_POST['img'];
                if (strlen($_POST["subs"]) > 250) {
                    $descr = strip_tags(substr($_POST["subs"], 0, 250)) . " ...";
                } else {
                    $descr = $_POST["subs"];
                }
                // Update DataBase
                $title = test_input($_POST["title-content"]);
                $content = $_POST["content"];
                $desc = test_input($descr);
                $slug = test_input(slugify($_POST["title-content"]));
                $tags = test_input($_POST["tags"]);
                $categorie = test_input($_POST["category"]);
                $author = test_input($_POST["author"]);
                $imageName = test_input($slug . '_' . date('Ymd_Hi') . '.png');

                // Upload Image
                if ($_FILES["mediaimg"]['error'] === 0) {
                    $filename = $slug . '_' . date('Ymd_Hi');
                    // Upload Image
                    uploadImage1("mediaimg", "../../assets/img/article/", $filename);
                } else {
                    $imageName = $getImg;
                }

                // Hapus Tags
                mysqli_query($mysqli, "DELETE FROM `tags` WHERE `article_slug` = '$slug'");

                // Insert Tags
                $array = explode(',', $_POST["tags"]);
                $co = count($array) - 1;
                for ($x = 0; $x <= $co; $x++) {
                    $dat = $x;
                    $arr = "('" . $slug . "','" . $array[$dat] . "')";
                    print_r($arr);
                    $sql = "INSERT INTO `tags`(`article_slug`, `tags`) VALUES $arr;";
                    $query = mysqli_query($mysqli, $sql);
                }
                echo '<script>console.log("' . $arg . '")</script>';

                try {
                    $sql = "UPDATE `article` SET `article_title`=?,`article_content`=?,`article_desc`=?,`article_image`=?,`article_updated_at`= current_timestamp(),`id_categorie`=?,`id_author`=?,`article_slug`=?,`tags`=? WHERE `article_id`=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$title, $content, $desc, $imageName, $categorie, $author, $slug, $tags, $urlId]);


                    // echo a message to say the UPDATE succeeded
                    echo "<script>alert('Article UPDATED successfully')</script>";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                // Go to show.php
                // header("refresh:1; url=../article.php");
                header("Location: ../blog.php", true, 301);
                exit;
                break;

            case "category":

                // Update DataBase
                $name = test_input($_POST["nameCat"]);
                try {

                    $sql = "UPDATE `category`
                        SET `category_name`= ? WHERE `category_id` = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$name, $urlId]);

                    // echo a message to say the UPDATE succeeded
                    echo "Category UPDATED successfully";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                // Go to show.php
                // header("refresh:1; url=../allCategories.php");
                header("Location: ../categories.php", true, 301);
                exit;

                break;
            case "author":
                // Update DataBase
                $fullName = test_input($_POST["authName"]);
                $description = test_input($_POST["authDesc"]);
                $email = test_input($_POST["authEmail"]);
                $twitter = test_input($_POST["authTwitter"]);
                $github = test_input($_POST["authGithub"]);
                $linkedin = test_input($_POST["authLinkedin"]);
                $imageName = test_input($_FILES["authImage"]["name"]);

                // Upload Image
                if ($_FILES["authImage"]['error'] === 0) {
                    uploadImage2("authImage", "../img/avatar/");
                } else {
                    $imageName = $urlImage;
                }

                try {
                    $sql = "UPDATE `author`
                        SET `author_fullname`= ?, `author_desc`= ?,`author_email`=?, `author_twitter`=?, `author_github`= ?, `author_link`= ?, `author_avatar`= ?
                        WHERE `author_id` = ?";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute([$fullName, $description, $email, $twitter, $github, $linkedin, $imageName, $urlId]);

                    // echo a message to say the UPDATE succeeded
                    echo "author UPDATED successfully";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                // Go to show.php
                header("Location: ../author.php", true, 301);
                exit;
                break;
            case "messages":
                mysqli_query($mysqli, "UPDATE `messages` SET `status` = '2' WHERE `messages`.`id` = $urlId");
                echo 'Update Success';
                exit;
                break;

            default:
                break;
        }
    }
} else {
    echo 'Error: ' . $e->getMessage();
}
