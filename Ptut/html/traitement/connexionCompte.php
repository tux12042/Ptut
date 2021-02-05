<?php
session_start();
if(isset($_POST['identifiant'])){

    include('../outils/connexionBDD.php');
$pseudo = $_POST['identifiant'];
$mdp = $_POST['mdp'];



$reponse = $bdd->prepare('SELECT mdp, nom FROM utilisateur WHERE nom = ?');
$reponse->execute(array($pseudo));
$userexist = $reponse->rowCount();
$donnees = $reponse->fetch();

if($userexist == 1)
{

  if (password_verify($_POST['mdp'], $donnees['mdp'])){  
 $userinfo = $reponse->fetch();
 $_SESSION['nom'] = $_POST['identifiant'];
 $_SESSION['id'] = $donnees['id'];
echo $_SESSION['nom'];
header('location: ../pages/principale.php');
} else {
    echo "problème de mot de passe";
}

}
else{
  echo "Désolé nous n'avons pas trouvé votre compte, mauvais mot de passe ou mauvais pseudo";
}

} else {
  echo "Problème rencontré désolé";  
}


?>