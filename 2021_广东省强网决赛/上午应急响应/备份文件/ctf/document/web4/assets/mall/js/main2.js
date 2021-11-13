$(function(){
	
	$(".tabs").each(function(){
		$(this).tabs();
	});
	
		// $(".ban_left >ul >li >span").eq(0).css({"margin-top":"0"});
		// var sp = $(".ban_left >ul >li");
		// sp.eq(0).find('ul').show();
		// $(".ban_left >ul >li >span").click(function(){
		// 	var t = $(this);
		// 	var ul = t.parents("li").find("ul");
		// 	sp.find('ul').slideUp();
		// 	ul.stop().slideDown();
		// });
		$('.ban_left ul li .otherstyle1').click(function(){
			$('.ban_left ul li ul').stop().slideToggle();
		});
		$(".ban_left >ul >li ").hover(function(){
			$(this).find(".zq_show").show();
		},function(){
			$(this).find(".zq_show").hide();
		});
		$(".ban_left ul li ul li").hover(function(){
		    $(this).find(".zq_show2").show();
		},function(){
			$(this).find(".zq_show2").hide();
		});
		//$(".zq_show2").mouseover(function(){
		//	$(this).show();
		//});
		//$(".zq_show2").mouseout(function(){
		//	$(this).hide();
		//});
		$(".zq_show").mouseenter(function(){
			$(this).show();
		});
		$(".zq_show").mouseleave(function(){
			$(this).hide();
		});
	//头部新闻切换
	;(function(){
		var vel = 1000;//滑动时间
		var set_vel = 3000;//间隔时间
		var box = $('.news_xl');
		var ul = box.find('ul');
		var li = ul.find('li');
		var lgn = li.length;
		var width = li.outerWidth(true);
		ul.css({
			'width' : width*lgn
		});
		function next_news(){
			ul.stop().animate({
				'left' : -width
			},vel,function(){
				ul.find('li:first').appendTo(ul);
				ul.css('left' , 0);
			});
		};
		var swf = setInterval(function(){
			next_news();
		},set_vel);
		box.hover(function(){
			clearInterval(swf);
		},function(){
			swf = setInterval(function(){
				next_news();
			},set_vel);
		});
	})();
});
