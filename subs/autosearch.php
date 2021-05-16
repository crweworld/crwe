<script type="text/javascript">!function(o){var l=new Array;o.Watermark={ShowAll:function(){for(var o=0;o<l.length;o++)""==l[o].obj.val()?(l[o].obj.val(l[o].text),l[o].obj.css("color",l[o].WatermarkColor)):l[o].obj.css("color",l[o].DefaultColor)},HideAll:function(){for(var o=0;o<l.length;o++)l[o].obj.val()==l[o].text&&l[o].obj.val("")}},o.fn.Watermark=function(r,a){return a||(a="#aaa"),this.each(function(){function t(){n.val()==r&&n.val(""),n.css("color",e)}function c(){0==n.val().length||n.val()==r?(n.val(r),n.css("color",a)):n.css("color",e)}var n=o(this),e=n.css("color");l[l.length]={text:r,obj:n,DefaultColor:e,WatermarkColor:a},n.focus(t),n.blur(c),n.change(c),c()})}}(jQuery);</script>



<script type="text/javascript">
$(document).ready(function(){$(".search").keyup(function(){var e=$(this).val(),a="searchword="+e;return""==e?($("#zips").hide(),$("#state").hide(),$("#city").hide(),$("#looky").hide()):$.ajax({type:"POST",url:"/loadit/autosearch.php",data:a,cache:!1,success:function(e){$("#zips").html(e).show(),$("#state").hide(),$("#city").hide(),$("#looky").hide()}}),!1})}),jQuery(function(e){e("#searchbox").Watermark("Search")});
</script>
<style type="text/css">
#display{width:250px;display:none;margin-right:30px;border-left:solid 1px #dedede;border-right:solid 1px #dedede;border-bottom:solid 1px #dedede;overflow:hidden}.display_box{padding:4px;border-top:solid 1px #dedede;font-size:12px;height:40px;z-index:1000000;position:sticky;background-color:#fff;font-family: Roboto,Helvetica,Arial,sans-serif;cursor: pointer}.display_box:hover{background:#CC0101;color:#FFF}#shade{background-color:#0CF}
</style>