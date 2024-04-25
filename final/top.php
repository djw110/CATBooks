<?php
    $phpSelf = htmlspecialchars($_SERVER['PHP_SELF']);
    $pathParts = pathinfo($phpSelf);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--Define Title and Meta Tags-->
    <meta charset="utf-8">
    <title>CATBooks</title>
    <meta name="author" content="Daniel Whooley">
    <meta name="description" content="Welcome to the UVM Online Book Club">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <!--Determine Style for the Document-->
    <link href="css/custom.css?version=<?php print time(); ?>"
          type="text/css"
          rel="stylesheet">
    <link href="css/layout-desktop.css?version=<?php print time(); ?>"
          type="text/css"
          rel="stylesheet"> 
    <link href="css/layout-tablet.css?version=<?php print time(); ?>"
          type="text/css"
          rel="stylesheet"
          media="(max-width:820px)">
    <link href="css/layout-iphone.css?version=<?php print time(); ?>"
          type="text/css"
          rel="stylesheet"
          media="(max-width:430px)">
</head>

<?php
      print '<body class="' . $pathParts['filename'] . '">';
      include 'database-connect.php';
      include 'header.php';
      include 'nav.php';
?>