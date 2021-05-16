<?php
include( 'header.php' );
if($_SESSION['pub_group']!='investor'){ header('Location:/dashboard'); exit();}
include( 'sidebar.php' );
$p = mysqli_fetch_array(mysqli_query($mysql_link, "SELECT propid FROM props where `userid`='{$_SESSION['pub_id']}'" ))or die( mysqli_error($mysql_link ) ); 
$d1=mysqli_fetch_assoc(mysqli_query( $mysql_link, "SELECT * FROM `investment` WHERE id='{$_GET['id']}'and status='1' and id in ('".str_replace(',',"','",$p['propid'])."') ")); 

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
					<?php if(!empty($err_sin) or !empty($err2)){ ?>
					<div class="col-md-12">
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<p>
								<?php  echo $err_sin.$err2;?>
							</p>
						</div>
					</div>
					<?php } ?>
					
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
								<p><?php echo printer('summary',$d1)?></p>
							</div>
							
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
<script>$('input,textarea,select').attr('disabled','disabled');$('.agree').remove();</script>
<?php include( 'footer.php' );
?>
