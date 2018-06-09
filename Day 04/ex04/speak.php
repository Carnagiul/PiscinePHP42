<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 12:09 PM
 */
@session_start();

function setTimezone($default)
{
    $timezone = "";

    if (is_link("/etc/localtime")) {

        $filename = readlink("/etc/localtime");

        $pos = strpos($filename, "zoneinfo");
        if ($pos) {
            $timezone = substr($filename, $pos + strlen("zoneinfo/"));
        } else {
            $timezone = $default;
        }
    }
    else {

        $timezone = file_get_contents("/etc/timezone");
        if (!strlen($timezone)) {
            $timezone = $default;
        }
    }
    date_default_timezone_set($timezone);
}

setTimezone('UTC');

if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "")
{
    if (isset($_POST["msg"]) && isset($_POST["submit"]) && $_POST["submit"] == "OK")
    {
        if (file_exists('./private/chat'))
        {
            $login = $_SESSION["loggued_on_user"];
            $content = unserialize(file_get_contents("./private/chat"));
            $content[] = array("login" => $login, "time" => time(), "msg" => $_POST["msg"]);
            file_put_contents("./private/chat", serialize($content), LOCK_EX);
        }
        else
        {
            if (file_exists('./private/passwd') == false)
                mkdir('./private');
            $login = $_SESSION["loggued_on_user"];
            $content = array(array("login" => $login, "time" => time(), "msg" => $_POST["msg"]));
            file_put_contents("./private/chat", serialize($content));
        }
    }

    ?>
    <form action="speak.php" method="post">
        <input type="text" name="msg" placeholder="Entrer votre message"/><input type="submit" value="OK" name="submit"/>
    </form>
    <?php
}