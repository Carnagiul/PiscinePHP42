<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 6:49 PM
 */

if (isset($_POST))
{
    if (isset($_POST['new_pass']) && isset($_POST['old_pass']) && isset($_POST['username']))
    {
        if (__user_getUserByName(htmlentities($_POST['username'])))
        {
            $user = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `name`='" . htmlentities($_POST['username']) . "'");
            if ($user['pass'] == hash("sha512", htmlentities($_POST['old_pass'])))
            {
                sql_update("UPDATE `users` SET `pass` = '" . hash("sha512", htmlentities($_POST['new_pass'])) . "' WHERE `users`.`id` = '" . $user['id'] . "';");
                tpl_setpage('modify/success');
            }
            else
                tpl_setpage('modify/error');
        }
        else
            tpl_setpage('modify/error');
    }
    else
        tpl_setpage('modify/form');
}
else
    tpl_setpage('modify/form');
$page = tpl_construire();