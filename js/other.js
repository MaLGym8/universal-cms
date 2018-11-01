(function($) {
    $(function() {
		
		 $('.pricetable .pricemodule .center ul').on('mousedown touchstart MSPointerDown', function(e){
			 if($(window).width()>1000)
			 {
				 e.stopPropagation();
			 }
        });
		
		 $('.pricetable .pricemodule .center ul').on('mousedown touchstart MSPointerDown', function(e){
			 if($(window).width()>1000)
			 {
				 e.stopPropagation();
			 }
        });
		
        var counttoslide4 = 4;
        var counttoslide3 = 3;
        var counttoslide2 = 2;
        if($(window).width()<=768)
        {
            counttoslide4 = 2;
            counttoslide3 = 2;
            counttoslide2 = 2;
        }
        if($(window).width()<=500)
        {
            counttoslide4 = 1;
            counttoslide3 = 1;
            counttoslide2 = 1;
        }

        var swiper2 = new Swiper('.swiper-container-2', {
            pagination: '.swiper-pagination2',
            slidesPerView: counttoslide2,
            paginationClickable: true,
            spaceBetween: 10
        });

        var swiper3 = new Swiper('.swiper-container-3', {
            pagination: '.swiper-pagination3',
            slidesPerView: counttoslide3,
            paginationClickable: true,
            spaceBetween: 10,
        });

        var swiper4 = new Swiper('.swiper-container-4', {
            pagination: '.swiper-pagination4',
            slidesPerView: counttoslide4,
            paginationClickable: true,
            spaceBetween: 10
        });

        $(".block-services-tabs .box").hide();
        $(".block-services-tabs .box.visible").show();

        $('ul.product-tabs').on('click', 'li:not(.current)', function() {
            $(this).addClass('current').siblings().removeClass('current')
                .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
        });

        $('ul.gifts-tabs').on('click', 'li:not(.current)', function() {
            $(this).addClass('current').siblings().removeClass('current')
                .parents('div.section').find('div.box').eq($(this).index()).fadeIn(150).siblings('div.box').hide();
        });

    })
})(jQuery)


$(document).on("click",".scroll-move",function(){
    var href = $(this).attr("href");
    $('html,body').animate({scrollTop: $(href).offset().top});

    return false;
});



$(document).ready(function(){


    $(".span-smaller .whatsapp, .span-smaller .viber").click(function () {

        if($(window).width()>1000) {

            Show_Pop_Up('#form_help', 0);
            return false;
        }
    });



    $(document).on('click', function(e) {

        if (!$(e.target).closest(".dropdown-info").length&&!$(e.target).closest(".header .headcontacts .phone").length) {
            if($(".dropdown-info").css("display")=="block"&&$(window).width()<1000)
            {
                $('.dropdown-info').hide();
            }
        }
        e.stopPropagation();
    });


    if($(window).width()>1000)
    {



        $(".header .headcontacts .phone").hover(function(){
           // $(".dropdown-info").show();
        },function () {
           // $(".dropdown-info").hide();
        });



    }else{
        $(document).on("click",".header .headcontacts .phone",function(){
            $(".dropdown-info").show();
        });

    }



    // $(".calc-tabs").find("a").click(function(){return false;});

    $(".services-order a, .button-down-order").click(function(){
        $('html,body').animate({scrollTop: $(".block-map-form.scroll").offset().top});
        return false;
    });
});
/*
$(".icons4").hover(function(){
    var OBJ = $(this);

    var id = $(this).attr("blockid");
    $(".icons4").removeClass("active");
    var OFTop = $(this).offset().top
    $(".ic-text").removeClass("active");
    $(this).addClass("active");
    $(".ic-text[textid='"+id+"']").addClass("active");
    $(".ic-text[textid='"+id+"']").animate({
        opacity: 1},500);
    //$(".ic-text[textid='"+id+"']").css("top",2+"px");
    $(".ic-text[textid='"+id+"']").css("width",$(".inner-text-blocks").width()+"px");
    //$(".ic-text[textid='"+id+"']").css("left",($(window).width()-$(".inner-text-blocks").width())/2+"px");
    $(".ic-text[textid='"+id+"']").css("left",-OBJ.offset().left+(($(window).width()-$(".inner-text-blocks").width())/2)+"px");



    $("body").append('<div id="mask"></div>');
},function () {
    $(".icons4").removeClass("active");
    $(".ic-text").removeClass("active");
    $(".ic-text").attr("style","");
    $('#mask').remove();
});*/



$(".icons4, .icons4 a").click(function(){
    if(!$(this).hasClass("active")) {

        var OBJ = $(this);

        var id = $(this).attr("blockid");
        $(".icons4").removeClass("active");
        var OFTop = $(this).offset().top
        $(".ic-text").removeClass("active");
        $(this).addClass("active");
        $(".icons4").find("span").css("opacity", "0");
        $(".ic-text[textid='" + id + "']").addClass("active");
        $(".ic-text[textid='" + id + "']").animate({
            opacity: 1
        }, 500);
        //$(".ic-text[textid='"+id+"']").css("top",2+"px");
        $(".ic-text[textid='" + id + "']").css("width", $(".inner-text-blocks").width() + "px");
        //$(".ic-text[textid='"+id+"']").css("left",($(window).width()-$(".inner-text-blocks").width())/2+"px");
        $(".ic-text[textid='" + id + "']").css("left", -OBJ.offset().left + (($(window).width() - $(".inner-text-blocks").width()) / 2) + "px");


        $("body").append('<div id="mask"></div>');
    }
    return false;
});

$(".icons4").hover(function(){},function(){
    $(".icons4").removeClass("active");
    $(".ic-text").removeClass("active");
    $(".ic-text").attr("style","");
    $('#mask').remove();
    $(".icons4").find("span").css("opacity","1");
});





var limitportfolio = parseInt($("#startload").val());
var limitportfolio1 = parseInt($("#limitajaxload").val());
$(document).on("click",".ajaxloadportfolio",function(){
    var tagid = $(this).attr("tagid");
    var query = $(this).attr("query");
    dataString = {ajaxloadportfolio:1,limit:limitportfolio,tagid:tagid,limitload:limitportfolio1, query:query};
    $.ajax({
        type: "POST",
        async:false,
        url: "/pages_include/portfolio/ajax.php",
        data:dataString,
        cache:false,
        success:function(html)
        {
            limitportfolio = limitportfolio + limitportfolio1;

            $(html).insertBefore(".ajaxloadportfolio");
            if(!html) {
                $("<div class='ajax-none'>Больше записей нет</div>").insertBefore(".ajaxloadportfolio");
                $(".ajaxloadportfolio").remove();
            }
        }
    });


});



$(document).ready(function(){
//Появление кнопки вверх
    $(window).scroll(function(){
        if($(window).scrollTop()>300)
        {
            $("#upgo").show();
        }else{
            $("#upgo").hide();
        }
    });
//Прокрутка страницы вверх
    $("#upgo").click(function(){
        $("html, body").animate({ scrollTop:0}, "slow");
    });
	
	
//фиксированное меню	---- здесь было вставлено
	
	
	
});

function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}