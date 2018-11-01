$(document).ready(function(){
    HeaderMenu();
});
$(window).resize(function(){
    HeaderMenu();

});

$(document).on("click",".amenu",function() {


    if ($(this).hasClass("is-active"))
    {

        $(this).removeClass("is-active");
    }else{

        $(this).addClass("is-active");
    }
    $(".menu-top .menu").stop().slideToggle(200);

});

$(document).on("click",".menu-top .menu li a i",function(){
    if($(window).width()<983) {
        if ($(this).parent("a").next("ul").length) {

            $(this).parent("a").next("ul").stop().slideToggle();
            return false;
        }
    }
});

function HeaderMenu()
{
    if($(window).width()<983){

        $(".menu-top .menu").css("width", $(".inner").width() + "px");

    }
    else{
        $(".menu-top .menu").css("width","auto");

        //Меню главное
        var OBJ;
        $(".cat2.parent").hover(function(){
            OBJ = $(this);
            // $(this).children("ul").addClass("active");
            OBJ.children("ul").stop().slideDown(300);
            OBJ.addClass("hover");

        });

        $(".menu-top .menu > li.arrow").hover(function(){},function(){
            if(OBJ){
                OBJ.children("ul").removeClass("active");
                OBJ.children("ul").stop().slideUp(300);}
            $(".cat2.parent").removeClass("hover");

        });
    }
}




$(document).ready(function(){
    /*$(".services-order a").click(function(){
        $('html,body').animate({scrollTop: $(".block-map-form").offset().top});
        return false;
    });*/


    if($(window).width()>=1000) {
        //Меню главное
        var OBJ;
        $(".parent2").hover(function () {

                OBJ = $(this);
                // $(this).children("ul").addClass("active");
                OBJ.children("ul").stop().slideDown(300);
                OBJ.addClass("hover");

            }, function () {
				/*
            if(!OBJ.children("a").hasClass("active2"))
            {
                OBJ.children("ul").stop().slideUp(300);
            OBJ.removeClass("hover");}
			*/
            }
        );
    }else{

        var OBJ;
        $(".parent2 i").click(function () {
            OBJ = $(this);
            // $(this).children("ul").addClass("active");
            OBJ.parent("li").children("ul").stop().slideToggle(300);
            OBJ.addClass("hover");

        });

    }
    $(".block-service1>li").hover(function(){},function(){
        if(OBJ){
            OBJ.children("ul").removeClass("active");
            OBJ.children("ul").stop().slideUp(300);}
        $(".parent2.parent").removeClass("hover");

    });


});