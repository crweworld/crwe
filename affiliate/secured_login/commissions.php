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
		
		mysql_query("UPDATE `commission` SET `approval`= '1' WHERE id IN ('" . implode("','",$value) . "')");
	}	
	echo "<script>alert('Approved');</script>";	
	
}
  if (isset($_GET['notapproved']) and isset($_GET['check']) and ($_GET['check'])!="" )
{
	$array[] = $_GET['check'];
	
	foreach ( $array as $key => $value )
	{
		$value; 	
		
		mysql_query("UPDATE `commission` SET `approval`= '0' WHERE id IN ('" . implode("','",$value) . "')");
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
            <li class="active">Commissions</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><span class="active">Commissions</span></h3>
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
                        <th>Transcation Id</th>
                        <th>Affiliate</th>
                        <th>Commissionable Amount</th>
                        <th>Based Amount</th>
                        <th>Gross Amount</th>
                        <th>Processed On</th>
                        <th>Commission Status</th>
                        <th>Commission Type </th>                                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysql_query("SELECT * FROM commission ORDER BY id DESC") or die(mysql_error()); 
					while($results = mysql_fetch_array($vid_cat))
					{	
						$id=$results['id'];
					 	$trans_id=$results['trans_id'];
						$com_amt=$results['com_amt'];
						$based_amt=$results['based_amt'];
						$gross_amt=urldecode($results['gross_amt']);
						$app_date=$results['app_date'];
						$approval=$results['approval'];
						$affiliate_id=$results['affiliate_id'];
						$com_type=$results['com_type'];
						
						$affi = mysql_query("SELECT * FROM affi_user where id ='$affiliate_id' ") or die(mysql_error()); 
						while($results = mysql_fetch_array($affi))
						{
							$username=$results['username'];
						}
						
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $id ?>"  /></td>
                        <td><a href="transaction_detail.php?transaction_id=<?php echo $trans_id?>" onclick="return popup(this, 'widthheight')">
                        <?php echo $trans_id?></a></td>
                        
                        <td><a href="edit_affiliate.php?affiliate_id=<?php echo $affiliate_id; ?>"><?php echo $username?></a></td>
                        
                        <td><?php echo '$'.$com_amt?></td>
                        <td><?php echo '$'.$based_amt?></td>
                        <td><?php echo '$'.$gross_amt?></td>
                        <td><?php echo $app_date?></td>
                         <td><span class="label <?php if($approval=="1"){echo "label-success"; $payment_status='Approved';} else{echo "label-warning"; $payment_status='Not Approved';} ?>"><?php echo $payment_status ?></span></td>
                        <td><?php echo $com_type?></td>
                      
                        
                       
                     
                        
                         
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Transcation Id</th>
                        <th>Affiliate</th>
                        <th>Commissionable Amount</th>
                        <th>Based Amount</th>
                        <th>Gross Amount</th>
                        <th>Processed On</th>
                        <th>Commission Status</th>
                        <th>Commission Type </th>  
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
