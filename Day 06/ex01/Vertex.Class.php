<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 11:01 AM
 */

class Vertex
{
    static $verbose = false;
    private $w = 1.0;
    private $x = 0;
    private $y = 0;
    private $z = 0;
    private $color;

    function __construct($data)
    {
        if (is_array($data))
        {
            if (isset($data["x"]) && isset($data["y"]) && isset($data['z']))
            {
                $this->setX($data['x']);
                $this->setY($data['y']);
                $this->setZ($data['z']);
                if (isset($data["w"]))
                    $this->setW($data['w']);
                if (isset($data["color"]))
                    $this->setColor($data['color']);
                else
                    $this->setColor(new Color(array("rgb" => 0xFFFFFF)));
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
        if (file_exists('Vertex.doc.txt'))
            return (file_get_contents('Vertex.doc.txt'));
        return ("");
    }

    public function __toString()
    {
        return (sprintf("Vertex( x: %0.2f, y: %0.2f, z: %0.2f, w: %0.2f, %s )", $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->getColor()->__toString()));
    }

    /**
     * @return int
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param int $w
     */
    public function setW($w)
    {
        $this->w = floatval($w);
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX($x)
    {
        $this->x = floatval($x);
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY($y)
    {
        $this->y = floatval($y);
    }

    /**
     * @return int
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @param int $z
     */
    public function setZ($z)
    {
        $this->z = floatval($z);
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        if ($color instanceof Color)
            $this->color = $color;
        $this->color = $this->color;
    }
}