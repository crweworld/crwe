<?php
include( 'header.php' );
include( 'sidebar.php' );


if ( isset( $_POST[ 'add' ] ) ) {
  foreach ( $_POST as $key => $value ) {
    $$key = mysqli_real_escape_string( $GLOBALS[ "___mysqli_ston" ], $value );
  }
  $err_sin = "";
  if ( $title == "" ) {
    $err_sin .= "<i class=\"icon fa fa-info\"></i> Title is empty <br>";
  }
  if ( isset( $_FILES[ 'audio' ] )and( $_FILES[ 'audio' ][ 'size' ] > 0 ) ) {
    $file_name = strtolower( $_FILES[ 'audio' ][ 'name' ] );
    $file_tmp = $_FILES[ 'audio' ][ 'tmp_name' ];
    $kaboom = explode( ".", $file_name ); // Split file name into an array using the dot
    $fileExt = end( $kaboom );
    if ( $fileExt != "mp3" ) {
      $err_sin .= "<i class=\"icon fa fa-info\"></i> Please upload only .mp3<br>";
    }

  } else {
    $err_sin .= "<i class=\"icon fa fa-info\"></i> Audio file is empty <br>";
  }


  if ( $err_sin == "" ) {
    $insert_ok = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "INSERT INTO `podcast`(`title`,  `description`, `user_id`, `status`) VALUES ( '$title', '$description', '{$_SESSION['pub_id']}', '$status')" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
    if ( $insert_ok == 1 ) {
      $id = ( ( is_null( $___mysqli_res = mysqli_insert_id( $GLOBALS[ "___mysqli_ston" ] ) ) ) ? false : $___mysqli_res );

      if ( isset( $_FILES[ 'audio' ] )and( $_FILES[ 'audio' ][ 'size' ] > 0 ) ) {
        $file_tmp = $_FILES[ 'audio' ][ 'tmp_name' ];
        $kaboom = explode( ".", strtolower( $_FILES[ 'audio' ][ 'name' ] ) );
        $fileExt = end( $kaboom );

        $dirPath = "../assets/user/{$_SESSION['pub_id']}/podcast/$id/";
        if ( !file_exists( "$dirPath" ) ) {
          mkdir( "$dirPath", 0755, true );
        }
        $hash = substr( bin2hex( md5( rand(), true ) ), 0, 22 );
        $moveResult = move_uploaded_file( $file_tmp, $dirPath . $hash . '.' . $fileExt );
        $src = $loc = "/assets/user/{$_SESSION['pub_id']}/podcast/$id/$hash.$fileExt";
        $dest = "/assets/user/{$_SESSION['pub_id']}/podcast/$id/temp.$fileExt";
        $url = '/podcast/' . $id . '/' . txtcleaner( $title );
        mysqli_query( $GLOBALS[ "___mysqli_ston" ], "UPDATE `podcast` SET `location`='$loc', `url`='$url' where id='$id'" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
        shell_exec( "ffmpeg -i ..$src -map_metadata -1 -c:v copy -c:a copy ..$dest 2>&1" );
        unlink( "..$src" );
        rename( "..$dest", "..$src" );
      }
      $_POST = array();
      $done = "<i class=\"icon fa fa-info\"></i> Podcast Created Successfully. <br>";
    }
  }
}
?>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
<script type="text/javascript">
	$( function () {
		CKEDITOR.replace( 'editor1' );
	} );
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> Dashboard <small>Version 1.0</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a> </li>
      <li><a href="#">Podcast</a> </li>
      <li class="active">Create Podcast</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12"> 
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Create Podcast</h3>
          </div>
          <!-- /.box-header --> 
          <!-- form start -->
          <?php if(!empty($err_sin)){ ?>
          <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <h4><i class="icon fa fa-ban"></i> Error!</h4>
              <p>
                <?php  echo "$err_sin";?>
              </p>
            </div>
          </div>
          <?php } ?>
          <?php if(!empty($done)){ ?>
          <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              <h4><i class="fa fa-thumbs-o-up"></i> Success!</h4>
              <p>
                <?php  echo "$done"?>
              </p>
            </div>
          </div>
          <?php
          }
          if ( $_SESSION[ 'pub_username' ] != '' ) {
            ?>
          <form role="form" action="" method="post" enctype="multipart/form-data" >
            <div class="box-body">
              <div class="form-group">
                <label for="title">Title *</label>
                <input class="form-control" name="title"  required placeholder="Enter Title" type="text">
              </div>
              <div class="form-group">
                <label for="Description">Description</label>
                <textarea class="ckeditor form-control" rows="3" cols="80" required id="editor1" name="description"></textarea>
              </div>
              <div class="form-group">
                <label>Audio file (only mp3 *)</label>
                <input class="form-control" type="file" accept="audio/mp3" name="audio" required>
              </div>
              <div class="form-group">
                <label for="InputStatus">Post Status</label>
                <div class="radio">
                  <label>
                    <input <?php if(isset($_POST['status'])){ if($_POST['status']=='1'){echo 'checked';} } else { echo 'checked'; }?> name="status" value="1" type="radio">
                    <span class="label label-success">Publish</span></label>
                </div>
                <?php /*?><div class="radio"><label><input <?php if(isset($_POST['status'])){ if($_POST['status']=='0'){echo 'checked';} }?>name="status" value="0" type="radio"><span class="label label-danger">Unpublish</span></label></div><?php */?>
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box-footer">
              <button type="submit" name="add" class="btn btn-primary">Create Podcast</button>
            </div>
          </form>
          <?php }else{ echo '<a href="/dashboard/edit_profile.php">Kindly set your username to create podcast link</a>';} ?>
        </div>
        <!-- /.box --> 
      </div>
    </div>
    <!-- /.row --> 
  </section>
  <!-- /.content --> 
</div>
<!-- /.content-wrapper --> 
<script>
	$( 'input[type="file"]' ).change( function ( e ) {
		var type = e.target.files[ 0 ].name.toLowerCase().split( '.' ).pop();
		if ( type != 'mp3' ) {
			alert( 'Upload only mp3 file' );
			$( 'input[type="file"]' ).val( '' )
		}
	} );
</script>
<?php include( 'footer.php' );?>
