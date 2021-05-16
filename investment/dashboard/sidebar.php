<aside class="main-sidebar">
        <section class="sidebar">
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          
          <li class="<?php if($nav =="index.php"){ echo "active";}?>"><a href="/dashboard"><i class='fa fa-tachometer'></i> <span>Dashboard</span></a></li>
         
          <li class="<?php if($nav =="profile.php"){ echo "active";}?>"><a href="profile"><i class='fa fa-user'></i> <span>Profile</span></a></li>
          <?php if($_SESSION['pub_group']=='entrepreneur'){ ?>
          <li class="<?php if($nav =="proposal.php"){ echo "active";}?>"><a href="proposal"><i class='fa fa-money'></i> <span>Proposal</span></a></li>
		  <?php } if($_SESSION['pub_group']=='investor'){?>
          <li><a href="/proposals" target="_blank"><i class='fa fa-money'></i> <span>Proposals</span></a></li>
          <li class="<?php if($nav =="saved.php"){ echo "active";}?>"><a href="saved"><i class="fa fa-save"></i> <span>Saved Proposal</span></a></li>
          <?php } ?>
             
          </ul><!-- /.sidebar-menu -->
        </section>
      </aside>