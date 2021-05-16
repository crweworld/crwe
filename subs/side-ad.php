<?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id=1") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id1=$results['post_id'];
					 	$post_status1=$results['post_status'];
						$post_title1=$results['post_title'];
						$post_description1=$results['post_description'];
						$source_url1=$results['source_url'];
						$post_image_loc1=$results['post_image_loc'];
						if($post_status1=="publish"){
?>
<div id="slideout">
<img src="<?php echo $post_image_loc1?>" alt="ad1">
<div id="slideout_inner">
  
   <?php echo $post_description1; ?>
    <p><a target="_blank" href="<?php echo $source_url1?>" style="color: #28FF05;;"><?php echo $post_title1?></a></p>
  
</div>
</div>
<?php }} ?>


<!--Side2-->
<?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id=2") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id2=$results['post_id'];
					 	$post_status2=$results['post_status'];
						$post_title2=$results['post_title'];
						$post_description2=$results['post_description'];
						$source_url2=$results['source_url'];
						$post_image_loc2=$results['post_image_loc'];
						if($post_status2=="publish"){
?>
<div id="slideout2">
<img src="<?php echo $post_image_loc2?>" alt="ad2">
<div id="slideout2_inner">
    
   <?php echo $post_description2; ?>
    <p><a target="_blank" href="<?php echo $source_url2?>" style="color: #28FF05;;"><?php echo $post_title2?></a></p>
    
</div>
</div>
<?php }} ?>

<!--Side3-->
<?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id=3") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id3=$results['post_id'];
					 	$post_status3=$results['post_status'];
						$post_title3=$results['post_title'];
						$post_description3=$results['post_description'];
						$source_url3=$results['source_url'];
						$post_image_loc3=$results['post_image_loc'];
						if($post_status3=="publish"){
?>
<div id="slideout3">
<img src="<?php echo $post_image_loc3?>" alt="ad3">
<div id="slideout3_inner">
  <?php echo $post_description3; ?>
    <p><a target="_blank" href="<?php echo $source_url3?>" style="color: #28FF05;;"><?php echo $post_title3?></a></p>
    
</div>
</div>
<?php }} ?>



<!--Side4-->
<?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id=4") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id4=$results['post_id'];
					 	$post_status4=$results['post_status'];
						$post_title4=$results['post_title'];
						$post_description4=$results['post_description'];
						$source_url4=$results['source_url'];
						$post_image_loc4=$results['post_image_loc'];
						if($post_status4=="publish"){
?>
<div id="slideout4">
<img src="<?php echo $post_image_loc4?>" alt="ad4">
<div id="slideout4_inner">
    
   <?php echo $post_description4; ?>
    <p><a target="_blank" href="<?php echo $source_url4?>" style="color: #28FF05;;"><?php echo $post_title4?></a></p>
    
</div>
</div>
<?php }} ?>

<!--Side5-->
<?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ads where post_id=5") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$post_id5=$results['post_id'];
					 	$post_status5=$results['post_status'];
						$post_title5=$results['post_title'];
						$post_description5=$results['post_description'];
						$source_url5=$results['source_url'];
						$post_image_loc5=$results['post_image_loc'];
						if($post_status5=="publish"){
?>
<div id="slideout5">
<img src="<?php echo $post_image_loc5?>" alt="ad5">
<div id="slideout5_inner">
    
   <?php echo $post_description5; ?>
    <p><a target="_blank" href="<?php echo $source_url5?>" style="color: #28FF05;;"><?php echo $post_title5?></a></p>
    
</div>
</div>
<?php }} ?>
<div class="mobile-ads">
	<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">      
          <!-- Modal -->
                  <div class="modal fade" id="myModal-mobileads" role="dialog">
                    <div class="modal-dialog">				
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Advertisements</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 ad-container">                                      
                                        <div class="col-xs-12 pull-right ad-text">
                                        	<?php echo $post_description1; ?>
                                            <p><a target="_blank" href="<?php echo $source_url1?>" style="color: #d80102;"><?php echo $post_title1?></a></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 ad-container">                                      
                                        <div class="col-xs-12 pull-right ad-text">
                                        	<?php echo $post_description2; ?>
                                             <p><a target="_blank" href="<?php echo $source_url2?>" style="color: #d80102;"><?php echo $post_title2?></a></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 ad-container">                                      
                                        <div class="col-xs-12 pull-right ad-text">
                                        	<?php echo $post_description3; ?>
                                             <p><a target="_blank" href="<?php echo $source_url3?>" style="color: #d80102;"><?php echo $post_title3?></a></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 ad-container">                                     
                                        <div class="col-xs-12 pull-right ad-text">
                                        	<?php echo $post_description4; ?>
                                             <p><a target="_blank" href="<?php echo $source_url4?>" style="color: #d80102;"><?php echo $post_title4?></a></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 ad-container">                                      
                                        <div class="col-xs-12 pull-right ad-text">
                                        	<?php echo $post_description5; ?>
                                             <p><a target="_blank" href="<?php echo $source_url5?>" style="color: #d80102;"><?php echo $post_title5?></a></p>
                                        </div>
                                    </a>
                                </div>
                                						
                            </div>
                        </div>
                      </div>				  
                    </div>
                  </div>	  
          <div class="btn-group">
            <a href="javascript:void(0)" type="button" class="btn btn-info btn-fab" data-toggle="modal" data-target="#myModal-mobileads">
              <i class="fa fa-bullhorn" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
});
$.material.init();
</script>