#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/30/18
 * Time: 6:57 AM
 */
DEFINE ("NOTE_MOULINETTE", 6.335654152);

function moyenne($csv)
{
    $i = 0;
    $c = 0;
    foreach ($csv as $user)
    {
        if ($user["Note"] != "")
        {
            $c += intval($user["Note"]);
            $i++;
        }
    }
    if ($i > 0) {
        $c /= $i;
        echo $c . "\n";
    }
}

function moyenne_user($csv)
{
    $data = NULL;
    foreach ($csv as $user)
    {
        if ($user["User"] != "User")
        {
            $data[$user["User"]]["Name"] = $user["User"];
            $data[$user["User"]]["Note"] += $user["Note"];
            $data[$user["User"]]["Count"] += 1;
        }
    }
    if (isset($data) && $data != NULL)
        sort($data);
    foreach ($data as $user)
        echo $user["Name"] . ":" . ($user["Note"] / $user["Count"]) . "\n";
}

function ecart_moulinette($csv)
{
    $data = NULL;
    foreach ($csv as $user)
    {
        if ($user["User"] != "User")
        {
            $data[$user["User"]]["Name"] = $user["User"];
            $data[$user["User"]]["Note"] += $user["Note"];
            $data[$user["User"]]["Count"] += 1;
        }
    }
    if (isset($data) && $data != NULL)
        sort($data);
    foreach ($data as $user)
        echo $user["Name"] . ":" . (NOTE_MOULINETTE - ($user["Note"] / $user["Count"])) . "\n";
}

function none()
{

}

function read_entry()
{
    $handle = fopen("php://stdin", 'r');
    while (($str = fgets($handle)) != NULL)
        $donnee[] = $str;
    $i = 0;
    $result = NULL;
    $result = NULL;
    $data = explode(";", $donnee[0]);
    foreach ($donnee as $d)
    {
        $r = explode(";", $d);
        $j = 0;
        while ($data[$j])
        {
            $result[$i][$data[$j]] = $r[$j];
            $j++;
        }
        $i++;
    }
    return $result;
}

if ($argc == 2)
{
    $result = read_entry();
    if ($argv[1] == "moyenne")
        moyenne($result);
    else if ($argv[1] == "moyenne_user")
        moyenne_user($result);
    else if ($argv[1] == "ecart_moulinette")
        ecart_moulinette($result);
    else
        none();
}