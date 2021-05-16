<?php
session_start();

include ('../subs/connect_me.php');

if(empty($_SESSION['affi_id']))
{
	header('Location:logout.php');
}


 include('header.php');
 include('sidebar.php');

 ?>
 <style>
 .red-star{
	 color: rgb(240, 0, 0);
 }
 .box-primary{
	 margin-top:1em
 }
 </style>
  

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
            <li class="active">Tax Information</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tax Information</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <?php
				$edit_user = mysql_query("SELECT * FROM affi_user where id='{$_SESSION['affi_id']}'") or die(mysql_error()); 
				while($results = mysql_fetch_array($edit_user))
				{
					if($results['person']=='N'){$person='Non US Person';}
					else if($results['person']=='U'){$person='US Person';}
					else{$person='Please Update Your Tax Information';}
					
				?>
                               	
                  <div class="box-body">  
                  	
                    <b class="col-md-12">CRWEWORLD is required to collect certain declarations from our payees. <br><br>
If you are a US person (see definitions on the <a target="_blank" href="http://www.irs.gov/pub/irs-pdf/fw9.pdf">IRS site</a>) select the "US Person" tab to electronically submit the W-9 form.<br> <br>
If you are not a US person, select the "Non US person"  tab and follow the instructions there. <br><br>
If you do not fall under the above mentioned definitions, consult the <a target="_blank" href="http://www.irs.gov/">IRS site</a> for clarifications, and contact support for instructions on submitting other IRS forms.<br><br></b>
                    <div class="form-group col-md-12">
                      <label>Person <span class="red-star">*</span></label> &nbsp; &nbsp;
                       <input type="text" class="form-control" value="<?php echo $person?>" disabled="disabled" />
                    </div>
                 
                 
                <?php include('person/non_us.php');?> 
                 <?php include('person/us_person.php');?> 
                 
                  <div class="box-footer col-md-12">
                    	<a href="edit_tax_form.php" class="btn btn-primary">Edit Tax Info</a> 
                </div>
                 
                 
                   
                  </div><!-- /.box-body -->

                 
                <?php } ?>
                
                
                
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      <?php include('footer.php')?>
