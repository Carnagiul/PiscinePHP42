<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:22 AM
 */

@session_start();

if (isset($_SESSION["loggued_on_user"]))
    unset($_SESSION["loggued_on_user"]);