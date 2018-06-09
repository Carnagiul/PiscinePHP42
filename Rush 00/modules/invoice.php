<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 4:22 PM
 */

if (isset($_SESSION['user'])) {
    if (isset($_POST['action']) && $_POST['action'] == "Command") {
        $array = 0;
        $invoice = "";
        $price = 0;
        foreach ($_SESSION['merch'] as $merch => $amount) {
            $explode = explode("_", $merch);
            $ret = sql_select("SELECT * FROM `" . MERCH_TABLE . "` WHERE `id`='" . intval($explode[1]) . "'");
            $x = $ret['amount'] - $amount;
            if ($x < 0)
                $x = 0;
            $array = 1;
            $price += $amount * $ret['price'];
            sql_update("UPDATE `" . MERCH_TABLE . "` SET `amount` = '" . $x . "' WHERE `merchs`.`id` = '" . $explode[1] . "';");
            $invoice .= implode("-", array("id" => $explode[1], "amount" => $amount)) . ";";
            unset($_SESSION['merch'][$merch]);
        }
        if ($array == 1) {
            sql_update("INSERT INTO `" . INVOCE_TABLE . "` (`id`, `user_id`, `content`, `timestamp`, `price`) VALUES (NULL, '" . $_SESSION['user']['id'] . "', '" . $invoice . "', '" . time() . "', '" . $price . "');");
            tpl_setpage('invoice/done');

            $to      = htmlentities($_SESSION['user']["mail"]);
            $subject = 'Rush 00 - Invoice';
            $message = 'Bonjour, vous venez d\'effectuer un achat sur notre site.\n';
            $headers = 'From: rush00@rush00.con' . "\r\n" .
                'Reply-To: custommer@rush00.con' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);


        } else
            tpl_setpage('invoice/error');
        $page = tpl_construire();
    }
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
       tpl_add_data('invoice_user', (isset($_SESSION['user'])) ? $_SESSION['user']['name'] : "Visiteur");
       tpl_setpage('invoice/main_view');
       $page = tpl_construire();
