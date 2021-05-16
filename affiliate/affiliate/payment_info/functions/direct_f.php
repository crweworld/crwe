<?php
if($chk_loc=='United States')
{	
	$account_name=mysql_real_escape_string($_POST['account_name']);
	$account_no=mysql_real_escape_string($_POST['account_no']);
	$routing_no=mysql_real_escape_string($_POST['routing_no']);
	$bank_name=mysql_real_escape_string($_POST['bank_name']);
	$account_type=mysql_real_escape_string($_POST['account_type']);
	
	$err_sin="";
	if($account_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Name on Account is Empty <br>";} 
	if($account_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Number is Empty <br>";}  
	if($routing_no==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Branch Routing Number is Empty <br>";}
	if($bank_name==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Bank Name is Empty <br>";} 
	if($account_type==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Account Type is Empty <br>";} 
	
	$_SESSION['payment_method']='D';
	$_SESSION['account_name']=$account_name;
	$_SESSION['account_no']=$account_no;
	$_SESSION['routing_no']=$routing_no;
	$_SESSION['bank_name']=$bank_name;
	$_SESSION['account_type']=$account_type;
	
	if($err_sin=="")
	{	
		$sql="UPDATE `affi_user` SET `payment_method`='D', `account_name`='$account_name', `account_no`='$account_no', `routing_no`='$routing_no', `bank_name`='$bank_name', `account_type`='$account_type' where `id`='{$_SESSION['affi_id']}'";
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