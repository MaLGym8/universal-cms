<div id="addcoment" class="addcoment" style="display:none;">
    <form name="comment">
        <div id="statusbox">Комментарий должен быть по теме и составлен корректно!</div>
        <input id="name" type="text" name="name" value="Имя (Обязательно)" maxlength="60" onfocus="clearText(this)" onblur="clearText(this)"/>
        <input id="mail" type="text" name="mail" value="Почта (Обязательно, непубликуется)" maxlength="60" onfocus="clearText(this)" onblur="clearText(this)"/>
        <textarea id="text" name="text" onfocus="clearText(this)" onblur="clearText(this)"></textarea>
<span>
<br/><input id="nr" onClick="document.getElementById('nr').value='nerobot';" type="checkbox" name="nr"/>
<b>я не робот...</b>
</span>
        <input type="button" class="button_add"  value="Отправить" onclick='ajax({
url:"/libs/ajax/comments.php",
statbox:"statusbox",
method:"POST",
data:
	{
	   name:document.getElementById("name").value,
	   mail:document.getElementById("mail").value,
	   text:document.getElementById("text").value,
	   nr:document.getElementById("nr").value,
	   pageid:document.getElementById("pageid").value,
	},
success:function(data){document.getElementById("statusbox").innerHTML=data;}
})'
        />
    </form>
</div>