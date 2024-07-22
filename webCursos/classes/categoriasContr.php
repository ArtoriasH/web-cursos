<?php 

class categoriasContr extends insertDataClass{

    private $nombreCat;
    private $descripcionCat;


    public function __construct($nombreCat, $descripcionCat){
        $this->nombreCat = $nombreCat;
        $this->descripcionCat = $descripcionCat;

    }

    public function addCategoryContr(){
        $this->addCategoryClass($this->nombreCat, $this->descripcionCat);
    }    
}

?>