<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 3:52 PM
 */

class Matrix
{
    static $verbose = false;
    const IDENTITY = 1;
    const SCALE = 2;
    const RX = 3;
    const RY = 4;
    const RZ = 5;
    const TRANSLATION = 6;
    const PROJECTION = 7;
    private $preset = 0;
    private $scale;
    private $angle;
    private $vtc;
    private $fov;
    private $ratio;
    private $near;
    private $far;
    private $matrix;

    function __construct($data)
    {
        if (is_array($data))
        {
            if (isset($data['preset']))
                if (intval($data['preset']) >= 1 && intval($data['preset']) <= 7)
                    $this->setPreset(intval($data['preset']));
            if ($this->getPreset() == self::SCALE && isset($data['scale']))
                $this->setScale($data['scale']);
            else if ($this->getPreset() >= self::RX && $this->getPreset() <= self::RZ && isset($data['angle']))
                $this->setAngle($data['angle']);
            else if ($this->getPreset() == self::TRANSLATION && isset($data['vtc']))
                $this->setVtc($data['vtc']);
            else if ($this->getPreset() == self::PROJECTION && isset($data['fov']) && isset($data['far']) && isset($data['near']))
            {
                $this->setVtc($data['fov']);
                $this->setFar($data['far']);
                $this->setNear($data['near']);
            }
            else if ($this->getPreset() == self::IDENTITY)
                ;
            else
                return ("Error");
            $this->generate_matrix();
        }
        if (self::$verbose)
        {
            if (self::IDENTITY == $this->getPreset())
                printf("Matrix IDENTITY instance constructed\n");
            if (self::TRANSLATION == $this->getPreset())
                printf("Matrix TRANSLATION preset instance constructed\n");
            if (self::SCALE == $this->getPreset())
                printf("Matrix SCALE preset instance constructed\n");
            if (self::RX == $this->getPreset())
                printf("Matrix Ox ROTATION preset instance constructed\n");
            if (self::RY == $this->getPreset())
                printf("Matrix Oy ROTATION preset instance constructed\n");
            if (self::RZ == $this->getPreset())
                printf("Matrix Oz ROTATION preset instance constructed\n");
            if (self::PROJECTION == $this->getPreset())
                printf("Matrix PROJECTION preset instance constructed\n");
        }
    }

    function __destruct()
    {
        if (self::$verbose)
            printf("Matrix instance destructed\n");
    }

    public static function doc()
    {
        if (file_exists('Matrix.doc.txt'))
            return (file_get_contents('Matrix.doc.txt'));
        return ("");
    }

    public function __toString()
    {
        $matrix = $this->getMatrix();
        $line =     "M | vtcX | vtcY | vtcZ | vtx0\n";
        $line .=    "-----------------------------\n";
        $line .=    sprintf("x | %0.2f | %0.2f | %0.2f | %0.2f\n", $matrix[0][0], $matrix[0][1], $matrix[0][2], $matrix[0][3]);
        $line .=    sprintf("y | %0.2f | %0.2f | %0.2f | %0.2f\n", $matrix[1][0], $matrix[1][1], $matrix[1][2], $matrix[1][3]);
        $line .=    sprintf("z | %0.2f | %0.2f | %0.2f | %0.2f\n", $matrix[2][0], $matrix[2][1], $matrix[2][2], $matrix[2][3]);
        $line .=    sprintf("w | %0.2f | %0.2f | %0.2f | %0.2f\n", $matrix[3][0], $matrix[3][1], $matrix[3][2], $matrix[3][3]);
        return ($line);
    }

    private function generate_identity()
    {
        $array = NULL;
        $array[] = array(1,0,0,0);
        $array[] = array(0,1,0,0);
        $array[] = array(0,0,1,0);
        $array[] = array(0,0,0,1);
        $this->setMatrix($array);
    }

    private function scale_matrix()
    {
        $array = NULL;
        $array[] = array($this->getScale(),0,0,0);
        $array[] = array(0,$this->getScale(),0,0);
        $array[] = array(0,0,$this->getScale(),0);
        $array[] = array(0,0,0,1);
        $this->setMatrix($array);
    }

    private function translate_matrix()
    {
        $array = NULL;
        $array[] = array(1,0,0,$this->getVtc()->getX());
        $array[] = array(0,1,0,$this->getVtc()->getY());
        $array[] = array(0,0,1,$this->getVtc()->getZ());
        $array[] = array(0,0,0,1);
        $this->setMatrix($array);
    }

    private function rotate_matrix()
    {
        $array = NULL;
        $array[] = array(1,0,0,0);
        $array[] = array(0,1,0,0);
        $array[] = array(0,0,1,0);
        $array[] = array(0,0,0,1);
        if ($this->getPreset() == self::RX)
        {
            $array[1][1] = cos($this->getAngle());
            $array[1][2] = -sin($this->getAngle());
            $array[2][1] = sin($this->getAngle());
            $array[2][2] = cos($this->getAngle());
        }
        if ($this->getPreset() == self::RY)
        {
            $array[0][0] = cos($this->getAngle());
            $array[0][2] = sin($this->getAngle());
            $array[2][0] = -sin($this->getAngle());
            $array[2][2] = cos($this->getAngle());
        }
        if ($this->getPreset() == self::RZ)
        {
            $array[0][0] = cos($this->getAngle());
            $array[0][1] = -sin($this->getAngle());
            $array[1][0] = sin($this->getAngle());
            $array[1][1] = cos($this->getAngle());
        }
        $this->setMatrix($array);
    }

    private function project_matrix()
    {
        $array = NULL;
        $array[] = array(1,0,0,0);
        $array[] = array(0,1,0,0);
        $array[] = array(0, -1 * ($this->getNear() - $this->getFar()) / ($this->getNear() - $this->getFar()),1,0);
        $array[] = array(0,-1,0,0);

        $array[1][0] = (tan(0.5 * deg2rad($this->getFov())) != 0) ? 1 / tan(0.5 * deg2rad($this->getFov())) : 0;
        $array[0][0] = ($this->getRatio() != 0) ? $array[1][0] / $this->getRatio() : 0;
        if (($this->getNear() - $this->getFar()) != 0)
            $array[2][3] = (2 * $this->getNear() * $this->getFar()) / ($this->getNear() - $this->getFar());
        else
            $array[2][3] = 0;
        $this->getMatrix($array);
    }

    private function generate_matrix()
    {
        if ($this->getPreset() == self::IDENTITY)
            $this->generate_identity();
        if ($this->getPreset() == self::SCALE)
           $this->scale_matrix();
        if ($this->getPreset() >= self::RX && $this->getPreset() <= self::RZ)
            $this->rotate_matrix();
        if ($this->getPreset() == self::TRANSLATION)
            $this->translate_matrix();
        if ($this->getPreset() == self::PROJECTION)
            $this->project_matrix();
    }

    public function mult(Matrix $matrix)
    {
        $m3 = array();

        for ($i=0;$i<4;$i++){
            for($j=0;$j<4;$j++){
                $m3[$i][$j]=0;
                for($k=0;$k<4;$k++){
                    $m3[$i][$j]+=$this->getMatrix()[$i][$k]*$matrix->getMatrix()[$k][$j];
                }
            }
        }
        $data = new Matrix(array());
        $data->setMatrix($m3);
        return ($data);
    }

    public function transformVertex(Vertex $vertex)
    {
        $ret = array();
        $matrix = $this->getMatrix();
        $ret['x'] = $matrix[0][0] * $vertex->getX() + $matrix[0][1] * $vertex->getY() + $matrix[0][2] * $vertex->getZ() + $matrix[0][3] * $vertex->getW();
        $ret['y'] = $matrix[1][0] * $vertex->getX() + $matrix[1][1] * $vertex->getY() + $matrix[1][2] * $vertex->getZ() + $matrix[1][3] * $vertex->getW();
        $ret['z'] = $matrix[2][0] * $vertex->getX() + $matrix[2][1] * $vertex->getY() + $matrix[2][2] * $vertex->getZ() + $matrix[2][3] * $vertex->getW();
        $ret['w'] = $matrix[3][0] * $vertex->getX() + $matrix[3][1] * $vertex->getY() + $matrix[3][2] * $vertex->getZ() + $matrix[3][3] * $vertex->getW();
        return (new Vertex($ret));
    }

    /**
     * @return int
     */
    public function getPreset()
    {
        return $this->preset;
    }

    /**
     * @param int $preset
     */
    private function setPreset($preset)
    {
        $this->preset = $preset;
    }

    /**
     * @return mixed
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * @param mixed $scale
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
    }

    /**
     * @return mixed
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * @param mixed $angle
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
    }

    /**
     * @return mixed
     */
    public function getVtc()
    {
        return $this->vtc;
    }

    /**
     * @param mixed $vtc
     */
    public function setVtc($vtc)
    {
        $this->vtc = $vtc;
    }

    /**
     * @return mixed
     */
    public function getFov()
    {
        return $this->fov;
    }

    /**
     * @param mixed $fov
     */
    public function setFov($fov)
    {
        $this->fov = $fov;
    }

    /**
     * @return mixed
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * @param mixed $ratio
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * @return mixed
     */
    public function getNear()
    {
        return $this->near;
    }

    /**
     * @param mixed $near
     */
    public function setNear($near)
    {
        $this->near = $near;
    }

    /**
     * @return mixed
     */
    public function getFar()
    {
        return $this->far;
    }

    /**
     * @param mixed $far
     */
    public function setFar($far)
    {
        $this->far = $far;
    }

    /**
     * @return mixed
     */public function getMatrix()
    {
        return $this->matrix;
    }
    /**
     * @param mixed $matrix
     */public function setMatrix($matrix)
    {
        $this->matrix = $matrix;
    }
}