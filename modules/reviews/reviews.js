
var countelements = 0;
//Слайдер с отзывами
(function ($) {
    $(function () {
        var jcarousel = $('#slider_reviews');
        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 887) {
                    width = width / 3 - 30;
                    countelements = 3;
                    $('.jcarousel-control-prev')
                        .jcarouselControl({
                            target: '-=3'
                        });
                    $('.jcarousel-control-next')
                        .jcarouselControl({
                            target: '+=3'
                        });


                } else if (width >= 600) {
                    width = width / 2 - 30;
                    countelements = 2;
                    $('.jcarousel-control-prev')
                        .jcarouselControl({
                            target: '-=2'
                        });
                    $('.jcarousel-control-next')
                        .jcarouselControl({
                            target: '+=2'
                        });



                } else  {
                    width = width / 1 - 30;
                    countelements = 1;
                    $('.jcarousel-control-prev')
                        .jcarouselControl({
                            target: '-=1'
                        });
                    $('.jcarousel-control-next')
                        .jcarouselControl({
                            target: '+=1'
                        });
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            }).jcarouselSwipe({
            perSwipe: countelements
        });


    });
})(jQuery);




$(document).ready(function(){

    $(document).on("click","#chComments-Send",function(){

        var Name = $("#chComments-Name").val();
        var Link = $("#chComments-Link").val();
        var Text = $("#chComments-Text").val();
        var Photo = $("#chComments-Photo").val();
        var TypeServ = $("#chComments-TypeServ").val();
        //

        if(Name && Text)
        {
            var r1 = new RegExp("\x27+","g");
            var r2 = new RegExp("\x22+","g");
            Text = Text.replace(r1, " ");
            Text = Text.replace(r2, " ");

            $("#otziv_send").children(".inner").hide();
            $("#otziv_send").append("<div class='ajax-loader-inner'> <div class='ajax-loader'><img src='/images/chcomments/ajax-loader.gif'/></div></div>");
            $.ajaxFileUpload
            (
                {
                    url:'/modules/reviews/reviews_cender.php',
                    secureuri:false,
                    fileElementId:'chComments-Photo',
                    dataType: 'json',
                    data:{name:Name, link:Link, typeserv:TypeServ, text:Text.replace('"',""), sendchcomment:1},
                    success: function (data, status)
                    {
                        if(typeof(data.error) != 'undefined')
                        {
                            if(data.error != '')
                            {
                                //	alert(data.error);
                            }else
                            {
                                //	alert(data.msg);
                            }
                        }
                        var TEXT = $(".form_otziv_send").children(".inner").html();
                        $("#otziv_send").children(".inner").html(TEXT);
                        $(".ajax-loader-inner").remove();
                        $("#otziv_send").children(".inner").show();
                        $("#chComments-Name").val("");
                        $("#chComments-Link").val("");
                        $("#chComments-Text").val("");
                        $("#chComments-Photo").val("");
                        $("#chComments-TypeServ").val("");
                        $("#fileInputText1").val("");
                    },
                    error: function (data, status, e)
                    {
                        var TEXT = $(".form_otziv_send").children(".inner").html();
                        $("#otziv_send").children(".inner").html(TEXT);
                        $("#chComments-Name").val("");
                        $("#chComments-Link").val("");
                        $("#chComments-Text").val("");
                        $("#chComments-Photo").val("");
                        $("#chComments-TypeServ").val("");
                        $("#fileInputText1").val("");
                    }
                }
            );
        }
        else
        {
            if(!Name)
            {
                $("#chComments-Name").parent("label").css("color","red");
            }
            else
            {
                $("#chComments-Name").parent("label").css("color","#777");
            }
            if(!Text)
            {
                $("#chComments-Text").parent("label").css("color","red");
            }
            else
            {
                $("#chComments-Text").parent("label").css("color","#777");
            }
        }

    });
    //-----
    $("#otzit-PopUp-Open, #otzit-PopUp-Open_").click(function(){

        var Width = $("#otziv_send").width();
        var Height = $("#otziv_send").height();

        var WWidth = $(window).width();
        var WHeight = ieWindow();

        $("#otziv_send").css("top",(WHeight-Height)/2+"px");

        $("#otziv_send").css("left",(WWidth-Width)/2+"px");
        $("body").append("<div id='overlay'></div>");
        $("#otziv_send").show();
    });
    $(window).resize(function(){
        var Width = $("#otziv_send").width();
        var Height = $("#otziv_send").height();

        var WWidth = $(window).width();
        var WHeight = ieWindow();

        $("#otziv_send").css("top",(WHeight-Height)/2+"px");
        $("#otziv_send").css("left",(WWidth-Width)/2+"px");
    });

    $(".PopUp").children(".close").click(function(){$(this).parent(".PopUp").hide();$("#overlay").remove();limitComments=10;});
    $(document).on("click","#overlay",function(){$(".PopUp").hide();$("#overlay").remove();});
});

function ieWindow()
{

    if(window.innerWidth!= undefined){
        return $(window).height();
    }
    else{
        var B= document.body,
            D= document.documentElement;
        return $(window).height();
    }

}


$("#otzit_board-PopUp-Open").click(function(){
    Show_Pop_Up('#otzit_board_send',0);
});