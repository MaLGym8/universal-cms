function BuyProduct1(id,obj){
    var OBJ = obj.parent("div").parent("li");
    var DIVIMG = OBJ.children(".good-img-div");
    var IMG = OBJ.children(".good-img-div").children("a").children("img");


    IMG.clone().appendTo(OBJ)
        .css( {'position' : 'absolute', 'z-index' : '10000', 'left':IMG.offset()['left']+40, 'top':IMG.offset()['top']} )
        .animate({opacity: 0.05,
            left: $(".cart-top").offset()['left'],
            top: $(".cart-top").offset()['top'],
            position: 'absolute',
            width: 20}, 1000, function() {
            $(this).remove();

            if(id){
                dataString = {addtocart: id};
                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: "/libs/ajax/catalog.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        if(html.result==1)
                        {
                           // $(".cart-top").children("span").html("("+html.count+")");
                            //$(".carttable").children("tbody").html(html.cart);

                            if(!$(".cart-count").length)
                            {
                                $(".cart-more").html('<span class="cart-count"></span><span class="cart-coast"></span><a href="/cart">В корзину</a>')
                            }
                        $(".cart-count").html(html.count+" шт.");
                        $(".cart-coast").html(" на "+html.coast+"р.");

                         //   Show_Pop_Up('.cartpopup',0);

                        }else{

                        }
                    }
                });
            }

        });


return false;
}

function BuyProduct2(id,obj){
    var OBJ = obj.parent("div").parent("div");
    var DIVIMG = $(".catalog2-image");
    var IMG = $(".catalog2-image").children("a").children("img");


    IMG.clone().appendTo(DIVIMG)
        .css( {'position' : 'absolute', 'width':'300px','z-index' : '10000', 'left':IMG.offset()['left']+50, 'top':IMG.offset()['top']} )
        .animate({opacity: 0.05,
            left: $(".cart-top").offset()['left'],
            top: $(".cart-top").offset()['top'],
            position: 'absolute',
            width: 20, height:'auto'}, 1000, function() {
            $(this).remove();

            if(id){
                dataString = {addtocart: id};
                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: "/libs/ajax/catalog.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        if(html.result==1)
                        {
                            if(!$(".cart-count").length)
                            {
                                $(".cart-more").html('<span class="cart-count"></span><span class="cart-coast"></span><a href="/cart">В корзину</a>')
                            }
                            $(".cart-count").html(html.count+" шт.");
                            $(".cart-coast").html(" на "+html.coast+"р.");

                            $(".good-item").each(function(){
                                $(this).removeClass("gift-added");

                            });


                          //  Show_Pop_Up('.cartpopup',0);

                        }else{

                        }
                    }
                });
            }

        });



}

function BuyProduct3(id,obj)
{
    var OBJ = obj.parent("div").parent("li");


    var DIVIMG = OBJ.children(".good-img-div");
    var IMG = OBJ.children(".good-img-div").children("img");

    IMG.clone().appendTo(OBJ)
        .css( {'position' : 'absolute','width':'150px', 'z-index' : '10000', 'left':IMG.offset()['left']+40, 'top':IMG.offset()['top']} )
        .animate({opacity: 0.05,
            left: $(".cart-top").offset()['left'],
            top: $(".cart-top").offset()['top'],
            position: 'absolute',
            width: 20}, 1000, function() {
            //$(this).remove();

            if(id){
                dataString = {addtocart: id,gift:1};
                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: 'json',
                    url: "/libs/ajax/catalog.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        if(html.result==1)
                        {
                           // $(".cart-top").children("span").html("("+html.count+")");
                           // $(".carttable").children("tbody").html(html.cart);
                            if(!$(".cart-count").length)
                            {
                                $(".cart-more").html('<span class="cart-count"></span><span class="cart-coast"></span><a href="/cart">В корзину</a>')
                            }
                            //   Show_Pop_Up('.cartpopup',0);
                            $(".cart-count").html(html.count+" шт.");
                            $(".cart-coast").html(" на "+html.coast+"р.");
                        }else{

                        }
                    }
                });
            }

        });
return false;
}


$(document).ready(function(){

	if($("input[name='dostavka']:checked").length){
	 dataString = {adddostavka:1,coast:$("input[name='dostavka']:checked").attr("coast"),name:$("input[name='dostavka']:checked").attr("value")};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {

                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(parseFloat(html.coast))+"р.");
                $("#coastordershipping span").html(parseFloat(parseFloat(html.coast_dostavka))+"р.");

            }
        });
	}


    ////////////////////////////////Подарки
    $(".good-items.gifts .good-item").hover(function(e){
        console.log(e.clientX);
        console.log(e.clientY);
        $(this).children(".good-desc").show();
        $(this).children(".good-desc").stop().animate({opacity: 1},500);


    },function () {

        $(this).children(".good-desc").stop().animate({opacity: 0},500,function () {
            $(this).children(".good-desc").hide();
        });
    });

    $(".good-items.gifts .good-item").mousemove(function(e){
        var parentOffset = $(this).offset();
       // console.log("Y"+e.clientY);
        $(this).children(".good-desc").css("top",e.pageY-parentOffset.top);
        $(this).children(".good-desc").css("left",e.pageX-parentOffset.left+10);
    });

    ////////////////////////////////Товары-подарки
    $(".good-items.gifts-all-ul .good-item").hover(function(e){
        console.log(e.clientX);
        console.log(e.clientY);
        $(this).children(".good-desc").show();
        $(this).children(".good-desc").stop().animate({opacity: 1},500);


    },function () {

        $(this).children(".good-desc").stop().animate({opacity: 0},500,function () {
            $(this).children(".good-desc").hide();
        });
    });

    $(".good-items.gifts-all-ul .good-item").mousemove(function(e){
        var parentOffset = $(this).offset();
        $(this).children(".good-desc").css("top",e.pageY-parentOffset.top);
        $(this).children(".good-desc").css("left",e.pageX-parentOffset.left+10);
    });

    //Клик в шапке по корзине
   /* $(".cart-top").click(function(){

        dataString = {checkcart:1};
        $.ajax({
            type: "POST",
            async: false,
            dataType: 'json',
            url: "/libs/ajax/catalog.php",
            data: dataString,
            cache: false,
            success: function (html) {
                if(html.result==1)
                {
                    $(".carttable").children("tbody").html(html.cart);

                    Show_Pop_Up('.cartpopup',0);

                }else{

                }
            }
        });

    });*/

    //Подарок в корзину
    $(document).on("click",".gift-to-cart",function(e){
        var giftid = $(this).attr("giftid");
        var productid = $(this).attr("productid");
        var obj = $(this);

        if(giftid && productid)
        {
            dataString = {addgift:giftid,productid:productid};
            $.ajax({
                type: "POST",
                async:false,
                dataType:'json',
                url: "/libs/ajax/catalog.php",
                data:dataString,
                cache:false,
                success:function(html)
                {

                    $(".good-item").each(function(){
                        $(this).removeClass("gift-added");

                    });
                    obj.parent("div").parent("li").addClass("gift-added");
                }
            });
        }
        return false;
    });

    //Заказ в один клик
    $(document).on("click",".good-quick-order-button",function(e){
        var id = $(this).attr("productid");
        $("#quickorderid").val(id);
        Show_Pop_Up("#zakaz_send");
    });

    $(document).on("click","#cart-send",function(e){

        var name = $("#cart-name").val();
        var phone = $("#cart-phone").val();
        var email = $("#cart-email").val();
        var adres = $("#cart-adres").val();
        var comment = $("textarea[name='cart-comment']").val();

        var dostavka = $("input[name='dostavka']:checked").val();
        var pay = $("input[name='pay']:checked").val();
        var options="";
         $("input[name='options[]']:checked").each(function(){
             if($(this).val())
             options += $(this).val()+"\n";
        });

        var error = 0;

        if(!name){$("#cart-name").addClass("cart-error");error = 1;}else{$("#cart-name").removeClass("cart-error");}
        if(!phone){$("#cart-phone").addClass("cart-error");error = 1;}else{$("#cart-phone").removeClass("cart-error");}

        if(error==0)
        {
            dataString = {sendcart:1,name:name,phone:phone,email:email,adres:adres,comment:comment,dostavka:dostavka,pay:pay,options:options};
            $.ajax({
                type: "POST",
                async:false,
                dataType:'json',
                url: "/libs/ajax/catalog.php",
                data:dataString,
                cache:false,
                success:function(html)
                {
                  //  Show_Pop_Up(".form_zakaz_send",10000);
                    window.location = "/success";

                  //  $("input[name='cart-name']").val("");
                  //  $("input[name='cart-phone']").val("");
                  //  $("input[name='cart-email']").val("");
                   // $("input[name='cart-adres']").val("");
                   // $("textarea[name='cart-comment']").val("");
                  //  $(".cart-inner").remove();
                  //  $("body>.inner").html('<div class="cart-inner"><div class="title cart-title">Ваша корзина пуста</div></div>');
                   // window.location = "/success";



                }
            });
        }


    });
    $(document).on("change","input[name='dostavka']",function(e){


        dataString = {adddostavka:1,coast:$("input[name='dostavka']:checked").attr("coast"),name:$("input[name='dostavka']:checked").attr("value")};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {

                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(parseFloat(html.coast))+"р.");
                $("#coastordershipping span").html(parseFloat(parseFloat(html.coast_dostavka))+"р.");

            }
        });

    });

    $(document).on("click",".cart-plus-gift",function(e){



        var count = parseInt($(this).parent("div").children("input").val())+1;

        $(this).parent("div").children("input").val(count);







        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");





        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");
        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcartgift:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast_clear);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");

                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(html.coast)+"р.");


                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });


    $(document).on("click",".cart-minus-gift",function(e){


        var count = parseInt($(this).parent("div").children("input").val())-1;
        if(count<=0)
        {
            count = 1;
        }

        $(this).parent("div").children("input").val(count);







        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");


        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");
        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcartgift:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast_clear);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");
                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(html.coast)+"р.");

                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });







    $(document).on("click",".cart-plus",function(e){



        var count = parseInt($(this).parent("div").children("input").val())+1;

        $(this).parent("div").children("input").val(count);







        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");





        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");
        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcart:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast_clear);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");

                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(html.coast)+"р.");


                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });

    $(document).on("click",".cart-minus",function(e){


        var count = parseInt($(this).parent("div").children("input").val())-1;
        if(count<=0)
        {
            count = 1;
        }

        $(this).parent("div").children("input").val(count);







        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");


        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");
        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcart:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast_clear);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");
                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(html.coast)+"р.");

                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });




    $(document).on("keyup",".cart-count",function(e){

        var count = parseInt($(this).val());
        if(!count)
        {
            count = 1;
            $(this).attr("value","1");
            $(this).val("1");

        }

        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");
        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");

        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcart:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");
                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(parseFloat(dostavka)+parseFloat(html.coast))+"р.");                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });

    $(document).on("keyup",".cart-count-gift",function(e){

        var count = parseInt($(this).val());
        if(!count)
        {
            count = 1;
            $(this).attr("value","1");
            $(this).val("1");

        }

        var coast = $(this).parent("div").parent("td").parent("tr").attr("prodcoast");
        var prodid = $(this).parent("div").parent("td").parent("tr").attr("prodid");
        $(this).parent("div").parent("td").parent("tr").children(".countincart").html(coast*count+"р.");

        //$(this).parent("td").parent("tr").children(".countincart").children("b").html(coast*count+"р.");
        dataString = {changecountcartgift:prodid,count:count};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                //$(".count-tovars").html(html.count);
                $("#cartTotalPrice").html(html.coast);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");
                var dostavka = $("input[name='dostavka']:checked").attr("coast");
                $("#coastorderall span").html(parseFloat(html.coast)+"р.");                //$(".cart-coastall").children("span").html(html.coast);
            }
        });



    });






    $(document).on("click",".clear-cart",function(){

        dataString = {cartclear: 1};
        $.ajax({
            type: "POST",
            async: false,
            dataType: 'json',
            url: "/libs/ajax/catalog.php",
            data: dataString,
            cache: false,
            success: function (html) {
                if(html.result==1)
                {
                    $('#overlay').remove();
                    $(".cartpopup").hide();
                    $(".cart-count").html(html.count+" шт.");
                    $(".cart-coast").html(" на "+html.coast+"р.");
                }
            }
        });

    });

    $(document).on("click",".send-cart",function(){

        $('#overlay').remove();
        $(".cartpopup").hide();

        Show_Pop_Up('#zakaz_send',0);

    });

    $(document).on("click",".cancel-cart",function(){

        $('#overlay').remove();
        $(".cartpopup").hide();

    });
    $(document).on("click",".delete-cart",function(){
        var obj = $(this);
        var prodid = $(this).parent("td").parent("tr").attr("prodid");

        dataString = {deletecart:prodid};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                obj.parent("td").parent("tr").remove();
                $("#cartTotalPrice").html(html.coast);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");
                $("#coastorderall span").html(parseFloat(html.coast)+parseFloat(html.coast_dostavka)+"р.");
                if(html.coast==0)
                {
                    $(".cart-inner").remove();
                    $(".container>.inner").html('<div class="cart-inner"><div class="title cart-title">Ваша корзина пуста</div></div>');
                    $(".cart-more").html('Корзина пуста');
                }
            }
        });
    });

    $(document).on("click",".delete-cart-gift",function(){
        var obj = $(this);
        var prodid = $(this).parent("td").parent("tr").attr("prodid");

        dataString = {deletecartgift:prodid};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'json',
            url: "/libs/ajax/catalog.php",
            data:dataString,
            cache:false,
            success:function(html)
            {

                obj.parent("td").parent("tr").remove();
                $("#cartTotalPrice").html(html.coast);
                $(".cart-count").html(html.count+" шт.");
                $(".cart-coast").html(" на "+html.coast+"р.");                $("#coastorderall span").html(parseFloat(html.coast)+parseFloat(html.coast_dostavka)+"р.");

                if(html.coast==0)
                {
                    $(".cart-inner").remove();
                    $(".container>.inner").html('<div class="cart-inner"><div class="title cart-title">Ваша корзина пуста</div></div>');


                        $(".cart-more").html('Корзина пуста');



                }
            }
        });
    });


    $(".send_order_zakaz_quick").click(function(){

        var name = $("#zakaz_name").val();
        var number = $("#zakaz_number").val();
        var email = $("#zakaz_email").val();
        var message = $("#zakaz_message").val();
        var id = $("#quickorderid").val();

        if(!number)
        {
            $("#zakaz_number").parent("label").css("color","red");
        }else{
            $("#zakaz_number").parent("label").css("color","#777");
        }

        if(number)
        {
            var r1 = new RegExp("\x27+","g");
            var r2 = new RegExp("\x22+","g");
            name = name.replace(r1, " ");
            name = name.replace(r2, " ");

            dataString = {sendzakazquick:id,name:name,number:number,email:email,message:message};
            $.ajax({
                type:"POST",
                dataType:'json',
                url:"/libs/ajax/catalog.php",
                data:dataString,
                cache:false,
                success:function(html){
                    Close_Pop_Up('.PopUp');
                    Show_Pop_Up(".form_zakaz_send",10000);
                    $(".cart-count").html("");
                    $(".cart-coast").html("");

                    $("#zakaz_name").val("");
                    $("#zakaz_number").val("");
                    $("#zakaz_email").val("");
                    $("#zakaz_email").val("");
                }
            });

        }

    });

});
