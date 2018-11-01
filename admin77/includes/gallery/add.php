<?php
require_once("../../../config.php");
include_once("../../../libs/resizeimg.php");

if (isset($_POST['link']))      {$link = $_POST['link']; if ($link == '') {unset($link);}}
if (isset($_POST['description']))        {$description = $_POST['description']; if ($description == '') {unset($description);}}
if (isset($_POST['cat']))      {$cat = $_POST['cat']; if ($cat == '') {unset($cat);}}
if (isset($_POST['sort']))      {$sort = $_POST['sort']; if ($sort == '') {unset($sort);}}
if (isset($_POST['public']))      {$public = $_POST['public']; if ($public == '') {unset($public);}}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>


<div id="main">


        
        
<div id="wrapper">

<?php 

if ($public=="on") $public = 1;
else $public = 0;


/* Здесь пишем что можно заносить информацию в базу */
$result = mysql_query ("INSERT INTO images_content (thumb,fullimg,link,description,cat,sort,public) VALUES ('$thumb','$fullimg','$link','$description','$cat','$sort','$public')");

if ($result == 'true') 
{
	$result_img = mysql_fetch_array(mysql_query("SELECT * FROM images_content ORDER by id DESC limit 1"));
	$dir_id = $result_img["id"];
	if($result_img)
	{
	if($_FILES["fullimg"]['size']!= 0)
	{

        switch($cat)
        {
            case "1":$dir_name="slider";break;
            case "2":$dir_name="gallery";break;
            case "3":$dir_name="partners";break;
            case "4":$dir_name="certificates";break;
        }
		
		$tmp_path = "../../../tmp/";
		$dir_upload = "../../../files/$dir_name/";

        $photo_img="$dir_id.jpg";
        $photo_img_name = $dir_upload."".$photo_img;
        if($cat==1)
            $name = resize($_FILES["fullimg"], 1,1920,"../../../tmp/");
        else
            $name = resize($_FILES["fullimg"], 1,900,"../../../tmp/");
        copy($tmp_path.$name,$photo_img_name);
        $fullimg = "files/$dir_name/$photo_img";

        $photo_img="$dir_id"."_thumb".".jpg";
        $photo_img_name = $dir_upload.$photo_img;
        $name = resize($_FILES["fullimg"], 1,300,"../../../tmp/");
        copy($tmp_path.$name,$photo_img_name);
        $thumb = "files/$dir_name/$photo_img";

		@unlink($tmp_path.$name);
		mysql_query("UPDATE images_content SET thumb='$thumb', fullimg='$fullimg' WHERE id=$dir_id");
	}
	}

    if($cat=="1")
        echo '<script>window.location="/admin77/index.php?page=show_sliders";</script>';
    if($cat=="2")
        echo '<script>window.location="/admin77/index.php?page=show_gallery";</script>';
    if($cat=="3")
        echo '<script>window.location="/admin77/index.php?page=show_part";</script>';
    if($cat=="4")
        echo '<script>window.location="/admin77/index.php?page=show_sert";</script>';
} 
else {
echo '<script>window.location="index.php";</script>';
}
?>

</div>


</div>
</body>
</html>