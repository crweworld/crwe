<?php
include( 'header.php' );
include( 'sidebar.php' );
if ( isset( $_GET[ 'active' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		$value;
		mysqli_query( $mysql_link, "UPDATE `user` SET `active`= '1' WHERE id IN ('" . implode( "','", $value ) .
			"')" );
	}
	echo "<script>alert('Active');</script>";
}
if ( isset( $_GET[ 'inactive' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		$value;
		mysqli_query( $mysql_link, "UPDATE `user` SET `active`= '0' WHERE id IN ('" . implode( "','", $value ) .
			"')" );
	}
	echo "<script>alert('Inactive');</script>";
}
if ( isset( $_GET[ 'del_me' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) 
{
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		mysql_query("DELETE FROM `user` WHERE id IN ('" . implode("','",$value) . "')");
	}  echo "<script>alert('Deleted');</script>";
}
?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Dashboard<small>Version 1.0</small></h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
					</li>
					<li><a href="#">Users</a>
					</li>
					<li class="active">View Users</li>
				</ol>
			</section>
			<form action="#" method="get">
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">View User Information</h3>
								</div>
								<div class="box-body">
									<div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
										<div class="col-xs-4"><button type="submit" name="active" class="btn btn-block btn-success">Active</button>
										</div>
										<div class="col-xs-4"><button type="submit" name="inactive" class="btn btn-block btn-warning">Inactive</button>
										</div>
										<div class="col-xs-4"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button>
										</div>
									</div>
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th><input type="checkbox" id="selecctall"/>
												</th>
												<th>Name</th>
												<th>Email</th>
												<th>Type</th>
												<th>Phone</th>
												<th>Created On</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $admin = mysqli_query($mysql_link, "SELECT * FROM user ORDER BY id DESC") or die(mysqli_error($mysql_link));
												while($r = mysqli_fetch_array($admin)){?>
											<tr style="text-transform:capitalize;">
												<td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $r['id'] ?>"/>
												</td>
												<td>
													<?php echo $r['fname']." ".$r['lname'] ?>
												</td>
												<td><a style="text-transform: lowercase;" href="edit_user.php?id=<?php echo $r['id'] ?>">
													<?php echo $r['email']?></a>
												</td>
												<td>
													<?php echo $r['group'] ?>
												</td>
												<td>
													<?php echo $r['phone'] ?>
												</td>
												<td>
													<?php echo $r['doc'] ?>
												</td>
												<td>
													<span class="label <?php if($r['active']=="1"){echo "label-success "; $status="Active ";} else{echo "label-warning "; $status="Inactive ";} ?>">
														<?php echo $status ?>
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
												<th>Type</th>
												<th>Phone</th>
												<th>Created On</th>
												<th>Status</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</section>
			</form>
		</div> 
<?php include( 'footer.php' );?>