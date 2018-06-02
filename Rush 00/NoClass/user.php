<?php

    function __user_username_exist($name = NULL)
    {
        $ret = NULL;

        if ($name)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `name`='" . $name . "'");
            if (isset($ret))
                return (true);
        }
        return (false);
    }

    function __user_mail_exist($mail = NULL)
    {
        $ret = NULL;

        if ($mail)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `mail`='" . $mail . "'");
            if (isset($ret))
                return (true);
        }
        return (false);
    }

    function __user_id_exist($id = NULL)
    {
        $ret = NULL;

        if ($id)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `id`='" . intval($id) . "'");
            if (isset($ret))
                return (true);
        }
        return (false);
    }

    function __user_getUserById($id = NULL)
    {
        $ret = NULL;

        if ($id)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `id`='" . intval($id) . "'");
            if (isset($ret))
                return ($ret);
        }
        return (NULL);
    }

    function __user_getUserByName($name = NULL)
    {
        $ret = NULL;

        if ($name)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `name`='" . $name . "'");
            if (isset($ret))
                return ($ret);
        }
        return (NULL);
    }

    function __user_getUserByMail($mail = NULL)
    {
        $ret = NULL;

        if ($mail)
        {
            $ret = sql_select("SELECT * FROM `" . TABLE_USER . "` WHERE `mail`='" . $mail . "'");
            if (isset($ret))
                return ($ret);
        }
        return (NULL);
    }

    function __user_loggin($name = NULL, $pass = NULL)
    {
        $ret = NULL;
        $user = NULL;

        $user = __user_getUserByMail($name);
        if (!(isset($user)))
            $user = __user_getUserByName($name);
        if (!(isset($user)))
            return ("user_not_exist");
        if ($user['pass'] == md5($pass))
        {
            $_SESSION['user'] = $user;
            return ("user_logged");
        }
        return ("wrong_password");
    }

    function __user_register($name = NULL, $pass = NULL, $mail = NULL)
    {
        $ret = NULL;

        if (isset($name) && isset($pass) && isset($mail))
        {
            if ($name == $pass || (strcmp(strrev($name), $pass) == 0) || strlen($pass) < 8)
                $ret[] = "pass_too_easy";
            if (!(filter_var($mail, FILTER_VALIDATE_EMAIL)))
                $ret[] = "wrong_mail";
            if (__user_username_exist($name))
                $ret[] = "username_exist";
            if (__user_mail_exist($mail))
                $ret[] = "usermail_exist";
            if (isset($ret))
                return ($ret);
            sql_update("INSERT INTO `" . TABLE_USER . "` (`id`, `name`, `mail`, `pass`, `ip`, `descr`, `avatar`, `banni`, `reason_ban`, `last_co`, `admin`, `lang`) VALUES (NULL, '" . $name . "', '" . $mail . "', '" . md5($pass) . "', '0.0.0.0', 'Aucune Description', '', '0', '', '" . time() . "', '0', 'FR'	);");
            $ret[] = "account_create";
        }
        else
        {
            if (!(isset($name)))
                $ret[] = "missing_username";
            if (!(isset($pass)))
                $ret[] = "missing_password";
            if (!(isset($mail)))
                $ret[] = "missing_mail";
        }
        return ($ret);
    }
?>