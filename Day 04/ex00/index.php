<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 8:56 AM
 */

session_start();

$passwd = "";
$login = "";

if (isset($_GET["submit"]) && $_GET["submit"] == "OK")
{
    if (isset($_GET["login"]) && $_GET["login"] != "")
    {
        if (isset($_GET["passwd"]) && $_GET["passwd"] != "")
        {
            $_SESSION["login"] = $_GET["login"];
            $_SESSION["passwd"] = $_GET["passwd"];
        }
    }
}

if (isset($_SESSION["login"]))
{
    $login = $_SESSION["login"];
    $passwd = $_SESSION["passwd"];
}

if (isset($_GET["login"]) && $_GET["login"] != "")
    $login = $_GET["login"];
if (isset($_GET["passwd"]) && $_GET["passwd"] != "")
    $passwd = $_GET["passwd"];

?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>D04 Ex00</title>
    </head>
    <body>
    <h1>Formulaire</h1>
    <br />
    <form method="get" action="index.php">
        Identifiant : <input type="text" value="<?php echo $login; ?>" name="login" ><br />
        Mot de passe: <input type="password" value="<?php echo $passwd; ?>" name="passwd" ><br />

        <input type="submit" name="submit" value="OK" >
    </form>
    </body>
</html>
