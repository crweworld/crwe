<?php

 include('header.php');
 include('sidebar.php');
 
 if(isset($_SESSION['pub_id'])){
	 if($_SESSION['pub_username']==''){
		header( "Location: /dashboard/edit_profile.php?err=true" );
		 exit(); }	 
 }

if(!isset($_SESSION['pub_group'])){ $_SESSION['pub_group']='';}

$posts='';$posts='';$opinion='';
if(isset($_SESSION['pub_id'])){
	$posts= mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where post_status='publish' and user_id={$_SESSION['pub_id']}"));
	
	$posts=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where trend is not null and user_id={$_SESSION['pub_id']} and post_status='publish'"));

	$opinion= mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM posts where cat_id in (16,19,20,21,22,24,26,27,30,31,33,34,35,36,37,38,39,40,41,42,44,45,46) and user_id='{$_SESSION['pub_id']}' and post_status='publish'"));

}
 
 ?>
      <!-- Left side column. contains the logo and sidebar -->
      

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
            <!--<li class="active">Here</li>-->
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        	<div class="row">
          
        
       <?php if($_SESSION['pub_group'] =="global"){  ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $posts['count(*)']?></h3>
                  <p>Posts</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
       <?php } ?>
       
       <?php if($_SESSION['pub_group'] =="affiliate"){  ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
               <div class="small-box bg-olive">
                <div class="inner">
                  <h3><?php echo $posts['count(*)']?></h3>
                  <p>Posts</p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
       <?php } ?>
       
		 <?php if($_SESSION['pub_group'] =="opinion"){  ?>
         		 <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3><?php echo $opinion['count(*)']?></h3>
                  <p>Opinion</p>
                </div>
                <div class="icon">
                  <i class="fa fa-files-o"></i>
                </div>                
              </div>
            </div><!-- ./col -->
            
			  <?php } ?>
            
            
                    
                         <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-light-blue">
                <div class="inner">
                  <h3><?php echo 6617809 ?></h3>
                  <p>Post Available Locations</p>
                </div>
                <div class="icon">
                  <i class="fa fa-globe"></i>
                </div>                
              </div>
            </div><!-- ./col -->
          </div>
<h1>Disclaimer</h1>
<p>ENTERING OUR CHAT ROOMS OR POSTING TO CRWEWORLD.com WILL CONSTITUTE ACCEPTANCE OF THE TERMS AND CONDITIONS. <br />
IF YOU DO NOT AGREE TO ABIDE BY <a target="_blank" href="/terms_conditions">THESE TERMS</a>, PLEASE DO NOT ENTER OUR CHAT ROOM AND DO NOT POST ON OUR SITE.</p>
<h1>Instructions</h1>

<?php if($_SESSION['pub_group'] =="global") {?>
<!--for global-->
<p>1) To publish an article, click on &quot;Opinion&quot; located in the left column.</p>
<p>2) Select &quot;Create Opinion&quot; And create your article.</p>
<p>3) To view your content, click on &quot;Opinion&quot; and select &quot;View Opinion&quot;.</p>
<p>4) Select the date range you would like to take a view and then click on &quot;Apply&quot;</p>
<p>5) Afterwards click on &quot;View Now&quot;<br>
  (example if you selected August 22, 2015 - August 27, 2015, this date range will show your content published during that time)</p>
<p>6) To change your password, click on &quot;Profile&quot; then on your email and change the information.</p>

<?php } elseif($_SESSION['pub_group'] =="opinion") {?>
<!--for opinion-->
<p>1) To publish an article, click on &quot;Opinion&quot; located in the left column.</p>
<p>2) Select &quot;Create Opinion&quot; And create your article.</p>
<p>3) To view your content, click on &quot;Opinion&quot; and select &quot;View Opinion&quot;.</p>
<p>4) Select the date range you would like to take a view and then click on &quot;Apply&quot;</p>
<p>5) Afterwards click on &quot;View Now&quot;<br>
  (example if you selected August 22, 2015 - August 27, 2015, this date range will show your content published during that time)</p>
<p>6) To change your password, click on &quot;Profile&quot; then on your email and change the information.</p>

<?php } elseif($_SESSION['pub_group'] =="state") {?>
<!--for state-->
<p>1) To publish an article, click on &quot;Opinion&quot; located in the left column.</p>
<p>2) Select &quot;Create Opinion&quot; And create your article.</p>
<p>3) To view your content, click on &quot;Opinion&quot; and select &quot;View Opinion&quot;.</p>
<p>4) Select the date range you would like to take a view and then click on &quot;Apply&quot;</p>
<p>5) Afterwards click on &quot;View Now&quot;<br>
  (example if you selected August 22, 2015 - August 27, 2015, this date range will show your content published during that time)</p>
<p>6) To change your password, click on &quot;Profile&quot; then on your email and change the information.</p>

<?php } elseif($_SESSION['pub_group'] =="country") {?>
<!--for country-->
<p>1) To publish an article, click on &quot;Opinion&quot; located in the left column.</p>
<p>2) Select &quot;Create Opinion&quot; And create your article.</p>
<p>3) To view your content, click on &quot;Opinion&quot; and select &quot;View Opinion&quot;.</p>
<p>4) Select the date range you would like to take a view and then click on &quot;Apply&quot;</p>
<p>5) Afterwards click on &quot;View Now&quot;<br>
  (example if you selected August 22, 2015 - August 27, 2015, this date range will show your content published during that time)</p>
<p>6) To change your password, click on &quot;Profile&quot; then on your email and change the information.</p>

<?php } elseif($_SESSION['pub_group'] =="affiliate") {?>
<!--for affiliate-->
<p>1) To publish an article, click on &quot;Local News&quot; located in the left column.</p>
<p>2) Select &quot;Create Local News&quot; And create your article.</p>
<p>3) To view your content, click on &quot;Local News&quot; and select &quot;View Local News&quot;.</p>
<p>4) Select the date range you would like to take a view and then click on &quot;Apply&quot;</p>
<p>5) Afterwards click on &quot;View Now&quot;<br>
  (example if you selected August 22, 2015 - August 27, 2015, this date range will show your content published during that time)</p>
<p>6) To change your password, click on &quot;Profile&quot; then on your email and change the information.</p>
<?php } ?>

          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
     <?php include('footer.php')?>
