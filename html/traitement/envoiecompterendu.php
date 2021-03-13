<?php
session_start();


echo 'début <br>';
$nomUtilisateur = $_SESSION['id']; //mettre id utilisateur


if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){ //vérifie si il y a un fichier
    echo 'fichier envoyé <br>';
    $taillemax = 80000000000; //taille maxi du fichier
    $extensionValides = array('jpg', 'jpeg', 'gif', 'png', 'avi', 'mp4', 'mov'); //extensions prises en compte
    if($_FILES['avatar']['size'] <= $taillemax){
        echo 'fichier bonne taille <br>';
        $generateurNom = rand();
        echo $_FILES['avatar']['name'];
$extentionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); //extension pour l'uplaud
if(in_array($extentionUpload, $extensionValides)){
    echo 'autre if <br>';
    echo $_FILES['avatar']['tmp_name'];
$chemin = "./imgpost/".$generateurNom.".".$extentionUpload; //chemin pour l'upload
echo 'nom du file au dessus <br>';



$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
if($resultat){
    try
    {
    $bdd = new PDO('mysql:host=localhost;dbname=tictoc;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }



    $req = $bdd->prepare('INSERT INTO contenu(`id`, `message`, `video`, `idutilisateur`) VALUES(NULL, :message, :url, :id) ');
    // INSERT INTO `contenu` (`id`, `message`, `video`, `idutilisateur`) VALUES (NULL, :message, :url, :id) 
    //  INSERT INTO utilisateur VALUES (NULL, :nom, :mail, :mdp,current_timestamp(), "") 
      
      $req->execute(array(
          'id' => $_SESSION['id'],
          'url' => $chemin,
          'message' => $_POST['message']
      ));

      echo 'message envoyé !';
      header('location: ./principale.php');

      
    
}else{
    echo 'probleme du deplacement';
}

}
else {
    echo 'votre photo n\'est pas au bon format';
}

}
    else
    {
    echo 'votre photo est trop lourde';
    }
}

?>