<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 3:18 PM
 */

function    __show_cart()
{
    tpl_setpage("merch/merch_data");
    $data = "";
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
            tpl_add_data('merch_price', $amount * $ret['price']);
            $data .= tpl_construire();
        }
    }
    return ($data);
}