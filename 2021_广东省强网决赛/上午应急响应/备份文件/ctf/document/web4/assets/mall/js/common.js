/**
 * 全局JS
 */


/** 显示加载状态 */
function showLoading() {
	loading();
}

/** 隐藏加载状态 */
function hideLoading() {
	$("#top_loading").remove();
}

/** 加载中 */
function loading() {
	var winH = $(window).height();
	var winW = $(window).width();
	
	var styleStr = 'position: fixed;' 
		+ 'left: 0;' 
		+ 'top: 0;' 
		+ 'width: '+winW+'px;' 
		+ 'height: '+winH+'px;' 
		+ 'z-index: 98765;' 
		+ 'background-image: url(\'assets/mall/images/loading.gif\');' 
		+ 'background-position: center;' 
		+ 'background-repeat: no-repeat;' 
//		+ 'background-color: #FFFFFF;' 
		+ 'filter: alpha(opacity=50);' 
		+ '-moz-opacity: 0.5;' 
		+ '-khtml-opacity: 0.5;' 
		+ 'opacity: 0.5;';
	
	$("body").append('<div id="top_loading" style="' + styleStr + '"></div>');
}

/** 获取事件 */
function getEvent() {
	if(window.event) {
		return window.event;
	}
	
	var func = getEvent.caller;
	while(func != null) {
		var arg0 = func.arguments[0];
		if(arg0) {
			if((arg0.constructor == Event || arg0.constructor == MouseEvent
					|| arg0.constructor==KeyboardEvent)
					|| (typeof(arg0) == "object" && arg0.preventDefault
					&& arg0.stopPropagation)) {
				return arg0;
			}
		}
		func=func.caller;
	}
	return null;
}

/** 阻止事件冒泡 */
function stopBubble() {
	var e = getEvent();
	if(window.event) {
		e.cancelBubble=true;//阻止冒泡
	}else if(e.preventDefault) {
		e.stopPropagation();//阻止冒泡
	}
}

/** 鼠标坐标 */
function mouseCoords(ev) {
	if(ev && (ev.pageX || ev.pageY)) {
		return {x:ev.pageX, y:ev.pageY};
	}
	return {
		x:ev.clientX + document.body.scrollLeft - document.body.clientLeft, 
		y:ev.clientY + document.body.scrollTop - document.body.clientTop
	};
}

/**
 * 部分替换
 * @param str 字符串
 * @param replacement 替换为
 * @param start 替换开始位置
 * @param len 替换长度
 */
function substr_replace(str, replacement, start, len) {
	if(str == null || str == "") {
		return replacement;
	}
	
	if(str.length <= start + 1) {
		return str + replacement;
	}
	
	if(start == null) {
		start = 0;
	}
	if(len == null) {
		len = 0;
	}
	
	return str.substring(0, start) + replacement + str.substr(start + len);
}

/**
 * 去除字符串两头的空格
 * @returns String
 */
String.prototype.trim = function() {
    return this.replace(/(^\s*)|(\s*$)/g, "");
};

/**
 * 简单判空
 * @param val
 * @returns {Boolean}
 */
function isNull(val) {
	if(val == null || val == "") {
		return true;
	}
	return false;
}

/**
 * 买家等级
 * @param score 积分
 * @returns String
 */
function getBuyerLvl(score) {
	var lvl = "无";
	if(score >= 400) {
		lvl = "神豪";
	}
	else if(score >= 300) {
		lvl = "土豪";
	}
	else if(score >= 200) {
		lvl = "租号达人";
	}
	else if(score >= 100) {
		lvl = "老手";
	}
	else {
		lvl = "新手";
	}
	return lvl;
}

/**
 * 卖家等级
 * @param score 积分
 * @returns String
 */
function getSalerLvl(score) {
	var lvl = "无";
	if(score >= 2000) {
		lvl = "土豪";
	}
	else if(score >= 300) {
		lvl = "大亨";
	}
	else if(score >= 200) {
		lvl = "老板";
	}
	else if(score >= 100) {
		lvl = "商人";
	}
	else {
		lvl = "小贩";
	}
	return lvl;
}

/**
 * 选中所有文字
 * @param element
 */
function selectElementTxt(element) {
	var text = element;
	if (document.body.createTextRange) {
		var range = document.body.createTextRange();
		range.moveToElementText(text);
		range.select();
	} else if (window.getSelection) {
		var selection = window.getSelection();
		var range = document.createRange();
		range.selectNodeContents(text);
		selection.removeAllRanges();
		selection.addRange(range);
		/*if(selection.setBaseAndExtent){
			selection.setBaseAndExtent(text, 0, text, 1);
		}*/
	} else {
		//alert("none");
	}
}

/**
 * 判空
 */
function empty(str) {
	if(undefined == str || null == str || str == "") {
		return true;
	}
	return false;
}

/**
 * 禁用按钮
 * @param btn 按钮Dom
 * @param val 值
 */
function disableButton(btn, val) {
	$(btn).prop("disabled", true).addClass("disabledbtn");
	if(!empty(val)) {
		$(btn).attr("value", val);
	}
}

/**
 * 启用按钮
 * @param btn 按钮Dom
 * @param val 值
 */
function enableButton(btn, val) {
	$(btn).prop("disabled", false).removeClass("disabledbtn");
	if(!empty(val)) {
		$(btn).attr("value", val);
	}
}