<?php
session_start();

include ('../subs/connect_me.php');

if($_SESSION['group']!=("superadmin" or "miniadmin"))
{
	header('Location:logout.php');
}

 include('header.php');
 include('sidebar.php');
 
 
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
            <li class="active">Payments</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><span class="active">Payments</span></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
               
                <form action="" method="get">
                 
                
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Affiliate ID</th>
                        <th>Name</th>
                        <th>Payment Method</th>
                        <th>Paid On</th>
                        <th>Paid Amt</th>
                        <th>Reference</th>
                        <th>Updated On</th>                                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
					$vid_cat = mysql_query("SELECT * FROM payment ORDER BY id DESC") or die(mysql_error()); 
					while($results = mysql_fetch_array($vid_cat))
					{	
						$affiliate_id=$results['affiliate_id'];
					 	$payment_method=$results['payment_method'];
						$paid_on=$results['paid_on'];
						$paid_amt=$results['paid_amt'];
						$ref=$results['ref'];
						$updated_on=$results['updated_on'];
						
						if($payment_method=='L'){ $method='eCheque / Local Bank Transfer';}
						elseif($payment_method=='W'){ $method='Wire Transfer';}
						elseif($payment_method=='C'){ $method='Cheque';}
						elseif($payment_method=='P'){ $method='Paypal';}
						else{ $method='Error Contact Admin';}
						
						$affi = mysql_query("SELECT * FROM affi_user where id ='$affiliate_id' ") or die(mysql_error()); 
						while($results = mysql_fetch_array($affi))
						{
							$username=$results['username'];
							$name=$results['fname']." ".$results['lname'];
						}
						
					?>
                      <tr style="text-transform:capitalize;">
                      	<td><input  class="checkbox1" type="checkbox" name="check[]" value="<?php echo $affiliate_id ?>"  /></td>
                        <td><a href="edit_affiliate.php?affiliate_id=<?php echo $affiliate_id; ?>"><?php echo $username?></a></td>
                        
                        <td><?php echo $name?></td>
                        <td><?php echo $method?></td>
                        <td><?php echo $paid_on?></td>
                        <td><?php echo $paid_amt?></td>
                         <td><?php echo $ref?></td>
                          <td><?php echo $updated_on?></td>
                      </tr>   
                    <?php }?>                               
                    </tbody>
                    <tfoot>
                      <tr>
                      	<th><input type="checkbox" id="selecctall"/></th>
                        <th>Affiliate ID</th>
                        <th>Name</th>
                        <th>Payment Method</th>
                        <th>Paid On</th>
                        <th>Paid Amt</th>
                        <th>Reference</th>
                        <th>Updated On</th> 
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
