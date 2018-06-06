<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 1:04 PM
 */

class Vector
{
    static $verbose = false;
    private $from;
    private $to;
    private $x;
    private $y;
    private $z;
    private $w;

    function __construct($data)
    {
        if (is_array($data))
        {
            if (isset($data['dest']))
                $this->setFrom($data['dest']);
            if (isset($data['orig']))
                $this->setTo($data['orig']);
            else
                $this->setTo(new Vertex(array("x" => 0, "y" => 0, "z" => 0)));
            $this->setX($this->getFrom()->getX() - $this->getTo()->getX());
            $this->setY($this->getFrom()->getY() - $this->getTo()->getY());
            $this->setZ($this->getFrom()->getZ() - $this->getTo()->getZ());
            $this->setW(0);

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
        if (file_exists('Vector.doc.txt'))
            return (file_get_contents('Vector.doc.txt'));
        return ("");
    }

    public function magnitude()
    {
        return ((float) sqrt(($this->getX() * $this->getX()) + ($this->getY() * $this->getY()) + ($this->getZ() * $this->getZ())));
    }

    public function normalize()
    {
        if ($this->magnitude() == 1)
            return clone $this;
        return (new Vector(array("dest" => new Vertex(array("x" => ($this->getX() / $this->magnitude()), "y" => ($this->getY() / $this->magnitude()), "z" => ($this->getZ() / $this->magnitude()))))));
    }

    public function add(Vector $vectorv)
    {
        $array["x"] = $this->getX() + $vectorv->getX();
        $array["y"] = $this->getY() + $vectorv->getY();
        $array["z"] = $this->getZ() + $vectorv->getZ();
        return (new Vector(array("dest" => new Vertex($array))));
    }

    public function sub(Vector $vectorv)
    {
        $array["x"] = $this->getX() - $vectorv->getX();
        $array["y"] = $this->getY() - $vectorv->getY();
        $array["z"] = $this->getZ() - $vectorv->getZ();
        return (new Vector(array("dest" => new Vertex($array))));
    }

    public function opposite()
    {
        $array["x"] = $this->getX() * -1;
        $array["y"] = $this->getY() * -1;
        $array["z"] = $this->getZ() * -1;
        return (new Vector(array("dest" => new Vertex($array))));
    }

    public function scalarProduct($k)
    {
        $array["x"] = $this->getX() * $k;
        $array["y"] = $this->getY() * $k;
        $array["z"] = $this->getZ() * $k;
        return (new Vector(array("dest" => new Vertex($array))));
    }

    public function dotProduct(Vector $vector)
    {
        $c = (float)0.0;
        $c += (float)($this->getX() * $vector->getX());
        $c += (float)($this->getY() * $vector->getY());
        $c += (float)($this->getZ() * $vector->getZ());
        return ((float)$c);
    }

    public function cos(Vector $vector)
    {
        $c = floatval($this->dotProduct($vector));
        $calc = floatval($c * $c);
        if ($calc != 0)
            return ((float)($c / sqrt($calc)));
        return (0);
    }

    public function crossProduct(Vector $vector)
    {
        $data['x'] = $this->getY() * $vector->getZ() - $this->getZ() * $this->getY();
        $data['y'] = $this->getZ() * $vector->getX() - $this->getZ() * $this->getZ();
        $data['z'] = $this->getX() * $vector->getY() - $this->getY() * $this->getX();
        return (new Vector(array("dest" => new Vertex($data))));
    }

    public function __toString()
    {
        return (sprintf("Vector( x: %0.2f, y: %0.2f, z: %0.2f , w: %0.2f )", $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    private function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    private function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    private function setX($x)
    {
        $this->x = floatval($x);
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    private function setY($y)
    {
        $this->y = floatval($y);
    }

    /**
     * @return mixed
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @param mixed $z
     */
    private function setZ($z)
    {
        $this->z = floatval($z);
    }

    /**
     * @return mixed
     */
    public function getW()
    {
        return $this->w;
    }

    /**
     * @param mixed $w
     */
    private function setW($w)
    {
        $this->w = floatval($w);
    }

}