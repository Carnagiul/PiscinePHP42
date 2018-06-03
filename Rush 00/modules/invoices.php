<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 5:19 PM
 */

function __invoice_static_display($id)
{
    $page = "";
    $content = "";
    if ($_SESSION['user']['admin'])
        $query = "SELECT * FROM `" . INVOCE_TABLE . "`";
    else
        $query = "SELECT * FROM `" . INVOCE_TABLE . "` WHERE `user_id`='" . $_SESSION['user']['id'] . "'";
    $ret = sql_query($query);
    if ($ret)
    {
        tpl_setpage('invoice_list/list');
        while ($data = mysqli_fetch_assoc($ret))
        {
            tpl_add_data('invoice_list_id', $data['id']);
            tpl_add_data('invoice_list_price', $data['price']);
            tpl_add_data('invoice_list_date', date("F j, Y, g:i a", $data['timestamp']));
            $content .= tpl_construire();
        }
        tpl_setpage('invoice_list/invoice_list');
        tpl_add_data('invoice_data_list', $content);
        $page .= tpl_construire();
    }
    else
    {
        tpl_setpage('merch/none');
        $page .= tpl_construire();
    }
    return ($page);
}

if (isset($_SESSION['user']))
{
    if (isset($_GET['id']) && $_GET['id'] != '')
    {
        if (__invoice_show(intval($_GET['id'])))
        {
            tpl_setpage('invoice/data_view');
            $data = "";
            $total_amount = 0;
            $invoice = __invoice_getById(intval($_GET['id']));
            $explode_item = explode(";", $invoice['content']);
            for ($i = 0; isset($explode_item[$i]); $i++)
            {
                $explode_container = explode("-", $explode_item[$i]);
                $id = intval($explode_container[0]);
                $item = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . $id . "'");
                $amount = $explode_container[1];
                $total_amount += $amount;
                if (isset($item))
                {
                    tpl_add_data('merch_name', $item['name']);
                    tpl_add_data('merch_amount', $amount);
                    tpl_add_data('merch_price', 'unknow');
                    $data .= tpl_construire();
                }
            }
            tpl_add_data('invoice_content', $data);
            tpl_add_data('total_qte', $total_amount);
            tpl_add_data('total_price', $invoice['price']);
            tpl_add_data('invoice_list_date', date("F j, Y, g:i a", $invoice['timestamp']));

            if ($_SESSION['user']['id'] == $_SESSION['user'])
                tpl_add_data('invoice_user', $_SESSION['user']);
            else
            {
                $meta_user = sql_select("SELECT * FROM `users` WHERE `id`='" . $invoice['user_id'] . "'");
                tpl_add_data('invoice_user', $meta_user['name']);
            }
            tpl_setpage('invoice_list/main_view');
            $page = tpl_construire();
        }
        else
            $page = __invoice_static_display(0);
    }
    else
        $page = __invoice_static_display(1);
}
else
{
    tpl_setpage('public/home');
    header('Location: index.php');
    $page = tpl_construire();
}
