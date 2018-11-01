$(document).ready(function() {

    $('#s1-button').click(function(){
        $('#tab-anketa-2').show();
        $('#tab-anketa-1').hide();
        $('.index-ceni').hide();
        $('.container.anketa_page').css("min-height","600px");
    });
    /*$('#tab-anketa-1').click(function(){
        $('#tab-anketa-2').show(); $('#tab-anketa-1').hide();
    });*/



});

var AnketaCoast = 0;
function GetAnketaCoast()
{
    AnketaCoast = 0;
    $(".calculator-value-anketa input:checked").each(function(){
        if($(this).parent("span").children(".coast-element").length)
        {
            AnketaCoast += parseInt($(this).parent("span").children(".coast-element").html());
        }
    });
    $("#anketa-coast-all span").html(AnketaCoast);
    $("#s1-title-coast b").html(AnketaCoast);
}

$(document).on("change",".calculator-value-anketa",function(){
    $(".anketa_next_step").css("opacity","1");
    GetAnketaCoast();

});

$(document).on("click",".calculator-value-anketa input[type='text']",function(){
    $(this).parent("label").parent("span").children("input").prop("checked",true);
    $(".anketa_next_step").css("opacity","1");
    GetAnketaCoast();
});

$(document).on("click",".anketa-back",function(){
    $(this).parent("div").parent("div").parent("div").parent("div").hide();
    $(this).parent("div").parent("div").parent("div").parent("div").prev(".tab-anketa").show();
    $(".anketa_next_step").css("opacity","1");

    return false;
});


$(document).on("click",".anketa_next_step",function(){
    $(this).parent("div").parent("div").parent("div").parent("div").hide();
    $(this).parent("div").parent("div").parent("div").parent("div").next(".tab-anketa").show();
    $(".anketa_next_step").css("opacity","0.3");


});


////////////////////////////////////
////////////////////////////////////
////////////////////////////////////
////////////////////////////////////
////////////////////////////////////Оформление
//Форма заявки
$(document).on("click",".send-order-anketa",function(){


    var ArrayFinal = [];
    var ArrayFinalAnketa = [];
    var ArrayFinalAnketaQuest = [];
    var ArrayFinalCount = [];


    $(".calculator-content-anketa").find("input[type='radio']").each(function () {
        var OBJ = $(this);
        if(OBJ.prop("checked"))
        {
            var arr = [];
            arr[0] = OBJ.val();
            arr[1] = OBJ.attr("name");
            arr[2] = OBJ.parent("span").find("input[type='text']").val();
            ArrayFinalAnketa.push(arr);
        }
    });

    $(".calculator-content-anketa").find("input[type='checkbox']").each(function () {
        var OBJ = $(this);
        if(OBJ.prop("checked"))
        {
            var arr = [];
            arr[0] = OBJ.val();
            arr[1] = OBJ.attr("name");
            arr[2] = OBJ.parent("div").find("input[type='text']").val();
            ArrayFinalAnketa.push(arr);
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
                url:'/modules/anketa/cender.php',
                secureuri:false,
                fileElementId : fileElement,
                dataType: 'post',
                data:{sendordercalc:1,name:Name.replace('"', "'"),number:Phone.replace('"', "'"),email:Email,message:Message.replace('"', ""),formname:FormName,site:Site,link:link,title:title,typeform:TypeForm,arrayfinalanketa:encodeURIComponent(JSON.stringify(ArrayFinalAnketa)),ArrayFinalAnketaQuest:encodeURIComponent(JSON.stringify(ArrayFinalAnketaQuest)),anketacoast:AnketaCoast},
                success: function (data, status)
                {
                    SetMetrika('anketa');
                },
                error: function (data, status, e)
                {

                }
            }
        );

        Close_Pop_Up('.PopUp');
        SetMetrika('anketa');
        Form.find("input[name=name]").val("");
        Form.find("input[name=email]").val("");
        Form.find("textarea[name=message]").val("");
        Form.find("input[name=phone]").val("");
        $(".form_order_send_name").html(Name);
        Show_Pop_Up(".form_zayavka_send_calculator",10000);

    }
});


