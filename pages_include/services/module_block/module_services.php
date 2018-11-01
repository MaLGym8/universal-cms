
    <div class="title">Наши услуги</div>
        <ul class="block-service1">
            <?
            $MainCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='0' and public=1 ORDER by `position` ASC");

            if ($MainCats) {
                foreach ($MainCats as $Cat) {
                    $CatsParent1 = $db->read_all(
                        "SELECT * FROM `services` WHERE public=1 and `parent`='" . $Cat["id"] . "' ORDER by `position` ASC"
                    );
                    if ($CatsParent1) {
                        $hover1 = "hover-1";
                    } else {
                        $hover1 = "";
                    }


                    if(!$Cat["type_text"]):
                    echo '<li class="parent1" ><a class="parent1-a ' . $hover1
                        . '" href="'
                        . GetPathCat($Cat["id"]) . '">' . $Cat["menu"] . '</a>';
                    else:
                        echo '<li class="parent1" >' . $Cat["menu"] . '';
                    endif;

                    if ($CatsParent1) {
                        echo "<ul>";
                        foreach ($CatsParent1 as $CatParent1) {
                            $CatsParent2 = $db->read_all(
                                "SELECT * FROM `services` WHERE public=1 and `parent`='" . $CatParent1["id"]
                                . "' ORDER by `position` ASC"
                            );


                            if ($CatsParent2) {
                                $hover2 = "<i></i>";
                                $parent = " parent ";
                            } else {
                                $hover2 = "";
                                $parent = "";
                            }
                         
                            echo '<li class="parent2"><a class="parent2-a '.$parent.'" href="' . GetPathCat(
                                    $CatParent1["id"]
                                ) . '">' . $CatParent1["menu"] . '</a> ' . $hover2 . ' ';

                            if ($CatsParent2) {
                                echo "<ul>";

                                foreach ($CatsParent2 as $CatParent2) {
                                    echo '<li class="parent3"><a class="parent3-a" href="' . GetPathCat($CatParent2["id"])
                                        . '">' . $CatParent2["menu"]
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





    <div class="title">Наши услуги</div>
    <ul class="block-service2">
        <?
        $MainCats = $db->read_all("SELECT * FROM `services` WHERE `parent`='0' and public=1 ORDER by `position` ASC");

        if ($MainCats) {
            foreach ($MainCats as $Cat) {
                $CatsParent1 = $db->read_all(
                    "SELECT * FROM `services` WHERE `parent`='" . $Cat["id"] . "' and public=1 ORDER by `position` ASC"
                );
                if ($CatsParent1) {
                    $hover1 = "hover-1";
                } else {
                    $hover1 = "";
                }


                if(!$Cat["type_text"]):
                echo '<li class="parent1" style="background: url(/' . $Cat["image"] . ');"><a class="parent1-a ' . $hover1
                    . '" href="'
                    . GetPathCat($Cat["id"]) . '">' . $Cat["menu"] . '</a>';
                else:
                    echo '<li class="parent1" style="background: url(/' . $Cat["image"] . ');"><a class="parent1-a ' . $hover1
                        . '" href="javascript:void(0)">' . $Cat["menu"] . '</a>';
                endif;

                if ($CatsParent1) {
                    echo "<ul>";
                    foreach ($CatsParent1 as $CatParent1) {
                        $CatsParent2 = $db->read_all(
                            "SELECT * FROM `services` WHERE `parent`='" . $CatParent1["id"]
                            . "' and public=1 ORDER by `position` ASC"
                        );


                        if ($CatsParent2) {
                            $hover2 = "hover-1";
                        } else {
                            $hover2 = "";
                        }
                        echo '<li class="parent2"><a class="parent2-a ' . $hover2 . '" href="' . GetPathCat(
                                $CatParent1["id"]
                            ) . '">' . $CatParent1["menu"] . '</a>';

                        if ($CatsParent2) {
                            echo "<ul>";

                            foreach ($CatsParent2 as $CatParent2) {
                                echo '<li class="parent3"><a class="parent3-a" href="' . GetPathCat($CatParent2["id"])
                                    . '">' . $CatParent2["menu"]
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