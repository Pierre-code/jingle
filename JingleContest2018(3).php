<head>
    <meta name="ROBOTS" content="all">
    <meta name="keywords" content="mot clé 1,mot cle 2,Mot clé 3, Mots clefs">
    <meta name="title" content="titre de votre page">
    <title>titre de votre page</title>
</head>
<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');

// on choisit la bonne base


echo "
<html>

<head>

<title>Résultat de la recherche</title>

</head>

<body>";

if (($Mot == "")||($Mot == "%")) {
// Si aucun mot clé n'a été saisi,
// le script demande à l'utilisateur
// de bien vouloir préciser un mot clé

    echo "
Veuillez entrer un mot clé s'il vous plaît!
<p>";

}

else {
// On selectionne les enregistrements contenant le mot clé
// dans les keywords ou le titre
    $query = "SELECT distinct count(lien) FROM search
WHERE keyword LIKE \"%$Mot%\"
OR titre LIKE \"%$Mot%\"
";

    $result = mysql_query($query);

    $row = mysql_fetch_row($result);

    $Nombre = $row[0];

// Si aucun enregistrement n'est retourné,
// on affiche un message adéquat
    if ($Nombre == "0") {
        echo "
<h2>Aucun résultat ne correspond à votre recherche</h2>

<p>

";

    }

// Sinon, on affiche le nombre d'enregistrements correspondant
// et les résultats eux-mêmes
    else {
        $query = "SELECT distinct lien,keyword,titre FROM search
WHERE keyword LIKE \"%$Mot%\"
OR titre LIKE \"%$Mot%\" ORDER by titre ASC";

        $result = mysql_query($query);

// Si un seul enregistrement est trouvé, on affiche un message au singulier
        if ($Nombre == "1") {
            echo "
<a name=\"#resultat\"><h2>Résultat: Un article trouvé</h2></a>

<p>";

        }
// Dans le cas contraire le message est au pluriel...
        else {
            echo "
<a name=\"#resultat\"><h2>Résultat: $Nombre articles trouvés</h2></a>

<p>";

        }
        while($row = mysql_fetch_row($result))
        {
            echo "
<p>\n
<b>$row[2]</b>\n
<br><a href=\"../$row[0]\">Visualiser l'article</a>\n
<p>\n
";

        }
    }

}



?>

</body>

</html>

<form method="post" action="search.php">

    Entrez un mot clé:<br>

    <input type="text" name="Mot" size="15">

    <input type="submit" value="Rechercher" alt="Lancer la recherche!">

</form>