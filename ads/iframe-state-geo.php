<!DOCTYPE html>
<html><head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script  type="text/javascript" src="frams.js"></script>
    <link type="text/css" rel="stylesheet" href="frams.css">
    <script data-source="gwdpagedeck_min.js" data-version="1.1" data-exports-type="gwd-pagedeck" type="text/javascript">(function(){"use strict";var k=["-ms-","-moz-","-webkit-",""],l=function(a,c){for(var b,d,e=0;e<k.length;++e)b=k[e]+"transition-duration",d=""+c,a.style.setProperty(b,d)};function m(a,c,b,d,e,g,f){this.h=a;this.e=c;this.o=b;a=d||"none";this.i=e="none"===a?0:e||1E3;this.d=g||"linear";this.f=[];if(e){g=f||"top";if(f=this.h){f.classList.add("gwd-page");f.classList.add("center");f="center";if("push"==a)switch(g){case "top":f="top";break;case "bottom":f="bottom";break;case "left":f="left";break;case "right":f="right"}this.f.push(f);"fade"==a&&this.f.push("transparent")}f=this.e;e="center";if("none"!=a&&"fade"!=a)switch(g){case "top":e="bottom";break;case "bottom":e="top";
break;case "left":e="right";break;case "right":e="left"}f.classList.add(e);f.classList.add("gwd-page");"fade"==a&&f.classList.add("transparent")}}m.prototype.start=function(){if(this.i){var a=this.h,c=this.e;n(c,this.r.bind(this));a&&(l(a,this.i+"ms"),a.classList.add(this.d));l(c,this.i+"ms");c.classList.add(this.d);c.setAttribute("gwd-reflow",c.offsetWidth);if(a)for(var b=0;b<this.f.length;++b)a.classList.add(this.f[b]);p(c)}else this.o()};
var q=function(a,c,b,d){b="transform: matrix3d(1,0,0,0,0,1,0,0,0,0,1,0,"+b+","+d+",0,1);";return a+"."+c+"{-webkit-"+b+"-moz-"+b+"-ms-"+b+b+"}"},r="center top bottom left right transparent".split(" "),p=function(a){r.forEach(function(c){a.classList.remove(c)})},n=function(a,c){var b=function(){a.removeEventListener("webkitTransitionEnd",b);a.removeEventListener("transitionend",b);c()};a.addEventListener("webkitTransitionEnd",b);a.addEventListener("transitionend",b)};
m.prototype.r=function(){var a=this.h;a&&(p(a),l(a,0),a.classList.remove(this.d));l(this.e,0);this.e.classList.remove(this.d);this.o()};var s=function(a,c,b){var d;b?(d=document.createEvent("CustomEvent"),d.initCustomEvent(a,!0,!0,b)):(d=document.createEvent("Event"),d.initEvent(a,!0,!0));c.dispatchEvent(d)};document.registerElement&&document.registerElement("gwd-pagedeck",{prototype:Object.create(HTMLDivElement.prototype,{createdCallback:{value:function(){window.addEventListener("WebComponentsReady",this.handleWebComponentsReadyEvent_.bind(this),!1);this.l=this.forwardDeviceEventsToCurrentPage_.bind(this,"shake");this.k=this.forwardDeviceEventsToCurrentPage_.bind(this,"rotatetoportrait");this.j=this.forwardDeviceEventsToCurrentPage_.bind(this,"rotatetolandscape");this.a=[];this.m=this.handlePageLoaded_.bind(this);
this.q=this.endPageTransition_.bind(this);this.c=this.n=null;this.b=-1;this.g=!1;this.classList.add("gwd-pagedeck")},enumerable:!0},handleWebComponentsReadyEvent_:{value:function(){this.a=Array.prototype.slice.call(this.querySelectorAll("div[is=gwd-page]"));for(this.a.forEach(function(a){a.classList.add("gwd-page")});this.firstChild;)this.removeChild(this.firstChild);-1==this.b&&void 0!==this.p&&this.goToPage(this.p)},enumerable:!1},attachedCallback:{value:function(){if(!this.n){var a;a=this.offsetWidth;
var c=this.offsetHeight,b;b=this.id;b=(b&&"#")+b+".gwd-pagedeck > .gwd-page";a=q(b,"center",0,0)+q(b,"top",0,c)+q(b,"bottom",0,-c)+q(b,"left",a,0)+q(b,"right",-a,0);c=document.createElement("style");void 0!==c.cssText?c.cssText=a:c.innerHTML=a;document.head.appendChild(c);this.n=c}this.addEventListener("pageload",this.m,!1);document.body.addEventListener("shake",this.l,!0);document.body.addEventListener("rotatetoportrait",this.k,!0);document.body.addEventListener("rotatetolandscape",this.j,!0)},enumerable:!0},
detachedCallback:{value:function(){this.removeEventListener("pageload",this.m,!1);document.body.removeEventListener("shake",this.l,!0);document.body.removeEventListener("rotatetoportrait",this.k,!0);document.body.removeEventListener("rotatetolandscape",this.j,!0)},enumerable:!0},goToPageImpl_:{value:function(a,c,b,d,e){if(!(this.b==a||0>a||a>this.a.length-1||this.c)){var g=this.a[this.b],f=this.a[a];this.b=a;this.c=new m(g,f,this.q,c,b,d,e);this.appendChild(f);var h=f.gwdLoad&&!f.gwdIsLoaded();this.g=
h;setTimeout(function(){h?f.gwdLoad():this.startPageTransition_()}.bind(this),0)}},enumerable:!1},handlePageLoaded_:{value:function(a){this.g&&a.target.parentNode==this&&(this.startPageTransition_(),this.g=!1)}},startPageTransition_:{value:function(){s("pagetransitionstart",this);this.c.start()},enumerable:!1},endPageTransition_:{value:function(){this.c&&(this.c=null);var a=this.firstChild,c=this.lastChild,b=a==c;s("pagetransitionend",this,{outgoingPage:b?null:a,incomingPage:c});b||this.removeChild(a);
c.gwdPresent()},enumerable:!1},findPageIndexByAttributeValue:{value:function(a,c){for(var b=this.a.length,d,e=0;e<b;e++)if(d=this.a[e],"boolean"==typeof c){if(d.hasAttribute(a))return e}else if(d.getAttribute(a)==c)return e;return-1},enumerable:!0},goToNextPage:{value:function(a,c,b,d,e){var g=this.b,f=g+1;f>=this.a.length&&(f=a?0:g);this.goToPageImpl_(f,c,b,d,e)},enumerable:!0},goToPreviousPage:{value:function(a,c,b,d,e){var g=this.b,f=this.a.length,h=g-1;0>h&&(h=a?f-1:g);this.goToPageImpl_(h,c,
b,d,e)},enumerable:!0},goToPage:{value:function(a,c,b,d,e){this.a.length?(a="number"==typeof a?a:this.findPageIndexByAttributeValue("id",a),0<=a&&this.goToPageImpl_(a,c,b,d,e)):this.p=a},enumerable:!0},currentIndex:{get:function(){return 0<=this.b?this.b:void 0},enumerable:!0},getPage:{value:function(a){if("number"!=typeof a){if(!a)return null;a=this.findPageIndexByAttributeValue("id",a)}return 0>a||a>this.a.length-1?null:this.a[a]},enumerable:!0},getDefaultPage:{value:function(){var a=this.getAttribute("default-page");
return a?this.getPage(this.findPageIndexByAttributeValue("id",a)):this.getPage(0)},enumerable:!0},getOrientationSpecificPage:{value:function(a,c){var b=this.getPage(c),d=b.getAttribute("alt-orientation-page");if(!d)return b;var e=b.isPortrait(),g=1==a,d=this.getPage(d);return g==e?b:d},enumerable:!0},forwardDeviceEventsToCurrentPage_:{value:function(a,c){if(c.target==document.body){var b=this.getPage(this.b);s(a,b)}},enumerable:!1},getElementById:{value:function(a){for(var c=this.a.length,b=0;b<c;b++){var d=
this.a[b].querySelector("#"+a);if(d)return d}return null},enumerable:!0}}),"extends":"div"});})()</script>
    <script data-source="Enabler.js" data-exports-type="gwd-doubleclick" type="text/javascript" src="Enabler.js"></script>    
    <script data-source="gwddoubleclick_min.js" data-version="1.2" data-exports-type="gwd-doubleclick" type="text/javascript">(function(){"use strict";var g=function(a,b){if(a.contains&&1==b.nodeType)return a==b||a.contains(b);if("undefined"!=typeof a.compareDocumentPosition)return a==b||Boolean(a.compareDocumentPosition(b)&16);for(;b&&a!=b;)b=b.parentNode;return b==a};function h(){this.b={}}h.prototype.add=function(a,b){this.b[a]||(this.b[a]=[]);this.b[a].push(b)};function k(a,b){this.c=a;this.w=b;this.h=this.handleMetricEvent_.bind(this)}k.prototype.observe=function(a){if(a.nodeType==Node.ELEMENT_NODE)for(var b=Object.keys(this.c.b),d=0;d<b.length;d++){var c=document.getElementById(b[d]);c&&g(a,c)&&(this.c.b[b[d]]||[]).forEach(function(a){c.addEventListener(a.event,this.h,!1)}.bind(this))}};
var l=function(a,b){if(b.nodeType==Node.ELEMENT_NODE)for(var d=Object.keys(a.c.b),c=0;c<d.length;c++){var e=document.getElementById(d[c]);e&&g(b,e)&&(a.c.b[d[c]]||[]).forEach(function(a){e.removeEventListener(a.event,this.h,!1)}.bind(a))}};k.prototype.handleMetricEvent_=function(a){this.w(a)};document.registerElement&&document.registerElement("gwd-metric-event",{prototype:Object.create(HTMLElement.prototype,{})});document.registerElement&&document.registerElement("gwd-metric-configuration",{prototype:Object.create(HTMLElement.prototype,{})});document.registerElement&&document.registerElement("gwd-exit",{prototype:Object.create(HTMLElement.prototype,{})});document.registerElement&&document.registerElement("gwd-timer",{prototype:Object.create(HTMLElement.prototype,{})});document.registerElement&&document.registerElement("gwd-doubleclick",{prototype:Object.create(HTMLElement.prototype,{createdCallback:{value:function(){this.q=this.handleEnablerInit_.bind(this);this.i=this.handleEnablerVisible_.bind(this);this.p=this.handleEnablerPageLoaded_.bind(this);this.m=this.handleEnablerExpandStart_.bind(this);this.l=this.handleEnablerCollapseStart_.bind(this);this.h=this.handleMetricEvent_.bind(this);this.n=this.handlePageTransitionEnd_.bind(this);this.o=this.handleResize_.bind(this);
this.d=this.e=!1;this.j=[];this.r=window.innerHeight>=window.innerWidth?1:2},enumerable:!0},attachedCallback:{value:function(){Enabler.addEventListener(studio.events.StudioEvent.EXPAND_START,this.m);Enabler.addEventListener(studio.events.StudioEvent.COLLAPSE_START,this.l);this.a=this.querySelector("[is=gwd-pagedeck]");this.a.addEventListener("pagetransitionend",this.n,!1);this.c=this.getMetricConfiguration_();this.s=new k(this.c,this.h);window.addEventListener("resize",this.o,!1)},enumerable:!0},
detachedCallback:{value:function(){Enabler.removeEventListener(studio.events.StudioEvent.INIT,this.q);Enabler.removeEventListener(studio.events.StudioEvent.VISIBLE,this.i);Enabler.removeEventListener(studio.events.StudioEvent.PAGE_LOADED,this.p);Enabler.removeEventListener(studio.events.StudioEvent.EXPAND_START,this.m);Enabler.removeEventListener(studio.events.StudioEvent.COLLAPSE_START,this.l);this.a.removeEventListener("pagetransitionend",this.n,!1);window.removeEventListener("resize",this.o,!1)},
enumerable:!0},initAd:{value:function(){this.onEnablerInit_(this.q)},enumerable:!0},exit:{value:function(a,b,d){Enabler.exit(a,b);d&&this.goToPage()},enumerable:!0},exitOverride:{value:function(a,b,d){Enabler.exitOverride(a,b);d&&this.goToPage()},enumerable:!0},incrementCounter:{value:function(a,b){Enabler.counter(a,b)},enumerable:!0},startTimer:{value:function(a){Enabler.startTimer(a)},enumerable:!0},stopTimer:{value:function(a){Enabler.stopTimer(a)},enumerable:!0},reportManualClose:{value:function(){Enabler.reportManualClose()},
enumerable:!0},getMetricConfiguration_:{value:function(){var a=this.querySelector("gwd-metric-configuration"),b=new h;if(a)for(var a=Array.prototype.slice.call(a.getElementsByTagName("gwd-metric-event")),d=0;d<a.length;d++){var c=a[d],e=c.getAttribute("source");if(e){var f=c.getAttribute("exit"),c={event:c.getAttribute("event"),v:c.getAttribute("metric")||f,u:c.hasAttribute("cumulative"),exit:f};b.add(e,c)}}return b}},handleMetricEvent_:{value:function(a){var b=a.target,d=b.getAttribute("id")+": "+
a.type,c;i:{c=this.c.b[b.id]||[];for(var e=0;e<c.length;e++)if(c[e].event==a.type){c=c[e];break i}c=void 0}c.exit&&a.detail&&a.detail.url?(Enabler.exitOverride(b.id+": "+c.exit,a.detail.url),a.detail.handled=!0,a.detail.collapse&&this.goToPage()):this.incrementCounter(c.v||d,c.u)}},onEnablerInit_:{value:function(a){Enabler.isInitialized()?a():Enabler.addEventListener(studio.events.StudioEvent.INIT,a)},enumerable:!1},handleEnablerInit_:{value:function(){if(this.hasAttribute("polite-load"))this.onEnablerPageLoaded_(this.p);
else this.onEnablerVisible_(this.i)},enumerable:!1},onEnablerVisible_:{value:function(a){Enabler.isVisible()?a():Enabler.addEventListener(studio.events.StudioEvent.VISIBLE,a)},enumerable:!1},handleEnablerVisible_:{value:function(a){var b;a&&(b=a.detail);(a=b)?(b=document.createEvent("CustomEvent"),b.initCustomEvent("adinitialized",!0,!0,a)):(b=document.createEvent("Event"),b.initEvent("adinitialized",!0,!0));this.dispatchEvent(b);this.goToPage()},enumerable:!1},onEnablerPageLoaded_:{value:function(a){Enabler.isPageLoaded()?
a():Enabler.addEventListener(studio.events.StudioEvent.PAGE_LOADED,a)},enumerable:!1},handleEnablerPageLoaded_:{value:function(){this.onEnablerVisible_(this.i)},enumerable:!1},goToPage:{value:function(a,b,d,c,e){var f=this.a.getPage(this.a.currentIndex);if(a=a?this.a.getPage(a):this.a.getDefaultPage())a=this.a.getOrientationSpecificPage(window.innerHeight>=window.innerWidth?1:2,a.id),this.f=a.id,b&&(this.g={transition:b,duration:d,t:c,direction:e}),f&&a&&this.shouldExpand_(f,a)?Enabler.requestExpand():
f&&a&&this.shouldCollapse_(f,a)?Enabler.requestCollapse():(this.d=this.e=!1,this.goToNextPage_())},enumerable:!0},shouldExpand_:{value:function(a,b){return!this.e&&!a.hasAttribute("expanded")&&b.hasAttribute("expanded")}},shouldCollapse_:{value:function(a,b){return!this.d&&a.hasAttribute("expanded")&&!b.hasAttribute("expanded")}},handleEnablerExpandStart_:{value:function(){this.e=!0;Enabler.finishExpand();setTimeout(this.goToNextPage_.bind(this),30)},enumerable:!1},handleEnablerCollapseStart_:{value:function(){this.d=
!0;Enabler.finishCollapse();this.f||(this.reportManualClose(),this.f=this.a.getDefaultPage().id);setTimeout(this.goToNextPage_.bind(this),30)},enumerable:!1},handleResize_:{value:function(){if(!this.e&&!this.d){var a=window.innerHeight>=window.innerWidth?1:2;this.r!=a&&(this.r=a,(a=this.a.getPage(this.a.currentIndex))&&this.goToPage(a.id))}}},goToNextPage_:{value:function(){this.f&&(this.g?this.a.goToPage(this.f,this.g.transition,this.g.duration,this.g.t,this.g.direction):this.a.goToPage(this.f));
this.g=this.f=void 0}},handlePageTransitionEnd_:{value:function(a){this.e?this.e=!1:this.d&&(this.d=!1);if(a.target==this.a){var b=a.detail;a=b.outgoingPage;b=b.incomingPage;a&&this.handlePageUnbound_(a);this.handlePageBound_(b)}},enumerable:!1},handlePageBound_:{value:function(a){this.s.observe(a);if((a=a.querySelectorAll("video"))&&0<a.length){var b=studio.video&&studio.video.Reporter,d=this.registerVideoElements_.bind(this);this.k=Array.prototype.slice.call(a);b?d():Enabler.loadModule(studio.module.ModuleId.VIDEO,
d)}},enumerable:!1},handlePageUnbound_:{value:function(a){l(this.s,a);(a=a.querySelectorAll("video"))&&0<a.length&&this.unregisterVideoElements_()},enumerable:!1},registerVideoElements_:{value:function(){for(var a,b;this.k.length;)if(b=this.k.shift(),a=b.id)studio.video.Reporter.attach(a,b,b.autoplay),this.j.push(a)},enumerable:!1},unregisterVideoElements_:{value:function(){for(this.k=[];this.j.length;)studio.video.Reporter.detach(this.j.shift())},enumerable:!1}})});})()</script>
    <script data-source="gwdimage_min.js" data-version="1" data-exports-type="gwd-image" type="text/javascript">(function(){"use strict";var c=function(a){return"gwd-page"==a.tagName.toLowerCase()||"gwd-page"==a.getAttribute("is")},d=function(a){if(c(a))return a;for(;a&&9!=a.nodeType;)if((a=a.parentElement)&&c(a))return a;return null};var e=function(a,f){var b;b=document.createEvent("Event");b.initEvent(a,!0,!0);f.dispatchEvent(b)};document.registerElement&&document.registerElement("gwd-image",{prototype:Object.create(HTMLImageElement.prototype,{createdCallback:{value:function(){this.a=this.handleLoad_.bind(this);this.b=!1;var a=this.getAttribute("src");a&&(this.setAttribute("source",a),this.removeAttribute("src"))},enumerable:!0},attachedCallback:{value:function(){this.addEventListener("load",this.a,!1);this.addEventListener("error",this.a,!1);d(this)||"function"!=typeof this.gwdLoad||("function"==typeof this.gwdIsLoaded?this.gwdIsLoaded()||
this.gwdLoad():this.gwdLoad())},enumerable:!0},detachedCallback:{value:function(){this.removeEventListener("ready",this.a,!1);this.removeEventListener("error",this.a,!1)},enumerable:!0},gwdIsLoaded:{value:function(){return this.b}},gwdLoad:{value:function(){var a=this.getAttribute("source");a?this.setAttribute("src",a):e("load",this)},enumerable:!0},handleLoad_:{value:function(){e("ready",this);this.b=!0},enumerable:!1},attributeChangedCallback:{value:function(a){"source"==a&&this.removeAttribute("src")},
enumerable:!0}}),"extends":"img"});})()</script>
  </head>
  
  <body>
    <gwd-doubleclick id="gwd-ad" polite-load="">
      <gwd-metric-configuration></gwd-metric-configuration>
      <div is="gwd-pagedeck" class="gwd-page-container" id="pagedeck">
        <div is="gwd-page" id="page1" class="gwd-page-wrapper gwd-page-size gwd-lightbox" data-gwd-width="300px" data-gwd-height="250px" style="display: block;">
          <div class="gwd-page-content gwd-page-size">
          <a target="_blank" href="/contact">
            <img class="gwd-img-969i" is="gwd-image" source="/ads/images/model.jpg" id="model">
            <img class="gwd-img-n6xp" is="gwd-image" source="/ads/images/bg1.png" id="bg2">
            <img class="gwd-img-9ef2" is="gwd-image" source="/ads/images/bg2.png" id="bg1">
            <img class="gwd-img-3g52" is="gwd-image" source="/ads/images/logo.png" width="67px" id="logo">
            <img class="gwd-img-y28i gwd-gen-7zwsgwdanimation" is="gwd-image" source="/ads/images/button.png" id="button">
            <div class="gwd-div-r0l1 gwd-gen-6a6tgwdanimation editable" id="button_text">
              <div class="gwd-div-jhn3"><strong class="gwd-span-ab0y">CONTACT NOW</strong>

              </div>
            </div>
            <div class="gwd-div-tdsg gwd-gen-9iepgwdanimation" id="text_1">
              <div class="gwd-div-qjvq"><span class="gwd-span-7mp0"><span class="gwd-span-j0v3"> <span class="gwd-span-0ht9">State level </span></span>Geo-Targeting<br> Place your ad here</span>
              </div>
            </div>
            <!--<div class="gwd-div-553k gwd-gen-ohhrgwdanimation" id="text_2">
              <div class="gwd-div-w6in"><span class="gwd-span-oa1l">* Increase your business</span>

              </div>
              <div class="gwd-div-uwtu"><span class="gwd-span-6vvp">visibility <span class="gwd-span-4sf3">10 times</span></span>
              </div>
            </div>-->
            <img class="gwd-img-qz2z gwd-gen-udwhgwdanimation" is="gwd-image" source="/ads/images/cursor_1.png" id="cursor">
            </a>
          </div>
        </div>
      </div>
    </gwd-doubleclick>
    <script type="text/javascript" id="gwd-init-code">
      (function() {
document.body.style.opacity = "0";
var gwdAd = document.getElementById('gwd-ad');
/**
 * Handles the DOMContentLoaded event. The DOMContentLoaded event is
 * fired when the document has been completely loaded and parsed.
 */

function handleDomContentLoaded(event) {
  // This is a good place to show a loading or branding image while
  // the ad loads.
}

/**
 * Handles the WebComponentsReady event. This event is fired when all
 * custom elements have been registered and upgraded.
 */
function handleWebComponentsReady(event) {
  document.body.style.opacity = "";
  // Start the Ad lifecycle.
  setTimeout(function() {
    gwdAd.initAd();
  }, 0);
}

/**
 * Handles the event that is dispatched after the Ad has been
 * initialized and before the default page of the Ad is shown.
 */
function handleAdInitialized(event) {
  // This marks the end of the polite load phase of the Ad. If a
  // loading image was shown to the user, this is a good place to
  // remove it.
}

window.addEventListener('DOMContentLoaded',
    handleDomContentLoaded, false);
window.addEventListener('WebComponentsReady',
    handleWebComponentsReady, false);
window.addEventListener('adinitialized',
    handleAdInitialized, false);
})();
    </script>
  

<script type="text/javascript" data-exports-type="gwd-studio-registration">function StudioExports() {
}</script><script type="text/gwd-admetadata">{"version":1,"type":"DoubleClick","format":"","template":"","politeload":true,"counters":[],"timers":[],"exits":[],"creativeProperties":{"minWidth":300,"minHeight":250,"maxWidth":300,"maxHeight":250},"components":["gwd-image","gwd-doubleclick","gwd-page","gwd-pagedeck"]}</script>
</body>

</html>
