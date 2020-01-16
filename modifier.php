<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');

$pdoStat = $bdd ->prepare('UPDATE eleve set nom=:nom, prenom=:prenom, classe=:classe, equipe=:equipe/*, passCrypte=:passCrypte*/ WHERE id=:num LIMIT 1');

$pdoStat ->bindValue(':num', $_POST['numContact'], PDO::PARAM_INT);
$pdoStat ->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
$pdoStat ->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
$pdoStat ->bindValue(':classe', $_POST['classe'], PDO::PARAM_INT);
$pdoStat ->bindValue(':equipe', $_POST['equipe'], PDO::PARAM_INT);
//$pdoStat ->bindValue(':passCrypte', $_POST['mdp'], PDO::PARAM_STR);

$executeIsOk = $pdoStat -> execute();

if ($executeIsOk)
{
    $message = 'La Personne à été mis à jour';
}
else
{
    $message = 'Une Erreur cest produite';
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier</title>

</head>
<body>
<h1>Modifier</h1>
<p><?= $message ?></p>
<a href="GestionEleves.php">Retour</a>
</body>
<html>
