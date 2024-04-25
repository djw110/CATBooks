<?php
    include 'top.php';
?>

        <main>


            <pre>
                <h2>Create Book Table</h2>
                <code>
                CREATE TABLE tblBooks (
                    pmkBookID INT AUTO_INCREMENT PRIMARY KEY,
                    fldTitle VARCHAR(60),
                    fldLastName VARCHAR(18),
                    fldFirstName VARCHAR(18),
                    fldYear INT,
                    fldGenre VARCHAR(18),
                    fldSummary VARCHAR(5000),
                    varRating INT
                )
                </code>

                <h2>Create Review Table</h2>
                <code>
                CREATE TABLE tblReviews (
                    pmkReviewID INT AUTO_INCREMENT PRIMARY KEY,
                    fkBookID INT,
                    fldReview VARCHAR(5000),
                    fldScore INT,
                    fldEmail VARCHAR(50),
                    FOREIGN KEY (fkBookID) REFERENCES tblBooks(pmkBookID)
                )
                </code>

                <h2>Fetch Top 5 Books</h2>
                <code>
                    SELECT fldTitle, fldLastName, fldFirstName, fldYear, varRating FROM tblBooks 
                    ORDER BY varRating DESC 
                    LIMIT 5
                </code>

                <h2>Fetch 5 Recently Added Books</h2>
                <code>
                    SELECT fldTitle, fldLastName, fldFirstName, fldYear, varRating FROM tblBooks 
                    ORDER BY pmkBookID DESC 
                    LIMIT 5
                </code>

                <h2>Submit Review</h2>
                <code>
                    INSERT INTO tblReviews(fkBookID, fldReview, fldScore, fldEmail) 
                    VALUES (?,?,?,?)
                </code>

                <h2>Insert Form Data</h2>
                <code>
                    INSERT INTO tblBooks(fldTitle, fldLastName, fldFirstName, fldYear, fldGenre, fldSummary, varRating) 
                    VALUES (?,?,?,?,?,?,?)
                </code>

                <h2>Fetch Book Reviews</h2>
                <code>
                    SELECT fldReview, fldScore, fldEmail FROM tblReviews 
                    WHERE fkBookID = ? 
                    ORDER BY pmkReviewID DESC
                </code>

                <h2>Fetch Book Data</h2>
                <code>
                    SELECT fldTitle, fldLastName, fldFirstName, fldYear, fldGenre, fldSummary, varRating FROM tblBooks 
                    WHERE pmkBookID = ?
                </code>

                <h2>Set New Score for Book</h2>
                <code>
                    UPDATE tblBooks SET varRating = ? 
                    WHERE pmkBookID = ?
                </code>

                <h2>Fetch Scores For Book</h2>
                <code>
                    SELECT fldScore FROM tblReviews 
                    WHERE fkBookID = ?
                </code>

            </pre>
        </main>

        <?php
            include 'footer.php';
        ?>

    </body>

</html>