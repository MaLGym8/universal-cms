<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                $Page["title"]
            ?></h1>
        
    </div>
</div>



<div class="block-services">
	<div class="inner">





<ul class="actionspiss">
              <?
				$sliderQuery = $db->read_all("SELECT * FROM `sales` WHERE public='1' ORDER by position ASC");
				if($sliderQuery)
				{
					$i=0;
					foreach($sliderQuery as $slide)
					{
						$i++;
						?>
					 <li <?if($i==2||$i==3||$i==6){?>class="dark"<?}?> >
                    <div class="title">
                    <?=$slide["h1"]?></div>
                    <?=$slide["dop_text"]?>
                    <div class="string-3"><a class="button slider-button" href="/<?=$slide["url"]?>">Подробнее</a></div>
                </li>
                
						<?
					}
				}
				?>
            
            
                
            </ul>

    
    
    <? echo $Item["desc"]; ?>
    </div>
</div>



<? 
//$formtitle = "";
include_once("modules/forms/bottom/bottom_block.php");?>

</div>