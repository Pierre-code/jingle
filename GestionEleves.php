<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=jingle', 'root', '');
//$bdd->select_db( 'database_name' );
//$bdd->query("eleve");


if(isset($_POST['forminscription'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    $classe = htmlspecialchars($_POST['classe']);
    $equipe = htmlspecialchars($_POST['equipe']);

    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['classe']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])AND !empty($_POST['equipe'])) {
        $nomlength = strlen($nom);
        if($nomlength <= 255) {
/*            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if($mailexist == 0) {*/
                        if($mdp == $mdp2) {
                            $longueurKey = 16;
                            /*$key = "";
                            for ($i = 1; $i<$longueurKey; $i++)
                            {
                                $key .= mt_rand(0,9);
                            }*/
                            /*var_dump($equipe);*/
                            $insertmbr = $bdd -> prepare("INSERT INTO eleve (nom, prenom, passCrypte, classe, equipe) VALUES (?,?,?,?,?)");
                            /*var_dump ($insertmbr);*/
                            $insertmbr->execute(array($nom, $prenom, $mdp, $classe, $equipe));
                            //$insertmbr->execute();

                            $erreur = "Votre compte a bien été créé ! <a href=\"connection.php\">Me connecter</a>";
                        } else {
                            $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                    /*} else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                    $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
            }*/
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
$pdoStat = $bdd -> prepare('SELECT * FROM eleve');
$executeIsOk = $pdoStat-> execute();
$contacts = $pdoStat->fetchAll();

?>


<html>
<head>
    <title>inscription</title>
    <meta charset="utf-8">
    <script src="incriptionn.js"></script>
    <script src="jquery-1.3.2.min.js"></script>
</head>
<body>
<div align="center">
    <h1>Inscription</h1>
    <br /><br />
    <h2>Création de groupe</h2>
    <form method="POST" action="">
        <table>
            <tr>
                <td align="right">
                    <label for="nom">Nom :</label>
                </td>
                <td>
                    <input type="text" placeholder="Nom de l'élève" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="prenom">Prénom :</label>
                </td>
                <td>
                    <input type="text" placeholder="Prenom de l'élève" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="classe">Classe :</label>
                </td>
                <td>
                    <select name="classe" id="classe" cols="38" rows="18">
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
                    <select name="equipe" id="equipe" cols="38" rows="18">
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
            <tr>
                <td align="right">
                    <label for="mdp">Mot de passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Définir un mdp" id="mdp" name="mdp" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    <label for="mdp2">Mot de Passe :</label>
                </td>
                <td>
                    <input type="password" placeholder="Confirmation du mdp" id="mdp2" name="mdp2" value="<?php if(isset($mdp2)) { echo $mdp2; } ?>"/>
                </td>
            </tr>

                <td align="center">
                    <br />
                    <input type="submit" name="forminscription" value="Je m'inscris" />
                </td>
            </tr>
        </table>

    </form>
    <h1>liste des personnes inscrites</h1>
    <ul>
        <?php foreach ($contacts as $contact): ?>
        <li>
            <?= $contact['nom'] ?> - <?= $contact['prenom'] ?> - <?= $contact['passCrypte'] ?> - <?= $contact['classe'] ?> - <?= $contact['equipe'] ?>
            <a href="supprimer.php?numContact=<?= $contact['id']?>">Supprimer</a>
            <a href="modification.php?numContact=<?= $contact['id']?>">Modifier</a>
        </li>

        <?php endforeach; ?>
    </ul>
    <h2>Aide</h2>
    <h3>Classe</h3>
    <table>
        <tr>
            <td>
                1
            </td>
            <td>
                maternelle
            </td>
        </tr>
        <tr>
            <td>
                2
            </td>
            <td>
                CP
            </td>
        </tr>
        <tr>
            <td>
                3
            </td>
            <td>
                CE1
            </td>
        </tr>
        <tr>
            <td>
                4
            </td>
            <td>
                CE2
            </td>
        </tr>
        <tr>
            <td>
                5
            </td>
            <td>
                CM1
            </td>
        </tr>
        <tr>
            <td>
                6
            </td>
            <td>
                CM2
            </td>
        </tr>
        <tr>
            <td>
                7
            </td>
            <td>
                6ème
            </td>
        </tr>
        <tr>
            <td>
                8
            </td>
            <td>
                5ème
            </td>
        </tr>
        <tr>
            <td>
                9
            </td>
            <td>
                4ème
            </td>
        </tr>
        <tr>
            <td>
                10
            </td>
            <td>
                3ème
            </td>
        </tr>
        <tr>
            <td>
                11
            </td>
            <td>
                Seconde
            </td>
        </tr>
        <tr>
            <td>
                12
            </td>
            <td>
                Première
            </td>
        </tr>
        <tr>
            <td>
                13
            </td>
            <td>
                Terminal
            </td>
        </tr>
        <tr>
            <td>
                14
            </td>
            <td>
                BTS
            </td>
        </tr>
    </table>
    <h3>Equipe</h3>
    <table>
        <tr>
            <td>
                1
            </td>
            <td>
                Rouge
            </td>
        </tr>
        <tr>
            <td>
                2
            </td>
            <td>
                Bleu
            </td>
        </tr>
        <tr>
            <td>
                3
            </td>
            <td>
                Vert
            </td>
        </tr>
        <tr>
            <td>
                4
            </td>
            <td>
                Violet
            </td>
        </tr>
        <tr>
            <td>
                5
            </td>
            <td>
                Jaune
            </td>
        </tr>
        <tr>
            <td>
                6
            </td>
            <td>
                Orange
            </td>
        </tr>
        <tr>
            <td>
                7
            </td>
            <td>
                Gris
            </td>
        </tr>
        <tr>
            <td>
                8
            </td>
            <td>
                Noir
            </td>
        </tr>
        <tr>
            <td>
                9
            </td>
            <td>
                Blanc
            </td>
        </tr>
        <tr>
            <td>
                10
            </td>
            <td>
                Marron
            </td>
        </tr>
        <tr>
            <td>
                11
            </td>
            <td>
                Alpine
            </td>
        </tr>
        <tr>
            <td>
                12
            </td>
            <td>
                Mauve
            </td>
        </tr>
        <tr>
            <td>
                13
            </td>
            <td>
                Turquoise
            </td>
        </tr>
        <tr>
            <td>
                14
            </td>
            <td>
                Taupe
            </td>
        </tr>
    </table>
    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?>


</div>
</body>
</html>
