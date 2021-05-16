<?php 
include('subs/header.php');

$mvc_id=txtcleaner($_GET['vc_id']);
$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$mvc_id' and vc_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
$vc_result = mysqli_fetch_array($vc_id);
$vc_name=$vc_result['vc_name'];
$vc_id=$vc_result['vc_id'];
if(!isset($vc_id))
{
	echo "<script>window.location = '404.php'</script>";
}

 ?>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
$(function() {

$('.more_button').live("click",function() 
{
var getId = $(this).attr("id");
if(getId)
{
$("#load_more_"+getId).html('<img src="/assets/images/load.gif" style="padding:10px 0 0 100px;"/>');  


$.ajax({
type: "POST",
url: "/loadit/channel.php",
data: {getLastContentId: getId, vc_id: <?php echo $vc_id?>},
cache: false,
success: function(html){
$("#result-list").append(html);
$("#load_more_"+getId).remove();
}
});
}
else
{
$(".more_tab").html('The End');
}
return false;
});
});

</script>

  <link type="text/css" rel="stylesheet" href="/assets/css/pages/search_result.css">
<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
    <div id="page-wrapper"><!-- MAIN CONTENT-->
        <div class="main-content"><!-- CONTENT-->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-8">
                            <ul class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Channel</a></li>
                                <li class="active"><?php echo $vc_name?></li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-right col-sm-4">
                            <div class="weather-info"><span class="date"></span><span class="fa fa-circle"></span><span
                                    class="description"><span  class="city-weather-temperature temp"   id="city-weather-temperature" >21° C</span><img src="http://openweathermap.org/img/w/01d.png" style="width: 10%;" alt="weather-icon" class="city-weather-icon" id="city-weather-icon" /></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-left col-sm-8">
                            <div id="search-result" class="section-category">
                                <div class="section-name"><?php include('ads/729ad.php')?> <br /><a href="#"><?php echo $vc_name?></a></div>
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                          
                                            <?php
												
												
												
												$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM videos where vc_id ='$vc_id' and vid_status='publish'");
												$numrows=mysqli_num_rows($query);
												
																	
												$sp=mysqli_query($GLOBALS["___mysqli_ston"], "select * from videos where vc_id ='$vc_id' and vid_status='publish' ORDER BY vid_id DESC LIMIT 8") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
												
												?>
                                            
                                            <div id="result-list">   
                                            	<?php                                         	
												while($row=mysqli_fetch_array($sp))
												{
												$vid_id=$row['vid_id'];
												$vid_title=htmlspecialchars_decode($row['vid_title']);
												$vid_description=strip_tags(htmlspecialchars_decode($row['vid_description']));
												$vid_url=$row['vid_url'];
												$vid_doc=$row['vid_doc'];
												if($row['vid_type']==0)
												{
												$img_src1='http://img.youtube.com/vi/'.$vid_url.'/mqdefault.jpg';
												} else {$img_src1='http://www.crwetube.com/image/thumbnail/'.$vid_url.'.jpg'; }
												
												?>
                                               
                                                <div class="media">
                                                    <div class="media-left"><a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>">
                                                    <img onerror="this.src='/default.jpg'" src="<?php echo $img_src1?>"  width="200" height="149" class="media-object"/>
                                                    </a></div>
                                                    <div class="media-body">
                                                        <div class="media-heading"><a title="<?php echo $vid_title; ?>" href="<?php echo "http://".$_SERVER['HTTP_HOST']."/watch/".$vid_id."/". txtcleaner($vid_title);?>" class="title"><?php echo $vid_title?></a></div>
                                                        <div class="info"><span class="category"><?php echo $vc_name?></span><span
                                                                class="fa fa-circle"></span><span class="date-created"><?php echo $vid_doc ?></span>
                                                        </div>
                                                        <div class="description"><?php echo substr($vid_description, 0, 240); ?></div>
                                                    </div>
                                                </div>
                                               
                                                <?php }?>   
                                            </div>
                                           <?php if($numrows > 8){ ?>
                                               <a href="#"><div id="load_more_<?php echo $vid_id; ?>" class="more_tab">
<div id="<?php echo $vid_id; ?>" class="more_button btn" style="width:100%" >Load More Content</div>
</div></a>
 											 <?php }?>   
                                            
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-right col-sm-4">
                         <?php include('subs/sidebar.php'); ?>
                          <?php include('ads/geo-side-ads.php'); ?>
                            <div class="clearfix"></div>
                            
                            <div class="clearfix"></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include('subs/footer.php') ?>