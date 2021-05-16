<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
  if (isset($_GET['approved']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		mysql_query("UPDATE `transactions` SET `commision_status`= '1' WHERE id IN ('" . implode("','",$value) . "')");
		mysql_query("UPDATE `commission` SET `approval`= '1' WHERE trans_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Approved');</script>";	
	
}
  if (isset($_GET['notapproved']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		mysql_query("UPDATE `transactions` SET `commision_status`= '0' WHERE id IN ('" . implode("','",$value) . "')");
		mysql_query("UPDATE `commission` SET `approval`= '0' WHERE trans_id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Not Approved');</script>";	
	
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
             <li class="active">Report</li>
            <li class="active">Transactions</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><span class="active">Transactions</span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
               
                <form action="" method="get">
                 <div class="col-xs-6" style="position: absolute; left: 21%; z-index:10">
                  <div class="col-xs-3"><button type="submit" name="approved" class="btn btn-block btn-success">Approved</button></div>
                  <div class="col-xs-3"><button type="submit" name="notapproved" class="btn btn-block btn-warning">Not Approved</button></div>
                  </div>
                
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Name</th>
                        <th>Affiliate</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Commission</th>
                        <th>Paid On</th>
                        <th>View </th>                                           
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysql_query("SELECT * FROM transactions ORDER BY id DESC") or die(mysql_error()); 
					while($results = mysql_fetch_array($vid_cat))
					{	
						$payer_id=$results['id'];
					 	$first_name=$results['first_name'];
						$last_name=$results['last_name'];
						$affiliate_id=$results['affiliate_id'];
						$payment_date=urldecode($results['payment_date']);
						$mc_gross=$results['mc_gross'];
						$payment_status=$results['payment_status'];
						$commision_status=$results['commision_status'];
						
						$affi = mysql_query("SELECT * FROM affi_user where id ='$affiliate_id' ") or die(mysql_error()); 
						while($results = mysql_fetch_array($affi))
						{
							$username=$results['username'];
						}
						
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $payer_id ?>"  /></td>
                        
                        <td><?php echo $first_name." ".$last_name ?></td>
                        
                        <td><a href="edit_affiliate.php?affiliate_id=<?php echo $affiliate_id; ?>"><?php echo $username?></a></td>
                        
                         <td>$ <?php echo $mc_gross ?></td>
                         
                         <td><span class="label <?php if($payment_status=="Completed"){echo "label-success";} else{echo "label-warning";} ?>"><?php echo $payment_status ?></span></td>
                         <td><span class="label <?php if($commision_status=="1"){echo "label-success"; $commision_status1='Approved';} else{echo "label-warning"; $commision_status1='Not Approved';} ?>"><?php echo $commision_status1 ?></span></td>
                         
                        <td><?php echo $payment_date ?></td>
                       
                     
                        <td><a href="transaction_detail.php?transaction_id=<?php echo $payer_id?>" onclick="return popup(this, 'widthheight')">
                        <i class="fa fa-external-link"></i></a></td>
                         
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Name</th>
                        <th>Affiliate</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Commission</th>
                        <th>Paid On</th>
                        <th>View </th>  
                      </tr>
                    </tfoot>
                  </table>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <SCRIPT TYPE="text/javascript"> function popup(mylink, windowname)
{
if (! window.focus)return true;
var href;
if (typeof(mylink) == 'string')
   href=mylink;
else
   href=mylink.href;
window.open(href, windowname, 'width=674,height=456,scrollbars=yes');
return false;
}
  </SCRIPT>

      <?php include('footer.php')?>
