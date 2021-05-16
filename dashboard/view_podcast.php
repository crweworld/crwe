<?php
 include('header.php');
 include('sidebar.php');
 
  if (isset($_GET['unpub'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	foreach ( $array as $key => $value )
	{ 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `podcast` SET `status`= '0' WHERE user_id={$_SESSION['pub_id']} and id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Unpublished');</script>";		
	
}
if (isset($_GET['pub'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	foreach ( $array as $key => $value )
	{	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `podcast` SET `status`= '1' WHERE user_id={$_SESSION['pub_id']} and id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');</script>";		
	
}
if (isset($_GET['del_me'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	foreach ( $array as $key => $value )
	{ 	
		$posts=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT location FROM podcast WHERE  user_id={$_SESSION['pub_id']} and id IN ('" . implode("','",$value) . "') ORDER BY id DESC");
		while($results = mysqli_fetch_array($posts)){
			unlink('..'.$results['location']);
			rmdir('../assets/user/'.$_SESSION['pub_id'].'/podcast/'.$value[$key].'/');
		}
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `podcast` WHERE user_id={$_SESSION['pub_id']} and id IN ('" . implode("','",$value) . "')");
		
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
            <li><a href="#">Podcast</a></li>
            <li class="active">View Podcast</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Podcast - <?php if($_SESSION['pub_username']!=''){ echo '<a target="_blank" href="'.$mainserver.'/podcast/'.$_SESSION['pub_username'].'">'.$mainserver.'/podcast/'.$_SESSION['pub_username'].'</a>';}else{echo '<a href="/dashboard/edit_profile.php">Kindly set your username to create podcast link</a>';}?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">   
               <form action="#" method="get">                                
                   <div class="form-group col-xs-12">
                <div class="col-xs-8" style="position: absolute; left: 15%; z-index:10">
                  <div class="col-xs-3"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-3"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                 <!-- <div class="col-xs-3"><button type="submit" name="slider" class="btn btn-block btn-info">Add to Slider</button></div>-->
                  </div></div>
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
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM podcast WHERE  user_id={$_SESSION['pub_id']} ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					while($results = mysqli_fetch_array($posts))
					{	
										 
					?>
                      <tr>
                      <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $results['id']?>"  /></td>
                        <td><a href="edit_podcast.php?podid=<?php echo $results['id'] ?>"><?php echo $results['title'] ?></a></td>
                        <td><?php echo $results['created_on'] ?></td>
                        <td><?php echo $results['updated_on'] ?></td>
                        <td><span class="label <?php if($results['status']=="1"){echo "label-success"; $status="Published";} else{echo "label-warning"; $status="Unpublished";} ?>"><?php echo $status; ?></span></td>
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
                </form>      
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
       
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
