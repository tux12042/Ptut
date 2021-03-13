<?php
session_start();
include('./html/outils/connexionBDD.php'); //recupération script de connexion bdd
/*Verification que tout le formulaire soit remplis*/
if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['nombre'])){
    // Mise au bon format pour éviter l'injection sql
    $nom = htmlspecialchars($_POST['nom']);
    $desc = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['date']);
    $lieu = htmlspecialchars($_POST['lieu']);
    $nb = htmlspecialchars($_POST['nombre']);
//preparation de l'envoie
    $req = $bdd->prepare('INSERT INTO reunion VALUES (NULL, :nom, :descriptio, current_timestamp(), :datereu, :lieu, :nbperso, 0) ');
    
      //envoie
      $req->execute(array(
          'nom' => $nom,
          'descriptio' => $desc,
          'datereu' => $date,
          'lieu' => $lieu,
          'nbperso' => $nb
      ));

      echo "Réunion créée avec succès";



} else {
echo "Certains champs n'on pas été remplis";

}


?>