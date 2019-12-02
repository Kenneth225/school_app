<?php
    $username = "jeboostemonentre_myalitousr";
    $password = "ZKSriGs*Ahk,";
    $hostname = "ftp.jeboostemonentreprise.com";
    $db_name = "jeboostemonentre_myAlito";

    //connection to the database
    $mysqli = new mysqli($hostname, $username, $password, $db_name);
    /* check connection */
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
?>
