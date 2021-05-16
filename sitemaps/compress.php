<?php
$data = implode("", file("http://crweworld.com/sitemaps/sitemap-1.xml"));
$gzdata = gzencode($data, 9);
$fp = fopen("sitemap-1.xml.gz", "w");
fwrite($fp, $gzdata);
fclose($fp);
$data = implode("", file("http://crweworld.com/sitemaps/sitemap-2.xml"));
$gzdata = gzencode($data, 9);
$fp = fopen("sitemap-2.xml.gz", "w");
fwrite($fp, $gzdata);
fclose($fp);
$data = implode("", file("http://crweworld.com/sitemaps/sitemap-3.xml"));
$gzdata = gzencode($data, 9);
$fp = fopen("sitemap-3.xml.gz", "w");
fwrite($fp, $gzdata);
fclose($fp);
echo "sitemap updated"
?>