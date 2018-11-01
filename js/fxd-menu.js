//фиксированное меню	
var scroll_ = 0;
var mtop=150;
var MenuHeight = $(".menu-top-main").height();
		$(window).scroll(function(){ 
		
		
		if($(window).width()>1000){
            if ($(window).scrollTop()>=$(".header").height())
			{
                $(".menu-top-main").addClass("fxd");
                $("body").css("padding-top",MenuHeight+"px");
				 scroll_=1;
				//$("#about, #price,  #sale, #reviews, #portfolio, #contacts").addClass("fxd-padding");
            }
            else
            {
                $(".menu-top-main").removeClass("fxd");
				  $("body").css("padding-top","0px");
				scroll_=0;
				//$("#about, #price,#sale, #reviews, #portfolio, #contacts").removeClass("fxd-padding");
            }
		}
			
			
        });