function CheckFormCatalog()
{
    var cat = $("select[name='cat'] option:selected").val();

    if(cat==0)
    {
        alert("Укажите категрию");
        return false;
    }else{
        return true;
    }
}

function onclick_delete() {
    return confirm("Удалить?");
    
}
$(document).on("change","#descr",function(){
$("#desc-block").toggle();

});

$(document).on("change","#loadinfoservices",function(){
    var id = $(this).val();

    dataString = {loadinfoservices:id};
    $.ajax({
        type: "POST",
        async:false,
        dataType:'json',
        url: "functions.php",
        data:dataString,
        cache:false,
        success:function(html)
        {
            $("input[name='menu_portfolio']").attr("placeholder",html.menu);
            $("input[name='title_portfolio']").attr("placeholder",html.title);
            $("input[name='url_portfolio']").attr("placeholder",html.url);
            $("input[name='meta_d_portfolio']").attr("placeholder",html.meta_d);
            $("input[name='meta_k_portfolio']").attr("placeholder",html.meta_k);
            $("input[name='h1_portfolio']").attr("placeholder",html.h1);
            $("input[name='background_color_portfolio']").attr("placeholder",html.background_color);
            $("input[name='background_text_portfolio']").attr("placeholder",html.text);
        }
    });

});
$(document).on("click",".delete_img",function(){


    var type = $(this).attr("type");
    var id = $("input[name='id']").val();
    var image = $(this).attr("alt");
    $(this).remove();
    dataString = {delete_img:id,type:type,image:image};
    $.ajax({
        type: "POST",
        async:false,
        url: "functions.php",
        data:dataString,
        cache:false,
        success:function(html)
        {

        }
    });

});
$(document).on("change","#gettag",function(){
    var catid = $(this).val();

    if(catid)
    {
        dataString = {gettagbycat:catid};
        $.ajax({
            type: "POST",
            async:false,
            url: "functions.php",
            data:dataString,
            cache:false,
            success:function(html)
            {
                $("#tags").html(html);
            }
        });
    }



});


(function($) {
    $(function() {

        $('ul.tabs__caption').on('click', 'li:not(.active)', function() {
            $(this)
                .addClass('active').siblings().removeClass('active')
                .closest('div.tabs').find('div.tabs__content').removeClass('active').eq($(this).index()).addClass('active');
        });

    });
})(jQuery);

$(document).on("click",".addoptionvalue.add",function(){

    $(".options-table").append('<div class="options-table-row"><div class="width_quarter">Название:<br/><input type="text" name="options_name[]"/></div><div class="width_quarter">Изображение:<br/><input type="file" name="options_image[]"/></div><div class="width_quarter">Позиция:<br/><input type="text" name="options_position[]" placeholder="Позиция"/></div><div class="width_quarter">Публикация:<br/><input type="checkbox" name="options_public[]" value="1"/></div><div class="width_quarter"><span class="delete_icon removeoptionvalue"></span></div></div>');

});

$(document).on("click",".removeoptionvalue",function(){

    $(this).parent("div").parent("div").remove();

});
$(document).on("click",".addcalcvalue.add",function(){

    $(".calc-values").append('        <div class="calc-value">             <div class="left-value">                 <div class="calc-value-label">                     <span class="td1">Название</span>                     <span class="td2"><input type="text" name="namev[]"></span>                 </div>                  <div class="calc-value-label">                     <span class="td1">Подсказка</span>                     <span class="td2"><textarea name="tooltopv[]" ></textarea></span>                 </div>                  <div class="calc-value-label doppol">                     <span class="td1">Доп радио св-ва</span>                     <span class="td2"><input class="gray" type="text" name="dop_items[]"></span>                 </div>                  <div class="calc-value-label doppol">                     <span class="td1">HTML</span>                     <span class="td2"><textarea class="gray" name="htmlv[]"></textarea></span>                 </div>             </div>                                 <div class="right-value">                            <div class="calc-value-label ">                     <span class="td1">Цена <input class="price" type="text" name="coastv[]"></span>                 </div>  <div class="calc-value-label ">                     <span class="td1">Коэфф <input class="price" type="number" step="0.1" value="1" name="coeff[]"></span>                 </div>                  <div class="calc-value-label">                     <span class="td1">Срок <input class="srok" type="text" name="timev[]" placeholder="д/ч 8,16,24,32,40"></span>                 </div>                         <div class="calc-value-label">                 <span class="td1">Степень</span><span class="td2"><input type="checkbox" name="stepen1[]" value="1"/> <input type="checkbox" name="stepen2[]" value="1"/> <input type="checkbox" name="stepen3[]" value="1"/> <label>ИМ <select name="stepen4[]">        <option value="0">Сайт</option>        <option value="1">ИМ</option>        <option value="2">Исключить ИМ</option>    </select>    </label></span></div>                                      <span class="publclass">Публ.<br />                 <input type="checkbox" name="publicv[]" value="1"/ checked></span>                                 <div class="calc-value-label">                 <span class="td1">Кол-во <input type="checkbox" name="countv[]" value="1"/> <input class="price" type="text" name="textcountv[]"/ placeholder="текст кол-ва"></span>             </div>                                      <div class="calc-value-label">                     <span class="td1 doppole">Доп поля</span>                 </div>                                       <div class="calc-value-label doppol">                 <span class="td1">Изображение</span>                 <span class="td2"><input type="file" name="imagev[]"/></span>             </div>               <div class="calc-value-label doppol">                 <span class="td1">CSS</span>                 <span class="td2"><input class="gray" type="text" name="classv[]"/></span>             </div>                           <div class="calc-value-label deleteabs"><span class="td2"><span class="delete_icon removecalcvalue"></span></span></div>            </div>             </div>');

});
$(document).on("click",".addcalcvalue.edit",function(){

    $(".calc-values").append('  <div class="calc-value">             <div class="left-value">                 <div class="calc-value-label">                     <span class="td1">Название</span>                     <span class="td2"><input type="text" name="namev_new[]"></span>                 </div>                  <div class="calc-value-label">                     <span class="td1">Подсказка</span>                     <span class="td2"><textarea name="tooltopv_new[]" ></textarea></span>                 </div>                  <div class="calc-value-label doppol">                     <span class="td1">Доп радио св-ва</span>                     <span class="td2"><input class="gray" type="text" name="dop_items_new[]"></span>                 </div>                  <div class="calc-value-label doppol">                     <span class="td1">HTML</span>                     <span class="td2"><textarea class="gray" name="htmlv_new[]"></textarea></span>                 </div>             </div>                                 <div class="right-value">                            <div class="calc-value-label ">                     <span class="td1">Цена <input class="price" type="text" name="coastv_new[]"></span>                 </div> <div class="calc-value-label ">                     <span class="td1">Коэфф <input class="price" type="number" step="0.1" name="coeff_new[]" value="1"></span>                 </div>                   <div class="calc-value-label">                     <span class="td1">Срок <input class="srok" type="text" name="timev_new[]" placeholder="д/ч 8,16,24,32,40"></span>                 </div>                         <div class="calc-value-label">                 <span class="td1">Степень</span><span class="td2"><input type="checkbox" name="stepen1_new[]" value="1"/> <input type="checkbox" name="stepen2_new[]" value="1"/> <input type="checkbox" name="stepen3_new[]" value="1"/> <label>ИМ <select name="stepen4_new[]">        <option value="0">Сайт</option>        <option value="1">ИМ</option>        <option value="2">Исключить ИМ</option>    </select>    </label></span></div>                                      <span class="publclass">Публ.<br />                 <input type="checkbox" name="publicv_new[]" value="1"/ checked></span>                                 <div class="calc-value-label">                 <span class="td1">Кол-во <input type="checkbox" name="countv_new[]" value="1"/> <input class="price" type="text" name="textcountv_new[]"/ placeholder="текст кол-ва"></span>             </div>                                      <div class="calc-value-label">                     <span class="td1 doppole">Доп поля</span>                 </div>                                       <div class="calc-value-label doppol">                 <span class="td1">Изображение</span>                 <span class="td2"><input type="file" name="imagev_new[]"/></span>             </div>               <div class="calc-value-label doppol">                 <span class="td1">CSS</span>                 <span class="td2"><input class="gray" type="text" name="classv_new[]"/></span>             </div>                           <div class="calc-value-label deleteabs"><span class="td2"><span class="delete_icon removecalcvalue"></span></span></div>            </div>             </div>');

});


$(document).on("click",".removecalcvalue",function(){
    $(this).parent("span").parent("div").parent("div").parent("div").remove();
});


$(document).on("change","input[name='cat[]']",function(){
   if($(this).prop("checked"))
   {
        $(this).parent("label").parent("div").parent("div").find("input[name='value[]']").prop('checked', true);
        $(this).parent("label").parent("div").parent("div").find("input[name='cat[]']").prop('checked', true);
   }else{
       $(this).parent("label").parent("div").parent("div").find("input[name='value[]']").prop('checked', false);
       $(this).parent("label").parent("div").parent("div").find("input[name='cat[]']").prop('checked', false);
   }
});


$(document).on("change","input[name='item[]']",function(){
   if($(this).prop("checked"))
   {
        $(this).parent("label").parent("div").find("input[name='value[]").prop('checked', true);
        $(this).parent("label").parent("div").find("input[name='cat[]").prop('checked', true);
   }else{
       $(this).parent("label").parent("div").find("input[name='value[]']").prop('checked', false);
       $(this).parent("label").parent("div").find("input[name='cat[]']").prop('checked', false);
   }
});

$(document).on("change","input[name='selectall']",function(){
   if($(this).prop("checked"))
   {
        $(".cat1").find("input[name='cat[]']").prop('checked', true);
        $(".cat1").find("input[name='item[]']").prop('checked', true);
        $(".cat1").find("input[name='value[]']").prop('checked', true);
   }else{
       $(".cat1").find("input[name='cat[]']").prop('checked', false);
       $(".cat1").find("input[name='item[]']").prop('checked', false);
       $(".cat1").find("input[name='value[]']").prop('checked', false);
   }
});

$(document).on("click",".doppole",function(){

    $(this).parent("div").parent("div").parent("div").find(".doppol").toggle();

});


$(document).on("click",".save-value",function(){
    var OBJ = $(this).parent("div").parent("div");

    var coast = $(this).parent("div").find(".evf-coast").val();
    var time = $(this).parent("div").find(".evf-time").val();

    var stepen1 = $(this).parent("div").find(".evf-stepen1:checked").val();
    var stepen2 = $(this).parent("div").find(".evf-stepen2:checked").val();
    var stepen3 = $(this).parent("div").find(".evf-stepen3:checked").val();
    var stepen4 = $(this).parent("div").find(".evf-stepen4").val();
    var coeff = $(this).parent("div").find(".evf-coeff").val();

    var id = $(this).attr('valid');


    dataString = {savevalueid:id,coast:coast,time:time,stepen1:stepen1,stepen2:stepen2,stepen3:stepen3,stepen4:stepen4,coeff:coeff};
    $.ajax({
        type: "POST",
        async:false,
        url: "",
        data:dataString,
        cache:false,
        success:function(html)
        {
            OBJ.addClass("save");
            setTimeout(function(){OBJ.removeClass("save");},300);
        }
    });


});