<?php 

class chatContr extends insertDataClass{

    private $idAlumno;
    private $idMaestro;
    private $idChat;
    private $mensaje;
    

    public function __construct($idAlumno, $idMaestro, $idChat, $mensaje){
        $this->idAlumno = $idAlumno;
        $this->idMaestro = $idMaestro;
        $this->idChat = $idChat;
        $this->mensaje = $mensaje; 
  
    }

    public function crearChatContr(){
        $this->crearChatClass($this->idAlumno, $this->idMaestro);
    }

    public function SendMsgContr(){
        $this->SendMsgClass($this->idAlumno, $this->idChat, $this->mensaje);
    }

    
}

?>