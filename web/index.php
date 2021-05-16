<!DOCTYPE html>
<html>
<head>
<title>Your web browser is no longer supported.</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

</head>
<?php
function strposa($haystack, $needles=array()) {
        $chr = array();
        foreach($needles as $needle) {
                $res = stripos($haystack, $needle);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}

if(isset($_SERVER['HTTP_USER_AGENT']))
{
	$agent=$_SERVER['HTTP_USER_AGENT'];
} else { $agent='';}
$agent =strtolower($agent);
$fliter2  = array('trident/5.0', 'trident/4.0');

if (!strposa($agent, $fliter2)) 
{
	header('Location:/');
	exit();
}

?>
<body>
<!--mian-content-->
<h1><a href="<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']?>"><img src="images/<?php echo $_SERVER['SERVER_NAME'];?>.jpg"></a></h1>
	<div class="main-wthree">
	  <h2>Your web browser is no longer supported.</h2>	
		<p style="padding: 2em;">Our website works with a wide range of browsers. However, if you'd like to use many of our latest and greatest features, please upgrade to a modern, fully supported browser.</p>
  	</div>
<!--//mian-content-->
<!-- copyright -->
	<div class="copyright-w3-agile">
		<p> &copy; 2017 <?php echo $_SERVER['SERVER_NAME'];?> . All rights reserved </p>
	</div>
<!-- //copyright --> 

</body>
</html>