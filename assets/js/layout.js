!function(e){"use strict";e(window).bind("scroll load",function(){e("body").hasClass("menu-options")&&(e(this).scrollTop()>160?e("body").addClass("header-menu-fixed"):e("body").removeClass("header-menu-fixed"))}),e("#theme-setting > a.btn-theme-setting").click(function(){e("#theme-setting").css("right")<"0"?e("#theme-setting").css("right","0"):e("#theme-setting").css("right","-300px")}),e("#layout-wide").click(function(){e("body").removeClass("layout-boxed"),e("body").css("background","#ffffff"),e("#layout-boxed").removeClass("active"),e("#layout-wide").addClass("active"),e(".boxed-background-patterns, .boxed-background-images").slideUp("fast")}),e("#layout-boxed").click(function(){e("body").addClass("layout-boxed"),e("body").css("background","url(../assets/images/patterns/brickwall.png)"),e("#layout-boxed").addClass("active"),e("#layout-wide").removeClass("active"),e(".boxed-background-patterns, .boxed-background-images").slideDown("fast")}),e(".boxed-background-patterns ul > li > a").click(function(){var t=e(this).children().attr("src");e("body").css("background","url("+t+")")}),e(".boxed-background-images ul > li > a").click(function(){var t=e(this).children().attr("src");e("body").css("background","url("+t+") no-repeat 100% 100% fixed"),e("body").css("background-size","cover")}),e("#menu-static").click(function(){e("body").removeClass("menu-options"),e("#menu-fixed").removeClass("active"),e(this).addClass("active")}),e("#menu-fixed").click(function(){e("body").addClass("menu-options"),e("#menu-static").removeClass("active"),e(this).addClass("active")});var t=new Date,a=new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat"),s=a[t.getDay()],o=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),d=o[t.getMonth()],i=t.getFullYear(),n=s+", "+d+" "+t.getDate()+", "+i,c=t.getDate()+1,r=t.getDate()+2,l=t.getDate()+3,u=d+" "+c+", "+i,b=d+" "+r+", "+i,g=d+" "+l+", "+i;e(".date, .today-weather .info small").html(n),e(".date-weather.date1").html(u),e(".date-weather.date2").html(b),e(".date-weather.date3").html(g)}(jQuery);