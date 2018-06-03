<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 7:41 AM
 */

if (isset($_SESSION['user']))
{
    header('Location: index.php');
    tpl_setpage('log/home');
    echo tpl_construire();
}
else
{
    if (isset($_POST))
    {
        if (isset($_POST["action"]) && $_POST["action"] == "register")
        {
            $ret = __user_register(htmlentities($_POST["user"]), htmlentities($_POST["pass"]), htmlentities($_POST["mail"]));
            foreach ($ret as $line)
            {
                if ($line == "pass_too_easy")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Votre mot de passe est trop simple");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "wrong_mail")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Votre email n'est pas correct");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "username_exist")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Ce nom d'utilisateur est deja pris!");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "usermail_exist")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Ce mail d'utilisateur est deja pris!");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "missing_username")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Merci d'indiquer un nom d'utilisateur");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "missing_password")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Merci d'indiquer un mot de passe");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "missing_mail")
                {
                    tpl_add_data("notif_title", "Erreur d'inscription");
                    tpl_add_data("notif_content", "Merci d'indiquer un email valide");
                    tpl_setpage("notifs/error_notifs");
                    $page_notif .= tpl_construire();
                }
                if ($line == "account_create")
                {
                    tpl_add_data("notif_title", "Compte Creer");
                    tpl_add_data("notif_content", "Votre compte a bien ete creer");
                    tpl_setpage("notifs/success_notifs");
                    $page_notif .= tpl_construire();
                }
            }
        }
    }
    $username = (isset($_POST["user"])) ? $_POST["user"] : "";
    $pass = (isset($_POST["pass"])) ? $_POST["pass"] : "";
    $mail = (isset($_POST["mail"])) ? $_POST["mail"] : "";
    tpl_add_data("register_username", $username);
    tpl_add_data("register_pass", $pass);
    tpl_add_data("register_mail", $mail);
    tpl_setpage('public/register');
    $page = tpl_construire();
}