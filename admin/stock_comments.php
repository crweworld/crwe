<?php
session_start();
include ('../subs/connect_me.php');
include ('../subs/functions.php');

if(isset($_SESSION['group']))
{
	if($_SESSION['group']!=("superadmin" or "miniadmin"))
	{
		header('Location:logout.php');
	}
}

 include('header.php');
 include('sidebar.php');
 

if (isset($_GET['del_me'])and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	if($_GET['type']=='replies'){ $db='stock_replies';} else{$db='stock_comments';}
	if($db=='stock_replies'){
		foreach ( $array as $key => $value )
		{
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_replies` WHERE `id` IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			while($data2=mysqli_fetch_array($query))
			{
				if($data2['stock_image']!=NULL){unlink('..'.$data2['stock_image']);}				
			}
			RemoveEmptySubFolders('../assets/images/');
			mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_replies` WHERE id IN ('" . implode("','",$value) . "')");
		}		
	}
	else{
		foreach ( $array as $key => $value )
		{	
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_comments` WHERE `id` IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			while($data=mysqli_fetch_array($query))
			{
				if($data['stock_image']!=NULL){unlink('..'.$data['stock_image']);}				
			}
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `stock_replies` WHERE `ref_id` IN ('" . implode("','",$value) . "')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
			while($data2=mysqli_fetch_array($query))
			{
				if($data2['stock_image']!=NULL){unlink('..'.$data2['stock_image']);}				
			}
			RemoveEmptySubFolders('../assets/images/');
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_replies` where ref_id IN ('" . implode("','",$value) . "')");
			$query=mysqli_query($GLOBALS["___mysqli_ston"], "DELETE FROM `stock_comments` WHERE id IN ('" . implode("','",$value) . "')");
			}			
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
            <li class="active">Comments</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Comments</h3>
                </div><!-- /.box-header -->
                <div class="box-body">         
                <form action="#" method="get">       
                <div class="form-group col-xs-4">
                    <label>Search: <?php if(isset($_GET['search'])){echo $_GET['search'];}?></label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-comments-o"></i>
                      </div>
                      <input type="text" placeholder="Search comments" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>" class="form-control col-xs-4 pull-left active">
                      <select name="type" class="form-control col-xs-4 pull-left active">
                      <option value="comments" <?php  if(isset($_GET['type']) and ($_GET['type']=='comments')){ echo 'selected';}?>>Comments</option>
                      <option value="replies" <?php if(isset($_GET['type']) and ($_GET['type']=='replies')){ echo 'selected';}?>>Replies</option>
                      	
                      </select>
                    </div><!-- /.input group -->                    
                  </div>
                  <div class=" form-group col-xs-2"  style="margin-top: 23px;"><button type="submit" class="btn btn-block btn-primary">Search</button></div>
                  </form>
               <form action="#" method="get">
                  <?php if (isset($_GET['search']) and $_GET['search']!="" ){ ?>                 
                   <div class="form-group col-xs-12">
                <div class="col-xs-8" style="position: absolute; left: 15%; z-index:10">
                 <input hidden="" name="type" value="<?php echo $_GET['type']?>">
                 <input hidden="" name="search" value="<?php echo $_GET['search']?>">
                  <div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button></div>
                  </div></div>
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                      <tr>
                      <th><input type="checkbox" id="selecctall"/></th>
                      	<th>Comment</th>
                        <th>Posted By</th>
                        <th>User Tag</th>
                        <th>Symbol Tag</th>
                        <th>Created On</th>                 
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					if($_GET['type']=='replies'){ $db='stock_replies';} else{$db='stock_comments';}
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM ".$db." WHERE `comment` LIKE '%".$_GET['search']."%' ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
					while($results = mysqli_fetch_array($posts)){	
						$user_id=$results['user_id'];						
						$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where `id`='$user_id'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$username=$cat_result['fname']." ".$cat_result['lname'];
							
						}
					?>
                      <tr style="text-transform:capitalize;">
                      <td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $results['id'] ?>"  /></td>
                        <td><?php echo strip_tags($results['comment']) ?></td>
                        <td><a href="edit_user.php?id=<?php echo $user_id ?>" target="_blank"><?php echo $username;?> </a></td>
                        <td><?php echo $results['user_tag'] ?></td>
                        <td><?php echo $results['symbol_tag'] ?></td>
                        <td><?php echo date("jS M, Y", strtotime($results['created_on']))?></td>  
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	 <th></th>
                        <th>Comment</th>
                        <th>Posted By</th>
                        <th>User Tag</th>
                        <th>Symbol Tag</th>
                        <th>Created On</th> 
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
