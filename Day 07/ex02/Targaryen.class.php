<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 8:58 PM
 */

class Targaryen
{
    public function getBurned()
    {
        if ($this->resistsFire())
            return "emerges maked but unharmed";
        return "burns alive";
    }

    public function resistsFire() {
        return false;
    }

}