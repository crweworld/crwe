<div id="hot-topics" class="section-category" >
<div class="section-name">
<div class="pull-left"><a href="#">Hot Topics</a></div>
<div class="pull-right"></div>
<div class="clearfix"></div>
</div>                                
<div class="section-content">
<div class="row">
<div class="col-md-6 col-sm-6">
<div class="hot-topics-list">
<?php 
$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE post_status='publish' and post_id NOT IN ('" . implode("','",$sldarray) . "') and post_id NOT IN ('" . implode("','",$lat1) . "') and post_id NOT IN ('" . implode("','",$lat2) . "') and post_id NOT IN ('" . implode("','",$rss1) . "') and post_id NOT IN ('" . implode("','",$rss2) . "') ORDER BY `post_id` DESC LIMIT 2") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($info = mysqli_fetch_array( $bd )) 
{ 
$hot1[]=$info['post_id']; 
$post_title=($info['post_title']);
$post_doc=$info['post_doc'];
$post_image_loc=$info['post_image_loc']; 
$post_id=$info['post_id']; 
$post_url=$info['post_url'];
$cat_id=$info['cat_id'];
$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='$cat_id' ORDER BY cat_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
while($cat_result = mysqli_fetch_array($cat_id))
{
$cat_name=$cat_result['cat_name'];
}
?>       
<div class="media">
<?php  if(!empty($post_image_loc)) {?>
<div class="media-left"><a title="<?php echo $post_title; ?>"  href="<?php echo "http://".$_SERVER['HTTP_HOST']. $post_url?>"><img onerror="this.src='/default.jpg'" src="<?php echo $post_image_loc?>" alt="<?php echo $post_title; ?>" class="media-object"></a></div>   
<?php } ?>
<div class="media-body">
<h2 class="media-heading"><a title="<?php echo $post_title; ?>"  href="<?php echo "http://".$_SERVER['HTTP_HOST'].$post_url?>" class="title"><?php echo $post_title?></a></h2>
<div class="info"><span class="category"><?php echo $cat_name?></span><span class="fa fa-circle"></span><span class="date-created"><?php echo $post_doc?></span>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="hot-topics-list">
<?php 
$bd = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE post_status='publish' and post_id NOT IN ('" . implode("','",$sldarray) . "') and post_id NOT IN ('" . implode("','",$lat1) . "') and post_id NOT IN ('" . implode("','",$lat2) . "') and post_id NOT IN ('" . implode("','",$hot1) . "') and post_id NOT IN ('" . implode("','",$rss1) . "') and post_id NOT IN ('" . implode("','",$rss2) . "') ORDER BY `post_id` DESC LIMIT 2") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
while($info = mysqli_fetch_array( $bd )) 
{ 
$hot2[]=$info['post_id']; 
$post_title=($info['post_title']);
$post_doc=$info['post_doc'];
$post_image_loc=$info['post_image_loc']; 
$post_id=$info['post_id']; 
$post_url=$info['post_url'];
$cat_id=$info['cat_id'];
$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_status='publish' and `cat_id`='$cat_id' ORDER BY cat_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
while($cat_result = mysqli_fetch_array($cat_id))
{
$cat_name=$cat_result['cat_name'];
}
?>       
<div class="media">
<?php  if(!empty($post_image_loc)) {?>
<div class="media-left"><a title="<?php echo $post_title; ?>"  href="<?php echo "http://".$_SERVER['HTTP_HOST']. $post_url;?>"><img onerror="this.src='/default.jpg'" src="<?php echo $post_image_loc?>" alt="<?php echo $post_title; ?>" class="media-object"></a></div>   
<?php } ?>
<div class="media-body">
<h2 class="media-heading"><a title="<?php echo $post_title; ?>"  href="<?php echo "http://".$_SERVER['HTTP_HOST'].$post_url?>" class="title"><?php echo $post_title?></a></h2>
<div class="info"><span class="category"><?php echo $cat_name?></span><span class="fa fa-circle"></span><span class="date-created"><?php echo $post_doc?></span>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>                                
</div>


								
                       