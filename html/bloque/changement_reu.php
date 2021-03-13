<?php
session_start();
if(isset($_GET['id'])) {
    include('../outils/connexionBDD.php');
    $reponse = $bdd->prepare('SELECT * FROM reunion WHERE id = ?');
    $reponse->execute(array($_GET['id']));
    $donnees = $reponse->fetch();

?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer réu</title>
</head>
<body>
    <h1>Modifier la réunion</h1>
    <form action="../traitement/Traitement_update_Reu.php" method="post">
<input name="nom" value="<?php echo $donnees['nom'];  ?>" required type="text" placeholder="nom de la réunion" >
<input name="description" value="<?php echo $donnees['description'];  ?>" required type="text" placeholder="description de la reu" >
<input type="date" value="<?php echo $donnees['date'];  ?>" name="date">
<input name="lieu" value="<?php echo $donnees['lieu'];  ?>" required type="text" placeholder="Lieu de la reu" >
<input type="number" value="<?php echo $donnees['nb_perso_max'];  ?>" name="nombre" required>    
<input type="submit">
</form>
</body>
</html>


<?php
$_SESSION['id'] = $_GET['id'];

} else{
    echo 'Aucunes réunion sélectionné';
}

?>

