#!/usr/bin/php
<?php

/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 9:37 AM
 */

$output = shell_exec("who");

echo $output;
?>