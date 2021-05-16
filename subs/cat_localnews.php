<?php
session_start();
include ('../subs/connect_me.php');
include ('../subs/txtcleaner.php');
require_once('/var/www/html/vhosts/crweworld.com/public_html/geoip/location.php');
include ('../subs/location_check.php');	

/*require_once('../subs/geoplugin.class.php');
$geoplugin = new geoplugin();
$geoplugin->locate();*/

/*include('../subs/ip2locationlite.class.php'); 
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('cf309407361a7779359fcbe7505369a0035688ec6cb8a2fe788da2f276a4c65a'); 
//Get errors and locations
$geo_locations= $ipLite->getCity($_SERVER['REMOTE_ADDR']);*/


if(isSet($_POST['getLastContentId']))
{
$getLastContentId=DATE($_POST['getLastContentId']);

$post_city=str_replace("'","''","$post_city");
$post_state=str_replace("'","''","$post_state");
$post_country=str_replace("'","''","$post_country");
												
$sql = "
SELECT * 
FROM (
SELECT *
FROM  `local_news`
where post_status='publish' and post_city = '$post_city'  
AND trend = '' 
GROUP BY post_id

) 
AS u where post_order < '$getLastContentId' ORDER BY post_order DESC LIMIT 5

"; 
$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));;
$count=mysqli_num_rows($result);
if($count>0){
	
while($row=mysqli_fetch_array($result))
												{
												$post_id=$row['post_id'];
												$post_url=$row['post_url'];
												$post_title=($row['post_title']);
												$post_city=txtcleaner($row['post_city']);
												$post_state=txtcleaner($row['post_state']);
												$post_country=txtcleaner($row['post_country']);
												$post_description=strip_tags(htmlspecialchars_decode($row['post_description']));
												$post_image_loc=$row['post_image_loc'];
												$post_doc=$row['post_doc'];
												$post_order=$row['post_order'];
												
												$cat_id=$row['cat_id'];
												$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='$cat_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
												while($cat_result = mysqli_fetch_array($cat_id))
												{
												$cat_name=$cat_result['cat_name'];
												}
												?>
                                               
                                                <div class="media">
                                                    <div class="media-left"><a title="<?php echo $post_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST'].$post_url;?>"><img onerror="this.src='/default.jpg'" width="200" height="149"
                                                            src="<?php echo $post_image_loc?>" alt=""
                                                            class="media-object"/></a></div>
                                                    <div class="media-body">
                                                        <div class="media-heading"><a title="<?php echo $post_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST'].$post_url;?>" class="title"><?php echo $post_title?></a></div>
                                                        <div class="info"><span class="category"><?php echo $cat_name?></span><span
                                                                class="fa fa-circle"></span><span class="date-created"><?php echo $post_doc ?></span>
                                                        </div>
                                                        <div class="description"><?php echo substr($post_description, 0, 240)."....Read more"; ?></div>
                                                    </div>
                                                </div>
                                               
                                                <?php }?> 

<a href="#"><div id="load_more_<?php echo $post_order; ?>" class="more_tab">
<div id="<?php echo $post_order; ?>" class="more_button btn" style="width:100%" >Load More Content</div>
</div></a>

<?php
} else{
echo "<div class='all_loaded btn' style='width:100%'>No More Content to Load</div>";
}
}
?>