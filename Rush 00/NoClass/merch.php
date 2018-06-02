<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 9:18 AM
 */

define("MERCH_TABLE", "merchs");

    function __merch_existById($id)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        if (isset($merch))
            return (true);
        return (false);
    }

    function __merch_getById($id)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        if (isset($merch))
            return (true);
        return (false);
    }

    function __merch_remove_stock($id, $amount)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        $merch['amount'] -= $amount;
        sql_update("UPDATE `" . MERCH_TABLE . "` SET `amount` = '" . $merch['amount'] . "' WHERE `id` = '" . $id . "';");
    }

    function __merch_ad_stock($id, $amount)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        $merch['amount'] += $amount;
        sql_update("UPDATE `" . MERCH_TABLE . "` SET `amount` = '" . $merch['amount'] . "' WHERE `id` = '" . $id . "';");
    }

    function __merch_add_merch($id = 0, $amount = 0)
    {
        $ret = NULL;
        $merch = NULL;

        if ($id <= 0 || ctype_digit($id) != 0)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if (__merch_existById($id))
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        $merch = __merch_getById($id);
        if ($amount <= 0 || ctype_digit($amount) != 0)
            $ret[] = "amount_is_invalid";
        if ($ret)
            return ($ret);
        if ($amount > $merch['amount'])
            $ret[] = "unsuficcient_stock";
        if ($ret)
            return ($ret);
        $_SESSION['merch']['merch_' . $id] += $amount;
        $ret[] = "merch_add";
        return ($ret);
    }

    function __merch_remove_merch($id = 0, $amount = 0)
    {
        $ret = NULL;
        $merch = NULL;

        if ($id <= 0 || ctype_digit($id) != 0)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if (__merch_existById($id))
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if ($amount <= 0 || ctype_digit($amount) != 0)
            $ret[] = "amount_is_invalid";
        if ($ret)
            return ($ret);
        if ($amount > $_SESSION['merch']['merch_' . $id])
            $ret[] = "unsuficcient_panier_stock";
        if ($ret)
            return ($ret);
        $_SESSION['merch']['merch_' . $id] -= $amount;
        $ret[] = "merch_remove";
        return ($ret);
    }

    function __merch_create_new($name, $descr, $price, $amount, $image)
    {

    }