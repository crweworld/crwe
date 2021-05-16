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
          
          
       
      
           <li class="treeview <?php if($nav =="view_affiliate.php"){ echo "active";} if($nav =="add_affiliate.php"){ echo "active";}if($nav =="edit_affiliate.php"){ echo "active";}if($nav =="affiliate_stats.php"){ echo "active";} if($nav =="pay_affiliate.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-user'></i> <span>Affiliate</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="view_affiliate.php"){ echo "active";}?>"><a href="view_affiliate.php"><i class="fa fa-circle-o"></i> View Affiliate</a></li>
                <li class="<?php if($nav =="add_affiliate.php"){ echo "active";}?>"><a href="add_affiliate.php"><i class="fa fa-circle-o"></i> Create Affiliate</a></li>  
                  <li class="<?php if($nav =="pay_affiliate.php"){ echo "active";}?>"><a href="pay_affiliate.php"><i class="fa fa-circle-o"></i> Pay Affiliate</a></li>                
              </ul>
            </li>
            
             <li class="treeview <?php if($nav =="transactions.php"){ echo "active";}if($nav =="commissions.php"){ echo "active";}if($nav =="payments.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-file'></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="commissions.php"){ echo "active";}?>"><a href="commissions.php"><i class="fa fa-circle-o"></i>Commissions</a></li>
                <li class="<?php if($nav =="transactions.php"){ echo "active";}?>"><a href="transactions.php"><i class="fa fa-circle-o"></i> Transactions</a></li> 
                 <li class="<?php if($nav =="payments.php"){ echo "active";}?>"><a href="payments.php"><i class="fa fa-circle-o"></i> Payments</a></li>             
              </ul>
            </li>
           
           
          <li class="header">Front Page Manager</li>
        
             <!--service rate-->
             <li class="treeview <?php if($nav =="view_sc.php"){ echo "active";} if($nav =="edit_sc.php"){ echo "active";} if($nav =="add_sc.php"){ echo "active";} if($nav =="view_si.php"){ echo "active";} if($nav =="edit_si.php"){ echo "active";} if($nav =="add_si.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-shopping-cart'></i> <span>Services Rate</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
               
                <li class="<?php if($nav =="view_sc.php"){ echo "active";} if($nav =="edit_sc.php"){ echo "active";} if($nav =="add_sc.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-circle-o"></i> Services Rate Category<i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu menu-open">             
                <li class="<?php if($nav =="view_sc.php"){ echo "active";}?>"><a href="view_sc.php"><i class="fa fa-circle-o"></i> View SR Category</a></li>
                <li class="<?php if($nav =="add_sc.php"){ echo "active";}?>"><a href="add_sc.php"><i class="fa fa-circle-o"></i> Create SR Category </a></li>
              </ul>
            </li>
			
			
             
			<li class="<?php if($nav =="view_si.php"){ echo "active";} if($nav =="edit_si.php"){ echo "active";} if($nav =="add_si.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-circle-o"></i> Services Rate Info <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu menu-open">
                <li class="<?php if($nav =="view_si.php"){ echo "active";}?>"><a href="view_si.php"><i class="fa fa-circle-o"></i> View SR Info</a></li>
                <li class="<?php if($nav =="add_si.php"){ echo "active";}?>"><a href="add_si.php"><i class="fa fa-circle-o"></i> Create SR Info </a></li>
              </ul>
            </li>
              </ul>
            </li>
          <!--service rate-->
        
            <!-- Optionally, you can add icons to the links -->
           
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>