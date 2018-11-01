$(document).ready(function(){
    var Width = $(".index-slider .jcarousel").width();
    $(".index-slider li").css("width",Width+"px");
});
$(document).on("click",".head-navigation .elemnav",function(){
    var elem = $(this).attr("idelem");
    $(this).parent("div").parent('div').children("p").children("a:eq("+ parseInt(elem-1) +")").click();



});
setInterval("$('.index-slider .jcarousel').jcarousel('scroll', '+=1')", 20000);
(function($) {
    $(function() {
        $('.index-slider .jcarousel').jcarousel({
            wrap: 'circular',

        });

        $('.jcarousel-control-prev-index')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next-index')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination-index')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination({    customnav:1});
    });
})(jQuery);