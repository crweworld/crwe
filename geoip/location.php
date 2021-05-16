<?php
require_once 'vendor/autoload.php';
use GeoIp2\Database\Reader;
$reader = new Reader('/usr/share/GeoIP/GeoIP2-City_20160830/GeoIP2-City.mmdb');
$record = $reader->city($_SERVER['REMOTE_ADDR']);
$geo_country=$record->country->name; // 'United States'
$geo_region=$record->mostSpecificSubdivision->name; // 'Minnesota'
$geo_region_code=$record->mostSpecificSubdivision->isoCode; // 'MN'
$geo_city=$record->city->name; // 'Minneapolis'
$geo_cont= $record->continent->name; //North America

/*$geo_country='United States';
$geo_region='Nevada';
$geo_city='Las Vegas';
$geo_region_code='NV';
$geo_cont= 'North America';*/
?>