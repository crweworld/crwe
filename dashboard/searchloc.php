<?php include ('../subs/connect_me.php'); 
$mainserver= 'http://'.str_replace("dashboard.","",$_SERVER['HTTP_HOST']);
?>

<script type="text/javascript" src="jquery.js"></script>

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

</script>
<script type="text/javascript">
$(document).ready(function(){

$(".state").click(function() 
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


</script>
<style type="text/css">
#img1,#img2,#state,#city,#looky
{
	display:none;
}
#display
{
width:250px;
display:none;
margin-right:30px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}

#display2
{
width:250px;
display:none;
margin-right:30px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}
</style>
