var Mar = document.getElementById("Marquee"); 
        var child_div=Mar.getElementsByTagName("div") 
        var picH = 17;//移动高度 
        var scrollstep=3;//移动步幅,越大越快 
        var scrolltime=50;//移动频度(毫秒)越大越慢 
        var stoptime=5000;//间断时间(毫秒) 
        var tmpH = 0; 
        Mar.innerHTML += Mar.innerHTML; 
        function start(){ 
            if(tmpH < picH){ 
                tmpH += scrollstep; 
                if(tmpH > picH )tmpH = picH ; 
                Mar.scrollTop = tmpH; 
                setTimeout(start,scrolltime); 
            }else{ 
                tmpH = 0; 
                Mar.appendChild(child_div[0]); 
                Mar.scrollTop = 0; 
                setTimeout(start,stoptime); 
            } 
        } 
        onload=function(){setTimeout(start,stoptime)}; 

/**
  * ModalHelper helpers resolve the modal scrolling issue on mobile devices
  * https://github.com/twbs/bootstrap/issues/15852
  * requires document.scrollingElement polyfill https://github.com/yangg/scrolling-element
  */
var ModalHelper = (function(bodyCls) {
  var scrollTop;
  return {
    afterOpen: function() {
      scrollTop = document.scrollingElement.scrollTop;
      document.body.classList.add(bodyCls);
      document.body.style.top = -scrollTop + 'px';
    },
    beforeClose: function() {
      document.body.classList.remove(bodyCls);
      // scrollTop lost after set position:fixed, restore it back.
      document.scrollingElement.scrollTop = scrollTop;
    }
  };
})('modal-open');