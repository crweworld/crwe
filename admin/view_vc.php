<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
   if (isset($_GET['unpub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `vid_cat` SET `vc_status`= 'unpublish' WHERE vc_id IN ('" . implode("','",$value) . "')");
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vc_status`= 'unpublish' WHERE vc_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Unpublished');</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `vid_cat` SET `vc_status`= 'publish' WHERE vc_id IN ('" . implode("','",$value) . "')");
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `videos` SET `vc_status`= 'publish' WHERE vc_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";		
	
}
if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `vid_cat` WHERE vc_id IN ('" . implode("','",$value) . "')");
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `videos` WHERE vc_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Deleted');</script>";		
	
}
 
 ?>

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
             <li class="active">Video Category</li>
            <li class="active">View Video Category</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Video Category</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                  <div class="col-xs-4"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-4"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-4"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Category Name</th>
                        <th>Created On</th>
                        <th>Status</th>  
                        <th>No of Videos</th>                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vid_cat ORDER BY vc_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($vid_cat))
					{	
						$vc_id=$results['vc_id'];
					 	$vc_name=$results['vc_name'];
					 	$vc_doc=$results['vc_doc'];
						$vc_status=$results['vc_status'];						 
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $vc_id ?>"  /></td>
                        <td><a href="edit_vc.php?vc_id=<?php echo $vc_id ?>"><?php echo $vc_name ?></a></td>
                        <td><?php echo $vc_doc ?></td>
                        <td><span class="label <?php if($vc_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $vc_status ?></span></td>
                        <td><?php  $query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(*) FROM videos where vc_id='$vc_id'");
									$num_sql = mysqli_fetch_array($query);
									echo $numrows = $num_sql[0];?></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th></th>
                        <th>Category Name</th>
                        <th>Created On</th>
                        <th>Status</th>  
                        <th>No of Videos</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
