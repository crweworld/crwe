<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
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
            <li class="active">View Subscribers</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Subscribers</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Subscriber Name</th>
                        <th>Subscribed On</th>                                           
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$users = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  subscribers ORDER BY sub_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($users))
					{	
						$sub_id=$results['sub_id'];
					 	$email=$results['email'];
					 	$sub_doc=$results['sub_doc'];					 
					?>
                      <tr style="text-transform:capitalize;">
                      
                        <td><a href="edit_subscriber.php?sub_id=<?php echo $sub_id ?>"><?php echo $email ?></a></td>
                        <td><?php echo $sub_doc ?></td>
                       
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Subscriber Name</th>
                        <th>Created On</th>  
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
