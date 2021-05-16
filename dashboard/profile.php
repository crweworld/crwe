<?php
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
            <li><a href="#">Profile</a></li>
            <li class="active">View Profile</li>
          </ol>
        </section>
<form action="#" method="get">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">View Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
               
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	
                      	
                        <th>Name</th>
                        <th>Email</th>
                       
                        <th>Created On</th>
                                      
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr style="text-transform:capitalize;">
                      	
                      
                        <td><?php echo $_SESSION['pub_name'] ?></td>
                        <td><a href="edit_profile.php"><?php echo $_SESSION['pub_email'] ?></a></td>
                         
                        <td><?php echo $_SESSION['pub_doc'] ?></td>
                        
                      </tr>   
                                              
                    </tbody>
                    <tfoot>
                      <tr>
                     
                       <th>Name</th>
                        <th>Email</th>
                         
                        <th>Created On</th>
                         
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
        </form>
      </div><!-- /.content-wrapper -->
      <?php include('footer.php')?>
