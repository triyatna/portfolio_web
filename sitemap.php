<?php
require "core/db.php";
header('Content-type: application/xml');

$get_result= mysqli_query($mysqli,"SELECT * FROM `article`");

echo "<?xml version='1.0' encoding='UTF-8'?>"."\n";
echo "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>"."\n";

echo "
<url>
 <loc>".$domain."</loc>
 <lastmod>2021-04-06 02:31:3</lastmod>
 <changefreq>daily</changefreq>
 <priority>1.00</priority>
</url>
";

foreach ($get_result as $row) :
 echo "<url>";
 echo "<loc>".$domain.'article/'.$row['article_slug']."</loc>";
 echo "<lastmod>".$row['article_created_time']."</lastmod>";
 echo "<changefreq>daily</changefreq>";
 echo "<priority>1.00</priority>";
 echo "</url>";
endforeach;
echo "</urlset>";

?>