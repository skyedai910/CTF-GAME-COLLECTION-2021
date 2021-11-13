$(function(){
	init();
	$(".foot_top_right .indexewm .imgtarch li").mouseenter(function(){
        var bottomnum=$(".foot_top_right .indexewm .imgtarch li").index(this);
        $(".foot_top_right .indexewm .ewmcon li").eq(bottomnum).show().siblings().hide();
    });

	var tyc,newschange,changeban;
	$(".news_title li").mouseenter(function(){
		shownews(1,$(this));
	})
	$(".news1_title li").mouseenter(function(){
		shownews(2,$(this));
	})
	  $("#serch1").mouseenter(function(){
        $(this).children("li").show();
    }).mouseleave(function(){
        $(this).children("li").hide();
        $(this).children("li.hover").show();
    });
    $("#serch1 li").click(function(){
        $(this).addClass("hover").show().siblings().removeClass("hover").hide();
    })
	$(".tyright").click(function(){
		tyboxchange();
	});
	$(".tyleft").click(function(){
		var $width = $('.tybox a:last').css("width");
		$('.tybox a:first').css({'width': '0px','opacity':'0'}).insertBefore('.tybox a:last').animate({'width': $width,'opacity':'1'}, function() {
			$(this).removeAttr('style');
		});
		
	});
	$(".hotgame_left").mouseenter(function(){
		$(this).children(".topbtn").html($(this).find(".btn").html());
	})
	$(".hotgame_right li").mouseenter(function(){
		$(this).children(".topbtn").html($(this).find(".btn").html());
	})
	var tiyantext = "";
	$(".tiyan_con a").mouseenter(function(){
		tiyantext= $(this).children("span").html();
		$(this).children("span").html("立即查看");
	}).mouseleave(function(){
		$(this).children("span").html(tiyantext);
		tiyantext="";
	})
	$(".tiyan_con").mouseenter(function(){
		clearInterval(tyc);
	}).mouseleave(function(){
		tycauto();
	})
	$(".banner_left").click(function(){
		bannerchange(1);
	});
	$(".banner_right").click(function(){
		bannerchange(2);
	});
	$(".main_left").mouseenter(function(){
		clearInterval(changeban);
	}).mouseleave(function(){
		changebanner();
	});
	$(".topcon ul li").mouseenter(function(){
		$(this).children(".tkbox").fadeIn();
	}).mouseleave(function(){
		$(this).children(".tkbox").fadeOut();
	})
	function bannerchange(n){
		var banner_circlelength = $(".banner_circle li").length;
		var bannercurrent = $(".banner_circle").find(".current");
		var bannerindex = $(".banner_circle li").index(bannercurrent);
		if(n==1){
			if(bannerindex<=0){
				bannerindex = banner_circlelength;
			}
			bannerindex = bannerindex-1;
		}else if(n==2){
			if(bannerindex>=banner_circlelength-1){
				bannerindex = -1;
			}
			bannerindex = bannerindex+1;
		}
		$(".banner_circle li").removeClass("current").eq(bannerindex).addClass("current");
		$(".banner li").removeClass("current").eq(bannerindex).addClass("current");
	}
	$(".banner_circle li").mouseenter(function(){
		var bannerindex = $(".banner_circle li").index(this);
		$(".banner_circle li").removeClass("current").eq(bannerindex).addClass("current");
		$(".banner li").removeClass("current").eq(bannerindex).addClass("current");
	});
	function windowchange(){
		if($(window).scrollTop()>$(window).height()){
				$(".sidebarbottom").addClass("flycurrent");
			}else{
				$(".sidebarbottom").removeClass("flycurrent");
			}
	}
	window.onscroll=windowchange;
	$(".sidebarbottom").click(function(){
		$('html, body').animate({scrollTop:0}); 
	})
	function init(){
		windowchange();
		var banner_circlelength = $(".banner_circle li").length;
		$(".banner_circle").css("marginLeft","-"+(banner_circlelength*37)/2+"px");
		tycauto();
		//change();
		changebanner();
		setInterval( function () {
	        $('.circles').toggleClass('animated')
	    }, 4 * 1000); 
	}
	function changebanner(){
		changeban= setInterval(function(){
			bannerchange(2);
		},5000)
	}
	function shownews(n,thisclass){
		if(n==1){
			var news = 'news';
		}else if(n==2){
			var news = 'news1'
		}
		var lititle = $('.'+news+'_title li');
		var lilist = $('.'+news+'_list li');
		thisclass.addClass("current").siblings().removeClass("current");
		var thisindex = lititle.index(thisclass);
		lilist.hide().eq(thisindex).show();
	}
	function changenews(n){
		var i=0;var j=0;
		if(n==1){
			var news = 'news';
			var lititle = $('.'+news+'_title li');
			var lilist = $('.'+news+'_list li');
			i++;
			if(i>1){
				i=0;
			}
			lititle.removeClass("current").eq(i).addClass("current");
			lilist.hide().eq(i).show();		
		}else if(n==2){
			var news = 'news1'
			var lititle = $('.'+news+'_title li');
			var lilist = $('.'+news+'_list li');
			j++;
			if(j>3){
				j=0;
			}
			lititle.removeClass("current").eq(j).addClass("current");
			lilist.hide().eq(j).show();			
		}	
	}
	function tycauto(){
		tyc = setInterval(function(){
			tyboxchange();
		},4000);
	
	}
	function change(){
		setInterval(function(){
			changenews(1);
			changenews(2);
		},5000);
	}
	function tyboxchange(){
		var $width = $('.tybox a:last').css("width");
		$('.tybox a:last').css({'width': '0px','opacity':'0'}).insertBefore('.tybox a:first').animate({'width': $width,'opacity':'1'}, 'fast', function() {
			$(this).removeAttr('style');
		});
		
	}
$(".bigclassy").mouseenter(function(){

									var indexnum = $(".bigclassy").index(this) +1;
									$(this).children("img").attr("src","assets/mall/images/ban_left"+indexnum+indexnum+".png")
								}).mouseleave(function(){
var indexnum = $(".bigclassy").index(this) +1;
									$(this).children("img").attr("src","assets/mall/images/ban_left"+indexnum+indexnum+".png")

})
})