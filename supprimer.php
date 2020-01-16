<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');

$pdoStat =$bdd -> prepare('DELETE FROM eleve WHERE id=:num LIMIT 1');// sécu supprime une ligne par exectution

$pdoStat ->bindValue(':num', $_GET['numContact'], PDO::PARAM_INT); // dire que c'est un paramètre de type int

$executeIsOk = $pdoStat ->execute();

if ($executeIsOk)
{
    $message = 'le contact a été supprimé';

}
else
{
    $message = 'Echec de la suppression de l élève';
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suppression</title>

</head>
<body>
<h1>Suppression</h1>
<p><?= $message ?></p>
<a href="GestionEleves.php">Retour</a>
</body>
<html>
