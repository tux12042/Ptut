<?php
session_start();

if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_POST['nombre']) && isset($_SESSION['id'] )) {

$nom = htmlspecialchars($_POST['nom']);
$desc = htmlspecialchars($_POST['description']);
$date = htmlspecialchars($_POST['date']);
$lieu = htmlspecialchars($_POST['lieu']);
$nomb = htmlspecialchars($_POST['nombre']);

    include('../outils/connexionBDD.php');

$req = $bdd->prepare('UPDATE `reunion` SET `nom` = :nom , `description` = :descr , `date` = :dates , `lieu` = :lieu , `nb_perso_max` = :nomb WHERE `reunion`.`id` = :id ');
       
          
          $req->execute(array(
              'nom' => $nom,
              'descr' => $desc,
              'dates' => $date,
              'lieu' => $lieu,
              'nomb' => $nomb,
              'id' => $_SESSION['id']
          ));

          header('location: ../bloque/changement_reu.php?id=' . $_SESSION['id'] );

} else {

echo 'L\'un des champs n\'est pas remplie';

}





?>