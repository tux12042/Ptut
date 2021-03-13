
<?php 
session_start();
include('../outils/connexionBDD.php'); //code connection bdd
if(isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['prenom']) && isset($_POST['num']) && isset($_POST['mdp_verif'])) { //verifie si form est rempli 
  echo'tout est entré correctement';
  //GOOGLE
  if(empty($_POST['recaptcha-response'])){
        echo 'problème captcha';
    }else{     
      
      $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcVDlQaAAAAAPcEKBk8_M2ItNgUjxjWpm7fL7rC&response={$_POST['recaptcha-response']}";

// On vérifie si curl est installé
if(function_exists('curl_version')){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($curl);
}else{
    // On utilisera file_get_contents
    $response = file_get_contents($url);
}




if(empty($response) || is_null($response)){
  echo'google n a pas reçus 1';
}else{
  $data = json_decode($response);
  if($data->success){
      // Google a répondu avec un succès
      // On traite le formulaire
  }else{
    echo'google n a pas reçus 2';
  }
}



echo'google est passé';
//-STOP GOOGLE
$identifiant = htmlspecialchars($_POST['nom']) . ' ' . htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['mail']);
echo $identifiant;
            $verifMail = $bdd->query('SELECT `nom` FROM utilisateur WHERE nom LIKE "'. $mail .'"');
            
          $dejaMail = $verifMail->rowCount();
          $verifMail->CloseCursor();

          
        if ($_POST['mdp_verif'] == $_POST['mdp']) {

        


          if($dejaMail == 0){
              echo' mail inexistant ont peu créer compte ';
              
              // modification mdp
          $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
          $num = htmlspecialchars($_POST['num']);
          
          $req = $bdd->prepare('INSERT INTO utilisateur VALUES (NULL, :nom, :mail, :mdp, :tel)');
        //  INSERT INTO utilisateur VALUES (NULL, :nom, :mail, :mdp,current_timestamp(), "") 
          
          $req->execute(array(
              'nom' => $identifiant,
              'mail' => $mail,
              'mdp' => $mdp,
              'tel' => $num
          ));

          $idrecup = $bdd->prepare('SELECT id FROM utilisateur WHERE nom = :nom');
$idrecup ->execute(array('nom' => $identifiant));
$idutilisateur = $idrecup ->fetch();
          echo "Votre compte à été créer avec succès ";
          $_SESSION['id'] = $idutilisateur['id'];
          $_SESSION['nom'] = $identifiant;
          echo $_SESSION['nom'];
         // header('location: ../pages/principale.php');
          }
          else{
          echo "Erreur le compte existe déjà";
          
          
          }

} else {


  echo 'Problème vos mots de passe ne correspondent pas, recommencez';
}



        }
          }
          else
          {
              echo "Erreur Aucunes données envoyé";
          };
          
    


?>