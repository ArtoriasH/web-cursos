<?php 

class cursoContr extends insertDataClass{

    private $nombre;
    private $contenidoP;
    private $contenidoAd;
    private $descripcion;
    private $precio;
    private $instructor;
    private $imgContenido;
    private $idCategory;
    private $nombreNivel;
    private $gratuito;
    private $video;
    private $idCurso;


    public function __construct($nombre, $contenidoP, $contenidoAd, $descripcion, $precio, $instructor, $imgContenido, $idCategory, $nombreNivel, $gratuito, $video, $idCurso){
        $this->nombre = $nombre;
        $this->contenidoP = $contenidoP;
        $this->contenidoAd = $contenidoAd;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->instructor = $instructor;
        $this->imgContenido = $imgContenido;
        $this->idCategory = $idCategory;
        $this->nombreNivel = $nombreNivel;
        $this->gratuito= $gratuito;
        $this->video = $video;
        $this->idCurso = $idCurso;

    }

    public function addCourse(){
        $this->insertCourse($this->nombre, $this->contenidoP, $this->contenidoAd, $this->descripcion, $this->precio, $this->instructor, $this->imgContenido);
    }

    public function asignCategoryContr(){
        $this->asignCategoryClass($this->idCategory);
    }

    public function addLevelContr(){
        $this->addLevelClass($this->nombreNivel, $this->gratuito, $this->video);
    }

    public function updateCourseContr(){
        $this->updateCourseClass($this->idCurso, $this->precio);
    }

    public function deleteCourseContr(){
        $this->deleteCourseClass($this->idCurso);
    }
}

?>