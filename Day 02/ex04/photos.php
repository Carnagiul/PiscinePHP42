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
        $content = @file_get_contents($file);
        $content2 = @file_get_contents($file);
        $re = '/<img(.|\n)*?>/mx';
        $re_title = '/src="(.|\n)*?"/mx';

        $link1 = explode("http://", $file);
        $link2 = explode("https://", $file);

        if ($link1 == $file)
            $http = $link2[1];
        else if ($link2 == $file)
            $http = $link1[1];
        else
            $http = $file;

        preg_match_all($re, $content2, $matches, PREG_SET_ORDER, 0);
        if (isset($matches))
        {
            foreach ($matches as $m)
            {
                preg_match_all($re_title, $m[0], $matches_title, PREG_SET_ORDER, 0);
                foreach ($matches_title as $mt)
                {
                    $filename1 = explode("\"", $mt[0]);
                    $filename2 = explode("'", $mt[0]);
                    if ($filename1 == $mt[0])
                        $filename = $filename2[1];
                    else
                        $filename = $filename1[1];
                    $real_names = explode("/", $filename);
                    $real_name = NULL;
                    foreach ($real_names as $r)
                        $real_name = $r;
                    shell_exec("mkdir -p " . $http);
                    $url = $filename;
                    $img = $http . '/' . $r;
                    $url = str_replace($file, "", $url);
                    @file_put_contents($img, file_get_contents($file . $url));
                }
            }
        }
    }
}