<div class="top-bg"<? if($Page["image"]):?>style="background: url('/<?=$Page["image"]?>') center no-repeat;background-size: cover;"<? endif; if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
     
	<div class="inner">
    <? include_once("blocks/breadcrumbs.php");?>
    <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>
            <h2><?= $Page["titlee"]; ?></h2>
        <? if(!empty($Page["meta_d"])):?>
            <h2 class="small_desc" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?=$Page["meta_d"];?></h2>
        <? endif;?>
    </div>
</div>

    


<div class="current-blog">
	<div class="inner">
		<?=$Page["text"]?>
        <br clear="all">
        <div class="blog-date">Добавлено: <? echo date("d-m-Y", strtotime($Page["date_add"])); ?></div>

    <?php /*?><div class="blog-current-comments">
        <div class="inner">
            <?
            $queryCount = mysql_query("select COUNT(*) from commentsystem  where url_id like '".$_SERVER['REQUEST_URI']."' and public = 1 order by id");
            $resultCount = mysql_fetch_array($queryCount);



            ?>
            <div class="title">Дискуссия по теме <span class="count-comments"><?=$resultCount[0];?> Комментария</span></div>
            <?
            @include_once ("modules/comments_blog/comments.php");
            ?>



        </div>
    </div><?php */?>
	</div>		 
</div>


    
    
<div class="blog-current-moreread">
	<div class="inner">
        <?
        //$newsQ = $db->read_all("SELECT * FROM `blog` WHERE `cat`='".$Page["cat"]."' and id!='".$Page["id"]."' ORDER by rand() LIMIT 3");
		$newsQ = $db->read_all("SELECT * FROM `blog` ORDER by rand() LIMIT 3");

        if($newsQ)
        {?>

	 <div class="title">Что ещё почитать</div>
       <? 
include_once("pages_include/blog/include-list.php");
	   } ?>
    </div>
</div>