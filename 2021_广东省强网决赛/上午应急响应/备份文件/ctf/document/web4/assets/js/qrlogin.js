var interval1,interval2;
function setCookie(name,value)
{
	var exp = new Date();
	exp.setTime(exp.getTime() + 30*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
function getCookie(name)
{
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
		return unescape(arr[2]);
	else
		return null;
}
function getqrpic(force){
	force = force || false;
	var qrsig = getCookie('qrsig');
	var qrimg = getCookie('qrimg');
	if(qrsig!=null && qrimg!=null && force==false){
		$('#qrimg').attr('qrsig',qrsig);
		$('#qrimg').html('<img id="qrcodeimg" onclick="getqrpic(true)" src="data:image/png;base64,'+qrimg+'" title="点击刷新">');
		if( /Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i.test(navigator.userAgent) && navigator.userAgent.indexOf("QQ/") == -1) {
			$('#mobile').show();
		}
	}else{
		var getvcurl='qrlogin.php?do=getqrpic&r='+Math.random(1);
		$.get(getvcurl, function(d) {
			if(d.saveOK ==0){
				setCookie('qrsig',d.qrsig);
				setCookie('qrimg',d.data);
				$('#qrimg').attr('qrsig',d.qrsig);
				$('#qrimg').html('<img id="qrcodeimg" onclick="getqrpic(true)" src="data:image/png;base64,'+d.data+'" title="点击刷新">');
				if( /Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i.test(navigator.userAgent) && navigator.userAgent.indexOf("QQ/") == -1) {
					$('#mobile').show();
				}
			}else{
				alert(d.msg);
			}
		}, 'json');
	}
}
function ptuiCB(code,uin,sid,skey,pskey,superkey,nick){
	var msg='请扫描二维码';
	switch(code){
		case '0':
			$('#loginmsg').html('QQ已成功登录，正在保存...');
			$('#login').hide();
			$('#qrimg').hide();
			$('#submit').hide();
			$('#login').attr("data-lock", "true");
			$.get("findpwd.php?act=qrlogin&r="+Math.random(1), function(arr) {
				if(arr.code==1) {
					alert(arr.msg);
					window.location.href=arr.url;
				}else{
					alert(arr.msg);
				}
			}, 'json');
			cleartime();
			break;
		case '1':
			getqrpic(true);
			msg='请重新扫描二维码';
			break;
		case '2':
			msg='使用QQ手机版扫描二维码';
			break;
		case '3':
			msg='扫描成功，请在手机上确认授权登录';
			break;
		default:
			msg=sid;
			break;
	}
	$('#loginmsg').html(msg);
}
function loadScript(c) {
	if ($('#login').attr("data-lock") === "true") return;
	var qrsig=$('#qrimg').attr('qrsig');
	c = c || "qrlogin.php?do=qqlogin&qrsig="+decodeURIComponent(qrsig)+"&r=" + Math.random(1);
	var a = document.createElement("script");
	a.onload = a.onreadystatechange = function() {
		if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
			if (typeof d == "function") {
				d()
			}
			a.onload = a.onreadystatechange = null;
			if (a.parentNode) {
				a.parentNode.removeChild(a)
			}
		}
	};
	a.src = c;
	document.getElementsByTagName("head")[0].appendChild(a)
}
function loginload(){
	if ($('#login').attr("data-lock") === "true") return;
	var load=document.getElementById('loginload').innerHTML;
	var len=load.length;
	if(len>2){
		load='.';
	}else{
		load+='.';
	}
	document.getElementById('loginload').innerHTML=load;
}
function cleartime(){
	clearInterval(interval1);
	clearInterval(interval2);
}
function mloginurl(){
	var imagew = $('#qrcodeimg').attr('src');
	imagew = imagew.replace(/data:image\/png;base64,/, "");
	$('#mlogin').html("正在跳转...");
	$.post("findpwd.php?act=qrcode&r="+Math.random(1),"image="+encodeURIComponent(imagew), function(arr) {
		if(arr.code==0) {
			$('#loginmsg').html('跳转到QQ登录后请返回此页面');
			window.location.href='mqqapi://forward/url?version=1&src_type=web&url_prefix='+window.btoa(arr.url);
		}else{
			alert(arr.msg);
		}
		$('#mlogin').html("跳转QQ快捷登录");
	}, 'json');
}
$(document).ready(function(){
	getqrpic();
	interval1=setInterval(loginload,1000);
	interval2=setInterval(loadScript,3000);
});