<?php
    include 'top.php';
?>

        <main>
            <h2 class="centered">
            Library
            </h2>
            <div class="mainsection">
                    <section class="libsection">
                        <?php
                                $sql = 'SELECT pmkBookID, fldTitle, fldLastName, fldYear, varRating FROM tblBooks';
                                $statement = $pdo->prepare($sql);
                                $statement->execute();

                                $books = $statement->fetchAll();

                                foreach($books as $book){
                                    print '<a href="detail.php?id=' . $book['pmkBookID'] .  '" class="booklink">';
                                    print '<article class = "book">';
                                    print '<h3 class="title">' . $book['fldTitle'] . '</h3>';
                                    print '<p class="author">' . $book['fldLastName'] . '</p>';
                                    print '<p class="date"><em>' . $book['fldYear'] . '</em></p>';
                                    if($book['varRating'] > 0){
                                        print '<p class="rating">' . $book['varRating'] . '</p>';
                                    }
                                    else {
                                        print '<p class="rating">Unrated</p>';
                                    }
                                    print'</article>';
                                    print '</a>' . PHP_EOL;
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