<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 8:49 PM
 */

class Tyrion extends Lannister
{
    public function __construct()
    {

        parent::__construct();
        print ("My name is Tyrion" . PHP_EOL);
    }

    public function getSize()
    {
        print ("Short");
    }
}