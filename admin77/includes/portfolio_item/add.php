<?
function  show_portfolio_Add()
{
    ?>
    <article class="module width_full">
        <header><h3>Добавление работы в портфолио</h3></header>
        <div class="module_content">


            <form enctype="multipart/form-data" name="form" id="forma" method="post" action="">


                <div style="float:left; width:50%;">
                    <p>
                        <label>Изображение<br>
                            <input type="file" name="fullimg" style="width:70%;"/>
                        </label>
                    </p>

                </div>


                <div style="float:right; width:50%;">


                    <p>
                        <label>Название работы<br>
                            <input value="" type="text" name="description" style="width:70%;">
                        </label></p>

                    <p>
                        <label>Ссылка на сайт<br>
                            <input value="" type="text" name="site_href" style="width:70%;">
                        </label>
                    </p>

                    <p>
                        <label>Ссылка для IFRAME<br>
                            <input value="" type="text" name="iframe" style="width:70%;">
                        </label>
                    </p>


                    <?
                    $sorting = mysql_query("SELECT * FROM portfolio_item ORDER by sort DESC limit 1");
                    $sort = mysql_fetch_array($sorting);
                    ?>


                    <p>
                        <label>Сортировка<br>

                            <input value="<? echo $sort['sort'] + 1; ?>" type="text" name="sort"
                                   class="input-sort">




                        </label>
                    </p>
                    <p>
                    Категория портфолио:<br/>
                    <?

                    echo '
        <select id="gettag" name="cat1"><option value="0">Выберите подкатегорию</option>';

                    $queryC1 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=0 AND `public`=1  ORDER by position ASC");
                    $resultC1 = mysql_fetch_array($queryC1);

                    do{
                        if($resultC1["id"]) {
                            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["menu"] . '</option>';

                            $queryC2 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC1["id"] ." AND `public`=1  ORDER by position ASC");
                            $resultC2 = mysql_fetch_array($queryC2);
                            do{
                                if($resultC2["id"]) {
                                    echo '<option value="' . $resultC2["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                                        . '</option>';
                                    $queryC3 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC2["id"] ." AND `public`=1  ORDER by position ASC");
                                    $resultC3 = mysql_fetch_array($queryC3);
                                    do{
                                        if($resultC3)
                                        {
                                            echo '<option value="' . $resultC3["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC3["menu"]
                                                . '</option>';
                                        }
                                    }while($resultC3 = mysql_fetch_array($queryC3));


                                }
                            }while($resultC2 = mysql_fetch_array($queryC2));
                        }





                    }while($resultC1 = mysql_fetch_array($queryC1));


                    echo'</select></p><p>
        Теги:<br/><div id="tags"></div><br/>

                   
                    </p>

                            <span style=\'color:#02D702; text-decoration:underline\'>Опубликованный</span> <input
                                type=\'checkbox\' name=\'public\' value="1" checked>

                            <span style=\'color:#02D702; text-decoration:underline;margin-left: 25px;\'>Отдельная страница</span> <input
                                type=\'checkbox\' name=\'descr\' id="descr" value="1" ><br/>





                </div>


                <br clear="all">
                <div style="float:right; width:50%;">
                    

';
                    ?>
                </div>
                <div id="desc-block" style="display: none;">
                <p>
                    <label>Title:<br>
                        <input value="" type="text" name="title" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>URL:<br>
                        <input value="" type="text" name="link" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>Краткое описание:<br>
                        <input value="" type="text" name="meta_d" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>Ключевые слова:<br>
                        <input value="" type="text" name="meta_k" style="width:70%;">
                    </label>
                </p>

                <p>
                    <label>H1:<br>
                        <input value="" type="text" name="h1" style="width:70%;">
                    </label>
                </p>

                    <br clear="all">

                    Описание:<br/>
                    <textarea name="desc" value="" class="tinymce"></textarea><br />

                <p>
                    <label>Дополнительные изображения: <br>
                        <input type="file" multiple name="images[]" style="width:70%;"/>
                    </label><br/><br/><br/>
                </p>
                <p>
                Фон (Изображение):<br/>
                <input type="file" name="image"/><br/></p>
                <p>
                Фон (Цвет):<br/>
                <input type="text" name="background_color"/><br/></p>
                <p>
                Фон (Цвет текста):<br/>
                <input type="text" name="background_text"/><br/></p>
                </div>

                <br clear="all">
                <p style="margin-top:15px; ">
                    <label>
                        <input type="hidden" name="cat" value="2"/>
                        <input type="submit" class="button button-add" name="add_portfolio" value="Добавить">
                    </label>
                </p>


            </form>

            <div class="clear"></div>
        </div>
    </article>

    <?
}








if(isset($_POST["add_portfolio"]))
{
    $name = $_POST["description"];
    $site_href = $_POST["site_href"];
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



    mysql_query ("INSERT INTO portfolio_item (title,meta_d,meta_k,url,`name`,`text`,`public_text`,`site_href`,`iframe`,`h1`,`sort`,`public`,`background_color`,`background_text`,`portfolio_cat`) VALUES ('$title','$meta_d','$meta_k','$url','$name','$text','$public_text','$site_href','$iframe','$h1','$position','$public','$background_color','$background_text','$cat')");

    $result_img = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_item ORDER by id DESC limit 1"));
    $result_cat = mysql_fetch_array(mysql_query("SELECT * FROM portfolio_cat WHERE `id`='$cat' limit 1"));
    $dir_id = $result_img["id"];


    if($tags)
    {
        foreach($tags as $tag)
        {
            mysql_query("INSERT INTO `tags_ids` (`tag_id`,`obj_id`,`obj_type`) VALUES ('$tag','$dir_id','image')");
        }
    }


    $url_portfolio_file = GetPathPortfolio($cat);
    @mkdir("../files/portfolio/".$url_portfolio_file."/".$result_img["url"], 0777,true);
    $dir_name="portfolio/".$url_portfolio_file."/".$result_img["url"];
        if($_FILES["fullimg"]['size']!= 0)
        {



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
$DOPIMG = 0;
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
    mysql_query("UPDATE portfolio_item SET images='$photosAll'  WHERE id=$dir_id");



    if ($_FILES["image"]['size'] != 0)
    {
        $type = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.') + 1);
        $photo_img =$result_img["url"]. "_background." . $type;
        $image = new CHImage();
        $image->load($_FILES['image']['tmp_name']);
        $image->save("../files/$dir_name/" . $photo_img);
        $thumb = "files/$dir_name/" .$photo_img;
        mysql_query("UPDATE portfolio_item SET background='$thumb'  WHERE id=$dir_id");
    }


    echo '<script>window.location="index.php?page=show_portfolio";</script>';
    exit();
}