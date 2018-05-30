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
        $matches = NULL;
        $matches_title = NULL;
        $matches_alt = NULL;
        $matches_div = NULL;
        $content = file_get_contents($file);
        $content2 = file_get_contents($file);
        $re = '/<a(.|\n)*?<\/a>/mx';
        $re_title = '/(title=".*.")/mx';
        $re_alt = '/(alt=".*.")/mx';
        $re_div = '/>(.|\n)*?</mx';
        preg_match_all($re, $content2, $matches, PREG_SET_ORDER, 0);
        if (isset($matches))
        {
            foreach ($matches as $m)
            {
                preg_match_all($re_title, $m[0], $matches_title, PREG_SET_ORDER, 0);
                foreach ($matches_title as $mt)
                {
                    $explode = explode("=", $mt[0]);
                    $explode[1] = strtoupper($explode[1]);
                    $content = str_replace($mt[0], implode("=", $explode), $content);
                }
                preg_match_all($re_alt, $m[0], $matches_alt, PREG_SET_ORDER, 0);
                foreach ($matches_alt as $mt)
                {
                    $explode = explode("=", $mt[0]);
                    $explode[1] = strtoupper($explode[1]);
                    $content = str_replace($mt[0], implode("=", $explode), $content);
                }
                preg_match_all($re_div, $m[0], $matches_div, PREG_SET_ORDER, 0);
                foreach ($matches_div as $mt)
                {
                    $explode = strtoupper($mt[0]);
                    $content = str_replace($mt[0], $explode, $content);
                }
            }
            echo $content;
        }
    }
}