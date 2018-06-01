<?php

define("TABLE_USER", "users");

    function __user_register($name = NULL, $pass = NULL, $mail = NULL)
    {
        if (isset($name) && isset($pass) && isset($mail))
        {
            
        }
        else
        {
            return ("empty_flags");
        }
    }
?>