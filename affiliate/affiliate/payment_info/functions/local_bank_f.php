<?php
if($chk_loc=='India')
{	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$ifsc_code=mysql_real_escape_string($_POST['ifsc_code']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$account_type=mysql_real_escape_string($_POST['account_type']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";} 
	if($ifsc_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IFSC Code is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Type is Empty <br>";} 
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='L';
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['ifsc_code']=$ifsc_code;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['account_type']=$account_type;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='L', `account_name`='$account_name', `account_no`='$account_no', `ifsc_code`='$ifsc_code', `swift_code`='$swift_code', `bank_name`='$bank_name', `account_type`='$account_type',`bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}


if($chk_loc=='Canada')
{
	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$insti_no=mysql_real_escape_string($_POST['insti_no']);
	$routing_no=mysql_real_escape_string($_POST['routing_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$account_type=mysql_real_escape_string($_POST['account_type']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";} 
	if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Institution Number is Empty <br>";} 
	if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Branch Routing Number is Empty <br>";}
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Type is Empty <br>";} 
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='L';
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['insti_no']=$insti_no;
	$_SESSION['routing_no']=$routing_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['account_type']=$account_type;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='L', `account_name`='$account_name', `account_no`='$account_no',`insti_no`='$insti_no', `routing_no`='$routing_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `account_type`='$account_type',`bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}

if($chk_loc=='Mexico')
{
	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$insti_no=mysql_real_escape_string($_POST['insti_no']);
	$clabe=mysql_real_escape_string($_POST['clabe']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$account_type=mysql_real_escape_string($_POST['account_type']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);	
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	$bank_code=mysql_real_escape_string($_POST['bank_code']);
	$branch_code=mysql_real_escape_string($_POST['branch_code']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty <br>";} 
	if($clabe==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CLABE Number is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";}	
	if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Type is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	if($bank_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	if($branch_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='L';
	$_SESSION['account_name']=$account_name;
	$_SESSION['insti_no']=$insti_no;
	$_SESSION['clabe']=$clabe;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['account_type']=$account_type;
	$_SESSION['bank_name']=$bank_name;	
	$_SESSION['bank_address']=$bank_address;
	$_SESSION['bank_code']=$bank_code;
	$_SESSION['branch_code']=$branch_code;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='L', `account_name`='$account_name', `insti_no`='$insti_no', `clabe`='$clabe', `swift_code`='$swift_code', `account_type`='$account_type', `bank_name`='$bank_name', `bank_address`='$bank_address' , `bank_code`='$bank_code',`branch_code`='$branch_code' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}


if($local_type=='t1')
{
	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IBAN Number is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='L';
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='L', `account_name`='$account_name', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
		echo alert_mail();	
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}

if($local_type=='t2')
{
	if(isset($_POST['currency_type'])){$currency_type=mysql_real_escape_string($_POST['currency_type']);}else {$currency_type='AUD'; }	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$insti_no=mysql_real_escape_string($_POST['insti_no']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$account_type=mysql_real_escape_string($_POST['account_type']);
	$sql2='';
	
	
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($chk_loc=='Australia')
	{ 
		if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! BSB Code is Empty <br>";} 
	}
	else if($chk_loc=='Sweden' or $chk_loc=='United Kingdom')
	{ 
		if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IBAN is Empty <br>";} 
	}
	else
	{
		if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Code is Empty <br>";}
	}
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IBAN Number is Empty <br>";} 
	if($chk_loc=='Israel')
	{ 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty <br>";} 
	}
	else{
	if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Account Type <br>";} 
	}
	
	if($chk_loc=='Poland') 
	{ 
		$routing_no=mysql_real_escape_string($_POST['routing_no']);
		if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty <br>";} 
		$_SESSION['routing_no']=$routing_no;
		$sql2=", `routing_no`='$routing_no'";
	}
	
	$_SESSION['payment_method']='L';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['insti_no']=$insti_no;
	$_SESSION['account_no']=$account_no;	
	$_SESSION['account_type']=$account_type;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='L', `currency_type`='$currency_type', `account_name`='$account_name', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `insti_no`='$insti_no', `account_type`='$account_type' ".$sql2." where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}

?>