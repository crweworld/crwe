<?php
include( 'header.php' );
include( 'sidebar.php' );
if(!isset($_GET['id'])){$_GET['id']='0';}
$c1= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}' and status='0'"));
$c12= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}' and status='2'"));
$c2= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}'"));
$err_sin='';
if($c1['count(*)']==1){	
	$done2 = "<i class=\"icon fa fa-info\"></i> Waiting for your review<br>";
}
if($c12['count(*)']==1){	
	$done2 = "<i class=\"icon fa fa-info\"></i> Proposal Dismissed<br>";
}
if($c2['count(*)']!=0){ 
	if ( isset( $_POST[ 'submit' ] ) ) { 	
		foreach ( $_POST as $key => $value ) {
			$$key = mysqli_real_escape_string( $mysql_link, $value );
		}
		$c3= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where title='$title' and id!='{$_GET['id']}'"));
		if($title=='' or $industry=='' or $capital=='' or $minimum=='' or $invested=='' or $reason=='' or $stage=='' or $role=='' or $summary==''){
			$err_sin='Kindly fill all the fields';
		}if($c3['count(*)'] == 1){$err_sin='Title already exist';}
		if($err_sin==''){ 
			$insert_ok = mysqli_query( $mysql_link, "UPDATE `investment` SET `title`='$title',`industry`='$industry',`capital`='$capital',`minimum`='$minimum',`invested`='$invested',`reason`='$reason',`stage`='$stage',`role`='$role',`summary`='$summary',`status`='1' where `id`='{$_GET['id']}'" )or die( mysqli_error( $mysql_link ) );
			if ( $insert_ok == 1 ) {
				$_POST = array();	unset($done2);	
				echo '<script>
						$(document).ready(function(){	
							$("#myModalLabel").html("Proposal updated");
									$("#myModal").modal("show");			
									 setTimeout(function(){
										$("#myModal").modal("hide");
									}, 1000);
							});
						</script>';	
			}
		}
	}
}
else{ 
	if ( isset( $_POST[ 'submit' ] ) ) {
		foreach ( $_POST as $key => $value ) {
			$$key = mysqli_real_escape_string( $mysql_link, $value );
		}
		$c3= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where title='$title'"));
		if($title=='' or $industry=='' or $capital=='' or $minimum=='' or $invested=='' or $reason=='' or $stage=='' or $role=='' or $summary==''){
			$err_sin='Kindly fill all the fields';
		}if($c3['count(*)'] == 1){$err_sin='Title already exist';}
		if($err_sin==''){
			$insert_ok = mysqli_query( $mysql_link, "INSERT INTO `investment`(`title`, `industry`, `capital`, `minimum`, `invested`, `reason`, `stage`, `role`, `summary`, `status`, `user_id`) VALUES ('$title', '$industry', '$capital', '$minimum', '$invested', '$reason', '$stage', '$role', '$summary', '1', '{$_GET['id']}')" )or die( mysqli_error( $mysql_link ) );
			if ( $insert_ok == 1 ) {
				$_POST = array();unset($done2);	
				echo '<script>
						$(document).ready(function(){	
							$("#myModalLabel").html("Proposal created");
									$("#myModal").modal("show");			
									 setTimeout(function(){
										$("#myModal").modal("hide");
									}, 1000);
							});
						</script>';	
			}			
		}
		
	}
}
if ( isset( $_POST[ 'dismiss' ] ) ) { 
	mysqli_query( $mysql_link, "UPDATE `investment` SET `status`='2' where `id`='{$_GET['id']}'" )or die( mysqli_error( $mysql_link ) );
	$done2 = "<i class=\"icon fa fa-info\"></i> Proposal Dismissed<br>";
	echo '<script>
						$(document).ready(function(){	
							$("#myModalLabel").html("Proposal updated");
									$("#myModal").modal("show");			
									 setTimeout(function(){
										$("#myModal").modal("hide");
									}, 1000);
							});
						</script>';
}
$d1=mysqli_fetch_assoc(mysqli_query( $mysql_link, "SELECT * FROM `investment` WHERE id='{$_GET['id']}'")); 
	//var_dump($d1);
function printer($title,$d1){
if(isset($d1[$title])){ return $d1[$title]; }elseif(isset($_POST[$title])){ return $_POST[$title];}	
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
			<li><a href="#">Proposal</a>
			</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Proposal</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php if(!empty($err_sin)){ ?>
					<div class="col-md-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h4><i class="icon fa fa-ban"></i> Error!</h4>
							<p>
								<?php  echo $err_sin;?>
							</p>
						</div>
					</div>
					<?php } ?>
					<?php if(!empty($done2)){ ?>
					<div class="col-md-12">
						<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<h4> Alert!</h4>
							<p>
								<?php  echo "$done2"?>
							</p>
						</div>
					</div>
					<?php } 
					
						?>
						 <form role="form" action="" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label>Title of investment proposal</label>
								<input class="form-control" name="title" value="<?php echo printer('title',$d1)?>"  required >
							</div>							
							<div class="form-group">
								<label>Choice for industry classification</label>
								<select class="form-control" name="industry" required>
									<option value="" selected="">Select industry</option>
									<?php $sql = mysqli_query($mysql_link, "SELECT * FROM sel_industry") or die(mysqli_error($mysql_link)); 
									while($d = mysqli_fetch_array($sql))
									{  $chk=''; if($d['id']== printer('industry',$d1)){$chk='selected';}
										echo '<option '.$chk.' value="'.$d['id'].'">'.$d['name'].'</option>';} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Amount of capital required ( in $Dollars )</label>
								<input class="form-control" name="capital"  type="text" onkeypress="return isNumber(event)" value="<?php echo printer('capital',$d1)?>" required></textarea>
							</div>
							<div class="form-group">
								<label>Minimum investment from each investor ( in $Dollars )</label>
								<input class="form-control" name="minimum"  type="text" onkeypress="return isNumber(event)" value="<?php echo printer('minimum',$d1)?>" required></textarea>
							</div>
							<div class="form-group">
								<label>How much money has been invested in the business   ( in $Dollars )</label>
								<input class="form-control" name="invested" type="text" onkeypress="return isNumber(event)" value="<?php echo printer('invested',$d1)?>" required></textarea>
							</div>
							<div class="form-group">
								<label>Primary reason for needing capital</label>
								<select class="form-control" name="reason" required>
									<option value="" selected="">Select reason</option>
									<?php $sql = mysqli_query($mysql_link, "SELECT * FROM sel_reason") or die(mysqli_error($mysql_link)); 
									while($d = mysqli_fetch_array($sql))
									{  $chk=''; if($d['id']== printer('reason',$d1)){$chk='selected';}
									  echo '<option '.$chk.' value="'.$d['id'].'">'.$d['name'].'</option>';} ?>
								</select>
							</div>
							<div class="form-group">
								<label>What stage is the company/product at</label>
								<select class="form-control" name="stage" required>
									<option value="" selected="">Select stage</option>
									<?php $sql = mysqli_query($mysql_link, "SELECT * FROM sel_stage") or die(mysqli_error($mysql_link)); 
									while($d = mysqli_fetch_array($sql))
									{ $chk=''; if($d['id']== printer('stage',$d1)){$chk='selected';}
									 echo '<option '.$chk.' value="'.$d['id'].'">'.$d['name'].'</option>';} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Ideally, what role would you like the investor to play</label>
								<select class="form-control" name="role" required>
									<option value="" selected="">Select role</option>
									<?php $sql = mysqli_query($mysql_link, "SELECT * FROM sel_role") or die(mysqli_error($mysql_link)); 
									while($d = mysqli_fetch_array($sql))
									{ $chk=''; if($d['id']== printer('role',$d1)){$chk='selected';}
									 echo '<option '.$chk.' value="'.$d['id'].'">'.$d['name'].'</option>';} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Summary</label>
								<textarea class="form-control" name="summary"  minlength="250" rows="4" placeholder="Please describe this investment opportunity." required><?php echo printer('summary',$d1)?></textarea>
							</div>
							
						</div>
						<!-- /.box-body -->
						<div class="box-footer agree">
							<button type="submit" name="submit" class="btn btn-primary">Approve</button> 
							<?php if($_GET['id']!=0){ echo '<button type="submit" name="dismiss" class="btn btn-danger">Dismiss</button>';}?>
						</div>
						
					</form>						
					
				</div>
				<!-- /.box -->
			</div>
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div> <!-- /.content-wrapper -->
<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true; 
}

</script> <?php include( 'footer.php' );
?>