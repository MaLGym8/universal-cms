$(document).ready(function(){



    var limitblog = 12;
    $(document).on("click",".ajaxloadblog",function(){
        var catid = $(this).attr("catid");
        limitblog = $("#limitajaxload").val();
        dataString = {ajaxloadblog:1,limit:limitblog,catid:catid};
        $.ajax({
            type: "POST",
            async:false,
            url: "/pages_include/blog/ajax.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                limitblog = limitblog + limitblog;

                $(".blog-all").append(html);




                dataString = {ajaxloadblog:1,limit:limitblog,catid:catid};
                $.ajax({
                    type: "POST",
                    async:false,
                    url: "/pages_include/blog/ajax.php",
                    data:dataString,
                    cache:false,
                    success:function(html)
                    {

                        if(!html) {
                            $(".ajaxloadblog").remove();

                            $(".blog-all").append("<br clear='all'><div class='ajax-none'>Больше записей нет</div>");
                        }

                    }
                });







            }
        });


    });


});