<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/1/18
 * Time: 11:53 AM
 */

    if (file_exists('./private/chat'))
    {
        $content = unserialize(file_get_contents('./private/chat'));
        foreach ($content as $line)
            echo "[" . date("H:i", $line["time"]) . "] <b>" . $line["user"] . "</b>: " . $line["msg"] . "<br />";
    }
    ?>
</iframe>
