<?php

/* The purpose of this page is to allow the Instructor and TA's to view the 
actual source code of the files located in the folder up one level from 
the ADMIN folder.

Originally written by Karol Zieba for Bob Erickson
  
Each semester i need to set the $users variable to list all the ta's for that class 

*/

// external files
// $%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#
$cssLink = '//rerickso.w3.uvm.edu/Tools/css/admin.css?' .  time();
$ids = file_get_contents('http://rerickso.w3.uvm.edu/cs-1080-ta.txt');
$ids2 = file_get_contents('http://rerickso.w3.uvm.edu/cs-2480-ta.txt');

$version = 'v2024-1-13';

$debug = false;
if (isset($_GET["x"])) {
    if ($_GET["x"] == 1)
        $debug = true;
}

$title = get_current_user();

$tas_one = $ids;
$tas_two = $ids2;

$classFolder = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

if (strpos($classFolder, 'cs1080') !== false) {
    // tas and assignments for cs 008 
    $users = $tas_one;
    $assignments = array(
        array('folder' => "." , 'restricted' =>0),
        array('folder' => "lab2" , 'restricted' =>0),
        array('folder' => "lab3" , 'restricted' =>0),
        array('folder' => "lab4" , 'restricted' =>0),
        array('folder' => "lab5" , 'restricted' =>0),
        array('folder' => "lab6" , 'restricted' =>0),
        array('folder' => "lab7" , 'restricted' =>0),
        array('folder' => "lab8" , 'restricted' =>0),
        array('folder' => "lab9" , 'restricted' =>0),
        array('folder' => "final" , 'restricted' =>0)
    );
}else{
    // tas and assignments for one other class generally cs 2480 or cs 145
    $users = $tas_two;
    $assignments = array(
        array('folder' => "." , 'restricted' =>0),
        array('folder' => "class-exercise-1" , 'restricted' =>0),
        array('folder' => "class-exercise-2" , 'restricted' =>0),
        array('folder' => "class-exercise-3" , 'restricted' =>0),
        array('folder' => "class-exercise-4" , 'restricted' =>0),
        array('folder' => "class-exercise-5" , 'restricted' =>0),
        array('folder' => "class-exercise-6" , 'restricted' =>0),
        array('folder' => "class-exercise-7" , 'restricted' =>0),
        array('folder' => "live-lab1" , 'restricted' =>0),
        array('folder' => "live-lab2" , 'restricted' =>0),
        array('folder' => "live-lab3" , 'restricted' =>0),
        array('folder' => "live-lab4" , 'restricted' =>0),
        array('folder' => "live-lab5" , 'restricted' =>0),
        array('folder' => "live-lab6" , 'restricted' =>0),
        array('folder' => "live-final" , 'restricted' =>0),
        array('folder' => "dev-lab1" , 'restricted' =>0),
        array('folder' => "dev-lab2" , 'restricted' =>0),
        array('folder' => "dev-lab3" , 'restricted' =>0),
        array('folder' => "dev-lab4" , 'restricted' =>0),
        array('folder' => "dev-lab5" , 'restricted' =>0),
        array('folder' => "dev-lab6" , 'restricted' =>0),
        array('folder' => "dev-lab7" , 'restricted' =>0),
        array('folder' => "dev-final" , 'restricted' =>0)
    );
}

// $%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#
//
// Initial Variables
//

if($debug){
    print "<p>CS (" . $classFolder . ") </p><pre>"; print_r($users); print "</pre>";
    print "<p>Assignments:  </p><pre>"; print_r($assignments); print "</pre>";
}
$body = array();

// Local folder that leads to student's class files
$student_class_folder = get_class_folder();
// example: cs1080
if ($debug)
    print "<p>Student Class Folder: " . $student_class_folder;

// Full path to our class
$student_class_path = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/${student_class_folder}";
// example: /users/r/e/rerickso/www-root/cs1080
if ($debug)
    print "<p>Student Class Path : " . $student_class_path;

// Full path to the admin folder.
$student_admin_path = "${student_class_path}/ADMIN";
// example: /users/r/e/rerickso/www-root/cs1080/ADMIN
if ($debug)
    print "<p>Admin Path : " . $student_admin_path;

// allowed extensions, so we cannot see other file types.
$code_exts = array('py', 'php', 'xml', 'csv', 'html', 'xhtml', 'css', 'js', 'sql', 'java', 'json');
$image_exts = array('jpg', 'jpeg', 'tiff', 'png', 'gif', 'bmp');
$validation_exts = array('php', 'css', 'html', 'xhtml');



//!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$              
//
// If there are no get statements then just list all available assignments.
//

if (empty($_GET)) {
    $title .= " Listing Assignments";
    $body[] = list_assignments($assignments, $student_class_path);
}

// update the htaccess file
$body[] = update_admin_htaccess($student_admin_path);
$body[] = create_class_htaccess($student_class_path);

// $%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#
// 
// Display list or file contents
// 
// // $%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#$%^#
// If a folder is requested then display its contents
if (isset($_GET['folder'])) {
    $title .= " Listing Folder Contents";
    $folder = clean_path(filter_input(INPUT_GET, 'folder', FILTER_SANITIZE_SPECIAL_CHARS));
    $file_paths = bob_scandir("${student_class_path}/${folder}", $student_admin_path, false);
    if ($file_paths === False)
        $body[] = "<p class=\"error\">Folder does not exist. You should create it!</p>";
    else
        $body[] = list_files($file_paths, $student_class_path, $student_class_folder, $code_exts, $validation_exts);
}

// If all files are requested, then show them a list of all files
if (isset($_GET['all'])) {
    $title .= " Listing All Files and Directories";
    $file_paths = bob_scandir($student_class_path, $student_admin_path, true);
    if ($file_paths === False)
        $body[] = "<p class=\"error\">Something is really weird... report this to your TA or Bob.</p>";
    else
        $body[] = list_files($file_paths, $student_class_path, $student_class_folder, $code_exts, $validation_exts);
}

// Provide the contents of this code file
if (isset($_GET['file'])) {
    $title .= " Showing Code File Contents";
    $relative_path = clean_path(filter_input(INPUT_GET, 'file', FILTER_SANITIZE_SPECIAL_CHARS));
    $body[] = show_file($relative_path, $student_class_path, $code_exts);
}

// Provide the contents of this code file
if (isset($_GET['code'])) {
    header('Content-Type:text/plain');
    $relative_path = clean_path(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS));
    print file_get_contents("$student_class_path/$relative_path");
    die();
}

// Provide the contents of all code files in this folder, often an assignment, recursively.
if (isset($_GET['files'])) {
    $title .= " Showing All Code File Contents with Folder";
    $folder = clean_path(filter_input(INPUT_GET, 'files', FILTER_SANITIZE_SPECIAL_CHARS));
    $paths = bob_scandir("${student_class_path}/${folder}", $student_admin_path, true);
    if ($paths === False or count($paths) == 0)
        $body[] = "<p class=\"error\">No files found.</p>";
    else
        foreach ($paths as $file_path) {
            $relative_path = substr($file_path, strlen($student_class_path));
            if (in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), $code_exts))
                $body[] = show_file($relative_path, $student_class_path, $code_exts);
            elseif (in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), $image_exts))
                $body[] = "<h1>${relative_path}</h1><p><img src=\"/${student_class_folder}/${relative_path}\" alt=\"${relative_path}\"></p>";
            elseif (strtolower(pathinfo($file_path, PATHINFO_EXTENSION)) == 'pdf')
                $body[] = "<h1>${relative_path}</h1><p><object type=\"application/pdf\" src=\"/${student_class_folder}/${relative_path}\">It appears that your browser does not support embedding pdf documents.</object></p>";
            else
                $body[] = "<p>Skipping ${relative_path}</p>";
        }
}

///////////////////////////////////////////////////////////////////////////////
// Support Functions //////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
// Returns the root path of this class. This is to ensure that this class path serves as our root
// so that we can not show other file contents.
function get_class_folder() {
    $path = '';

    $split = explode('/', filter_input(INPUT_SERVER, 'PHP_SELF'));
    for ($i = 0; $i < count($split) - 2; $i++)
        if ($split[$i])
            $path .= "/" . $split[$i];
    if ($path[0] == '/')
        return substr($path, 1);
    return $path;
}

// Creates a default class htaccess file that forces the use of https and
// creates a default index page that displays contents. If an htaccess file
// already exists then it is not changed.
function create_class_htaccess($student_class_path) {
    $class_htaccess = "
SetEnv wsgi_max_requests 10
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}

<Files *>
  Options +Indexes
</Files>
";
    $file_path = "${student_class_path}/.htaccess";
    if (file_exists($file_path))
        return "<!-- Class htaccess already exists -->";
    if (file_put_contents($file_path, $class_htaccess))
        return "<!-- Created class htaccess -->";
    return "<!-- Unable to create class htaccess -->";
}

// Update the htaccess contents. 
function update_admin_htaccess($student_admin_path) {
    global $users;
    $output = "";
    $existing_contents = "";

    $file_path = "${student_admin_path}/.htaccess";
    if (file_exists($file_path)) {
        $existing_contents = file_get_contents($file_path);
    }
    // Create a list of users who can view this admin page, begining with the user
    $split = explode('@', filter_input(INPUT_SERVER, 'SERVER_ADMIN'));
    $users =  str_replace("\n", "", $users) . ' ' . $split[0];

    $htaccess_contents = "
SetEnv wsgi_max_requests 10
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI}

<Files *>
  Options -Indexes
  AuthType CAS
  require user $users
  satisfy any
  order allow,deny
</Files>
";
    // If there is an update, then write our new admin htaccess. Otherwise
    if ($htaccess_contents == $existing_contents)
        return "${output}\n<!-- No changes needed to ${file_path} -->";
    if (file_put_contents($file_path, $htaccess_contents))
        return "${output}\n<!-- Synchronized ${file_path} -->";
    return "${output}\n<!-- Failed sync on ${file_path} -->";
}

// Traverse the root path, ignoring skiping over any match to bad path. Returns an array of paths
function bob_scandir($root_path, $bad_path, $recursive) {
    $output = array();
    if (file_exists($root_path)){
        $paths = scandir($root_path);
        if ($paths === False)
            return False;
        foreach ($paths as $path) {
            $potential_path = "${root_path}/${path}";

            // Ignore any files in the bad (admin) path or files that begin with a period.
            if ($potential_path == $bad_path or $path[0] == '.')
                continue;

            $output[] = $potential_path;
            $bad_folder = ''; // not sure what this is for
            if ($recursive and is_dir($potential_path)) // Recursively descend and print out files.
                $output = array_merge($output, bob_scandir($potential_path, $bad_folder, $recursive));
        }
    }
    return $output;
}

// Converts a provided octal into a permissions string and reutrns it
function perms($oct) {
    $str = decoct($oct);
    $out = substr($str, -5, 1) & 4 ? 'd' : '-';
    for ($i = -3; $i < 0; $i++) {
        $perm = substr($str, $i, 1);
        $out .= $perm & 4 ? 'r' : '-';
        $out .= $perm & 2 ? 'w' : '-';
        $out .= $perm & 1 ? 'x' : '-';
    }
    return $out;
}

// Retreive a remote file and return its contents
function url_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

// Removes .. and /. from paths
function clean_path($dirty_path) {
    $cleaner_path = preg_replace('/\.[\.]+/', '', $dirty_path);
    return preg_replace('/\/\./', '', $cleaner_path);
}

// Show the contents of a file to the screen.
// Only show it if it's extension is part of the allowable extensions and
// is readable
function show_file($relative_path, $student_class_path, array $required_exts) {
    $file_path = "${student_class_path}/${relative_path}";
    $file_code = "<h1>$relative_path</h1>\n";
    if (in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), $required_exts) and
            is_readable($file_path) and basename($relative_path) != "pass.php") {

        $contents = file_get_contents($file_path);
        $file_code .= "<pre><code>\n";
        $file_code .= filter_var($contents, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $file_code .= "</code></pre>\n";
    } else
        $file_code .= "<p class=\"error\">File is unreadable, has an invalid extension, or is a password file.</p>";
    return $file_code;
}

function list_assignments($assignments, $root_path) {
    $now = time();
    $output = "<table>\n<tr>";
    $output .= "<th>Permission</th>";
    $output .= "<th>Browse</th>";
    $output .= "<th>Due Date</th>";
    $output .= "<th>Files</th>";
    $output .= "</tr>\n";
    if(is_array($assignments)){
        foreach ($assignments as $assignment) {
            $path = $root_path . '/' . $assignment['folder'];
            $stat = @stat($path);

            $output .= '<tr>';
            $output .= '<td>' . perms($stat['mode']) . '</td>';
            $output .= '<td><a class="folder" href="?folder=' . $assignment['folder'] .'"> ' . $assignment['folder'] . '</a></td>';    
            $output .= '<td><a class="code" href="?files=' . $assignment['folder'] . '">All Code</a></td>';
            $output .= '</tr>' .PHP_EOL;
        }
    }
    $output .= '</table>' .PHP_EOL;
    return $output;
}

// Returns output HTML of a table that contains a row for each file in $file_paths.
// These are aranged similarly to the index that Apache provides.
function list_files($file_paths, $root_path, $student_class_folder, array $code_exts, array $validation_exts) {
    // Prepare header row
    $output = "<table>\n<tr>";
    $output .= "<th>Permission</th>";
    //$output .= "<th>User</th>";
    //$output .= "<th>Group</th>";
    $output .= "<th>File</th>";
    $output .= "<th>Modify Date</th>";
    $output .= "<th>Size</th>";
    $output .= "<th>Extra</th>";
    $output .= "</tr>\n";

    foreach ($file_paths as $file_path) {
        $relative_path = substr($file_path, strlen($root_path) + 1);
        // $split = split("/", $relative_path);
        $split = explode("/", $relative_path);
        $filename = $split[count($split) - 1];
        $stat = @stat($file_path);

        $output .= '<tr>';
        $output .= '<td>' . perms($stat['mode']) . '</td>';
        //$output .= '<td>' . $stat['uid'] . '</td>';
        //$output .= '<td>' . $stat['gid'] . '</td>';
        // Display the correct link to our files
        if (is_dir($file_path))
            $output .= "<td><a class=\"folder\" href=\"?folder=$relative_path\"";
        elseif (in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), $code_exts))
            $output .= "<td><a class=\"code\" href=\"?file=$relative_path\"";
        else
            $output .= "<td><a class=\"show\" target=\"_blank\" href=\"/${student_class_folder}/${relative_path}\"";
        $output .= ">" . $relative_path . "</a></td>"; //. $filename 

        // Show the date. Depending on the due date color the text
        $ctime = date('Y-m-d H:i:s', $stat['ctime']);
        $mtime = date('Y-m-d H:i:s', $stat['mtime']);
        $output .= "<td";
        
        $output .= ">$mtime</td>";

        // Add a cell for the size. Ignore directories
        if (is_dir($file_path))
            $output .= "<td>&nbsp</td>";
        else
            $output .= '<td class="right">' . $stat['size'] . '</td>';

        // Add a cell for a validation link. Only do it for files we're checking.
        if (in_array(strtolower(pathinfo($file_path, PATHINFO_EXTENSION)), $validation_exts)) {
            $server_name = filter_input(INPUT_SERVER, 'SERVER_NAME');
            $url = "https://${server_name}/${student_class_folder}/${relative_path}";
            $output .= "<td><a target=\"_blank\" href=\"http://validator.w3.org/check?uri=$url\">Validate</a></td>";
        } elseif (is_dir($file_path))
            $output .= "<td><a class=\"code\" href=\"?files=${relative_path}\">View Code</a></td>";

        //$output .= "<td>&nbsp;</td>";

        $output .= "</tr>\n";
    }
    $output .= "</table>\n";

    if (count($file_paths) == 0)
        $output .= "<p class=\"error\">There are no files to display</p>";

    return $output;
}

///////////////////////////////////////////////////////////////////////////////
// HTML ///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php print $cssLink; ?>">
    </head>
    <body id="admin" style="padding: 1em;">
    <p style='text-align: right; display: block;'><?php print $version; ?></p>
        <nav>
            <ul>
                <li><a href="code-viewer.php?">Assignments</a></li>
                <li><a href="code-viewer.php?all">List of Files</a></li>
                <li><a href="table-viewer.php?getDatabase=" target="_blank">Table Viewer</a></li>
                <li><a href="../sitemap.php" target="_blank">Site map</a></li>
            </ul>
        </nav>
        <?php print implode("\n", $body); ?>
    </body>
</html>
