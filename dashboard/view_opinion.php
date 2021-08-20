<?php
 include('header.php');
 include('sidebar.php');
 if($_SESSION['pub_group'] != "opinion")
{
	header('Location:index.php');
}
  if (isset($_GET['unpub'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	print_r($array);
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `post_status`= 'unpublish' WHERE user_id={$_SESSION['pub_id']} and post_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Unpublished');
	window.location.href='?date=$date&find=$date';
	</script>";		
	
}
if (isset($_GET['pub'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	print_r($array);
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET `post_status`= 'publish' WHERE user_id={$_SESSION['pub_id']} and post_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Published');
	window.location.href='?date=$date&find=$date';
	</script>";		
	
}
if (isset($_GET['del_me'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	$date = $_GET['date'];
	print_r($array);
	foreach ( $array as $key => $value )
	{
		  $value; 	
		mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `posts` WHERE user_id={$_SESSION['pub_id']} and post_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Deleted');
	window.location.href='?date=$date&find=$date';
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
            <li><a href="#">Opinion</a></li>
            <li class="active">View Opinion</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Opinion</h3>
                </div><!-- /.box-header -->
                <div class="box-body">         
                <form action="#" method="get">       
                <div class="form-group col-xs-4">
                    <label>Date range: <?php if(isset($_GET['date'])){echo $_GET['date'];}?></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="date" class="form-control col-xs-4 pull-left active" id="reservation">
                    </div><!-- /.input group -->                    
                  </div>
                  <div class=" form-group col-xs-2"  style="margin-top: 23px;"><button type="submit" name="find" class="btn btn-block btn-primary">View Now</button></div>
                  </form>
               <form action="#" method="get">
                  <?php if (isset($_GET['find'])and isset($_GET['date']) and ($_GET['date'])!="" ){ ?>                 
                   <div class="form-group col-xs-12">
                <div class="col-xs-8" style="position: absolute; left: 15%; z-index:10">
                  <div class="col-xs-3"><button type="submit" name="pub" class="btn btn-block btn-success">Publish</button></div>
                  <div class="col-xs-3"><button type="submit" name="unpub" class="btn btn-block btn-warning">Unpublish</button></div>
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                  
                  </div></div>
                  <table id="example1" class="table table-bordered table-striped">
                  
                  <input type="text" name="date" style="visibility:hidden" value="<?php $date= $_GET['date']; echo $date?>">
                     <thead>
                      <tr>
                      <th><input type="checkbox" id="selecctall"/></th>
                      	<th>Title</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th>Status</th>  
                        <th>Live View</th>                      
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					list($date1, $date2) = explode('-', $_GET['date']);					
					$date1= str_replace("/","-","$date1");
					$date2= str_replace("/","-","$date2");
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM posts WHERE cat_id in (16,19,20,21,22,23,24,26,27,30,31,33,34,35,36,37,38,39,40,41,42,44,45,46) and user_id={$_SESSION['pub_id']} and post_doc BETWEEN CAST('$date1' AS DATE) AND CAST('$date2' AS DATE) ORDER BY post_id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					
					
					while($results = mysqli_fetch_array($posts))
					{	
						$post_id=$results['post_id'];
					 	$post_status=$results['post_status'];
						$post_title=$results['post_title'];
					 	$post_doc=$results['post_doc'];
						$post_update=$results['post_update'];
						$slider=$results['slider'];
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
                        <td><?php if($slider=="slider"){echo "<i class='fa fa-slideshare'></i>";}?> <a href="edit_opinion.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></td>
                        <td><span class="label <?php if($cat_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $cat_name ?></span></td>
                        <td><?php echo $post_doc ?></td>
                        <td><?php echo $post_update ?></td>                        
                        <td><span class="label <?php if($post_status=="publish"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $post_status ?></span></td>
                        <td><a href="<?php echo $mainserver.$results['post_url'] ?>" target="_blank"><i class="fa fa-external-link"></i></a></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	 <th></th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th>Status</th> 
                        <th>Live View</th>  
                      </tr>
                    </tfoot>
                  </table>                              
                <?php  } ?>
                </form>      
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
       
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
