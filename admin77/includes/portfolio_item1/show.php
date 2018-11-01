<?php

function show_portfolio()
{
    ?>

    <script type="text/javascript">
        $(function () {
            $("#list1").sortable({ update: function () {

                var order = $(this).sortable("serialize") + '&update=updateportfolio';
                $.post("", order, function (theResponse) {

                });
            }
            });
        });
    </script>

    <?
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (isset($_POST["set_position"])) {
        $items = $_POST['portf'];
        mysql_query("UPDATE portfolio_item SET public=0 ");
        if ($items != "") {
            foreach ($items as $id) {
                mysql_query("UPDATE portfolio_item SET public=1 WHERE id=$id");
            }
        }
        echo '<script>window.location="index.php?page=show_portfolio";</script>';
    }


if (!isset($id)) {

    ?><article class="module width_full">
    <header><h3>Редактирование работ портфолио <span class="header-small">(перетаскивая, можно менять позиции)</span></h3></header>
    <div class="module_content">

        <form method="post" action="index.php?page=show_portfolio">

            <div align="center"><input onclick="window.location='index.php?page=show_portfolio_add'" type="button" class="add-image-button" value="Добавить работу в портфолио"/>

                <?

                echo'
			<form method="get" action="index.php?page=show_gallery" >
			<select onchange="this.form.submit()"  name="catsearch" style="float:right;margin-top: 15px;">
                <option value="0"';    echo'>Все категории</option>';

                $queryC1 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=0  AND `public`=1  ORDER by position ASC");
                $resultC1 = mysql_fetch_array($queryC1);

                do{
                    if($resultC1["id"]) {
                        echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;"'; if($resultC1["id"]==$_POST["catsearch"])echo'selected'; echo'>' . $resultC1["menu"] . '</option>';

                        $queryC2 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC1["id"] ."  AND `public`=1  ORDER by position ASC");
                        $resultC2 = mysql_fetch_array($queryC2);
                        do{
                            if($resultC2["id"]) {
                                echo '<option value="' . $resultC2["id"] . '" '; if($resultC2["id"]==$_POST["catsearch"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                                    . '</option>';
                                $queryC3 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC2["id"] ."  AND `public`=1  ORDER by position ASC");
                                $resultC3 = mysql_fetch_array($queryC3);
                                do{
                                    if($resultC3)
                                    {
                                        echo '<option '; if($resultC3["id"]==$_POST["catsearch"])echo'selected'; echo' value="' . $resultC3["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["menu"]
                                        . '</option>';
                                    }
                                }while($resultC3 = mysql_fetch_array($queryC3));


                            }
                        }while($resultC2 = mysql_fetch_array($queryC2));
                    }





                }while($resultC1 = mysql_fetch_array($queryC1));

                echo'
             </select></form>';

                ?>
            </div>



            <ul class="cause" id="list1">
                <?
                if(isset($_POST["catsearch"]) and $_POST["catsearch"]>0)
                {
                    $catid = $_POST["catsearch"];
                    global $db;
                    $cat = $db->read("SELECT * FROM `portfolio_cat` WHERE `id`='$catid'");
                    $query = " AND (`portfolio_cat`='$catid'" ;

                    if($cat["parent"]==0)
                    {
                        $CATS = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='$catid'");

                        if($CATS)
                        {
                            foreach($CATS as $cat)
                            {
                                $query .= " OR `portfolio_cat`='".$cat["id"]."'" ;
                            }
                        }
                    }
                    $query .= ")";
                }


                $result = mysql_query("SELECT * FROM portfolio_item WHERE `id`!=0 $query ORDER by public DESC, sort");
                if (!$result) {
                    echo "<p class='error'>Запрос на выборку данных из базы не прошёл</p>";
                }

                if (mysql_num_rows($result) > 0) {
					$COUNTALL = mysql_num_rows($result);
                    $myrow = mysql_fetch_array($result);
echo "<div style='float:left;width: 100%;font-size: 16px;'>Найдено работ: <b>$COUNTALL</b></div>";
                    do
					 {

                        if ($myrow['public'] == 1) {
                            $check = 'checked';
							$opacity = '';
                        } else {
                            $check = '';
							$opacity = 'style="opacity:0.4"';
                        }  

                        if ($myrow['public_text'] == 1) {
                            $check_text = 'checked';
							$yellow_bg = 'style="background:#FFECB9;"';
                        } else {
                            $check_text = '';
							$yellow_bg = '';
                        }


                        $cat = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE `id`='".$myrow["portfolio_cat"]."'"));
                        echo '<li id="position_' . $myrow["id"] . '" ' . $opacity . ' ' . $yellow_bg . '>
	
	<span class="name">'.$myrow["name"].'</span><br/>
	<a href="index.php?page=show_portfolio&id=' . $myrow["id"] . '">
	<div class="img"><img src="../' . $myrow["image"] . '"></div></a>
	'.$cat["menu"].'<br/>';
	
	if ($myrow["dop_text"]) echo '<span class="link"><a href="http://' . $myrow["dop_text"] . '" target="_blank">http://' . $myrow["dop_text"] . '</a></span><br />';

	
	echo '<div style="width:100%; margin:0 auto;">
	<div style="float:left"><input class="checkbox-on-off" type="checkbox" name="portf[' . $myrow["id"] . ']" value="' . $myrow["id"] . '" ' . $check . '></div>
	<div style="float:right"><input class="checkbox-on-off" type="checkbox" name="portf[' . $myrow["id"] . ']" value="' . $myrow["id"] . '" ' . $check_text . '></div>
	</div></li>';
                    } while ($myrow = mysql_fetch_array($result));
                } else {
                    echo "<p class='error'></p>";
                }
                ?>
            </ul>

            <br clear="all"><div align="center"><input type="submit" class="save-changes-button" name="set_position" value="Сохранить вкл/выкл"/></div>
        </form>
        <?
        } else {
?>

            <script>
                $(document).ready(function(){

                    var id=$("input[name='id']").val();
                    var catid=$("#gettag option:selected").val();

                    if(catid&&id)
                    {
                        dataString = {gettagbyid:id,catid:catid};
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
            </script>

            <?

            $result = mysql_query("SELECT * FROM portfolio_item WHERE id='$id'");
            $myrow = mysql_fetch_array($result);


            $link = $myrow["link"];
            echo "<article class='module width_full'>
<header><h3>Редактирование изображения портфолио</h3></header>
<div class='module_content'>";

            echo '
<form enctype="multipart/form-data" name="form"  id="forma" method="post" action="">



		<div style="float:left; width:50%;">
		<p>
			 
			 <label>Полное изображение<br>
              <input type="file" name="fullimg" style="width:70%;"/>
			  <br/><br/>
			  <img src="../' . str_replace("_thumb","_huge",$myrow["image"]) . '" width=70/>
			  <img src="../' . str_replace("_thumb","_main",$myrow["image"]) . '" width=50/>
			  <img src="../' . $myrow["image"] . '" width=30/>
             </label>
			 
			 
         </p>


		</div>





		<div style="float:right; width:50%;">
		  <p>
                        <label>Название работы<br>
                            <input value="'.$myrow["name"].'" type="text" name="description" style="width:70%;">
                        </label></p>

                    <p>
                        <label>Ссылка на сайт<br>
                            <input value="'.$myrow["dop_text"].'" type="text" name="dop_text" style="width:70%;">
                        </label>
                    </p>

                    <!--<p>
                        <label>Ссылка для IFRAME<br>
                            <input value="'.$myrow["iframe"].'" type="text" name="iframe" style="width:70%;">
                        </label>
                    </p>-->






		 <p>
           <label>Сортировка<br>
             <input value=\'' . $myrow[sort] . '\' type="text" name="sort" class="input-sort">';





            echo ' </label>
         </p>
	
        

    Категория портфолио:<br/>
        <select id="gettag" name="cat1"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=0  AND `public`=1  ORDER by position ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;"'; if($resultC1["id"]==$myrow["portfolio_cat"])echo'selected'; echo'>' . $resultC1["menu"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC1["id"] ."  AND `public`=1  ORDER by position ASC");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '" '; if($resultC2["id"]==$myrow["portfolio_cat"])echo'selected'; echo'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC2["id"] ."  AND `public`=1  ORDER by position ASC");
                    $resultC3 = mysql_fetch_array($queryC3);
                    do{
                        if($resultC3)
                        {
                            echo '<option '; if($resultC3["id"]==$myrow["portfolio_cat"])echo'selected'; echo' value="' . $resultC3["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["menu"]
                            . '</option>';
                        }
                    }while($resultC3 = mysql_fetch_array($queryC3));


                }
            }while($resultC2 = mysql_fetch_array($queryC2));
        }





    }while($resultC1 = mysql_fetch_array($queryC1));


    echo'</select> <br/>Теги:<br/><div id="tags"></div><br/>
';

if ($myrow['public'] == 1
            ) {
                echo "<span style='color:#02D702; text-decoration:underline'>Опубликованный</span>";
            } else {
                echo "<span style='color:#ff0000; text-decoration:none'>Неопубликованный</span>";
            }
            echo " <input value='1' type='checkbox' name='public'";
            if ($myrow['public'] == 1) {
                echo "checked";
            }
            echo ">";



            if ($myrow['public_text']) {
                echo "<span style='color:#02D702; text-decoration:underline;margin-left: 25px;'>Отдельная страница</span>";
            } else {
                echo "<span style='color:#ff0000; text-decoration:none;margin-left: 25px;'>Отдельная страница</span>";
            }
            echo " <input value='1' type='checkbox' name='descr' id='descr'";
            if ($myrow['public_text'] ) {
                echo "checked";
            }
            echo '><br/>
      
            </div>
                   <br clear="all">
                   
                     <div id="desc-block" style="';       if ($myrow['public_text']) {echo'display:block';}else{echo'display:none';} echo'">

                    <p>
                    <label>Title:<br>
                        <input value="'.$myrow["title"].'" type="text" name="title" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>URL:<br>
                        <input value="'.$myrow["url"].'" type="text" name="link" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>Краткое описание:<br>
                        <input value="'.$myrow["meta_d"].'" type="text" name="meta_d" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>Ключевые слова:<br>
                        <input value="'.$myrow["meta_k"].'" type="text" name="meta_k" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>H1:<br>
                        <input value="'.$myrow["h1"].'" type="text" name="h1" style="width:70%;">
                    </label>
                </p>
                   
                   
                   
                    <br clear="all">

                    Описание:<br/>
                    <textarea name="desc" value="" class="tinymce">'.$myrow["text"].'</textarea><br />
                    
                     <p>
                    <label>Дополнительные изображения: <br>
                        <input type="file" multiple name="images[]" style="width:70%;"/> </label><br />';
                        $IMAGES = explode(" ",trim($myrow["images"]));
            if($IMAGES)
            {
                foreach ($IMAGES as $Image)
                {
                    echo "<img class='delete_img' type='images' alt='$Image' src='../$Image' style='width: 100px;float:left;'/>";
                }
            }

                        echo'                   <br clear="all"/><br/><br/>
                </p>



		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/><input type="file" name="image"/><br/>';
			if ($result["background"]) {
			echo '<img width="100" class="delete_img" type="page" src="../' . $result["background"] . '" alt="' . $result["background"] . '"/><br/>'; }
			echo'</div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color" value="' . $result["background_color"] . '"/></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text" value="' . $result["background_text"] . '"/></div>				
		</div>


</div>
     

		<br clear="all">


		<input name="id" type="hidden" value="' . $myrow[id] . '">
		<input name="cat" type="hidden" value="' . $myrow[cat] . '">

         <p align="center" style="margin-top:15px; ">
           <label>
           <input type="submit" class="button save-changes" name="edit_portfolio" value="Сохранить изменения">
           </label>
         </p>


       </form>';


            echo "<div class='delete-image'><form name='delport' action='' method='post'><input name='delport' type='hidden' value='$myrow[id]'><input name='delete_portfolio' type='submit' class='delete-image-but' value='X'></form>";


        } ?>
    </div>
    <div class='clear'></div>
    </div>
</article>
    <?

}








if(isset($_POST["edit_portfolio"]))
{
    $id = $_POST["id"];
    $name = $_POST["description"];
    $dop_text = $_POST["dop_text"];
    $iframe = $_POST["iframe"];
    $position = $_POST["sort"];
    $cat = $_POST["cat1"];
    $tags = $_POST["tags"];
    $public = $_POST["public"];
    $url = $_POST["link"];
    $public_text = $_POST["descr"];
    $text = $_POST["desc"];
    $title = $_POST["title"];
    $meta_d = $_POST["meta_d"];
    $meta_k = $_POST["meta_k"];
    $h1 = $_POST["h1"];
    $background_color = $_POST["background_color"];
    $background_text = $_POST["background_text"];

    if (!$url)
    {
        if($name)
        {
            $url = translateURL($name);
        }else{

            $url = translateURL($title);
        }
    }


    $url = checkurl($url,"portfolio");

    mysql_query("UPDATE `portfolio_item` SET `title`='$title', `meta_d`='$meta_d',`meta_k`='$meta_k', `url`='$url',`name`='$name', `h1`='$h1', `text`='$text', `public_text`='$public_text', `dop_text`='$dop_text', `iframe`='$iframe', `sort`='$position', `public`='$public', `portfolio_cat`='$cat',`background_color`='$background_color', `background_text`='$background_text' WHERE `id`='$id'");

    $result_img = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_item WHERE `id`='$id'"));
    $result_cat = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_cat WHERE `id`='$cat' limit 1"));
    $dir_id = $result_img["id"];

    $url_portfolio_file = GetPathPortfolio($cat);
    @mkdir("../files/portfolio/".$url_portfolio_file."/".$result_img["url"], 0777,true);


    if($url_portfolio_file)
        $dir_name="portfolio/".$url_portfolio_file."/".$result_img["url"];
    else
        $dir_name="portfolio/".$result_img["url"];

    if($_FILES["fullimg"]['size']!= 0)
    {



        @unlink("../".$result_img["image"]);
        @unlink("../".str_replace("small","big",$result_img["image"]));

        $tmp_path = "../tmp/";
        $dir_upload = "../files/$dir_name/";

        $photo_img=$result_img["url"]."_huge".".jpg";
        $photo_img_name = $dir_upload.$photo_img;
        $name = resize($_FILES["fullimg"], 1,3000,"../tmp/");
        copy($tmp_path.$name,$photo_img_name);
        $thumb = "files/$dir_name/$photo_img";

        $photo_img=$result_img["url"]."_thumb".".jpg";
        $photo_img_name = $dir_upload.$photo_img;
        $name = resize($_FILES["fullimg"], 1,400,"../tmp/");
        copy($tmp_path.$name,$photo_img_name);
        $thumb = "files/$dir_name/$photo_img";

        $photo_img=$result_img["url"]."_main.jpg";
        $photo_img_name = $dir_upload."".$photo_img;
        $name = resize($_FILES["fullimg"], 1,1244,"../tmp/");
        copy($tmp_path.$name,$photo_img_name);
        $fullimg = "files/$dir_name/$photo_img";

        @unlink($tmp_path.$name);
        mysql_query("UPDATE portfolio_item SET image='$thumb'  WHERE id=$dir_id");


    }

    mysql_query("DELETE FROM `tags_ids` WHERE `obj_id`='$id' AND `obj_type`='image' ");
    if($tags)
    {
        foreach($tags as $tag)
        {
            mysql_query("INSERT INTO `tags_ids` (`tag_id`,`obj_id`,`obj_type`) VALUES ('$tag','$id','image')");
        }
    }

    if(trim($result_img["images"]))
    {

        $IMAGES = explode(" ", trim($result_img["images"]));
        $DOPIMG = count($IMAGES);
    }
    if($_FILES["images"]["name"])
        foreach($_FILES["images"]["name"] as $keys=>$item)
        {

            if( $_FILES["images"]['size'][$keys])
            {
                $DOPIMG++;
                $type = substr(
                    $_FILES["images"]['name'][$keys], strrpos($_FILES["images"]['name'][$keys], '.') + 1
                );
                $photo_img = $result_img["url"]. "_dop_$DOPIMG." . $type;

                $image = new CHImage();
                $image->load($_FILES["images"]['tmp_name'][$keys]);
                $image->resizeToWidth(2000);
                $image->save("../files/$dir_name/" . $photo_img);
                $photosAll .= " files/$dir_name/" . $photo_img;
            }
        }
    $photosAll = $result_img["images"]."".$photosAll;
    mysql_query("UPDATE portfolio_item SET images='$photosAll'  WHERE id=$dir_id");



    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img =$result_img["url"]. "_background." . $type;
        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/$dir_name/" . $photo_img);
        $thumb = "files/$dir_name/" .$photo_img;
        @unlink("../".$result_img["background"]);
        mysql_query("UPDATE portfolio_item SET background='$thumb'  WHERE id=$dir_id");

    }


   echo '<script>window.location="index.php?page=show_portfolio";</script>';


    exit();

}
















if(isset($_POST["delete_portfolio"]))
{
    if (isset($_POST['delport'])) {$delport = $_POST['delport'];}
    $photo = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_item WHERE id='$delport'"));
    $result = mysql_query ("DELETE FROM portfolio_item WHERE id='$delport'");
    $result = mysql_query ("DELETE FROM tags_ids WHERE obj_id='$delport'");

    $url_portfolio_file = GetPathPortfolio($photo["portfolio_cat"]);
    $dir_name="portfolio/".$url_portfolio_file."/".$photo["url"];


    @unlink("../".$photo["fullimg"]);
    @unlink("../".$photo["thumb"]);
    @unlink('../'.str_replace("_thumb","_huge",$photo["thumb"]));
    removeDirRec("../files/".$dir_name);



        echo '<script>window.location="index.php?page=show_portfolio";</script>';

}
if ($_POST['update'] == "updateportfolio"){
    $array	= $_POST['position'];
    $count = 1;
    foreach ($array as $idval) {
        $query = "UPDATE portfolio_item SET sort = " . $count . " WHERE id = " . $idval;
        mysql_query($query) or die('Ошибка');
        $count ++;
    }
    echo 'Информация сохранена!';
}