<?php /*?><div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
    <div class="inner">
        <? //include_once("blocks/breadcrumbs.php");?>
		<? include_once("pages_include/services/module_block/4block_ceni.php");?>
    </div>
</div><?php */?>


<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>

            <h2 class="small_desc">Отметьте необходимые пункты, и получите автоматически сформированное КП на e-mail</h2>

        <?php /*?><div class="services-orderim">
            <a href="#" class="button active">Сайт интернет-магазина</a>
            <a href="/sozdanie_saitov/sozdanie_internet_magazina" class="button">Бизнес интернет-магазина под ключ</a>
        </div><?php */?>

    </div>
</div>


<div class="container">
    <div class="inner">
<?php /*?><h1 class="title calc_tit">Онлайн калькулятор расчета стоимости</h1>

<div align="center" class="calc_tit_small">Отметьте необходимые пункты, и получите автоматически сформированное КП на e-mail</div><?php */?>

<?php include_once($_SERVER["DOCUMENT_ROOT"]."/modules/calculator/calculator_block.php"); ?>
	</div>
</div>