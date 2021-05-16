<?php

session_start();

include ('../subs/connect_me.php');
 include('header.php');
 include('sidebar.php');

if($_SESSION['group']!=("superadmin"))
{
	header('Location:logout.php');
}





 

  if (isset($_GET['active']) and isset($_GET['check']) and ($_GET['check'])!="" )

{

	$array[] = $_GET['check'];

	

	foreach ( $array as $key => $value )

	{

		$value; 	

		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `admin` SET `active`= '1' WHERE id IN ('" . implode("','",$value) . "')");

	}	

	echo "<script>alert('Active');</script>";	

	

}

if (isset($_GET['inactive']) and isset($_GET['check']) and ($_GET['check'])!="" )

{

	$array[] = $_GET['check'];

	

	foreach ( $array as $key => $value )

	{

		$value; 	

		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `admin` SET `active`= '0' WHERE id IN ('" . implode("','",$value) . "')");

	}	

	echo "<script>alert('Inactive');</script>";	

	

}

if (isset($_GET['del_me']) and isset($_GET['check']) and ($_GET['check'])!="" )

{

	$array[] = $_GET['check'];

	

	foreach ( $array as $key => $value )

	{

	   $value; 	

		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `admin` WHERE id IN ('" . implode("','",$value) . "')");

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

            <li><a href="#">Mini Admin</a></li>

            <li class="active">View Mini Admin</li>

          </ol>

        </section>

<form action="#" method="get">

        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box">

                <div class="box-header">

                  <h3 class="box-title">View Editors Information</h3>

                </div><!-- /.box-header -->

                <div class="box-body">

               

                  <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">

                  <div class="col-xs-4"><button type="submit" name="active" class="btn btn-block btn-success">Active</button></div>

                  <div class="col-xs-4"><button type="submit" name="inactive" class="btn btn-block btn-warning">Inactive</button></div>

                  <div class="col-xs-4"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>

                  </div>

                  <table id="example1" class="table table-bordered table-striped">

                    <thead>

                      <tr>

                      	<th><input type="checkbox" id="selecctall"/></th>

                      	<th>Name</th>
					   <th>Purpose</th>
                       <th>Phone</th>
                       <th>Username</th>
                       <th>Created On</th>
                       <th>Status</th> 
                       <th>Group</th>
                       <th>Email</th>
                       <th>Location</th>                       

                      </tr>

                    </thead>

                    <tbody>

                    <?php  

					$admin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM admin ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 

					while($results = mysqli_fetch_array($admin))

					{	

						$id=$results['id'];
					 	$username=$results['username'];
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
                         <td><?php if($subject==''){$subject='Unknown';} echo $subject ?></td>
                         <td><?php echo $phone ?></td>
                         <td><?php if($username==''){$username='Username is not set';}echo $username ?></td>
                         <td><?php echo $doc ?></td>
                         <td><span class="label <?php if($active=="1"){echo "label-success"; $status="Active";} else{echo "label-warning"; $status="Inactive";} ?>"><?php echo $status ?></span></td>
                         <td><?php if($group==''){$group='Group is not set';} echo $group ?></td>
                         <td><a href="edit_admin.php?id=<?php echo $id ?>"><?php echo $email ?></a></td>
                         <td><?php if($location==''){$location='location is not set';}echo $location ?></td> 
                      </tr>   

                    <?php }?>                               

                    </tbody>

                    <tfoot>

                      <tr>

                      <th></th>

                       <th>Name</th>
					   <th>Purpose</th>
                       <th>Phone</th>
                       <th>Username</th>
                       <th>Created On</th>
                       <th>Status</th> 
                       <th>Group</th>
                       <th>Email</th>
                       <th>Location</th>
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

