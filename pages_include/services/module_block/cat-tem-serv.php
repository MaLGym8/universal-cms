<div class="container">
	<div class="inner">

                <?
                if ($MainCats) {
					//echo '<div class="title selectservice">Выберите услугу</div>';
					echo '<ul class="block-universal-button">';
                    foreach ($MainCats as $Cat) {
                        $CatsParent1 = $db->read_all(
                            "SELECT * FROM `services` WHERE public=1 and `parent`='" . $Cat["id"] . "' ORDER by `position` ASC"
                        );
                        if ($CatsParent1) {
                            $hover1 = "hover-1";
                        } else {
                            $hover1 = "";
                        }
                        echo '<li class="cat1 '; if($Page["id"]==$Cat["id"])echo" active "; echo'">
						<a class="cat1-a ' . $hover1  . '" href="' . GetPathCat($Cat["id"]) . '">' . $Cat["menu"] . '</a>';

                        if ($CatsParent1) {
                            echo "<ul>";
                            foreach ($CatsParent1 as $CatParent1) {
                                $CatsParent2 = $db->read_all(
                                    "SELECT * FROM `services` WHERE public=1 and `parent`='" . $CatParent1["id"]
                                    . "' ORDER by `position` ASC"
                                );
                                if ($CatsParent2) {
                                    $hover2 = "hover-1";
                                } else {
                                    $hover2 = "";
                                }
                                echo '<li class="cat2 '; if($Page["id"]==$Cat["id"])echo" active "; echo'"><a class="cat2-a ' . $hover2 . '" href="' . GetPathCat(
                                        $CatParent1["id"]
                                    ) . '">' . $CatParent1["menu"] . '</a>';

                                if ($CatsParent2) {
                                    echo "<ul>";

                                    foreach ($CatsParent2 as $CatParent2) {
                                        echo '<li class="cat3"><a class="cat3-a" href="' . GetPathCat($CatParent2["id"])
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
					echo '</ul>'; }  ?>
	</div>
</div>