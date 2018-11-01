<?php
//$idm="345";
$dom = "";
$page = $_SERVER['REQUEST_URI'];
$uid=$dom.$page;
include('config_comments.php');
include('lib/includes.php');
include('lang.php');


?>
<script Language="JavaScript">
function obj(){var rt;var b = navigator.appName;if(b == "Microsoft Internet Explorer"){var rt = new ActiveXObject("Microsoft.XMLHTTP");
}else{var rt = new XMLHttpRequest();}return rt;}
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
	if(p.statbox)document.getElementById(p.statbox).innerHTML = '<? echo templater($theme_path."wait.php", array('[#theme_path]','[#wait]'), array($theme_path,$wait_text)); ?>';
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
function gbi(id){var e = document.getElementById(id); return e;}
function rp(pid)
{
	var e = gbi("status");
	var a = gbi("pid");
	var b = gbi("buf");
	b.value=e.innerHTML;
	e.innerHTML=gbi(pid).innerHTML+'<? echo templater($theme_path."reply.php", '[#unreply]', $unreply); ?>';
	a.value=pid;
}
function unrp()
{
	var e = gbi("status");
	var a = gbi("pid");
	var b = gbi("buf");
	e.innerHTML=b.value;
	a.value='0';
}
</script>
<style>
	.comments-inner{text-align: center;}
#cs { color:#333; padding:10px;  font-family: "Open Sans",sans-serif;font-size: 15px; text-align:left; background:#FFF;display: inline-block;width: 100%;box-sizing: border-box;}
#cs a{text-decoration:none; cursor:pointer;}
#cs div.f{width:99%; float:right;}
#cs div.s{width:50%; float:left; margin-top:5px;}

#cs div.c div{clear:both; padding:10px; background: #ebeff1;position: relative  ;border-radius: 7px;padding-top: 15px;padding-bottom: 15px;}
	#cs div.c div:before{content: "";position: absolute;top:-10px;left:45px;background: url("/modules/comments_blog/themes/default/coment_bottom.png") no-repeat scroll left bottom;width: 100%;height: 10px;}
#cs div.c span.l{ float:left;height: 32px;line-height: 32px;margin-left: 10px;}
#cs div.c span.rd{ font-size:10px; position:absolute; top:5px; right:10px;}
span.r{float:right; margin:2px 0px 2px; padding:5px 15px 5px; border:1px #CCC solid; cursor:pointer; background: url(<?=$theme_path?>addtitle.png) bottom left repeat-x; color:#FFF;}
span.r:hover{color:#FF5;}
#cf { border:1px solid #CCC; margin-top:25px; padding:0px;float:left;background:#fff;}
#scf {background:#FFF;padding: 10px;box-sizing: border-box  ;}

#cf #status font.ok{ font-family: "Open Sans",sans-serif;font-size: 18px; font-weight: bold;color:green;}
#cf #status font.err{ font-family: "Open Sans",sans-serif;font-size: 18px; font-weight: bold; color:#F99;}
#cf #rules{ font-family: "Open Sans",sans-serif;font-size: 18px; font-weight: bold;  padding:5px 0px 20px;}
#cf #rules div{padding:5px 15px 5px; }
#cf textarea{border:10px solid #FFF; padding:5px; font-family: "Open Sans",sans-serif;font-size: 15px; overflow:hidden; background: url(<?=$theme_path?>areafon.png) top left no-repeat;margin-left:0px;}
#cf #name{width:49%; height:50px; float:left;font-family: "Open Sans",sans-serif;font-size: 15px; }
#cf #mail{width:49%; height:50px; float:right;font-family: "Open Sans",sans-serif;font-size: 15px; }
#cf #text {width:100%;border:1px solid #DDD; height:200px; background:#EEE;box-sizing: border-box;margin-top:2%;resize: none;background: #fff;}
.clear {clear:both;}
.add {cursor:pointer; margin:10px 0px 0px;}

	#cf .button{margin-top: 10px;float:left;margin-left:0px;}
	#cf #name, #cf #site, #cf #mail{border:1px solid #DDD;box-sizing: border-box;padding-left: 10px;}

.blog-current-comments{float:left;width: 100%;margin-top: 35px;}
.blog-current-comments .title{text-align: left;font-size: 22px;font-weight: bold;color:#444444;border-bottom: 2px solid #bbbbbb;line-height: 38px;}
.blog-current-comments .title:after{content: none;}
.blog-current-comments .title span{text-align: left;font-size: 16px;font-weight: normal;color:#444444;float:right;}



#coments .title {
	border-bottom: 2px solid #bbb;
	color: #444;
	font: bold 20px Arial;
	height: 26px;
	padding-left: 10px;
}
#coments .title .counter {
	float: right;
	font: 12px/26px Arial;
	padding-right: 10px;
}
#coments .top_row {
	padding-left: 197px;
	padding-top: 20px;
	text-align: center;
}
#coments #open-form-button {
	border: 1px solid #ccc;
	color: #444;
	cursor: pointer;
	font: bold 14px/34px Arial;
	height: 34px;
	position: relative;
	width: 200px;
}
#coments #add-comment-form {
	background: #eee none repeat scroll 0 0;
	border-bottom: 1px solid #ddd;
	border-top: 1px solid #ddd;
	height: 350px;
	margin-top: 20px;
}
#coments .repcom {
	font-size: 12px;
	line-height: 15px;
	padding: 15px 10px 5px;
}
#coments .addcoment img:hover {
	cursor: pointer;
}
#coments textarea {
	background: #fff none repeat scroll 0 0;
	border: 1px solid #ddd;
	font-size: 14px;
	height: 180px;
	margin: 10px;
	overflow: hidden;
	width: 95%;
}
#coments input[type="text"] {
	border: 1px solid #ddd;
	font-size: 15px;
	height: 25px;
	line-height: 1.8em;
	margin: 10px 5px 0 10px;
	padding-left: 10px;
	width: 33%;
}
#coments #statusbox {
	color: #888;
	font-size: 18px;
	line-height: 55px;
	padding-left: 10px;
}
#coments #add-comment-button {
	background: #292 none repeat scroll 0 0;
	border: 1px solid #ccc;
	color: #fff;
	cursor: pointer;
	float: right;
	font: bold 14px/34px Arial;
	height: 34px;
	margin-right: 15px;
	text-align: center;
	width: 160px;
}
#coments .main {
	position: relative;
}
#coments .reply {
	text-align: right;
}
#coments .reply a {
	text-decoration: none;
}
#coments .block_name {
	float:left;
	margin-left: 10px;
	line-height: 40px;
}
#coments .name {
	color: #070;
	float: left;
	font-size: 17px;
	font-weight: normal;
	height: 32px;
}
#coments .date {
	color: #555;
	float: right;
	font-size: 10px;
	right: 10px;
	top:-21px;
	position: absolute;
}
#coments img {
	float: left;
}
#coments .coment:before {

	background: rgba(0, 0, 0, 0) url("/modules/comments_blog/themes/default/coment_top.png") no-repeat scroll left top;
	position: absolute;
	width: 100%;
	height: 20px;
	top:-9px;
	left:90px;
	content: "";


}
#coments .coment {
	background: #f7f4ca;
	border-radius: 7px;
	font-size: 12px;
	padding: 6px 0 0;
	text-align: justify;
	width: 100%;
	box-sizing: border-box;
	float:left;
	position: relative;
}
#coments{width: 100%;}
#coments a{ color: #266ba8;}

#coments .coment div.bottom {

	padding: 5px 10px;
}
#coments .response {
	margin-left: 50px;
}
#coments .response .coment {
	background: #ebeff1;
	font-size: 12px;
	padding: 10px 0 0;
	text-align: justify;
	width: 520px;
}
#coments .response .coment div.bottom {
	background: rgba(0, 0, 0, 0) url("../images/response_bottom.png") no-repeat scroll left bottom;
	padding: 5px 10px;
}
#coments .sub {
	color: #888;
	font-size: 12px;
	padding: 5px;
}
#coments .else {
	background: #eee none repeat scroll 0 0;
	color: #475764;
	font-size: 20px;
	left: -9px;
	margin: 25px 0 15px;
	padding: 15px;
	position: relative;
	text-align: center;
	width: 563px;
}
#coments .else:hover {
	background: #ddd none repeat scroll 0 0;
	color: #345;
	cursor: pointer;
}

#cf{width: 570px;box-sizing: border-box;}

.block-map-form .zayavka{border:0px;padding:10px;    box-sizing: border-box;}


.block-map-form .zayavka input[type="text"]{margin-left:0px!important;}
.block-map-form .zayavka .send-order.button{width:49%;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="clear"></div>

<div class="comments-inner">
<div id="cs">
<div id="coments">
	<? parentcomments(); ?>
</div>








	<div id="cf">
	
	
	<div class="block-map-form" style="padding-top:0px;background:#fff;padding-bottom:10px;">
 


        <div class="formname">
    <span>


	<div id="status"><span class="t"><?=$addc_text?></span></div>    </span>
				
        </div>


        <div class="zayavka">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="div-name"><input type="text" id="name" onfocus="ct(this)" onblur="ct(this)" value="<?=$name_area;?>"></div>

                <div class="div-email"><input type="text" id="mail" onfocus="ct(this)" onblur="ct(this)" value="<?=$mail_area;?>"></div>

              

                <div class="div-text"><textarea id="text" onfocus="ct(this)" onblur="ct(this)"><?=$text_area?></textarea></div>


	<input type="hidden" id="uid" value="<?=$uid?>">
			<input type="hidden" id="pid" value="<?=$Page["id"];?>">
			<input type="hidden" id="buf" value="">
			<? if(isset($idm)): ?>
			<input type="hidden" id="idm" value="<?=$idm?>">
			<? endif; ?>
                <input type="button" name="send" class="send-order  button" onclick='
			ajax({
			url:"/modules/comments_blog/get_ajax.php",
			statbox:"status",
			method:"POST",
			data:
			{
			name:gbi("name").value,
			mail:gbi("mail").value,
			text:gbi("text").value,
			pid:gbi("pid").value,
			uid:gbi("uid").value
		<? if(isset($idm)): ?>
			,idm:gbi("idm").value
		<? endif; ?>
			},
			success:function(data){
				//window.location="#cf";
				gbi("status").innerHTML=data;
				}
			})' value="Оставить комментарий"> 
          
            </form>
        </div>
    </div>


	
	
	<!--
	
		<div id="status"><span class="t"><?=$addc_text?></span></div>
				<div id="rules">
					<div><?=$rules?></div>
				</div>

		<div id="scf">
			<input type="text" id="name" onfocus="ct(this)" onblur="ct(this)" value="<?=$name_area;?>">
			<input type="text"  id="mail" onfocus="ct(this)" onblur="ct(this)" value="<?=$mail_area;?>">
			<textarea id="text" onfocus="ct(this)" onblur="ct(this)"><?=$text_area?></textarea>
			<input type="hidden" id="uid" value="<?=$uid?>">
			<input type="hidden" id="pid" value="<?=$Page["id"];?>">
			<input type="hidden" id="buf" value="">
			<? if(isset($idm)): ?>
			<input type="hidden" id="idm" value="<?=$idm?>">
			<? endif; ?>
		</div>
		<input class="button" class="add" onclick='
			ajax({
			url:"/modules/comments_blog/get_ajax.php",
			statbox:"status",
			method:"POST",
			data:
			{
			name:gbi("name").value,
			mail:gbi("mail").value,
			text:gbi("text").value,
			pid:gbi("pid").value,
			uid:gbi("uid").value
		<? if(isset($idm)): ?>
			,idm:gbi("idm").value
		<? endif; ?>
			},
			success:function(data){gbi("status").innerHTML=data;}
			})' value="Отправить">-->

	</div>
</div></div>
<?

function comments_compress($buffer)
{
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}

