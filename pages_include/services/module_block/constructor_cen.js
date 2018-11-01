$(document).ready(function(){

    $(".cosnt-cen").click(function(){


        $("input[name='form-type']").val($(this).parent("div").parent("div").parent("div").parent("div").parent("div").parent("div").parent("div").parent("div").find(".title").html()+" "+$(this).attr("typeorder"));


        $('html,body').animate({scrollTop: $(".block-map-form.scroll").offset().top});

        return false;
    });


    $(".cosnt-cen-2").click(function(){


        $("input[name='form-type']").val($(this).attr("typeorder"));


        $('html,body').animate({scrollTop: $(".block-map-form.scroll").offset().top});

        return false;
    });

});



$(document).ready(function(){
//доп функции
    $(".pricetablepopup-open").click(function(){
        if($(".listhiden").css("display")=="none")
            $(".listhiden").slideDown();
        else
            $(".listhiden").slideUp();
    });
});