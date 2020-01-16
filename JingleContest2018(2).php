<?php
include ("extentionsssh2.php");
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');
$strServer = "ppepl.fr";
$strServerPort = "22";
$strServerUsername = "luca";
$strServerPassword = "luca";

//connect to server
$resConnection = ssh2_connect($strServer, $strServerPort);

?>
<html>
<h2>Bravo !!!</h2>
<!-- Le type d'encodage des données, enctype, DOIT être spécifié comme ce qui suit -->
<form enctype="multipart/form-data" action="recup_donnees.php" method="post">
    <label for="filename">Nom du fichier (après Upload)</label>
    <input type="text" id="fileName" name="fileName" value="" />
    <input type="file" name="fichier" id="">

    <input type="submit" value="Envoyer le fichier" />
</form>
</html>
<!--'.mp3', '.ogg', '.wav', '.mid','.ac3','.flac','.tta', '.aiff', '.m4a','.wv', '.shn','.ape', '.spx','.au','.wma'-->