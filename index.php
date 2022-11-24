<?php
//Nouvelle requete pour corriger l'heure sur siteground
// SET GLOBAL time_zone ='-05:00';
// SELECT DATE_ADD(CURRENT_TIMESTAMP,interval -5 hour)

// Importer la base de données.
include('lib/bd.lib.php');

//Se connecter à la base de donnés.
$cnx = connexionBD();

//requête MySQL par défaut pour afficher toutes les tâches.
$requete = "SELECT id, texte, accomplie, date_ajout,
    DATE_FORMAT(date_ajout, '%d/%m/%Y à %H:%i:%s')
    AS date_ajout_modifie FROM tache ORDER BY date_ajout DESC";
    // Si on ne change pas "date_ajout" par "date_ajout_modifié", lorsqu'on fait
    // le trie en ordre décroissant, le trie se fait selon J/M/A.
    // MySql trie d'abord les jours, ensuite le mois et l'année.
    // l'ordre n'est plus le bon.

// Filter les tâches à faire et celle complétées.
if(isset($_GET['filtrer'])) {
    //Modifer la requête actuel pour afficher les tâches que l'on souhaite trier.
    if($_GET['filtrer'] == 1) {
        $requete ="SELECT id, texte, accomplie, date_ajout,
            DATE_FORMAT(date_ajout, '%d/%m/%Y à %H:%i:%s') AS date_ajout_modifie
            FROM tache WHERE accomplie=1 ORDER BY date_ajout DESC";
    } else {
        $requete ="SELECT id, texte, accomplie, date_ajout,
            DATE_FORMAT(date_ajout, '%d/%m/%Y à %H:%i:%s') AS date_ajout_modifie
            FROM tache WHERE accomplie=0 ORDER BY date_ajout DESC";
    }
}
//Ajouter une tâche
if(isset($_POST['texteTache'])) {
    //l'id de la tâche à ajouter
    $ajouterUneTache = $_POST['texteTache'];
    //Ajouter la tâche si la chaîne de caractère est plus grande que 2
    if (strlen($ajouterUneTache)>2) {
        //Effectuer une reqête indépendante de la précédente
        $requeteAjouterTache = lireDonnees($cnx, "INSERT INTO tache
        (id, texte, accomplie, date_ajout, utilisateur_id)
        VALUES (0, '$ajouterUneTache', 0, CURRENT_TIMESTAMP, NULL)");
    }
}
// Changer l'état de la tâche sélectionnée.
if(isset($_GET['basculer'])) {
    //l'id de la tâche à changer
    $tacheAChanger = $_GET['basculer'];
    //état actuel de la tâche à changer
    $tabEtatActuel  = lireDonnees($cnx, "SELECT accomplie
    FROM tache WHERE id=$tacheAChanger");
    $etatActuel = mysqli_fetch_assoc($tabEtatActuel);

    // Effectuer une reqête indépendante de la précédente selon l'état actuel
    // pour le changer
    if($etatActuel['accomplie']==1) {
        $requeteBasculer0 = lireDonnees($cnx, "UPDATE tache SET accomplie = 0
        WHERE id = $tacheAChanger");
    } else {
        $requeteBasculer1 = lireDonnees($cnx, "UPDATE tache SET accomplie = 1 
        WHERE id = $tacheAChanger");
    }    
}
//Listes des tâches à afficher
$listeDesTaches = lireDonnees($cnx, $requete);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MEMO | Liste de tâches</title>
    <meta name="description" content="Application Web de gestion de tâches - à produire dans le cadre du TP #2 du cours 582-3W3.">
    <link rel="stylesheet" href="ressources/css/styles.css">
    <link rel="icon" href="ressources/images/favicon.ico">
</head>
<body>
    <div class="conteneur">
        <a href="index.php"><h1>MEMO</h1></a>
        <form method="post" autocomplete="off" action="index.php">
            <input type="text" name="texteTache" class="quoi-faire" autofocus placeholder="Tâche à accomplir ...">
        </form>
        <div class="filtres">
            <a href="index.php?filtrer=1" title="Afficher les tâches complétées uniquement.">Complétées</a>
            <a href="index.php?filtrer=0" title="Afficher les tâches non-complétées uniquement.">Non-complétées</a>
            <a href="index.php" title="Afficher toutes les tâches.">Toutes</a>
        </div>
        <ul class="liste-taches">

            <!-- Afficher chaque tâche dans la requête SQL -->
            <?php while($uneTache = mysqli_fetch_assoc($listeDesTaches)) :
            // Obtenir l'id de la tâche pour changer ses propriété plustard
            $idDeLaTache = $uneTache['id']; ?>
            <li <?php if($uneTache['accomplie']==1) {echo 'class="accomplie"';} ?>>
                <span class="coche">
                    <a href="index.php?basculer=<?= $idDeLaTache; ?>" title="Cliquez pour faire basculer l'état de cette tâche.">
                        <img src="ressources/images/coche.svg" alt="">
                    </a>
                </span>
                <span class="texte"><?= $uneTache['texte']; ?></span>
                <span class="ajout"><?= $uneTache['date_ajout_modifie']; ?></span>
            </li>
            <?php endwhile; ?>
            
        </ul>
    </div>
</body>
</html>

<script>
	//Ne pas ajouté la même tâche plusieurs fois si l'on actualise la page
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>