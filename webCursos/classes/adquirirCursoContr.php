<?php 

class adquirirCursoContr extends insertDataClass{

    private $idUser;
    private $precioOriginal;
    private $idCurso;
    private $idNivel;
    private $comentario;
    private $valoracion;
    private $idVenta;

    public function __construct($idUser, $precioOriginal, $idCurso, $idNivel, $comentario, $valoracion, $idVenta){
        $this->idUser = $idUser;
        $this->precioOriginal = $precioOriginal;
        $this->idCurso = $idCurso;
        $this->idNivel = $idNivel; 
        $this->comentario = $comentario; 
        $this->valoracion = $valoracion;     
        $this->idVenta = $idVenta;  
    }

    public function addSellContr(){
        $this->addSellClass($this->idUser, $this->precioOriginal, $this->idCurso,$this->idNivel);
    }

    public function updateProgressContr(){
        $this->updateProgressClass($this->idUser, $this->idCurso,$this->idNivel);
    }

    public function valorarContr(){
        $this->valorarClass($this->idUser, $this->idCurso, $this->comentario, $this->valoracion );
    }

    public function getCertificateContr(){
        $this->getCertificateClass($this->idVenta);
    }

    public function updateMethodContr(){
        $this->updateMethodClass($this->idVenta);
    }
}

?>