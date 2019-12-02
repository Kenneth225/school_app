<?php
try
{
$bdd = new PDO('mysql:host=ftp.jeboostemonentreprise.com;dbname=jeboostemonentre_myAlito', 'jeboostemonentre_myalitousr', 'ZKSriGs*Ahk,');
}catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
?>