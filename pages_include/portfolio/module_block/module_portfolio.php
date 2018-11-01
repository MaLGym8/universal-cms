<div class="block-portfolio">
    <div class="inner">

        <div class="title">
            <?if($TitlePortfolio):?><?=$TitlePortfolio;?><?else:?>Портфолио<?endif;?>

        </div>

        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <?

                    if(!$ServicesPortfolio) {
                        if ($queryPortfCat) {
                            $queryPortfCat = mysql_query($queryPortfCat);

                        } else {
                            $queryPortfCat = mysql_query(
                                "SELECT * FROM `portfolio_item` WHERE `public`=1 ORDEr by sort ASC"
                            );

                        }
                    }else {
                        $ServicesPortfolio;
                        global $db;
                        $Cat = $db->read("SELECT * FROM `portfolio_cat` WHERE `services_id`='$ServicesPortfolio'");
                        $QueryCat = " `portfolio_cat` = '" . $Cat["id"] . "'";

                        if ($Cat) {

                            $Cats1 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat["id"] . "'");


                            if ($Cats1) {
                                foreach ($Cats1 as $Cat1) {
                                    $QueryCat .= " or `portfolio_cat` = '" . $Cat1["id"] . "'";

                                    $Cats2 = $db->read_all(
                                        "SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat1["id"] . "'"
                                    );
                                    if ($Cats2) {
                                        foreach ($Cats2 as $Cat2) {
                                            $QueryCat .= " or `portfolio_cat` = '" . $Cat2["id"] . "'";

                                        }
                                    }
                                }

                            }
                        }

                        $queryPortfCat = mysql_query(
                            "SELECT * FROM `portfolio_item` WHERE `public`=1 AND ($QueryCat) ORDEr by sort ASC"
                        );

                        $resultCount = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE `public`=1 AND ($QueryCat) ORDEr by sort ASC");
                        if($resultCount[0]["COUNT(*)"]==0)
                        {
                            $QueryCat = " `portfolio_cat` = '" . $Cat["parent"] . "'";

                            if ($Cat) {

                                $Cats1 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat["parent"] . "'");


                                if ($Cats1) {
                                    foreach ($Cats1 as $Cat1) {
                                        $QueryCat .= " or `portfolio_cat` = '" . $Cat1["id"] . "'";

                                        $Cats2 = $db->read_all(
                                            "SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat1["id"] . "'"
                                        );
                                        if ($Cats2) {
                                            foreach ($Cats2 as $Cat2) {
                                                $QueryCat .= " or `portfolio_cat` = '" . $Cat2["id"] . "'";

                                            }
                                        }
                                    }

                                }
                            }

                            $queryPortfCat = mysql_query(
                                "SELECT * FROM `portfolio_item` WHERE `public`=1 AND ($QueryCat) ORDEr by sort ASC"
                            );

                            $resultCount = $db->read_all("SELECT COUNT(*) FROM `portfolio_item` WHERE `public`=1 AND ($QueryCat) ORDEr by sort ASC");

                            if($resultCount[0]["COUNT(*)"]==0)
                            {
								
                                $Cat = $db->read("SELECT * FROM `portfolio_cat`");
                                $QueryCat = " `portfolio_cat` = '" . $Cat["parent"] . "'";

                                if ($Cat) {

                                    $Cats1 = $db->read_all("SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat["parent"] . "'");


                                    if ($Cats1) {
                                        foreach ($Cats1 as $Cat1) {
                                            $QueryCat .= " or `portfolio_cat` = '" . $Cat1["id"] . "'";

                                            $Cats2 = $db->read_all(
                                                "SELECT * FROM `portfolio_cat` WHERE `parent`='" . $Cat1["id"] . "'"
                                            );
                                            if ($Cats2) {
                                                foreach ($Cats2 as $Cat2) {
                                                    $QueryCat .= " or `portfolio_cat` = '" . $Cat2["id"] . "'";

                                                }
                                            }
                                        }

                                    }
                                }

                                $queryPortfCat = mysql_query(
                                    "SELECT * FROM `portfolio_item` WHERE `public`=1 AND ($QueryCat) ORDEr by sort ASC"
                                );


                            }
                        }

                    }

                    $resultPortfCat = mysql_fetch_array($queryPortfCat);
                    do
                    {
                        if($resultPortfCat)
                        {
                            include("pages_include/portfolio/module.php");
                        }
                    }while($resultPortfCat = mysql_fetch_array($queryPortfCat));
                    ?>
                </ul>
            </div>
            <a href="#" class="jcarousel-control-prev-portf-0 jcarousel-control-prev-portf-all"></a>
            <a href="#" class="jcarousel-control-next-portf-0 jcarousel-control-next-portf-all"></a>


        </div>


<br clear="all">

<div class="moreblog"><a class="button" href="/portfolio<?=$portfolio_link?>">Перейти в портфолио</a></div>


    </div>
</div>

