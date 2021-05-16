<?php
session_start();

include ('../subs/connect_me.php');
if(isset($_SESSION['group']))
{
	if($_SESSION['group']!=("superadmin" or "miniadmin"))
	{
		header('Location:logout.php');
	}
}
 include('header.php');
 include('sidebar.php');

if(isset($_POST['add_video']))
{  					  

$vid_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_status']);
$vid_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_title']);
$vid_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_description']);
$vid_url=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_url']);
$vid_type=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vid_type']);
if($vid_type==0){ 
	//$vidurl=substr($vid_url, strpos($vid_url, "=") + 1);
	$vid_url=end(explode('v=',$vid_url));
	$vid_len= strlen($vid_url);
}else{
	$vid_url=end(explode('/',$vid_url));
	$vid_len= strlen($vid_url);
}

$vc_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['vc_id2']);
$vid_doc=date("Y-m-d") ;


$err_sin="";
	if($vid_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($vc_id2==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Category is Empty <br>";} 
	if($vid_url==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Video Url is Empty <br>";}
	if($vid_type==0){ 
		if($vid_len!=11){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Invalid Youtube Link <br>";} 
	}else{
		if($vid_len!=10){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Invalid Crwetube Link <br>";} 
	}
	
		
	if(empty($err_sin))
	{							
		$vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat where `vc_id`='$vc_id2'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_status1=$vc_result['vc_status'];
						}
		
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `videos`(`vc_id`,`vc_status`, `vid_title`, `vid_description`, `vid_url`, `vid_type`, `vid_doc`, `vid_status`) VALUES ( '$vc_id2','$vc_status1', '$vid_title', '$vid_description', '$vid_url', '$vid_type', '$vid_doc', '$vid_status')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			$done='Video Created Successfully';
		}		
	}
}

 
 ?>
 <!-- CK Editor -->
    <script src="../assets/ckeditor/ckeditor.js"></script>
   

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
             <li><a href="#">Video</a></li>
            <li class="active">Create Video</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Video</h3>
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
                      <label for="vid_title">Title *</label>
                      <input class="form-control" name="vid_title" id="vid_title" required="required"  placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select class="form-control" required="required"  name="vc_id2">
                      <option value="">-Change Category-</option>
                      	<?php $vc_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($vc_result = mysqli_fetch_array($vc_id))
						{
							$vc_name2=$vc_result['vc_name'];
							$vc_id2=$vc_result['vc_id'];
						
						?>
                        <option <?php echo "value=\"$vc_id2\""; ?>><?php echo $vc_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description </label>
                      <textarea class="ckeditor form-control" rows="3" cols="80" required="required" id="editor1" name="vid_description" ></textarea>                     
                    </div>
                    <div class="form-group">
                      <label>Type *</label>
                      <select class="form-control" required="required" id="vid_type"  name="vid_type">
                      	<option value="0">Youtube</option>
                        <option value="1">Crwetube</option>
                      </select>                
                    </div>
                 
                    
                    <div class="form-group" >
                      <label id="youtube" style="display:block">Youtube Url*</label>
                      <label id="crwetube" style="display:none">Crwetube Url*</label>
                      <input class="form-control" required="required" name="vid_url"  placeholder="Enter Source Url" type="url">
                    </div>
                    
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="vid_status" checked value="publish" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="vid_status"  value="unpublish"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_video" class="btn btn-primary">Create Video</button> 
                    
                  </div>
                </form>
                
            
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
<script type="text/javascript">
$(document).ready(function(){
$("#vid_type").change(function(){var a=$(this).val();"0"==a?($("#youtube").show(),$("#crwetube").hide()):($("#crwetube").show(),$("#youtube").hide())});  
});
</script> 