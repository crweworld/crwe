<?php
session_start();

include ('../subs/connect_me.php');
include('../subs/functions.php');
include('../subs/searchloc.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 $admin_id = $_SESSION['id'];
 include('header.php');
 include('sidebar.php');

 
if(isset($_POST['edit_banner_ad']))
{  					  
	$ad_title = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_title']);
	$ad_tag = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_tag']);
	$target_url = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['target_url']);
	$ad_type = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_type']);
	$ad_expiry = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_expiry']);
	$ad_status = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_status']);
	$tracking_id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['tracking_id']);
	$ad_order = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_order']);
	$hash = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['hash']);
	if(isset($_POST['continent'])){$post_continent=txtcleaner(mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['continent']));}
	
	
	
	$ad_update=date("Y-m-d") ;
	
	if($ad_type=="big_ad")
	{
		$_SESSION['width']=460; $_SESSION['height']=250;
	}
	elseif($ad_type=="bottom_ad")
	{
		$_SESSION['width']=300; $_SESSION['height']=430;
	}
	else
	{
		$_SESSION['width']=300; $_SESSION['height']=250;
	}
	$post_zipid="";
	$err_sin="";
	if($ad_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($ad_tag==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Tags / Short Description is Empty <br>";}
	if($target_url==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Target Url is Empty <br>";}
	if($ad_expiry==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Enter Expiry Date <br>";}
	if($ad_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Select Ad Type <br>";}
	
		
	if(isset($_FILES['files']))
		{
			$errors= array();					
			$file_name = strtolower($_FILES['files']['name']);
			$file_size =$_FILES['files']['size'];
			$file_tmp =$_FILES['files']['tmp_name'];
			$file_type=$_FILES['files']['type'];	
			$kaboom = explode(".", $file_name); // Split file name into an array using the dot
			$fileExt = end($kaboom);
			
			if($file_size > 0 )
			{
				if($fileExt!="jpg" and $fileExt!="png")
				{					
					 $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Image File is Invalid, Please Upload Again <br>";					
				}
				else if($file_size > 2097152)
				{
					$err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! File size must be less than 2 MB <br>";
				}
				
				else
				{
					$dirPath = "../uploads/ads/$hash";
					$dirPath2 = "../uploads/ads/$hash/thumb";
		
					if (!file_exists("$dirPath")) 
					{
						mkdir("$dirPath", 0755, true);
					}
					
					if (!file_exists("$dirPath2")) 
					{
						mkdir("$dirPath2", 0755, true);
					}	
											
					$moveResult = move_uploaded_file($file_tmp, "../uploads/ads/$hash/$file_name");
				 
					include_once("../subs/ak_php_img_lib_1.0.php");
					$target_file = "../uploads/ads/$hash/$file_name";
					$resized_file = "../uploads/ads/$hash/thumb/$file_name";
					$wmax = $_SESSION['width'];
					$hmax = $_SESSION['height'];					
					ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);	
					
					
					$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM banner_ads where ad_id={$_GET['ad_id']}") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				    $results = mysqli_fetch_array($edit_post);
					$ad_image=$results['ad_image'];
					 
					unlink("../uploads/ads/$hash/$ad_image");
					 unlink("../uploads/ads/$hash/thumb/$ad_image");
					 
					 mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `ad_image`='$file_name' where ad_id='{$_GET['ad_id']}'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
																
				}
			}					
		}	
	
	if($ad_type!='conti_view')
		{	
			/*zippy*/	
			include('../subs/zippy.php');	
			/*zippy*/
		}
	
	$done2="";
	if(!empty($post_zipid))
	{
		$sql="SELECT * FROM ban_loc WHERE ad_id='{$_GET['ad_id']}' and zip_id='$post_zipid' ";
		$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$count=mysqli_num_rows($result);
		if($count==0)
		{
			mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `ban_loc`(`ad_id`, `zip_id`, `ad_imp`, `ad_unq_imp`, `ad_clicks`, `ad_unq_clicks`,  `post_state`, `post_city`, `post_local`, `post_country`, `post_zipcode`) VALUES ('{$_GET['ad_id']}','$post_zipid','0','0','0','0','$post_state','$post_city','$post_local','$post_country','$post_zipcode')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
				$done2="New Location Added";			
		}
		else
		{
			$err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Location already exist <br>";
		}
		
	}
	elseif(!empty($post_continent))
	{
		$sql="SELECT * FROM ban_loc WHERE ad_id='{$_GET['ad_id']}' and post_continent='$post_continent'";
		$result=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
		$count=mysqli_num_rows($result);
		if($count==0)
		{			
				mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `ban_loc`(`ad_id`,`ad_imp`, `ad_unq_imp`, `ad_clicks`, `ad_unq_clicks`, `post_continent`) VALUES ('{$_GET['ad_id']}','0','0','0','0','$post_continent')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
				$done2="New Location Added";			
		}
		else
		{
			$err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Location already exist <br>";
		}
		
	}
	
	if(empty($err_sin))
	{
		$update_ok = mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `banner_ads` SET `admin_id`='$admin_id', `ad_title`='$ad_title' ,`ad_tag`='$ad_tag',`target_url`='$target_url',`ad_type`='$ad_type',`ad_expiry`='$ad_expiry',`ad_status`='$ad_status',`tracking_id`='$tracking_id' ,`ad_update`='$ad_update' ,`ad_order`='$ad_order' where ad_id='{$_GET['ad_id']}' ")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		
		$done="Banner Ad is Updated";
	
		
	}
}
if(isset($_POST['del_loc']))
{  					  
	$ban_id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['del_loc']);
	mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `ban_loc` WHERE ban_id='$ban_id'");
	echo "<script>alert('Location Deleted');</script>";	
}
 
 ?>
  
    
    <script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		var messages = {
		    global_view: '- will resize to 300px * 250px',
			country_view: '- will resize to 300px * 250px',
			conti_view: '- will resize to 300px * 250px',
			state_view: '- will resize to 300px * 250px',
			local_view: '- will resize to 300px * 250px',
			big_ad: '- will resize to 460px * 250px',
			bottom_ad: '- will resize to 300px * 430px',
			"": ''
		}
		$('select').change(function() {
			$('#message').text(messages[$(this).val()]);
		});
		});//]]> 
	
	</script>
     <style>
 .location{
	 display:none
 }
 </style>
    <script type="text/javascript">
$(document).ready(function(){
$(".set_country").click(function() 
{
$(".location").show();
});
});$(document).ready(function(){
$(".unset_country").click(function() 
{
$(".location").hide();
});
});
</script>
    

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard 
            <small>Version 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li class="active">Ad Manager</li>
            <li class="active">Edit Banner Ad</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Banner Ad</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php
				$edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM banner_ads where ad_id={$_GET['ad_id']}") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
				while($results = mysqli_fetch_array($edit_post))
				{
						$ad_title = $results['ad_title'];
						$ad_tag = $results['ad_tag'];
						$ad_order = $results['ad_order'];
						$target_url = $results['target_url'];
						$ad_expiry =$results['ad_expiry'];
						$ad_type = $results['ad_type'];
						$tracking_id= $results['tracking_id'];
						$ad_image = $results['ad_image'];
						$ad_status = $results['ad_status'];												
						$hash =$results['hash_key'];
						if($ad_type=='global_view'){$ban_adid='b'.$_GET['ad_id'];}else{$ban_adid=$_GET['ad_id'];}
						
				?>
                
                 <?php if(!empty($err_sin)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <p><?php  echo "$err_sin";?></p>
              </div>
              </div>
              <?php } ?>
              <?php if(!empty($done)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
                <p><?php  echo "$done";?></p>
				 <p><?php  echo "$done2";?></p>
              </div>
              </div>
             	 <?php } ?>
               
                <form action="" method="post" enctype="multipart/form-data">
                	
                  <div class="box-body">
                    <div class="form-group">
                    <input name="hash" value="<?php echo $hash?>" type="hidden" required>
                      <label>Title *</label>
                      <input class="form-control" name="ad_title" value="<?php echo $ad_title?>"   placeholder="Enter Ad Title" type="text" required>
                    </div>
                   
                   <div class="form-group">
                      <label>Tags / Short Description *</label>
                      <input class="form-control" name="ad_tag" value="<?php echo $ad_tag ?>"   placeholder="Enter Tags / Short Description" type="text" required>
                    </div>
                   
                    <div class="form-group">
                      <label>Target Url *</label>
                      <input class="form-control" name="target_url" value="<?php echo $target_url ?>"   placeholder="Enter Target Url" type="url" required>
                    </div>
                    <div class="form-group">
                      <label>Ad Type *</label>
                      <select class="form-control" name="ad_type" required>
                      	<option value="">--Select Ad Type--</option>
                        <option <?php  if($ad_type=="global_view"){ echo "selected";} ?> value="global_view">Rectangle Ad (Global View)</option>
                        <option <?php  if($ad_type=="conti_view"){ echo "selected";} ?> value="conti_view">Rectangle Ad (Continent View)</option>
                        <option <?php  if($ad_type=="country_view"){ echo "selected";} ?> value="country_view">Rectangle Ad (Country View)</option>
                        <option <?php  if($ad_type=="state_view"){ echo "selected";} ?> value="state_view">Rectangle Ad (State View)</option>
                        <option <?php  if($ad_type=="local_view"){ echo "selected";} ?> value="local_view">Rectangle Ad (Local View)</option>
                        <option <?php  if($ad_type=="big_ad"){ echo "selected";} ?> value="big_ad">Big Rectangle Ad (Home Page)</option>
                        <option <?php  if($ad_type=="bottom_ad"){ echo "selected";} ?> value="bottom_ad">Bottom Rectangle Ad (Article Page)</option>
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label>Current Banner Image</label>
                       <br /><img src="<?php echo "../uploads/ads/$hash/thumb/$ad_image" ?>" width="90"  /><br />
                    </div>  
                    <div class="form-group"> 
                       <label>To Change Banner Image  <span id="message"></span></label>
                      <input type="file"  name="files">
                    </div>
                    <div class="form-group">
                      <label>Priority Level  </label>
                      <select class="form-control"  name="ad_order">
                      <option value="">--Select Priority Level--</option>
                      <option <?php  if($ad_order=="1"){ echo "selected";} ?> value="1">1</option>
                      <option <?php  if($ad_order=="2"){ echo "selected";} ?> value="2">2</option>
                      <option <?php  if($ad_order=="3"){ echo "selected";} ?>  value="3">3</option>
                      <option <?php  if($ad_order=="4"){ echo "selected";} ?> value="4">4</option>
                      <option <?php  if($ad_order=="5"){ echo "selected";} ?> value="5">5</option>
                      <option <?php  if($ad_order=="6"){ echo "selected";} ?> value="6">6</option>
                      <option <?php  if($ad_order=="7"){ echo "selected";} ?> value="7">7</option>
                      <option <?php  if($ad_order=="8"){ echo "selected";} ?> value="8">8</option>
                      <option <?php  if($ad_order=="9"){ echo "selected";} ?> value="9">9</option>
                      <option <?php  if($ad_order=="10"){ echo "selected";} ?> value="10">10</option>
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label>Ad Expires On * </label>
                      <input class="form-control" type="text" name="ad_expiry" placeholder="yyyy-mm-dd" value="<?php echo $ad_expiry?>" required/>
                      
                    </div>
                    <div class="form-group">
					 <?php if($ad_type=="global_view"){ $click_tracker="g_click_tracker";}else{$click_tracker="click_tracker";} ?>
                      <label>Google Tracking Code - Use this URL : <?php echo "http://".$_SERVER['HTTP_HOST']."/".$click_tracker."/".$hash."/".$ban_adid?></label>
                      <textarea class="form-control" name="tracking_id" placeholder="Insert Code Here"><?php echo $tracking_id ?></textarea>
                      
                    </div>
                    
                     <div class="form-group">
                     <input name="location" id="optionsRadios1" class="unset_country" checked type="radio">
					
					 <?php
					 $i=0;
					 $edit_post = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ban_loc where ad_id={$_GET['ad_id']}") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($results = mysqli_fetch_array($edit_post))
						{
						$post_city = $results['post_city'];
						$post_state = $results['post_state'];
						$post_country =$results['post_country'];
						$post_continent =$results['post_continent'];
						$ban_id =$results['ban_id'];
						$i++;
						if($ad_type=="conti_view"){ echo "<b>Location - $i </b>". $post_continent; }
						else{ echo "<b>Location - $i </b>". $post_city." ,".$post_state." ,".$post_country; }
						 ?> <input type="image" src="images/cross.png" value="<?php echo $ban_id?>" name="del_loc" /><br />
					  <?php } 
					  if(empty($post_country) and empty($post_continent)){
						  if($ad_type=="global_view"){ echo "<b>Current Location - Global </b>"; } 
						  else {echo "<b>Current Location - </b> <span>None (Please select a loction to display your ad)</span> ";}
						  }  ?>
                      
                      
                       <br /> <input name="location" class="set_country" id="optionsRadios1"  type="radio">
                    <label>Add Location </label>
                      
                      
                      
                    </div>
                   
                    
                    <div class="form-group">
                     
         			  <table width="100%" class="location" border="0" cellspacing="0" cellpadding="0">
                      <?php if($ad_type=="conti_view"){ ?>
                        <tr><td>
                        <label>Continent: </label>
                        <div class="form-group">
                        <select name="continent"  class="country form-control">
                        <option class="col-md-12" value="">-- Select Continent --</option>
                        <option value="Africa">Africa</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Asia">Asia</option>
                        <option value="Europe">Europe</option>
                        <option value="North America">North America</option>
                        <option value="Oceania">Oceania</option>
                        <option value="South America">South America</option>                                        
                        </select>
                        </div>
                        </td></tr>
                      <?php }else {?>
                      	<tr><td><label>Country: </label>
                        <div class="form-group">
                        <select name="country"  class="country form-control">
                        <option class="col-md-12" value="">-- Select Location --</option>
                        <?php include ('../subs/country_opt.php') ?>
                        </select>
                        </div></td>
                        </tr>
                        <tr id="state">
                        <td>
                        <div class="form-group">
                        <label>State or Province</label> 
                        
                        <div align="center"><img id="img1" src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/assets/images/load.gif"/>  </div>        
                        <select id="display" name="state"  style="width:100%"  class="state form-control" >
                        
                        </select>
                        </div>
                        </td>
                        </tr>
                        <tr id="city">
                        <td>
                        <div class="form-group">
                        <label>City or Municipality</label>
                        
                        <div align="center"><img id="img2" src="<?php echo "http://".$_SERVER['HTTP_HOST']?>/assets/images/load.gif"/></div>
                        <select id="display2" name="city"  style="width:100%"  class="search2 form-control" >
                        
                        </select>
                        </div>
                        </td>
                        </tr>
                      <?php } ?>
                      </table>                      
                    </div>
                    
                    <div class="form-group">
                      <label>Ad Status</label>
                      <div class="radio">
                        <label>
                          <input name="ad_status" id="optionsRadios1" value="1" <?php if($ad_status=="1"){echo 'checked=""';}?> type="radio">
                          <span class="label label-success">Active</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="ad_status" id="optionsRadios1" value="0" <?php if($ad_status=="0"){echo 'checked=""';}?> type="radio">
                          <span class="label label-danger">Inactive</span>
                        </label>
                      </div>
                    </div>
                    
                    
                  </div><!-- /.box-body -->
 					
                  <div class="box-footer">
                    <button type="submit" name="edit_banner_ad" class="btn btn-primary">Update Banner Ad</button> 
                  </div>
                </form>
                
               <?php } ?>
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
