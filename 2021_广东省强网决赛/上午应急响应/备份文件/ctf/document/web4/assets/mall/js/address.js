$.fn.sjld1 = function(shenfen,chengshi,quyu){
	var sfp = shenfen+' p'
	var csp = chengshi+' p'
	var qyp = quyu+' p'
	var sfs = shenfen+' .m_zlxg2'
	var css = chengshi+' .m_zlxg3'
	var qys = quyu+' .m_zlxg4'
	var sfli = shenfen+' ul li'
	var csli = chengshi+' ul li'
	var qyli = quyu+' ul li'
	$('.m_zlxg1').click(function(){
		$(this).find('.m_zlxg2').slideDown(200);
	})
	$('.m_zlxg1').mouseleave(function(){
		$(this).find('.m_zlxg2').css("display","none");		
	})
	$('.m_zlxg2').click(function(){
		$('.m_zlxg2').css("display","none");
		$('.m_zlxg3').slideDown(200);
	})
	$('.m_zlxg33').click(function(){
		$(this).find('.m_zlxg3').slideDown(200);
	})
	$('.m_zlxg33').mouseleave(function(){
		$(this).find('.m_zlxg3').css("display","none");
	})
	$('.m_zlxg3').click(function(){
		$('.m_zlxg3').css("display","none");
		$('.m_zlxg4').slideDown(200);
	})
	$('.m_zlxg44').click(function(){
		$(this).find('.m_zlxg4').slideDown(200);

	})
	$('.m_zlxg44').mouseleave(function(){
		$(this).find('.m_zlxg4').slideUp(200);
	})
	$('.m_zlxg4').click(function(){
		$('.m_zlxg4').css("display","none");
	})
	var sfgsmr = gameList;
	var csgsmr = gameList[0].areaList;
	var qygsmr = gameList[0].areaList[0].serverList;
	var kuandu = new Array();
	
	
	$(sfp).text(sfgsmr[0].name);
	$(csp).text(csgsmr[0].name);
	$(qyp).text(qygsmr[0]);
	//默认城市
	for(a=0;a<sfgsmr.length;a++){
		var sfmcmr = sfgsmr[a].name;
		var sfnrmr = "<li>"+sfmcmr+"</li>";
		$(shenfen).find('ul').append(sfnrmr);
	}
	for(b=0;b<csgsmr.length;b++){
		var csmcmr = csgsmr[b].name;
		
		var csnrmr = "<li>"+csmcmr+"</li>";
		$(chengshi).find('ul').append(csnrmr);
		kuandu[b] =csmcmr.length*14+20;
	}
	for(c=0;c<qygsmr.length;c++){
		var qymcmr = qygsmr[c];
		var qynrmr = "<li>"+qymcmr+"</li>";
		$(quyu).find('ul').append(qynrmr);
	}
	Array.max=function(array)
		{
    		return Math.max.apply(Math,array);
		}
	var max_kd = Array.max(kuandu); 

	
/*---------------------------------------------------------------------*/

	$(sfli).click(function(){
		var dqsf = $(this).text();
		$(shenfen).find('p').text(dqsf);
		$(shenfen).find('p').attr('title',dqsf);
		var sfnum = $(this).index();
		
	var csgs = gameList[sfnum].areaList;
	var csgs2 = gameList[sfnum].areaList[0].serverList;
	$(chengshi).find('ul').text('');
	var kuandu = new Array();
	for(i=0;i<csgs.length;i++){
		var csmc = csgs[i].name;
		var csnr = "<li>"+csmc+"</li>";
		$(chengshi).find('ul').append(csnr);
		kuandu[i] =csmc.length*14+20;
	}
Array.max=function(array)
{
    return Math.max.apply(Math,array);
}
var max_kd = Array.max(kuandu); 
	var qygsdqmr = gameList[sfnum].areaList[0].serverList;
	$(quyu).find('ul').text('');
	for(j=0;j<qygsdqmr.length;j++){
		var qymc = qygsdqmr[j];
		var qynr = "<li>"+qymc+"</li>";
		$(quyu).find('ul').append(qynr);
	}		
	$(csp).text(csgs[0].name);
	$(qyp).text(csgs2[0]);
	$('#sfdq_num').val(sfnum);

/*------------------*/
	$(csli).click(function(){
		var dqcs = $(this).text();
		var dqsf_num = $('#sfdq_num').val();
		if(dqsf_num==""){
			dqsf_num=0;
			}
			else{
			var dqsf_num = $('#sfdq_num').val();
			}
		$(chengshi).find('p').text(dqcs);
		$(chengshi).find('p').attr('title',dqcs);
		var csnum = $(this).index();
	var qygs = gameList[dqsf_num].areaList[csnum].serverList;
	$(quyu).find('ul').text('');
	for(j=0;j<qygs.length;j++){
		var qymc = qygs[j];
		var qynr = "<li>"+qymc+"</li>";
		$(quyu).find('ul').append(qynr);
	}
	
$(qyp).text(qygs[0]);
	$('#csdq_num').val(csnum);
	
	$(qyli).click(function(){
	var dqqy = $(this).text();
		$(quyu).find('p').text(dqqy);
		$(quyu).find('p').attr('title',dqqy);
			
})//区级
	})	//市级
/*------------------*/	
$(qyli).click(function(){
	var dqqy = $(this).text();
		$(quyu).find('p').text(dqqy);
		$(quyu).find('p').attr('title',dqqy);
			
})//区级


		})//省级
/*---------------------------------------------------------------------*/		
		
		
		
	$(csli).click(function(){
		var dqcs = $(this).text();
		var dqsf_num = $('#sfdq_num').val();
		if(dqsf_num==""){
			dqsf_num=0;
			}
			else{
			var dqsf_num = $('#sfdq_num').val();
			}
		$(chengshi).find('p').text(dqcs);
		$(chengshi).find('p').attr('title',dqcs);
		var csnum = $(this).index();
	var qygs = gameList[dqsf_num].areaList[csnum].serverList;
	$(quyu).find('ul').text('');
	for(j=0;j<qygs.length;j++){
		var qymc = qygs[j];
		var qynr = "<li>"+qymc+"</li>";
		$(quyu).find('ul').append(qynr);
	}
$(qyp).text(qygs[0]);
	$('#csdq_num').val(csnum);
	/*------------------*/
	$(qyli).click(function(){
	var dqqy = $(this).text();
		$(quyu).find('p').text(dqqy);
		$(quyu).find('p').attr('title',dqqy);

			
})//区级
	})	//市级
/*---------------------------------------------------------------------*/	
	
$(qyli).click(function(){
	var dqqy = $(this).text();
		$(quyu).find('p').text(dqqy);
		$(quyu).find('p').attr('title',dqqy);

			
})//区级

/*---------------------------------------------------------------------*/
$('.m_zlxg1').click(function(){
	$('#sfdq_tj').val($(sfp).text());
	$('#csdq_tj').val($(csp).text());
	$('#qydq_tj').val($(qyp).text());
	})//表单传值获取
$('.m_zlxg33').click(function(){
	$('#sfdq_tj').val($(sfp).text());
	$('#csdq_tj').val($(csp).text());
	$('#qydq_tj').val($(qyp).text());
	})//表单传值获取
$('.m_zlxg44').click(function(){
	$('#sfdq_tj').val($(sfp).text());
	$('#csdq_tj').val($(csp).text());
	$('#qydq_tj').val($(qyp).text());
	})//表单传值获取
}


var gameList = [
 
{name:'英雄联盟', areaList:[		   
{name:'电信', serverList:['艾欧尼亚','暗影岛','班德尔城','裁决之地','钢铁烈阳','黑色玫瑰','巨神峰','均衡教派','卡拉曼达','雷瑟守备','诺克萨斯','皮城警备','皮尔特沃夫','守望之海','水晶之痕','影流','战争学院','征服之海','祖安']},	
{name:'网通', serverList:['比尔吉沃特','德玛西亚','弗雷尔卓德','无畏先锋','恕瑞玛','扭曲丛林','巨龙之巢','教育网专区']}
]},
{name:'穿越火线', areaList:[		   
{name:'电信区', serverList:['安徽一区','福建一区','广东一区','广东二区','广东三区','广东四区','广西一区','湖北一区','湖北二区','湖南一区','湖南二区','江苏一区','江苏二区','江西一区','南方大区','陕西一区','上海一区','上海二区','四川一区','四川二区','云南一区','浙江一区','浙江二区','重庆一区']},		   
{name:'网通区', serverList:['北方大区','北京一区','北京二区','北京三区','北京四区','河北一区','河南一区','河南二区','黑龙江区','吉林一区','辽宁一区','辽宁二区','辽宁三区','山东一区','山东二区','山西一区']},
{name:'其他大区', serverList:['教育网专区','移动专区']},
{name:'全区全服', serverList:['全区全服']}
]},
{name:'逆战', areaList:[		   
{name:'电信区', serverList:['电信一服']},		   
{name:'联通区', serverList:['联通一服']}
]},
{name:'地下城与勇士', areaList:[		   
{name:'广东区', serverList:['广东1区','广东2区','广东3区','广东4区','广东5区','广东6区','广东7区','广东8区','广东9区','广东10区','广东11区','广东12区','广东13区','广东1/2区']},		   
{name:'北京区', serverList:['北京1区','北京2/4区','北京3区']},		   
{name:'四川区', serverList:['四川1区','四川2区','四川3区','四川4区','四川5区','四川6区']}
]},
];
