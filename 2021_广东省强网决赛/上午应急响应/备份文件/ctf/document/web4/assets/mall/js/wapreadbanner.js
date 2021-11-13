if("undefined"!=typeof(advert4list)){
	if(advert4list!="" && advert4list!=null && advert4list!=undefined && advert4list.length>0){
		var imageBase = document.getElementById("imageBase").value;
		document.writeln("<div class=\"mui-slider-group mui-slider-loop\">");
		document.writeln("<div class=\"mui-slider-item mui-slider-item-duplicate\"><a href=\""+advert4list[advert4list.length-1].link+"\"><img src=\""+imageBase +advert4list[advert4list.length-1].img.replace("advert","img")+"\"></a><p class=\"mui-slider-title\">"+advert4list[advert4list.length-1].title+"</p></div>");
		for(var i=0;i<advert4list.length;i++){
			document.writeln("<div class=\"mui-slider-item\"><a href=\""+advert4list[i].link+"\"><img src=\""+imageBase +advert4list[i].img.replace("advert","img")+"\"></a><p class=\"mui-slider-title\">"+advert4list[i].title+"</p></div>");
		}
		document.writeln("</div>");
		document.writeln("<div class=\"mui-slider-indicator mui-text-right\">");
		for(var i=0;i<advert4list.length;i++){
			if (i==0) {
				document.writeln("<div class=\"mui-indicator mui-active\"></div>");
			}else{
				document.writeln("<div class=\"mui-indicator\"></div>");
			}
		}
		document.writeln("</div>");
	}
}

