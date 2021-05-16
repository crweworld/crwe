<?php
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Content-Type: text/html; charset=iso-8859-1' );
header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
header( 'Pragma: no-cache' );

include( 'connect_me.php' );
include( 'txtcleaner.php' );
$post_doc = date( "Y-m-d" );
$dir = $_SERVER[ 'DOCUMENT_ROOT' ] . "/accesswire";
$files = array_diff( scandir( $dir ), array( '..', '.', '.ftpquota' ) );
foreach ( $files as $file ) {
	$fileExt = end( explode( ".", $file ) );
	if ( $fileExt == 'xml' ) {
		$myfile = fopen( $dir . '/' . $file, "r" )or die( "Unable to open file!" );
		$xml = fread( $myfile, filesize( $dir . '/' . $file ) );

		$doc = new DOMDocument;
		$doc->loadXML( $xml );
		$xpath = new DOMXPath( $doc );
		$post_title = mysqli_real_escape_string($GLOBALS["___mysqli_ston"],$xpath->query( '//NewsML/Articles/Headline' )->item( 0 )->nodeValue);
		$post_description = mysqli_real_escape_string($GLOBALS["___mysqli_ston"],$xpath->query( '//NewsML/Articles/Body' )->item( 0 )->nodeValue);
		$post_description .= '<br> <br><p><em>&copy; ' . date( "Y" ) . ' Accesswire. All Rights Reserved.</em></p>';

		$post_sql = mysqli_fetch_array( mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT count(*) FROM posts where post_title='$post_title'" ) )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
		if ( $post_sql[ 'count(*)' ] == 0 ) {
			
			mysqli_query( $GLOBALS[ "___mysqli_ston" ], "INSERT INTO `posts`(`post_title`, `post_description`, `post_doc`, `cat_id`, `cat_status`, `post_status`) VALUES ('$post_title', '$post_description', '$post_doc',37, 'publish', 'publish')" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
			$post_id = ( ( is_null( $___mysqli_res = mysqli_insert_id( $GLOBALS[ "___mysqli_ston" ] ) ) ) ? false : $___mysqli_res );
			
			$cat_id = mysqli_query( $GLOBALS[ "___mysqli_ston" ], "SELECT * FROM category where `cat_id`='37' and cat_status='publish'" )or die( mysqli_error( $GLOBALS[ "___mysqli_ston" ] ) );
			while ( $cat_result = mysqli_fetch_array( $cat_id ) ) {
				$cat_name = $cat_result[ 'cat_name' ];
			}
			$post_url = "/article/" . txtcleaner( $cat_name ) . "/" . $post_id . "/" . txtcleaner( $post_title );

			mysqli_query( $GLOBALS[ "___mysqli_ston" ], "UPDATE `posts` SET `post_url`='$post_url' where post_id='$post_id'" );

                         //Auto share
			include('/home/crweworld/public_html/admin/auto_share/twitter.php');			
			//include('/home/crweworld/public_html/admin/auto_share/facebook.php');


			echo '<b>Posted</b> -> ' . $post_title . '<br>';
		} else {
			echo '<b>Duplicate</b> -> ' . $post_title . '<br>';
		}
	}
	unlink($dir.'/'.$file);
	fclose( $myfile );
}


( ( is_null( $___mysqli_res = mysqli_close( $mysql_link ) ) ) ? false : $___mysqli_res );
?>