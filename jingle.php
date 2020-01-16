<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Infos</title>
</head>
<body>
<h1>Affichage des infos</h1>

<ul>
    <li><?php echo $_POST ['nom'];?></li>
    <li><?php echo $_POST ['prenom'];?></li>
    <li><?php echo $_POST ['email'];?></li>
    <li><?php echo $_POST ['age'];?></li>
    <li><?php echo $_POST ['precisions'];?></li>
    <li><?php echo $_POST ['ameliorer'];?></li>
    <li><?php echo $_FILES ['ameliorer'];?></li>

</ul>
</body>

<?php $suppress_localhost = fasle ;?>


