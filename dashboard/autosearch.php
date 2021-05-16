
<script type="text/javascript" src="jquery.js"></script>
<script>
 function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      </script>
<script type="text/javascript">

$(document).ready(function(){

$(".search").keyup(function() 
{
var searchbox = $(this).val();
var dataString = 'searchword='+ searchbox;

if(searchbox=='')
{
}
else
{

$.ajax({
type: "POST",
url: "search.php",
data: dataString,
cache: false,
success: function(html)
{

$("#display").html(html).show();
	
	
	}
});
}return false;    


});
});

jQuery(function($){
   //$("#searchbox").Watermark("Search");
   });
</script>
<style type="text/css">

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
.display_box
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:40px;
}

.display_box:hover
{
background:#DD4B39;
color:#FFFFFF;
}
#shade
{
background-color:#00CCFF;

}


</style>