#!/usr/bin/php
<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/31/18
 * Time: 6:38 AM
 */

if ($argc == 2)
{
    if (file_exists($argv[1]))
    {
        $content = file_get_contents($argv[1]);
        $explode = explode("\n", $content);
        $i = 0;
        while (isset($explode[$i * 4]))
        {
            $line[$i][0] = $explode[$i * 4];
            $line[$i][1] = $explode[$i * 4 + 1];
            $line[$i][2] = $explode[$i * 4 + 2];
            $line[$i][3] = $explode[$i * 4 + 3];
            $i++;
        }
        $j = 0;
        while (isset($line[$j]))
        {
            $k = 0;
            while (isset($line[$k]))
            {
                $data = NULL;
                $data2 = NULL;
                $data = $line[$k][1];
                if (isset($line[$k + 1][1]))
                    $data2 = $line[$k + 1][1];
                if (isset($data) && isset($data2))
                {
                    $read1 = explode(" --> ", $data);
                    $read2 = explode(" --> ", $data2);

                    if (strcmp($read1[1], $read2[0]) > 0)
                    {
                        $tmp = $line[$k][1];
                        $line[$k][1] = $line[$k + 1][1];
                        $line[$k + 1][1] = $tmp;
                        $tmp = $line[$k][2];
                        $line[$k][2] = $line[$k + 1][2];
                        $line[$k + 1][2] = $tmp;
                    }
                }
                $k++;
            }
            $j++;
        }
        unset($line[$j - 1][3]);
        foreach ($line as $item)
            foreach ($item as $i)
                echo $i . "\n";
    }
}