<?php
if($chk_loc=='India' or $chk_loc=='China')
{
	if(isset($_POST['currency_type'])){$currency_type=mysql_real_escape_string($_POST['currency_type']);}else {$currency_type='USD'; }	
	$currency_type=$currency_type;
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$ifsc_code=mysql_real_escape_string($_POST['ifsc_code']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_branch=mysql_real_escape_string($_POST['bank_branch']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";}
	if($chk_loc=='India'){
		if($ifsc_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IFSC Code is Empty <br>";} 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Branch Name is Empty <br>";} 
	}
	else{
		if($ifsc_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CNAPS is Empty <br>";} 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Beneficiary ID is Empty <br>";} 
	}
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['ifsc_code']=$ifsc_code;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_branch']=$bank_branch;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W',`currency_type`='$currency_type', `account_name`='$account_name', `account_no`='$account_no', `ifsc_code`='$ifsc_code', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_branch`='$bank_branch',`bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
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
	$currency_type=mysql_real_escape_string($_POST['currency_type']);
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$insti_no=mysql_real_escape_string($_POST['insti_no']);
	$routing_no=mysql_real_escape_string($_POST['routing_no']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Institution Number is Empty <br>";} 
	if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Branch Routing Number is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";}
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['insti_no']=$insti_no;
	$_SESSION['routing_no']=$routing_no;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W', `currency_type`='$currency_type', `account_name`='$account_name', `insti_no`='$insti_no', `routing_no`='$routing_no',`account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
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
	$currency_type=mysql_real_escape_string($_POST['currency_type']);
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$clabe=mysql_real_escape_string($_POST['clabe']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($clabe==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CLABE is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";}
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['clabe']=$clabe;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W', `currency_type`='$currency_type', `account_name`='$account_name', `clabe`='$clabe', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
		echo alert_mail();	
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}



if($wire_type=='iban') 
{
	if(isset($_POST['currency_type'])){$currency_type=mysql_real_escape_string($_POST['currency_type']);}else {$currency_type='USD'; }	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_branch=mysql_real_escape_string($_POST['bank_branch']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IBAN  Number is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";}
	if($chk_loc=='Azerbaijan'){ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Tax ID is Empty <br>";} 
	}
	else if($chk_loc=='Kazakhstan'){ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IIN , BIN is Empty <br>";} 
	}
	else if($chk_loc=='Costa Rica'){ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Beneficiary ID is Empty <br>";} 
	}
	else{
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Branch Name is Empty <br>";} 
	}
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_branch']=$bank_branch;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W',`currency_type`='$currency_type', `account_name`='$account_name', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_branch`='$bank_branch',`bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
		echo alert_mail();	
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}

if($wire_type=='swift') {
	if(isset($_POST['currency_type'])){$currency_type=mysql_real_escape_string($_POST['currency_type']);}else {$currency_type='USD'; }	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_branch=mysql_real_escape_string($_POST['bank_branch']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	$sql2='';
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($chk_loc=='Mozambique') 
	{ 
		if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! NIB is Empty <br>";} 
	}
	else
	{
		if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";} 
	}
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($chk_loc=='Bangladesh')
	{
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Beneficiary ID is Empty <br>";} 
	} 
	else if($chk_loc=='Cameroon') 
	{ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! RIB is Empty <br>";} 
	}
	else if($chk_loc=='Chile') 
	{ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! RUT is Empty <br>";} 
	}
	else if($chk_loc=='Colombia' or $chk_loc=='Peru') 
	{ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Tax ID is Empty <br>";} 
	}
	else if($chk_loc=='Dominican Republic') 
	{ 
		$account_type=mysql_real_escape_string($_POST['account_type']);
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty <br>";} 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Account Type<br>";} 
		$_SESSION['account_type']=$account_type;
		$sql2=", `account_type`='$account_type'";
	}
	else if($chk_loc=='Russia') 
	{ 
		$account_type=mysql_real_escape_string($_POST['account_type']);
		$routing_no=mysql_real_escape_string($_POST['routing_no']);
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! BIK code is Empty <br>";} 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Correspondent Account is Empty<br>";} 
		if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! INN,KPP is Empty<br>";} 
		$_SESSION['account_type']=$account_type;
		$_SESSION['routing_no']=$routing_no;
		$sql2=", `account_type`='$account_type' , `routing_no`='$routing_no'";
	}
	else if($chk_loc=='Ukraine') 
	{ 
		$account_type=mysql_real_escape_string($_POST['account_type']);
		$routing_no=mysql_real_escape_string($_POST['routing_no']);
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Code is Empty <br>";} 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty<br>";} 
		if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Tax ID is Empty<br>";} 
		$_SESSION['account_type']=$account_type;
		$_SESSION['routing_no']=$routing_no;
		$sql2=", `account_type`='$account_type' , `routing_no`='$routing_no'";
	}
	else if($chk_loc=='New Zealand') 
	{ 
		$account_type=mysql_real_escape_string($_POST['account_type']);
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Code is Empty <br>";} 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Branch Code is Empty <br>";} 
		$_SESSION['account_type']=$account_type;
		$sql2=", `account_type`='$account_type'";
	}
	else if($chk_loc=='Paraguay') 
	{ 
		
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! National ID Number is Empty <br>";} 
	}
	else
	{ 
		if($bank_branch==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Branch Name is Empty <br>";} 
	}
	 if($chk_loc=='Jamaica') 
	{ 
		$account_type=mysql_real_escape_string($_POST['account_type']); 
		if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Account Type<br>";} 
		$_SESSION['account_type']=$account_type;
		$sql2=", `account_type`='$account_type'";
	}
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_branch']=$bank_branch;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W',`currency_type`='$currency_type', `account_name`='$account_name', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_branch`='$bank_branch',`bank_address`='$bank_address'".$sql2."where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}



if($chk_loc=='Argentina' or $chk_loc=='Australia')
{
	$currency_type=mysql_real_escape_string($_POST['currency_type']);
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$insti_no=mysql_real_escape_string($_POST['insti_no']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($chk_loc=='Argentina'){
		if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CBU Number is Empty <br>";} 
		if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CUIT Number is Empty <br>";} 
	}
	if($chk_loc=='Australia'){
		if($insti_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! BSB Code is Empty <br>";} 
		if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";} 
	}
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";}
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['insti_no']=$insti_no;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_address']=$bank_address;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W', `currency_type`='$currency_type', `account_name`='$account_name', `insti_no`='$insti_no', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
		$update_ok = mysql_query($sql)or die(mysql_error());
		
		if($update_ok == 1)
		{
			echo clear();
			echo alert_mail();
		$done ="<i class=\"icon fa fa-info\"></i> Your Payment Info updated successfully. <br>";
			
		}
	}
}


if($chk_loc=='Brazil')
{
	if(isset($_POST['currency_type'])){$currency_type=mysql_real_escape_string($_POST['currency_type']);}else {$currency_type='USD'; }	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$swift_code=mysql_real_escape_string($_POST['swift_code']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$bank_code=mysql_real_escape_string($_POST['bank_code']);
	$branch_code=mysql_real_escape_string($_POST['branch_code']);
	$bank_address=mysql_real_escape_string($_POST['bank_address']);
	
	$err_sin="";
	if($currency_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Please Select Payment Currency <br>";} 
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! IBAN  Number is Empty <br>";} 
	if($swift_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! SWIFT is Empty <br>";} 
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";}
	if($bank_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! CNPJ / CPF is Empty <br>";} 
	if($branch_code==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Agency Code is Empty <br>";} 
	
	if($bank_address==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Address is Empty <br>";} 
	
	$_SESSION['payment_method']='W';
	$_SESSION['currency_type']=$currency_type;
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['swift_code']=$swift_code;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['bank_code']=$bank_code;
	$_SESSION['branch_code']=$branch_code;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='W',`currency_type`='$currency_type', `account_name`='$account_name', `account_no`='$account_no', `swift_code`='$swift_code', `bank_name`='$bank_name', `bank_code`='$bank_code', `branch_code`='$branch_code',`bank_address`='$bank_address' where `id`='{$_SESSION['affi_id']}'";
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