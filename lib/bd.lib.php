<?php
    /**
     * Obtient une connexion à MySQL et la configure
     * 
     * @return Identifiant de connexion MySQL
     * 
     */
    function connexionBD() {
        /* On utilise la librairie MySQLi de PHP */
        // Inclure le fichier de configuration BD
        // Ouvrir une connexion à MySQL (connect())
        $connexion = mysqli_connect("localhost", "root", "");
        // Configurer l'encodage de la communication MySQL/PHP
        mysqli_query($connexion, "SET NAMES 'utf8'");
        // Sélectionner la BD avec laquelle on veut travailler (select_db())
        mysqli_select_db($connexion, "memo_e1975958");
        return $connexion;
    }

    /**
     * Exécute une requête SQL de type SELECT
     * 
     * @param $cnx Identifiant de la connexion MySQL
     * @param $requete Requête SQL de type SELECT
     * 
     * @return Object Un jeu d'enregistrements de la BD
     * 
     */
    function lireDonnees($cnx, $requete) {
        return mysqli_query($cnx, $requete);
    }
?>