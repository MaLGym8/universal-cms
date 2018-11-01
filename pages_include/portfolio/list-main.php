<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <? if($ParentCats == 0):?>
            <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>>
                <?
                if($Page["h1"]):
                    echo $Page["h1"];
                else:
                    echo $Page["title"];
                endif;
                ?>
            </h1>
        <? else:?>
            <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>> <?
                if($Page["h1"]):
                    echo $Page["h1"];
                else:
                    echo $Page["title"];
                endif;
                ?></h1>
        <? endif;?>
    </div>
</div>
<?

?>

<div class="container">
	<div class="inner">
        <?
        if($ParentCats == 0):?>

        <div class="section block-portfolio">

            <div class="ulcenter">
                <ul class="block-universal-button list">
                    <?
                    $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE public=1");
                    ?>
                    <?php /*?><li class="active"><span>Все <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></span></li><?php */?>
                    <li class="active"><a href="/portfolio">Все <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></a></li>
                    
                    
                    <?

                    if($MainCats)
                        foreach($MainCats as $Cat)
                    {

                        $CATURL = str_replace("services","portfolio",GetPathCat($Cat["id"],"portf"));

                        $ALLCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `id`='".$Cat["id"]."'");

                        if($ALLCats)
                        {
                            $q =" AND (";
                            $q .=" `portfolio_cat`='".$Cat["id"]."' ";
                            foreach ($ALLCats as $Cat1)
                            {
                                $ALLCats2 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Cat1["id"]."'");

                                if($ALLCats2)
                                {

                                    $q .=" OR  `portfolio_cat`='".$Cat1["id"]."' ";
                                    foreach ($ALLCats2 as $Cat2)
                                    {
                                        $q .=" OR `portfolio_cat`='".$Cat2["id"]."' ";
                                    }

                                }else{
                                    $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";

                                }





                                //   $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";
                            }
                            $q .=") ";
                        }




                        $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE public=1 and id!=0 $q ");
             ?><li class="ahref"><a href="<?=$CATURL?>"><?=$Cat["menu"];?> <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></a></li>

                        <?

                    }
                    ?>

                </ul>
    <?
    if(isset($_GET["tag"])):?>
    <br clear="all"><h2 class="h2-portfolio-cat">
    <?

        echo $Page["h1"].": ".$Tag1;

    ?>
        <?php /*?><span>(по тематике: <b><?=$Tag1;?></b>)</span><?php */?>
    <? endif;
    ?>
</h2>
                <div class="box visible">
                    <ul class="cause">
                        <div class="tags-block">
                        <?

                       
                        $GetTags = $db->read_all("SELECT * FROM `tags` ORDER by id ASC");
                        if($GetTags)
                        {
                            foreach ($GetTags as $tag)
                            {
                                $Tag = $db->read_all("SELECT * FROM `tags_ids` WHERE `tag_id`='".$tag["id"]."' AND `obj_type`='image'");
                                if($Tag)
                                        {
                                            $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `tags_ids` WHERE tag_id='".$tag["id"]."' ");
                                            echo "<a"; if($tag["name"]==$Tag1)echo" class='active' "; echo" title='".$tag["name"]."' href='?tag=".$tag["name"]."' tagid='".$tag["id"]."'>".$tag["name"]." <i>(".$COUNT1[0]["COUNT(*)"].")</i></a>";
                                        }

                            }
                        }
                        ?>

                            </div>

                            <?
                        if($TagInfo)
                        {
                            $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` INNER JOIN tags_ids ON tags_ids.tag_id = '".$TagInfo["id"]."' AND tags_ids.obj_id=portfolio_item.id WHERE `portfolio_item`.public=1 ORDEr by `portfolio_item`.sort ASC LIMIT 0,".portfolioquantity1."");

                            $RCOUNT = mysql_fetch_array(mysql_query("SELECT * FROM `portfolio_item` INNER JOIN tags_ids ON tags_ids.tag_id = '".$TagInfo["id"]."' AND tags_ids.obj_id=portfolio_item.id WHERE `portfolio_item`.public=1 ORDEr by `portfolio_item`.sort ASC LIMIT 0,".portfolioquantity1.""));

                        }else{
                            $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` WHERE `public`=1 ORDEr by sort ASC LIMIT 0,".portfolioquantity1."");

                            $RCOUNT = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `portfolio_item` WHERE `public`=1 ORDEr by sort ASC LIMIT 0,".portfolioquantity1.""));


                        }

                        $resultPortfCat = mysql_fetch_array($queryPortfCat);
                        do
                        {
                            if($resultPortfCat)
                            {







                                include("pages_include/portfolio/module.php");




                            }
                        }while($resultPortfCat = mysql_fetch_array($queryPortfCat));

                            if($RCOUNT[0]>portfolioquantity1)
                            {
                        ?>
        <li class="ajaxloadportfolio" tagid="<?=$TagInfo["id"]?>"><span class="button">Показать больше</span></li>
                        <?}?>
                    </ul>
                </div>
                </div>
                </div>


            <?elseif($ParentCats==1):?>
            <div class="section block-portfolio">

                <div class="ulcenter">
                    <ul class="block-universal-button list">

                        <?if($MainCats):?>
<?
                            $ALLCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$ParentCat["id"]."'");

                            if($ALLCats)
                            {
                                $q =" AND (";
                                $q .=" `portfolio_cat`='".$ParentCat["id"]."' ";
                                foreach ($ALLCats as $Cat1)
                                {
                                    $ALLCats2 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Cat1["id"]."'");

                                    if($ALLCats2)
                                    {

                                        $q .=" OR  `portfolio_cat`='".$Cat1["id"]."' ";
                                        foreach ($ALLCats2 as $Cat2)
                                        {
                                            $q .=" OR `portfolio_cat`='".$Cat2["id"]."' ";
                                        }

                                    }else{
                                        $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";

                                    }





                                    //   $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";
                                }
                                $q .=") ";
                            }

                            $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE public=1 and id!=0 $q LIMIT 0,".portfolioquantity1."")
                            ?>

                            <? if($ParentCat):
                                $CATURL = str_replace("services","portfolio",GetPathCat($ParentCat["id"],'portf'));
?>
                                <li class="ahref"><a href="<?=$CATURL?>">Показать все <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></a></li>
                                <? else:?>
                                <?php /*?><li class="active"><span>Все <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></span></li><?php */?>
                              
                                
                                <li <? if(!$ROUTES[2]):?>class="active"<?endif;?>><a href="/portfolio">Показать все <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></a></li>
                                
                            <? endif;?>

                        <?endif;?>
                        <?

                        foreach($MainCats as $Cat)
                        {
                            $CATURL = str_replace("services","portfolio",GetPathCat($Cat["id"],'portf'));
                            $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE public=1 and id!=0 and `portfolio_cat`='".$Cat["id"]."' ");

                            if($CheckCat==1):
                            ?>


                            <li class="ahref <? if(/*$Parent==$Cat["id"]*/$ROUTES[2]==$Cat["url"]):?>active<? endif;?>" >
							<a href="<?=$CATURL?>">
						<? if($Cat["menu"]){echo $Cat["menu"];}
                                    elseif($Cat["h1"]){echo $Cat["h1"];}
                                    else{echo $Cat["title"];}?> <i>(<?=$COUNT1[0]["COUNT(*)"];?>)</i></a>
                                    </li>

                            <?else:?>
                                <li><?
                                    if($Cat["menu"]){echo $Cat["menu"];}
                                    elseif($Cat["h1"]){echo $Cat["h1"];}
                                    else{echo $Cat["title"];}
                                    ?> <i> <?=$COUNT1[0]["COUNT(*)"];?></i></li>

                                <?endif;

                        }
                        ?>

                    </ul>


    <?
    if(isset($_GET["tag"])):?>
    <br clear="all"><h2 class="h2-portfolio-cat">
    <?

        echo $Page["h1"].": ".$Tag1;

    ?>
        <?php /*?><span>(по тематике: <b><?=$Tag1;?></b>)</span><?php */?>
    <? endif;
    ?>
</h2>

                    <div class="box visible">
                        <ul class="cause">

                            <?





                                $ALLCats = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Page["id"]."'");

                                if($ALLCats)
                                {
                                    $q =" AND (";
                                    $q .=" `portfolio_cat`='".$Page["id"]."' ";
                                    foreach ($ALLCats as $Cat1)
                                    {
                                        $ALLCats2 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='".$Cat1["id"]."'");

                                        if($ALLCats2)
                                        {

                                            $q .=" OR  `portfolio_cat`='".$Cat1["id"]."' ";
                                            foreach ($ALLCats2 as $Cat2)
                                            {
                                                $q .=" OR `portfolio_cat`='".$Cat2["id"]."' ";
                                            }

                                        }else{
                                            $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";

                                        }





                                     //   $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";
                                    }
                                    $q .=") ";
                                }else{
                                    $q .="  AND `portfolio_cat`='".$Page["id"]."' ";
                                    $FinalCat = 1;

                                }



?>


                            <div class="tags-block">
                                <?
                                $qtags = str_replace("portfolio_cat",'services_id',$q);
                                $GetTags = $db->read_all("SELECT * FROM `tags` WHERE `id`!=0 $qtags ORDER by id ASC");
								
                                if($GetTags&&$FinalCat==0)
                                {
                                    foreach ($GetTags as $tag)
                                    {
                                        $Tag = $db->read_all("SELECT * FROM `tags_ids` WHERE `tag_id`='".$tag["id"]."' AND `obj_type`='image'");
                                        if($Tag)
                                        {
                                            $COUNT1 = $db->read_all("SELECT COUNT(*) FROM `tags_ids` WHERE tag_id='".$tag["id"]."' ");
                                            echo "<a"; if($tag["name"]==$Tag1)echo" class='active' "; echo" title='".$tag["name"]."' href='?tag=".$tag["name"]."' tagid='".$tag["id"]."'>".$tag["name"]." <i>(".$COUNT1[0]["COUNT(*)"].")</i></a>";
                                        }

                                    }
                                }elseif($FinalCat==1){

                                    $GetTags = $db->read_all("SELECT * FROM `tags` WHERE `id`!=0  ORDER by id ASC");

                                foreach ($GetTags as $tag) {
                                    $Tag = $db->read_all(
                                        "SELECT * FROM `tags_ids` WHERE `tag_id`='" . $tag["id"]
                                        . "' AND `obj_type`='image'"
                                    );

                                    $queryPortfCat = mysql_query(
                                        "SELECT * FROM `portfolio_item` WHERE `public`=1 $q ORDEr by sort ASC LIMIT 0,"
                                        . portfolioquantity1 . ""
                                    );


                                    $resultPortfCat = mysql_fetch_array($queryPortfCat);
                                    do {
                                        $Tag = $db->read(
                                            "SELECT * FROM `tags_ids` WHERE `tag_id`='" . $tag["id"]
                                            . "' AND `obj_id`='" . $resultPortfCat["id"] . "'"
                                        );

                                        if ($Tag) {

                                            $tag["count"] = $tag["count"]+1;

                                            $TMP[$tag["id"]] = $tag;
                                        }


                                    } while ($resultPortfCat = mysql_fetch_array($queryPortfCat));

                                }

                                if($TMP)
                                {
                                foreach($TMP as $tag)
                                {

                                if($tag["name"]){
                                    echo "<a";
                                    if ($tag["name"] == $Tag1) {
                                        echo " class='active' ";
                                    }
                                    echo " title='" . $tag["name"] . "' href='?tag=" . $tag["name"]
                                        . "' tagid='" . $tag["id"] . "'>" . $tag["name"] . " <i>("
                                        .$tag["count"]. ")</i></a>";}
                                }
                                }


                                }
                                ?>

                            </div>
                            <?



                            if($TagInfo)
                            {
                                $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` INNER JOIN tags_ids ON tags_ids.tag_id = '".$TagInfo["id"]."' AND tags_ids.obj_id=portfolio_item.id WHERE `portfolio_item`.`public`=1 $q ORDEr by `portfolio_item`.sort ASC LIMIT 0,".portfolioquantity1."");
                                $RCOUNT = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `portfolio_item`  WHERE  public=1 INNER JOIN tags_ids ON tags_ids.tag_id = '".$TagInfo["id"]."' AND tags_ids.obj_id=portfolio_item.id WHERE `portfolio_item`.`public`=1 $q ORDEr by `portfolio_item`.sort ASC LIMIT 0,".portfolioquantity1.""));

                            }else{
                                $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` WHERE `public`=1 $q ORDEr by sort ASC LIMIT 0,".portfolioquantity1."");
                                $RCOUNT = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `portfolio_item` WHERE `public`=1 $q ORDEr by sort ASC LIMIT 0,".portfolioquantity1.""));
                            }



                            $resultPortfCat = mysql_fetch_array($queryPortfCat);
                            do
                            {
                                if($resultPortfCat)
                                {

                                    $tag="";
                                    $GetTags = $db->read_all("SELECT * FROM `tags_ids` WHERE `obj_id`='".$resultPortfCat["id"]."'");
                                    if($GetTags)
                                    {
                                        foreach ($GetTags as $Tag){
                                            $tag .= " tag_".$Tag["tag_id"]."='1' ";
                                        }
                                    }

                                    include("pages_include/portfolio/module.php");


                                }
                            }while($resultPortfCat = mysql_fetch_array($queryPortfCat));


                            if($RCOUNT[0]>portfolioquantity1)
                            {
                                ?>
                                <li class="ajaxloadportfolio" tagid="" query="<?=$q?>"><span class="button">Показать больше</span></li>

                                <?
                            }
                            ?>

                        </ul>
                    </div>


                    <?

                                    foreach($MainCats as $Cat)
                                    {
                    ?>
                                    <?php /*?>дубляж работ<div class="box">  <ul class="cause"><li>

                                        <?
                                        $q = " public = 1 ";


                                            $ALLCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='".$Cat["id"]."'");

                                            if($ALLCats)
                                            {
                                                $q .=" AND (";
                                                $q .=" `portfolio_cat`='".$Cat["id"]."' ";
                                                foreach ($ALLCats as $Cat1)
                                                {
                                                    $q .=" OR `portfolio_cat`='".$Cat1["id"]."' ";
                                                }
                                                $q .=") ";
                                            }else{
                                                $q .="  AND `portfolio_cat`='".$Cat["id"]."' ";

                                            }



                                        $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` WHERE $q ORDEr by sort ASC");
                                        $resultPortfCat = mysql_fetch_array($queryPortfCat);
                                        do
                                        {
                                            if($resultPortfCat)
                                            {


                                                include("pages_include/portfolio/module.php");
                                                }



                                        }while($resultPortfCat = mysql_fetch_array($queryPortfCat));
                    ?>

                                               </li>  </ul> </div>дубляж работ<?php */?> 
                                        <?
                                    }
                    ?>

                </div>








            </div>

        <?else:?>


        <div class="section block-portfolio">

            <ul class="cause">

                    <?
                    $queryPortfCat = mysql_query("SELECT * FROM `portfolio_item` WHERE `portfolio_cat`='".$Page["id"]."' and `public`=1 ORDEr by sort ASC");
                    $resultPortfCat = mysql_fetch_array($queryPortfCat);
                    do
                    {
                        if($resultPortfCat)
                        {




                                $OBJURL = str_replace("services","portfolio",GetPathService($resultPortfCat["portfolio_cat"],'portf'));

                            include("pages_include/portfolio/module.php");


                        }
                    }while($resultPortfCat = mysql_fetch_array($queryPortfCat));
                    ?>

                 </ul>









        </div>


        <? endif; ?>



    </div>
</div>

<? if($Page["desc"] and !isset($_GET["tag"])) {?>
<div class="pagetext">
	<div class="inner">
    	<? echo $Page["desc"];?>
    </div>
</div>
<? }?>

<input type="hidden" id="limitajaxload" value="<?=portfolioquantity2?>"/>
<input type="hidden" id="startload" value="<?=portfolioquantity1?>"/>
<input type="hidden" id="queryajax" value="<?=$q?>"/>

<? include_once("modules/forms/bottom/bottom_block.php");?>