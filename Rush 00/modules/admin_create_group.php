<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:27 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    if (isset($_POST['name']))
    {
        if (!(__merch_groupNameExist($_POST['name'])))
        {
           $ret = __merch_create_new_group($_POST['name']);
           foreach ($ret as $line)
           {
               if ($line == "group_merch_created")
               {
                   tpl_add_data("notif_title", "Groupe Creer");
                   tpl_add_data("notif_content", "Vous venez de creer un nouveau groupe");
                   tpl_setpage("notifs/success_notifs");
                   $page_notif .= tpl_construire();
               }
           }
        }

    }
    tpl_setpage('admin/create_group.php');
}
else
{
    if (isset($_SESSION['user']))
        tpl_setpage('log/home');
    else
        tpl_setpage('public/home');
    header('Location: index.php');
    echo tpl_construire();
}