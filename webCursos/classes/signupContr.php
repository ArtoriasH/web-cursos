<?php
class signupContr extends signupClass{
    private $idUsuario;
    private $email;
    private $pass;
    private $imgContenido;
    private $nombre;
    private $apeP;
    private $apeM;
    private $fechaN;
    private $sex;
    private $rol;

    public function __construct($idUsuario, $pass, $imgContenido, $rol, $email, $nombre, $apeP, $apeM, $fechaN, $sex){
        $this->idUsuario = $idUsuario;
        $this->email = $email;
        $this->pass = $pass;
        $this->imgContenido = $imgContenido;
        $this->nombre =$nombre;
        $this->apeP = $apeP;
        $this->apeM = $apeM;
        $this->fechaN = $fechaN;
        $this->sex = $sex;
        $this->rol = $rol;
    }

    public function signupUser(){
        if($this->userTakenCheck() == false){
            return false;
            exit();
        }
        $this->setUser($this->pass, $this->rol, $this->imgContenido, $this->email, $this->nombre, $this->apeP, $this->apeM, $this->fechaN, $this->sex);
        return true;
    }

    private function userTakenCheck(){
        $result;
        if(!$this->checkUser($this->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function updateUserContr(){
        $this->updateUser($this->idUsuario, $this->pass, $this->imgContenido, $this->nombre, 
            $this->apeP, $this->apeM, $this->fechaN);
    }

    public function updateUserContrSinImagen(){
        $this->updateUserSinImagen($this->idUsuario, $this->pass, $this->nombre, 
            $this->apeP, $this->apeM, $this->fechaN);
    }

    public function deleteUserContr(){
        $this->deleteUserClass($this->idUsuario);
    }

    public function enableUserContr(){
        $this->enableUserClass($this->idUsuario);
    }
}

?>