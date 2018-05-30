#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 9:43 AM
 */

if ($argc == 2)
{
    $file = $argv[1];
    if (file_exists($file));
    {

        $content = file_get_contents($file);
        $content2 = file_get_contents($file);
        $re = '/<a.*a>/i';
        preg_match_all($re, $content2, $matches, PREG_SET_ORDER, 0);
        var_dump($content, $matches);
    }
}