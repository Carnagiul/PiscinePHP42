<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/3/18
 * Time: 7:27 PM
 */

unset($_SESSION['panier']);

tpl_setpage('reset');
$page = tpl_construire();