<?php
    include 'top.php';
    
    $dataIsGood = false;

    $message = '';

    $review = '';
    $score = 0;
    $email = '';

    function getData($field) {
        if (!isset($_POST[$field])) {
            $data = "";
        } 
        else {
            $data = trim($_POST[$field]);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    function verifyAlphaNum($string){
        return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $string));
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        print PHP_EOL . '<!-- Starting Sanitization -->' . PHP_EOL;

        $score = getData('numScore');
        $review = getData('txtReview');
        $email = getData('txtEmail');
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        print PHP_EOL . '<!-- Starting Validation -->' . PHP_EOL;

        $dataIsGood = true;

        if($email == '' OR !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message .= '<p class="mistake">Please enter a valid email </p>';
            $dataIsGood = false;
        }
        if($score < 0 OR $score >100){
            $message .= '<p class="mistake">Please enter a valid score </p>';
            $dataIsGood = false;
        }

        print PHP_EOL . '<!-- Starting Saving -->' . PHP_EOL;
        if($dataIsGood){
            
            $sql = 'INSERT INTO tblReviews(fkBookID, fldReview, fldScore, fldEmail) VALUES (?,?,?,?)';
            $data = array(htmlspecialchars($_GET["id"]),$review,$score,$email);
            $statement = $pdo->prepare($sql);
            if($statement->execute($data)){
                $message .= '<p>Review Submitted</p>';

                $to = $email;
                $from = 'CATBooks Team <dwhooley@uvm.edu>';
                $subject = 'Thank You For Submitting A Review!';

                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From: " . $from . "\r\n";

                $mailmsg = '<p style="font: 15pt Verdana;">Your review has been added to the list. Thank you for your thoughts!</p>';
                $mailmsg .= '<p>Happy reading<br>';
                $mailmsg .= '<span style="color: yellow;">CAT</span><span style="color: green;">Books </span><span>Team</span>';
                $mailsent = mail($to,$subject,$mailmsg,$headers);
            }

            print PHP_EOL . '<!-- Review Added -->' . PHP_EOL;

            $sql = 'SELECT fldScore FROM tblReviews WHERE fkBookID = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([htmlspecialchars($_GET["id"])]);

            $datareviews = $statement->fetchAll();
            $sum = 0;
            foreach($datareviews as $datareview){
                $sum += $datareview['fldScore'];
            }
            if(count($datareviews)>0){
                $sum = intdiv($sum,count($datareviews));
            }

            print PHP_EOL . '<!-- Got Sum -->' . PHP_EOL;

            $sql = 'UPDATE tblBooks SET varRating = ? WHERE pmkBookID = ?';
            $statement = $pdo->prepare($sql);
            $statement->execute([$sum,htmlspecialchars($_GET["id"])]);
        }



    }

?>

        <main>
        <div class="mainsection">
            <?php

                $sql = 'SELECT fldTitle, fldLastName, fldFirstName, fldYear, fldGenre, fldSummary, varRating FROM tblBooks WHERE pmkBookID = ?';
                $statement = $pdo->prepare($sql);
                $statement->execute([htmlspecialchars($_GET["id"])]);
                $book = $statement->fetchAll()[0];

                print '<h1 class="allcols" id="booktitle">' . $book['fldTitle'] . '</h1>';
                print '<section>';
                print '<h2 class="centered">Details</h2>';
                print '<p>Author: ' . $book['fldFirstName'] .' ' . $book['fldLastName'].'</p>';
                print '<p>Genre: '. $book['fldGenre'] . '</p>';
                print '<p>Year: '. $book['fldYear'] . '</p>';
                if($book['varRating'] > 0){
                    print '<p>Score: <span class="score">'. $book['varRating'] . '</span></p>';
                }
                else{
                    print '<p>Score: <span class="score">Unrated</span></p>';    
                }
                print'</section>';
                print '<section>';
                print '<h2 class="centered">Synopsis</h2>';
                print '<p>'. $book['fldSummary'] . '</p>';    
                print '</section>'
            ?>


            <section>
                <?php
                    if($message != ''){
                        print $message;
                    }
                ?>

                <h2>Reviews</h2>
                <form action="#" method="POST" id="addReview">
                    <fieldset>
                        <p>
                            <label for="txtReview">Review</label>
                            <textarea id="txtReview" name="txtReview" maxlength="5000" placeholder="Great plot but.." required><?php print $review ?></textarea>
                        </p>
                        <p>
                            <label for="numScore">Score</label>
                            <input id="numScore" type="number" name="numScore" placeholder="1-100" min="0" max="100" <?php if($score > 0) {print 'value="'. $score . '"';} ?>required>
                        </p>
                        <p>
                            <label for="txtEmail">Email</label><input type="email" name="txtEmail" id="txtEmail" placeholder="reader@catbooks.org" value="<?php print $email ?>" required>
                        </p>
                        <p>
                            <input type="submit" value="Finish">
                        </p>
                    </fieldset>
                </form>

                <?php
                    $sql = 'SELECT fldReview, fldScore, fldEmail FROM tblReviews WHERE fkBookID = ? ORDER BY pmkReviewID DESC';
                    $statement = $pdo->prepare($sql);
                    $statement->execute([htmlspecialchars($_GET["id"])]);

                    $displayreviews = $statement->fetchAll();

                    foreach($displayreviews as $displayreview){
                        print '<article class ="review">';
                        print '<h2 class="hidden">Placeholder</h2>';
                        print '<fieldset>';
                        print '<legend>' . $displayreview['fldEmail'] . ' <span class="score">'. $displayreview['fldScore'] . '</span></legend>';
                        print '<p>' . $displayreview['fldReview'] . ' </p>';
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