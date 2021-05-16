<?php include('subs/header.php') ;


if(!isset($_GET['crwe']))
{
	header('Location:index.php');
}
else{
	$crwe =$_GET['crwe'] ;
	
	$mystring = $crwe;
$findme   = "bbc.com";
$pos = strpos($mystring, $findme);

	if($crwe=="http://crwedomains.com/")
	{
		$crwetitle="Buy a Domain";
		$style="80em";
	}
	
	elseif($crwe=="http://crwepressrelease.com")
	{
		$crwetitle="Press Release";
		$style="120em";
	}
	elseif($crwe=="http://ib2bglobal.com")
	{
		$crwetitle="Business 2 Business";
		$style="110em";
	}
	elseif($pos== true)
	{
		$crwetitle="BBC";
		$style="365em";
	}
	else{$crwetitle="source"; $style="120em";}
}

?>
<!--<style>
	 html, body {height: 100%;
	 margin:0px;padding:0px;overflow:hidden}

#content, .container-fluid, .span9
{
   
    overflow-y:hidden;
    height:100%;
}?
</style>-->
<!-- WRAPPER-->
<div id="wrapper"><!-- PAGE WRAPPER-->
<title>Crwe World | <?php echo ucfirst($crwetitle)?></title>
<iframe class="container-fluid"  frameborder="0" style="overflow:hidden;height:<?php echo $style?>; margin-bottom: 3em;width:100%"  src="<?php echo $crwe?>" >
<p>Your browser does not support iframes.</p>
</iframe>
    
<div id="foot" style="background-color: rgb(0, 0, 0); padding: 1%; position: fixed; bottom: 0px; width: 100%;">
       <a href="#">&copy; Copyright 2015 crweworld.com</a>
</div>
<script src="/assets/js/jquery-1.11.2.min.js"></script>
<script src="/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="/assets/js/html5shiv.js"></script>
<script src="/assets/js/respond.min.js"></script>
<!--LOADING SCRIPTS FOR PAGE-->
<script src="/assets/vendors/skycons/skycons.js"></script>
<script src="/assets/vendors/easy-ticker/jquery.easing.min.js"></script>
<script src="/assets/vendors/easy-ticker/jquery.easy-ticker.min.js"></script>
<script src="/assets/js/pages/header_2.js"></script>
<!--CORE JAVASCRIPT-->
<script src="/assets/js/main.js"></script>
<script src="/assets/js/layout.js"></script>
<script src="/assets/js/menu_opener.js"></script>
<!--Weather-->

<script>
$(document).ready(function () {
    $.ajax({
        url: 'http://api.openweathermap.org/data/2.5/weather?q=<?php echo $api_state?>',
        dataType: 'json',
        type: 'GET',
        success: function (json) {
            var temp = Math.round(json.main.temp - 273.15);
            $('#city-weather-temperature').html(temp + '\xB0 C');
            $('#city-weather-description').html(json.weather[0].description);
            $('img#city-weather-icon').attr('src', 'http://openweathermap.org/img/w/' + json.weather[0].icon + '.png');
        },
        error: function (xhr, status, errorThrown) {
        }
    });
    $('nav ul li a').on('click', function () {
        var $this = $(this);
        var target = $this.text().toLowerCase();
        $this.parent().addClass('selected').siblings().removeClass('selected');
        $('#' + target).fadeIn('slow').removeClass('hide').siblings().not('nav').not('.nav-info-behind').hide();
        return false;
    });
});
//@ sourceURL=pen.js
</script>
</body>

</html>
