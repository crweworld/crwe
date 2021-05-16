<?php
 include('header.php');
 include('sidebar.php');
if($_SESSION['pub_group'] != "affiliate")
{
	header('Location:index.php');
}

if(isset($_POST['add_post']))
{  					  

$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);


$cat_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id2']);


$err_sin="";
	if($post_title==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Title is Empty <br>";} 
	if($post_description==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Description is Empty <br>";} 
	if($cat_id2==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Category is Empty <br>";} 
	if($_POST['city']==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! City is Empty <br>";} 
	if($_POST['state']==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! State is Empty <br>";} 
	if($_POST['country']==""){ $err_sin .="<i class=\"icon fa fa-info\"></i> Error!!! Country is Empty <br>";} 
	
	
	$_SESSION['post_status']=$post_status;
	$_SESSION['post_title']=$post_title;
	$_SESSION['post_description']=$post_description;
	
	
	$_SESSION['cat_id2']=$cat_id2;
	
	
	if($err_sin=="")
	
	{	 $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_status1=$cat_result['cat_status'];
						}
						
		/*zippy*/	
		include('../subs/zippy.php');					
		/*zippy*/
					
									
		$post_description=str_replace("textarea","",$post_description);
						
	
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`cat_id`, `cat_status`, `post_title`, `post_description`,  `post_doc`,  `post_status`, `post_state`, `post_city`,  `post_country`, `trend`,  `user_id`,`zip_id`) VALUES ( '$cat_id2','$cat_status1', '$post_title', '$post_description',  NOW(),  'publish', '$post_state', '$post_city', '$post_country', 'localnews',  '{$_SESSION['pub_id']}' , '$post_zipid')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);			
			
			$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
			{
				$cat_name=$cat_result['cat_name'];
			}

			$post_url= "/".txtcleaner($post_country)."/".txtcleaner($post_state)."/".txtcleaner($post_city)."/localnews/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner($post_title);
			
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET   `post_url`='$post_url' where user_id={$_SESSION['pub_id']} and post_id='$post_id'");
			
			echo clear();
			$done ="<i class=\"icon fa fa-info\"></i> Local News Created Successfully. <br>";
			
		}	
		
	}
}
else
{
	echo clear();
	
}
function clear()
{
  unset($_SESSION['post_title']);unset($_SESSION['post_description']);unset($_SESSION['post_status']);unset($_SESSION['cat_id2']);
}
 ?>
 <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        
      });
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
            <li><a href="#">Local News</a></li>
            <li class="active">Create Local News</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Local News</h3>
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
                <p><?php  echo "$done"?></p>
              </div>
              </div>
              <?php } ?>
              
                <form role="form" action="" method="post">
                	
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title" value="<?php if(isset($_SESSION['post_title'])){ echo $_SESSION['post_title']; }?>" required="required"  placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>   
                      <select class="form-control" name="cat_id2">
                      <option value="">-Change Category-</option>
                      	<?php $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_id not in (16,19,20,21,22,24,26,27,30,31,33,34,35,36,37,38,39,40,41,42,44,45, 46, 47,48,49,50)") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_name=$cat_result['cat_name'];
							$cat_id2=$cat_result['cat_id'];
						
						?>
                        <option <?php if(isset($_SESSION['cat_id2'])){ if($_SESSION['cat_id2']==$cat_id2){echo "selected";}} echo " value=\"$cat_id2\""; ?>><?php echo $cat_name ?></option>
                         <?php }?>
                      </select>                  
                     
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="3" cols="80" required id="editor1" name="post_description" >
                   <?php if(isset($_SESSION['post_description'])){ echo $_SESSION['post_description']; }?>
                      </textarea>
                     
                    </div>                 
                    <div class="form-group">
 <link href="/css/ui.css" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <!-- Javascript -->
      <script>
         $(function() {
            var availableTutorials = [
			
					
            ];
            $( "#automplete-1" ).autocomplete({
               source: availableTutorials
            });
         });
      </script>
  
                       <label for="location">Location *</label>
           <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
            <td><label>Country: </label>
            <div class="form-group">
<select name="country" required class="country form-control">
    <option class="col-md-12" value="">-- Select Location --</option>
    	<?php include ('../subs/country_opt.php') ?>
	</select>
</div></td>
          </tr>
          <tr id="state">
            <td>
            <div class="form-group">
            <label>State</label> 
            <div align="center"><img id="img1" src="/images/load.gif"/>  </div>        
            <select id="display" name="state" required  style="width:100%"  class="state form-control" >
            
            </select>
            </div>
            </td>
          </tr>
          <tr id="city">
            <td>
            <div class="form-group">
            <label>City</label>
            <div align="center"><img id="img2" src="/images/load.gif"/></div>
            <select id="display2" name="city" required style="width:100%"  class="search2 form-control" >
            
            </select>
            </div>
            </td>
          </tr>
          </table>
                      
                    </div>
                    <div class="form-group">
                      <label for="InputStatus">Post Status</label>
                      <div class="radio">
                        <label>
                          <input name="post_status" <?php if(isset($_SESSION['post_status'])){ if($_SESSION['post_status']=='publish'){echo 'checked';} } else { echo 'checked'; }?>  value="publish" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                     <?php /*?> <div class="radio">
                        <label>
                          <input name="post_status"  <?php if(isset($_SESSION['post_status'])){ if($_SESSION['post_status']=='unpublish'){echo 'checked';} }?>  value="unpublish"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div><?php */?>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_post" class="btn btn-primary">Create Local News</button> 
                    
                  </div>
                </form>
              
              </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://crweworld.com">www.crweworld.com</a>.</strong> All rights reserved.
      </footer>
      
   
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

   
    <!-- Bootstrap 3.3.2 JS -->
    <script src="/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
 <!-- InputMask -->
    <script src="/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
   
    <!-- iCheck 1.0.1 -->
    <script src="/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
   
    <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm//yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD'});
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
<script>
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});
</script>

  </body>
</html>
