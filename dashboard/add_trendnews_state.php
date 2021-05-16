<?php
 include('header.php');
 include('sidebar.php');
if($_SESSION['pub_group']!=("state" or "country"))
{
	header('Location:logout.php');
}
$user_id = $_SESSION['pub_id'];
if(isset($_POST['add_post']))
{  					  

$post_status=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_status']);
$post_title=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_title']);
$post_description=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['post_description']);


$cat_id2=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['cat_id2']);


	
	if($post_title=="")
	{
		echo "<script>alert('Error!!! Title is Empty');</script>";
	}
	elseif($cat_id2=="")
	{
		echo "<script>alert('Error!!! Category is Empty');</script>";
	}
	elseif($post_description=="")
	{
		echo "<script>alert('Error!!! Description is Empty');</script>";
	}
	
	
	else
	{	 $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_status1=$cat_result['cat_status'];
						}
						
	/*zippy*/	
	include('../subs/zippy.php');	
    /*zippy*/				

			$post_description=str_replace("textarea","",$post_description);			
	
		$insert_ok = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO `posts`(`cat_id`, `cat_status`, `post_title`, `post_description`,  `post_doc`,  `post_status`, `post_state`, `post_city`, `post_country`,  `zip_id`, `trend`, `user_id`) VALUES ( '$cat_id2','$cat_status1', '$post_title', '$post_description',  NOW(),  'publish', '$post_state', '$post_city', '$post_country', '$post_zipid','trend_state', '$user_id')")or die(mysqli_error($GLOBALS["___mysqli_ston"]));
		if($insert_ok == 1)
		{
			$post_id=((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
			
			$post_location=$post_state;
			
			$cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where `cat_id`='$cat_id2' and cat_status='publish'") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
			while($cat_result = mysqli_fetch_array($cat_id))
			{
				$cat_name=$cat_result['cat_name'];
			}

			$post_url= "/". txtcleaner($post_location)."/trendingnow/".txtcleaner($cat_name)."/".$post_id."/".txtcleaner(			$post_title);		
			
			mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE `posts` SET   `post_url`='$post_url' where post_id='$post_id'");
			
			echo "<script>
			alert('Trending News Created Successfully');
			</script>";	
		}
		else
		{
			echo "<script>
			alert('Error!!!');
			</script>";	
		}		
		
	}
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
            <li><a href="#">Trending News</a></li>
            <li class="active">Create Trending News State</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Create Trending News State</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="" method="post">
                	
                  <div class="box-body">
                    <div class="form-group">
                      <label for="post_title">Title *</label>
                      <input class="form-control" name="post_title" id="post_title" required="required"  placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                      <label for="Category">Category *</label>                      
                      <select style="text-transform:capitalize"  class="form-control" required  name="cat_id2">
                      <option value="">-Change Category-</option>
                      	<?php $cat_id = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM category where cat_id not in (16,19,20,21,22,24,26,27,30,31,33,34,35,36,37,38,39,40,41,42,44,45, 46, 47,48,49,50)") or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
						while($cat_result = mysqli_fetch_array($cat_id))
						{
							$cat_name2=$cat_result['cat_name'];
							$cat_id2=$cat_result['cat_id'];
						
						?>
                        <option <?php echo "value=\"$cat_id2\""; ?>><?php echo $cat_name2 ?></option>
                         <?php }?>
                      </select>
                     </div>
                    <div class="form-group">
                      <label for="Description">Description *</label>
                      <textarea class="ckeditor form-control" rows="3" cols="80" required id="editor1" name="post_description" ></textarea>
                     
                    </div>
                 
                    
                    
                    
                    <div class="form-group">
 <link href="css/ui.css" rel="stylesheet">
      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
            <select id="display" name="state"  style="width:100%"  class="form-control" >
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
                          <input name="post_status" checked value="publish" type="radio"> <span class="label label-success">Publish</span>
                        </label>
                      </div>
                      <?php /*?><div class="radio">
                        <label>
                          <input name="post_status"  value="unpublish"  type="radio">
                          <span class="label label-danger">Unpublish</span>
                        </label>
                      </div><?php */?>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="add_post" class="btn btn-primary">Create Trending News State</button> 
                    
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
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
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
    <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
   
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    
   
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
