<?php
    $databaseName = 'DWHOOLEY_labs';
    $dsn = 'mysql:host=webdb.uvm.edu;dbname=' . $databaseName;
    $username = 'dwhooley_writer';
    $password = 'Io8HKN[+-sx,s8ekogJB';

    $pdo = new PDO($dsn, $username, $password);
    if($pdo) print '<!-- Connection complete -->';
?>