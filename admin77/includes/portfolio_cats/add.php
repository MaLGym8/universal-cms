<?php
//Добавление категории
function Add_PortfolioCat()
{
    echo '
    <article class="module width_full">
    <header><h3>Добавление категории портфолио</h3></header>
    <div class="module_content">
    <form action="" method="post" enctype="multipart/form-data">        
        
        
       

 ';

    $pos = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat`   ORDER by position DESC LIMIT 1"));
    $pos = $pos["position"]+1;
    echo'
        
        Подкатегория:<br/>
        <select name="parent"><option value="0">Выберите подкатегорию</option>';

    $queryC1 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=0 and `public`=1  ORDER by position ASC");
    $resultC1 = mysql_fetch_array($queryC1);

    do{
        if($resultC1["id"]) {
            echo '<option value="' . $resultC1["id"] . '" style="font-weight:bold;">' . $resultC1["menu"] . '</option>';

            $queryC2 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC1["id"] ." and `public`=1  ORDER by position ASC");
            $resultC2 = mysql_fetch_array($queryC2);
            do{
                if($resultC2["id"]) {
                    echo '<option value="' . $resultC2["id"] . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-' . $resultC2["menu"]
                        . '</option>';
                    $queryC3 = mysql_query("SELECT * FROM `portfolio_cat`  WHERE parent=". $resultC2["id"] ." and `public`=1  ORDER by position ASC");
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


    echo'</select>
        <br/>
        Позиция:<br/>
        <input type="text" name="position" value="'.$pos.'" style="width: 75px;"/><br />
    
    

        
        Имя меню:<br/>
        <input type="text" name="menu_portfolio" value=""/><br />
        Title:<br/>
        <input type="text" name="title_portfolio" value=""/><br />
        URL:<br/>
        <input type="text" name="url_portfolio" value=""/><br />
        Краткое описание:<br/>
        <input type="text" name="meta_d_portfolio" value=""/><br />
        Ключевые слова:<br/>
        <input type="text" name="meta_k_portfolio" value=""/><br />
        H1:<br/>
        <input type="text" name="h1_portfolio" value=""/><br />

        

        Описание:<br/>
        <textarea name="desc_portfolio" class="tinymce" value=""></textarea><br />
        
		<div class="fon_color_image">
			<div class="fon_block">Фон (Изображение):<br/>
			<input type="file" name="image"/></div>
			<div class="fon_block">Фон (Цвет#000):<br/>
			<input type="text" name="background_color"></div>
			<div class="fon_block">Цвет#000 текста на фоне:<br/>
			<input type="text" name="background_text"></div>				
		</div>
          

		
        <input type="submit" name="add_portfolio_cats" value="Добавить" >
    </form>

    <div class="clear"></div>
    </div>
    </article>';
}



//Добавление категории
if(isset($_POST["add_portfolio_cats"]))
{
    $services_id = $_POST["services_id"];
    $parent = $_POST["parent"];

    $TAGS = explode(",",$tags);
    $title_portfolio = $_POST["title_portfolio"];
    $url_portfolio = $_POST["url_portfolio"];
    $meta_d_portfolio = $_POST["meta_d_portfolio"];
    $meta_k_portfolio = $_POST["meta_k_portfolio"];
    $desc_portfolio = $_POST["desc_portfolio"];
    $menu_portfolio = $_POST["menu_portfolio"];
    $h1_portfolio = $_POST["h1_portfolio"];
    $position = $_POST["position"];

    $background_color_portfolio = mysql_real_escape_string($_POST["background_color_portfolio"]);
    $background_text_portfolio = mysql_real_escape_string($_POST["background_text_portfolio"]);

    if(!$title_portfolio)
        $title_portfolio = $menu_portfolio;


    if (!$url_portfolio)
    {
        if($menu_portfolio)
        {
            $url_portfolio = translateURL($menu_portfolio);
        }else{

            $url_portfolio = translateURL($title_portfolio);
        }
    }




    $url_portfolio = checkurl($url_portfolio,"services2");





    mysql_query("INSERT INTO `portfolio_cat` (`title`,`meta_d`,`meta_k`,`desc`,`url`,`menu`,`h1`,`services_id`,`parent`,`background`,`background_color`,`background_text`,`position`,`public`) VALUES ('$title_portfolio','$meta_d_portfolio','$meta_k_portfolio','$desc_portfolio','$url_portfolio','$menu_portfolio','$h1_portfolio','$services_id','$parent','$thumb','$background_color_portfolio','$background_text_portfolio','$position','1')");

    $lastid = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` ORDER by id DESC LIMIT 1"));
    $lastid = $lastid["id"];





    $url_portfolio_file = GetPathPortfolio($lastid);
    @mkdir("../files/portfolio/".$url_portfolio_file."", 0777,true);
    if ($_FILES["image_portfolio"]['size'] != 0)
    {
        $type = substr($_FILES['image_portfolio']['name'], strrpos($_FILES['image_portfolio']['name'], '.') + 1);
        $photo_img = md5(date('YmdHis') . rand(100, 1000)) . "." . $type;

        $image = new CHImage();


        $image->load($_FILES['image_portfolio']['tmp_name']);
        $image->save("../files/portfolio/$url_portfolio_file/big" . $photo_img);

        $thumb = "files/portfolio/$url_portfolio_file/big" .$photo_img;
    }


    mysql_query("UPDATE `portfolio_cat` SET `background`='$thumb' WHERE `id`='$lastid'");




    if($TAGS)
    {
        foreach ($TAGS as $tag)
        {
            $tag = trim($tag);
            if($tag)
            {
                mysql_query("INSERT INTO `tags` (`services_id`,`name`) VALUES ('$lastid','$tag')");
            }
        }
    }



    $_SESSION["message"] = "Категория добавлена";
    echo'<script>window.location="index.php?page=show_portfolio_cats";</script>';

}