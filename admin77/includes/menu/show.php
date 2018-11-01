<?php
//Просмотр меню
function Show_Menu()
{
	
?>
<script>
    $(document).ready(function () {
        $(".public-menu").click(function () {
            var id = $(this).attr("idmenu");
            var OBJ = $(this);

            var post = 'updatemenu=' + id;
            $.post("", post, function (theResponse) {
                OBJ.html(theResponse);
            });
        });
    });
</script>
<?

    $tableName = "menu";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));
	
    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Меню (' . $count[0] . ') <span class="header-small">(меню с отступами означают вложенность)</span>  <a href="index.php?page=add_menu" class="event-button">Добавить меню</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				<th>#</th>
                    <th>Название</th>
                    <th>Ссылка</th>
                    <th>Позиция</th>
    				<th>Вкл/Выкл</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_menu";
    $page = $_GET["num"];


    $result = mysql_query("SELECT COUNT(*) FROM  `$tableName` WHERE `parent`=0 ORDER by id DESC");


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

    $query = mysql_query("SELECT * FROM `$tableName` WHERE `parent`=0 ORDER by position ASC LIMIT $start, $num");

    while ($postrow[] = mysql_fetch_array($query)) {
        ;
    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {

            if($postrow[$i]["public"])
            {
                $public1 = "<b class='on'>Вкл</b>/Выкл";
            }else{
                $public1 = "Вкл/<b class='off'>Выкл</b>";
            }

            echo '<tr ';
			 if(!$postrow[$i]["public"]) {echo 'style="opacity:0.5"';}
			echo '>
            <!--<td><input type="checkbox" name="menu['.$postrow[$i]["id"].']" value="' . $postrow[$i]["id"] . '"></td>-->
            <td>' . $postrow[$i]["id"] . '</td>
            <td><a  href="index.php?page=edit_menu&id=' . $postrow[$i]["id"] . '">' . $postrow[$i]["title"] . '</a></td>
            <td>';

            if ($postrow[$i]["link"]) {
                echo $postrow[$i]["link"];
            }elseif($postrow[$i]["page"])
            {
                $resultPage = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE `url`='".$postrow[$i]["page"]."'"));

                echo "<a href='index.php?page=edit_page&id=".$resultPage["id"]."'>".$postrow[$i]["page"]."</a>";
            }






            echo'</td>
            <td>' . $postrow[$i]["position"] . '</td>
			<td><span idmenu="'.$postrow[$i]["id"].'" class="public-menu">'.$public1.'</span></td>
			<td><a  href="index.php?page=edit_menu&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="right"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_menu=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';

            $queryParent = mysql_query("SELECT * FROM `menu` WHERE `parent`='" . $postrow[$i]["id"] . "' ORDER by position ASC");
            $resultParent = mysql_fetch_array($queryParent);
            if ($resultParent) {
                do {

                    if($resultParent["public"])
                    {
                        $public2 = "<b class='on'>Вкл</b>/Выкл";
                    }else{
                        $public2 = "Вкл/<b class='off'>Выкл</b>";
                    }

					echo '<tr ';
			 if(!$resultParent["public"]) {echo 'style="opacity:0.5"';}
			echo ' class="parent-menu">
            <!--<td><input type="checkbox" name="menu[' . $resultParent["id"] . ']" value="' . $resultParent["id"] . '"></td>-->
            <td>' . $resultParent["id"] . '</td>
            <td><a  href="index.php?page=edit_menu&id=' . $resultParent["id"] . '">' . $resultParent["title"] . '</a></td>
            <td>';


                    if ( $resultParent["link"]) {
                        echo $resultParent["link"];
                    }elseif($resultParent["page"])
                    {
                        $resultPage = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE `url`='".$resultParent["page"]."'"));
                        echo "<a href='index.php?page=edit_page&id=". $resultPage["id"]."'>". $resultParent["page"]."</a>";
                    }

                    echo'</td>  <td>' . $resultParent["position"] . '</td>
 <td>
             <span idmenu="'.$resultParent["id"].'" class="public-menu">'.$public2.'</span>
			</td>
          
            <td><a  href="index.php?page=edit_menu&id=' . $resultParent["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
           
           
			
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_menu=' . $resultParent["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
			
            </tr>';





                    /*---------------------------------------*/
                    $queryParent1 = mysql_query("SELECT * FROM `menu` WHERE `parent`='" . $resultParent["id"] . "' ORDER by position ASC");
                    $resultParent1 = mysql_fetch_array($queryParent1);
                    if ($resultParent1) {
                        do {

                            if($resultParent1["public"])
                            {
                                $public2 = "<b class='on'>Вкл</b>/Выкл";
                            }else{
                                $public2 = "Вкл/<b class='off'>Выкл</b>";
                            }

                            echo '<tr class="parent-menu2">
            <!--<td><input type="checkbox" name="menu[' . $resultParent1["id"] . ']" value="' . $resultParent1["id"] . '"></td>-->
            <td>' . $resultParent1["id"] . '</td>
            <td><a  href="index.php?page=edit_menu&id=' . $resultParent1["id"] . '">' . $resultParent1["title"] . '</a></td>
            <td>';


                            if ( $resultParent1["link"]) {
                                echo $resultParent1["link"];
                            }elseif($resultParent1["page"])
                            {
                                $resultPage1 = mysql_fetch_array(mysql_query("SELECT * FROM `pages` WHERE `url`='".$resultParent1["page"]."'"));
                                echo "<a href='index.php?page=edit_page&id=". $resultPage1["id"]."'>/page/". $resultParent1["page"]."</a>";
                            }

                            echo'</td>
            <td>' . $resultParent1["position"] . '</td>
            <td><a  href="index.php?page=edit_menu&id=' . $resultParent1["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>

            <td>
             <span idmenu="'.$resultParent1["id"].'" class="public-menu">'.$public2.'</span>
			</td>

			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_menu=' . $resultParent1["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>

            </tr>';
                        } while ($resultParent1 = mysql_fetch_array($queryParent1));

                    }
                    /*---------------------------------------*/






                } while ($resultParent = mysql_fetch_array($queryParent));

            }


            /*=========================================*/

            /*=========================================*/
        }
    }


    echo '
			</tbody>
			</table>
            <!--<input type="submit" name="delete_menu" style="float:left;margin-left:15px;" value="Удалить"><br />-->
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




//Удаление
if(isset($_GET["delete_menu"]))
{
    $id = $_GET["delete_menu"];
    mysql_query("DELETE FROM menu WHERE id=$id");
    mysql_query("DELETE FROM menu WHERE parent=$id");
    $_SESSION["message"] = "Пункт меню удален";
    echo'<script>window.location="index.php?page=show_menu";</script>';
    exit();
}
if(isset($_POST["delete_menu"]))
{
    $items = $_POST["menu"];
    foreach($items as $id)
    {
        mysql_query("DELETE FROM menu WHERE id=$id");
        mysql_query("DELETE FROM menu WHERE parent=$id");
    }
    $_SESSION["message"] = "Пункты меню удалены";
    echo'<script>window.location="index.php?page=show_menu";</script>';
    exit();
}
//Обновление публикации
if(isset($_POST["updatemenu"]))
{
    $id = intval($_POST["updatemenu"]);
    $result = mysql_fetch_array(mysql_query("SELECT * FROM `menu` WHERE id=$id"));
    if($result)
    {
        if($result["public"]==1)
        {
            mysql_query("UPDATE `menu` SET `public`=0 WHERE id=$id");
            echo "Вкл/<b class='off'>Выкл</b>";
        }else{
            mysql_query("UPDATE `menu` SET `public`=1 WHERE id=$id");
            echo "<b class='on'>Вкл</b>/Выкл";
        }

    }else{
        echo "0";
    }
    exit();

}

?>