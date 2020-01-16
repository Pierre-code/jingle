<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');

$pdoStat =$bdd -> prepare('SELECT * FROM eleve WHERE id=:num ');

$pdoStat ->bindValue(':num', $_GET['numContact'], PDO::PARAM_INT);

$executeIsOk = $pdoStat ->execute();

$contact = $pdoStat->fetch();


?>
<html>
<head>
    <title>Modification</title>
    <meta charset="utf-8">
    <script src="incriptionn.js"></script>
    <script src="jquery-1.3.2.min.js"></script>
</head>
<body>
<div align="center">
    <h1>Modification</h1>
    <br /><br />
    <h2>Modification d'un groupe</h2>
    <form method="POST" action="modifier.php">
        <input type="hidden" name="numContact" value="<?= $contact['id'] ?>"><!--cacher de l'utilisateur c'est pour reprendre son id-->
        <table>
            <tr>
                <td align="right">
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input type="text" placeholder="Nom de l'élève" id="nom" name="nom" value="<?= $contact['nom']; ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input type="text" placeholder="Prenom de l'élève" id="prenom" name="prenom" value="<?= $contact['prenom']; ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="classe">Classe :</label>
                </td>
                <td>
                    <select name="classe" id="classe" cols="38" rows="18" value="<?= $contact['classe']; ?>">
                        <option value="1">maternelle</option>
                        <option value="2">CP</option>
                        <option value="3">CE1</option>
                        <option value="4">CE2</option>
                        <option value="5">CM1</option>
                        <option value="6">CM2</option>
                        <option value="7">6ème</option>
                        <option value="8">5ème</option>
                        <option value="9">4ème</option>
                        <option value="10">3ème</option>
                        <option value="11">Seconde</option>
                        <option value="12">Première</option>
                        <option value="13">Terminal</option>
                        <option value="14">BTS</option>
                    </select>
                    <!--                    <input type="text" placeholder="Classe de l'élève" id="classe" name="classe" />-->
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="equipe">Equipe :</label>
                </td>
                <td>
                    <select name="equipe" id="equipe" cols="38" rows="18" value="<?= $contact['equipe']; ?>">
                        <option value="1">rouge</option>
                        <option value="2">bleu</option>
                        <option value="3">vert</option>
                        <option value="4">violet</option>
                        <option value="5">jaune</option>
                        <option value="6">orange</option>
                        <option value="7">gris</option>
                        <option value="8">noir</option>
                        <option value="9">blanc</option>
                        <option value="10">marron</option>
                        <option value="11">alpine</option>
                        <option value="12">mauve</option>
                        <option value="13">turquoise</option>
                        <option value="14">taupe</option>
                    </select>
                    <!--                    <input type="text" placeholder="Nom de l'équipe" id="équipe" name="équipe" />-->
                </td>
            </tr>
            <!--<tr>
                <td align="right">
                    <label for="mdp">Mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Définir un mdp" id="mdp" name="mdp" value="<?/*= $contact['passCrypte']; */?>"/><p>Pensez à bien remodifier le mot de passe obligatoirement</p>
                </td>
            </tr>-->
            <!--<tr>
                <td align="right">
                    <label for="mdp2">Mot de Passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmation du mdp" id="mdp2" name="mdp2" value="<?/*= $contact['']; */?>"/>
                </td>
            </tr>-->

            <td align="center">
                <br />
                <input type="submit" name="forminscription" value="Je modifie" />
            </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>