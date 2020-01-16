<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');

if(isset($_POST['formconnexion'])) {
    $nomconnect = htmlspecialchars($_POST['nomconnect']);
    $prenomconnect = htmlspecialchars($_POST['prenomconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($nomconnect) AND !empty($mdpconnect)AND !empty($prenomconnect)) {
        $requser = $bdd->prepare("SELECT * FROM eleve WHERE nom = ? AND prenom = ? AND passCrypte = ?");
        $requser->execute(array($nomconnect,$prenomconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            header("Location: JingleContest2018(2).php?id=".$_SESSION['id']);
        } else {
            $erreur = "Votre compte n'existe pas !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>
<html>
<head>
    <title>connexion</title>
    <meta charset="utf-8">
</head>
<body>
<div align="center">
    <h2>Connexion</h2>
    <br /><br />
    <form method="POST" action="">
        <input type="text" name="prenomconnect" placeholder="prenom" />
        <input type="text" name="nomconnect" placeholder="nom" />
        <input type="password" name="mdpconnect" placeholder="Mot de passe" />
        <br /><br />
        <input type="submit" name="formconnexion" value="Se connecter !" />
    </form>
    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?>
</div>
</body>
</html>