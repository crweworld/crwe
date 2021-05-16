<?php

include( 'header.php' );
include( 'sidebar.php' );
if ( $_SESSION[ 'pub_group' ] != "global" ) {
  header( 'Location:index.php' );
}

if ( isset( $_POST[ 'add_post' ] ) ) {

  $post_status = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'post_status' ] );
  $post_title = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'post_title' ] );
  $post_description = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'post_description' ] );
  //

  $cat_id2 = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $_POST[ 'cat_id2' ] );


  if ( $post_title == "" ) {
    echo "<script>alert('Error!!! Title is Empty');</script>";
  } elseif ( $cat_id2 == "" ) {
    echo "<script>alert('Error!!! Category is Empty');</script>";
  }
  elseif ( $post_description == "" ) {
    echo "<script>alert('Error!!! Description is Empty');</script>";
  }

  else {
    $cat_id = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT * FROM category where `cat_id`='$cat_id2'" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
    while ( $cat_result = mysqli_fetch_array( $cat_id ) ) {
      $cat_status1 = $cat_result[ 'cat_status' ];
    }
    $post_description = str_replace( "textarea", "", $post_description );
    $insert_ok = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "INSERT INTO `posts`(`cat_id`, `cat_status`, `post_title`, `post_description`,  `post_doc`,  `post_status`, `user_id`) VALUES ( '$cat_id2','$cat_status1', '$post_title', '$post_description',  NOW(),  'publish', '{$_SESSION['pub_id']}')" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
    if ( $insert_ok == 1 ) {
      $post_id = ( ( is_null( $___mysqli_res = mysqli_insert_id( $GLOBALS[ "___mysqli_ston" ] ) ) ) ? false : $___mysqli_res );

      $cat_id = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT * FROM category where `cat_id`='$cat_id2' and cat_status='publish'" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
      while ( $cat_result = mysqli_fetch_array( $cat_id ) ) {
        $cat_name = $cat_result[ 'cat_name' ];
      }

      $post_url = "/article/" . txtcleaner( $cat_name ) . "/" . $post_id . "/" . txtcleaner( $post_title );

      mysqli_query( $GLOBALS[ "___mysqli_ston" ], "UPDATE `posts` SET   `post_url`='$post_url' where user_id={$_SESSION['pub_id']} and  post_id='$post_id'" );

      echo "<script>
			alert('Post Created Successfully');
			</script>";
    } else {
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
      });
    </script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Dashboard <small>Version 1.0</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="#">Public News</a></li>
      <li class="active">Create Public News</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Create Public News</h3>
          </div>
          <!-- /.box-header --> 
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
                  <?php
                  $cat_id = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT * FROM category where cat_id not in (16,19,20,21,22,24,26,27,30,31,33,34,35,36,37,38,39,40,41,42,44,45, 46, 47,48,49,50)" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
                  while ( $cat_result = mysqli_fetch_array( $cat_id ) ) {
                    $cat_name2 = $cat_result[ 'cat_name' ];
                    $cat_id2 = $cat_result[ 'cat_id' ];

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
                <label for="InputStatus">Post Status</label>
                <div class="radio">
                  <label>
                    <input name="post_status" checked value="publish" type="radio">
                    <span class="label label-success">Publish</span> </label>
                </div>
                <?php /*?>
<div class="radio">
  <label>
    <input name="post_status" value="unpublish" type="radio">
    <span class="label label-danger">Unpublish</span>
  </label>
</div>
                <?php */?>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" name="add_post" class="btn btn-primary">Create Post</button>
            </div>
          </form>
        </div>
        <!-- /.box --> 
      </div>
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper -->
<?php include('footer.php'); ?>
