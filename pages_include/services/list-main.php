<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?> >
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"]):
                echo $Page["h1"];
            else:
                echo $Page["title"];
            endif;
            ?></h1>

        <?if($Page["small_desc"]):?>
            <h2 class="small_desc"><?=$Page["small_desc"];?></h2>
        <?endif;?>
    </div>
</div>


<div class="container">
    <div class="inner">
        <? include_once("pages_include/services/module_block/module_services.php"); ?>

       
        <?
        echo '<div class="cats-text">'.$Page["desc"].'</div>';
        ?>
        

    </div>
    <? include_once("modules/forms/bottom/bottom_block.php");?>
</div>