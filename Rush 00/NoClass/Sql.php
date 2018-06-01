<?php

    define('BDD_PORT', 3306);
    $nombrerequetes = 0; // Permet de connaitre le nombres de requete effectué pour l'affichage d'une page

    /*******************************************************************************************************\
    POUR SE CONNECTER AU SERVEUR SQL
    \*******************************************************************************************************/
    function sql_connect() // Permet dans le cas ou on arrive pas sur ce fichier par l'index du jeu de definir ou se trouve le config.php
    {
        mysql_connect(BDD_HOST.':'.BDD_PORT, BDD_USER, BDD_PASS)
        or die('<font color="red">IMPOSSIBLE DE SE CONNECTER AU SERVEUR SQL
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOST :</font> '.BDD_HOST.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">PORT :</font> '.BDD_PORT.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">UTILISATEUR :</font> '.BDD_USER.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">PASS :</font> ********
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR : </font>'.mysql_error()
        );

        mysql_select_db(BDD_NOM)
        or die('<font color="red">IL EST IMPOSSIBLE DE SELECTIONNER LA BASE DE DONNÉES
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BASE DEMANDÉ : </font>'.BDD_NOM.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR : </font>'.mysql_error()
        );
    }

    /*******************************************************************************************************\
    POUR SE DECONNECTER DU SERVEUR SQL
    \*******************************************************************************************************/
    function sql_close()
    {
        mysql_close()
        or die('<font color="red">IL EST IMPOSSIBLE DE FERMER LA BASE DE DONNÉES');
    }

    ###############################################################################
    /*******************************************************************************************************\
    DANS LE CAS DE DEMANDE D'UNE SEULE LIGNE, RENVOYE LE TABLEAU
    \*******************************************************************************************************/
    function sql_select($texte)
    {
        global $nombrerequetes;
        $query = mysql_query($texte)
        or die('<font color="red">ERREUR SQL :
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysql_error()
        );
        $row = mysql_fetch_array($query);
        $nombrerequetes++;
        return $row;
    }

    /*******************************************************************************************************\
    PERMET LORSQUE UN SEULE CHAMP DE SQL EST DEMANDER, DE L'ENVOYE DIRECTEMENT
    \*******************************************************************************************************/
    function sql_select1($texte)
    {
        global $nombrerequetes;
        $query = mysql_query($texte)
        or die('<font color="red">ERREUR SQL :
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysql_error()
        );
        $row2 = mysql_fetch_array($query);
        $row = $row2['0'];
        $nombrerequetes++;
        return $row;
    }

    /*******************************************************************************************************\
    POUR MODIFIER UN TEXTE, CETTE FONCTION NE RENVOYE RIEN
    \*******************************************************************************************************/
    function sql_update($texte)
    {
        global $nombrerequetes;
        mysql_query($texte)
        or die('<font color="red">ERREUR SQL :
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysql_error()
        );
        $nombrerequetes++;
    }

    /****************************************µ**************************************************************\
    CETTE FONCTION AGIT COMME mysql_query() CEPENDANT ELLE PERMET DE CALCULER LA REQUETE
    \*******************************************************************************************************/
    function sql_query($texte)
    {
        global $nombrerequetes;
        $query = mysql_query($texte)
        or die('<font color="red">ERREUR SQL :<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysql_error()
        );
        $nombrerequetes++;
        return $query;
    }

?>