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
		 mysql_query("UPDATE `service` SET `serv_status`= '0' WHERE serv_id IN ('" . implode("','",$value) . "')");	
		
	}	
	echo "<script>alert('Unpublished');</script>";	
	
}
if (isset($_GET['pub']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysql_query("UPDATE `service` SET `serv_status`= '1' WHERE serv_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";		
	
}
if (isset($_GET['del_me'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	
	foreach ( $array as $key => $value )
	{					
		mysql_query("DELETE FROM `service` WHERE serv_id IN ('" . implode("','",$value) . "')");
		mysql_query("DELETE FROM `pop_loc` WHERE serv_id IN ('" . implode("','",$value) . "')");
	}
		
		
	echo "<script>alert('Deleted');
	</script>";		
	
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
             <li class="active">Service Rate</li>
            <li class="active">View Service Rate</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><span class="active">View Service Rate</span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="" method="get">
                <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                  <div class="col-xs-4"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-4"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                 </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Service Info</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Created On</th>
                        <th>Status</th>                                           
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysql_query("SELECT * FROM service ORDER BY serv_id") or die(mysql_error()); 
					while($results = mysql_fetch_array($vid_cat))
					{	
						$serv_id=$results['serv_id'];
					 	$serv_status=$results['serv_status'];
						$serv_price=$results['serv_price'];
						$serv_info=$results['serv_info'];
						$cs_id=$results['cs_id'];
						$serv_doc=$results['serv_doc'];
						$cs_status=$results['cs_status'];
						
						$service_cat = mysql_query("SELECT * FROM service_cat where cs_id='$cs_id'") or die(mysql_error()); 
							while($results = mysql_fetch_array($service_cat))
							{	
								$cs_name=$results['cs_name'];
								
							}
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $serv_id ?>"  /></td>
                        <td><a href="edit_si.php?serv_id=<?php echo $serv_id ?>"><?php echo $serv_info ?></a></td>
                         <td><span class="label <?php if($cs_status=="1"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $cs_name ?></span></td>
                        
                        <td>$ <?php echo $serv_price ?></td>
                        <td><?php echo $serv_doc ?></td>
                        <td><span class="label <?php if($serv_status=="1"){echo "label-success"; $post_status="Published";} else{echo "label-warning"; $post_status="Unpublished";} ?>"><?php echo $post_status ?></span></td>
                         
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Service Info</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Created On</th>
                        <th>Status</th>  
                      </tr>
                    </tfoot>
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
