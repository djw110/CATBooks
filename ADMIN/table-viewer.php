<?php
include 'credentials.php';

$debug = isset($_GET['x']) ? true : false;

$version = 'v2024-1-13';
$cssLink = '//rerickso.w3.uvm.edu/Tools/css/admin.css?' .  time();
$title = get_current_user() . ' - Table Information ' . $version;

/* please put your reader password in a file named credentials.php that you sftp to your the ADMIN folder
   which acknowledges that you give us reader permission on your database to remove access after the 
   class is over change your password to xxxx. Your credentials.php should look like this:

<?php
$password = 'your reader password';
?>


*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php print $cssLink; ?>">
    <style>
    /*    grid set up    */
        #admin .container {
            display: grid;
            grid-template-areas: "databases tables" "records tables";
            grid-template-columns: auto auto;
            grid-gap: 2em;
        }
        .databases {
            grid-area: databases;
        }

        .tables {
            grid-area: tables;
        }

        .records {
            grid-area: records;
        }

        @media only screen and (max-width: 750px) {
            .databases {
                grid-template-areas: "databases" "tables" "records";
                grid-template-columns: auto;
            }
        }
        </style>
</head>

<?php

function runQuery($query = '', $values = '', $code = '')
{
    global $pdo;
    $statement = $pdo->prepare($query);

    if (is_array($values)) {
        $statement->execute($values);
    } else {
        $statement->execute();
    }
    $results = $statement->fetchAll();

    return $results;
}

print '<body id="admin" style="padding: 1em;">
    <p style="text-align: right; display: block;">'. $version . '</p>' .
'<nav>
            <ul>
                <li><a href="code-viewer.php?">Assignments</a></li>
                <li><a href="code-viewer.php?all">List of Files</a></li>
                <li><a href="table-viewer.php?getDatabase=" target="_blank">Table Viewer</a></li>
                <li><a href="../sitemap.php" target="_blank">Site map</a></li>
            </ul>
        </nav>
' . PHP_EOL;
//##############################################################################
//
// This page lists your tables and fields within your database. if you click on
// a database name it will show you all the records for that table. 
// 
// 
// This file is only for class purposes and should never be publicly live
//##############################################################################
if ($password == '') {
    print "<p>Your credentials.php is not set up so this page will not work. Please contact your instructor.</p>";
    die();
}

$databaseName = '';

$currentUser = get_current_user();

$databaseName = isset($_GET['getDatabase']) ? htmlentities($_GET['getDatabase'], ENT_QUOTES, "UTF-8") : strtoupper($currentUser);

$dsn = 'mysql:host=webdb.uvm.edu;';
if(strpos($databaseName, '_')) $dsn .= 'dbname=' . $databaseName;

$username = $currentUser . '_reader';
$pdo = null;

if ($debug) {
    print '<section class="debug"><p>Try connecting with phpMyAdmin with these credentials.</p>';
    print '<p>Username: ' . $username;
    print '<p>DSN: ' . $dsn;
    print '<p>Password: ' . $password;
    print '</section>';
}

try {
    $pdo = new PDO($dsn, $username, $password);

    if (!$pdo) {
        if ($debug) echo '<section class="debug"><p>You are NOT connected to the database!</p></section>';
    } else {
        if ($debug) echo '<section class="debug"><p>You are connected to the database!</p></section>';
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    if ($debug) print '<section class="debug"><p>An error occurred while connecting to the database: $error_message </p></section>'. PHP_EOL;
}


print '<section class="container">';
// print out a list of all the tables and their description
// make each table name a link to display the record
print '<table class="databases">' . PHP_EOL;
print '<caption>Databases</caption>';
$query = 'SHOW DATABASES';
$results = runQuery($query);

// loop through all the tables in the database, display fields and properties
if (is_array($results)) {
    foreach ($results as $row) {
        if (substr($row[0], -7) != '_schema') {
            // table name link
            print '<tr';
            print $databaseName == $row[0] ? ' class="current"' : '';
            print '>';
            print '<th>';
            print '<a href="?getDatabase=' . htmlentities($row[0], ENT_QUOTES) . '">';
            print htmlentities($row[0], ENT_QUOTES) . '</a>';
            print '</th>';
            print '</tr>';
        }
    }
}
print '</table>' . PHP_EOL;

if (str_contains($databaseName, '_')) {
    $tables = '';
    $tableName = '';

    if ($databaseName != strtoupper(get_current_user())) {
        if (isset($_GET['getRecordsFor'])) {
            $tableName = htmlentities($_GET['getRecordsFor'], ENT_QUOTES, "UTF-8");
        }

        // print out a list of all the tables and their description
        // make each table name a link to display the record

        print '<table class="tables">' . PHP_EOL;
        print '<caption>Table Structure</caption>';
        $query = 'SHOW TABLES';
        $tables = runQuery($query);

        // loop through all the tables in the database, display fields and properties
        if (is_array($tables)) {
            foreach ($tables as $table) {

                //get the fields and any information about them
                $query = 'SHOW COLUMNS FROM ' . $table[0];
                $columns = '';
                $columns = runQuery($query);

                $span = count($columns);

                // table name link
            print '<tr';
            print $tableName == $table[0] ? ' class="current"' : '';
            print '>';
                print '<th colspan="' . $span . '">';
                print '<a href="?getDatabase=' . $databaseName . '&getRecordsFor=' . htmlentities($table[0], ENT_QUOTES) . '">';
                print htmlentities($table[0], ENT_QUOTES) . '</a>';
                print '</th>';
                print '</tr>';

                foreach ($columns as $field) {
                    print '<tr>';
                    print '<td>' . $field['Field'] . '</td>';
                    print '<td>' . $field['Type'] . '</td>';
                    print '<td>' . $field['Null'] . '</td>';
                    print '<td>' . $field['Key'] . '</td>';
                    print '<td>' . $field['Default'] . '</td>';
                    print '<td>' . $field['Extra'] . '</td>';
                    print '</tr>';
                }
            }
        }
        print '</table>' . PHP_EOL;
    }

    // Display all the records for a given table
    if ($tableName != "") {
        //get the fields and any information about them
        $query = 'SHOW COLUMNS FROM ' . $tableName;
        $fields = '';
        $fields = runQuery($query);

        $fieldCount = count($fields);
        //print out the table name and how many records there are
        print '<table class="records">' . PHP_EOL;
        print '<caption>Data Records</caption>';
        $query = 'SELECT * FROM ' . $tableName;
        $allRecords = '';
        $allRecords = runQuery($query);

        print '<tr>';
        print '<th colspan=' . $fieldCount . '>' . $query;
        print '</th>';
        print '</tr>';

        print '<tr>';
        print '<th colspan=' . $fieldCount . '>' . $tableName;
        print ' ' . count($allRecords) . ' records';
        print '</th>';
        print '</tr>';

        // print out the column headings, note i always use a 3 letter prefix
        // and camel case like pmkCustomerId and fldFirstName
        print '<tr>';

        // loop through all the tables in the database, display fields and properties
        if (is_array($fields)) {
            foreach ($fields as $field) {
                print '<td>';
                $camelCase = preg_split('/(?=[A-Z])/', substr($field[0], 3));

                foreach ($camelCase as $one) {
                    print $one . " ";
                }
                print '</td>';
            }
        }
        print '</tr>';

        foreach ($allRecords as $rec) {
            print '<tr>';
            for ($i = 0; $i < $fieldCount; $i++) {
                print '<td>' . $rec[$i] . '</td>';
            }
            print '</tr>';
        }

        // all done
        print '</table>' . PHP_EOL;
    }
}

?>
</section>
</body>
</html>
