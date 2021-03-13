<?php 
session_start();


if (isset($_GET['id'])) {

if (isset($_SESSION['id'])) {

include('../outils/connexionBDD.php');

echo 'Vous êtes connecté ';
echo $_SESSION['id'];



//SELECT * FROM `abonnement` WHERE `id_utilisateur` = 1 AND `id_reunion` = 1

$verifinscript = $bdd->query('SELECT * FROM abonnement WHERE id_utilisateur = '. $_SESSION['id'] .' AND id_reunion = ' . $_GET['id'] );
            
$dejainscript = $verifinscript->rowCount();
$verifinscript->CloseCursor();

if($dejainscript == 0) { //VERIFIER LE NOMBRE MAX DE PERSONNES D2JA DANS LA REU

    $nbperso = $bdd->query('SELECT * FROM abonnement WHERE id_reunion = ' . $donnees['id'] );
            
    $nbpersonnages = $verifinscript->rowCount(); //nb perso
    $nbperso->CloseCursor();

    $nbpersomax = $bdd->query('SELECT nb_perso_max FROM reunion WHERE id = ' . $donnees['id'] );
    $maxperso = $nbpersomax ->fetch();



if ($nbpersonnages >= $maxperso) {

    echo 'La réunion est déjà complète, il ne reste plus de place';

} else {



    $req = $bdd->prepare('INSERT INTO abonnement VALUES (NULL, :idutilisateur, :idreunion )');
          
    $req->execute(array(
        'idutilisateur' => $_SESSION['id'],
        'idreunion' => $_GET['id']

    ));


}


} else {


echo 'Vous êtes déja inscript';

}










} else {

echo 'Vous devez vous connecter http://localhost/petut/html/front/BnB/html/connexion.html';

}
} else {

echo 'Aucune réunion sélectionné';

}




?>