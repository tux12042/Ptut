
<?php 
session_start();
include('../outils/connexionBDD.php'); //code connection bdd
if(isset($_POST['nom']) && isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['prenom'])) { //verifie si form est rempli 
            $verifIdentifiant = $bdd->query('SELECT `nom` FROM utilisateur WHERE nom LIKE "'. $_POST['identifiant'] .'"');
            $verifMail = $bdd->query('SELECT `nom` FROM utilisateur WHERE nom LIKE "'. $_POST['mail'] .'"');
            
            $dejaIdentifiant = $verifIdentifiant->rowCount();
          $verifIdentifiant->CloseCursor();
          $dejaMail = $verifMail->rowCount();
          $verifMail->CloseCursor();

          
          if($dejaIdentifiant == 0 && $dejaMail == 0){
              $identifiant = htmlspecialchars($_POST['nom']) . ' ' . htmlspecialchars($_POST['prenom']);
              $mail = htmlspecialchars($_POST['mail']);
              // modification mdp
          $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
          
          
          $req = $bdd->prepare('INSERT INTO utilisateur VALUES (NULL, :nom, :mail, :mdp,current_timestamp(), "") ');
        //  INSERT INTO utilisateur VALUES (NULL, :nom, :mail, :mdp,current_timestamp(), "") 
          
          $req->execute(array(
              'nom' => $identifiant,
              'mail' => $mail,
              'mdp' => $mdp
          ));

          $idrecup = $bdd->prepare('SELECT id FROM utilisateur WHERE nom = :nom');
$idrecup ->execute(array('nom' => $identifiant));
$idutilisateur = $idrecup ->fetch();
          echo "Votre compte à été créer avec succès";
          $_SESSION['id'] = $idutilisateur['id'];
          $_SESSION['nom'] = $nom;
          echo $_SESSION['nom'];
         // header('location: ../pages/principale.php');
          }
          else{
          echo "Erreur le compte existe déjà";
          
          
          }
          }
          else
          {
              echo "Erreur Aucunes données envoyé";
          };
          
    


?>