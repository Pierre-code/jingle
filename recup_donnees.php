<?php
/**
 * Created by PhpStorm.
 * User: pierr
 * Date: 19/03/2018
 * Time: 16:30
 */
var_dump($_POST['fileName']);
var_dump($_FILES);
// a t il été envoyer
if (!empty($_FILES['fichier']['tmp_name']))
{
// été correctement uploadé
    if(is_uploaded_file($_FILES['fichier']['tmp_name']))
    {
        // a t il un type autorisé
        $typeMime = mime_content_type($_FILES['fichier']['tmp_name']);

        if ($typeMime == 'application/pdf')
        {
            // taille
            $size = filesize($_FILES['fichier']['tmp_name']);
            if ($size > 1000000)
            {
                $message = "le fichier ne doit pas dépasser 1Mo";
            }
            else
            {
                //nettoyage nom du fichier
                $nomAvantNettoyage = $_POST['fileName'];
                // remplacer les caractères qui ne sont pas des lettres ni des nombre par un tiret
                $nomEnCoursDeNettoyage = preg_replace('~[^\\pL\d]+~u','-', $nomAvantNettoyage);
                //retire les tirets
                $nomEnCoursDeNettoyage = trim($nomEnCoursDeNettoyage, '-');
                //passer d'un encodage utf-8 à un encodage
                $nomEnCoursDeNettoyage = iconv('utf-8','us-ascii//TRANSLIT',$nomEnCoursDeNettoyage);
                // nom en minuscule
                $nomEnCoursDeNettoyage = strtolower($nomEnCoursDeNettoyage);
                //suppression des caractères indésirable
                $nomNettoye = preg_replace('~[^-\w]+~','', $nomEnCoursDeNettoyage);
                //chemin complet de destination
                $extensions = substr(strrchr($_FILES['fichier']['name'], "."),1);
                $cheminDEDestination = 'son/'.$nomNettoye.'.'.$extensions;
                // déplacer le fichier avec le nouveau nom
                /*$moveIsOk = move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminDEDestination);
                $cheminEtNomTemporaire = $_FILES['fichier']['tmp_name'];

//récupération de l'extentions du fichier
                $extensions = substr(strrchr($_FILES ['fichier']['name'],"."),1);
                $nouveauNom = $_POST['fileName'].'.'.$extensions;

                $cheminEtNomDefinitif = 'son/'.$nouveauNom;*/

                //$moveIsOk = move_uploaded_file($cheminEtNomTemporaire, $cheminEtNomDefinitif);
                $moveIsOk = move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminDEDestination);

                if ($moveIsOk)
                {
                    $message = "Le fichier a été uploadé dans ".$cheminDEDestination;
                }
                else
                {
                    $message = "le fichier n'a pas été déplacé dans ".$cheminDEDestination;
                }
            }
        }
        else
        {
            $message = "il faut obligatoirement un fichier audio";
        }
    }
    else
    {
        $message = "un problème a eu lieu lors de l'upload";
    }
}
else
{
    $message= "Aucun fichier à télécharger";
}

var_dump($_POST['fileName']);
var_dump($_FILES);
?>
<html lang="fr">
<head>
    <title>Traitement Upload</title>
</head>
<body>
<h1>Upload</h1>
<p> <?= $message ?></p>
</body>
</html>
