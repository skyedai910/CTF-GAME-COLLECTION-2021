/*
hui 2.3.5
作者 : 深海 5213606@qq.com
官网 : http://hui.hcoder.net/
*/
var hui = (function(selector, undefined){
	var isId = /^#([\w-]+)$/, isClass = /^\.([\w-]+)$/, isTag = /^[\w-]+$/;
	var huibackNum = 0, huiResizeNeedDo = new Array(), huiReSizeTimer = null, huiDeputes = new Array();
	var huibase = function(selector){
		if(!selector){return addFuns(Array(document));}
		if(typeof(selector) == 'string'){selector = selector.trim(); return getDoms(selector);}
		if(typeof(selector) == 'object'){return addFuns(new Array(selector));}
		return null;
	}
	var getDoms = function(selector){
		var selectorArray = selector.split(' ');
		if(selectorArray.length < 2){
			if(isId.test(selector)){
				var dom = document.getElementById(RegExp.$1);
				var doms = new Array(); if(dom){doms[0] = dom;}
				return addFuns(doms);
			}
			if(isClass.test(selector)){
				var doms = document.getElementsByClassName(RegExp.$1);
				return addFuns(doms);
			}
			if(isTag.test(selector)){
				var doms = document.getElementsByTagName(selector);
				return addFuns(doms);
			}
		}else{
			var lastDoms = hui(selectorArray[0]);
			for(var i = 1; i < selectorArray.length; i++){lastDoms = lastDoms.find(selectorArray[i]);}
			return lastDoms;
		}
		return addFuns(null);
	}
	var addFuns = function(doms){
		if(!doms){doms = new Array();}
		if(!doms[0]){doms = new Array();}
		var reObj = {dom:doms, length:doms.length};
		reObj.__proto__ = hcExtends;
		return reObj;
	}
	var hcExtends = {
		val : function(vars){
			if(typeof(vars) != 'undefined'){
				for(var i = 0; i < this.length; i++){this.dom[i].value = vars;}
				return this;
			}
			return this.dom[0].value;
		},
		hasClass : function(cls){
			if(this.length != 1){return false;}
			return this.dom[0].className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
		},
		addClass : function(cls){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){
				if(!this.dom[i].className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'))){this.dom[i].className += " " + cls;}
			}
			return this;
		},
		removeClass : function(cls){
			if(this.length < 1){return this;}
			var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
			for(var i = 0; i < this.length; i++){this.dom[i].className = this.dom[i].className.replace(reg, ' ');}
			return this;
		},
		hide : function(){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){this.dom[i].style.display = 'none';}
			return this;
		},
		show : function(){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){this.dom[i].style.display = 'block';}
			return this;
		},
		each : function(callBack){
			for(var i = 0; i < this.length; i++){this.dom[i].index = i; callBack(this.dom[i]);}
		},
		size : function(){return this.length;},
		html : function(html){
			if(this.length < 1){return this;}
			if(typeof(html) != 'undefined'){for(var i = 0; i < this.length; i++){this.dom[i].innerHTML = html;} return this;}
			return this.dom[0].innerHTML;
		},
		click : function(callBack){
			if(this.length < 1){return;}
			for(var i = 0; i < this.length; i++){
				if(callBack == undefined){hui(this.dom[i]).trigger('click');}
				this.dom[i].addEventListener('click',callBack);
			}
		},
		dblclick : function(callBack){
			if(this.length < 1){return;}
			for(var i = 0; i < this.length; i++){this.dom[i].addEventListener('dblclick',callBack);}
		},
		change : function(callBack){
			if(this.length < 1){return;}
			for(var i = 0; i < this.length; i++){
				this.dom[i].addEventListener('change',callBack);
			}
		},
		on : function(eventType, sonSelector, callBack){
			huiDeputes.push({selector:sonSelector, cb:callBack});
			switch(eventType){
				case 'click':
				document.onclick = function(e){this.ondo(e);}.bind(this);
				break;
				case 'dblclick':
				document.ondblclick = function(e){this.ondo(e);}.bind(this);
				break;
			}
		},
		ondo : function(e){
			if(!e.target){return false;}
			for(var i = 0; i < huiDeputes.length; i++){
				var objs = hui(huiDeputes[i].selector);
				for(var ii = 0; ii < objs.length; ii++){
					if(objs.dom[ii] === e.target){objs.dom[ii].index = ii; huiDeputes[i].cb(objs.dom[ii]); break;}
				}
			}
		},
		longTap : function(callBack){
			if(this.length < 1){return;}
			var timer = null, timerNum = 0, _self = this;
			this.dom[0].addEventListener('longTapDo', callBack);
			this.dom[0].addEventListener('touchstart',function(){
				timer = setInterval(function(){
					if(timerNum >= 1500){
						_self.trigger('longTapDo'); timerNum = 0; clearInterval(timer);
					}else{
						timerNum += 100;
					}
				}, 100);
			});
			this.dom[0].addEventListener('touchend',function(){clearInterval(timer);});
		},
		scroll : function(callBack){
			if(this.length < 1){return;}
			this.dom[0].addEventListener('scroll', callBack);
		},
		touchStartX : 0, touchStartY : 0,
		touchStart  : function(callBack){
			if(this.length != 1){return;} var _self = this;
			this.dom[0].addEventListener('touchstart', function(e){
				_self.touchStartX = Math.round(e.touches[0].clientX);
				_self.touchStartY = Math.round(e.touches[0].clientY);
				if(callBack){callBack({x:_self.touchStartX, y:_self.touchStartY});}
			});
		},
		touchMove : function(callBack){
			if(this.length != 1){return;} this.touchStart(); var _self = this;
			this.dom[0].addEventListener('touchmove', function(e){
				if(callBack){
					callBack({x: Math.round(e.changedTouches[0].pageX - _self.touchStartX), y:Math.round(e.changedTouches[0].pageY - _self.touchStartY)});
				}
			});
		},
		touchEnd : function(callBack){
			if(this.length != 1){return;} this.touchMove(); var _self = this;
			this.dom[0].addEventListener('touchend', function(e){
				if(callBack){
					callBack({x: Math.round(e.changedTouches[0].pageX - _self.touchStartX), y:Math.round(e.changedTouches[0].pageY - _self.touchStartY)});
				}
			});
		},
		swipe : function(callBack){
			if(this.length != 1){return;} this.touchMove(); var _self = this;
			this.dom[0].addEventListener('touchend', function(e){
				var x = Math.round(e.changedTouches[0].pageX - _self.touchStartX), y = Math.round(e.changedTouches[0].pageY - _self.touchStartY);
				var absX = Math.abs(x), absY = Math.abs(y);
				if(absX > absY){
					if(x > 50){callBack('right');}else if(x < -50){callBack('left');}
				}else{
					if(y > 50){callBack('down');}else if(y < -50){callBack('up');}
				}
			});
		},
		trigger : function(eventType, eventData){
			var element = this.dom[0];
			element.dispatchEvent(new CustomEvent(eventType,{detail:eventData,bubbles:true, cancelable:true}));
		},
		switchBox : function(butNames, callBack){
			if(!butNames){butNames = ['Off', 'On'];}
			this.dom[0].onclick = function(){
				var thisObj = hui(this);
				var status = thisObj.hasClass('hui-switch-on');
				var span = thisObj.dom[0].getElementsByTagName('span');
				if(status){
					thisObj.removeClass('hui-switcn-on');
					span[0].innerHTML = butNames[0]; thisObj.removeClass('hui-switch-on');
					if(callBack){callBack(false);}
					return;
				}
				thisObj.addClass('hui-switch-on'); span[0].innerHTML = butNames[1];
				thisObj.addClass('hui-switch-on');
				if(callBack){callBack(true);}
			}
		},
		getSwitchVal : function(){
			if(this.hasClass('hui-switch-on')){return true;}
			return false;
		},
		progressBar : function(val){this.find('span').first().css({width:val+'%'});},
		find : function(selector){
			if(this.length < 1){return this;}
			if(this.length < 2){
				if(isId.test(selector)){
					var dom  = document.getElementById(RegExp.$1);
					var doms = new Array();
					if(dom){doms[0] = dom;}
					return addFuns(doms);
				}
				if(isClass.test(selector)){
					var doms = this.dom[0].getElementsByClassName(RegExp.$1);
					return addFuns(doms);
				}
				if(isTag.test(selector)){
					var doms = this.dom[0].getElementsByTagName(selector);
					return addFuns(doms);
				}
			}else{
				var selectedDoms = new Array();
				for(var i = 0; i < this.length; i++){
					if(isId.test(selector)){
						var dom  = document.getElementById(RegExp.$1);
						selectedDoms.push(dom);
					}
					if(isClass.test(selector)){
						var doms = this.dom[i].getElementsByClassName(RegExp.$1);
						for(var ii = 0; ii < doms.length; ii++){selectedDoms.push(doms[ii]);}
					}
					if(isTag.test(selector)){
						var doms = this.dom[i].getElementsByTagName(selector);
						for(var ii = 0; ii < doms.length; ii++){selectedDoms.push(doms[ii]);}
					}
				}
				return addFuns(selectedDoms);
			}
		},
		eq : function(index){return addFuns(new Array(this.dom[index]));},
		last : function(){return addFuns(new Array(this.dom[this.length - 1]));},
		first : function(){return addFuns(new Array(this.dom[0]));},
		next : function(){return addFuns(new Array(this.dom[0].nextElementSibling || this.dom[0].nextSibling));},
		parent : function(){return addFuns(new Array(this.dom[0].parentNode));},
		siblings : function(){
			if(!this.dom[0]){return addFuns();}
			var nodes=[], startNode = this.dom[0], nextNode, preNode;
			var currentNode = startNode;
			while(nextNode = currentNode.nextElementSibling){nodes.push(nextNode); currentNode = nextNode;}
			currentNode = startNode;
			while(preNode = currentNode.previousElementSibling){nodes.push(preNode); currentNode = preNode;}
			return addFuns(nodes);
		},
		even : function(){
			if(this.length < 1){return addFuns();}
			var doms = new Array();
			for(var i = 0; i < this.length; i++){if(i % 2 == 0){doms.push(this.dom[i]);}}
			return addFuns(doms);
		},
		odd : function(){
			if(this.length < 1){return addFuns();}
			var doms = new Array();
			for(var i = 0; i < this.length; i++){if(i % 2 == 1){doms.push(this.dom[i]);}}
			return addFuns(doms);
		},
		index : function(){
			if(this.length != 1){return null;}
			var nodes=[], startNode = this.dom[0],  preNode;
			while(preNode = startNode.previousElementSibling){nodes.push(preNode); startNode = preNode;}
			return nodes.length;
		},
		css : function(cssObj){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){var styleObj = this.dom[i].style; for(var k in cssObj){eval('styleObj.'+k+' = "'+cssObj[k]+'";');}} return this;
		},
		clone : function(){
			if(this.length < 1){return this;}
			var nodeClone = this.dom[0].cloneNode(true); 
			return addFuns(new Array(nodeClone));
		},
		appendTo : function(parentObj){
			if(this.length < 1){return this;}
			if(typeof(parentObj) == 'object'){
				parentObj.dom[0].appendChild(this.dom[0]);
			}else if(typeof(parentObj) == 'string'){
				var parentDom = hui(parentObj);
				if(parentDom.length >= 1){parentDom.dom[0].appendChild(this.dom[0]);}
			}
		},
		prependTo : function(parentObj){
			if(this.length < 1){return this;}
			if(typeof(parentObj) == 'object'){parentObj.dom[0].insertBefore(this.dom[0], parentObj.dom[0].firstChild);}
			else if(typeof(parentObj) == 'string'){
				var parentDom = hui(parentObj); if(parentDom.length >= 1){parentDom.dom[0].insertBefore(this.dom[0], parentDom.dom[0].firstChild);}
			}
		},
		animate : function(animateObj, timer, callBack){
			if(this.length != 1){return this;} if(!timer){timer = 300;}
			var interVal = null, styleObj = this.dom[0].style, i = 0, start = {};
			if(this.dom[0].getAttribute('isAnimate')){return false;}
			this.dom[0].setAttribute('isAnimate', 'Yes');
			var thisObj = this, styleVal = 0;
			for(var k in animateObj){
				if(k.indexOf('scroll') != -1){
					eval('styleVal = thisObj.dom[0].'+k);
					eval('start.'+k+' = Number(styleVal);');
				}else{
					eval('styleVal = styleObj.'+k);
					if(!styleVal){
						styleVal = 0;
					}else{
						styleVal = styleVal.toLowerCase();
						styleVal = styleVal.replace(/px|%/,'');
					}
					eval('start.'+k+' = Number(styleVal);');
				}
			}
			interVal = setInterval(function(){
				for(var k in animateObj){
					eval('var startVal = start.'+k+';');
					var endVal = animateObj[k];
					if(k.indexOf('scroll') != -1){
						if(startVal!= endVal){eval('thisObj.dom[0].'+k+' = "'+(startVal + (endVal - startVal)* i / timer)+'";');}
					}else{
						endVal = endVal.toString();
						if(endVal.indexOf('px') != -1){
							endVal = Number(endVal.replace('px',''));
							if(startVal != animateObj[k]){eval('styleObj.'+k+' = "'+(startVal + (endVal - startVal)* i / timer)+'px";');}
						}else if(endVal.indexOf('%') != -1){
							endVal = Number(endVal.replace('%',''));
							if(startVal != animateObj[k]){eval('styleObj.'+k+' = "'+(startVal + (endVal - startVal)* i / timer)+'%";');}
						}else{
							if(startVal != animateObj[k]){eval('styleObj.'+k+' = "'+(startVal + (endVal - startVal)* i / timer)+'";');}
						}
					}
				}
				if(i >= timer){clearInterval(interVal); thisObj.dom[0].removeAttribute('isAnimate'); if(callBack){callBack();}}; i += 20;
			}, 20);
		},
		remove : function(){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){
				this.dom[0].parentNode.removeChild(this.dom[0]);
			}
		},
		attr : function(attrName, val){
			if(this.length < 1){return this;}
			if(typeof(val) != 'undefined'){
				for(var i = 0; i < this.length; i++){
					this.dom[i].setAttribute(attrName, val);
				}
				return this;
			}
			return this.dom[0].getAttribute(attrName);
		},
		Attr : function(attrName, val){this.attr(attrName, val);},
		removeAttr : function(attrName){
			if(this.length < 1){return this;}
			for(var i = 0; i < this.length; i++){
				this.dom[i].removeAttribute(attrName);
			}
			return this;
		},
		height : function(isOffset){
			if(this.length != 1){return 0;}
			if(isOffset){return this.dom[0].offsetHeight;}
			return this.dom[0].clientHeight;
		},
		width : function(isOffset){
			if(this.length != 1){return 0;}
			if(isOffset){return this.dom[0].offsetWidth;}
			return this.dom[0].clientWidth;
		},
		loadingButton : function(loadingText, isIcon){
			if(!loadingText){loadingText = 'Loading...';} if(!isIcon){isIcon = true;}
			this.attr('HUI_BTN_RESET', this.html());
			var loadingHtml = '<div class="hui-loading-wrap"><div class="hui-loading" style="margin:8px 0px 0px 0px;"></div><div class="hui-loading-text">'+loadingText+'</div></div>';
			this.html(loadingHtml);
		},
		resetLoadingButton : function(){this.html(this.attr('HUI_BTN_RESET')); this.removeAttr('HUI_BTN_RESET');},
		buttonIsLoading : function(){if(this.attr('HUI_BTN_RESET')){return true;} return false;},
		ranging : function(callBack){this.dom[0].oninput = function(){callBack(this.value);}; this.dom.onchange = function(){callBack(this.value);}},
		offset : function(){if(this.length != 1){return {left:0, top:0};} return huibase.offset(this.dom[0]);},
		isShow : function(){
			if(this.length != 1){return true;}
			if(this.dom[0].currentStyle){var showRes = this.dom[0].currentStyle.display;}else{var showRes = getComputedStyle(this.dom[0], null).display;}
			if(showRes == 'none'){return false;} return true;
		},
		pointMsg : function(msg, color, size, top, right, isRelative){
			if(this.length < 1){return false;} if(!isRelative){isRelative = true;}
			if(isRelative){this.dom[0].style.position = 'relative';}
			if(!msg){
				if(!color){color = '#ED2D22';} if(!size){size = '8px';} if(!top){top = '0px';} if(!right){right = '8px';}
				var HUI_RedPoint = this.find('.hui-point-msg'); if(HUI_RedPoint.length >= 1){return;}
				HUI_RedPoint = document.createElement('div'); HUI_RedPoint.className = 'hui-point-msg';
				HUI_RedPoint.style.width = size; HUI_RedPoint.style.height = size;
				HUI_RedPoint.style.background = color; HUI_RedPoint.style.top = top;
				HUI_RedPoint.style.right = right; hui(HUI_RedPoint).appendTo(this);
				return;
			}
			var HUI_RedPoint = this.find('.hui-number-point');
			if(!HUI_RedPoint.length){
				if(!color){color = '#ED2D22';} if(!size){size = '8px';} if(!top){top = '0px';} if(!right){right = '5px';}
				HUI_RedPoint = document.createElement('div'); HUI_RedPoint.className = 'hui-number-point';
				HUI_RedPoint.style.fontSize = size; HUI_RedPoint.style.background = color; HUI_RedPoint.style.top = top;
				if(typeof(msg) == 'number'){
					if(msg <= 99){
						hui(HUI_RedPoint).css({borderRadius:'50%', fontSize:'12px', lineHeight:'12px', width:'12px', height:'12px'});
					}else{
						HUI_RedPoint.style.borderRadius = '5px';
						HUI_RedPoint.style.padding = '1px 3px';
					}
				}else{
					HUI_RedPoint.style.borderRadius = '5px';
					HUI_RedPoint.style.padding = '1px 3px';
				}
				HUI_RedPoint.style.right = right;
				HUI_RedPoint.innerHTML = msg;
				hui(HUI_RedPoint).appendTo(this);
			}else{
				if(typeof(msg) == 'number'){
					if(msg <= 99){
						HUI_RedPoint.css({borderRadius:'50%', fontSize:'12px', lineHeight:'12px', width:'12px', padding:'2px', height:'12px'});
					}else{
						HUI_RedPoint.css({'borderRadius':'3px', padding:'1px 3px', fontSize:'10px'});
					}
				}else{
					HUI_RedPoint.css({borderRadius:'5px', padding:'1px 3px'});
				}
				HUI_RedPoint.html(msg);
			}
		},
		removePointMsg : function(){
			if(this.length < 1){return false;}
			var HUI_RedPoint = this.find('.hui-point-msg'); 
			if(HUI_RedPoint.length >= 1){HUI_RedPoint.remove();}
			var HUI_NumPoint = this.find('.hui-number-point'); 
			if(HUI_NumPoint.length >= 1){HUI_NumPoint.remove();}
		},
		scrollX : function(num, sonsTag, extraValue){
			if(this.length < 1){return} if(!num){num = 3;} if(!sonsTag){sonsTag = 'img';} if(!extraValue){extraValue = 0;}
			var setWitdh = hui(this.dom[0]).width() / num;
			for(var i = 0; i < this.length; i++){
				var cObj = hui(this.dom[i]), sons = cObj.find(sonsTag), total = sons.length;
				sons.css({'width':(setWitdh+extraValue)+'px', 'float':'left'});
				cObj.find('div').eq(0).css({width : (setWitdh * total) + 'px'});
				cObj.css({'overflowX' : 'auto'});
			}
		},
		scrollY : function(height){
			if(this.length < 1){return} if(!height){height = 150;}
			for(var i = 0; i < this.length; i++){
				var cObj = hui(this.dom[i]);
				hui(this.dom[i]).css({height:height+'px', 'overflowY':'auto'});
			}
		},
		unfold : function(height, text){
			if(this.length < 1){return} if(!height){height = 550;} if(!text){text = '展开全文';}
			this.css({height:height+'px'});
			var buttonDom = document.createElement('div');
			buttonDom.setAttribute('id', 'hui-unfold');
			buttonDom.innerHTML = '<span class="hui-icons hui-icons-down2"></span>' + text;
			hui(buttonDom).appendTo(this);
			hui('#hui-unfold').click(function(){
				hui(this).parent().css({height:'auto'});
				hui(this).remove();
			});
		}
	};
	huibase.readyRe = /complete|loaded|interactive/;
	huibase.ready = function(callBack){
		if(document.addEventListener){
			document.addEventListener('DOMContentLoaded', function(){
				document.body.addEventListener('touchstart', function (){});
				huibase.readyBase(callBack);
			});
		}else if(document.attachEvent){
			document.attachEvent("onreadystatechange", function(){
				if(huibase.readyRe.test(document.readyState)){
					document.body.addEventListener('touchstart', function (){});
					huibase.readyBase(callBack);
				}
			});
		}
	};
	huibase.readyBase = function(callBack){
		var backBtn = document.getElementById('hui-back');
		if(backBtn){backBtn.onclick = huibase.Back;} if(callBack){callBack();}
	};
	huibase.plusReady = function(callBack){
		document.addEventListener('plusready', function(){if(callBack){callBack();}});
	};
	huibase.ajax = function(sets){
		if(!sets){sets = {url:null};}
		if(!sets.url){return ;}
		var async = 'async' in sets ? sets.async : true;
		sets.type = 'type' in sets ? sets.type.toUpperCase() : 'GET';
		sets.backType = 'backType' in sets ? sets.backType.toUpperCase() : 'HTML';
		sets.beforeSend = 'beforeSend' in sets ? sets.beforeSend : null;
		sets.complete = 'complete' in sets ? sets.complete : null;
		sets.success = 'success' in sets ? sets.success : function(){};
		sets.error = 'error' in sets ? sets.error : function(){};
		var xhr = new window.XMLHttpRequest();
		if(typeof(xhr) == 'undefined'){if(sets.error){sets.error('无法加载XMLHttpRequest模块！');} return;}
		xhr.timeout = 'timeout' in sets ? sets.timeout : 0;
		if(sets.beforeSend){sets.beforeSend();}
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4){
				if(sets.complete){sets.complete();}
				if(xhr.status == 200){
					if(sets.backType == 'HTML'){
						sets.success(xhr.responseText);
					}else if(sets.backType == 'JSON'){
						sets.success(JSON.parse(xhr.responseText));
					}
				}
			}
		}
		xhr.ontimeout = function(){if(sets.error){sets.error('请求超时');}}
		if(sets.error){xhr.onerror = function(e){sets.error('请求失败');}}
		xhr.open(sets.type, sets.url, async);
		if(sets.type == 'POST'){
			var pd = '';
			for(var k in sets.data){pd += encodeURIComponent(k)+'='+encodeURIComponent(sets.data[k])+'&';}
			pd = pd.substr(0, pd.length - 1);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send(pd);
		}else{
			xhr.send();
		}
	};
	huibase.get = function(url, success, err){
		var sets = {url:url, type:'GET', backType:'HTML', success:success, error:err};
		this.ajax(sets);
	};
	huibase.getJSON = function(url, success, err){
		var sets = {url:url, type:'GET', backType:'JSON', success:success, error:err};
		this.ajax(sets);
	};
	huibase.post = function(url, pd ,success, err){
		var sets = {url:url, type:'POST',backType:'HTML', data:pd, success:success, error:err};
		this.ajax(sets);
	};
	huibase.postJSON = function(url, pd ,success, err){
		var sets = {url:url, type:'POST',backType:'JSON', data:pd, success:success, error:err};
		this.ajax(sets);
	};
	huibase.getItem = function(keyName){return plus.storage.getItem(keyName);};
	huibase.setItem = function(keyName, val){plus.storage.setItem(keyName, val);};
	huibase.removeItem = function(keyName){return plus.storage.removeItem(keyName);};
	huibase.open = function(winName, styles, isClose, extras){
		if(!window.plus){location.href = winName; return ;}
		if(!styles){styles= {};}
		var w = this.create(winName, styles, isClose, extras); plus.webview.show(w, 'slide-in-right'); return w;
	};
	huibase.create = function(winName, styles, isClose, extras){
		if(!isClose){isClose = false;} if(typeof(styles) == "undefined"){styles = {popGesture:"none"};}
		if(!styles.popGesture){styles.popGesture = 'none';} if(typeof(extras) == "undefined"){extras = {};}
		if(!styles.zindex){styles.zindex = 10;} extras.HuiIsClose = isClose;
		var w = plus.webview.getWebviewById(winName); if(w){return w;}
		w = plus.webview.create(winName, winName, styles, extras); return w;
	};
	huibase.subpages = function(subpages){
		var currentView = plus.webview.currentWebview();
		for(var i = 0; i < subpages.length; i++){
			var subView = this.create(subpages[i][0], subpages[i][1]);
			currentView.append(subView);
		}
	};
	huibase.drag    = function(prevView, nextView, callBack){
		var currentView = plus.webview.currentWebview();
		if(nextView){
			var _next = hui.getView(nextView.pageId);
			currentView.drag(
				{direction : "left", moveMode: "followFinger"},
                {view  :　_next, moveMode : "follow"},
                function(e){if(e.type == 'end' && e.result){if(nextView.callBack){nextView.callBack();}}}
			);
		}
		if(prevView){
			var _prev = hui.getView(prevView.pageId);
			currentView.drag(
				{direction : "right", moveMode: "followFinger"},
                {view  :　_prev, moveMode : "follow"},
                function(e){if(e.type == 'end' && e.result){if(prevView.callBack){prevView.callBack();}}}
			);
		}
	};
	huibase.Back = function(){
		if(!window.plus){history.back(); return ;}
		if(hui.BackDo){var res = hui.BackDo(); if(!res){return;}}
		var selfW = plus.webview.currentWebview();
		if(selfW.id == plus.runtime.appid || selfW.id == 'HBuilder'){
    		if(huibackNum < 1){
    			hui.toast('再按一次退出程序');
    			huibackNum++;
    			setTimeout(function(){huibackNum = 0;},3000);
    		}else{selfW.close();}
		}else{
			if(selfW.HuiIsClose){
				if(selfW.HuiIsClose == 'no'){return;}
				selfW.close('slide-out-right');
			}else{
				selfW.hide('slide-out-right');
			}
		}
	};
	huibase.back  = huibase.Back;
	huibase.close = function(vId){var w = plus.webview.getWebviewById(vId); if(w){w.close();}};
	huibase.listViews = function(){return plus.webview.all();};
	huibase.getView = function(vId){return plus.webview.getWebviewById(vId);};
	huibase.getCView = function(){return plus.webview.currentWebview();};
	huibase.winInfo = function(){
		var winInfo = {height:0, width:0, scrollTop:0};
		if(window.innerHeight){
			winInfo.height = window.innerHeight;
		}else if((document.body)&&(document.body.clientHeight)){
			winInfo.height = document.body.clientHeight;
		}
		if(window.innerWidth){
			winInfo.width = window.innerWidth;
		}else if((document.body)&&(document.body.clientWidth)){
			winInfo.width = document.body.clientWidth;
		}
		if(document.documentElement && document.documentElement.scrollTop){
			winInfo.scrollTop = document.documentElement.scrollTop;
		}else if(document.body){
			winInfo.scrollTop = document.body.scrollTop;
		}
		return winInfo;
	};
	huibase.offset = function(e){
		var offset  = {left:0, top:0}; offset.left = e.offsetLeft; offset.top  = e.offsetTop;
		while(e = e.offsetParent){offset.top += e.offsetTop; offset.left += e.offsetLeft;} return offset;
	};
	huibase.maskShow = function(){
		huibase.mask = document.getElementById('hui-mask');
		if(!huibase.mask){
			huibase.mask = document.createElement('div');
			huibase.mask.setAttribute('id', 'hui-mask');
			document.body.appendChild(huibase.mask);
		}
	};
	huibase.maskHide = function(){if(huibase.mask){document.body.removeChild(huibase.mask);}};
	huibase.maskTap  = function(callBack){huibase.mask.addEventListener('click', callBack);};
	huibase.loading = function(msg, isClose){
		if(msg){var loadingText = '<div id="hui-loading-text">'+msg+'</div>';}else{var loadingText = '';}
		var HUI_LoadingMask = document.getElementById('hui-transparent-mask');
		if(isClose){if(HUI_LoadingMask){HUI_LoadingMask.parentNode.removeChild(HUI_LoadingMask);} return false;}
		if(!HUI_LoadingMask){
			var HUI_LoadingMask = document.createElement('div');
			HUI_LoadingMask.setAttribute('id', 'hui-transparent-mask');
			HUI_LoadingMask.innerHTML = '<div id="hui-loading"><div id="hui-loading-in"><div></div><div></div><div></div><div></div><div></div></div>'+loadingText+'</div>';
			document.body.appendChild(HUI_LoadingMask);
		}
	};
	huibase.closeLoading = function(){
		var HUI_LoadingMask = document.getElementById('hui-transparent-mask');
		if(HUI_LoadingMask){HUI_LoadingMask.parentNode.removeChild(HUI_LoadingMask);}
	};
	huibase.h5Loading = function(isClose, title, options){
		if(isClose){plus.nativeUI.closeWaiting(); return ;}
		if(!title){title = ''}; if(!options){options = {};}
		plus.nativeUI.showWaiting(title, options);
	}
	
	huibase.scrollTop = function(val){document.body.scrollTop = val;};
	huibase.numberBox = function(){
		var numberBoxes =  document.getElementsByClassName('hui-number-box');
		if(!numberBoxes){return;}
		for(var i = 0; i < numberBoxes.length; i++){
			var numberBox = numberBoxes[i], numberBoxL = numberBox.getElementsByClassName('reduce')[0];
			var numberBoxR = numberBox.getElementsByClassName('add')[0];
			numberBoxL.onclick = function(){
				var min = Number(this.parentNode.getAttribute('min'));
				var max = Number(this.parentNode.getAttribute('max'));
				var numberIn  = this.parentNode.getElementsByTagName('input')[0];
				var cNum = Number(numberIn.value);
				if(!cNum || cNum == NaN){cNum = min;} cNum -= 1;
				if(cNum < min){cNum = min;} numberIn.value = cNum;
				hui(numberIn).trigger('change');
			}
			numberBoxR.onclick = function(){
				var min = Number(this.parentNode.getAttribute('min'));
				var max = Number(this.parentNode.getAttribute('max'));
				var numberIn  = this.parentNode.getElementsByTagName('input')[0];
				var cNum = Number(numberIn.value);
				if(!cNum || cNum == NaN){cNum = min;}
				var cNum = Number(numberIn.value);
				if(!cNum || cNum == NaN){cNum = min;} cNum += 1;
				if(cNum > max){cNum = max;} numberIn.value = cNum;
				hui(numberIn).trigger('change');
			}
		}
	};
	huibase.lazyLoad = function(className){
		huibase.timerForLazy = null;
		window.addEventListener('scroll', function(){
			clearTimeout(huibase.timerForLazy);
			huibase.timerForLazy = setTimeout(function(){huibase.lazyLoadNow(className)}, 200);
		});
		hui(window).trigger('scroll');
	};
	huibase.lazyLoadNow = function(className){
		if(!className){className = 'hui-lazy';}
		var winInfo = hui.winInfo(), imgs = new Array(), lazyObj = hui('.'+className);
		for(var i = 0; i < lazyObj.length; i++){
			var dom = lazyObj.dom[0], realSrc = dom.getAttribute('lazySrc');
			var setsY = hui.offset(dom);
			if(setsY.top >=  winInfo.height + winInfo.scrollTop){break;}
			dom.src = realSrc;
			hui(dom).removeClass(className);
		}
	};
	huibase.toast = function(msg, timer){
		if(timer == undefined){timer = 'short';}
		if(typeof(plus) != 'undefined'){plus.nativeUI.toast(msg, {duration:timer}); return;}
		var toast = hui('#hui-toast');
		if(toast.length > 0){toast.remove();}
		var div = document.createElement('div');
		div.setAttribute('id','hui-toast');
		div.setAttribute('class', 'hui-fade-in');
		document.body.appendChild(div);
		toast = hui('#hui-toast');
		toast.html('<div id="hui-toast-msg">'+msg+'</div>');
		if(huibase.ToastTimer){clearTimeout(huibase.ToastTimer);}
		if(timer == 'short'){timer = 2000;}else{timer = 3500;}
		huibase.ToastTimer = setTimeout(function(){toast.remove();}, timer);
	};
	huibase.iconToast = function(msg, icon){
		if(icon == undefined){icon = 'success';}
		var iconToast = hui('#hui-icon-toast');
		if(iconToast.length < 1){
			var div = document.createElement('div');
			div.setAttribute('id','hui-icon-toast');
			div.innerHTML = '<div class="hui-icons"></div><div class="hui-text-center"></div>';
			document.body.appendChild(div);
			iconToast = hui('#hui-icon-toast');
		}else{
			return false;
		}
		iconToast.find('div').eq(0).addClass('hui-icons-'+icon);
		iconToast.find('div').eq(1).html(msg);
		setTimeout(function(){iconToast.remove();}, 3000);
	};
	huibase.ToastTimer = null;
	huibase.upToast = function(msg){
		var toast = hui('#hui-up-toast');
		if(toast.length > 0){toast.remove();}
		var div = document.createElement('div');
		div.setAttribute('id','hui-up-toast');
		document.body.appendChild(div);
		toast = hui('#hui-up-toast');
		toast.html(msg);
		if(huibase.ToastTimer){clearTimeout(huibase.ToastTimer);}
		huibase.ToastTimer = setTimeout(function(){toast.remove();}, 2500);
	};
	huibase.ToastTimer = null;
	huibase.upAllToast = function(msg){
		var toast = hui('#hui-up-all-toast');
		if(toast.length > 0){toast.remove();}
		var div = document.createElement('div');
		div.setAttribute('id','hui-up-all-toast');
		document.body.appendChild(div);
		toast = hui('#hui-up-all-toast');
		toast.html(msg);
		if(huibase.ToastTimer){clearTimeout(huibase.ToastTimer);}
		huibase.ToastTimer = setTimeout(function(){toast.remove();}, 6000);
	};
	huibase.dialogBase  = function(){
		hui.dialogDom = document.getElementById('hui-dialog');
		if(hui.dialogDom){document.body.removeChild(hui.dialogDom);}
		hui.dialogDom = document.createElement('div');
		hui.dialogDom.setAttribute('id', 'hui-dialog');
		hui.dialogDom.setAttribute('class', 'hui-fade-in');
		document.body.appendChild(hui.dialogDom);
		hui.maskShow();
		/* hui.mask.removeEventListener('click', hui.dialogClose);
		 * hui.mask.addEventListener('click',hui.dialogClose); */
	};
	huibase.dialogClose = function(){document.body.removeChild(hui.dialogDom); hui.maskHide();};
	huibase.dialogCallBack = null;
	huibase.alert = function(msg, btnName, callBack){
		hui.dialogCallBack = callBack;
		if(!btnName){btnName = '确定';}
		hui.dialogBase();
		hui.dialogDom.innerHTML = '<div id="hui-dialog-in"><div id="hui-dialog-msg">'+msg+'</div><div id="hui-dialog-btn-line">'+btnName+'</div></div>';
		var btn = document.getElementById('hui-dialog-btn-line');
		btn.onclick = function(){hui.dialogClose(); if(hui.dialogCallBack){hui.dialogCallBack();}}
	};
	huibase.confirm = function(msg, btnName, callBack, callBack2){
		if(!btnName){btnName = ['取消','确定'];}
		hui.dialogBase();
		hui.dialogDom.innerHTML = '<div id="hui-dialog-in"><div id="hui-dialog-msg">'+msg+'</div><div id="hui-dialog-btn-line"><div>'+btnName[0]+'</div><div>'+btnName[1]+'</div></div></div>';
		var btns = document.getElementById('hui-dialog-btn-line').getElementsByTagName('div');
		btns[0].onclick = function(){hui.dialogClose(); if(callBack2){callBack2();}};
		btns[1].onclick = function(){hui.dialogClose(); if(callBack){callBack();}};
	};
	huibase.prompt = function(msg, btnName, callBack, placeholder){
		if(!btnName){btnName = ['取消','确定'];}
		if(!placeholder){placeholder = '';}
		hui.dialogBase();
		hui.dialogDom.innerHTML = '<div id="hui-dialog-in" style="width:300px;"><div id="hui-dialog-msg" style="padding-bottom:12px;">'+msg+'</div><div id="hui-dialog-input-in"><input type="text" id="hui-dialog-input" placeholder="'+placeholder+'" /></div><div style="height:15px;"></div><div id="hui-dialog-btn-line"><div>'+btnName[0]+'</div><div>'+btnName[1]+'</div></div></div>';
		var btns = document.getElementById('hui-dialog-btn-line').getElementsByTagName('div');
		btns[0].onclick = hui.dialogClose;
		btns[1].onclick = function(){
			if(callBack){callBack(document.getElementById("hui-dialog-input").value);}
			hui.dialogClose();
		};
	};
	/* actionSheet */
	huibase.actionSheet = function(menus, cancel, callBack){
		hui.maskShow();
		var huiActionSheet = document.getElementById('hui-action-sheet');
		if(!huiActionSheet){
			var huiActionSheet = document.createElement('div');
			huiActionSheet.setAttribute('id', 'hui-action-sheet');
			document.body.appendChild(huiActionSheet);
			huiActionSheet = document.getElementById('hui-action-sheet');
		}
		var actionSheets = '<ul>';
		for(var i = 0; i < menus.length; i++){actionSheets += '<li huiASId="'+i+'">'+meuns[i]+'</li>';}
		huiActionSheet.innerHTML = actionSheets + '<li id="hui-action-sheet-cancel" huiASId="-1">'+cancel+'</li></ul>';
		hui.mask.removeEventListener('click', hui.actionSheetClose);
		hui.mask.addEventListener('click',hui.actionSheetClose);
		hui(huiActionSheet).find('li').click(function(){
			this.index = this.getAttribute('huiASId'); callBack(this); hui.actionSheetClose();
		});
	};
	huibase.actionSheetClose = function(){
		hui.maskHide();
		var huiActionSheet = document.getElementById('hui-action-sheet');
		if(huiActionSheet){document.body.removeChild(huiActionSheet);}
	}
	huibase.extend  = function(funName, fun){eval('hcExtends.'+funName+' = fun;');};
	huibase.resize  = function(callBack){huiResizeNeedDo.push(callBack);};
	huibase.onScroll = function(callBack){
		window.addEventListener('scroll', function(e){
			var e = e || window.event;
			var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			callBack(scrollTop);
		});
	};
	huibase.createDom = function(domTag){return document.createElement(domTag);};
	huibase.immersedStatusbar = function(){
		hui.plusReady(function(){
			var isImmersedStatusbar = plus.navigator.isImmersedStatusbar();
			if(isImmersedStatusbar){
				var StatusbarHeight = plus.navigator.getStatusbarHeight();
				hui('.hui-header').eq(0).css({'paddingTop':StatusbarHeight + 'px'});
				hui('#hui-back').css({top:StatusbarHeight+'px'});
				hui('#hui-header-menu').css({top:StatusbarHeight+'px'});
				hui('.hui-wrap').eq(0).css({'paddingTop':(StatusbarHeight+44)+'px'});
			}
		});
	}
	window.onresize = function(){
		clearTimeout(huiReSizeTimer);
		if(huiResizeNeedDo.length < 1){return false;}
		huiReSizeTimer = setTimeout(function(){for(var i = 0; i < huiResizeNeedDo.length; i++){var fun = huiResizeNeedDo[i]; fun();}}, 100);
	};
	document.addEventListener('plusready', function(){
		plus.key.removeEventListener('backbutton',huibase.Back);
		plus.key.addEventListener("backbutton",huibase.Back);
	});
	return huibase;
})(document);
Array.prototype.shuffle = function(){this.sort(function(){return Math.random() - 0.5;});};
function huiLog(data){console.log(data);}
function huiJsonLog(data){console.log(JSON.stringify(data));}
(function(){
	if(typeof(window.CustomEvent) === 'undefined'){
		function CustomEvent(event, params){params = params || {bubbles: false, cancelable:false, detail:undefined};
		var evt = document.createEvent('Events');
		var bubbles = true;
		for (var name in params){(name === 'bubbles') ? (bubbles = !!params[name]) : (evt[name] = params[name]);}
		evt.initEvent(event, bubbles, true); return evt;};
		CustomEvent.prototype = window.Event.prototype; 
		window.CustomEvent = CustomEvent;
	}
})();
hui.ready();