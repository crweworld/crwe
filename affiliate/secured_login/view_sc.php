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
		mysql_query("UPDATE `service_cat` SET `cs_status`= '0' WHERE cs_id IN ('" . implode("','",$value) . "')");
		mysql_query("UPDATE `service` SET `cs_status`= '0' WHERE cs_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Unpublished');</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysql_query("UPDATE `service_cat` SET `cs_status`= '1' WHERE cs_id IN ('" . implode("','",$value) . "')");
		mysql_query("UPDATE `service` SET `cs_status`= '1' WHERE cs_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";		
	
}
if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysql_query("DELETE FROM `service_cat` WHERE cs_id IN ('" . implode("','",$value) . "')");
		mysql_query("DELETE FROM `service` WHERE cs_id IN ('" . implode("','",$value) . "')");
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
             <li class="active">Service Rate Category</li>
            <li class="active">View Service Rate Category</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Service Rate Category</h3>
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
                        <th>No of Services</th>                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$service_cat = mysql_query("SELECT * FROM service_cat ORDER BY cs_id") or die(mysql_error()); 
					while($results = mysql_fetch_array($service_cat))
					{	
						$cs_id=$results['cs_id'];
					 	$cs_name=$results['cs_name'];
					 	$cs_doc=$results['cs_doc'];
						$cs_status=$results['cs_status'];						 
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $cs_id ?>"  /></td>
                        <td><a href="edit_sc.php?cs_id=<?php echo $cs_id ?>"><?php echo $cs_name ?></a></td>
                        <td><?php echo $cs_doc ?></td>
                        <td><span class="label <?php if($cs_status=="1"){echo "label-success"; $status="Published";} else{echo "label-warning";$status="Unpublished";} ?>"><?php echo $status ?></span></td>
                        <td><?php  $query = mysql_query("SELECT COUNT(*) FROM service where cs_id='$cs_id'");
									$num_sql = mysql_fetch_array($query);
									echo $numrows = $num_sql[0];?></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Category Name</th>
                        <th>Created On</th>
                        <th>Status</th>  
                        <th>No of Services</th>  
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
