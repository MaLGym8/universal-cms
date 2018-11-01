<?php /*?><?
//Проверяем, находимся ли мы в разделе с услугами
if ("sales" == $ROUTES[1]||$ROUTES[1]=="$SALES1"||$ROUTES[1]=="$SALES2"||$ROUTES[1]=="$SALES3"||$ROUTES[1]=="$SALES4") {
    $ACTIVE_LEVEl_1 = "active";
} else {
    $ACTIVE_LEVEl_1 = "";
}
?>


<li class="<?=$ACTIVE_LEVEl_1;?> arrow podmenu"><a href="/sales">Акции <i></i></a>
    <ul>
	
	
        <?
        //Получаем список родителей
        $resultC1 = $db->read_all("SELECT * FROM `sales` WHERE `public`=1 ORDER by `position` ASC");
        foreach ($resultC1 as $C1)
        {
           
            //Проверяем, не находимся ли мы в этой категории
            if($ROUTES[1]==$C1["url"])
            {
                $act = " active2 ";
            }else{
                $act = "";
            }

            //Проверяем, что выводить в пункт меню
            if( $C1["name"])
                $title1 =  $C1["name"];
            else
                $title1 =  $C1["title"];

           echo '<li><a class="'.$act.' '.$hover1.'" href="/'.$C1["url"].'">' .$title1. '</a></li>';
           
            
        }


        ?></ul>
</li>
<?php */?>