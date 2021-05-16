<?php include_once('connect_me.php');
$server_url = $_SERVER['REQUEST_URI'];
if(strpos($server_url, "/admin")!== false or strpos($server_url, "/publishers") !== false) {	
	echo '<script type="text/javascript" src="/subs/jquery.js"></script>';
}
 ?>



<script type="text/javascript">
$(document).ready(function(){

$(".country").change(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;
$("#zips").hide();

if(searchbox=='')
{
$("#display").hide();
$("#display2").hide();
$("#state").hide();
$("#looky").hide();

}
else
{
 $("#display").hide();	
 $("#display2").hide();
 $("#state").show();
$("#img1").show();
$.ajax({
type: "POST",
url: "/loadit/searchstate.php",
data: dataString,
cache: false,
success: function(html)
{
required: true
$("#display").html(html).show();
$("#looky").show();
$("#img1").hide();
 if(html=='')
{	
	$("#display").hide();
	$("#display2").hide();
	$("#state").hide();
	$("#city").hide();
}

}
});
}return false;    
});
});

jQuery(function($){
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$(".state").change(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;
$("#zips").hide();
if(searchbox=='')
{
$("#display2").hide();
$("#city").hide();
}
else
{
 $("#display2").hide();	
 $("#city").show();
$("#img2").show();
$.ajax({
type: "POST",
url: "/loadit/searchcity.php",
data: dataString,
cache: false,
success: function(html)
{
$("#display2").html(html).show();
$("#img2").hide();
if(html=='')
{
	$("#display2").hide();
	$("#city").hide();
	
}

}
});
}return false;    
});
});

jQuery(function($){
});
</script>
