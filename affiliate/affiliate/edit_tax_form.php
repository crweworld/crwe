<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}


 include('header.php');
 include('sidebar.php');
 
if(isset($_POST['us_person']))

{
	$us_name=mysql_real_escape_string($_POST['us_name']);
	$us_bname=mysql_real_escape_string($_POST['us_bname']);
	$us_type=mysql_real_escape_string($_POST['us_type']);
	$us_lim=mysql_real_escape_string($_POST['us_lim']);
	$us_other=mysql_real_escape_string($_POST['us_other']);
	$us_paycode=mysql_real_escape_string($_POST['us_paycode']);
	$us_fat=mysql_real_escape_string($_POST['us_fat']);
	$us_state=mysql_real_escape_string($_POST['us_state']);
	$us_street=mysql_real_escape_string($_POST['us_street']);
	$us_stno=mysql_real_escape_string($_POST['us_stno']);
	$us_city=mysql_real_escape_string($_POST['us_city']);
	$us_zip=mysql_real_escape_string($_POST['us_zip']);
	$us_req=mysql_real_escape_string($_POST['us_req']);
	$us_list=mysql_real_escape_string($_POST['us_list']);
	$us_ss=mysql_real_escape_string($_POST['us_ss']);
	$us_id=mysql_real_escape_string($_POST['us_id']);
	$us_cert=mysql_real_escape_string($_POST['us_cert']);
	
	$err_sin="";
	if($us_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Your Name is Empty <br>";}
	if($us_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Business Type<br>";}
	if($us_type=="L" and $us_lim==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Enter the Tax Classification <br>";}
	if($us_state==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! State is Missing <br>";}
	if($us_city==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! City is Missing <br>";}
	if($us_street==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Street is Missing <br>";}
	if($us_stno==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Street Number is Missing <br>";}
	if($us_zip==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Zip is Missing <br>";}
	if($us_ss=="" and $us_id=="" ){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Enter SSN or EIN <br>";}
	if($us_cert==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Certify By Typing Your Name is Missing <br>";}
	
	
	$_SESSION['person']='U';
	$_SESSION['us_name']=$us_name;
	$_SESSION['us_bname']=$us_bname;
	$_SESSION['us_type']=$us_type;
	$_SESSION['us_lim']=$us_lim;
	$_SESSION['us_other']=$us_other;
	$_SESSION['us_paycode']=$us_paycode;
	$_SESSION['us_fat']=$us_fat;
	$_SESSION['us_state']=$us_state;
	$_SESSION['us_street']=$us_street;
	$_SESSION['us_stno']=$us_stno;
	$_SESSION['us_city']=$us_city;
	$_SESSION['us_zip']=$us_zip;
	$_SESSION['us_req']=$us_req;
	$_SESSION['us_list']=$us_list;
	$_SESSION['us_ss']=$us_ss;
	$_SESSION['us_id']=$us_id;
	$_SESSION['us_cert']=$us_cert;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `person`='U', `us_name`='$us_name',`us_bname`='$us_bname',`us_type`='$us_type',`us_lim`='$us_lim',`us_other`='$us_other',`us_paycode`='$us_paycode',`us_fat`='$us_fat',`us_state`='$us_state',`us_street`='$us_street',`us_stno`='$us_stno',`us_city`='$us_city',`us_zip`='$us_zip',`us_req`='$us_req',`us_list`='$us_list',`us_ss`='$us_ss',`us_id`='$us_id',`us_cert`='$us_cert' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			unset($_SESSION['us_name']);unset($_SESSION['us_bname']);unset($_SESSION['us_type']);unset($_SESSION['us_lim']);unset($_SESSION['us_other']);unset($_SESSION['us_paycode']);unset($_SESSION['us_fat']);unset($_SESSION['us_state']);unset($_SESSION['us_street']);unset($_SESSION['us_stno']);unset($_SESSION['us_city']);unset($_SESSION['us_zip']);unset($_SESSION['us_req']);unset($_SESSION['us_list']);unset($_SESSION['us_ss']);unset($_SESSION['us_id']);unset($_SESSION['us_cert']);unset($_SESSION['person']);
			
		$done ="<i class=\"icon fa fa-info\"></i> Your Tax Info updated successfully. <br>";
			
		}
	}
}
else if(isset($_POST['non_us']))

{
	$non_address=mysql_real_escape_string($_POST['non_address']);
	$non_name=mysql_real_escape_string($_POST['non_name']);
	
	$err_sin="";
	if($non_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Your Address is Empty <br>";} 
	if($non_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Enter your name to confirm<br>";}
	
	$_SESSION['person']='N';
	$_SESSION['non_address']=$non_address;
	$_SESSION['non_name']=$non_name;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `person`='N', `non_address`='$non_address',`non_name`='$non_name' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			unset($_SESSION['non_address']);unset($_SESSION['non_name']);unset($_SESSION['person']);
			
		$done ="<i class=\"icon fa fa-info\"></i> Your Tax Info updated successfully. <br>";
			
		}
	}
}
else
{
	unset($_SESSION['non_address']);unset($_SESSION['non_name']);  unset($_SESSION['us_name']);unset($_SESSION['us_bname']);unset($_SESSION['us_type']);unset($_SESSION['us_lim']);unset($_SESSION['us_other']);unset($_SESSION['us_paycode']);unset($_SESSION['us_fat']);unset($_SESSION['us_state']);unset($_SESSION['us_street']);unset($_SESSION['us_stno']);unset($_SESSION['us_city']);unset($_SESSION['us_zip']);unset($_SESSION['us_req']);unset($_SESSION['us_list']);unset($_SESSION['us_ss']);unset($_SESSION['us_id']);unset($_SESSION['us_cert']);	
	unset($_SESSION['person']);
}
 
 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 .box-primary{
	 margin-top:1em
 }
 </style>
  <script type="text/javascript" src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script type='text/javascript'>//<![CDATA[
		$(window).load(function(){
		$(document).ready(function(){
			$('#person').on('change', function() {
			  if ( this.value == 'N')
			  {
				$("#non_us").show();
				$("#us_person").hide();
				
			  }
			   else if ( this.value == 'U')
			  {
				$("#us_person").show();
				$("#non_us").hide();
			  }
			  
			  else
			  {
				$("#non_us").hide();
				$("#us_person").hide();
			  }
			});
		});
		});//]]> 		
	  </script>

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
            <li><a href="#">Account</a></li>
            <li class="active">Edit Tax Information</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Tax Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <?php if(!empty($err_sin)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                <p><?php  echo "$err_sin";?></p>
              </div>
              </div>
              <?php } ?>
              <?php if(!empty($done)){ ?>
                 <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
                <p><?php  echo "$done";?></p>
              </div>
              </div>
              <?php } ?>
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					
				?>
                               	
                  <div class="box-body">  
                  	
                    <b class="col-md-12">CRWEWORLD is required to collect certain declarations from our payees. <br><br>
If you are a US person (see definitions on the <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">IRS site</a>) select the "US Person" tab to electronically submit the W-9 form.<br> <br>
If you are not a US person, select the "Non US person"  tab and follow the instructions there. <br><br>
If you do not fall under the above mentioned definitions, consult the <a target="_blank" href="http://www.irs.gov/">IRS site</a> for clarifications, and contact support for instructions on submitting other IRS forms.<br><br></b>
                    <div class="form-group col-md-12">
                      <label>Person <span class="red-star">*</span></label> &nbsp; &nbsp;
                       
                       <select class="form-control" id="person"  name="person" required="required">
                        <option value="">Select</option>
                        <option <?php if(isset($_SESSION['person'])){ if($_SESSION['person']=='N'){echo 'selected';} } else if($results['person']=='N'){echo 'selected';}?> value="N" >Non US Person</option>
                        <option <?php  if(isset($_SESSION['person'])){ if($_SESSION['person']=='U'){echo 'selected';} } else if($results['person']=='U'){echo 'selected';}?> value="U" >US Person</option>
                        </select>
                    </div>
                 
                 
                <?php include('person/non_us.php');?> 
                 <?php include('person/us_person.php');?> 
                 
                 
                 
                 
                 
                 
                 
                   
                  </div><!-- /.box-body -->

                 
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      <?php include('footer.php')?>
