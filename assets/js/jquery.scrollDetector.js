var lastScrollTop = 0;
var action = "stopped";
var timeout = 400;
$.fn.scrollEnd = function(callback, timeout) {
    $(this).scroll(function(){
        var st = $(this).scrollTop();
        var $this = $(this);
        if (lastScrollTop !=0 )
        {
            if (st < lastScrollTop){
                action = "scrollUp";
            }
            else if (st > lastScrollTop){
                action = "scrollDown";
            }
        }
        lastScrollTop = st;
        if ($this.data('scrollTimeout')) {
            clearTimeout($this.data('scrollTimeout'));
        }
        $this.data('scrollTimeout', setTimeout(callback,timeout));
    });
};

$(window).scrollEnd(function(){
    if(action!="stopped"){
        $(document).trigger(action);
    }
}, timeout);