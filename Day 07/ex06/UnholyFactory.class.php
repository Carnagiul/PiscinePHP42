<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 9:47 PM
 */

class UnholyFactory
{
    private $soldats;

    function absorb($data)
    {
        if ($data instanceof Fighter)
        {
            if ($this->soldats[$data->getName()])
                print ("(Factory already absorbed a fighter of type " . $data->getName() . ")" . PHP_EOL);
            else
            {
                $this->soldats[$data->getName()] = $data;
                print ("(Factory absorbed a fighter of type " . $data->getName() . ")" . PHP_EOL);
            }
        }
        else
        {
            print ("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
        }

    }

    function fabricate($data)
    {
            foreach ($this->soldats as $soldat) {
                if ($soldat instanceof Fighter) {
                    if ($soldat->getName() == $data) {
                        print ("(Factory fabricates a fighter of type " . $soldat->getName() . ")" . PHP_EOL);
                        return clone $soldat;
                    }
                }
            }
            print ("(Factory hasn't absorbed any fighter of type " . $data . ")" . PHP_EOL);
    }
}