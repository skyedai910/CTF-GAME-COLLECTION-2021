/**
 * 滚动通知
 * @date 2017年6月6日15:21:59
 * @author WangBinjie
 */
// ======================================
$(function(){
	loadNoticeRoll();
});

function loadNoticeRoll() {
	var url = "/Common/noticeRoll.html";
	$.get(url, function(data){
		if(data.status == "1") {
			showTopNoticeRoll(data.notice);
			showFixNoticeRoll(data.notice);
		} else {
			closeTopNotice();
			closeFixNotice();
		}
		//setTimeout(loadNoticeRoll, 10000);
	});
}

/** 显示顶部通知 */
function showTopNoticeRoll(notice) {
	if($(".noticeRollTop").length == 1) {
		var noticeTopC = $.cookie("notice_top_"+notice.d);
		if(noticeTopC == "c") {
			return false;
		}

		$(".noticeTopTxt span").html('<a href="'+notice.url+'" target="_blank">'+notice.title+'</a>');
		$(".noticeRollTop").show();
		$('.logBox').css("top","25px");
		$("#top_top").height("63px");
		// 绑定事件
		$('.close__').unbind("click").click(function(){
			closeTopNotice();
			$.cookie("notice_top_"+notice.d, "c");
		});
	}
}

/** 隐藏顶部通知 */
function closeTopNotice() {
	$('#noticeContent').removeClass('noticeC');
	$('#noticeContent').hide();
	$('.logBox').css("top","0px");
	$("#top_top").height("38");
}

/** 显示右下角通知 */
function showFixNoticeRoll(notice) {
	if($(".noticeRollFix").length == 1) {
		var noticeFixC = $.cookie("notice_fix_"+notice.d);
		if(noticeFixC == "c") {
			return false;
		}

		$(".noticeTxt").html('<a href="'+notice.url+'" target="_blank">'+notice.title+'</a>');
		$(".noticeRollFix").show().animate({"bottom":"2px","opacity":"1"},"slow");
		$('.noticeClose').unbind("click").click(function(){
			closeFixNotice();
			$.cookie("notice_fix_"+notice.d, "c");
		});
	}
}

/** 关闭右下角通知 */
function closeFixNotice() {
	$(".noticeFix").animate({"bottom":"-150px","opacity":"0.5"},"slow", function(){
		$(".noticeFix").hide();
	});
}