<?php
require "../../core/db.php";
require "function.php"
?>
<?php

// Get id & type from header
$id = $_GET['id'];
$type = $_GET['type'];


if ($conn) {
    switch ($type) {
        case "article":
            // Cek Tags
            $sql = "SELECT * FROM `article` WHERE `article_id` = $id";
            $query = mysqli_query($mysqli, $sql);
            foreach ($query as $row) :
                $slugAr = $row['article_slug'];
                // Delete Tags
                $sql = "DELETE FROM `tags` WHERE `article_slug` = '$slugAr'";
                mysqli_query($mysqli, $sql);
            endforeach;
            delete($conn, $type, $id, $admin . "blog.php");
            break;
        case "category":
            delete($conn, $type, $id, $admin . "categories.php");
            break;
        case "author":
            delete($conn, $type, $id, "author.php");
            break;
        default:
            break;
    }
} else {
    echo 'Error: ' . $e->getMessage();
}


function delete($conn, $table, $id, $go)
{

    $col = $table . "_id";

    try {
        // sql to delete a record
        $sql = "DELETE FROM $table WHERE $col = $id";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "$table Deleted Successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

    header("Location: $go", true, 301);
    exit;
}
?>