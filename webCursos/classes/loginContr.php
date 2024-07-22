<?php 
    class loginContr extends loginClass{
        private $email;
        private $pass;
        private $intento;

        public function __construct($email, $pass, $intento){
            $this->email = $email;
            $this->pass = $pass;
            $this->intento = $intento;
        }

        public function loginUser(){
            $this->getUser($this->email, $this->pass, $this->intento);
        }

        public function sessionData(){
            $data = $this->traeData($this->email);
            return $data;
        }
    }
?>