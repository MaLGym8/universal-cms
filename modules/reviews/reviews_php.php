				<ul>
                    <?

                    if($queryComments)
                        $queryComments = mysql_query($queryComments);
                    else
                        $queryComments = mysql_query("SELECT * FROM comments WHERE public=1 ORDER by date DESC");

                    $resultComments = mysql_fetch_array($queryComments);
                    do
                    {
                        if($resultComments) {
                            $countComment = strlen($resultComments["text"]);

                            $text = iconv('UTF-8', 'CP1251', $resultComments["text"]);
                            $text = substr($text, 0, 300);
                            $text = iconv('CP1251', 'UTF-8', $text);
                            $date = date("Y-m-d", strtotime($resultComments["date"]));

                            if ($resultComments["photo"]) {
                                $photo = "/files/reviews_photos/" . $resultComments["photo"];
                            } else {
                                $photo = "/images/chcomments/nophoto.png";
                            }

                            $linkText = str_replace("www.","",$resultComments["link"]);
                            $linkText = str_replace("http://","",$linkText);
                            $linkText = str_replace("mailto:","",$linkText);

                            echo '<li>
                            <div class="rev-top">
								<noindex><div class="imageoverflow"><img src="' . $photo . '" align="left"></div>
								<p class="name">' . $resultComments["name"] . '</p>
								<p class="car">' . $resultComments["link"] . '</p>
								<p class="info">' . $resultComments["type"] . '</p>
                            </div>
							
                            <div class="rev-text">
                                ' . $resultComments["text"] . '
                            </div>
							<span class="date_rewiews">' . date("d-m-Y", strtotime($resultComments["date"])) . '</span>
							';
                            //if($countComment>890)echo'<span class="allcomment">...весь отзыв</span>';
                            echo '</li>';
                        }
                    }
                    while($resultComments = mysql_fetch_array($queryComments));
                    ?>

                </ul>
