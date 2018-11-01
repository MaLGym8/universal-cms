function obj() {
var rt;
var b = navigator.appName;
if(b == "Microsoft Internet Explorer"){
rt = new ActiveXObject("Microsoft.XMLHTTP");
}else{
rt = new XMLHttpRequest();
}
return rt;
}
function ajax(p)
{
	var r = obj();
	m=(!p.method ? "POST" : p.method.toUpperCase());
	
	if(m=="GET")
	{
		send=null;
		p.url=p.url+"&ajax=true";
	}
	else
	{
		send="";
		for (var i in p.data) send+= i+"="+p.data[i]+"&";
		send=send+"ajax=true";
	}
	
	r.open(m, p.url, true);
	if(p.statbox)document.getElementById(p.statbox).innerHTML = '<img src="images/wait.gif">';
	r.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	r.send(send);
	r.onreadystatechange = function()
	{
		if (r.readyState == 4 && r.status == 200)
		{
			if(p.success)p.success(r.responseText);
		}
	}
}
function ct(f){if (f.defaultValue == f.value) f.value = '';else if (f.value == '') f.value = f.defaultValue;}
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