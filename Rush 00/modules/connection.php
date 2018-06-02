<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:49 PM
 */

if (isset($_SESSION['user']))
{
    tpl_setpage('log/home');
    tpl_add_data('username', $_SESSION['user']['name']);
    echo tpl_construire();
}
else
{
    if (isset($_POST['user']) && isset($_POST['pass']))
    {
       $ret = __user_loggin($_POST['user'], $_POST['pass']);
       foreach ($ret as $line)
       {
           if ($line == "user_not_exist")
           {
               tpl_add_data("notif_title", "Erreur de connection");
               tpl_add_data("notif_content", "Ce compte n'existe pas");
               tpl_setpage("notifs/error_notifs");
               $page_notif .= tpl_construire();
           }
           if ($line == "wrong_password")
           {
               tpl_add_data("notif_title", "Erreur de connection");
               tpl_add_data("notif_content", "Ce mot de passe n'es pas le bon");
               tpl_setpage("notifs/error_notifs");
               $page_notif .= tpl_construire();
           }
           if ($line == "user_logged")
           {
               tpl_add_data("notif_title", "Connection Reussit");
               tpl_add_data("notif_content", "Vous venez de vous connectez au site");
               tpl_setpage("notifs/success_notifs");
               $page_notif .= tpl_construire();
           }
       }
    }
    if (isset($_SESSION['user']))
    {
        tpl_setpage('log/home');
        tpl_add_data('username', $_SESSION['user']['name']);
        echo tpl_construire();
    }
    else
    {
        tpl_add_data('connection_username', (isset($_POST['user'])) ? $_POST['user'] : "");
        tpl_add_data('connection_password', (isset($_POST['pass'])) ? $_POST['pass'] : "");
        tpl_setpage('public/connection');
        echo tpl_construire();
    }
}