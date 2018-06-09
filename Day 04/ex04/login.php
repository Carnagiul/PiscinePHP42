<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:27 AM
 */

function display_page()
{
    ?>
    <iframe height="550px" width="100%" style="overflow-scrolling: auto;" src="chat.php" name="chat" id="chat" class="chat"></iframe>
    <iframe height="50px" width="100%" style="overflow-scrolling: auto;" src="speak.php"></iframe>
    <script>
        function reloadchat()
        {
            var iframe = document.getElementById('chat');
            iframe.src = iframe.src;
            setTimeout("reloadchat()", 10000);
        }
        setTimeout("reloadchat()", 10000);
    </script>
    <?php
    exit();
}

function display_error()
{
    echo "ERROR\n";
    header('Location: index.html');
    exit();
}

@session_start();

require_once ("auth.php");

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


if (isset($_POST["submit"]) && $_POST["submit"] == "OK")
{
    if (isset($_POST["login"]) && $_POST["login"] != "")
    {
        if (isset($_POST["passwd"]) && $_POST["passwd"] != "")
        {
            if (auth($_POST["login"], $_POST["passwd"]))
            {
                $_SESSION["loggued_on_user"] = $_POST["login"];
                exit(display_page());
            }
            else
                $_SESSION["loggued_on_user"] = "";
        }
    }
}
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "")
    display_page();
display_error();