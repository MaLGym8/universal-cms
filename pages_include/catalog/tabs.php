<div class="section products-tabs-block">
    <ul class="product-tabs">
        <li class="current">Описание</li>
        <li>Доставка</li>
        <li>Оплата</li>
        <?php /*?><li>Советы по уходу</li><?php */?>
    </ul>
<div class="box visible">

    <div class="catalog2-desc">
	
	<?
	echo $Item["dopdesc"];
	if(!empty($Item["desc"])) echo "<br>". str_replace("../files/", "/files/", $Item["desc"]); ?></div>



</div>
<div class="box">
<div class="bdo-dostavka">
Курьером в пределах МКАД				<span>300 p.</span>	<br>
Курьером в пределах 5 км от МКАД		<span>500 p.</span>	<br>
Курьером в пределах 10 км от МКАД		<span>700 p.</span>	<br>
Курьером в пределах 15 км от МКАД		<span>900 p.</span></div>
</div>


<div class="box"><div class="bdo-oplata"><img src="<?=$base_url?>images/pay-icons.jpg" align="right">Онлайн оплата картой Visa, MasterCard,<br>
Сбербанк, Яндекс-деньги<br>
Оплата наличными курьеру при получении</div>
</div>


<?php /*?><div class="box">Текст про уход
</div><?php */?>


</div>