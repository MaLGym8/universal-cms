<?
function Show_Part()
{
    ?>

    <script type="text/javascript">
        $(function () {
            $("#list1").sortable({ update: function () {

                var order = $(this).sortable("serialize") + '&update=update';
                $.post("/admin77/includes/gallery/updateList.php", order, function (theResponse) {

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
        mysql_query("UPDATE images_content SET public=0 WHERE cat=3");
        if ($items != "") {
            foreach ($items as $id) {
                mysql_query("UPDATE images_content SET public=1 WHERE id=$id");
            }
        }
        echo '<script>window.location="index.php?page=show_part";</script>';
    }


    if (!isset($id)) {

        ?><article class="module width_full">
        <header><h3>Редактирование парнеров <span class="header-small">(перетаскивая, можно менять позиции)</span></h3></header>
        <div class="module_content">

        <form method="post" action="index.php?page=show_part">
        
            <div align="center"><input onclick="window.location='index.php?page=show_part_add'" type="button" class="add-image-button" value="Добавить партнера"/></div>
            
                <ul id="list1">
                    <?
                    $result = mysql_query("SELECT * FROM images_content WHERE `cat`=3 ORDER by sort");
                    if (!$result) {
                        echo "<p class='error'>Запрос на выборку данных из базы не прошёл</p>";
                    }

                    if (mysql_num_rows($result) > 0) {
                        $myrow = mysql_fetch_array($result);

                        do {

                            if ($myrow['public'] == 1) {
                                $check = 'checked';
                            } else {
                                $check = '';
                            }
                            if ($myrow['public'] == 0) {
                                $opacity = 'style="opacity:0.4"';
                            } else {
                                $opacity = '';
                            }
                            echo '

	<li id="position_' . $myrow["id"] . '" class="li-card"><div ' . $opacity . ' class="card">
	<a href="index.php?page=show_part&id=' . $myrow["id"] . '">
	<div class="img"><img  width="133" src="../' . $myrow["thumb"] . '"></div></a>
	<label>вкл/выкл<input class="checkbox-on-off" type="checkbox" name="portf[' . $myrow["id"] . ']" value="' . $myrow["id"] . '" ' . $check . '></label>
	</div></li>

';
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


        $result = mysql_query("SELECT * FROM images_content WHERE id='$id'");
        $myrow = mysql_fetch_array($result);


        $link = $myrow["link"];
        echo "<article class='module width_full'>
<header><h3>Редактирование партнера</h3></header>
<div class='module_content'>";

        echo '
<form enctype="multipart/form-data" name="form"  id="forma" method="post" action="/admin77/includes/gallery/index_update.php">



		<div style="float:left; width:50%;">
		<p>
           <label>Полное изображение<br>
              <input type="file" name="fullimg" style="width:70%;"/>
			  <br/>
			  <img src="../' . $myrow[fullimg] . '" width=100/>
			  <img src="../' . $myrow[thumb] . '" width=50/>
             </label>
         </p>


		</div>





		<div style="float:right; width:50%;">


 <p>
           <!--<label>Текст слева<br>
             <input value=\'' . $myrow[description] . '\' type="text" name="description" style="width:70%;">
			
             </label>
         </p>
         <p>
           <label>Текст справа<br>
             <input value="' . $myrow[link] . '" type="text" name="link" style="width:70%;">
             </label>
         </p>-->

 <input type="hidden" name="imgfull" value="' . $myrow[fullimg] . '"/>
			 <input type="hidden" name="imgthumb" value="' . $myrow[thumb] . '"/>
		 <p>
           <label>Сортировка<br>
             <input value=\'' . $myrow[sort] . '\' type="text" name="sort" class="input-sort">';


        if ($myrow['public'] == 1
        ) {
            echo "<span style='color:#02D702; text-decoration:underline'>ОПУБЛИКОВАННЫЙ</span>";
        } else {
            echo "<span style='color:#ff0000; text-decoration:none'>НЕОПУБЛИКОВАННЫЙ</span>";
        }
        echo " <input type='checkbox' name='public'";
        if ($myrow['public'] == 1) {
            echo "checked";
        }
        echo "><br/>";


        echo ' </label>
         </p>
		</div>


		<br clear="all">


		<input name="id" type="hidden" value="' . $myrow[id] . '">
		<input name="cat" type="hidden" value="' . $myrow[cat] . '">

         <p align="center" style="margin-top:15px; ">
           <label>
           <input type="submit" class="button save-changes" name="submit" value="Сохранить изменения">
           </label>
         </p>


       </form>';


        echo "<div class='delete-image'><form name='delport' action='/admin77/includes/gallery/index_drop.php' method='post'><input name='delport' type='hidden' value='$myrow[id]'><input name='submit' type='submit' class='delete-image-but' value='X'></form>";


    } ?>
    </div>
    <div class='clear'></div>
    </div>
    </article>
<?
}
function  Show_Part_Add()
{
?>
    <article class="module width_full">
    <header><h3>Добавление партнера</h3></header>
    <div class="module_content">
    

        <form enctype="multipart/form-data" name="form" id="forma" method="post" action="/admin77/includes/gallery/add.php">


            <div style="float:left; width:50%;">
                <p>
                    <label>Изображение<br>
                        <input type="file" name="fullimg" style="width:70%;"/>
                    </label>
                </p>

            </div>


            <div style="float:right; width:50%;">


                <!--<p>
                    <label>Текст слева<br>
                        <input value="" type="text" name="description" style="width:70%;">
                    </label></p>

                <p><label>Текст справа<br>
                        <input value="" type="text" name="link" style="width:70%;">
                    </label>
                </p>-->

                <?
                $sorting = mysql_query("SELECT * FROM images_content ORDER by sort DESC limit 1");
                $sort = mysql_fetch_array($sorting);
                ?>


                <p>
                    <label>Сортировка<br>

                        <input value="<? echo $sort['sort'] + 1; ?>" type="text" name="sort"
                               class="input-sort">

                        <span style='color:#02D702; text-decoration:underline'>ОПУБЛИКОВАННЫЙ</span> <input
                            type='checkbox' name='public' checked><br/>



                    </label>
                </p>
            </div>


            <br clear="all">

            <p align="center" style="margin-top:15px; ">
                <label>
                    <input type="hidden" name="cat" value="3"/>
                    <input type="submit" class="button button-add" name="submit" value="Добавить">
                </label>
            </p>


        </form>
        
	<div class="clear"></div>
    </div>
    </article>

<?
}
?>