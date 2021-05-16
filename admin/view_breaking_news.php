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
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `breaking_news` SET `bn_status`= 'unpublish' WHERE bn_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Unpublished');</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `breaking_news` SET `bn_status`= 'publish' WHERE bn_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";	
	
}
if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `breaking_news` WHERE bn_id IN ('" . implode("','",$value) . "')");
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
            <li><a href="#">News Feed</a></li>
            <li class="active">View Breaking News</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Breaking News</h3>
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
                        <th>Title</th>
                        <th>Created On</th>
                        <th>Updated On</th>  
                        <th>Status</th>                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$users = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  breaking_news ORDER BY bn_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($users))
					{	
						$bn_id=$results['bn_id'];
					 	$bn_title=$results['bn_title'];
					 	$bn_doc=$results['bn_doc'];
						$bn_update=$results['bn_update'];
						$bn_status=$results['bn_status'];						 
					?>
                      <tr style="text-transform:capitalize;">
                        <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $bn_id ?>"  /></td>
                        <td><a href="edit_breaking_news.php?bn_id=<?php echo $bn_id ?>"><?php echo $bn_title ?></a></td>
                        <td><?php echo $bn_doc ?></td>
                        <td><?php echo $bn_update ?></td>
                        <td><span class="label <?php if($bn_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $bn_status ?></span></td>
                        
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th></th>
                        <th>Title</th>
                        <th>Created On</th>
                        <th>Updated On</th>  
                        <th>Status</th>  
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
