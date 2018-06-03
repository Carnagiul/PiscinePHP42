<?php

define('BDD_PORT', 3306);
define('BDD_HOST', 'localhost');
define('BDD_USER', 'root');
define('BDD_PASS', '000000');
define('BDD_NOM', 'rush00');

$nombrerequetes = 0; // Permet de connaitre le nombres de requete effectué pour l'affichage d'une page

$mysqli = NULL;

/*******************************************************************************************************\
POUR SE CONNECTER AU SERVEUR SQL
\*******************************************************************************************************/
function sql_connect() // Permet dans le cas ou on arrive pas sur ce fichier par l'index du jeu de definir ou se trouve le config.php
{
    global $mysqli;

    $mysqli =  mysqli_connect(BDD_HOST.':'.BDD_PORT, BDD_USER, BDD_PASS, BDD_NOM)
    or die('<font color="red">IMPOSSIBLE DE SE CONNECTER AU SERVEUR SQL
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOST :</font> '.BDD_HOST.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">PORT :</font> '.BDD_PORT.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">UTILISATEUR :</font> '.BDD_USER.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">PASS :</font> ********
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">BASE :</font> '.BDD_NOM.'
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR : </font>'.mysqli_error($mysqli)
    );
}

/*******************************************************************************************************\
POUR SE DECONNECTER DU SERVEUR SQL
\*******************************************************************************************************/
function sql_close()
{

}

###############################################################################
/*******************************************************************************************************\
DANS LE CAS DE DEMANDE D'UNE SEULE LIGNE, RENVOYE LE TABLEAU
\*******************************************************************************************************/
function sql_select($texte)
{
    global $nombrerequetes, $mysqli;
    $query = mysqli_query($mysqli, $texte)
    or die('<font color="red">ERREUR SQL :
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysqli_error($mysqli)
    );
    $row = mysqli_fetch_array($query);
    $nombrerequetes++;
    return $row;
}

/*******************************************************************************************************\
PERMET LORSQUE UN SEULE CHAMP DE SQL EST DEMANDER, DE L'ENVOYE DIRECTEMENT
\*******************************************************************************************************/
function sql_select1($texte)
{
    global $nombrerequetes, $mysqli;
    $query = mysqli_query($mysqli, $texte)
    or die('<font color="red">ERREUR SQL :
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysqli_error($mysqli)
    );
    $row2 = mysqli_fetch_array($query);
    $row = $row2['0'];
    $nombrerequetes++;
    return $row;
}

/*******************************************************************************************************\
POUR MODIFIER UN TEXTE, CETTE FONCTION NE RENVOYE RIEN
\*******************************************************************************************************/
function sql_update($texte)
{
    global $nombrerequetes, $mysqli;
    $query = mysqli_query($mysqli, $texte)
    or die('<font color="red">ERREUR SQL :
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
						<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysqli_error($mysqli)
    );
    $nombrerequetes++;
}

/****************************************µ**************************************************************\
CETTE FONCTION AGIT COMME mysql_query() CEPENDANT ELLE PERMET DE CALCULER LA REQUETE
\*******************************************************************************************************/
function sql_query($texte)
{
    global $nombrerequetes, $mysqli;
    $query = mysqli_query($mysqli, $texte)
    or die('<font color="red">ERREUR SQL :<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUÊTE :</font> '.htmlentities($texte).' 
								<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="red">ERREUR :</font> '.mysqli_error($mysqli)
    );
    $nombrerequetes++;
    return $query;
}

function sql_execbackup($nom_fichier_backup,$del_fichier='0')
{
    $requetes="";
    if (!(file_exists($nom_fichier_backup)))
        return ;
    $sql=file($nom_fichier_backup); // on charge le fichier SQL
    foreach($sql as $l) // on le lit
    {
        if (substr(trim($l),0,2)!="--")  // suppression des commentaires
        {
            $requetes .= $l;
        }
    }
    $reqs = preg_split("/;/", $requetes);
    foreach($reqs as $req) // et on les éxécute
    {
        if (!sql_update($req) && trim($req) != '')
        {
        }
    }
    if($del_fichier == '1') // Si l'utilisateur a demandé la suppression du fichier
    {
        unlink($nom_fichier_backup);
    }
}


?>