<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 5:19 PM
 */

if (isset($_SESSION['user']))
{
    if (isset($_GET['invoice_id']))
    {
        if (__invoice_show(intval($_GET['invoice_id'])))
        {
            $invoice = __invoice_getById(intval($_GET['invoice_id']));
            $explode_item = explode(";", $invoice['content']);
            for ($i = 0; isset($explode_item[$i]); $i++)
            {
                $explode_container = explode("-", $explode_item[$i]);
                $id = $explode_container[0];
                $item = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . $id . "'");
                $amount = $explode_container[1];
                tpl_add_data('invoice_name', $ret['name']);
                tpl_add_data('invoice_amount', $ret['name']);
            }
        }
        else
        {

        }
    }
    else
    {

    }
}
else
{

}
