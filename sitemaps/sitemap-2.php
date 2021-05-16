<?php 
include ('../subs/connect_me.php'); 

 $dat=date('Y-m-d');
 header ("content-type: text/xml");
 header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
 header('Pragma: no-cache');
 echo '<?xml version="1.0" encoding="UTF-8"?>
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
 xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
$urls=mysqli_query($GLOBALS["___mysqli_ston"], "select * from posts where trend ='localnews' and post_status='publish' order by post_id desc limit 49000")or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
 while($row_Tags=mysqli_fetch_array($urls))
 {
   echo "<url><loc>http://crweworld.com".$row_Tags['post_url']."</loc><lastmod>".$dat."</lastmod><changefreq>hourly</changefreq><priority>1</priority></url>";
 }
  echo "</urlset>";
 ?>