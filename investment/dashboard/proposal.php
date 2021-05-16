<?php
include( 'header.php' );
if($_SESSION['pub_group']!='entrepreneur'){ header('Location:/dashboard'); exit();}
include( 'sidebar.php' );
$d1=mysqli_fetch_assoc(mysqli_query( $mysql_link, "SELECT `id` FROM `investment` WHERE user_id='{$_SESSION['pub_id']}'")); 
$_GET['id']=$d1['id'];
$err_sin='';
$c1= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}' and user_id='{$_SESSION['pub_id']}' and status='0'"));
$c2= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}' and user_id='{$_SESSION['pub_id']}' and status='1'"));
$c12= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where  id='{$_GET['id']}' and user_id='{$_SESSION['pub_id']}' and status='2'"));
if($c1['count(*)']==1){	
	$done = "<i class=\"icon fa fa-info\"></i> Request send for approval, we will contact you soon<br>";$dis='1';$err2='';
}
if($c12['count(*)']==1){	
	$err2 = "<i class=\"icon fa fa-info\"></i> Proposal Dismissed<br>";
}
if($c2['count(*)']==1 or $c12['count(*)']==1){	
	if ( isset( $_POST[ 'submit' ] ) ) {
		foreach ( $_POST as $key => $value ) {
			$$key = mysqli_real_escape_string( $mysql_link, $value );
		} 
		$c3= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where title='$title' and id!='{$_GET['id']}' and user_id!='{$_SESSION['pub_id']}'"));
		if($title=='' or $industry=='' or $capital=='' or $minimum=='' or $invested=='' or $reason=='' or $stage=='' or $role=='' or $summary==''){
			$err_sin='Kindly fill all the fields';
		}if($c3['count(*)'] == 1){$err_sin='Title already exist';}
		if($err_sin==''){
			$insert_ok = mysqli_query( $mysql_link, "UPDATE `investment` SET `title`='$title',`industry`='$industry',`capital`='$capital',`minimum`='$minimum',`invested`='$invested',`reason`='$reason',`stage`='$stage',`role`='$role',`summary`='$summary',`status`='0' where  id='{$_GET['id']}' and `user_id`='{$_SESSION['pub_id']}'" )or die( mysqli_error( $mysql_link ) );
			if ( $insert_ok == 1 ) {
				$_POST = array();
				/*$rr = mysqli_query($mysql_link, "SELECT * FROM user where id='{$_SESSION['pub_id']}'") or die(mysqli_error($mysql_link));
				while($r2 = mysqli_fetch_array($rr))
				{ $name = $r2['fname'].' '.$r2['lname'];}

				$to   = $email  = 'info@crweworld.com'; // Send email to our user
				$subject = "Crwe World | Investment Request"; // Give the email a subject 
				 $message = "
				<b>You got an investment request from ".$name."</b>";
				//phpemailer
				 require '/var/www/html/vhosts/phpmail/mail.php';
				 $from_name= $name;
				 $reply = $email;
				 $reply_name = $name;
				 $to = $to;
				 $subject = $subject;
				 $message = $message;
				 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);*/
				 $done = "<i class=\"icon fa fa-info\"></i> Request send for approval, we will contact you soon<br>";$dis='1';$err2='';
			}
		}
	}
}
else{ 
	if ( isset( $_POST[ 'submit' ] ) ) {
		foreach ( $_POST as $key => $value ) {
			$$key = mysqli_real_escape_string( $mysql_link, $value );
		}$c3= mysqli_fetch_array(mysqli_query($mysql_link, "SELECT count(*) FROM `investment` where title='$title' and id!='{$_GET['id']}' and user_id!='{$_SESSION['pub_id']}'"));
		if($title=='' or $industry=='' or $capital=='' or $minimum=='' or $invested=='' or $reason=='' or $stage=='' or $role=='' or $summary==''){
			$err_sin='Kindly fill all the fields';
		}if($c3['count(*)'] == 1){$err_sin='Title already exist';}
		if($err_sin==''){
			$insert_ok = mysqli_query( $mysql_link, "INSERT INTO `investment`(`title`, `industry`, `capital`, `minimum`, `invested`, `reason`, `stage`, `role`, `summary`, `status`, `user_id`) VALUES ('$title', '$industry', '$capital', '$minimum', '$invested', '$reason', '$stage', '$role', '$summary', '0', '{$_SESSION['pub_id']}')" )or die( mysqli_error( $mysql_link ) );
			if ( $insert_ok == 1 ) {
				$_POST = array();
				/*$rr = mysqli_query($mysql_link, "SELECT * FROM user where id='{$_SESSION['pub_id']}'") or die(mysqli_error($mysql_link));
				while($r2 = mysqli_fetch_array($rr))
				{ $name = $r2['fname'].' '.$r2['lname'];}

				$to   = $email  = 'info@crweworld.com'; // Send email to our user
				$subject = "Crwe World | Investment Request"; // Give the email a subject 
				 $message = "
				<b>You got an investment request from ".$name."</b>";
				//phpemailer
				 require '/var/www/html/vhosts/phpmail/mail.php';
				 $from_name= $name;
				 $reply = $email;
				 $reply_name = $name;
				 $to = $to;
				 $subject = $subject;
				 $message = $message;
				 $send_mail = sendphpmail('crweworld.com',$from_name,$reply,$reply_name,$to,$subject,$message);*/
				  $done = "<i class=\"icon fa fa-info\"></i> Request send for approval, we will contact you soon<br>";$dis='1';$err2='';
			}
		}
	}
}

$d1=mysqli_fetch_assoc(mysqli_query( $mysql_link, "SELECT * FROM `investment` WHERE id='{$_GET['id']}' and user_id='{$_SESSION['pub_id']}'")); 
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
					<?php if(!empty($done)){ ?>
					<div class="col-md-12">
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
							<p>
								<?php  echo $done?>
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
								<textarea class="form-control" name="summary"  minlength="250" placeholder="Please describe this investment opportunity." required><?php echo printer('summary',$d1)?></textarea>
							</div>
							
							<div class="form-group agree">
								<strong>DISCLAIMERS</strong> <br> I have read and agree to the Website <a target="_blank" href="//investment.crweworld.com/privacy">Terms of Use and Acceptable Use Policy</a>.<br>  understand that the CRWEWORLD Investment (Crown Equity Holdings Inc. or Its Affiliates) can in no way be held responsible for what takes place once contact with an investor has been established<br> I understand that it is my sole responsibility to do due diligence on any of the investors I deal with.
							</div>
							<div class="form-group agree">
								<label><input type="checkbox" required> I have read and agree to the terms of the disclaimers above. </label>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer agree">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
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
<?php if($dis==1){ echo "$('input,textarea,select').attr('disabled','disabled');$('.agree').remove();";}	?>
</script> <?php include( 'footer.php' );
?>