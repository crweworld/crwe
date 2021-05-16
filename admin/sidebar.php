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
          
          
          <li class="<?php if($nav =="subscribers.php"){ echo "active";} if($nav =="edit_subscriber.php"){ echo "active";}?>"><a href="subscribers.php"><i class='fa fa-thumbs-up'></i> <span>Subscribers</span></a></li>   
          
          <!--ad manager-->
           <li class="treeview <?php if($nav =="view_ads.php"){ echo "active";} if($nav =="edit_ads.php"){ echo "active";} if($nav =="ad_stats.php"){ echo "active";} if($nav =="view_ban_ads.php"){ echo "active";} if($nav =="edit_ban_ads.php"){ echo "active";} if($nav =="add_ban_ads.php"){ echo "active";}if($nav =="pop_stats.php"){ echo "active";} if($nav =="view_pop_ads.php"){ echo "active";} if($nav =="edit_pop_ads.php"){ echo "active";} if($nav =="add_pop_ads.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-bullhorn'></i> <span>Ad Manager</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_ads.php"){ echo "active";} if($nav =="edit_ads.php"){ echo "active";}?>"><a href="view_ads.php"><i class="fa fa-circle-o"></i> Side Ad</a></li>
                
                <li class="<?php if($nav =="view_ban_ads.php"){ echo "active";} if($nav =="edit_ban_ads.php"){ echo "active";} if($nav =="add_ban_ads.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-circle-o"></i> Banner Ad <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu menu-open">
                <li class="<?php if($nav =="view_ban_ads.php"){ echo "active";}?>"><a href="view_ban_ads.php"><i class="fa fa-circle-o"></i> View Banner Ad</a></li>
                <li class="<?php if($nav =="add_ban_ads.php"){ echo "active";}?>"><a href="add_ban_ads.php"><i class="fa fa-circle-o"></i> Create Banner Ad </a></li>
              </ul>
            </li>
			
			
			<li class="<?php if($nav =="view_pop_ads.php"){ echo "active";} if($nav =="edit_pop_ads.php"){ echo "active";} if($nav =="add_pop_ads.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-circle-o"></i> Popup Ad <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu menu-open">
                <li class="<?php if($nav =="view_pop_ads.php"){ echo "active";}?>"><a href="view_pop_ads.php"><i class="fa fa-circle-o"></i> View Popup Ad</a></li>
                <li class="<?php if($nav =="add_pop_ads.php"){ echo "active";}?>"><a href="add_pop_ads.php"><i class="fa fa-circle-o"></i> Create Popup Ad </a></li>
              </ul>
            </li>
			
			
              </ul>
            </li>
             <!--ad manager-->
            
         
                                   
            <?php if(isset($_SESSION['group']))
			{
				if($_SESSION['group']=="superadmin" or "miniadmin"){ ?>
				<li class="treeview <?php if($nav =="view_user.php"){ echo "active";} if($nav =="add_user.php"){ echo "active";}if($nav =="edit_user.php"){ echo "active";}?>">
				  <a href="#"><i class='fa fa-user'></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
				  <ul class="treeview-menu">
					<li class="<?php if($nav =="view_user.php"){ echo "active";}?>"><a href="view_user.php"><i class="fa fa-circle-o"></i> View Users</a></li>
					<li class="<?php if($nav =="add_user.php"){ echo "active";}?>"><a href="add_user.php"><i class="fa fa-circle-o"></i> Create Users</a></li>                
				  </ul>
				</li>
          		<li class="<?php if($nav =="stock_comments.php"){ echo "active";}?>"><a href="stock_comments.php"><i class='fa fa-comments-o'></i> <span>Stock comments</span></a></li>
           <?php
				}
			} ?>
          
          <?php if(isset($_SESSION['group']))
			{
				if($_SESSION['group']=="superadmin"){ ?>
            <li class="treeview <?php if($nav =="view_admin.php"){ echo "active";} if($nav =="add_admin.php"){ echo "active";}if($nav =="edit_admin.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-user'></i> <span>Mini Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="view_admin.php"){ echo "active";}?>"><a href="view_admin.php"><i class="fa fa-circle-o"></i> View Mini Admin</a></li>
                <li class="<?php if($nav =="add_admin.php"){ echo "active";}?>"><a href="add_admin.php"><i class="fa fa-circle-o"></i> Create Mini Admin</a></li>                
              </ul>
            </li>
           <?php
				}
			} ?>
          
           
          <li class="header">Front Page Manager</li>
          <li class="treeview <?php if($nav =="view_breaking_news.php"){ echo "active";} if($nav =="add_breaking_news.php"){ echo "active";}if($nav =="edit_breaking_news.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-newspaper-o"></i> <span>News Feed</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li class="<?php if($nav =="view_breaking_news.php"){ echo "active";}?>"><a href="view_breaking_news.php"><i class="fa fa-circle-o"></i> View Breaking News</a></li>
                <li class="<?php if($nav =="add_breaking_news.php"){ echo "active";}?>"><a href="add_breaking_news.php"><i class="fa fa-circle-o"></i> Create Breaking News</a></li>
                
              </ul>
            </li>
            
            <li class="<?php if($nav =="view_hv.php"){ echo "active";}?>"><a href="view_hv.php"><i class='fa fa-video-camera'></i> <span>Hot Videos</span></a></li>  
             <li class="<?php if($nav =="view_slider.php"){ echo "active";}?>"><a href="view_slider.php"><i class='fa fa-slideshare'></i> <span>Slider</span></a></li>  
             
             <li class="<?php if($nav =="view_stock.php"){ echo "active";} if($nav =="edit_stock.php"){ echo "active";} if($nav =="add_stock.php"){ echo "active";}?>">
              <a href="#"><i class="fa fa-money"></i> Stock <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu menu-open">
                <li class="<?php if($nav =="view_stock.php"){ echo "active";}?>"><a href="view_stock.php"><i class="fa fa-circle-o"></i> View Stock</a></li>
                <li class="<?php if($nav =="add_stock.php"){ echo "active";}?>"><a href="add_stock.php"><i class="fa fa-circle-o"></i> Create Stock</a></li>
              </ul>
            </li>
             
        
            <!-- Optionally, you can add icons to the links -->
           
            
             
             <li class="header">Article Manager</li>
             
             <li class="treeview <?php if($nav =="view_trendnews.php" or $nav =="add_trendnews_country.php" or $nav =="add_trendnews_state.php" or $nav =="edit_trendnews.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-file-text-o'></i> <span>Trending News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_trendnews.php"){ echo "active";}?>"><a href="view_trendnews.php"><i class="fa fa-circle-o"></i> View Trending News</a></li>
                <li class="<?php if($nav =="add_trendnews_state.php"){ echo "active";}?>"><a href="add_trendnews_state.php"><i class="fa fa-circle-o"></i> Create Trending News State</a></li>
                <li class="<?php if($nav =="add_trendnews_country.php"){ echo "active";}?>"><a href="add_trendnews_country.php"><i class="fa fa-circle-o"></i> Create Trending News Country</a></li>
                <li class="<?php if($nav =="add_trendnews_continent.php"){ echo "active";}?>"><a href="add_trendnews_continent.php"><i class="fa fa-circle-o"></i> Create Trending News Continent</a></li>
              </ul>
            </li>
            
            
             <li class="treeview <?php if($nav =="view_localnews.php" or $nav =="add_localnews.php" or $nav =="edit_localnews.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-file-text-o'></i> <span>Local News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_localnews.php"){ echo "active";}?>"><a href="view_localnews.php"><i class="fa fa-circle-o"></i> View Local News</a></li>
                <li class="<?php if($nav =="add_localnews.php"){ echo "active";}?>"><a href="add_localnews.php"><i class="fa fa-circle-o"></i> Create Local News</a></li>
              </ul>
            </li>
             
             <li class="treeview <?php if($nav =="view_posts.php"){ echo "active";} if($nav =="add_post.php"){ echo "active";}if($nav =="edit_post.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-file-text-o'></i> <span>Public News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_posts.php"){ echo "active";}?>"><a href="view_posts.php"><i class="fa fa-circle-o"></i> View Public News</a></li>
                <li class="<?php if($nav =="add_post.php"){ echo "active";}?>"><a href="add_post.php"><i class="fa fa-circle-o"></i> Create Public News</a></li>
              </ul>
            </li>
            <li class="treeview <?php if($nav =="view_cat.php"){ echo "active";} if($nav =="add_cat.php"){ echo "active";} if($nav =="edit_cat.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-files-o'></i> <span>Category</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_cat.php"){ echo "active";}?>"><a href="view_cat.php"><i class="fa fa-circle-o"></i> View Categories</a></li>
                <li class="<?php if($nav =="add_cat.php"){ echo "active";}?>"><a href="add_cat.php"><i class="fa fa-circle-o"></i> Create Category</a></li>
              </ul>
            </li>
             <li class="header">Video Manager</li>
             <li class="treeview <?php if($nav =="view_videos.php"){ echo "active";} if($nav =="add_video.php"){ echo "active";} if($nav =="edit_video.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-youtube-play'></i> <span>Video</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_videos.php"){ echo "active";}?>"><a href="view_videos.php"><i class="fa fa-circle-o"></i> View Videos</a></li>
                <li class="<?php if($nav =="add_video.php"){ echo "active";}?>"><a href="add_video.php"><i class="fa fa-circle-o"></i> Create Video</a></li>
              </ul>
            </li>
            <li class="treeview <?php if($nav =="view_vc.php"){ echo "active";} if($nav =="add_vc.php"){ echo "active";} if($nav =="edit_vc.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-file-video-o'></i> <span>Video Category</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_vc.php"){ echo "active";}?>"><a href="view_vc.php"><i class="fa fa-circle-o"></i> View Video Categories</a></li>
                <li class="<?php if($nav =="add_vc.php"){ echo "active";}?>"><a href="add_vc.php"><i class="fa fa-circle-o"></i> Add Video Category</a></li>
              </ul>
            </li>
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>