<?php
//Просмотр категорий
function Show_Portfolio_Cats()
{
    $tableName = "portfolio_cat";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));


    ?>
    <script>
        $(document).ready(function () {
            $(".public-menu").click(function () {
                var id = $(this).attr("idmenu");
                var OBJ = $(this);

                var post = 'updateportfoliocat=' + id;
                $.post("", post, function (theResponse) {

                    OBJ.html(theResponse);
                });
            });
        });
    </script>


    <script type="text/javascript">
        $(function () {
            $("#list1 tbody").sortable({ update: function () {

                var order = $(this).sortable("serialize") + '&update=updateportfoliocat';
                $.post("", order, function (theResponse) {

                });
            }
            });
        });
    </script>
    <?


    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Категории портфолио (' . $count[0] . ')  <a href="index.php?page=add_portfolio_cats" class="event-button">Добавить категорию</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0" id="list1">
			<thead>
				<tr>
                    <th style="min-width:160px;">Имя меню</th>
                    <th>URL</th>
                    <th style="min-width:200px;">Title (Meta_d)</th>
                    <th style="min-width:150px;">H1 (Meta_k)</th>
					<th style="min-width:185px;">Текст</th>
                    <th style="min-width:90px;">Вкл/Выкл</th>
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

            if( $postrow[$i]["public"]==0)
            {
                $opacity = " opacity:0.5 ";
            }else{
                $opacity="";
            }
			if(!empty($postrow[$i]["meta_d"])) {$bold_meta_d = 'style="background:#FFEBB7"';} else {$bold_meta_d = '';}
			if(!empty($postrow[$i]["meta_k"])) {$bold_meta_k = 'style="background:#FFEBB7"';} else {$bold_meta_k = '';}
			$text = strip_tags($postrow[$i]["desc"]);
			$text = mb_substr(trim($text),0,50,'UTF-8');

            echo '<tr  id="position_' . $postrow[$i]["id"] . '" style="font-size:13px;'.$opacity.'">
            <td><a  href="index.php?page=edit_portfolio_cats&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["menu"] . '</b></a></td>
            <td><a  href="index.php?page=edit_portfolio_cats&id=' . $postrow[$i]["id"] . '"><b>' . $postrow[$i]["url"] . '</b></a></td>
            <td '.$bold_meta_d.'>' . $postrow[$i]["title"] . '</td>
            <td '.$bold_meta_k.'>' . $postrow[$i]["h1"] . '</td>
			<td>' . $text . '</td>
            <td><span idmenu="'.$postrow[$i]["id"].'" class="public-menu">'.$public1.'</span></td>
           
            <td align="center"><a  href="index.php?page=edit_portfolio_cats&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_portfolio_cats=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';

            $QC1 = mysql_query("SELECT * FROM `portfolio_cat` WHERE `parent`='".$postrow[$i]["id"]."' order by position" );
            $RC1 = mysql_fetch_array($QC1);
            do{
                if($RC1){


                    if($RC1["public"])
                    {
                        $public2 = "<b class='on'>Вкл</b>/Выкл";
                    }else{
                        $public2 = "Вкл/<b class='off'>Выкл</b>";
                    }

                    if( $RC1["public"]==0)
                    {
                        $opacity = " opacity:0.5 ";
                    }else{
                        $opacity="";
                    }
					if(!empty($RC1["meta_d"])) {$bold_meta_d = 'style="background:#FFEBB7"';} else {$bold_meta_d = '';}
					if(!empty($RC1["meta_k"])) {$bold_meta_k = 'style="background:#FFEBB7"';} else {$bold_meta_k = '';}
					$text = strip_tags($RC1["desc"]);
					$text = mb_substr(trim($text),0,50,'UTF-8');

                    echo '<tr id="position_' .$RC1["id"] . '" style="font-size:11px;'.$opacity.'">
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_portfolio_cats&id=' . $RC1["id"] . '">' . $RC1["menu"] . '</a></td>  
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_portfolio_cats&id=' . $RC1["id"] . '">' . $RC1["url"] . '</a></td>
            <td '.$bold_meta_d.'>' . $RC1["title"] . '</td>
            <td '.$bold_meta_k.'>' . $RC1["h1"] . '</td>
			<td>' . $text . '</td>
            			<td><span idmenu="'.$RC1["id"].'" class="public-menu">'.$public2.'</span></td>

            <td align="center"><a  href="index.php?page=edit_portfolio_cats&id=' . $RC1["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_portfolio_cats=' . $RC1["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';



                    $QC2 = mysql_query("SELECT * FROM `portfolio_cat` WHERE `parent`='".$RC1["id"]."' order by position");
                    $RC2 = mysql_fetch_array($QC2);
                    do{
                        if($RC2){


                            if($RC2["public"])
                            {
                                $public3 = "<b class='on'>Вкл</b>/Выкл";
                            }else{
                                $public3 = "Вкл/<b class='off'>Выкл</b>";
                            }
							if(!empty($RC2["meta_d"])) {$bold_meta_d = 'style="background:#FFEBB7"';} else {$bold_meta_d = '';}
							if(!empty($RC2["meta_k"])) {$bold_meta_k = 'style="background:#FFEBB7"';} else {$bold_meta_k = '';}
							$text = strip_tags($RC2["desc"]);
							$text = mb_substr(trim($text),0,50,'UTF-8');

                            echo '<tr id="position_' .$RC2["id"] . '" style="font-size:9px;">
            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_portfolio_cats&id=' . $RC2["id"] . '"><i>' . $RC2["menu"] . '</i></a></td>            <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  href="index.php?page=edit_portfolio_cats&id=' . $RC2["id"] . '"><i>' . $RC2["url"] . '</i></a></td>
            <td '.$bold_meta_d.'>' . $RC2["title"] . '</td>
            <td '.$bold_meta_k.'>' . $RC2["h1"] . '</td>
			<td>' . $text . '</td>
                        			<td><span idmenu="'.$RC2["id"].'" class="public-menu">'.$public3.'</span></td>

            <td align="center"><a  href="index.php?page=edit_portfolio_cats&id=' . $RC2["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_portfolio_cats=' . $RC2["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
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
if(isset($_GET["delete_portfolio_cats"]))
{
    $id = $_GET["delete_portfolio_cats"];
    $resultCat = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE id=$id"));
    @unlink("../".$resultCat["image"]);
    @unlink("../".str_replace("small","big",$resultCat["image"]));
    mysql_query("DELETE FROM `portfolio_cat` WHERE id=$id");
    $_SESSION["message"] = "Категория удалена";
    echo'<script>window.location="index.php?page=show_portfolio_cats";</script>';
    exit();
}

//Обновление публикации
if(isset($_POST["updateportfoliocat"]))
{
    $id = intval($_POST["updateportfoliocat"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_cat` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `portfolio_cat` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `portfolio_cat` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}

if ($_POST['update'] == "updateportfoliocat"){
    $array	= $_POST['position'];
    $count = 1;
    foreach ($array as $idval) {
        $query = "UPDATE portfolio_cat SET position = " . $count . " WHERE id = " . $idval;
        mysql_query($query) or die('Ошибка');
        $count ++;
    }
    echo 'Информация сохранена!';
}