function createObject(){
    var request_type;
    var browser = navigator.appName;
    if(browser == "Microsoft Internet Explorer"){
        request_type = new ActiveXObject("Microsoft.XMLHTTP");
    }else{
        request_type = new XMLHttpRequest();
    }
    return request_type;
}

function ajax(param)
{
    var req = createObject();
    method=(!param.method ? "POST" : param.method.toUpperCase());

    if(method=="GET")
    {
        send=null;
        param.url=param.url+"&ajax=true";
    }
    else
    {
        send="";
        for (var i in param.data) send+= i+"="+param.data[i]+"&";
        send=send+"ajax=true";

    }

    req.open(method, param.url, true);
    if(param.statbox)document.getElementById(param.statbox).innerHTML = '<img src="/images/wait.gif"> Пожалуйста подождите...';
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send(send);
    req.onreadystatechange = function()
    {
        if (req.readyState == 4 && req.status == 200) //если ответ положительный
        {
            if(param.success)param.success(req.responseText);
        }
    }
}

// сворачивание и разворачивание блока
function toggle(id)
{
    var e = document.getElementById(id);
    var dh = gh(id);
    var elems = e.getElementsByTagName('*');
    var flag;

    if (e.style.display == "none")
    {
        if (flag != 0)
        {
            flag = 0;
            for(var i=0; i<elems.length; i++){vhe(elems[i], "hidden");}

            e.style.height="1px";
            e.style.display = "block";
            for(var i=0;i<=100;i+=5)
            {
                (function()
                    {
                        var pos=i;
                        setTimeout(function(){e.style.height = (pos/100)*dh+1+"px";},pos*5);
                    }
                )();
            }
            setTimeout(function(){for(var i=0; i<elems.length; i++){elems[i].style.visibility="visible";}},500);
            return true;
            flag = 1;
        }
    }
    else
    {
        if (flag != 0)
        {
            flag = 0;
            var lh=dh-1+"px";

            for(var i=0; i<elems.length; i++){vhe(elems[i], "hidden");}

            for (var i=100;i>=0;i-=5)
            {
                (function()
                    {
                        var pos=i;
                        setTimeout(function()
                        {
                            e.style.height = (pos/100)*dh+"px";
                            if (pos<=0)
                            {
                                e.style.display = "none";
                                e.style.height=lh;
                            }
                        },1000-(pos*5));
                    }
                )();
            }
            return true;
            flag = 1;
        }
    }
    return false;
}

function vhe(obj, vh){obj.style.visibility=vh;}

function gh(id)
{
    var e = document.getElementById(id);
    if(e.style.display == "none")
    {
        e.style.visibility = "hidden";
        e.style.display = "block";
        dh = e.clientHeight||e.offsetHeight+5; // Высота
        e.style.display = "none";
        e.style.visibility = "visible";
    }
    else
    {
        dh = e.clientHeight||e.offsetHeight+5; // Высота
    }
    return dh;
}

function clearText(field)
{
    if(field.defaultValue == field.value)field.value = '';else if(field.value == '')field.value = field.defaultValue;
}