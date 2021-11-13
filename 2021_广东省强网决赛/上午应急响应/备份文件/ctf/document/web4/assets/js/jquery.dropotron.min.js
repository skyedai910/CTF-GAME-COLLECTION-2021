/* jquery.dropotron.js v1.4.3 | (c) @ajlkn | github.com/ajlkn/jquery.dropotron | MIT licensed */
!function(e){e.fn.disableSelection_dropotron=function(){return e(this).css("user-select","none").css("-khtml-user-select","none").css("-moz-user-select","none").css("-o-user-select","none").css("-webkit-user-select","none")},e.fn.dropotron=function(t){if(0==this.length)return e(this);if(this.length>1)for(var o=0;o<this.length;o++)e(this[o]).dropotron(t);return e.dropotron(e.extend({selectorParent:e(this)},t))},e.dropotron=function(t){var o=e.extend({selectorParent:null,baseZIndex:1e3,menuClass:"dropotron",expandMode:"hover",hoverDelay:150,hideDelay:250,openerClass:"opener",openerActiveClass:"active",submenuClassPrefix:"level-",mode:"fade",speed:"fast",easing:"swing",alignment:"left",offsetX:0,offsetY:0,globalOffsetY:0,IEOffsetX:0,IEOffsetY:0,noOpenerFade:!0,detach:!0,cloneOnDetach:!0},t),n=o.selectorParent,s=n.find("ul"),i=e("body"),a=e("body,html"),l=e(window),r=!1,d=null,c=null;n.on("doCollapseAll",function(){s.trigger("doCollapse")}),s.each(function(){var t=e(this),n=t.parent();o.hideDelay>0&&t.add(n).on("mouseleave",function(e){window.clearTimeout(c),c=window.setTimeout(function(){t.trigger("doCollapse")},o.hideDelay)}),t.disableSelection_dropotron().hide().addClass(o.menuClass).css("position","absolute").on("mouseenter",function(e){window.clearTimeout(c)}).on("doExpand",function(){if(t.is(":visible"))return!1;window.clearTimeout(c),s.each(function(){var t=e(this);e.contains(t.get(0),n.get(0))||t.trigger("doCollapse")});var i,a,d,f,u=n.offset(),p=n.position(),h=(n.parent().position(),n.outerWidth()),g=t.outerWidth(),v=t.css("z-index")==o.baseZIndex;if(v){switch(i=o.detach?u:p,f=i.top+n.outerHeight()+o.globalOffsetY,a=o.alignment,t.removeClass("left").removeClass("right").removeClass("center"),o.alignment){case"right":d=i.left-g+h,0>d&&(d=i.left,a="left");break;case"center":d=i.left-Math.floor((g-h)/2),0>d?(d=i.left,a="left"):d+g>l.width()&&(d=i.left-g+h,a="right");break;case"left":default:d=i.left,d+g>l.width()&&(d=i.left-g+h,a="right")}t.addClass(a)}else switch("relative"==n.css("position")||"absolute"==n.css("position")?(f=o.offsetY,d=-1*p.left):(f=p.top+o.offsetY,d=0),o.alignment){case"right":d+=-1*n.parent().outerWidth()+o.offsetX;break;case"center":case"left":default:d+=n.parent().outerWidth()+o.offsetX}navigator.userAgent.match(/MSIE ([0-9]+)\./)&&RegExp.$1<8&&(d+=o.IEOffsetX,f+=o.IEOffsetY),t.css("left",d+"px").css("top",f+"px").css("opacity","0.01").show();var C=!1;switch(d="relative"==n.css("position")||"absolute"==n.css("position")?-1*p.left:0,t.offset().left<0?(d+=n.parent().outerWidth()-o.offsetX,C=!0):t.offset().left+g>l.width()&&(d+=-1*n.parent().outerWidth()-o.offsetX,C=!0),C&&t.css("left",d+"px"),t.hide().css("opacity","1"),o.mode){case"zoom":r=!0,n.addClass(o.openerActiveClass),t.animate({width:"toggle",height:"toggle"},o.speed,o.easing,function(){r=!1});break;case"slide":r=!0,n.addClass(o.openerActiveClass),t.animate({height:"toggle"},o.speed,o.easing,function(){r=!1});break;case"fade":if(r=!0,v&&!o.noOpenerFade){var C;C="slow"==o.speed?80:"fast"==o.speed?40:Math.floor(o.speed/2),n.fadeTo(C,.01,function(){n.addClass(o.openerActiveClass),n.fadeTo(o.speed,1),t.fadeIn(o.speed,function(){r=!1})})}else n.addClass(o.openerActiveClass),n.fadeTo(o.speed,1),t.fadeIn(o.speed,function(){r=!1});break;case"instant":default:n.addClass(o.openerActiveClass),t.show()}return!1}).on("doCollapse",function(){return t.is(":visible")?(t.hide(),n.removeClass(o.openerActiveClass),t.find("."+o.openerActiveClass).removeClass(o.openerActiveClass),t.find("ul").hide(),!1):!1}).on("doToggle",function(e){return t.is(":visible")?t.trigger("doCollapse"):t.trigger("doExpand"),!1}),n.disableSelection_dropotron().addClass("opener").css("cursor","pointer").on("click touchend",function(e){r||(e.preventDefault(),e.stopPropagation(),t.trigger("doToggle"))}),"hover"==o.expandMode&&n.hover(function(e){r||(d=window.setTimeout(function(){t.trigger("doExpand")},o.hoverDelay))},function(e){window.clearTimeout(d)})}),s.find("a").css("display","block").on("click touchend",function(t){r||e(this).attr("href").length<1&&t.preventDefault()}),n.find("li").css("white-space","nowrap").each(function(){var t=e(this),o=t.children("a"),s=t.children("ul"),i=o.attr("href");o.on("click touchend",function(e){0==i.length||"#"==i?e.preventDefault():e.stopPropagation()}),o.length>0&&0==s.length&&t.on("click touchend",function(e){r||(n.trigger("doCollapseAll"),e.stopPropagation())})}),n.children("li").each(function(){var t,n=e(this),s=n.children("ul");if(s.length>0){o.detach&&(o.cloneOnDetach&&(t=s.clone(),t.attr("class","").hide().appendTo(s.parent())),s.detach().appendTo(i));for(var a=o.baseZIndex,l=1,r=s;r.length>0;l++)r.css("z-index",a++),o.submenuClassPrefix&&r.addClass(o.submenuClassPrefix+(a-1-o.baseZIndex)),r=r.find("> li > ul")}}),l.on("scroll",function(){n.trigger("doCollapseAll")}).on("keypress",function(e){r||27!=e.keyCode||(e.preventDefault(),n.trigger("doCollapseAll"))}),a.on("click touchend",function(){r||n.trigger("doCollapseAll")})}}(jQuery);

/* jquery.scrollgress vx.x | (c) @ajlkn | MIT licensed */
(function(){var e="scrollwatchResume",t="length",n="removeData",r="data",i="scrollwatch-state",s="scrollwatch-suspended",o="scrollgress-suspended",u="setTimeout",a="trigger",f="scroll",l="scrollwatchSuspend",c=!0,h="scrollwatch",p=null,d="top",v="rangeMin",m="rangeMax",g="scrollgress",y=!1,b="anchor",w="unscrollwatch",E="unscrollgress",S="element",x="-id",T="scroll.",N="height",C="scrollTop",k="center",L="bottom",A=$(window),O=$(document),M=1e3;jQuery.fn[e]=function(){var l,c;if(this[t]==0)return $(this);if(this[t]>1){for(l=0;l<this[t];l++)$(this[l])[e]();return this}return c=$(this),c[r](i,-1)[n](s)[n](o),window[u](function(){A[a](f)},50),c},jQuery.fn[l]=function(){var e,n;if(this[t]==0)return $(this);if(this[t]>1){for(e=0;e<this[t];e++)$(this[e])[l]();return this}return n=$(this),n[r](s,c),window[u](function(){A[a](f)},50),n},jQuery.fn[h]=function(e){var n,a,f,l,w;if(this[t]==0)return $(this);if(this[t]>1){for(n=0;n<this[t];n++)$(this[n])[h](e);return this}return a=jQuery.extend({range:.5,rangeMin:p,rangeMax:p,anchor:d,init:p,on:p,off:p,delay:0},e),a[v]===p&&(a[v]=-1*a.range),a[m]===p&&(a[m]=a.range),f=$(this),a.init&&(w=a.init),f[r](s,y)[r](i,-1)[g](function(e){if(f[r](s)===c){a.on&&a.on(f),f[r](o,c);return}window.clearTimeout(l),l=window[u](function(){var t,n,s=parseInt(f[r](i));if(s==0||s==-1){t=a[v]===y||e>=a[v],n=a[m]===y||e<=a[m];if(t&&n){f[r](i,1),a.on&&a.on(f),w&&(w(f,c),w=p);return}}if(s==1||s==-1){t=a[v]!==y&&e<a[v],n=a[m]!==y&&e>a[m];if(t||n){f[r](i,0),a.off&&a.off(f),w&&(w(f,y),w=p);return}}},w?0:a.delay)},{anchor:a[b]},h),f},jQuery.fn[w]=function(){var e,r;if(this[t]==0)return $(this);if(this[t]>1){for(e=0;e<this[t];e++)$(this[e])[w]();return this}return r=$(this),r[n](i)[E](h),r},jQuery.fn[g]=function(e,n,i){var s,u,l,h,p;if(this[t]==0)return $(this);if(this[t]>1){for(s=0;s<this[t];s++)$(this[s])[g](e,n,i);return $(this)}return i||(i=g),u=jQuery.extend({anchor:d,direction:"both",scope:S,easing:0},n),l=$(this),l[r](i+x)||l[r](i+x,M++),h=l[r](i+x),p=T+i+"-"+h,A.off(p).on(p,function(){var t,n,i,s;if(l[r](o)===c)return;t=l.offset()[d],n=l.outerHeight(),i=O[N]();switch(u.scope){default:case S:switch(u[b]){default:case d:s=(t-A[C]())/n*-1;break;case k:s=(t-A[C]()-(A[N]()-n)/2)/n*-1;break;case L:s=(t-A[C]()-(A[N]()-n))/n*-1}break;case"window":switch(u[b]){default:case d:s=(t-A[C]())/A[N]()*-1;break;case k:s=(t-A[C]()-(A[N]()-n)/2)/A[N]()*-1;break;case L:s=(t-A[C]()-(A[N]()-n))/A[N]()*-1}}u.direction=="forwards"?s=Math.max(0,s):u.direction=="backwards"&&(s=Math.min(0,s)),s>0?s=Math.max(0,s-u.easing/100):s<0&&(s=Math.min(0,s+u.easing/100)),e(s,l)})[a](f),l},jQuery.fn[E]=function(e){var i,s,o,u;if(this[t]==0)return $(this);if(this[t]>1){for(i=0;i<this[t];i++)$(this[i])[E](e);return $(this)}return e||(e=g),s=$(this),s[r](e+x)?(o=s[r](e+x),u=T+e+"-"+o,A.off(u),s[n](e+x),s):s}})();

jQuery(document).ready( function($) {

	skel.breakpoints({
		xlarge: '(max-width: 1800px)',
		large: '(max-width: 1280px)',
		medium: '(max-width: 980px)',
		mediumer: '(max-width: 840px)',
		small: '(max-width: 736px)',
		xsmall: '(max-width: 480px)'
	});

	$(function() {

		var $window = $(window),
		    $header = $('#header'),
			$banner = $('#banner'),
			$body = $('body');

		// 禁用动画/转换，直到页面加载。
			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 100);
			});

		// 触屏
			if (skel.vars.mobile) {

				// 开启触摸模式
					$body.addClass('is-touch');

				// 高度固定（大多为iOS）
					window.setTimeout(function() {
						$window.scrollTop($window.scrollTop() + 1);
					}, 0);

			}

		// 修正:占位符polyfill。
			$('form').placeholder();

		// 在中等屏幕中优先考虑“重要”元素
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});
			
		// 下拉菜单
			$('#navRight > ul').dropotron({
				alignment: 'right'
			});

			
			// 导航栏.
			if($('#bj_wrapper').length){
			// 导航按钮.
				$(
					'<div id="navButton">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// 导航面板.
			if($('#slideBar').length){
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').html() +
							$('#slideBar').html() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body);
			}else{
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').html() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body);
			}
				
				
				 $('#navButton').on('click',function(){
				 	$body.addClass('navPanel-visible');
				 });
				 $("#bj_wrapper").on('click',function(){
				   $body.removeClass('navPanel-visible');
				 });
			}
        
            // Header.
	        // 如果当前header是用“ALT”的造型，那么.banner使用scrollwatch
			// 一旦用户滚动过去的banner，让它恢复到正常的造型
			// 注意：这在移动设备上是被禁用的
				if (!skel.vars.mobile
				&&	$header.hasClass('alt')
				&&	$banner.length > 0) {
	
					$window.on('load', function() {
	
						$banner.scrollwatch({
							delay:		0,
							range:		0.5,
							anchor:		'top',
							on:			function() { $header.addClass('alt reveal'); },
							off:		function() { $header.removeClass('alt'); }
						});
	
					});
	
				}
            
            //内页侧边栏导航
            var body_w = $("body").width();
            var contain_w = $(".container").width();
            var bar_w = $(".api_doc_bar").width();
		    if(body_w > 736){
		        $(".api_doc_bar").css("left",(body_w-contain_w)/2);
		        $(".api_doc_content").css("padding-left",bar_w + 20);
		    }else{
		    	$(".api_doc_content").css("padding-left",0);
		    }
		    window.onresize = function(){
		        var body_w = $("body").width();
	            var contain_w = $(".container").width();
	            var bar_w = $(".api_doc_bar").width();
			    if(body_w > 736){
			        $(".api_doc_bar").css("left",(body_w-contain_w)/2);
			        $(".api_doc_content").css("padding-left",bar_w + 20);
			    }else{
			    	$(".api_doc_content").css("padding-left",0);
			    }
		    };
		    
		    var Nav_active = $(".active");
			var Nav_scroll = function(target) {
				Nav_active.removeClass("active");
				target.addClass("active");
				Nav_active = target;
			};
			$(".api_doc_bar dl a").click(function() {
				Nav_scroll($(this));
				var target = $(this).attr("href");
				var targetScroll = $(target).offset().top - 120;
				$("html,body").animate({
					scrollTop: targetScroll
				}, 300);
				return false;
			});		    
			
	})
});

/* skel.js v3.0.1 | (c) skel.io | MIT licensed */
var skel=function(){"use strict";var t={breakpointIds:null,events:{},isInit:!1,obj:{attachments:{},breakpoints:{},head:null,states:{}},sd:"/",state:null,stateHandlers:{},stateId:"",vars:{},DOMReady:null,indexOf:null,isArray:null,iterate:null,matchesMedia:null,extend:function(e,n){t.iterate(n,function(i){t.isArray(n[i])?(t.isArray(e[i])||(e[i]=[]),t.extend(e[i],n[i])):"object"==typeof n[i]?("object"!=typeof e[i]&&(e[i]={}),t.extend(e[i],n[i])):e[i]=n[i]})},newStyle:function(t){var e=document.createElement("style");return e.type="text/css",e.innerHTML=t,e},_canUse:null,canUse:function(e){t._canUse||(t._canUse=document.createElement("div"));var n=t._canUse.style,i=e.charAt(0).toUpperCase()+e.slice(1);return e in n||"Moz"+i in n||"Webkit"+i in n||"O"+i in n||"ms"+i in n},on:function(e,n){var i=e.split(/[\s]+/);return t.iterate(i,function(e){var a=i[e];if(t.isInit){if("init"==a)return void n();if("change"==a)n();else{var r=a.charAt(0);if("+"==r||"!"==r){var o=a.substring(1);if(o in t.obj.breakpoints)if("+"==r&&t.obj.breakpoints[o].active)n();else if("!"==r&&!t.obj.breakpoints[o].active)return void n()}}}t.events[a]||(t.events[a]=[]),t.events[a].push(n)}),t},trigger:function(e){return t.events[e]&&0!=t.events[e].length?(t.iterate(t.events[e],function(n){t.events[e][n]()}),t):void 0},breakpoint:function(e){return t.obj.breakpoints[e]},breakpoints:function(e){function n(t,e){this.name=this.id=t,this.media=e,this.active=!1,this.wasActive=!1}return n.prototype.matches=function(){return t.matchesMedia(this.media)},n.prototype.sync=function(){this.wasActive=this.active,this.active=this.matches()},t.iterate(e,function(i){t.obj.breakpoints[i]=new n(i,e[i])}),window.setTimeout(function(){t.poll()},0),t},addStateHandler:function(e,n){t.stateHandlers[e]=n},callStateHandler:function(e){var n=t.stateHandlers[e]();t.iterate(n,function(e){t.state.attachments.push(n[e])})},changeState:function(e){t.iterate(t.obj.breakpoints,function(e){t.obj.breakpoints[e].sync()}),t.vars.lastStateId=t.stateId,t.stateId=e,t.breakpointIds=t.stateId===t.sd?[]:t.stateId.substring(1).split(t.sd),t.obj.states[t.stateId]?t.state=t.obj.states[t.stateId]:(t.obj.states[t.stateId]={attachments:[]},t.state=t.obj.states[t.stateId],t.iterate(t.stateHandlers,t.callStateHandler)),t.detachAll(t.state.attachments),t.attachAll(t.state.attachments),t.vars.stateId=t.stateId,t.vars.state=t.state,t.trigger("change"),t.iterate(t.obj.breakpoints,function(e){t.obj.breakpoints[e].active?t.obj.breakpoints[e].wasActive||t.trigger("+"+e):t.obj.breakpoints[e].wasActive&&t.trigger("-"+e)})},generateStateConfig:function(e,n){var i={};return t.extend(i,e),t.iterate(t.breakpointIds,function(e){t.extend(i,n[t.breakpointIds[e]])}),i},getStateId:function(){var e="";return t.iterate(t.obj.breakpoints,function(n){var i=t.obj.breakpoints[n];i.matches()&&(e+=t.sd+i.id)}),e},poll:function(){var e="";e=t.getStateId(),""===e&&(e=t.sd),e!==t.stateId&&t.changeState(e)},_attach:null,attach:function(e){var n=t.obj.head,i=e.element;return i.parentNode&&i.parentNode.tagName?!1:(t._attach||(t._attach=n.firstChild),n.insertBefore(i,t._attach.nextSibling),e.permanent&&(t._attach=i),!0)},attachAll:function(e){var n=[];t.iterate(e,function(t){n[e[t].priority]||(n[e[t].priority]=[]),n[e[t].priority].push(e[t])}),n.reverse(),t.iterate(n,function(e){t.iterate(n[e],function(i){t.attach(n[e][i])})})},detach:function(t){var e=t.element;return t.permanent||!e.parentNode||e.parentNode&&!e.parentNode.tagName?!1:(e.parentNode.removeChild(e),!0)},detachAll:function(e){var n={};t.iterate(e,function(t){n[e[t].id]=!0}),t.iterate(t.obj.attachments,function(e){e in n||t.detach(t.obj.attachments[e])})},attachment:function(e){return e in t.obj.attachments?t.obj.attachments[e]:null},newAttachment:function(e,n,i,a){return t.obj.attachments[e]={id:e,element:n,priority:i,permanent:a}},init:function(){t.initMethods(),t.initVars(),t.initEvents(),t.obj.head=document.getElementsByTagName("head")[0],t.isInit=!0,t.trigger("init")},initEvents:function(){t.on("resize",function(){t.poll()}),t.on("orientationChange",function(){t.poll()}),t.DOMReady(function(){t.trigger("ready")}),window.onload&&t.on("load",window.onload),window.onload=function(){t.trigger("load")},window.onresize&&t.on("resize",window.onresize),window.onresize=function(){t.trigger("resize")},window.onorientationchange&&t.on("orientationChange",window.onorientationchange),window.onorientationchange=function(){t.trigger("orientationChange")}},initMethods:function(){document.addEventListener?!function(e,n){t.DOMReady=n()}("domready",function(){function t(t){for(r=1;t=n.shift();)t()}var e,n=[],i=document,a="DOMContentLoaded",r=/^loaded|^c/.test(i.readyState);return i.addEventListener(a,e=function(){i.removeEventListener(a,e),t()}),function(t){r?t():n.push(t)}}):!function(e,n){t.DOMReady=n()}("domready",function(t){function e(t){for(h=1;t=i.shift();)t()}var n,i=[],a=!1,r=document,o=r.documentElement,s=o.doScroll,c="DOMContentLoaded",d="addEventListener",u="onreadystatechange",l="readyState",f=s?/^loaded|^c/:/^loaded|c/,h=f.test(r[l]);return r[d]&&r[d](c,n=function(){r.removeEventListener(c,n,a),e()},a),s&&r.attachEvent(u,n=function(){/^c/.test(r[l])&&(r.detachEvent(u,n),e())}),t=s?function(e){self!=top?h?e():i.push(e):function(){try{o.doScroll("left")}catch(n){return setTimeout(function(){t(e)},50)}e()}()}:function(t){h?t():i.push(t)}}),Array.prototype.indexOf?t.indexOf=function(t,e){return t.indexOf(e)}:t.indexOf=function(t,e){if("string"==typeof t)return t.indexOf(e);var n,i,a=e?e:0;if(!this)throw new TypeError;if(i=this.length,0===i||a>=i)return-1;for(0>a&&(a=i-Math.abs(a)),n=a;i>n;n++)if(this[n]===t)return n;return-1},Array.isArray?t.isArray=function(t){return Array.isArray(t)}:t.isArray=function(t){return"[object Array]"===Object.prototype.toString.call(t)},Object.keys?t.iterate=function(t,e){if(!t)return[];var n,i=Object.keys(t);for(n=0;i[n]&&e(i[n],t[i[n]])!==!1;n++);}:t.iterate=function(t,e){if(!t)return[];var n;for(n in t)if(Object.prototype.hasOwnProperty.call(t,n)&&e(n,t[n])===!1)break},window.matchMedia?t.matchesMedia=function(t){return""==t?!0:window.matchMedia(t).matches}:window.styleMedia||window.media?t.matchesMedia=function(t){if(""==t)return!0;var e=window.styleMedia||window.media;return e.matchMedium(t||"all")}:window.getComputedStyle?t.matchesMedia=function(t){if(""==t)return!0;var e=document.createElement("style"),n=document.getElementsByTagName("script")[0],i=null;e.type="text/css",e.id="matchmediajs-test",n.parentNode.insertBefore(e,n),i="getComputedStyle"in window&&window.getComputedStyle(e,null)||e.currentStyle;var a="@media "+t+"{ #matchmediajs-test { width: 1px; } }";return e.styleSheet?e.styleSheet.cssText=a:e.textContent=a,"1px"===i.width}:t.matchesMedia=function(t){if(""==t)return!0;var e,n,i,a,r={"min-width":null,"max-width":null},o=!1;for(i=t.split(/\s+and\s+/),e=0;e<i.length;e++)n=i[e],"("==n.charAt(0)&&(n=n.substring(1,n.length-1),a=n.split(/:\s+/),2==a.length&&(r[a[0].replace(/^\s+|\s+$/g,"")]=parseInt(a[1]),o=!0));if(!o)return!1;var s=document.documentElement.clientWidth,c=document.documentElement.clientHeight;return null!==r["min-width"]&&s<r["min-width"]||null!==r["max-width"]&&s>r["max-width"]||null!==r["min-height"]&&c<r["min-height"]||null!==r["max-height"]&&c>r["max-height"]?!1:!0},navigator.userAgent.match(/MSIE ([0-9]+)/)&&RegExp.$1<9&&(t.newStyle=function(t){var e=document.createElement("span");return e.innerHTML='&nbsp;<style type="text/css">'+t+"</style>",e})},initVars:function(){var e,n,i,a=navigator.userAgent;e="other",n=0,i=[["firefox",/Firefox\/([0-9\.]+)/],["bb",/BlackBerry.+Version\/([0-9\.]+)/],["bb",/BB[0-9]+.+Version\/([0-9\.]+)/],["opera",/OPR\/([0-9\.]+)/],["opera",/Opera\/([0-9\.]+)/],["edge",/Edge\/([0-9\.]+)/],["safari",/Version\/([0-9\.]+).+Safari/],["chrome",/Chrome\/([0-9\.]+)/],["ie",/MSIE ([0-9]+)/],["ie",/Trident\/.+rv:([0-9]+)/]],t.iterate(i,function(t,i){return a.match(i[1])?(e=i[0],n=parseFloat(RegExp.$1),!1):void 0}),t.vars.browser=e,t.vars.browserVersion=n,e="other",n=0,i=[["ios",/([0-9_]+) like Mac OS X/,function(t){return t.replace("_",".").replace("_","")}],["ios",/CPU like Mac OS X/,function(t){return 0}],["wp",/Windows Phone ([0-9\.]+)/,null],["android",/Android ([0-9\.]+)/,null],["mac",/Macintosh.+Mac OS X ([0-9_]+)/,function(t){return t.replace("_",".").replace("_","")}],["windows",/Windows NT ([0-9\.]+)/,null],["bb",/BlackBerry.+Version\/([0-9\.]+)/,null],["bb",/BB[0-9]+.+Version\/([0-9\.]+)/,null]],t.iterate(i,function(t,i){return a.match(i[1])?(e=i[0],n=parseFloat(i[2]?i[2](RegExp.$1):RegExp.$1),!1):void 0}),t.vars.os=e,t.vars.osVersion=n,t.vars.IEVersion="ie"==t.vars.browser?t.vars.browserVersion:99,t.vars.touch="wp"==t.vars.os?navigator.msMaxTouchPoints>0:!!("ontouchstart"in window),t.vars.mobile="wp"==t.vars.os||"android"==t.vars.os||"ios"==t.vars.os||"bb"==t.vars.os}};return t.init(),t}();!function(t,e){"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?module.exports=e():t.skel=e()}(this,function(){return skel});



(function($) {

	/**
	 * Generate an indented list of links from a nav. Meant for use with panel().
	 * @return {jQuery} jQuery object.
	 */
	$.fn.navList = function() {

		var	$this = $(this);
			$a = $this.find('a'),
			b = [];

		$a.each(function() {

			var	$this = $(this),
				indent = Math.max(0, $this.parents('li').length - 1),
				href = $this.attr('href'),
				target = $this.attr('target');

			b.push(
				'<a ' +
					'class="link depth-' + indent + '"' +
					( (typeof target !== 'undefined' && target != '') ? ' target="' + target + '"' : '') +
					( (typeof href !== 'undefined' && href != '') ? ' href="' + href + '"' : '') +
				'>' +
					'<span class="indent-' + indent + '"></span>' +
					$this.text() +
				'</a>'
			);

		});

		return b.join('');

	};

	/**
	 * Panel-ify an element.
	 * @param {object} userConfig User config.
	 * @return {jQuery} jQuery object.
	 */
	$.fn.panel = function(userConfig) {

		// No elements?
			if (this.length == 0)
				return $this;

		// Multiple elements?
			if (this.length > 1) {

				for (var i=0; i < this.length; i++)
					$(this[i]).panel(userConfig);

				return $this;

			}

		// Vars.
			var	$this = $(this),
				$body = $('body'),
				$window = $(window),
				id = $this.attr('id'),
				config;

		// Config.
			config = $.extend({

				// Delay.
					delay: 0,

				// Hide panel on link click.
					hideOnClick: false,

				// Hide panel on escape keypress.
					hideOnEscape: false,

				// Hide panel on swipe.
					hideOnSwipe: false,

				// Reset scroll position on hide.
					resetScroll: false,

				// Reset forms on hide.
					resetForms: false,

				// Side of viewport the panel will appear.
					side: null,

				// Target element for "class".
					target: $this,

				// Class to toggle.
					visibleClass: 'visible'

			}, userConfig);

			// Expand "target" if it's not a jQuery object already.
				if (typeof config.target != 'jQuery')
					config.target = $(config.target);

		// Panel.

			// Methods.
				$this._hide = function(event) {

					// Already hidden? Bail.
						if (!config.target.hasClass(config.visibleClass))
							return;

					// If an event was provided, cancel it.
						if (event) {

							event.preventDefault();
							event.stopPropagation();

						}

					// Hide.
						config.target.removeClass(config.visibleClass);

					// Post-hide stuff.
						window.setTimeout(function() {

							// Reset scroll position.
								if (config.resetScroll)
									$this.scrollTop(0);

							// Reset forms.
								if (config.resetForms)
									$this.find('form').each(function() {
										this.reset();
									});

						}, config.delay);

				};

			// Vendor fixes.
				$this
					.css('-ms-overflow-style', '-ms-autohiding-scrollbar')
					.css('-webkit-overflow-scrolling', 'touch');

			// Hide on click.
				if (config.hideOnClick) {

					$this.find('a')
						.css('-webkit-tap-highlight-color', 'rgba(0,0,0,0)');

					$this
						.on('click', 'a', function(event) {

							var $a = $(this),
								href = $a.attr('href'),
								target = $a.attr('target');

							if (!href || href == '#' || href == '' || href == '#' + id)
								return;

							// Cancel original event.
								event.preventDefault();
								event.stopPropagation();

							// Hide panel.
								$this._hide();

							// Redirect to href.
								window.setTimeout(function() {

									if (target == '_blank')
										window.open(href);
									else
										window.location.href = href;

								}, config.delay + 10);

						});

				}

			// Event: Touch stuff.
				$this.on('touchstart', function(event) {

					$this.touchPosX = event.originalEvent.touches[0].pageX;
					$this.touchPosY = event.originalEvent.touches[0].pageY;

				})

				$this.on('touchmove', function(event) {

					if ($this.touchPosX === null
					||	$this.touchPosY === null)
						return;

					var	diffX = $this.touchPosX - event.originalEvent.touches[0].pageX,
						diffY = $this.touchPosY - event.originalEvent.touches[0].pageY,
						th = $this.outerHeight(),
						ts = ($this.get(0).scrollHeight - $this.scrollTop());

					// Hide on swipe?
						if (config.hideOnSwipe) {

							var result = false,
								boundary = 20,
								delta = 50;

							switch (config.side) {

								case 'left':
									result = (diffY < boundary && diffY > (-1 * boundary)) && (diffX > delta);
									break;

								case 'right':
									result = (diffY < boundary && diffY > (-1 * boundary)) && (diffX < (-1 * delta));
									break;

								case 'top':
									result = (diffX < boundary && diffX > (-1 * boundary)) && (diffY > delta);
									break;

								case 'bottom':
									result = (diffX < boundary && diffX > (-1 * boundary)) && (diffY < (-1 * delta));
									break;

								default:
									break;

							}

							if (result) {

								$this.touchPosX = null;
								$this.touchPosY = null;
								$this._hide();

								return false;

							}

						}

					// Prevent vertical scrolling past the top or bottom.
						if (($this.scrollTop() < 0 && diffY < 0)
						|| (ts > (th - 2) && ts < (th + 2) && diffY > 0)) {

							event.preventDefault();
							event.stopPropagation();

						}

				});

			// Event: Prevent certain events inside the panel from bubbling.
				$this.on('click touchend touchstart touchmove', function(event) {
					event.stopPropagation();
				});

			// Event: Hide panel if a child anchor tag pointing to its ID is clicked.
				$this.on('click', 'a[href="#' + id + '"]', function(event) {

					event.preventDefault();
					event.stopPropagation();

					config.target.removeClass(config.visibleClass);

				});

		// Body.

			// Event: Hide panel on body click/tap.
				$body.on('click touchend', function(event) {
					$this._hide(event);
				});

			// Event: Toggle.
				$body.on('click', 'a[href="#' + id + '"]', function(event) {

					event.preventDefault();
					event.stopPropagation();

					config.target.toggleClass(config.visibleClass);

				});

		// Window.

			// Event: Hide on ESC.
				if (config.hideOnEscape)
					$window.on('keydown', function(event) {

						if (event.keyCode == 27)
							$this._hide(event);

					});

		return $this;

	};

	/**
	 * Apply "placeholder" attribute polyfill to one or more forms.
	 * @return {jQuery} jQuery object.
	 */
	$.fn.placeholder = function() {

		// Browser natively supports placeholders? Bail.
			if (typeof (document.createElement('input')).placeholder != 'undefined')
				return $(this);

		// No elements?
			if (this.length == 0)
				return $this;

		// Multiple elements?
			if (this.length > 1) {

				for (var i=0; i < this.length; i++)
					$(this[i]).placeholder();

				return $this;

			}

		// Vars.
			var $this = $(this);

		// Text, TextArea.
			$this.find('input[type=text],textarea')
				.each(function() {

					var i = $(this);

					if (i.val() == ''
					||  i.val() == i.attr('placeholder'))
						i
							.addClass('polyfill-placeholder')
							.val(i.attr('placeholder'));

				})
				.on('blur', function() {

					var i = $(this);

					if (i.attr('name').match(/-polyfill-field$/))
						return;

					if (i.val() == '')
						i
							.addClass('polyfill-placeholder')
							.val(i.attr('placeholder'));

				})
				.on('focus', function() {

					var i = $(this);

					if (i.attr('name').match(/-polyfill-field$/))
						return;

					if (i.val() == i.attr('placeholder'))
						i
							.removeClass('polyfill-placeholder')
							.val('');

				});

		// Password.
			$this.find('input[type=password]')
				.each(function() {

					var i = $(this);
					var x = $(
								$('<div>')
									.append(i.clone())
									.remove()
									.html()
									.replace(/type="password"/i, 'type="text"')
									.replace(/type=password/i, 'type=text')
					);

					if (i.attr('id') != '')
						x.attr('id', i.attr('id') + '-polyfill-field');

					if (i.attr('name') != '')
						x.attr('name', i.attr('name') + '-polyfill-field');

					x.addClass('polyfill-placeholder')
						.val(x.attr('placeholder')).insertAfter(i);

					if (i.val() == '')
						i.hide();
					else
						x.hide();

					i
						.on('blur', function(event) {

							event.preventDefault();

							var x = i.parent().find('input[name=' + i.attr('name') + '-polyfill-field]');

							if (i.val() == '') {

								i.hide();
								x.show();

							}

						});

					x
						.on('focus', function(event) {

							event.preventDefault();

							var i = x.parent().find('input[name=' + x.attr('name').replace('-polyfill-field', '') + ']');

							x.hide();

							i
								.show()
								.focus();

						})
						.on('keypress', function(event) {

							event.preventDefault();
							x.val('');

						});

				});

		// Events.
			$this
				.on('submit', function() {

					$this.find('input[type=text],input[type=password],textarea')
						.each(function(event) {

							var i = $(this);

							if (i.attr('name').match(/-polyfill-field$/))
								i.attr('name', '');

							if (i.val() == i.attr('placeholder')) {

								i.removeClass('polyfill-placeholder');
								i.val('');

							}

						});

				})
				.on('reset', function(event) {

					event.preventDefault();

					$this.find('select')
						.val($('option:first').val());

					$this.find('input,textarea')
						.each(function() {

							var i = $(this),
								x;

							i.removeClass('polyfill-placeholder');

							switch (this.type) {

								case 'submit':
								case 'reset':
									break;

								case 'password':
									i.val(i.attr('defaultValue'));

									x = i.parent().find('input[name=' + i.attr('name') + '-polyfill-field]');

									if (i.val() == '') {
										i.hide();
										x.show();
									}
									else {
										i.show();
										x.hide();
									}

									break;

								case 'checkbox':
								case 'radio':
									i.attr('checked', i.attr('defaultValue'));
									break;

								case 'text':
								case 'textarea':
									i.val(i.attr('defaultValue'));

									if (i.val() == '') {
										i.addClass('polyfill-placeholder');
										i.val(i.attr('placeholder'));
									}

									break;

								default:
									i.val(i.attr('defaultValue'));
									break;

							}
						});

				});

		return $this;

	};

	/**
	 * Moves elements to/from the first positions of their respective parents.
	 * @param {jQuery} $elements Elements (or selector) to move.
	 * @param {bool} condition If true, moves elements to the top. Otherwise, moves elements back to their original locations.
	 */
	$.prioritize = function($elements, condition) {

		var key = '__prioritize';

		// Expand $elements if it's not already a jQuery object.
			if (typeof $elements != 'jQuery')
				$elements = $($elements);

		// Step through elements.
			$elements.each(function() {

				var	$e = $(this), $p,
					$parent = $e.parent();

				// No parent? Bail.
					if ($parent.length == 0)
						return;

				// Not moved? Move it.
					if (!$e.data(key)) {

						// Condition is false? Bail.
							if (!condition)
								return;

						// Get placeholder (which will serve as our point of reference for when this element needs to move back).
							$p = $e.prev();

							// Couldn't find anything? Means this element's already at the top, so bail.
								if ($p.length == 0)
									return;

						// Move element to top of parent.
							$e.prependTo($parent);

						// Mark element as moved.
							$e.data(key, $p);

					}

				// Moved already?
					else {

						// Condition is true? Bail.
							if (condition)
								return;

						$p = $e.data(key);

						// Move element back to its original location (using our placeholder).
							$e.insertAfter($p);

						// Unmark element as moved.
							$e.removeData(key);

					}

			});

	};

})(jQuery);


/* jquery.scrollgress vx.x | (c) @ajlkn | MIT licensed */
(function(){var e="scrollwatchResume",t="length",n="removeData",r="data",i="scrollwatch-state",s="scrollwatch-suspended",o="scrollgress-suspended",u="setTimeout",a="trigger",f="scroll",l="scrollwatchSuspend",c=!0,h="scrollwatch",p=null,d="top",v="rangeMin",m="rangeMax",g="scrollgress",y=!1,b="anchor",w="unscrollwatch",E="unscrollgress",S="element",x="-id",T="scroll.",N="height",C="scrollTop",k="center",L="bottom",A=$(window),O=$(document),M=1e3;jQuery.fn[e]=function(){var l,c;if(this[t]==0)return $(this);if(this[t]>1){for(l=0;l<this[t];l++)$(this[l])[e]();return this}return c=$(this),c[r](i,-1)[n](s)[n](o),window[u](function(){A[a](f)},50),c},jQuery.fn[l]=function(){var e,n;if(this[t]==0)return $(this);if(this[t]>1){for(e=0;e<this[t];e++)$(this[e])[l]();return this}return n=$(this),n[r](s,c),window[u](function(){A[a](f)},50),n},jQuery.fn[h]=function(e){var n,a,f,l,w;if(this[t]==0)return $(this);if(this[t]>1){for(n=0;n<this[t];n++)$(this[n])[h](e);return this}return a=jQuery.extend({range:.5,rangeMin:p,rangeMax:p,anchor:d,init:p,on:p,off:p,delay:0},e),a[v]===p&&(a[v]=-1*a.range),a[m]===p&&(a[m]=a.range),f=$(this),a.init&&(w=a.init),f[r](s,y)[r](i,-1)[g](function(e){if(f[r](s)===c){a.on&&a.on(f),f[r](o,c);return}window.clearTimeout(l),l=window[u](function(){var t,n,s=parseInt(f[r](i));if(s==0||s==-1){t=a[v]===y||e>=a[v],n=a[m]===y||e<=a[m];if(t&&n){f[r](i,1),a.on&&a.on(f),w&&(w(f,c),w=p);return}}if(s==1||s==-1){t=a[v]!==y&&e<a[v],n=a[m]!==y&&e>a[m];if(t||n){f[r](i,0),a.off&&a.off(f),w&&(w(f,y),w=p);return}}},w?0:a.delay)},{anchor:a[b]},h),f},jQuery.fn[w]=function(){var e,r;if(this[t]==0)return $(this);if(this[t]>1){for(e=0;e<this[t];e++)$(this[e])[w]();return this}return r=$(this),r[n](i)[E](h),r},jQuery.fn[g]=function(e,n,i){var s,u,l,h,p;if(this[t]==0)return $(this);if(this[t]>1){for(s=0;s<this[t];s++)$(this[s])[g](e,n,i);return $(this)}return i||(i=g),u=jQuery.extend({anchor:d,direction:"both",scope:S,easing:0},n),l=$(this),l[r](i+x)||l[r](i+x,M++),h=l[r](i+x),p=T+i+"-"+h,A.off(p).on(p,function(){var t,n,i,s;if(l[r](o)===c)return;t=l.offset()[d],n=l.outerHeight(),i=O[N]();switch(u.scope){default:case S:switch(u[b]){default:case d:s=(t-A[C]())/n*-1;break;case k:s=(t-A[C]()-(A[N]()-n)/2)/n*-1;break;case L:s=(t-A[C]()-(A[N]()-n))/n*-1}break;case"window":switch(u[b]){default:case d:s=(t-A[C]())/A[N]()*-1;break;case k:s=(t-A[C]()-(A[N]()-n)/2)/A[N]()*-1;break;case L:s=(t-A[C]()-(A[N]()-n))/A[N]()*-1}}u.direction=="forwards"?s=Math.max(0,s):u.direction=="backwards"&&(s=Math.min(0,s)),s>0?s=Math.max(0,s-u.easing/100):s<0&&(s=Math.min(0,s+u.easing/100)),e(s,l)})[a](f),l},jQuery.fn[E]=function(e){var i,s,o,u;if(this[t]==0)return $(this);if(this[t]>1){for(i=0;i<this[t];i++)$(this[i])[E](e);return $(this)}return e||(e=g),s=$(this),s[r](e+x)?(o=s[r](e+x),u=T+e+"-"+o,A.off(u),s[n](e+x),s):s}})();

jQuery(document).ready( function($) {

	skel.breakpoints({
		xlarge: '(max-width: 1800px)',
		large: '(max-width: 1280px)',
		medium: '(max-width: 980px)',
		mediumer: '(max-width: 840px)',
		small: '(max-width: 736px)',
		xsmall: '(max-width: 480px)'
	});

	$(function() {

		var $window = $(window),
		    $header = $('#header'),
			$banner = $('#banner'),
			$body = $('body');

		// 禁用动画/转换，直到页面加载。
			$body.addClass('is-loading');

			$window.on('load', function() {
				window.setTimeout(function() {
					$body.removeClass('is-loading');
				}, 100);
			});

		// 触屏
			if (skel.vars.mobile) {

				// 开启触摸模式
					$body.addClass('is-touch');

				// 高度固定（大多为iOS）
					window.setTimeout(function() {
						$window.scrollTop($window.scrollTop() + 1);
					}, 0);

			}

		// 修正:占位符polyfill。
			$('form').placeholder();

		// 在中等屏幕中优先考虑“重要”元素
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});
			
		// 下拉菜单
			$('#navRight > ul').dropotron({
				alignment: 'right'
			});

		// 导航栏.

			// 导航按钮.
				$(
					'<div id="navButton">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// 导航面板.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
							$('#navRight').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// 修正：删除 navpanel transitions在WP＜10上 避免卡顿
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#navButton, #navPanel, #page-wrapper')
						.css('transition', 'none');
        
            // Header.
	        // 如果当前header是用“ALT”的造型，那么.banner使用scrollwatch
			// 一旦用户滚动过去的banner，让它恢复到正常的造型
			// 注意：这在移动设备上是被禁用的
				if (!skel.vars.mobile
				&&	$header.hasClass('alt')
				&&	$banner.length > 0) {
	
					$window.on('load', function() {
	
						$banner.scrollwatch({
							delay:		0,
							range:		0.5,
							anchor:		'top',
							on:			function() { $header.addClass('alt reveal'); },
							off:		function() { $header.removeClass('alt'); }
						});
	
					});
	
				}
            
            //内页侧边栏导航
            var body_w = $("body").width();
            var contain_w = $(".container").width();
            var bar_w = $(".api_doc_bar").width();
		    if(body_w > 736){
		        $(".api_doc_bar").css("left",(body_w-contain_w)/2);
		        $(".api_doc_content").css("padding-left",bar_w + 20);
		    }else{
		    	$(".api_doc_content").css("padding-left",0);
		    }
		    window.onresize = function(){
		        var body_w = $("body").width();
	            var contain_w = $(".container").width();
	            var bar_w = $(".api_doc_bar").width();
			    if(body_w > 736){
			        $(".api_doc_bar").css("left",(body_w-contain_w)/2);
			        $(".api_doc_content").css("padding-left",bar_w + 20);
			    }else{
			    	$(".api_doc_content").css("padding-left",0);
			    }
		    };
		    
		    var Nav_active = $(".active");
			var Nav_scroll = function(target) {
				Nav_active.removeClass("active");
				target.addClass("active");
				Nav_active = target;
			};
			$(".api_doc_bar dl a").click(function() {
				Nav_scroll($(this));
				var target = $(this).attr("href");
				var targetScroll = $(target).offset().top - 120;
				$("html,body").animate({
					scrollTop: targetScroll
				}, 300);
				return false;
			});		    
			
			//==================banner轮播
            var $index=0;
            var $exdex=0;
            $(".slider_pic li").first().css('left','0');
            $(".slider_btn li").first().addClass('on');
            /*小点的鼠标移入事件，触发图片左移还是右移*/
            $(".slider_btn li").on('click',function(){
                //获取当前移入的index值
                $index=$(this).index();        
                //首先让点的颜色变化，表示选中
                $(".slider_btn li").eq($index).addClass("on").siblings().
                    removeClass("on");
                //判断如果index变小，证明图片要往左移动。变大则为右移
                if($index>$exdex){
                    next();
                }else if($index<$exdex){
                    pre();
                }
                //移动完毕将当前index值替换了前页index
                return $exdex=$index;
            });
            //这里为右移和左移的事件函数。
            //右移基本原理就是先让exdex定位的left左移百分百，而选中的当前页从屏幕右边移入,left变为0
            function next(){
                $(".slider_pic li").eq($index).stop(true,true).
                        css("left","100%").animate({"left":"0"});
                $(".slider_pic li").eq($exdex).stop(true,true).
                        css("left","0").animate({"left":"-100%"});
            }
            function pre(){
                $(".slider_pic li").eq($index).stop(true,true).
                    css("left","-100%").animate({"left":"0"});
                $(".slider_pic li").eq($exdex).stop(true,true).
                    css("left","0").animate({"left":"100%"});
            }
            
            //加个定时器，正常轮播
            var atime=setInterval(function(){
                $index++;
                if($index>1){
                    $index=0
                }
                $(".slider_btn li").eq($index).addClass("on").siblings().
                   removeClass("on");
                next();
                return $exdex=$index;          
            },3000);
            
            //悬浮时轮播停止
            $(".slider_pic").hover(
		        function(){
		        	clearInterval(atime);
		        },function(){
		    		atime=setInterval(function(){
		                $index++;
		                if($index>1){
		                    $index=0
		                }
		                $(".slider_btn li").eq($index).addClass("on").siblings().
		                   removeClass("on");
		                next();
		                return $exdex=$index;          
		            },3000);
		        }
		    );
            
			//===================时间轴收缩
			$(".year_div .list").each(function (e, target) {
			    var $target=  $(target),
			        $ul = $target.find("ul");
			    $target.height($ul.outerHeight()), $ul.css("position", "absolute");
			}); 
			$(".year_div > h2 > a").click(function (e) {
			    e.preventDefault();
			    $(this).parents(".year_div").toggleClass("close");
			});
	})
});

/* skel.js v3.0.1 | (c) skel.io | MIT licensed */
var skel=function(){"use strict";var t={breakpointIds:null,events:{},isInit:!1,obj:{attachments:{},breakpoints:{},head:null,states:{}},sd:"/",state:null,stateHandlers:{},stateId:"",vars:{},DOMReady:null,indexOf:null,isArray:null,iterate:null,matchesMedia:null,extend:function(e,n){t.iterate(n,function(i){t.isArray(n[i])?(t.isArray(e[i])||(e[i]=[]),t.extend(e[i],n[i])):"object"==typeof n[i]?("object"!=typeof e[i]&&(e[i]={}),t.extend(e[i],n[i])):e[i]=n[i]})},newStyle:function(t){var e=document.createElement("style");return e.type="text/css",e.innerHTML=t,e},_canUse:null,canUse:function(e){t._canUse||(t._canUse=document.createElement("div"));var n=t._canUse.style,i=e.charAt(0).toUpperCase()+e.slice(1);return e in n||"Moz"+i in n||"Webkit"+i in n||"O"+i in n||"ms"+i in n},on:function(e,n){var i=e.split(/[\s]+/);return t.iterate(i,function(e){var a=i[e];if(t.isInit){if("init"==a)return void n();if("change"==a)n();else{var r=a.charAt(0);if("+"==r||"!"==r){var o=a.substring(1);if(o in t.obj.breakpoints)if("+"==r&&t.obj.breakpoints[o].active)n();else if("!"==r&&!t.obj.breakpoints[o].active)return void n()}}}t.events[a]||(t.events[a]=[]),t.events[a].push(n)}),t},trigger:function(e){return t.events[e]&&0!=t.events[e].length?(t.iterate(t.events[e],function(n){t.events[e][n]()}),t):void 0},breakpoint:function(e){return t.obj.breakpoints[e]},breakpoints:function(e){function n(t,e){this.name=this.id=t,this.media=e,this.active=!1,this.wasActive=!1}return n.prototype.matches=function(){return t.matchesMedia(this.media)},n.prototype.sync=function(){this.wasActive=this.active,this.active=this.matches()},t.iterate(e,function(i){t.obj.breakpoints[i]=new n(i,e[i])}),window.setTimeout(function(){t.poll()},0),t},addStateHandler:function(e,n){t.stateHandlers[e]=n},callStateHandler:function(e){var n=t.stateHandlers[e]();t.iterate(n,function(e){t.state.attachments.push(n[e])})},changeState:function(e){t.iterate(t.obj.breakpoints,function(e){t.obj.breakpoints[e].sync()}),t.vars.lastStateId=t.stateId,t.stateId=e,t.breakpointIds=t.stateId===t.sd?[]:t.stateId.substring(1).split(t.sd),t.obj.states[t.stateId]?t.state=t.obj.states[t.stateId]:(t.obj.states[t.stateId]={attachments:[]},t.state=t.obj.states[t.stateId],t.iterate(t.stateHandlers,t.callStateHandler)),t.detachAll(t.state.attachments),t.attachAll(t.state.attachments),t.vars.stateId=t.stateId,t.vars.state=t.state,t.trigger("change"),t.iterate(t.obj.breakpoints,function(e){t.obj.breakpoints[e].active?t.obj.breakpoints[e].wasActive||t.trigger("+"+e):t.obj.breakpoints[e].wasActive&&t.trigger("-"+e)})},generateStateConfig:function(e,n){var i={};return t.extend(i,e),t.iterate(t.breakpointIds,function(e){t.extend(i,n[t.breakpointIds[e]])}),i},getStateId:function(){var e="";return t.iterate(t.obj.breakpoints,function(n){var i=t.obj.breakpoints[n];i.matches()&&(e+=t.sd+i.id)}),e},poll:function(){var e="";e=t.getStateId(),""===e&&(e=t.sd),e!==t.stateId&&t.changeState(e)},_attach:null,attach:function(e){var n=t.obj.head,i=e.element;return i.parentNode&&i.parentNode.tagName?!1:(t._attach||(t._attach=n.firstChild),n.insertBefore(i,t._attach.nextSibling),e.permanent&&(t._attach=i),!0)},attachAll:function(e){var n=[];t.iterate(e,function(t){n[e[t].priority]||(n[e[t].priority]=[]),n[e[t].priority].push(e[t])}),n.reverse(),t.iterate(n,function(e){t.iterate(n[e],function(i){t.attach(n[e][i])})})},detach:function(t){var e=t.element;return t.permanent||!e.parentNode||e.parentNode&&!e.parentNode.tagName?!1:(e.parentNode.removeChild(e),!0)},detachAll:function(e){var n={};t.iterate(e,function(t){n[e[t].id]=!0}),t.iterate(t.obj.attachments,function(e){e in n||t.detach(t.obj.attachments[e])})},attachment:function(e){return e in t.obj.attachments?t.obj.attachments[e]:null},newAttachment:function(e,n,i,a){return t.obj.attachments[e]={id:e,element:n,priority:i,permanent:a}},init:function(){t.initMethods(),t.initVars(),t.initEvents(),t.obj.head=document.getElementsByTagName("head")[0],t.isInit=!0,t.trigger("init")},initEvents:function(){t.on("resize",function(){t.poll()}),t.on("orientationChange",function(){t.poll()}),t.DOMReady(function(){t.trigger("ready")}),window.onload&&t.on("load",window.onload),window.onload=function(){t.trigger("load")},window.onresize&&t.on("resize",window.onresize),window.onresize=function(){t.trigger("resize")},window.onorientationchange&&t.on("orientationChange",window.onorientationchange),window.onorientationchange=function(){t.trigger("orientationChange")}},initMethods:function(){document.addEventListener?!function(e,n){t.DOMReady=n()}("domready",function(){function t(t){for(r=1;t=n.shift();)t()}var e,n=[],i=document,a="DOMContentLoaded",r=/^loaded|^c/.test(i.readyState);return i.addEventListener(a,e=function(){i.removeEventListener(a,e),t()}),function(t){r?t():n.push(t)}}):!function(e,n){t.DOMReady=n()}("domready",function(t){function e(t){for(h=1;t=i.shift();)t()}var n,i=[],a=!1,r=document,o=r.documentElement,s=o.doScroll,c="DOMContentLoaded",d="addEventListener",u="onreadystatechange",l="readyState",f=s?/^loaded|^c/:/^loaded|c/,h=f.test(r[l]);return r[d]&&r[d](c,n=function(){r.removeEventListener(c,n,a),e()},a),s&&r.attachEvent(u,n=function(){/^c/.test(r[l])&&(r.detachEvent(u,n),e())}),t=s?function(e){self!=top?h?e():i.push(e):function(){try{o.doScroll("left")}catch(n){return setTimeout(function(){t(e)},50)}e()}()}:function(t){h?t():i.push(t)}}),Array.prototype.indexOf?t.indexOf=function(t,e){return t.indexOf(e)}:t.indexOf=function(t,e){if("string"==typeof t)return t.indexOf(e);var n,i,a=e?e:0;if(!this)throw new TypeError;if(i=this.length,0===i||a>=i)return-1;for(0>a&&(a=i-Math.abs(a)),n=a;i>n;n++)if(this[n]===t)return n;return-1},Array.isArray?t.isArray=function(t){return Array.isArray(t)}:t.isArray=function(t){return"[object Array]"===Object.prototype.toString.call(t)},Object.keys?t.iterate=function(t,e){if(!t)return[];var n,i=Object.keys(t);for(n=0;i[n]&&e(i[n],t[i[n]])!==!1;n++);}:t.iterate=function(t,e){if(!t)return[];var n;for(n in t)if(Object.prototype.hasOwnProperty.call(t,n)&&e(n,t[n])===!1)break},window.matchMedia?t.matchesMedia=function(t){return""==t?!0:window.matchMedia(t).matches}:window.styleMedia||window.media?t.matchesMedia=function(t){if(""==t)return!0;var e=window.styleMedia||window.media;return e.matchMedium(t||"all")}:window.getComputedStyle?t.matchesMedia=function(t){if(""==t)return!0;var e=document.createElement("style"),n=document.getElementsByTagName("script")[0],i=null;e.type="text/css",e.id="matchmediajs-test",n.parentNode.insertBefore(e,n),i="getComputedStyle"in window&&window.getComputedStyle(e,null)||e.currentStyle;var a="@media "+t+"{ #matchmediajs-test { width: 1px; } }";return e.styleSheet?e.styleSheet.cssText=a:e.textContent=a,"1px"===i.width}:t.matchesMedia=function(t){if(""==t)return!0;var e,n,i,a,r={"min-width":null,"max-width":null},o=!1;for(i=t.split(/\s+and\s+/),e=0;e<i.length;e++)n=i[e],"("==n.charAt(0)&&(n=n.substring(1,n.length-1),a=n.split(/:\s+/),2==a.length&&(r[a[0].replace(/^\s+|\s+$/g,"")]=parseInt(a[1]),o=!0));if(!o)return!1;var s=document.documentElement.clientWidth,c=document.documentElement.clientHeight;return null!==r["min-width"]&&s<r["min-width"]||null!==r["max-width"]&&s>r["max-width"]||null!==r["min-height"]&&c<r["min-height"]||null!==r["max-height"]&&c>r["max-height"]?!1:!0},navigator.userAgent.match(/MSIE ([0-9]+)/)&&RegExp.$1<9&&(t.newStyle=function(t){var e=document.createElement("span");return e.innerHTML='&nbsp;<style type="text/css">'+t+"</style>",e})},initVars:function(){var e,n,i,a=navigator.userAgent;e="other",n=0,i=[["firefox",/Firefox\/([0-9\.]+)/],["bb",/BlackBerry.+Version\/([0-9\.]+)/],["bb",/BB[0-9]+.+Version\/([0-9\.]+)/],["opera",/OPR\/([0-9\.]+)/],["opera",/Opera\/([0-9\.]+)/],["edge",/Edge\/([0-9\.]+)/],["safari",/Version\/([0-9\.]+).+Safari/],["chrome",/Chrome\/([0-9\.]+)/],["ie",/MSIE ([0-9]+)/],["ie",/Trident\/.+rv:([0-9]+)/]],t.iterate(i,function(t,i){return a.match(i[1])?(e=i[0],n=parseFloat(RegExp.$1),!1):void 0}),t.vars.browser=e,t.vars.browserVersion=n,e="other",n=0,i=[["ios",/([0-9_]+) like Mac OS X/,function(t){return t.replace("_",".").replace("_","")}],["ios",/CPU like Mac OS X/,function(t){return 0}],["wp",/Windows Phone ([0-9\.]+)/,null],["android",/Android ([0-9\.]+)/,null],["mac",/Macintosh.+Mac OS X ([0-9_]+)/,function(t){return t.replace("_",".").replace("_","")}],["windows",/Windows NT ([0-9\.]+)/,null],["bb",/BlackBerry.+Version\/([0-9\.]+)/,null],["bb",/BB[0-9]+.+Version\/([0-9\.]+)/,null]],t.iterate(i,function(t,i){return a.match(i[1])?(e=i[0],n=parseFloat(i[2]?i[2](RegExp.$1):RegExp.$1),!1):void 0}),t.vars.os=e,t.vars.osVersion=n,t.vars.IEVersion="ie"==t.vars.browser?t.vars.browserVersion:99,t.vars.touch="wp"==t.vars.os?navigator.msMaxTouchPoints>0:!!("ontouchstart"in window),t.vars.mobile="wp"==t.vars.os||"android"==t.vars.os||"ios"==t.vars.os||"bb"==t.vars.os}};return t.init(),t}();!function(t,e){"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?module.exports=e():t.skel=e()}(this,function(){return skel});

(function($) {

	/**
	 * Generate an indented list of links from a nav. Meant for use with panel().
	 * @return {jQuery} jQuery object.
	 */
	$.fn.navList = function() {

		var	$this = $(this);
			$a = $this.find('a'),
			b = [];

		$a.each(function() {

			var	$this = $(this),
				indent = Math.max(0, $this.parents('li').length - 1),
				href = $this.attr('href'),
				target = $this.attr('target');

			b.push(
				'<a ' +
					'class="link depth-' + indent + '"' +
					( (typeof target !== 'undefined' && target != '') ? ' target="' + target + '"' : '') +
					( (typeof href !== 'undefined' && href != '') ? ' href="' + href + '"' : '') +
				'>' +
					'<span class="indent-' + indent + '"></span>' +
					$this.text() +
				'</a>'
			);

		});

		return b.join('');

	};

	/**
	 * Panel-ify an element.
	 * @param {object} userConfig User config.
	 * @return {jQuery} jQuery object.
	 */
	$.fn.panel = function(userConfig) {

		// No elements?
			if (this.length == 0)
				return $this;

		// Multiple elements?
			if (this.length > 1) {

				for (var i=0; i < this.length; i++)
					$(this[i]).panel(userConfig);

				return $this;

			}

		// Vars.
			var	$this = $(this),
				$body = $('body'),
				$window = $(window),
				id = $this.attr('id'),
				config;

		// Config.
			config = $.extend({

				// Delay.
					delay: 0,

				// Hide panel on link click.
					hideOnClick: false,

				// Hide panel on escape keypress.
					hideOnEscape: false,

				// Hide panel on swipe.
					hideOnSwipe: false,

				// Reset scroll position on hide.
					resetScroll: false,

				// Reset forms on hide.
					resetForms: false,

				// Side of viewport the panel will appear.
					side: null,

				// Target element for "class".
					target: $this,

				// Class to toggle.
					visibleClass: 'visible'

			}, userConfig);

			// Expand "target" if it's not a jQuery object already.
				if (typeof config.target != 'jQuery')
					config.target = $(config.target);

		// Panel.

			// Methods.
				$this._hide = function(event) {

					// Already hidden? Bail.
						if (!config.target.hasClass(config.visibleClass))
							return;

					// If an event was provided, cancel it.
						if (event) {

							event.preventDefault();
							event.stopPropagation();

						}

					// Hide.
						config.target.removeClass(config.visibleClass);

					// Post-hide stuff.
						window.setTimeout(function() {

							// Reset scroll position.
								if (config.resetScroll)
									$this.scrollTop(0);

							// Reset forms.
								if (config.resetForms)
									$this.find('form').each(function() {
										this.reset();
									});

						}, config.delay);

				};

			// Vendor fixes.
				$this
					.css('-ms-overflow-style', '-ms-autohiding-scrollbar')
					.css('-webkit-overflow-scrolling', 'touch');

			// Hide on click.
				if (config.hideOnClick) {

					$this.find('a')
						.css('-webkit-tap-highlight-color', 'rgba(0,0,0,0)');

					$this
						.on('click', 'a', function(event) {

							var $a = $(this),
								href = $a.attr('href'),
								target = $a.attr('target');

							if (!href || href == '#' || href == '' || href == '#' + id)
								return;

							// Cancel original event.
								event.preventDefault();
								event.stopPropagation();

							// Hide panel.
								$this._hide();

							// Redirect to href.
								window.setTimeout(function() {

									if (target == '_blank')
										window.open(href);
									else
										window.location.href = href;

								}, config.delay + 10);

						});

				}

			// Event: Touch stuff.
				$this.on('touchstart', function(event) {

					$this.touchPosX = event.originalEvent.touches[0].pageX;
					$this.touchPosY = event.originalEvent.touches[0].pageY;

				})

				$this.on('touchmove', function(event) {

					if ($this.touchPosX === null
					||	$this.touchPosY === null)
						return;

					var	diffX = $this.touchPosX - event.originalEvent.touches[0].pageX,
						diffY = $this.touchPosY - event.originalEvent.touches[0].pageY,
						th = $this.outerHeight(),
						ts = ($this.get(0).scrollHeight - $this.scrollTop());

					// Hide on swipe?
						if (config.hideOnSwipe) {

							var result = false,
								boundary = 20,
								delta = 50;

							switch (config.side) {

								case 'left':
									result = (diffY < boundary && diffY > (-1 * boundary)) && (diffX > delta);
									break;

								case 'right':
									result = (diffY < boundary && diffY > (-1 * boundary)) && (diffX < (-1 * delta));
									break;

								case 'top':
									result = (diffX < boundary && diffX > (-1 * boundary)) && (diffY > delta);
									break;

								case 'bottom':
									result = (diffX < boundary && diffX > (-1 * boundary)) && (diffY < (-1 * delta));
									break;

								default:
									break;

							}

							if (result) {

								$this.touchPosX = null;
								$this.touchPosY = null;
								$this._hide();

								return false;

							}

						}

					// Prevent vertical scrolling past the top or bottom.
						if (($this.scrollTop() < 0 && diffY < 0)
						|| (ts > (th - 2) && ts < (th + 2) && diffY > 0)) {

							event.preventDefault();
							event.stopPropagation();

						}

				});

			// Event: Prevent certain events inside the panel from bubbling.
				$this.on('click touchend touchstart touchmove', function(event) {
					event.stopPropagation();
				});

			// Event: Hide panel if a child anchor tag pointing to its ID is clicked.
				$this.on('click', 'a[href="#' + id + '"]', function(event) {

					event.preventDefault();
					event.stopPropagation();

					config.target.removeClass(config.visibleClass);

				});

		// Body.

			// Event: Hide panel on body click/tap.
				$body.on('click touchend', function(event) {
					$this._hide(event);
				});

			// Event: Toggle.
				$body.on('click', 'a[href="#' + id + '"]', function(event) {

					event.preventDefault();
					event.stopPropagation();

					config.target.toggleClass(config.visibleClass);

				});

		// Window.

			// Event: Hide on ESC.
				if (config.hideOnEscape)
					$window.on('keydown', function(event) {

						if (event.keyCode == 27)
							$this._hide(event);

					});

		return $this;

	};

	/**
	 * Apply "placeholder" attribute polyfill to one or more forms.
	 * @return {jQuery} jQuery object.
	 */
	$.fn.placeholder = function() {

		// Browser natively supports placeholders? Bail.
			if (typeof (document.createElement('input')).placeholder != 'undefined')
				return $(this);

		// No elements?
			if (this.length == 0)
				return $this;

		// Multiple elements?
			if (this.length > 1) {

				for (var i=0; i < this.length; i++)
					$(this[i]).placeholder();

				return $this;

			}

		// Vars.
			var $this = $(this);

		// Text, TextArea.
			$this.find('input[type=text],textarea')
				.each(function() {

					var i = $(this);

					if (i.val() == ''
					||  i.val() == i.attr('placeholder'))
						i
							.addClass('polyfill-placeholder')
							.val(i.attr('placeholder'));

				})
				.on('blur', function() {

					var i = $(this);

					if (i.attr('name').match(/-polyfill-field$/))
						return;

					if (i.val() == '')
						i
							.addClass('polyfill-placeholder')
							.val(i.attr('placeholder'));

				})
				.on('focus', function() {

					var i = $(this);

					if (i.attr('name').match(/-polyfill-field$/))
						return;

					if (i.val() == i.attr('placeholder'))
						i
							.removeClass('polyfill-placeholder')
							.val('');

				});

		// Password.
			$this.find('input[type=password]')
				.each(function() {

					var i = $(this);
					var x = $(
								$('<div>')
									.append(i.clone())
									.remove()
									.html()
									.replace(/type="password"/i, 'type="text"')
									.replace(/type=password/i, 'type=text')
					);

					if (i.attr('id') != '')
						x.attr('id', i.attr('id') + '-polyfill-field');

					if (i.attr('name') != '')
						x.attr('name', i.attr('name') + '-polyfill-field');

					x.addClass('polyfill-placeholder')
						.val(x.attr('placeholder')).insertAfter(i);

					if (i.val() == '')
						i.hide();
					else
						x.hide();

					i
						.on('blur', function(event) {

							event.preventDefault();

							var x = i.parent().find('input[name=' + i.attr('name') + '-polyfill-field]');

							if (i.val() == '') {

								i.hide();
								x.show();

							}

						});

					x
						.on('focus', function(event) {

							event.preventDefault();

							var i = x.parent().find('input[name=' + x.attr('name').replace('-polyfill-field', '') + ']');

							x.hide();

							i
								.show()
								.focus();

						})
						.on('keypress', function(event) {

							event.preventDefault();
							x.val('');

						});

				});

		// Events.
			$this
				.on('submit', function() {

					$this.find('input[type=text],input[type=password],textarea')
						.each(function(event) {

							var i = $(this);

							if (i.attr('name').match(/-polyfill-field$/))
								i.attr('name', '');

							if (i.val() == i.attr('placeholder')) {

								i.removeClass('polyfill-placeholder');
								i.val('');

							}

						});

				})
				.on('reset', function(event) {

					event.preventDefault();

					$this.find('select')
						.val($('option:first').val());

					$this.find('input,textarea')
						.each(function() {

							var i = $(this),
								x;

							i.removeClass('polyfill-placeholder');

							switch (this.type) {

								case 'submit':
								case 'reset':
									break;

								case 'password':
									i.val(i.attr('defaultValue'));

									x = i.parent().find('input[name=' + i.attr('name') + '-polyfill-field]');

									if (i.val() == '') {
										i.hide();
										x.show();
									}
									else {
										i.show();
										x.hide();
									}

									break;

								case 'checkbox':
								case 'radio':
									i.attr('checked', i.attr('defaultValue'));
									break;

								case 'text':
								case 'textarea':
									i.val(i.attr('defaultValue'));

									if (i.val() == '') {
										i.addClass('polyfill-placeholder');
										i.val(i.attr('placeholder'));
									}

									break;

								default:
									i.val(i.attr('defaultValue'));
									break;

							}
						});

				});

		return $this;

	};

	/**
	 * Moves elements to/from the first positions of their respective parents.
	 * @param {jQuery} $elements Elements (or selector) to move.
	 * @param {bool} condition If true, moves elements to the top. Otherwise, moves elements back to their original locations.
	 */
	$.prioritize = function($elements, condition) {

		var key = '__prioritize';

		// Expand $elements if it's not already a jQuery object.
			if (typeof $elements != 'jQuery')
				$elements = $($elements);

		// Step through elements.
			$elements.each(function() {

				var	$e = $(this), $p,
					$parent = $e.parent();

				// No parent? Bail.
					if ($parent.length == 0)
						return;

				// Not moved? Move it.
					if (!$e.data(key)) {

						// Condition is false? Bail.
							if (!condition)
								return;

						// Get placeholder (which will serve as our point of reference for when this element needs to move back).
							$p = $e.prev();

							// Couldn't find anything? Means this element's already at the top, so bail.
								if ($p.length == 0)
									return;

						// Move element to top of parent.
							$e.prependTo($parent);

						// Mark element as moved.
							$e.data(key, $p);

					}

				// Moved already?
					else {

						// Condition is true? Bail.
							if (condition)
								return;

						$p = $e.data(key);

						// Move element back to its original location (using our placeholder).
							$e.insertAfter($p);

						// Unmark element as moved.
							$e.removeData(key);

					}

			});

	};

})(jQuery);