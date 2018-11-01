<?php
//Просмотр категорий
function Show_services_cats()
{
    $tableName = "services";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));


    ?>
    <script>
        $(document).ready(function () {
            $(".public-menu").click(function () {
                var id = $(this).attr("idmenu");
                var OBJ = $(this);

                var post = 'updateservices=' + id;
                $.post("", post, function (theResponse) {

                    OBJ.html(theResponse);
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(function () {
            $("#list1 tbody").sortable({ update: function () {

                var order = $(this).sortable("serialize") + '&update=updateservices';
                $.post("", order, function (theResponse) {

                });
            }
            });
        });
    </script>
    <?


    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Услуги (' . $count[0] . ')  <a href="index.php?page=add_services_cats" class="event-button">Добавить услугу</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0" id="list1">
			<thead>
				<tr>
    				
                    <th style="min-width:160px;">Имя меню</th>
                    <th>URL</th>
                    <th style="min-width:205px;">Title (Meta_d)</th>
                    <th style="min-width:185px;">H1 (Small_desc)</th>
					<th style="min-width:185px;">Текст</th>
                    <th style="min-width:90px;">Вкл/Выкл</th>
                    <th>Тип</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_cats";
    $page = $_GET["num"];
    $result = mysql_query("SELECT COUNT(*) FROM  `$tableName` WHERE `parent`=0");
    $posts = mysql_result($result, 0);

    $total = intval(($posts - 1) / $num) + 1;
    $page = intval($page);

    if (empty($page) or $page < 0) {
        $page = 1;
    }
    if ($page > $total) {
        $page = $total;
    }
    $start = $page * $num - $num;

    $query = mysql_query("SELECT * FROM `$tableName` WHERE `parent`=0 ORDER by position LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {

    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {


            if($postrow[$i]["public"])
            {
                $public1 = "<b class='on'>Вкл</b>/Выкл";
            }else{
                $public1 = "Вкл/<b class='off'>Выкл</b>";
            }


            if($postrow[$i]["type_text"])
            {
                $type_text = "style='opacity:0.3;'";
            }else{
                $type_text = "";
            }

            switch($postrow[$i]["type"])
            {
                case "0": $type1 = "<b style='color:#00278c;'>БД</b>";break;
                case "1": $type1 = "<b style='color:#008c2e;'>БД-Файл</b>";break;
                case "2": $type1 = "<b style='color:#8c0000;'>Файл</b>";break;
            }

            if( $postrow[$i]["public"]==0)
            {
                $opacity1 = "opacity:0.2;";
            }else{
                $opacity1 ="";
            }

			if(!empty($postrow[$i]["small_desc"])) {$textbold = 'style="background:#FFEBB7"';} else {$textbold = '';}
			if(!empty($postrow[$i]["meta_d"])) {$meta_d_bold = 'style="background:#FFEBB7"';} else {$meta_d_bold = '';}
			$text = strip_tags($postrow[$i]["desc"]);
			$text = mb_substr(trim($text),0,50,'UTF-8');

            echo '<tr  id="position_' . $postrow[$i]["id"] . '" style="font-size:13px; background:#FCDCDC;'.$opacity1.'">
            
            <td '.$type_text.'><a  href="index.php?page=edit_services_cats&id=' . $postrow[$i]["id"] . '" style="font-weight:bold">' . $postrow[$i]["menu"] . '</a></td>
            <td class="urloverflow150"><a  href="index.php?page=edit_services_cats&id=' . $postrow[$i]["id"] . '">' . $postrow[$i]["url"] . '</a></td>
            <td '.$meta_d_bold.'>' . $postrow[$i]["title"] . '</td>
             <td '.$textbold.'>' . $postrow[$i]["h1"] . '</td>
			 <td>' . $text . '</td>
            <td><span idmenu="'.$postrow[$i]["id"].'" class="public-menu">'.$public1.'</span></td>
            <td>'.$type1.'</td>
           
            <!--<td align="center"><a  href="index.php?page=edit_services_cats&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>-->
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_services_cats=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';

            $QC1 = mysql_query("SELECT * FROM `services` WHERE `parent`='".$postrow[$i]["id"]."' order by position" );
            $RC1 = mysql_fetch_array($QC1);
            do{
                if($RC1){


                    if($RC1["public"])
                    {
                        $public2 = "<b class='on'>Вкл</b>/Выкл";
                    }else{
                        $public2 = "Вкл/<b class='off'>Выкл</b>";
                    }
					if(!empty($RC1["small_desc"])) {$textbold = 'style="background:#FFEBB7"';} else {$textbold = '';}
					if(!empty($RC1["meta_d"])) {$meta_d_bold = 'style="background:#FFEBB7"';} else {$meta_d_bold = '';}
					$text = strip_tags($RC1["desc"]);
					$text = mb_substr(trim($text),0,50,'UTF-8');


                    switch($RC1["type"])
                    {
                        case "0": $type2 = "<b style='color:#00278c;'>БД</b>";break;
                        case "1": $type2= "<b style='color:#008c2e;'>БД-Файл</b>";break;
                        case "2": $type1 = "<b style='color:#8c0000;'>Файл</b>";break;
                    }

                    if( $RC1["public"]==0)
                    {
                        $opacity2 = "opacity:0.2";
                    }else{
                        $opacity2="";
                    }

                    echo '<tr id="position_' .$RC1["id"] . '" style="font-size:11px !important; background:#E0F8EE;'.$opacity2.'">
           
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_services_cats&id=' . $RC1["id"] . '">' . $RC1["menu"] . '</a></td>  
            <td class="urloverflow150">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_services_cats&id=' . $RC1["id"] . '">' . $RC1["url"] . '</a></td>
            <td '.$meta_d_bold.'>' . $RC1["title"] . '</td>
            <td '.$textbold.'>' . $RC1["h1"] . '</td>
			<td>' . $text . '</td>
            			<td><span idmenu="'.$RC1["id"].'" class="public-menu">'.$public2.'</span></td>
            			<td>'.$type2.'</td>

            <!--<td align="center"><a  href="index.php?page=edit_services_cats&id=' . $RC1["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>-->
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_services_cats=' . $RC1["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';



                    $QC2 = mysql_query("SELECT * FROM `services` WHERE `parent`='".$RC1["id"]."' order by position");
                    $RC2 = mysql_fetch_array($QC2);
                    do{
                        if($RC2){


                            if($RC2["public"])
                            {
                                $public3 = "<b class='on'>Вкл</b>/Выкл";
                            }else{
                                $public3 = "Вкл/<b class='off'>Выкл</b>";
                            }

                            switch($RC2["type"])
                            {
                                case "0": $type3 = "<b style='color:#00278c;'>БД</b>";break;
                                case "1": $type3= "<b style='color:#008c2e;'>БД-Файл</b>";break;
                                case "2": $type3 = "<b style='color:#8c0000;'>Файл</b>";break;
                            }

                            if(!empty($RC2["small_desc"])) {$textbold = 'style="background:#FFEBB7"';} else {$textbold = '';}
							if(!empty($RC2["meta_d"])) {$meta_d_bold = 'style="background:#FFEBB7"';} else {$meta_d_bold = '';}
							$text = strip_tags($RC2["desc"]);
							$text = mb_substr(trim($text),0,50,'UTF-8');

                            if( $RC2["public"]==0)
                            {
                                $opacity3 = "opacity:0.2";
                            }else{
                                $opacity3="";
                            }

                            echo '<tr id="position_' .$RC2["id"] . '" style="font-size:9px; background:#FFF5DD;'.$opacity3.'">
            
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_services_cats&id=' . $RC2["id"] . '"><i>' . $RC2["menu"] . '</i></a></td>            <td class="urloverflow150">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_services_cats&id=' . $RC2["id"] . '"><i>' . $RC2["url"] . '</i></a></td>
            <td '.$meta_d_bold.'>' . $RC2["title"] . '</td>
            <td '.$textbold.'>' . $RC2["h1"] . '</td>
			<td>' . $text . '</td>
                        			<td><span idmenu="'.$RC2["id"].'" class="public-menu">'.$public3.'</span></td>
                        			<td>'.$type3.'</td>

            <!--<td align="center"><a  href="index.php?page=edit_services_cats&id=' . $RC2["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>-->
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_services_cats=' . $RC2["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';







                        }
                    }while($RC2 = mysql_fetch_array($QC2));






                }
            }while($RC1 = mysql_fetch_array($QC1));


        }
    }


    echo '
			</tbody>
			</table>
            <!--<input type="submit" name="delete_pages" style="float:left;margin-left:15px;" value="Удалить"><br />-->
            </form>
			</div>
		</div>
		</article>';

    if ($page != 1) {
        $pervpage
            = '<li><a href="index.php?page=' . $pg . '&num=1"><<<</a> <a href="index.php?page=' . $pg . '&num=' . ($page
                - 1)
            . '"> < </a></li>';
    }
    if ($page != $total) {
        $nextpage
            = '<li><a href="index.php?page=' . $pg . '&num=' . ($page + 1) . '"> > </a> <a href= "index.php?page=' . $pg
            . '&num=' . $total . '"> >>> </a></li>';
    }

    if ($page - 8 > 0) {
        $page8left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 8) . '">' . ($page - 8) . '</a> </li> ';
    }
    if ($page - 7 > 0) {
        $page7left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 7) . '">' . ($page - 7) . '</a> </li> ';
    }
    if ($page - 6 > 0) {
        $page6left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 6) . '">' . ($page - 6) . '</a> </li> ';
    }
    if ($page - 5 > 0) {
        $page5left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 5) . '">' . ($page - 5) . '</a> </li> ';
    }
    if ($page - 4 > 0) {
        $page4left
            = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 4) . '">' . ($page - 4) . '</a> </li> ';
    }
    if ($page - 3 > 0) {
        $page3left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 3) . '">' . ($page - 3) . '</a></li> ';
    }
    if ($page - 2 > 0) {
        $page2left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 2) . '">' . ($page - 2) . '</a> </li>';
    }
    if ($page - 1 > 0) {
        $page1left = '<li> <a href= "index.php?page=' . $pg . '&num=' . ($page - 1) . '">' . ($page - 1) . '</a></li>';
    }

    if ($page + 8 <= $total) {
        $page8right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 8) . '">' . ($page + 8) . '</a></li>';
    }
    if ($page + 7 <= $total) {
        $page7right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 7) . '">' . ($page + 7) . '</a></li>';
    }
    if ($page + 6 <= $total) {
        $page6right = ' <li><a href= "index.php?page=' . $pg . '&num=' . ($page + 6) . '">' . ($page + 6) . '</a></li>';
    }
    if ($page + 5 <= $total) {
        $page5right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 5) . '">' . ($page + 5) . '</a></li>';
    }
    if ($page + 4 <= $total) {
        $page4right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 4) . '">' . ($page + 4) . '</a></li>';
    }
    if ($page + 3 <= $total) {
        $page3right = ' <li><a href= "index.php?page=' . $pg . '&num=' . ($page + 3) . '">' . ($page + 3) . '</a></li>';
    }
    if ($page + 2 <= $total) {
        $page2right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 2) . '">' . ($page + 2) . '</a></li>';
    }
    if ($page + 1 <= $total) {
        $page1right
            = ' <li> <a href= "index.php?page=' . $pg . '&num=' . ($page + 1) . '">' . ($page + 1) . '</a></li>';
    }

    if ($posts > $num) {
        echo '
<div class="page-count" align="center" style="float:Left;">
    <ul>
      ' . $pervpage . $page8left . $page7left . $page6left . $page5left . $page4left . $page3left . $page2left
            . $page1left . '<li><a href=""  class="active">' . $page . '</a></li>' . $page1right . $page2right
            . $page3right . $page4right . $page5right . $page6right . $page7right . $page8right . $nextpage . '
    </ul>
 </div>';

    }
}












//Удаление категории
if(isset($_GET["delete_services_cats"]))
{
    $id = $_GET["delete_services_cats"];
    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `services` WHERE id=$id"));
    @unlink("../".$resultCat["image"]);
    @unlink("../".str_replace("small","big",$resultCat["image"]));
    mysql_query("DELETE FROM `services` WHERE id=$id");
    mysql_query("DELETE FROM `portfolio_cat` WHERE services_id=$id");

    $_SESSION["message"] = "Категория удалена";
    echo'<script>window.location="index.php?page=show_services_cats";</script>';
    exit();

}

//Обновление публикации
if(isset($_POST["updateservices"]))
{
    $id = intval($_POST["updateservices"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `services` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `services` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `services` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}

if ($_POST['update'] == "updateservices"){
    $array	= $_POST['position'];
    $count = 1;
    foreach ($array as $idval) {
        $query = "UPDATE services SET position = " . $count . " WHERE id = " . $idval;
        mysql_query($query) or die('Ошибка');
        $count ++;
    }
    echo 'Информация сохранена!';
}