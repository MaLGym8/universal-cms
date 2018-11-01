//Вадилация емайла
function ValidEmail(email, strict)
{
    if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}

//Показ окно
function Show_Pop_Up(id,hide){
    var marginLeft = $(window).width()/2-5-$(id).width()/2 + 'px';
    var marginTop =  $(window).height()/2-$(id).height()/2 + 'px';
    $(id).css({'left':marginLeft, 'top': marginTop});
    $(id).show();

    if(!$("#overlay").length)
        $("body").append("<div id='overlay'></div>");

    if(hide>0)
    {
        setTimeout(function(){Close_Pop_Up('.PopUp')}, hide);
    }
}

//Закрытие окна
function Close_Pop_Up(id){
    $('#overlay').remove();
    $(id).hide();

}


function SetMetrika() {

}