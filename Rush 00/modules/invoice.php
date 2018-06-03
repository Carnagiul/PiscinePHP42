<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 4:22 PM
 */

if (isset($_SESSION['user']))
{
    if (isset($_POST['action']) && $_POST['action'] == "Command")
    {

    }
    $total_price = 0;
    $total_amount = 0;
    tpl_setpage('invoice/data_view');
    foreach ($_SESSION['merch'] as $merch => $amount)
    {
        if ($amount <= 0)
            unset($_SESSION['merch'][$merch]);
        else
        {
            $explode = explode("_", $merch);
            $ret = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($explode[1]) . "'");
            tpl_add_data('merch_name', $ret['name']);
            tpl_add_data('merch_amount', $amount);
            $total_amount += $amount;
            $total_price += ($amount * $ret['price']);
            tpl_add_data('merch_price', $amount * $ret['price']);
            $data .= tpl_construire();
        }
    }
    tpl_add_data('invoice_content', $data);
    tpl_add_data('total_qte', $total_amount);
    tpl_add_data('total_price', $total_price);
    tpl_add_data('invoice_user', $_SESSION['user']);
    tpl_setpage('invoice/main_view');
    $page = tpl_construire();
}