#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/31/18
 * Time: 6:38 AM
 */

if ($argc == 3)
{
    if (file_exists($argv[1]))
    {
        $content = file_get_contents($argv[1]);
        $explode = explode("\n", $content);
        $data_name = 0;
        $id = 0;
        foreach ($explode as $line)
        {
            $data = explode(";", $line);
            if ($id != 0)
            {
                if ($data_name == 0)
                    exit();
                $nom[$data[$data_name]] = $data[0];
                $prenom[$data[$data_name]] = $data[1];
                $mail[$data[$data_name]] = $data[2];
                $IP[$data[$data_name]] = $data[3];
                $pseudo[$data[$data_name]] = $data[3];
            }
            else
            {
                $j = 0;
                while ($data[$j])
                {
                    if ($data[$j] == $argv[2])
                        $data_name = $j;
                    $j++;
                }
            }
            $id++;
        }
        $stdin = fopen('php://stdin', 'r');
        while ($stdin)
        {
            echo "Entrez votre commande : ";
            $l = fgets(STDIN);
            if ($l == NULL)
                break ;
            $line = str_replace("\n", "", $l);
            if ($line[strlen($line) - 1] == ';')
                eval($line);
            else
                echo "PHP Parse error : syntax error, unexpected T_STRING in [...]\n";
        }
    }
}