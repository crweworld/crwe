<?php
include ('connect_me.php');
include('functions.php');
if(isset($_GET['podid']) )
{
	$podid=mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['podid']);
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM podcast where id='$podid' and status='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	
	$pod = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM podcast where id='$podid' and status='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"])); 
	
	$user_sql=mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(*) FROM user where id='$pod->user_id' and active='1'")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	notfound($user_sql['count(*)']);
	
	$user = mysqli_fetch_object(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM user where id='$pod->user_id' and active='1' limit 1")) or die(mysqli_error($GLOBALS["___mysqli_ston"]));

	$metadesc='Listen to '.$user->username.' episodes free, on demand.The easiest way to listen to podcasts on your iPhone, iPad, Android, PC, smart speaker – and even in your car.';
	$metatitle='Podcast | '.htmlspecialchars_decode($pod->title);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $metatitle; ?></title>
<meta name="Description" content="<?php echo $metadesc; ?>">
<link type="text/css" rel="stylesheet" href="../assets/css/player.min.css">
</head>
<body>
<div id="audio"></div>
<a href="http://crweworld.com/" target="_blank">Powered by crweworld.com</a>
<?php $audio= '<audio controls><source src="'.$pod->location.'" /></audio>';?>
</body> <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../assets/js/player.min.js"></script>
	<script>
		$( document ).ready( function () {
			setTimeout( function () {
				$( '#audio' ).html( '<?php echo $audio;?>' );
				$( 'audio' ).audioPlayer();
			}, 1000 );			

		} );
	</script>
</html>
<?php } ?>