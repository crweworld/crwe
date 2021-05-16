<?php   
	$nav= basename($_SERVER['PHP_SELF']);
?>
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          
         

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          
          <li class="<?php if($nav =="index.php"){ echo "active";}?>"><a href="index.php"><i class='fa fa-tachometer'></i> <span>Dashboard</span></a></li>
           
          
          
           <li class="treeview <?php if($nav =="profile.php"){ echo "active";}if($nav =="edit_profile.php"){ echo "active";} if($nav =="payment_info.php"){ echo "active";}if($nav =="edit_payment_info.php"){ echo "active";} if($nav =="tax_form.php"){ echo "active";}if($nav =="edit_tax_form.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-user'></i> <span>Account</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="profile.php"){ echo "active";}  if($nav =="edit_profile.php"){ echo "active";}?>"><a href="profile.php"><i class='fa fa-circle-o'></i> <span>My Profile</span></a></li>   
                <li class="<?php if($nav =="payment_info.php"){ echo "active";} if($nav =="edit_payment_info.php"){ echo "active";}?>"><a href="payment_info.php"><i class="fa fa-circle-o"></i>Payment Information</a></li> 
                <li class="<?php if($nav =="tax_form.php"){ echo "active";} if($nav =="edit_tax_form.php"){ echo "active";}?>"><a href="tax_form.php"><i class="fa fa-circle-o"></i>Tax Information</a></li>                 
              </ul>
            </li>
            
            
            
           <li class="treeview <?php if($nav =="ecard.php" or $nav =="banner.php"){ echo "active";} ?>">
              <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span>Affiliate Tools</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="ecard.php"){ echo "active";} ?>"><a href="ecard.php"><i class='fa fa-circle-o'></i> <span>Create Your Business Card</span></a></li>   
                <li class="<?php if($nav =="banner.php"){ echo "active";}?>"><a href="banner.php"><i class="fa fa-circle-o"></i>Banner</a></li> 
                            
              </ul>
            </li>
            
         
           
            
             
            
            
		 
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
      