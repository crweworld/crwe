<?php
session_start();

include ('../subs/connect_me.php');
include('../subs/functions.php');
include('../subs/searchloc.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 $admin_id = $_SESSION['id'];
 
 
 if(isset($_POST['add_pop_ad']))
{
	$ad_title = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_title']);
	$ad_tag = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_tag']);
	$target_url = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['target_url']);
	$ad_expiry = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_expiry']);
	$ad_type = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['ad_type']);
	
	
	
	$ad_doc=date("Y-m-d") ;
	$hash=bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
	
	
		$_SESSION['width']=300; $_SESSION['height']=200;
	
	
	$err_sin="";
	$post_zipid="";
	if($ad_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($ad_tag==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Tags / Short Description is Empty <br>";}
	if($target_url==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Target Url is Empty <br>";}
	if($ad_expiry==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Enter Ad Expire Date <br>";}
	if($ad_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Select Ad Type <br>";}
	
	if($ad_type=='global_view')
	{
		$zsql2="SELECT * FROM pop_ads WHERE ad_type='global_view'";
		$result2=mysqli_query($GLOBALS["___mysqli_ston"], $zsql2);
		$count2=mysqli_num_rows($result2);
		if($count2==1)
		{
			 $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Global View is used already <br>";
		}
	}
	
	
	$_SESSION['ad_title']="$ad_title";
	$_SESSION['ad_tag']="$ad_tag";
	$_SESSION['target_url']="$target_url";
	$_SESSION['ad_expiry']="$ad_expiry";
	$_SESSION['ad_type']="$ad_type";
	
	
	
	if(empty($err_sin))
	{
		
		
		
		
		/*zippy*/	
	include('../subs/zippy.php');	
    /*zippy*/
	
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `pop_ads`(`admin_id`,`hash_key`, `ad_title`, `ad_tag`, `target_url`, `ad_doc`, `ad_expiry`, `ad_status`, `ad_type`) VALUES ('$admin_id','$hash','$ad_title', '$ad_tag', '$target_url', '$ad_doc', '$ad_expiry', '1',  '$ad_type')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			
	
		if($insert_ok == 1)
			{
				$insert_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);	
				
				if(!empty($post_zipid))
					{
						$zsql="SELECT pop_loc.zip_id, pop_ads.ad_type,pop_ads.ad_title		
											 
								FROM pop_loc
								LEFT JOIN pop_ads
								ON pop_loc.ad_id=pop_ads.ad_id
																
								WHERE pop_loc.zip_id='$post_zipid' and pop_ads.ad_type='$ad_type'";	
								
						$result=mysqli_query($GLOBALS["___mysqli_ston"], $zsql)or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
						$count=mysqli_num_rows($result);						
						
						if($count==0)
						{
							mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `pop_loc`(`ad_id`, `zip_id`, `ad_imp`, `ad_unq_imp`, `ad_clicks`, `ad_unq_clicks`,  `post_state`, `post_city`, `post_local`, `post_country`, `post_zipcode`) VALUES ('$insert_id','$post_zipid','0','0','0','0','$post_state','$post_city','$post_local','$post_country','$post_zipcode')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));				
						}
						else
						{
							mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_ads` SET `ad_status`='0' where ad_id='$insert_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));	
							
							$info=mysqli_fetch_array($result);
							$ad_title=$info['ad_title'];
							
							echo "<script>alert('Error!!! Location already used by \"$ad_title\"');window.location.href='edit_pop_ads.php?ad_id=$insert_id';</script>";
						
						}
											
						
					}
				
				if(isset($_FILES['files']))
				{
					$errors= array();					
					$file_name = strtolower($_FILES['files']['name']);
					$file_size =$_FILES['files']['size'];
					$file_tmp =$_FILES['files']['tmp_name'];
					$file_type=$_FILES['files']['type'];	
					$kaboom = explode(".", $file_name); // Split file name into an array using the dot
					$fileExt = end($kaboom);
					
					
					if($fileExt!="jpg" and $fileExt!="png")
					{
						unset($_SESSION['ad_title']); unset($_SESSION['ad_tag']);unset($_SESSION['target_url']);unset($_SESSION['ad_expiry']);unset($_SESSION['ad_type']);unset($_SESSION['width']);unset($_SESSION['height']);	
						echo "<script>alert('Image File is Invalid, Please Upload Again');window.location.href='edit_pop_ads.php?ad_id=$insert_id';</script>"; 
					}
					else if($file_size > 2097152)
					{
						unset($_SESSION['ad_title']); unset($_SESSION['ad_tag']);unset($_SESSION['target_url']);unset($_SESSION['ad_expiry']);unset($_SESSION['ad_type']);unset($_SESSION['width']);unset($_SESSION['height']);	
						echo "<script>alert('File size must be less than 2 MB');window.location.href='edit_pop_ads.php?ad_id=$insert_id';</script>"; 
					}
					
					elseif($file_size > 0 )
					{
						$dirPath = "../uploads/pop/$hash";
						$dirPath2 = "../uploads/pop/$hash/thumb";
		
						if (!file_exists("$dirPath")) 
						{
							mkdir("$dirPath", 0755, true);
						}
						
						if (!file_exists("$dirPath2")) 
						{
							mkdir("$dirPath2", 0755, true);
						}	
												
						$moveResult = move_uploaded_file($file_tmp, "../uploads/pop/$hash/$file_name");
					 
						include_once("../subs/ak_php_img_lib_1.0.php");
						$target_file = "../uploads/pop/$hash/$file_name";
						$resized_file = "../uploads/pop/$hash/thumb/$file_name";
						$wmax = $_SESSION['width'];
						$hmax = $_SESSION['height'];					
						ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);	
						
						mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `pop_ads` SET `ad_image`='$file_name' where ad_id='$insert_id'")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
						$done="Popup Ad is Created";
						unset($_SESSION['ad_title']); unset($_SESSION['ad_tag']);unset($_SESSION['target_url']);unset($_SESSION['ad_expiry']);unset($_SESSION['ad_type']);unset($_SESSION['width']);unset($_SESSION['height']);														
					}
					else
					{
						unset($_SESSION['ad_title']); unset($_SESSION['ad_tag']);unset($_SESSION['target_url']);unset($_SESSION['ad_expiry']);unset($_SESSION['ad_type']);unset($_SESSION['width']);unset($_SESSION['height']);	
						echo "<script>alert('Invalid File');window.location.href='edit_pop_ads.php?ad_id=$insert_id';</script>";
					}
					
				}										
			}
	}
	
	
}
else
{
	unset($_SESSION['ad_title']); unset($_SESSION['ad_tag']);unset($_SESSION['target_url']);unset($_SESSION['ad_expiry']);unset($_SESSION['ad_type']);unset($_SESSION['width']);unset($_SESSION['height']);
}

 
 
 ?>


  <!-- CK Editor -->
    <script src="../assets/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
    
    <script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		var messages = {
		    global_view: '- will resize to 300px * 250px',
			country_view: '- will resize to 300px * 250px',
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
            <li class="active">Create Popup Ad</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Popup Ad</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
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
              </div>
              </div>
              <?php } ?>
               
                <form action="" method="post" enctype="multipart/form-data">
                	
                  <div class="box-body">
                    <div class="form-group">
                      <label>Title *</label>
                      <input class="form-control" name="ad_title" value="<?php if(isset($_SESSION['ad_title'])){ echo $_SESSION['ad_title']; }?>"   placeholder="Enter Ad Title" type="text" required>
                    </div>
                   
                   <div class="form-group">
                      <label>Tags / Short Description *</label>
                      <input class="form-control" name="ad_tag" value="<?php if(isset($_SESSION['ad_tag'])){ echo $_SESSION['ad_tag']; }?>"   placeholder="Enter Tags / Short Description" type="text" required>
                    </div>
                   
                    <div class="form-group">
                      <label>Target Url *</label>
                      <input class="form-control" name="target_url" value="<?php if(isset($_SESSION['target_url'])){ echo $_SESSION['target_url']; }?>"   placeholder="Enter Target Url" type="url" required>
                    </div>
                    <div class="form-group">
                      <label>Ad Type *</label>
                      <select class="form-control" name="ad_type" required>
                      	<option value="">--Select Ad Type--</option>
                        <option <?php if(isset($_SESSION['ad_type'])){ if($_SESSION['ad_type']=="global_view"){ echo "selected";} }?> value="global_view">Global View</option>
                        <option <?php if(isset($_SESSION['ad_type'])){ if($_SESSION['ad_type']=="country_view"){ echo "selected";} }?> value="country_view">Country View</option>
                        <option <?php if(isset($_SESSION['ad_type'])){ if($_SESSION['ad_type']=="state_view"){ echo "selected";} }?> value="state_view">State View</option>
                        <option <?php if(isset($_SESSION['ad_type'])){ if($_SESSION['ad_type']=="local_view"){ echo "selected";} }?> value="local_view">Local View</option>
                      
                      </select>
                      
                    </div>
                    <div class="form-group">
                      <label>Banner Image * - will resize to 300px * 200px</label>
                      <input type="file"  name="files" required>
                    </div>
                    
                     <div class="form-group">
                      <label>Expire Date*</label>
                    <input class="form-control" name="ad_expiry" value="<?php if(isset($_SESSION['ad_expiry'])){ echo $_SESSION['ad_expiry']; }?>"   placeholder="yyyy-mm-dd" type="text" required>
                      	
                    </div>
                   
                    
                    <div class="form-group">
                      <label>Location </label>
         			  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
                            <td><label>Country: </label>
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
                          </table>
                      
                    </div>
                    
                    
                  </div><!-- /.box-body -->
 					
                  <div class="box-footer">
                    <button type="submit" name="add_pop_ad" class="btn btn-primary">Add Popup Ad</button> 
                  </div>
                </form>
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<?php include('footer.php'); ?>
      
