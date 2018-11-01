//Портфолио
var counttoswipe;
(function($) {
    $(function() {
        var jcarousel = $('.block-portfolio .jcarousel').jcarousel();

        //setInterval("$('.box .jcarousel').jcarousel('scroll', '+=1')", 7000);

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 887) {
                    width = width / 3 - 14;
                    counttoswipe = 3;
                    $('.block-portfolio .jcarousel-control-prev-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '-=3'
                        });

                    $('.block-portfolio .jcarousel-control-next-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '+=3'
                        });
                } else if (width >= 600) {
                    width = width / 2 - 14;
                    counttoswipe = 2;

                    $('.box .jcarousel-control-prev-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '-=2'
                        });

                    $('.block-portfolio .jcarousel-control-next-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '+=2'
                        });
                } else  {
                    width = width / 1 - 14;
                    counttoswipe = 1;

                    $('.block-portfolio .jcarousel-control-prev-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '-=1'
                        });

                    $('.block-portfolio .jcarousel-control-next-portf-0')
                        .on('jcarouselcontrol:active', function() {
                            $(this).removeClass('inactive');
                        })
                        .on('jcarouselcontrol:inactive', function() {
                            $(this).addClass('inactive');
                        })
                        .jcarouselControl({
                            target: '+=1'
                        });
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            }).jcarouselSwipe({
            perSwipe: counttoswipe
        }).jcarouselAutoscroll({
            target: '+='+counttoswipe,interval: 20000
        });




        $('.block-portfolio .jcarousel-pagination-portf')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();
    });
})(jQuery);





function ShowPortfolioCats(cat)
{
    $(function () {
        //$('#portfolio-carusel'+cat).carousel({});
    });
    setTimeout(function(){


        (function($) {
            $(function() {
                var jcarousel1 = $('.jcarousel-'+cat).jcarousel();
                var Cat = cat;
                /*setInterval(function(){
                 jcarousel1.jcarousel('scroll', '+=1')
                 }, 7000);*/

                jcarousel1
                    .on('jcarousel:reload jcarousel:create', function () {
                        var carousel1 = $(this),
                            width = carousel1.innerWidth();


                        if (width >= 887) {
                            width = width / 3 - 14;
                            $('.box .jcarousel-control-prev-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '-=3'
                                });

                            $('.box .jcarousel-control-next-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '+=3'
                                });
                        } else if (width >= 600) {
                            width = width / 2 - 14;
                            $('.box .jcarousel-control-prev-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '-=2'
                                });

                            $('.box .jcarousel-control-next-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '+=2'
                                });
                        } else {
                            width = width / 1 - 14;
                            $('.box .jcarousel-control-prev-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '-=1'
                                });

                            $('.box .jcarousel-control-next-portf-'+cat)
                                .on('jcarouselcontrol:active', function() {
                                    $(this).removeClass('inactive');
                                })
                                .on('jcarouselcontrol:inactive', function() {
                                    $(this).addClass('inactive');
                                })
                                .jcarouselControl({
                                    target: '+=1'
                                });
                        }


                        carousel1.jcarousel('items').css('width', Math.ceil(width) + 'px');
                    })
                    .jcarousel({
                        wrap: 'circular'
                    });



                $('.box .jcarousel-pagination-portf')
                    .on('jcarouselpagination:active', 'a', function() {
                        $(this).addClass('active');
                    })
                    .on('jcarouselpagination:inactive', 'a', function() {
                        $(this).removeClass('active');
                    })
                    .jcarouselPagination();
            });
        })(jQuery);


    },10);

}

$(document).ready(function(){

});
$(document).on("click",".tags-block a",function(){/*
    $(".tags-block a").removeClass("active");
    $(this).addClass("active");
    var tagid = $(this).attr("tagid");
    var title = $(this).attr("title");

    $(".workportfolio").hide();
    $(".workportfolio[tag_"+tagid+"='1']").show();
    //setGetParameter("tag",title);




  parent.location.hash = "";
 parent.location.hash = "?tag="+title;
    return false;*/
});

function setGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    var hash = location.hash;
    url = url.replace(hash, '');
    if (url.indexOf(paramName + "=") >= 0)
    {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    }
    else
    {
        if (url.indexOf("?") < 0)
            url += "?" + paramName + "=" + paramValue;
        else
            url += "&" + paramName + "=" + paramValue;
    }
  //location.href = url + hash;
    //location.hash  = url + hash;
}