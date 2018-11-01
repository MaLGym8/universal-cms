//Слайдер с моделями
(function($) {
    $(function() {
        var jcarousel = $('.models-carusel').jcarousel({
            wrap: 'circular'
        });


var countelements = 0;

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 1100) {
                    width = width / 6;
                    countelements = 6;
			    } else if (width >= 1000) {
                    width = width / 5;
                    countelements = 5;
				} else if (width >= 768) {
                    width = width / 4;
                    countelements = 4;
			    } else if (width >= 480) {
                    width = width / 3;
                    countelements = 3;
                } else if (width >= 320) {
                    width = width / 2;
                    countelements = 2;
                }else{
                    width = width;
                    countelements = 1;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            }).jcarouselAutoscroll({





            target: '+='+countelements
        }).jcarouselSwipe({
            perSwipe: countelements
        });

       // setInterval(function(){ $('.models-carusel').jcarousel('scroll', '+=1')}, 10000);



        $('.jcarousel-pagination-models')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination();
    });
})(jQuery);