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
if(isset($_POST['add_post']))
{  					  

$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);
$source_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['source_url']);
$post_image_loc=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_image_loc']);
$cat_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id2']);


$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts where `post_title`='$post_title'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
$count=mysqli_num_rows($sql);
	
	$err_sin="";
	if($post_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($cat_id2==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Category is Empty <br>";} 
	if($post_description==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Description is Empty <br>";} 
	if($count!=0){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Post Title already exist <br>";} 

	
	
	if(empty($err_sin))
	{	 
		$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
			{
				$cat_status1=$cat_result['cat_status'];
			}
						
		/*zippy*/	
	include('../subs/zippy.php');	
    /*zippy*/					

				$post_description=str_replace("textarea","",$post_description);		
	
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`cat_id`, `cat_status`, `post_title`, `post_description`, `source_url`, `post_doc`, `post_image_loc`, `post_status`, `trend`, `post_state`, `post_city`, `post_country`, `zip_id`, `admin_id`) VALUES ( '$cat_id2','$cat_status1', '$post_title', '$post_description', '$source_url', NOW(), '$post_image_loc', '$post_status', 'localnews', '$post_state', '$post_city', '$post_country','$post_zipid', '$admin_id')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);			
			
			$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
			{
				$cat_name=$cat_result['cat_name'];
			}

			$post_url= "/".txtcleaner($post_country)."/".txtcleaner($post_state)."/".txtcleaner($post_city)."/localnews/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
			
			
			
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET   `post_url`='$post_url' where post_id='$post_id'");
			
			if(isset($_POST['tw_sh']))
			{	include('auto_share/twitter.php'); }
			if(isset($_POST['fb_sh']))
			{	include('auto_share/facebook.php'); }
			$done="Post Created Successfully";				
		}
			
		
	}
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
            <li><a href="#">Local News</a></li>
            <li class="active">Create Local News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Local News</h3>
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
                
                <form role="form" action="" method="post">
                	
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title" id="post_title" required="required"  placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select style="text-transform:capitalize"  class="form-control" required  name="cat_id2">
                      <option value="">-Change Category-</option>
                      	<?php $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_name2=$cat_result['cat_name'];
							$cat_id2=$cat_result['cat_id'];
						
						?>
                        <option <?php echo "value=\"$cat_id2\""; ?>><?php echo $cat_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="3" cols="80" required id="editor1" name="post_description" ></textarea>
                     
                    </div>
                 
                    
                    <div class="form-group">
                      <label for="source_url">Source Url</label>
                      <input class="form-control" type="url" name="source_url"  placeholder="Enter Source Url" >
                    </div>
                    <div class="form-group">
                      <label for="post_image_loc">Source Image</label>
                      <input class="form-control" type="url" name="post_image_loc"  placeholder="Enter Source Image" >
                    </div>
                    <div class="form-group">
                      <label for="location">Location *</label>
           <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
            <td><label>Country: </label>
            <div class="form-group">
<select name="country" required class="country form-control">
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
                    <div class="form-group">
                    <label>Social Shares</label> <br />
                      <label><input type="checkbox" name="fb_sh" checked="checked" /> Facebook </label>&nbsp;&nbsp;
                      <label><input type="checkbox" name="tw_sh" checked="checked" /> Twitter </label>
                    </div>
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" checked value="publish" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_post" class="btn btn-primary">Create Local News</button> 
                    
                  </div>
                </form>
              
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php include('footer.php')?>