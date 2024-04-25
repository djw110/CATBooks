<nav>
        <a  class ="<?php
            if($pathParts['filename'] == "index"){
                print 'activePage';
            }
        ?>" href="index.php">Home</a>
        <a  class ="<?php
            if($pathParts['filename'] == "library"){
                print 'activePage';
            }
        ?>" href="library.php">Library</a>
        <a  class ="<?php
            if($pathParts['filename'] == "form"){
                print 'activePage';
            }
        ?>" href="form.php">Book</a>
</nav>
