<?php

session_start();
include ('../subs/connect_me.php');
include ('../subs/functions.php');
if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php'); 

  if (isset($_GET['active']) and isset($_GET['check']) and ($_GET['check'])!="" )

{

	$array[] = $_GET['check'];

	

	foreach ( $array as $key => $value )

	{

		$value; 	

		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `active`= '1' WHERE id IN ('" . implode("','",$value) . "')");

	}	

	echo "<script>alert('Active');</script>";	

	

}

if (isset($_GET['block']) and isset($_GET['check']) and ($_GET['check'])!="" )

{

	$array[] = $_GET['check'];

	

	foreach ( $array as $key => $value )

	{

		$value; 	

		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `user` SET `active`= '0' WHERE id IN ('" . implode("','",$value) . "')");

	}	

	echo "<script>alert('Blocked');</script>";	

	

}

if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )

{
	$array[] = $_GET['check'];

	foreach ( $array as $key => $value )
	{
	   $query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_comments` WHERE `user_id` IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		while($data=mysqli_fetch_array($query))
		{
			if($data['stock_image']!=NULL){unlink('..'.$data['stock_image']);}				
		}
		$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_replies` WHERE `user_id` IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		while($data2=mysqli_fetch_array($query))
		{
			if($data2['stock_image']!=NULL){unlink('..'.$data2['stock_image']);}				
		}
		RemoveEmptySubFolders('../assets/images/');
		$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_replies` where user_id IN ('" . implode("','",$value) . "')");
		$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_comments` WHERE user_id IN ('" . implode("','",$value) . "')");
		
		//mysql_query("DELETE FROM `user` WHERE id IN ('" . implode("','",$value) . "')");

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

            <li><a href="#">Users</a></li>

            <li class="active">View Users</li>

          </ol>

        </section>

<form action="#" method="get">

        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box">

                <div class="box-header">

                  <h3 class="box-title">View User Information</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

               

                  <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">

                  <div class="col-xs-4"><button type="submit" name="active" class="btn btn-block btn-success">Active</button></div>

                  <div class="col-xs-4"><button type="submit" name="block" class="btn btn-block btn-danger">Block</button></div>

                  <div class="col-xs-4"><button type="submit" name="del_me" class="btn btn-block btn-warning">Delete</button></div>

                  </div>

                  <table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                      	<th><input type="checkbox" id="selecctall"/></th>

                      	<th>Name</th>
                      	<th>Username</th>
					   <th>Purpose</th>
                       <th>Phone</th>
                       <th>Created On</th>
                       <th>Status</th> 
                       <th>Group</th>
                       <th>Email</th>                     

                      </tr>

                    </thead>

                    <tbody>

                    <?php  

					$admin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user  ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

					while($results = mysqli_fetch_array($admin))

					{	

						$id=$results['id'];
						$fname=$results['fname'];
						$lname=$results['lname'];
						$email=$results['email'];
						$subject=$results['subject'];
						$phone=$results['phone'];
						$group=$results['group'];
						$location=ucfirst($results['post_state']).", ".ucfirst($results['post_country']);
					 	$doc=$results['doc'];
						$active=$results['active'];						 

					?>

                      <tr style="text-transform:capitalize;">

                      	 <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $id ?>"  /></td>

                      

                       	 <td><?php echo $fname." ".$lname ?></td>
                       	 <td><?php echo $results['username']?></td>
                         <td><?php if($subject==''){$subject='Unknown';} echo $subject ?></td>
                         <td><?php echo $phone ?></td>
                         <td><?php echo $doc ?></td>
                         <td><span class="label <?php if($active=="1"){echo "label-success"; $status="Active";} else if($active=="0"){echo "label-warning"; $status="Inactive";} else{echo "label-danger"; $status="Blocked";}?>"><?php echo $status ?></span></td>
                         <td><?php if($group==''){$group='Group is not set';} else if($group=='affiliate'){echo 'Editor';} else {echo $group;} ?></td>
                         <td><a style="text-transform: lowercase;" href="edit_user.php?id=<?php echo $id ?>"><?php echo $email ?></a></td>
                        
                      </tr>   

                    <?php }?>                               

                    </tbody>

                    <tfoot>

                      <tr>

                      <th></th>

                       <th>Name</th>
                       <th>Username</th>
					   <th>Purpose</th>
                       <th>Phone</th>
                       
                       <th>Created On</th>
                       <th>Status</th> 
                       <th>Group</th>
                       <th>Email</th>
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

