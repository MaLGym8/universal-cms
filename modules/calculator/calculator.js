var TabId;
$(document).ready(function(){



    var FilterTab = $("#calc-tab .current").attr("filter");
    var tabid = $("#calc-tab .current").attr("tabid");

    if(tabid==1)
    {
        $("input[stepen4='1']").parent(".calculator-value").hide();
    }else{
        $("input[stepen4='1']").parent(".calculator-value").show();
    }

       dataString = {create_tab:FilterTab,tabid:tabid};
       $.ajax({
           type: "POST",
           async:false,
           dataType:'html',
           url: "/modules/calculator/create_calc_tab.php",
           data:dataString,
           cache:false,
           success:function(html)
           {
               $(".section .box").each(function(){
                    $(this).html("");
               });
               $(".tbl2").html(html);
               $(".tbl2").addClass("visible");
               $("input[type='changetab']").prop("checked",true);
               //$("input[stepen1='1']").prop("checked",true);//Влкючение по умолчанию набора
               CalcReload("maincat");

               $(".calculator-value").children("input").change(function(){
                   CalcReload("maincat");
               });

               $(".calculator-value").children(".calc-dopitems").children("input").change(function(){
                   $(this).parent("div").parent("div").children("input").prop("checked",true);
                   CalcReload("maincat");
               });

               $(".calculator-value").children("input[type='number']").keyup(function(){

                   if(parseInt($(this).val())<=0||$(this).val()=="")
                   $(this).val(1);
                   CalcReload("maincat");
               });


           }
       });

    $("#calc-tab .portfolio-cats li").click(function(){

        $(".adp-left .title").text($(this).text());

        var numbr = $(this).attr("tabid");
        if(numbr==1)
        {
            $("input[stepen4='1']").parent(".calculator-value").hide();
        }else{
            $("input[stepen4='1']").parent(".calculator-value").show();
        }

        var FilterTab = $(this).attr("filter");
        dataString = {create_tab:FilterTab,tabid:numbr};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'html',
            url: "/modules/calculator/create_calc_tab.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                $(".section .box").each(function(){
                    $(this).html("");
                });
                $(".tbl"+numbr+"").html(html);
                //$("input[stepen1='1']").prop("checked",true);//Влкючение по умолчанию набора
                CalcReload("maincat");

                $(".calculator-value").children("input").change(function(){
                    CalcReload("maincat");
                });

                $(".calculator-value").children(".calc-dopitems").children("input").change(function(){
                    $(this).parent("div").parent("div").children("input").prop("checked",true);
                    CalcReload("maincat");
                });

                $(".calculator-value").children("input[type='number']").keyup(function(){
                    CalcReload("maincat");
                });


            }
        });
    });



   // $("input[stepen1='1']").prop("checked",true);//Влкючение по умолчанию набора

    $("input[name='showtypecalc']").change(function(){
        $("input[stepen0]").prop("checked",false);
        $("input[stepen1]").prop("checked",false);
        $("input[stepen2]").prop("checked",false);
        $("input[stepen3]").prop("checked",false);
        $("input[stepen4]").prop("checked",false);
        $(".calc-dopitems input").prop("checked",false);

        var current = parseInt($(this).val());
        switch (current)
        {
            case 0:
                CalcReload();
                $("#checkbox-11").prop("checked",true);
                $("#checkbox-11").parent("div").parent("div").next(".calculator-content").slideDown();

                break;
            case 1:$("input[stepen1='1']").prop("checked",true);CalcReload();break;
            case 2:$("input[stepen2='1']").prop("checked",true);CalcReload();break;
            case 3:$("input[stepen3='1']").prop("checked",true);CalcReload();break;
            case 4:$("input[stepen4='1']").prop("checked",true);CalcReload();break;

        }

    });


    $(".calculator-right .right_button").click(function(){
        $('html,body').animate({scrollTop: $(".calculator-form").offset().top});
        return false;
    });





    $(document).on("click",".calcslideinner",function(){
        if($(this).parent("div").parent("div").children(".calculator-content").css("display")=="none")
        {
            $(this).next(".calcslideinner").addClass("rotate");
        }else{
            $(this).next(".calcslideinner").removeClass("rotate");
        }
        $(this).parent("div").parent("div").children(".calculator-content").slideToggle();
    });

    $(document).on("click",".click-blcok",function(){
        if($(this).parent("div").parent("div").children(".calculator-content").css("display")=="none")
        {
            $(this).next(".calcslideinner").addClass("rotate");
        }else{
            $(this).next(".calcslideinner").removeClass("rotate");
        }
        $(this).parent("div").parent("div").children(".calculator-content").slideToggle();
    });




    $(document).on("change","input[name='calc-cat1[]']",function(){

        //$(this).parent("div").parent("div").parent("div").children(".calculator-content").slideToggle();

        if($(this).prop("checked"))
        {

            $(this).parent("div").parent("div").parent("div").children(".calculator-content").slideToggle();


            $(this).parent("div").children("label").text("Вкл");

        }else{

            $(this).parent("div").parent("div").parent("div").children(".calculator-content").find("input").each(function(){
                $(this).prop("checked",false);
            });
            CalcReload("maincat");
            $(this).parent("div").parent("div").next(".calculator-content").slideUp();
            $(this).parent("div").children("label").text("Выкл");

        }





    });





    CalcReload();
     $(".calculator-value").children("input").change(function(){
      //   CalcReload();
     });

    $(".calculator-value").children(".calc-dopitems").children("input").change(function(){
        $(this).parent("div").parent("div").children("input").prop("checked",true);
        CalcReload("maincat");
     });

    $(document).on("keyup",".calculator-value input[type='number']",function(){
        CalcReload("maincat");
     });

    $(document).on("change",".calculator-value input",function(){

        if($(this).attr("type")=="number")
        {
            $(this).parent("div").find("input").prop("checked",true);
        }
        CalcReload("maincat");
     });





    $(".calcslideinner").each(function(){
        if($(this).parent("div").parent("div").children(".calculator-content").css("display")=="block")
        {
            $(this).addClass("rotate");
        }
    });

    $("#checkbox-11").prop("checked",true);
    $("#checkbox-11").parent("div").parent("div").next(".calculator-content").slideDown();
    $("#checkbox-11").parent("div").parent("div").find(".calcslideinner").addClass("rotate");








    //#calccat=1&calctab=2
    var lochash    = location.hash.substr(1);
    var CatId = lochash.substr(lochash.indexOf('calccat=')).split('&')[0].split('=')[1];
    TabId = lochash.substr(lochash.indexOf('calctab=')).split('&')[0].split('=')[1];

    if(!CatId)CatId = $("#calccat").val();
    if(!TabId)TabId = $("#calctab").val();
    if(!TabId)TabId=2;


    if(TabId==1)
    {
        $("input[stepen4='1']").parent(".calculator-value").hide();
    }else{
        $("input[stepen4='1']").parent(".calculator-value").show();
    }
    if(TabId==2)
    {
        $("input[name='changetab']").prop("checked",true);

    }else{
        $("input[name='changetab']").prop("checked",false);

    }


    $("input[name='changetab']").change(function(){

        if($(this).prop("checked")==true)
        {
            $("input[name='changetab']").prop("checked",true);
            window.location="#calctab=2";
            TabId=2;
        }else{
            $("input[name='changetab']").prop("checked",false);

            window.location="#calctab=1";
            TabId=1;
        }


        if(TabId)
        {
            dataString = {create_tab: $("li[tabid='"+TabId+"']").attr("filter"),tabid:TabId};
            $.ajax({
                type: "POST",
                async:false,
                dataType:'html',
                url: "/modules/calculator/create_calc_tab.php",
                data:dataString,
                cache:false,
                success:function(html)
                {
                    $(".section .box").each(function(){
                        $(this).html("");
                        $(this).removeClass("visible");
                    });
                    $("#calc-tab li").removeClass("current");
                    $(".tbl"+TabId+"").html(html);
                    $(".tbl"+TabId+"").addClass("visible");
                    $(".portfolio-cats.list li[tabid='"+TabId+"']").addClass("current");
                    //$("input[stepen1='1']").prop("checked",true);//Влкючение по умолчанию набора
                    CalcReload("maincat");

                    $(".calculator-value").children("input").change(function(){
                        CalcReload("maincat");
                    });

                    $(".calculator-value").children(".calc-dopitems").children("input").change(function(){
                        $(this).parent("div").parent("div").children("input").prop("checked",true);
                        CalcReload("maincat");
                    });

                    $(".calculator-value").children("input[type='number']").keyup(function(){
                        CalcReload("maincat");
                    });
                    if( $(".portfolio-cats.list li[tabid='"+TabId+"']").length)
                        $('html,body').animate({scrollTop: $(".portfolio-cats.list li[tabid='"+TabId+"']").offset().top-450}); /**/



                }
            });
        }

    });

   

    if(TabId)
    {
        dataString = {create_tab: $("li[tabid='"+TabId+"']").attr("filter"),tabid:TabId};
        $.ajax({
            type: "POST",
            async:false,
            dataType:'html',
            url: "/modules/calculator/create_calc_tab.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                $(".section .box").each(function(){
                    $(this).html("");
                    $(this).removeClass("visible");
                });
                $("#calc-tab li").removeClass("current");
                $(".tbl"+TabId+"").html(html);
                $(".tbl"+TabId+"").addClass("visible");
                $(".portfolio-cats.list li[tabid='"+TabId+"']").addClass("current");
                //$("input[stepen1='1']").prop("checked",true);//Влкючение по умолчанию набора
                CalcReload("maincat");

                $(".calculator-value").children("input").change(function(){
                    CalcReload("maincat");
                });

                $(".calculator-value").children(".calc-dopitems").children("input").change(function(){
                    $(this).parent("div").parent("div").children("input").prop("checked",true);
                    CalcReload("maincat");
                });

                $(".calculator-value").children("input[type='number']").keyup(function(){
                    CalcReload("maincat");
                });
if( $(".portfolio-cats.list li[tabid='"+TabId+"']").length)
        $('html,body').animate({scrollTop: $(".portfolio-cats.list li[tabid='"+TabId+"']").offset().top-450}); /**/



            }
        });
    }else if(CatId)
    {
        $("input[name='calc-cat1[]']").prop("checked",false);
        $(".calculator-content").hide();
        $(".calcslideinner").removeClass("rotate");

        $(".calculator-cat-inner[calccatid='"+CatId+"']").find("input[name='calc-cat1[]']").prop("checked",true);
        $(".calculator-cat-inner[calccatid='"+CatId+"']").find(".calculator-content").show();
        $(".calculator-cat-inner[calccatid='"+CatId+"']").find(".calcslideinner").addClass("rotate");

        $('html,body').animate({scrollTop: $(".calculator-cat-inner[calccatid='"+CatId+"']").offset().top-450}); /**/

    }

















});

function CalcReload(Type1)
{

    var Coast = 0;
    var Time = 0;



    $(".calculator-value").children("input").each(function(){
        if($(this).attr("type")!="number") {
            if ($(this).prop("checked")) {
                if ($(this).parent("div").children(".calc-number").length) {
                    var number = parseInt($(this).parent("div").children(".calc-number").val());
                    Coast += parseInt($(this).attr("coast")) * number;
                    if($(this).attr("time"))
                    Time += parseFloat($(this).attr("time")) * number;
                    $(this).parent("div").children(".val-coast").children("span").html( parseInt($(this).attr("coast")) * number);
                } else {
                    if ($(this).parent("div").children(".calc-dopitems").length) {
                        var coastdop = $(this).parent("div").children(".calc-dopitems").find("input:checked").attr("coast");
                        if(coastdop==undefined)
                        {
                            $(this).parent("div").children(".calc-dopitems").find("input:first-child").prop("checked",true);
                            coastdop = $(this).parent("div").children(".calc-dopitems").find("input:checked").attr("coast");
                        }
                        Coast += parseInt($(this).attr("coast"))+parseInt(coastdop);
                        if($(this).attr("time"))

                            Time += parseFloat($(this).attr("time"));

                    }else{
                        Coast += parseInt($(this).attr("coast"));
                        if($(this).attr("time"))
                            Time += parseFloat($(this).attr("time"));
                    }

                }


            }else{
                if ($(this).parent("div").children(".calc-dopitems").length) {

                    $(this).parent("div").children(".calc-dopitems").find("input").each(function(){
                        $(this).prop("checked",false);
                    });
                }
            }
        }


    });

    if(Time<6&&Coast>0)
        Time = 6;


    $(".itog-1 span").html(Coast);
    $(".itog-2 span").html(parseInt(Time/6));

    $(".calculator-cat-inner").each(function(){
        if($(this).find("input:checked").length)
        {
            $(this).find("input[name='calc-cat1[]']").prop("checked",true);
            $(this).find("input[name='calc-cat1[]']").parent("div").children("label").text("Вкл");
        }
        var CoastInner = 0;
        var INNER = $(this);
        INNER.children(".calculator-content").find("input").each(function(){

            if($(this).prop("checked"))
            {

                if(parseInt($(this).attr("coast"))>0){
                if ($(this).parent("div").children(".calc-number").length) {
                    var number = parseInt($(this).parent("div").children(".calc-number").val());
                    CoastInner += parseInt($(this).attr("coast")) * number;
                }else{
                    CoastInner += parseInt($(this).attr("coast"));

                }
                }

            }else{

            }


        });
        INNER.children(".calculator-cat1").children(".cat-itog").children(".coast").html(CoastInner);
        if(Type1!="maincat"){
        if(CoastInner>0)
        {
            INNER.find("input[name='calc-cat1[]']").prop("checked",true);
            INNER.children(".calculator-content").slideDown();
            INNER.find("input[name='calc-cat1[]']").parent("div").children("label").text("Вкл");

        }else{
            INNER.find("input[name='calc-cat1[]']").prop("checked",false);
            INNER.children(".calculator-content").find("input").each(function(){
               $(this).prop("checked",false);
            });
            INNER.children(".calculator-content").slideUp();
            INNER.find("input[name='calc-cat1[]']").parent("div").children("label").text("Выкл");


        }}
    });

       if($(".calculator-mainhidden").height()>1000)
	$(".calculator-right").stick_in_parent();

}


////////////////////////////////////
////////////////////////////////////
////////////////////////////////////
////////////////////////////////////
////////////////////////////////////Оформление
//Форма заявки
$(document).on("click",".send-order-calculator",function(){

    var ArrayFinal = [];
    var ArrayFinalCount = [];

    $(".calculator-left").find("input[type='radio']").each(function () {
        var OBJ = $(this);
        if(OBJ.prop("checked")&&OBJ.attr("stepen1"))
        {
            var arr = [];
            arr[0] = OBJ.val();
            if(OBJ.parent("div").children(".calc-dopitems").length)
            {
                arr[1] = OBJ.parent("div").children(".calc-dopitems").find("input:checked").val();
            }

            if(OBJ.parent("div").children(".calc-number").length)
            {
                arr[2] = OBJ.parent("div").children(".calc-number").val();
            }
            ArrayFinal.push(arr);
        }
    });

    $(".calculator-left").find("input[type='checkbox']").each(function () {
        var OBJ = $(this);
        if(OBJ.prop("checked")&&OBJ.attr("stepen1"))
        {
            var arr = [];
            arr[0] = OBJ.val();
            if(OBJ.parent("div").children(".calc-dopitems").length)
            {
                arr[1] = OBJ.parent("div").children(".calc-dopitems").find("input:checked").val();
            }
            if(OBJ.parent("div").children(".calc-number").length) {
                arr[2] = OBJ.parent("div").children(".calc-number").val();
            }
                ArrayFinal.push(arr);
        }
    });














    var Error = 0;
    var Form = $(this).parent("form");

    var Name = Form.find("input[name=name]").val();
    var Site = Form.find("input[name=site]:checked").val();
    var Email = Form.find("input[name=email]").val();
    var Message = Form.find("textarea[name=message]").val();
    var Phone = Form.find("input[name=phone]").val();
    var FormName = Form.find("input[name=form-name]").val();
    var TypeForm = Form.find("input[name=form-type]").val();

    var link = location.href;
    var title = $(document).find("title").text();

    var coast = $(".itog-1 span").html();
    var time = $(".itog-2 span").html();


    if(Form.find("input[name=email]").length) {


        if (!Phone || Phone == 'Телефон') {
            if (!Email || ValidEmail(Email) != 1) {
                Form.find("input[name=email]").parent("div").addClass("ordercoast_warning");
                Error = 1;
            }
            else {
                Form.find("input[name=email]").parent("div").removeClass("ordercoast_warning");
            }
        } else {
            Form.find("input[name=email]").parent("div").removeClass("ordercoast_warning");
        }
    }else{
        if (!Phone || Phone == 'Телефон') {
            Form.find("input[name=phone]").parent("div").addClass("ordercoast_warning");
            Error = 1;
        }else{
            Form.find("input[name=phone]").parent("div").removeClass("ordercoast_warning");

        }

    }

    if(FormName=="С главной 1" || FormName=="Интернет-магазин 1")
    {
        var fileElement = 'question_file1';
    }else{
        var fileElement  = 'question_file2';
    }

    var lochash = location.hash.substr(1);
    TabId = lochash.substr(lochash.indexOf('calctab=')).split('&')[0].split('=')[1];
    if(!TabId)TabId = $("#calctab").val();
    var coastcats = new Array;
    $(".calculator-cat-inner").each(function () {
        var calccatid = $(this).attr("calccatid");
        var coast = $(this).find(".cat-itog").children(".coast").text();
        coastcats[calccatid] = coast;

    });









    if(Error==0)
    {
        $(".fileText1, .fileText2").html("Прикрепить файл");


        var r1 = new RegExp("\x27+","g");
        var r2 = new RegExp("\x22+","g");
        if(Message) {
            Message = Message.replace(r1, " ");
            Message = Message.replace(r2, " ");
        }else{
            Message = "";
        }

        if(Phone)
        {

            Phone = Phone.replace(r1, " ");
            Phone = Phone.replace(r2, " ");
        }else{
            Phone = "";
        }
        Show_Pop_Up(".upload-file",0);
        $.ajaxFileUpload
        (
            {
                url:'/modules/calculator/cender.php',
                secureuri:false,
                fileElementId : fileElement,
                dataType: 'post',
                data:{sendordercalc:1,name:Name.replace('"', "'"),number:Phone.replace('"', "'"),email:Email,message:Message.replace('"', ""),formname:FormName,site:Site,link:link,title:title,typeform:TypeForm,array:encodeURIComponent(JSON.stringify(ArrayFinal)),coast:coast,time:time,tabid:TabId,coastcats:encodeURIComponent(JSON.stringify(coastcats))},
                success: function (data, status)
                {
                  SetMetrika('calculator');
                },
                error: function (data, status, e)
                {
                    //sleep(1);
                   /* Close_Pop_Up('.PopUp');
                    SetMetrika('calculator');
                    Form.find("input[name=name]").val("");
                    Form.find("input[name=email]").val("");
                    Form.find("textarea[name=message]").val("");
                    Form.find("input[name=phone]").val("");
                    $(".form_order_send_name").html(Name);
                    Show_Pop_Up(".form_zayavka_send_calculator",10000);*/
                }
            }
        );
		
		  Close_Pop_Up('.PopUp');
                    SetMetrika('calculator');
                    Form.find("input[name=name]").val("");
                    Form.find("input[name=email]").val("");
                    Form.find("textarea[name=message]").val("");
                    Form.find("input[name=phone]").val("");
                    $(".form_order_send_name").html(Name);
                    Show_Pop_Up(".form_zayavka_send_calculator",10000);

    }
});
























/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
 */
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
    if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
            u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
            h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
        a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
        y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);


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

$(document).on("click",".action-1",function(){
    $(this).parent("div").parent("div").parent("div").find("input").prop("checked",false);CalcReload("maincat");
    return false;
});

$(document).on("click",".action-2",function(){
    $(this).parent("div").parent("div").parent("div").find("input").prop("checked",true);CalcReload("maincat");
    return false;
});

$(document).on("click",".action-3",function(){
    $(this).parent("div").parent("div").parent("div").find("input").prop("checked",false);CalcReload("maincat");
    return false;
});