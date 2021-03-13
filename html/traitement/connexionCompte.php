<?php
session_start();
if(isset($_POST['mail'])){

    include('../outils/connexionBDD.php');
$pseudo = $_POST['mail'];
$mdp = $_POST['mdp'];



$reponse = $bdd->prepare('SELECT id, nom, mdp FROM utilisateur WHERE mail = ?');
$reponse->execute(array($pseudo));
$userexist = $reponse->rowCount();
$donnees = $reponse->fetch();

if($userexist == 1)
{

  echo $donnees['mdp'];

  if (password_verify($mdp, $donnees['mdp'])){  
 $userinfo = $reponse->fetch();
 $_SESSION['nom'] = $donnees['nom'];
 $_SESSION['id'] = $donnees['id'];
echo $_SESSION['nom'];
echo $_SESSION['id'];

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