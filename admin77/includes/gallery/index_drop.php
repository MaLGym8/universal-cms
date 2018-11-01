<?php
require_once("../../../config.php");
if (isset($_POST['delport'])) {$delport = $_POST['delport'];}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>


<div id="main">

		
        
        
        
        
        
<div id="wrapper">
        
        
<?php 

$photo = mysql_fetch_array(mysql_query("SELECT * FROM images_content WHERE id='$delport'"));
$result = mysql_query ("DELETE FROM images_content WHERE id='$delport'");

@unlink("../../../".$photo["fullimg"]);
@unlink("../../../".$photo["thumb"]);

$cat = $photo["cat"];
if($cat=="1")
    echo '<script>window.location="/admin77/index.php?page=show_sliders";</script>';
if($cat=="2")
    echo '<script>window.location="/admin77/index.php?page=show_gallery";</script>';
if($cat=="3")
    echo '<script>window.location="/admin77/index.php?page=show_part";</script>';
if($cat=="4")
    echo '<script>window.location="/admin77/index.php?page=show_sert";</script>';
		 
?>


</div>

</body>
</html>