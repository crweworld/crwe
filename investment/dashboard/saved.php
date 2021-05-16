<?php
include( 'header.php' );
if ( $_SESSION[ 'pub_group' ] != 'investor' ) {
	header( 'Location:/dashboard' );
	exit();
}
include( 'sidebar.php' );

if ( isset( $_GET[ 'del_me' ] )and isset( $_GET[ 'check' ] )and( $_GET[ 'check' ] ) != "" ) {
	$d = mysqli_fetch_array( mysqli_query( $mysql_link, "SELECT propid FROM props WHERE userid='{$_SESSION['pub_id']}'" ) )or die( mysqli_error( $mysql_link ) );	
	$pid=implode(',',array_diff(explode(',',$d['propid']),$_GET[ 'check' ]));
	mysqli_query( $mysql_link, "UPDATE `props` SET `propid`='$pid' where userid='{$_SESSION['pub_id']}' " )or die( mysqli_error( $mysql_link ) );
	echo '<script>
					$(document).ready(function(){	
						$("#myModalLabel").html("Removed");
								$("#myModal").modal("show");			
								 setTimeout(function(){
									$("#myModal").modal("hide");
								}, 1000);
						});
					</script>';	

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
			<li><a href="#">Saved Proposal</a>
			</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Saved Proposal</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form action="#" method="get">
							<div class="form-group col-xs-12">
								<div class="col-xs-8" style="position: absolute; left: 15%; z-index:10">
									<div class="col-xs-3"><button type="submit" name="del_me" class="btn btn-block btn-danger">Remove</button>
									</div>
								</div>
							</div>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><input type="checkbox" id="selecctall"/></th>
										<th>Title</th>
										<th>Industry </th>
										<th>Capital</th>
										<th>Minimum investment</th>
										<th>Contact</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$dp =mysqli_query($mysql_link, "SELECT propid FROM props where `userid`='{$_SESSION['pub_id']}'" )or die( mysqli_error($mysql_link ) ); 
									$p= mysqli_fetch_array($dp);
									$w="and id in ('".str_replace(',',"','",$p['propid'])."')";
									$sql = mysqli_query($mysql_link, "SELECT * FROM investment WHERE status=1 $w ORDER BY id DESC" )or die( mysqli_error($mysql_link ) );
									while ( $d = mysqli_fetch_array( $sql ) ) {
										
										$cat_id = mysqli_query($mysql_link, "SELECT * FROM sel_industry where `id`='{$d['industry']}'" )or die( mysqli_error($mysql_link ) );
										while ( $c = mysqli_fetch_array( $cat_id ) ) {
											$cat_name = $c[ 'name' ];
										}
										
										$sq = mysqli_query($mysql_link, "SELECT * FROM user where `id`='{$d['user_id']}'" )or die( mysqli_error($mysql_link ) );
										while ( $u = mysqli_fetch_array( $sq ) ) {
											$name = $u[ 'fname' ]." ".$u[ 'lname' ];
										}
										?>
									<tr style="text-transform:capitalize;">
										<td><input class="checkbox1" type="checkbox" name="check[]" value="<?php echo $d['id'] ?>"/>
										</td>
										<td><a href="view?id=<?php echo $d['id'] ?>"><?php echo $d['title'] ?></a></td>
										<td>
											<span class="label label-success">
												<?php echo $cat_name ?>
											</span>
										</td>
										<td>$ <?php echo $d['capital'] ?></td>
										<td>$ <?php echo $d['minimum'] ?></td>
										<td><?php if($d['user_id']==0){ echo '<a href="/contact" target="_blank">Managed by CRWEWORLD</a>';}else { echo '<a href="viewprofile?id='.$d['user_id'].'">'.$name.'</a>';} ?></td>
									</tr>
									<?php }?>
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>Title</th>
										<th>Industry </th>
										<th>Capital</th>
										<th>Minimum investment</th>
										<th>Contact</th>
									</tr>
								</tfoot>
							</table>
						</form>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div> <!-- /.content-wrapper -->
<?php include( 'footer.php' )
?>