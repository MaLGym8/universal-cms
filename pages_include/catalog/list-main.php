<div class="top-bg" <? if($Page["background"]):?>style="background: url('/<?=$Page["background"]?>') center no-repeat;background-size: cover;"<? endif;?> <? if($Page["background_color"]):?>style="background: <?=$Page["background_color"]?> ;"<? endif;?>>
    <div class="inner">
        <? include_once("blocks/breadcrumbs.php");?>
        <h1 class="title" <? if($Page["background_text"]):?>style="color: <?=$Page["background_text"]?> ;"<? endif;?>><?
            if($Page["h1"])
                echo $Page["h1"];
            else
                echo $Page["title"];
            ?></h1>
    </div>
</div>


<div class="container">
    <div class="inner">

        <ul class="index-cats">
            <?

            if ($MainCats) {
                foreach ($MainCats as $Cat) {
                    $CatsParent1 = $db->read_all(
                        "SELECT * FROM `catalog_cat` WHERE `parent`='" . $Cat["id"] . "' ORDER by `position` ASC"
                    );
                    if ($CatsParent1) {
                        $hover1 = "hover-1";
                    } else {
                        $hover1 = "";
                    }


                    echo '<li class="cat1" style="background: url(/' . $Cat["image"] . ');"><a class="cat1-a ' . $hover1
                        . '" href="'
                        . GetPathCat($Cat["id"],"catalog") . '">' . $Cat["title"] . '</a><a class="a-inner" href="'
                        . GetPathCat($Cat["id"],"catalog") . '"></a>';

                    if ($CatsParent1) {
                        echo "<ul>";
                        foreach ($CatsParent1 as $CatParent1) {
                            $CatsParent2 = $db->read_all(
                                "SELECT * FROM `catalog_cat` WHERE `parent`='" . $CatParent1["id"]
                                . "' ORDER by `position` ASC"
                            );


                            if ($CatsParent2) {
                                $hover2 = "hover-1";
                            } else {
                                $hover2 = "";
                            }
                            echo '<li class="cat2"><a class="cat2-a ' . $hover2 . '" href="' . GetPathCat(
                                    $CatParent1["id"]
                                ,"catalog") . '">' . $CatParent1["title"] . '</a>';

                            if ($CatsParent2) {
                                echo "<ul>";

                                foreach ($CatsParent2 as $CatParent2) {
                                    echo '<li class="cat3"><a class="cat3-a" href="' . GetPathCat($CatParent2["id"],"catalog")
                                        . '">' . $CatParent2["title"]
                                        . '</a></li>';
                                }
                                echo "</ul>";


                            }
                            echo '</li>';


                        }
                        echo "</ul>";
                    }

                    echo '</li>';
                }
            }
            ?>
        </ul>
        <?
        echo '<div class="cats-text">'.$Page["desc"].'</div>';
        ?>
    </div>
</div>