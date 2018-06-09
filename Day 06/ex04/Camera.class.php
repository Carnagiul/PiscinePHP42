<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/6/18
 * Time: 6:58 PM
 */

require_once ("Color.class.php");
require_once ("Vertex.class.php");
require_once ("Vector.class.php");
require_once ("Matrix.class.php");

class Camera
{
    private $width;
    private $height;
    private $near;
    private $far;
    private $fov;
    private $ratio;
    private $origin;
    private $orientation;
    private $Tt;
    private $Tr;
    private $Project;
    static $verbose = false;

    function __construct($data)
    {
        if (isset($data['width']))
            $this->setWidth($data['width']);
        if (isset($data['height']))
            $this->setHeight($data['height']);
        if (isset($data['near']))
            $this->setNear($data['near']);
        if (isset($data['far']))
            $this->setFar($data['far']);
        if (isset($data['fov']))
            $this->setFov($data['fov']);
        if (isset($data['ratio']))
            $this->setRatio($data['ratio']);
        if (isset($data['origin']))
            $this->setOrigin($data['origin']);
        if (isset($data['orientation']))
            $this->setOrientation($data['orientation']);
        if (isset($data['origin']))
            $this->initTt();
        if (isset($data['orientation']))
            $this->initTr();
        if (isset($data['width']) && isset($data['height']))
            $this->initRatio();
        $this->initProject();

        if (self::$verbose)
            echo "Camera instance constructed\n";
    }

    function __destruct()
    {
        if (self::$verbose)
            echo "Camera instance destructed\n";
    }

    function __toString()
    {
        $tmp = "Camera( \n";
        $tmp .= "+ Origine: " . $this->getOrigin() . "\n";
        $tmp .= "+ tT:\n" . $this->getTt() . "\n";
        $tmp .= "+ tR:\n" . $this->getTr() . "\n";
        $tmp .= "+ tR->mult( tT ):\n" . $this->getTr()->mult($this->getTt()) . "\n";
        $tmp .= "+ Proj:\n" . $this->getProject() . ")";
        return ($tmp);
    }

    public function watchVertex(Vertex $vertex){
        $new_vertext = $this->_proj->transformVertex($this->getTr()->transformVertex($vertex));
        $new_vertext->setX($new_vertext->getX() * $this->getRatio());
        $new_vertext->setY($new_vertext->getY());
        $new_vertext->setColor($vertex->getColor());
        return ($new_vertext);
    }

    public static function doc()
    {
        if (file_exists('Camera.doc.txt'))
            return (file_get_contents('Camera.doc.txt'));
        return ("");
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = (float)$width / 2;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height)
    {
        $this->height = (float)$height / 2;
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
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @return mixed
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * @param mixed $orientation
     */
    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
    }

    public function initTt()
    {
        $vector = new Vector(array('dest' => $this->getOrigin()));
        $this->setTt(new Matrix(array('preset' => Matrix::TRANSLATION, 'vtc' => $vector->opposite())));
    }

    /**
     * @return mixed
     */
    public function getTt()
    {
        return $this->Tt;
    }

    /**
     * @param mixed $Tt
     */
    public function setTt($Tt)
    {
        $this->Tt = $Tt;
    }

    public function initTr()
    {
        $m = NULL;
        $m2 = NULL;
        $martix = $this->getOrientation();
        if ($martix instanceof Matrix) {
            $m = $martix->getMatrix();
            $m2 = $m;
            $m2[0][1] = $m[1][0];
            $m2[0][2] = $m[2][0];
            $m2[0][3] = $m[3][0];
            $m2[1][0] = $m[0][1];
            $m2[1][2] = $m[2][1];
            $m2[1][3] = $m[3][1];
            $m2[2][0] = $m[0][2];
            $m2[2][1] = $m[1][2];
            $m2[2][3] = $m[3][2];
            $m2[3][0] = $m[0][3];
            $m2[3][1] = $m[1][3];
            $m2[3][3] = $m[2][3];
            $new_matrix = new Matrix(array('preset' => Matrix::IDENTITY));
            $new_matrix->setMatrix($m2);
            $this->setTr($new_matrix);
        }
    }

    /**
     * @return mixed
     */
    public function getTr()
    {
        return $this->Tr;
    }

    /**
     * @param mixed $Tr
     */
    public function setTr($Tr)
    {
        $this->Tr = $Tr;
    }

    public function initRatio()
    {
        if ($this->getHeight() != 0)
            $this->setRatio($this->getWidth() / $this->getHeight());
        else
            $this->setRatio(0);
    }

    public function initProject()
    {
        $matrix = new Matrix(array(
            'preset' => Matrix::PROJECTION,
            'fov' => $this->getFov(),
            'ratio' => $this->getRatio(),
            'near' => $this->getNear(),
            'far' => $this->getFar()
        ));
        $this->setProject($matrix);
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->Project;
    }

    /**
     * @param mixed $Project
     */
    public function setProject($Project)
    {
        $this->Project = $Project;
    }
}