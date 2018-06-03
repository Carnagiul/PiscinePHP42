<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/2/18
 * Time: 9:18 AM
 */

define("MERCH_TABLE", "merchs");
define("GROUP_TABLE", "group_merchs");

    function __menu_generate()
    {

        $list_group = "";
        $ret = sql_query("SELECT * FROM `" . GROUP_TABLE . "`");
        tpl_setpage('menu/menu_merchandise');
        if (isset($ret))
        {
          while ($line = mysqli_fetch_array($ret))
          {
              tpl_add_data('menu_id', $line['id']);
              tpl_add_data('menu_name', $line['name']);
              $list_group .= tpl_construire();
          }
        }

        tpl_add_data('menu_merch', $list_group);
    }

    function __merch_existById($id)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        if (isset($merch))
            return (true);
        return (false);
    }

    function __merch_existByName($name)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `name`='" . $name . "'");
        if (isset($merch))
            return (true);
    }

    function __merch_groupexistByName($name)
    {
        $ret = sql_select("SELECT * FROM `" . GROUP_TABLE . "` WHERE `name`='" . $name . "'");
        if (isset($ret))
            return (true);
        return (false);
    }

    function __merch_getById($id)
    {
        $merch = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($id) . "'");
        if (isset($merch))
            return ($merch);
        return (NULL);
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

    function __merch_groupIdExist($id)
    {
        $ret = sql_select("SELECT * FROM `" . GROUP_TABLE . "` WHERE `id`='" . intval($id) . "'");
        if (isset($ret['id']))
            return (true);
        return (false);
    }

    function __merch_groupNameExist($name)
    {
        $ret = sql_select("SELECT * FROM `" . GROUP_TABLE . "` WHERE `name`='" . $name . "'");
        if (isset($ret['name']))
            return (true);
        return (false);
    }

    function __merch_add_merch($id = 0, $amount = 0)
    {
        $ret = NULL;
        $merch = NULL;
        if ($id <= 0 || ctype_digit($id) == 0)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if (__merch_existById($id) == false)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        $merch = __merch_getById($id);
        if (intval($amount) >= 0) {
            if (intval($amount) + $_SESSION['merch']['merch_' . $id] > intval($merch['amount']))
                $ret[] = "unsuficcient_stock";
        }
        else
            return (__merch_remove_merch($id, -1 * intval($amount)));
        if ($ret)
            return ($ret);
        $_SESSION['merch']['merch_' . $id] += intval($amount);
        $ret[] = "merch_add";
        return ($ret);
    }

    function __merch_remove_merch($id = 0, $amount = 0)
    {
        $ret = NULL;
        $merch = NULL;

        if ($id <= 0 || ctype_digit($id) == 0)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if (__merch_existById($id) == false)
            $ret[] = "merch_not_exist";
        if ($ret)
            return ($ret);
        if ($amount > $_SESSION['merch']['merch_' . $id])
            $ret[] = "unsuficcient_panier_stock";
        if ($ret)
            return ($ret);
        $_SESSION['merch']['merch_' . $id] -= intval($amount);
        if ($_SESSION['merch']['merch_' . $id] < 0)
            unset($_SESSION['merch']['merch_' . $id]);
        $ret[] = "merch_remove";
        return ($ret);
    }

    function __merch_create_new($name, $descr, $price, $amount, $image, $group)
    {
        $ret = NULL;

        if (!(isset($name)) || __merch_existByName($name) == true)
            $ret[] = "name_undefined";
        if (!(isset($descr)))
            $ret[] = "descr_undefined";
        if (!(isset($price)))
            $ret[] = "price_undefined";
        if (!(isset($amount)))
            $ret[] = "amount_undefined";
        if (!(isset($image)))
            $ret[] = "image_undefined";
        if (!(isset($group)) || __merch_groupIdExist($group) == false)
            $ret[] = "group_undefined";
        if ($ret)
            return ($ret);
        if (!(@GetImageSize($image))) {
            $ret[] = "image_undefined";
            return ($ret);
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
        {
            sql_update("INSERT INTO `" . MERCH_TABLE . "` (`id`, `name`, `description`, `price`, `amount`, `image`, `group_id`) VALUES (NULL, '" . $name . "', '" . $descr . "', '" . $price . "', '" . $amount . "', '" . $image . "', '" . $group . "');");
            $ret[] = "merch_created";
            return ($ret);
        }
        $ret[] = "not_Admin";
        return ($ret);
    }

    function __merch_create_new_group($name)
    {
        $ret = NULL;

        if (!(isset($name)) || __merch_groupexistByName($name) == true)
            $ret[] = "group_name_undefined";
        if ($ret)
            return ($ret);
        if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1)
        {
            sql_update("INSERT INTO `" . GROUP_TABLE . "` (`id`, `name`) VALUES (NULL, '" . $name . "');");
            $ret[] = "group_merch_created";
            return ($ret);
        }
        $ret[] = "not_Admin";
        return ($ret);
    }