//Форма заявки
$(".send-order-bottom").click(function(){
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

    if(FormName=="Top" || FormName=="Интернет-магазин 1")
    {
        var fileElement = 'question_file2';
    }else{
        var fileElement  = 'question_file1';
    }

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
                url:'/modules/forms/bottom/bottom_cender.php',
                secureuri:false,
                fileElementId : fileElement,
                dataType: 'json',
                data:{sendorderbottom:1,name:Name.replace('"', "'"),number:Phone.replace('"', "'"),email:Email,message:Message.replace('"', ""),formname:FormName,site:Site,link:link,title:title,typeform:TypeForm,formelement:fileElement},
                success: function (data, status)
                {
                    Close_Pop_Up('.PopUp');
                    SetMetrika('bottom_order');
                    Form.find("input[name=name]").val("Имя");
                    Form.find("input[name=email]").val("E-mail");
                    Form.find("textarea[name=message]").val("Сообщение");
                    Form.find("input[name=phone]").val("Телефон");
                    $(".form_order_send_name").html(Name);
                    Show_Pop_Up(".form_zayavka_send_bottom",10000);
                },
                error: function (data, status, e)
                {
                    //sleep(1);
                    Close_Pop_Up('.PopUp');
                    SetMetrika('bottom_order');
                    Form.find("input[name=name]").val("Имя");
                    Form.find("input[name=email]").val("E-mail");
                    Form.find("textarea[name=message]").val("Сообщение");
                    Form.find("input[name=phone]").val("Телефон");
                    $(".form_order_send_name").html(Name);
                    Show_Pop_Up(".form_zayavka_send_bottom",10000);
                }
            }
        );

    }
});
