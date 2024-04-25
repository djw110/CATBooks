<?php
    include 'top.php';
?>

        <main>
            <div class="mainsection">
                <section class="allcols">
                    <h2 class = "centered">
                        Welcome
                    </h2>
                        <p id = "bio">
                            Welcome to CATBooks. To get started, check out the <a href="library.php">Library,</a> which 
                            contains the currently added books and all their information. You can even add a review to books you've read. 
                            Don't see a book you've read already in the library? No worries, you can add a new book to the library on the 
                            <a href="form.php">Add a Book</a> page. We hope you enjoy, and happy reading.
                        </p>
                </section>
                <section>
                    <h2 class="centered">
                        Top Rated    
                    </h2>
                    <?php
                    $sql = 'SELECT fldTitle, fldLastName, fldFirstName, fldYear, varRating FROM tblBooks ORDER BY varRating DESC LIMIT 5';
                    $statement = $pdo->prepare($sql);
                    $statement->execute();

                    $top5 = $statement->fetchAll();

                    foreach($top5 as $topbook){
                        print '<article class ="review">';
                        print '<fieldset>';
                        print '<legend class="centered">' . $topbook['fldTitle'] . '</legend>';
                        print '<p>' . $topbook['fldFirstName'] . ' ' . $topbook['fldLastName'] . ' </p>';
                        print '<p><em>' . $topbook['fldYear'] . '</em></p>';
                        if($topbook['varRating'] > 0){
                            print '<p><span class="score">' . $topbook['varRating'] . '</span></p>';
                        }
                        else {
                            print '<p><span class="score">Unrated</span></p>';
                        }
                        print '</fieldset>';
                        print '</article>';
                    }
                ?>

    
                </section>
                <section>
                    <h2 class="centered">
                        Recently Added   
                    </h2>
                    <?php
                    $sql = 'SELECT fldTitle, fldLastName, fldFirstName, fldYear, varRating FROM tblBooks ORDER BY pmkBookID DESC LIMIT 5';
                    $statement = $pdo->prepare($sql);
                    $statement->execute();

                    $recents = $statement->fetchAll();

                    foreach($recents as $recent){
                        print '<article class ="review">';
                        print '<fieldset>';
                        print '<legend class="centered">' . $recent['fldTitle'] . '</legend>';
                        print '<p>' . $recent['fldFirstName'] . ' ' . $recent['fldLastName'] . ' </p>';
                        print '<p><em>' . $recent['fldYear'] . '</em></p>';
                        if($recent['varRating'] > 0){
                            print '<p><span class="score">' . $recent['varRating'] . '</span></p>';
                        }
                        else {
                            print '<p><span class="score">Unrated</span></p>';
                        }
                        print '</fieldset>';
                        print '</article>';
                    }
                ?>
                </section>
            </div>
        </main>

        <?php
            include 'footer.php';
        ?>

    </body>

</html>