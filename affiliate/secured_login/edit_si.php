<?php
session_start();

include ('../subs/connect_me.php');


if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');

if(isset($_POST['edit_serv']))
{  					  
$serv_info=mysql_real_escape_string($_POST['serv_info']);
$serv_add=mysql_real_escape_string($_POST['serv_add']);
$serv_price=mysql_real_escape_string($_POST['serv_price']);
$serv_type=mysql_real_escape_string($_POST['serv_type']);
$serv_up=date("Y-m-d");
$serv_status=mysql_real_escape_string($_POST['serv_status']);
$cs_id2=mysql_real_escape_string($_POST['cs_id2']);



$err_sin="";
	if($cs_id2==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Category  is Empty <br>";}
	if($serv_info==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Service Rate Info is Empty <br>";} 
	if($serv_price==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Price is Empty <br>";}
	if($serv_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Type is Empty <br>";}
	if($serv_status==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Service Rate Status is Empty <br>";}
	
	
	
	if(empty($err_sin)) 
	{
							
		$cs_id = mysql_query("SELECT * FROM service_cat where `cs_id`='$cs_id2'") or die(mysql_error()); 
						while($cs_result = mysql_fetch_array($cs_id))
						{
							$cs_status1=$cs_result['cs_status'];
						}
		
		$insert_ok = mysql_query("UPDATE `service` SET `serv_info`='$serv_info',`serv_add`='$serv_add',`serv_price`='$serv_price',`serv_type`='$serv_type',`serv_up`='$serv_up',`serv_status`='$serv_status' ,`cs_id`='$cs_id2',`cs_status`='$cs_status1' WHERE serv_id='{$_GET['serv_id']}'")or die(mysql_error());
		if($insert_ok == 1)
		{
			$done ="<i class=\"icon fa fa-info\"></i> Service Rate Updated Successfully. <br>";
			
		}
		else
		{
			echo "<script>
			alert('Error!!!');
			</script>";	
		}		
		
	}
}

 
 ?>
 <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
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
             <li><a href="#">Service Rate Info</a></li>
            <li class="active">Edit Service Rate</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Service Rate</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php
				$edit_service = mysql_query("SELECT * FROM service where serv_id={$_GET['serv_id']}") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_service))
				{
						$serv_info = $results['serv_info'];
						$serv_add = $results['serv_add'];						
						$serv_price =$results['serv_price'];
						$serv_type = $results['serv_type'];
						$serv_doc= $results['serv_doc'];
						$serv_status = $results['serv_status'];
						$cs_id = $results['cs_id'];
						
						$cs_id = mysql_query("SELECT * FROM service_cat where `cs_id`='$cs_id'") or die(mysql_error()); 
						while($vc_result = mysql_fetch_array($cs_id))
						{
							$cs_name=$vc_result['cs_name'];
						}
				}
												
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
              </div>
              </div>
              <?php } ?>
                
                <form role="form" action="" method="post">
                	
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label>Category *</label>                      
                      <select class="form-control" required="required"  name="cs_id2">
                      <option value="">-Change Category-</option>
                      	<?php $cs_id = mysql_query("SELECT * FROM service_cat") or die(mysql_error()); 
						while($cs_result = mysql_fetch_array($cs_id))
						{
							$cs_name2=$cs_result['cs_name'];
							$cs_id2=$cs_result['cs_id'];
						
						?>
                        <option <?php echo "value=\"$cs_id2\"";if($cs_name2==$cs_name){echo "selected";} ?>><?php echo $cs_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label>Service Rate Info *</label>
                       <textarea class="form-control" name="serv_info"  required="required"  placeholder="Enter Service Rate Info"><?php echo $serv_info?></textarea>
                      
                     
                    </div>
                    <div class="form-group">
                      <label>Service Rate Additional Info</label>
                      <input class="form-control" name="serv_add"  placeholder="Service Rate Additional Info" value="<?php echo $serv_add?>" type="text">
                    </div>
                  <div class="form-group">
                      <label>Price* (USD)</label>
                      <input class="form-control" required="required" name="serv_price"  placeholder="Enter Price" value="<?php echo $serv_price?>" type="text">
                    </div>
                    
                    
                    <div class="form-group">
                      <label>Service Rate Type</label>
                      <div class="radio">
                        <label>
                          <input name="serv_type" <?php if($serv_type=="1"){echo 'checked=""';}?> value="1" type="radio"> <span class="label label-success">Show Buy Button</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="serv_type" <?php if($serv_type=="0"){echo 'checked=""';}?> value="0"  type="radio">
                          <span class="label label-danger">Contant for Price</span>
                        </label>
                      </div>
                    </div>
                    
                   
                    
                    <div class="form-group">
                      <label>Service Rate Status</label>
                      <div class="radio">
                        <label>
                          <input name="serv_status" <?php if($serv_status=="1"){echo 'checked=""';}?> value="1" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="serv_status" <?php if($serv_status=="0"){echo 'checked=""';}?> value="0"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="edit_serv" class="btn btn-primary">Update Service Rate</button> 
                    
                  </div>
                </form>
              
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
