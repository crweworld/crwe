<?php
session_start();

include( '../subs/connect_me.php' );
include( '../subs/functions.php' );

if ( isset( $_SESSION[ 'group' ] ) ) {
	if ( $_SESSION[ 'group' ] != ( "superadmin"
			or "miniadmin" ) ) {
		header( 'Location:logout.php' );
	}
}

include( 'header.php' );
include( 'sidebar.php' );
$admin_id = '';
if ( isset( $_SESSION[ 'id' ] ) ) {
	$admin_id = $_SESSION[ 'id' ];
}
if ( isset( $_GET[ 'active' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		mysqli_query( $GLOBALS[ "___mysqli_ston" ], "UPDATE `investment` SET `status`= '1' WHERE user_id IN ('" . implode( "','", $value ) . "')" );
	}
	echo "<script>alert('Active')</script>";
}
if ( isset( $_GET[ 'inactive' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		mysqli_query( $GLOBALS[ "___mysqli_ston" ], "UPDATE `investment` SET `status`= '0' WHERE user_id IN ('" . implode( "','", $value ) . "')" );
	}
	echo "<script>alert('Inactive')</script>";
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
			<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
			</li>
			<li><a href="#">Public News</a>
			</li>
			<li class="active">Create Public News</li>
		</ol>
	</section>
<form action="#" method="get">
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Investment</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php if(!empty($err_sin)){ ?>
					<div class="col-md-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							<p>
								<?php  echo "$err_sin";?>
							</p>
						</div>
					</div>
					<?php } ?>
					<?php if(!empty($done)){ ?>
					<div class="col-md-12">
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
							<p>
								<?php  echo "$done"?>
							</p>
						</div>
					</div>
					<?php }?>
					<div class="box-body">
						<div class="col-md-12">
							<div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">

								<div class="col-xs-4"><button type="submit" name="active" class="btn btn-block btn-success">Active</button>
								</div>

								<div class="col-xs-4"><button type="submit" name="inactive" class="btn btn-block btn-warning">Inactive</button>
								</div>

							</div>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Category</th>
										<th>Budget</th>
										<th>Summary</th>
										<th>Status</th>
										<th>Posted On</th>
									</tr>
								</thead>
								<tbody>
									<?php  
					
					$ids=array();			
					$posts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM investment ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					while($results = mysqli_fetch_array($posts))
					{	$summary[$results['user_id']]=$results['summary'];
					    $category[$results['user_id']]=$results['category'];
					    $budget[$results['user_id']]=$results['budget'];
					 	$date[$results['user_id']]=$results['date'];
					 	$ids[]=$results['user_id'];
					    $status[$results['user_id']]=$results['status'];
					}
						if(count($ids)!=0){$sql= "WHERE id in (".implode(",",$ids).")";}else{$sql='WHERE id=0';}
					
					$rr = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user ".$sql." ORDER BY id DESC") or die(mysqli_error($GLOBALS["___mysqli_ston"]));
					while($r2 = mysqli_fetch_array($rr))
					{					 
					?>
									<tr>
										<td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $r2['id'] ?>"/>
										</td>
										<td>
											<?php echo $r2['fname'].' '.$r2['lname'] ?>
										</td>
										<td>
											<?php echo $r2['email'] ?>
										</td>
										<td>
											<?php echo $r2['phone'] ?>
										</td>

										<td>
											<?php echo $category[$r2['id']]; ?>
											</span>
										</td>
										<td>$
											<?php echo $budget[$r2['id']]; ?>
											</span>
										</td>
										<td>
											<?php echo $summary[$r2['id']]; ?>
											</span>
										</td>
										<td>
											<span class="label <?php if($status[$r2['id']]=="1"){echo "label-success "; $status="Active ";} else{echo "label-warning "; $status="Inactive ";} ?>">
												<?php echo $status ?>
											</span>
										</td>
										<td>
											<?php echo date('d/m/Y', strtotime($date[$r2['id']])); ?>
											</span>
										</td>
									</tr>
									<?php }?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Category</th>
										<th>Budget</th>
										<th>Summary</th>
										<th>Status</th>
										<th>Posted On</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<?php 
					?>
				</div>
				<!-- /.box -->
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
 </form>
</div> <!-- /.content-wrapper -->
<?php include( 'footer.php' );
?>