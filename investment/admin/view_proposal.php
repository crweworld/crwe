<?php
include( 'header.php' );
include( 'sidebar.php' );
if ( isset( $_GET[ 'active' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		$value;
		mysqli_query( $mysql_link, "UPDATE `investment` SET `status`= '1' WHERE id IN ('" . implode( "','", $value ) .
			"')" );
	}
	echo "<script>alert('active');</script>";
}
if ( isset( $_GET[ 'inactive' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) {
		$value;
		mysqli_query( $mysql_link, "UPDATE `investment` SET `status`= '0' WHERE id IN ('" . implode( "','", $value ) .
			"')" );
	}
	echo "<script>alert('inactive');</script>";
}
if ( isset( $_GET[ 'del_me' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) 
{
	$array[] = $_GET[ 'check' ];
	foreach ( $array as $key => $value ) { 
		mysqli_query( $mysql_link,"DELETE FROM `investment` WHERE id IN ('" . implode("','",$value) . "')");
	}  echo "<script>alert('Deleted');</script>";
}
?>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>Dashboard<small>Version 1.0</small></h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a>
					</li>
					<li><a href="#">Proposal</a>
					</li>
				</ol>
			</section>
			<form action="#" method="get">
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Proposal</h3>
								</div>
								<div class="box-body">
									<div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
										<div class="col-xs-3"><a href="proposal.php" class="btn btn-block btn-primary">Create new</a>
										</div>
										<div class="col-xs-3"><button type="submit" name="active" class="btn btn-block btn-success">Active</button>
										</div>
										<div class="col-xs-3"><button type="submit" name="inactive" class="btn btn-block btn-warning">inactive</button>
										</div>
										<div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Delete</button>
										</div>
									</div>
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th><input type="checkbox" id="selecctall"/>
												</th>
												<th>Title</th>
												<th>Industry</th>
												<th>Posted by </th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $admin = mysqli_query($mysql_link, "SELECT * FROM investment ORDER BY id DESC") or die(mysqli_error($mysql_link));
												while($r = mysqli_fetch_array($admin)){
													if($r['user_id']!=0){
														$r2 = mysqli_fetch_array(mysqli_query($mysql_link, "SELECT `fname`,`lname` FROM user where id='{$r['user_id']}'")) or die(mysqli_error($mysql_link));
														$name=$r2['fname']." ".$r2['lname'];
													}else{$name='Admin';}											
											$indus =  mysqli_fetch_array(mysqli_query($mysql_link, "SELECT `name` FROM sel_industry where id='{$r['industry']}'")) or die(mysqli_error($mysql_link));
											?>
											<tr style="text-transform:capitalize;">
												<td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $r['id'] ?>"/>
												</td>
												<td><a style="text-transform: lowercase;" href="proposal.php?id=<?php echo $r['id'] ?>">
													<?php echo $r['title'] ?></a>
												</td>
												<td>
													<?php echo $indus['name']?>
												</td>
												<td>
													<?php echo $name ?>
												</td>												
												<td>
													<span class="label <?php if($r['status']=="1"){echo "label-success "; $status="Active";} else{echo "label-warning "; $status="inactive ";} ?>">
														<?php echo $status ?>
													</span>
												</td>
											</tr>
											<?php }?>
										</tbody>
										<tfoot>
											<tr>
												<th></th>
												<th>Title</th>
												<th>Industry</th>
												<th>Posted by </th>
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