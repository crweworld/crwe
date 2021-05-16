<?php
session_start();

include ('../subs/connect_me.php');

if(isset($_SESSION['group']))
{
	if($_SESSION['group']!=("superadmin" or "miniadmin"))
	{
		header('Location:logout.php');
	}
}

 include('header.php');
 include('sidebar.php');

if (isset($_GET['del_me']))
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `slider`= 'unlinked' WHERE post_id IN ('" . implode("','",$value) . "')");	
	}		
	echo "<script>alert('Unlinked');</script>";	
	
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
            <li class="active">View Silder</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Silder</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                <div class="col-xs-4"><button type="submit" name="del_me" class="btn btn-block btn-warning">Unlink from Sliders</button></div>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Post Title</th>
                        <th>Category Name</th>
                        <th>Post Created on</th>
                        <th>Status</th>  
                                            
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$users = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  posts where slider='slider' order BY post_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($users))
					{	
						$post_id=$results['post_id'];												
						$post_title=$results['post_title'];
						$post_doc=$results['post_doc'];
						$post_status=$results['post_status'];

						$cat_id=$results['cat_id'];
						$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
						$cat_name=$cat_result['cat_name'];
						$cat_status=$cat_result['cat_status'];
						}
					 	
					 							 
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $post_id ?>"  /></td>
                      <td><a href="edit_post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
                      <td><span class="label <?php if($cat_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $cat_name ?></span></td>
                      <td><?php echo $post_doc ?></td>
                        <td><span class="label <?php if($post_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $post_status ?></span></td>
                        
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th></th>
                        <th>Post Title</th>
                        <th>Category Name</th>
                        <th>Post Created on</th>
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
