<?php
function Show_Calculator()
{
    global $db;
    if(isset($_POST["former"]))
    {
        $Arr[0] = $_POST["value"];
        $Arr = serialize($Arr);
    }
    //http://artweb/admin77/index.php?page=add_calculator_item
    //http://artweb/admin77/index.php?page=add_calculator_cat
    ?>
    <script type="text/javascript">
        $(function () {
            $(".cat2-2 ").sortable({ update: function () {

                var order = $(this).sortable("serialize") + '&update=updatevalueposition';
                $.post("", order, function (theResponse) {

                });
            }
            });
        });
    </script>
    <?
    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved"><a href="index.php?page=add_calculator_item" class="event-button">Добавить значение</a><a style="float:left; margin-left:0" href="index.php?page=add_calculator_cat" class="event-button">Добавить категорию</a></h3> 
		</header>
		<div class="tab_container">
		
		<div class="cat1"><textarea>'.$Arr.'</textarea></div>
		<form action="index.php?page=show_calculator" method="post">
		<label style="padding:20px 30px;float:left;width:100%;box-sizing:border-box;"><input name="selectall" type="checkbox"> <b>Выделить всё</b></label>
		';

    $CATS1 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`=0 ORDEr by POSITION  ASC");
    if($CATS1)
    {
        foreach ($CATS1 as $Cat1)
        {
            ?>
            <div class="cat1 <?if($Cat1["public"]==0){echo" public0 ";}?>" >
            <div class="row1">
             <!--1 уровень-->   <label><input type="checkbox" name="cat[]" value="<?=$Cat1["id"]?>"> <a href="index.php?page=edit_calculator_cat&id=<?=$Cat1["id"]?>"><b><?=$Cat1["name"]?></b></a></label>

                <?if($Cat1["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Cat1["tooltip"]?></div>
                    </span>
                <?endif;?>


            <div class="control-panel">
                <a href="index.php?page=edit_calculator_cat&id=<?=$Cat1["id"]?>"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a>
                <span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_calculator_cat=<?=$Cat1["id"]?>"><img src="images/icon_delete.gif"  title="Удалить"/></a></span>
            </div>

            </div>
            <?
            $Items1 = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$Cat1["id"]."' ORDER by position ASC");
            if($Items1)
            {
                foreach($Items1 as $Item1)
                {
                    ?>
                    <div class="cat2-2 <?if($Item1["public"]==0){echo" public0 ";}?>">

  <div class="row1">
               <!--2 уровень (кроме разработки сайтов)--> <label><input type="checkbox" name="cat[]" value="<?=$Item1["id"]?>"> <a href="index.php?page=edit_calculator_item&id=<?=$Item1["id"]?>"><b><?=$Item1["name"]?> <span>(<?=$Item1["type"]?>)</span></b></a></label>

                <?if($Item1["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Item1["tooltip"]?></div>
                    </span>
                <?endif;?>


            <div class="control-panel">
                <a href="index.php?page=edit_calculator_item&id=<?=$Item1["id"]?>"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a>
                <span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_calculator_item=<?=$Item1["id"]?>"><img src="images/icon_delete.gif"  title="Удалить"/></a></span>
            </div>

            </div>

                    <?


                    $Values1 = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item1["id"]."' ORDER by position ASC");
                    if($Values1)
                    {
                        foreach($Values1 as $Value1)
                        {
                            ?>
                            <div id="position_<?=$Value1["id"]?>" class="cat2-3 <?if($Value1["public"]==0){echo" public0 ";}?>"><label><input type="checkbox" name="value[]" value="<?=$Value1["id"]?>"> <?=$Value1["name"]?></label>

                                      <?if($Value1["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Value1["tooltip"]?></div>
                    </span>
                <?endif;?>

                <?php /*?><? if($Value1["coast"]):?><span class="coast"><?=$Value1["coast"];?> руб.</span><? endif;?><?php */?>
                <?if($Value1["time"]):?><span class="coast"><?=$Value1["time"]/8;?>д</span><?endif;?>
                <span class="stepen">

                <?if($Value1["stepen1"]):?><span class="stepen1"></span><?endif;?>
                <?if($Value1["stepen2"]):?><span class="stepen2"></span><?endif;?>
                <?if($Value1["stepen3"]):?><span class="stepen3"></span><?endif;?>
                <?if($Value1["stepen4"]):?><span class="stepen4"></span><?endif;?>

                </span>
                <?EditOptions($Value1);?>
                                    </div>
                            <?
                        }
                    }
  echo '</div>';
                }


            }


            $CATS2 = $db->read_all("SELECT * FROM `calculator_cats` WHERE `parent`='".$Cat1["id"]."' ORDEr by POSITION  ASC");
            if($CATS2)
            {
                foreach ($CATS2 as $Cat2)
                {
                    ?>
                    <div class="cat2 <?if($Cat2["public"]==0){echo" public0 ";}?>">


                    <div class="row1">
                <label><input type="checkbox" name="cat[]" value="<?=$Cat2["id"]?>"> 
               <!--2 уровень ЭТАПЫ--> <a href="index.php?page=edit_calculator_cat&id=<?=$Cat2["id"]?>"> <b style="font-size:20px;"><?=$Cat2["name"]?></b></a>
               </label>

                <?if($Cat2["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Cat2["tooltip"]?></div>
                    </span>
                <?endif;?>

            <div class="control-panel">
                <a href="index.php?page=edit_calculator_cat&id=<?=$Cat2["id"]?>"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a>
                <span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_calculator_cat=<?=$Cat2["id"]?>"><img src="images/icon_delete.gif"  title="Удалить"/></a></span>
            </div>

            </div>



                    <?

                    $Items2 = $db->read_all("SELECT * FROM `calculator_items` WHERE `cat_id`='".$Cat2["id"]."' ORDER by position ASC");
                    if($Items2)
                    {
                        foreach($Items2 as $Item2)
                        {
                            ?>
 <div class="cat2 <?if($Item2["public"]==0){echo" public0 ";}?>">

   <div class="row1">
               <!--3 уровень (в разработке сайтов)-->  <label><input type="checkbox" name="cat[]" value="<?=$Item2["id"]?>"> <a href="index.php?page=edit_calculator_item&id=<?=$Item2["id"]?>"> <b><?=$Item2["name"]?> <span>(<?=$Item2["type"]?>)</span></b></a></label>

                <?if($Item2["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Item2["tooltip"]?></div>
                    </span>
                <?endif;?>


            <div class="control-panel">
                <a href="index.php?page=edit_calculator_item&id=<?=$Item2["id"]?>"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a>
                <span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_calculator_item=<?=$Item2["id"]?>"><img src="images/icon_delete.gif"  title="Удалить"/></a></span>
            </div>

            </div>






                            <div class="cat2-2">
                            <?
                            $Values2 = $db->read_all("SELECT * FROM `calculator_values` WHERE `item_id`='".$Item2["id"]."' ORDER by position ASC");
                            if($Values2)
                            {
                                foreach($Values2 as $Value2)
                                {
                                    ?>
                                    <div   id="position_<?=$Value2["id"]?>" class="cat2-3 <?if($Value2["public"]==0){echo" public0 ";}?>"><label><input type="checkbox" name="value[]" value="<?=$Value2["id"]?>"> <?=$Value2["name"]?></label>

                                      <?if($Value2["tooltip"]):?>
                    <span class="help-block tooltip">?
                        <div class="tooltiptext "><?=$Value2["tooltip"]?></div>
                    </span>
                <?endif;?>

               <?php /*?> <? if($Value2["coast"]):?><span class="coast"><?=$Value2["coast"];?> руб.</span><?endif;?><?php */?>
                <? if($Value2["time"]):?><span class="coast"><?=$Value2["time"]/8;?>д</span><?endif;?>

                <?php /*?><span class="stepen">

                <? if($Value2["stepen1"]):?><span class="stepen1"></span><?endif;?>
                <? if($Value2["stepen2"]):?><span class="stepen2"></span><?endif;?>
                <? if($Value2["stepen3"]):?><span class="stepen3"></span><?endif;?>
                <? if($Value2["stepen4"]):?><span class="stepen4"></span><?endif;?>

                </span><?php */?>

                <? EditOptions($Value2);?>

                                    </div>
                                    <?
                                }
                            }




  echo '</div>';
  echo '</div>';
                        }

                    }
  echo '</div>';
                }
            }








            echo '</div>';

        }
    }


		
		echo'<div class="cat1"><br/><input type="submit" name="former" value="Сформировать"/></form></div>
		</div>
		</article>';
}

function EditOptions($Value)
{
    ?>
    <div class="edit_value_form">

    <div>
        <div class="floatleft">Цена <input type="text" placeholder="Цена" value="<?=$Value["coast"]?>" class="w50 evf-coast <? if($Value["coast"]==0):?>free<? endif;?>"/></div>
        <div class="floatleft">Срок <input type="text" placeholder="Часы" value="<?=$Value["time"]?>" class="w50 evf-time <? if(empty($Value["time"])):?>empty<? endif;?>"/></div>
        <div class="floatleft div <? if($Value["stepen1"]):?>check1<? endif;?>"><input type="checkbox" value="1" class="evf-stepen1" <?if($Value["stepen1"]==1)echo'checked'?>/></div>
        <div class="floatleft div <? if($Value["stepen2"]):?>check2<? endif;?>"><input type="checkbox" value="1" class="evf-stepen2" <?if($Value["stepen2"]==1)echo'checked'?>/></div>
        <div class="floatleft div <? if($Value["stepen3"]):?>check3<? endif;?>"><input type="checkbox" value="1" class="evf-stepen3" <?if($Value["stepen3"]==1)echo'checked'?>/></div>
        <div class="floatleft div <? if($Value["stepen4"]==1):?>check4<? endif; if($Value["stepen4"]==2):?>iskluch<? endif; ?>">

<?php /*?>ИМ <?php */?><select style="width:45px;" name="stepen4_new[]" class="evf-stepen4" >        <option value="0" <?if($Value["stepen4"]==0)echo'selected'?>>Сайт</option>        <option value="1"  <?if($Value["stepen4"]==1)echo'selected'?>>ИМ</option>        <option value="2"  <? if($Value["stepen4"]==2)echo'selected'?>>Исключить ИМ</option>    </select>



       <!-- <input type="checkbox" value="1" class="evf-stepen4" <?/*if($Value["stepen4"]==1)echo'checked'*/?>/>-->

        </div>

         <div class="floatleft div"><?php /*?>Коэфф <?php */?><input type="number" step="0.1" value="<?=$Value["coeff"]?>" class="evf-coeff" name="coeff" placeholder="Коэффициент"/></div>
        
        
        <input type="button" class="save-value"  valid="<?=$Value["id"]?>"/>
    </div>

    </div>
    <?
}
function Show_Calculator_Items()
{
    $tableName = "calculator_items";
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

                var order = $(this).sortable("serialize") + '&update=updatecalcitems';
                $.post("", order, function (theResponse) {

                });
            }
            });
        });
    </script>
    <?


    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Калькулятор - Значения (' . $count[0] . ')  <a href="index.php?page=add_calculator_item" class="event-button">Добавить значение</a></h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0" id="list1">
			<thead>
				<tr>
    				
                    <th style="min-width:250px;">Название</th>
                    <th>Подсказка</th>
                    <th>Цена</th>
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    $num = COUNTPAGE;
    $pg = "show_calculator_items";
    $page = $_GET["num"];
    $result = mysql_query("SELECT COUNT(*) FROM  `$tableName`");
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

    $query = mysql_query("SELECT * FROM `$tableName` ORDER by position LIMIT $start, $num");
    while ($postrow[] = mysql_fetch_array($query)) {

    }
    for ($i = 0; $i < $num; $i++) {
        if ($postrow[$i]) {


            if( $postrow[$i]["public"]==0)
            {
                $opacity1 = "opacity:0.2;";
            }else{
                $opacity1 ="";
            }


            echo '<tr  id="position_' . $postrow[$i]["id"] . '" style="font-size:13px;'.$opacity1.'">
            
            <td><a  href="index.php?page=edit_calculator_item&id=' . $postrow[$i]["id"] . '" style="font-weight:bold">' . $postrow[$i]["name"] . '</a></td>
            <td class="podskaz_img">' . $postrow[$i]["tooltip"] . '</td>
            <td>' . $postrow[$i]["coast"] . '</td>
           
            <td align="center"><a  href="index.php?page=edit_calculator_item&id=' . $postrow[$i]["id"] . '"><img style="margin-right:7px;" src="images/icn_edit.png" title="Редактировать"/></a></td>
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_calculator_item=' . $postrow[$i]["id"] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
            </tr>';









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
if(isset($_GET["delete_calculator_item"]))
{
    $id = $_GET["delete_calculator_item"];

    mysql_query("DELETE FROM `calculator_items` WHERE id=$id");
    mysql_query("DELETE FROM `calculator_values` WHERE item_id=$id");
    @removeDirRec("../files/calculator/".$id);

    $_SESSION["message"] = "Значение удалено";
    echo'<script>window.location="index.php?page=show_calculator";</script>';
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

if ($_POST['update'] == "updatevalueposition"){
    $array	= $_POST['position'];
    $count = 1;
    foreach ($array as $idval) {
        $query = "UPDATE calculator_values SET position = " . $count . " WHERE id = " . $idval;
        mysql_query($query) or die('Ошибка');
        $count ++;
    }
    echo 'Информация сохранена!';
}

if (isset($_POST['savevalueid'])){
    $id = $_POST['savevalueid'];
    $coast = $_POST['coast'];
    $time = $_POST['time'];
    $stepen1 = $_POST['stepen1'];
    $stepen2 = $_POST['stepen2'];
    $stepen3 = $_POST['stepen3'];
    $stepen4 = $_POST['stepen4'];
    $coeff = $_POST['coeff'];

    $db->query("UPDATE `calculator_values` SET `coast`='$coast', `time`='$time', `stepen1`='$stepen1', `stepen2`='$stepen2', `stepen3`='$stepen3', `stepen4`='$stepen4', `coeff`='$coeff' WHERE `id`='$id'");
    echo 'Информация сохранена!';
}