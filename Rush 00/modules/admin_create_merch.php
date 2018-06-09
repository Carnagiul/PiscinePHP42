<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 4:27 PM
 */

if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
{
    $list_group = "<option value='1' >All</option>";
    $ret = sql_query("SELECT * FROM `" . GROUP_TABLE . "`");
    while ($line = mysqli_fetch_array($ret))
        $list_group .= "<option value='" . $line['id'] . "' >" . $line['name'] . "</option>";
    tpl_add_data('list_group', $list_group);
    if (isset($_POST['name']))
    {
        $ret = __merch_create_new(htmlentities($_POST['name']), htmlentities($_POST['descr']), htmlentities($_POST['price']), htmlentities($_POST['amount']),  htmlentities($_POST['image']), htmlentities($_POST['group']));
        foreach ($ret as $line)
        {
            if ($line == "group_merch_created")
            {
                tpl_add_data("notif_title", "Item Creer");
                tpl_add_data("notif_content", "Item Ajouter a la DB");
                tpl_setpage("notifs/success_notifs");
                $page_notif .= tpl_construire();
            }
            if ($line == "name_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas de nom");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_construire();
            }
            if ($line == "descr_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas de description");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_construire();
            }
            if ($line == "price_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas de prix");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_construire();
            }
            if ($line == "amount_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas de quantite");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_onstruire();
            }
            if ($line == "image_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas d'image");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_construire();
            }
            if ($line == "group_undefined")
            {
                tpl_add_data("notif_title", "Item Creation Error");
                tpl_add_data("notif_content", "L'item ne possede pas de group");
                tpl_setpage("notifs/error_notifs");
                $page_notif .= tpl_construire();
            }
        }
    }
    tpl_setpage('admin/create_merch');
    $page = tpl_construire();
}
else
{
    if (isset($_SESSION['user']))
        tpl_setpage('log/home');
    else
        tpl_setpage('public/home');
    header('Location: index.php');
    $page = tpl_construire();
}