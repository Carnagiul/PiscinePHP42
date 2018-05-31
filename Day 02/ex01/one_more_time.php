#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 9:10 AM
 */

function setTimezone($default)
{
    $timezone = "";

    if (is_link("/etc/localtime")) {

        $filename = readlink("/etc/localtime");

        $pos = strpos($filename, "zoneinfo");
        if ($pos) {
            $timezone = substr($filename, $pos + strlen("zoneinfo/"));
        } else {
            $timezone = $default;
        }
    }
    else {

        $timezone = file_get_contents("/etc/timezone");
        if (!strlen($timezone)) {
            $timezone = $default;
        }
    }
    date_default_timezone_set($timezone);
}

if ($argc == 2)
{
    $value = trim($argv[1]);
    $result = preg_split('/\s+/', $value);
    if (count($result) == 5)
    {
        setTimezone('UTC');
        $day_name = $result[0];
        $day_value = $result[1];
        $month_value = $result[2];
        $year_value = $result[3];
        $hour_value = explode(":", $result[4]);
        if (count($hour_value) == 3 && is_numeric($hour_value[0]) && is_numeric($hour_value[1]) && is_numeric($hour_value[2]) && is_numeric($day_value) && is_numeric($year_value))
        {
            $none = 0;
            if ($day_name != "Lundi" && $day_name != "Mardi" && $day_name != "Mercredi" && $day_name != "Jeudi" &&  $day_name != "Vendredi" && $day_name != "Samedi" && $day_name != "Dimanche")
                $none = 1;
            if ($day_name == "Janvier")
                $month_value = 1;
            else if ($month_value == "Février")
                $month_value = 2;
            else if ($month_value == "Mars")
                $month_value = 3;
            else if ($month_value == "Avril")
                $month_value = 4;
            else if ($month_value == "Mai")
                $month_value = 5;
            else if ($month_value == "Juin")
                $month_value = 6;
            else if ($month_value == "Juillet")
                $month_value = 7;
            else if ($month_value == "Aout")
                $month_value = 8;
            else if ($month_value == "Septembre")
                $month_value = 9;
            else if ($month_value == "Octobre")
                $month_value = 10;
            else if ($month_value == "Novembre")
                $month_value = 11;
            else if ($month_value == "Décembre")
                $month_value = 12;
            else
                $none = 1;
            if ($none == 0)
            {
                $timestamp = mktime(intval($hour_value[0]), intval($hour_value[1]), intval($hour_value[2]), intval($month_value), intval($day_value), intval($year_value));
                echo $timestamp . "\n";
            }
            else
            {
                echo "Wrong Format\n";
            }
        }
        else
        {
            echo "Wrong Format\n";
        }
    }
    else
    {
        echo "Wrong Format\n";
    }
}