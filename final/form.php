<?php
    include 'top.php';

    $genres = array('Mystery','Romance','Sci-Fi','Horror','Fantasy','Non-Fiction','Fiction');
    
    $dataIsGood = false;

    $message = '';

    $title = '';
    $lastName = '';
    $firstName = '';
    $year = 1952;
    $genre = '';
    $summary = '';

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

        $title = getData('txtTitle');
        $lastName = getData('txtLastName');
        $firstName = getData('txtFirstName');
        $year = getData('numYear');
        $genre = getData('lstGenre');
        $summary = getData('txtSummary');

        print PHP_EOL . '<!-- Starting Validation -->' . PHP_EOL;

        $dataIsGood = true;

        if($genre == '' OR !in_array($genre,$genres)){
            $message .= '<p class="mistake">Please choose a genre</p>';
            $dataIsGood = false;
        }


        print PHP_EOL . '<!-- Starting Saving -->' . PHP_EOL;
        if($dataIsGood){
            
            $sql = 'INSERT INTO tblBooks(fldTitle, fldLastName, fldFirstName, fldYear, fldGenre, fldSummary, varRating) VALUES (?,?,?,?,?,?,?)';
            $data = array($title,$lastName,$firstName,$year,$genre,$summary,-1);
            $statement = $pdo->prepare($sql);
            if($statement->execute($data)){
                $message .= '<h2>Thank you</h2>';
                $message .= '<p>Data Successfully Saved</p>';
            }
            
            $message .= '<h2>Thank you</h2>';
            $message .= '<p>Data Successfully Saved</p>';
        }


    }

?>

    <main>
        <h2 class="centered">
        Add New Book
        </h2>
        <div class = "mainsection">
            <section id="formsection">
                <h2 id="FormHeader">Complete This Form</h2>
                <form action="#" method="POST">
                    
                    <fieldset>
                        <legend>General Information</legend>
                        <p>
                            <label for="txtTitle">Title</label>
                            <input id="txtTitle" type="text" maxlength="60" name="txtTitle" placeholder="East Of Eden" value="<?php print $title ?>" required>
                        </p>
                        <p>
                            <label for="txtTitle">Author's Last Name</label>
                            <input id="txtLastName" type="text" maxlength="18" name="txtLastName" placeholder="Steinbeck" value="<?php print $lastName ?>" required>
                        </p>
                        <p>
                            <label for="txtTitle">Author's First Name</label>
                            <input id="txtFirstName" type="text" maxlength="18" name="txtFirstName" placeholder="John" value="<?php print $firstName ?>" required>
                        </p>
                        <p>
                            <label for="numYear">Year Published</label>
                            <input id="numYear" type="number" name="numYear" placeholder="1953" min="1" max="<?php print date("Y"); ?>" value="<?php print $year ?>" required>
                        </p>
                        <p>
                            <label for="lstGenre">Genre</label>
                            <select name="lstGenre" id="lstGenre">
                                <option value="Mystery" <?php if($genre == "Mystery") print 'selected'; ?> >Mystery</option>
                                <option value="Romance" <?php if($genre == "Romance") print 'selected'; ?> >Romance</option>
                                <option value="Sci-Fi" <?php if($genre == "Sci-Fi") print 'selected'; ?> >Sci-Fi</option>
                                <option value="Horror" <?php if($genre == "Horror") print 'selected'; ?> >Horror</option>
                                <option value="Fantasy" <?php if($genre == "Fantasy") print 'selected'; ?> >Fantasy</option>
                                <option value="Non-Fiction" <?php if($genre == "Non-Fiction") print 'selected'; ?> >Non-Fiction</option>
                                <option value="Fiction" <?php if($genre == "Fiction") print 'selected'; ?> >Fiction</option>
                            </select>
                        </p>
                    </fieldset>
                    <fieldset>
                        <legend>Additional Information</legend>
                        <p>
                            <label for="txtSummary">Brief Synopsis</label>
                            <textarea id="txtSummary" name="txtSummary" maxlength="5000" placeholder="Once upon a time.." required><?php print $summary ?></textarea>
                        </p>
                    </fieldset>
                    <p>
                        <input type="submit" id="formsubmit" value="Finish">
                    </p>
                </form>
            </section>
        </div>
    </main>

    <?php
        include 'footer.php';
    ?>
</body>

</html>