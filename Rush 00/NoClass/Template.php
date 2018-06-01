<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 6:41 PM
 */

$tpl_data = NULL;
$tpl_file = NULL;

function tpl_add_data($key, $value)
{
    global $tpl_data;

    $tpl_data[$key] = $value;
}

function tpl_setpage($page)
{
    global $tpl_file;

    $tpl_file = $page;
}

function tpl_construire()
{
    global $tpl_file, $tpl_data;

    $content = file_get_contents('./template/' . $tpl_file . '.html');

    foreach ($tpl_data as $key => $value)
        $content = str_replace("{{{$key}}}", $value, $content);
    return ($content);
}