<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}


 include('header.php');
 include('sidebar.php');
 
 
if(isset($_POST['pic_show'])){
	
	
	$err_sin="";
	
	$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					$profile_pic=$results['profile_pic'];
				}
				
		if($_POST['pic_show']=='Y')
		{
			if($profile_pic=='')
			{
				$err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Your Profile Pic is Empty, Please <a href='edit_profile.php'>upload</a> to continue <br>";
			}
			else
			{
				mysql_query("UPDATE `affi_user` SET `pic_show`='Y' where `id`='{$_SESSION['affi_id']}'")or die(mysql_error());
				echo '<script>window.location.href = "subs/bcard.php";</script>';
				
			}
		}
		else
		{
			mysql_query("UPDATE `affi_user` SET `pic_show`='N' where `id`='{$_SESSION['affi_id']}'")or die(mysql_error());
			echo '<script>window.location.href = "subs/bcard.php";</script>';
		}
}
 
 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 </style>

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
            <li><a href="#">Affiliate Tools</a></li>
            <li class="active">Create Your Business Card</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Your Business Card</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
               
                <?php if(!empty($err_sin)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <p><?php  echo "$err_sin";?></p>
              </div>
              </div>
              <?php } ?>
              
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					
				?>
                <form role="form" action="" method="post">                	
                  <div class="box-body">  
                    
                    <?php if($results['ecard']!=''){?>
                              <p class="col-md-12"><img width="600" src="<?php echo $results['ecard'] ?>"></p>
                              <?php }?>
                              
                      
                    <?php if($results['active']==2) { ?>
                    
                     <div class="form-group col-md-6">
                      <label>I want my business card </label> &nbsp; &nbsp;
                      
                       <select class="form-control" name="pic_show" required>
                        <option value="">Select</option>
                        <option <?php if($results['pic_show']=='Y'){echo 'selected';}?> value="Y">To display my photo</option>
                        <option <?php if($results['pic_show']=='N'){echo 'selected';}?> value="N">Not to display my photo</option>
                        </select>
                   	 </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                   <input type="submit" class="btn btn-primary" value="Update and Preview">
                   <?php if($results['ecard']!=''){?>
                              <a href="<?php echo $results['ecard'] ?>" class="btn btn-success" download>Download</a>
                              <?php }?>
                    
                  </div>
                  
                  <?php } else {?>
                    	<p class="col-md-12">Your profile is not approved yet, Please try later.</p>
                  	<?php }?>
                    
                </form>
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
