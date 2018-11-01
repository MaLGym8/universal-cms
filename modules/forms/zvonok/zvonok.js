//Вызов попапа звонка
$(".zvonok-PopUp-Open").click(function(){
    $("#zvonokformid").val($(this).attr("formid"));
    Show_Pop_Up('#zvonok_send',0);
});

//Заявка на звонок
$(".send_order_phone").click(function(){

    var name = $("#phone_name").val();
    var number = $("#phone_number").val();
    var email = $("#phone_email").val();
    var id = $("#zvonokformid").val();

    var link = location.href;
    var title = $(document).find("title").text();

    if(!number)
    {
        $("#phone_number").parent("label").css("color","red");
    }else{
        $("#phone_number").parent("label").css("color","#777");
    }



    if(number)
    {
        var r1 = new RegExp("\x27+","g");
        var r2 = new RegExp("\x22+","g");
        name = name.replace(r1, " ");
        name = name.replace(r2, " ");

        dataString = {sendformzvonok:id,name:name,number:number,email:email,link:link,title:title};
        $.ajax({
            type:"POST",
            dataType:'json',
            url:"/modules/forms/zvonok/zvonok_cender.php",
            data:dataString,
            cache:false,
            success:function(html){
                Close_Pop_Up('.PopUp');
                Show_Pop_Up(".form_zvonok_send",10000);
                SetMetrika('zvonok_form');

                $("#phone_name").val("");
                $("#phone_number").val("");
                $("#phone_email").val("");
            }
        });

    }

});
