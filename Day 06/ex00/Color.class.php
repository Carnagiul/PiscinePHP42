<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 11:01 AM
 */

class Color
{
    static $verbose = false;
    private $red = 0;
    private $green = 0;
    private $blue = 0;

    function __construct($data)
    {
        if (is_array($data))
        {
            if (isset($data['red']) && isset($data['green']) && isset($data['blue'])) {
                if (isset($data['red']))
                    $this->setRed(intval($data['red']));
                if (isset($data['green']))
                    $this->setGreen(intval($data['green']));
                if (isset($data['blue']))
                    $this->setBlue(intval($data['blue']));
            }
            else if (isset($data['rgb']))
            {
                $data['rgb'] = intval($data['rgb']);
                $this->setRed($data['rgb'] / 65281 % 256);
                $this->setGreen($data['rgb'] / 256 % 256);
                $this->setBlue($data['rgb'] % 256);
            }
        }
        if (self::$verbose)
            printf("%s constructed.". PHP_EOL, $this->__toString());
    }

    function __destruct()
    {
        if (self::$verbose)
            printf("%s destructed.". PHP_EOL, $this->__toString());
    }

    public static function doc()
    {
        if (file_exists('Color.doc.txt'))
            return (file_get_contents('Color.doc.txt'));
        return ("");
    }

    public function add(Color $color)
    {
        $ret = array('red' => ($color->getRed() + $this->getRed()),'green' => ($color->getGreen() + $this->getGreen()),'blue' => ($color->getBlue() + $this->getBlue()));
        return (new Color($ret));
    }

    public function sub(Color $color)
    {
        $ret = array('red' => ($this->getRed() - $color->getRed()),'green' => ($this->getGreen() - $color->getGreen()),'blue' => ($this->getBlue() - $color->getBlue()));
        return (new Color($ret));
    }

    public function mult($color)
    {
        $color = intval($color);
        $ret = array('red' => ($this->getRed() * $color),'green' => ($color * $this->getGreen()),'blue' => ($color * $this->getBlue()));
        return (new Color($ret));
    }

    public function __toString()
    {
        return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->getRed(), $this->getGreen(), $this->getBlue()));
    }

    /**
     * @return mixed
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * @param mixed $blue
     */
    public function setBlue($blue)
    {
        $this->blue = $blue;
        if ($this->blue < 0)
            $this->blue = 0;
        if ($this->blue > 255)
            $this->blue = 255;
    }

    /**
     * @return mixed
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @param mixed $green
     */
    public function setGreen($green)
    {
        $this->green = $green;
        if ($this->green < 0)
            $this->green = 0;
        if ($this->green > 255)
            $this->green = 255;
    }

    /**
     * @return mixed
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @param mixed $red
     */
    public function setRed($red)
    {
        $this->red = $red;
        if ($this->red < 0)
            $this->red = 0;
        if ($this->red > 255)
            $this->red = 255;
    }
}