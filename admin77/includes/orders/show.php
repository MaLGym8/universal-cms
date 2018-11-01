<?php
//Просмотр страниц
function Show_Orders()
{
    $tableName = "blog";
    $count = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `$tableName`"));

		$dir    = "../files/leads/";

	$files = scandir($dir, 1);
	$count = count($files)-2;

	
	
    ?>

    <?

    echo '
    <article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Заявки (' . $count . ')  </h3></header>
		<div class="tab_container">
			<div id="tab1" class="tab_content catstable"><form action="" method="post">
			<table class="tablesorter" cellspacing="0">
			<thead>
				<tr>
    				
                    <th style="min-width:180px;">Название файла</th>
    			
    				<th></th>
					<th></th>
				</tr>
			</thead>
		    <tbody>';
    
    for ($i = 0; $i < $count; $i++) {
        if ($files[$i]) {
			

            echo '<tr>';
            echo '<td><a target="_blank" href="'.$dir.'' . $files[$i]. '">' . $files[$i] . '</a></td>
            
            ';
			
			echo'
        
			<td align="center"><span class="del-punkt"><a onclick="return onclick_delete()" href="?delete_orders=' . $files[$i] . '"><img src="images/icon_delete.gif"  title="Удалить"/></a></span></td>
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

    
}









if(isset($_GET["delete_orders"]))
{
    $id = $_GET["delete_orders"];

    @unlink("../files/leads/".$id);

    $_SESSION["message"] = "Заявка удалена";
    echo'<script>window.location="index.php?page=orders";</script>';
    exit();
}
