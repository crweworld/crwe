<?php   
	$nav= basename($_SERVER['PHP_SELF']);
	$mainserver= 'http://'.str_replace("dashboard.","",$_SERVER['HTTP_HOST']);
 if(isset($_SESSION['pub_group'])){	
?>
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          
         

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
          
          <li class="<?php if($nav =="index.php"){ echo "active";}?>"><a href="index.php"><i class='fa fa-tachometer'></i> <span>Dashboard</span></a></li>
          <?php if($_SESSION['pub_id']!='734'){?>
          	<li><a href="/user/<?php echo $_SESSION['pub_username'];?>"><i class='fa fa-globe'></i> <span>My Wall <img src="images/new.gif" /></span></a></li>
          	<?php } ?>
          <li><a href="<?php echo $mainserver?>/chat"><i class="fa fa-comments" aria-hidden="true"></i> <span>Chat Room </span></a></li>
          
          <li class="<?php if($nav =="profile.php"){ echo "active";}?>"><a href="profile.php"><i class='fa fa-user'></i> <span>Profile</span></a></li>
           
            <!-- Optionally, you can add icons to the links -->
              
           <?php 
			  //if($_SESSION['pub_group'] =="podcast")
			 {
		      ?>
             
              <li class="treeview <?php if($nav =="view_podcast.php" or $nav =="add_podcast.php" or $nav =="edit_podcast.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-headphones'></i> <span>Podcast</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_podcast.php"){ echo "active";}?>"><a href="view_podcast.php"><i class="fa fa-circle-o"></i> View Podcast</a></li>
                <li class="<?php if($nav =="add_podcast.php"){ echo "active";}?>"><a href="add_podcast.php"><i class="fa fa-circle-o"></i> Create Podcast</a></li>
              </ul>
            </li>
             
             <?php }
				  if($_SESSION['pub_group'] =="opinion")
			 {
		      ?>
              <li class="treeview <?php if($nav =="view_opinion.php" or $nav =="add_opinion.php" or $nav =="edit_opinion.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-file-text-o'></i> <span>Opinion</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_opinion.php"){ echo "active";}?>"><a href="view_opinion.php"><i class="fa fa-circle-o"></i> View Opinion</a></li>
                <li class="<?php if($nav =="add_opinion.php"){ echo "active";}?>"><a href="add_opinion.php"><i class="fa fa-circle-o"></i> Create Opinion</a></li>
              </ul>
            </li>
            
          <?php }?>
          
             <?php if($_SESSION['pub_group'] =="affiliate")
			 {
		      ?>
             
             <li class="treeview <?php if($nav =="view_localnews.php" or $nav =="add_localnews.php" or $nav =="edit_localnews.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-file-text-o'></i> <span>Local News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_localnews.php"){ echo "active";}?>"><a href="view_localnews.php"><i class="fa fa-circle-o"></i> View Local News</a></li>
                <li class="<?php if($nav =="add_localnews.php"){ echo "active";}?>"><a href="add_localnews.php"><i class="fa fa-circle-o"></i> Create Local News</a></li>
              </ul>
            </li>
             <?php } ?>
             
              <?php if($_SESSION['pub_group'] =="global") 
			 {
			  ?>
            
             <li class="treeview <?php if($nav =="view_posts.php"){ echo "active";} if($nav =="add_post.php"){ echo "active";}if($nav =="edit_post.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-file-text-o'></i> <span>Public News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_posts.php"){ echo "active";}?>"><a href="view_posts.php"><i class="fa fa-circle-o"></i> View Public News</a></li>
                <li class="<?php if($nav =="add_post.php"){ echo "active";}?>"><a href="add_post.php"><i class="fa fa-circle-o"></i> Create Public News</a></li>
              </ul>
            </li>
		 <?php } ?>
         
          <?php if($_SESSION['pub_group']=="state" or $_SESSION['pub_group']=="country") 
			 {
			  ?>
             <li class="treeview <?php if($nav =="view_trendnews.php" or $nav =="add_trendnews_country.php" or $nav =="add_trendnews_state.php" or $nav =="edit_trendnews.php"){ echo "active";}?>">
             <a href="#"><i class='fa fa-file-text-o'></i> <span>Trending News</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_trendnews.php"){ echo "active";}?>"><a href="view_trendnews.php"><i class="fa fa-circle-o"></i> View Trending News</a></li>
                <?php if($_SESSION['pub_group'] =="state") { ?>
                 <li class="<?php if($nav =="add_trendnews_state.php"){ echo "active";}?>"><a href="add_trendnews_state.php"><i class="fa fa-circle-o"></i> Create Trending News State</a></li>
                 <?php } ?>
                  <?php if($_SESSION['pub_group'] =="country") { ?>
                <li class="<?php if($nav =="add_trendnews_country.php"){ echo "active";}?>"><a href="add_trendnews_country.php"><i class="fa fa-circle-o"></i> Create Trending News Country</a></li>
                <?php } ?>
              </ul>
            </li>
		 <?php } ?>
        
        <?php if($_SESSION['pub_group']=="opinion") 
			 {
			  ?>
         <?php /*?><li class="header">Video Manager</li>
             <li class="treeview <?php if($nav =="view_videos.php"){ echo "active";} if($nav =="add_video.php"){ echo "active";} if($nav =="edit_video.php"){ echo "active";}?>">
              <a href="#"><i class='fa fa-youtube-play'></i> <span>Video</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($nav =="view_videos.php"){ echo "active";}?>"><a href="view_videos.php"><i class="fa fa-circle-o"></i> View Videos</a></li>
                <li class="<?php if($nav =="add_video.php"){ echo "active";}?>"><a href="add_video.php"><i class="fa fa-circle-o"></i> Create Video</a></li>
              </ul>
            </li><?php */?>
          <?php } ?>
             
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
         <div class="col-md-12"><a target="_blank" href="<?php echo $mainserver?>/chat"><img class="img-responsive" src="images/chat.png" /></a><br></div>
         <div class="col-md-12"><a target="_blank" href="<?php echo $mainserver?>/stock-track
"><img class="img-responsive" src="../assets/img/cw-stocks-2-dash.png"/></a></div>
      </aside>
     
   <?php } ?>