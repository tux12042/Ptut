<?php 
session_start();

if (isset($_GET[id])) {

    include('../outils/connexionBDD.php');

    $reponse = $bdd->prepare('SELECT lien FROM compte_rendu WHERE id_reunion = ?');
    $reponse->execute(array($_GET[id]));
    $userexist = $reponse->rowCount();
    $donnees = $reponse->fetch();
    
    if($userexist >= 1) {




    } else {

        echo 'Aucun compte rendu disponible pour la réunion pour le moment';
    }


} else

{


    echo "aucune réu n'est sélectionné";

}






?>