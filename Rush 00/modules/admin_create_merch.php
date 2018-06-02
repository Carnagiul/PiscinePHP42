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
     //   function __merch_create_new($name, $descr, $price, $amount, $image, $group)

        $ret = __merch_create_new($_POST['name'], $_POST['descr'], $_POST['price'], $_POST['amount'], $_POST['line'], $_POST['group']);
        foreach ($ret as $line)
        {
            if ($line == "group_merch_created")
            {
                tpl_add_data("notif_title", "Item Creer");
                tpl_add_data("notif_content", "Item Ajouter a la DB");
                tpl_setpage("notifs/success_notifs");
                $page_notif .= tpl_construire();
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