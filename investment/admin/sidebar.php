 <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">          
          <li class="<?php if($nav =="index.php"){ echo "active";}?>"><a href="index.php"><i class='fa fa-tachometer'></i> <span>Dashboard</span></a></li>
          <li class="<?php if($nav =="view_user.php"){ echo "active";} if($nav =="edit_user.php"){ echo "active";}?>"><a href="view_user.php"><i class='fa fa-user'></i> <span>Users</span></a></li>
          <li class="<?php if($nav == "proposal.php" or $nav =="view_proposal.php"){ echo "active";}?>"><a href="view_proposal.php"><i class='fa fa-star'></i>Proposal</a></li>               
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>