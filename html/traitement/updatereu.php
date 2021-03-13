<?php 
session_start();
include('../outils/connexionBDD.php');


$reponse = $bdd->query('SELECT * FROM reunion');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <strong>Réunion ID : <?php echo $donnees['id'];  ?></strong> : <?php echo $donnees['nom']; ?><br />
    Description : <?php echo $donnees['description']; ?>, Créer le <?php echo $donnees['date_creation']; ?><br />
    Elle aura lieu le <?php echo $donnees['date']; ?> à <?php echo $donnees['lieu']; ?><br />
    <?php
    $verifinscript = $bdd->query('SELECT * FROM abonnement WHERE id_reunion = ' . $donnees['id'] );
            
    $dejainscript = $verifinscript->rowCount();
    $verifinscript->CloseCursor();
    
    echo $dejainscript; ?> personnes vont déjà participer à la réunion sur un maximum de <?php echo $donnees['nb_perso_max']; ?> 
    <a href="../bloque/changement_reu.php?id=<?php echo $donnees['id'];?>"> Modifier </a> <br>
    <a href="./inscription_reu.php?id=<?php echo $donnees['id'];?>">Rejoindre la réunion</a>
    <a href="./redirection_compte_rendu.php?id=<?php echo $donnees['id'];?>">Voir le compte rendu de réunion</a>
</p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête





?>