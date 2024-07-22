<?php
    class loginClass extends Dbh{
        protected function getUser($email, $pass, $intento){
            $stmt = $this->connect()->prepare('CALL SP_LOGIN(0, NULL, ?, NULL)');
            if(!$stmt->execute(array($email))){
                $stmt = null;
                header("location: ../LogIn.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../LogIn.php?error=usuarioNoExiste");
                exit();
            }

            $pwd = $stmt->fetch(PDO::FETCH_ASSOC);
            $checkPwd = strcmp($pass, $pwd["contra"]);

            if ($intento < 3){
                if($checkPwd != 0){
                    $stmt = null;
                    header("location: ../LogIn.php?error=incorrectPassword&intento=".$intento);
                    exit();
                }
                elseif($checkPwd == true){
                    $stmt = $this->connect()->prepare('CALL SP_LOGIN(1, NULL, ?, ?)');
                    if(!$stmt->execute(array($email, $pass))){
                        $stmt = null;
                        header("location: ../LogIn.php?error=stmtfailed");
                        exit();
                    }
                    if($stmt->rowCount() == 0){
                        $stmt = null;
                        header("location: ../LogIn.php?error=failedlogin");
                        exit();
                    }
                }
            }else{
                $stmt = $this->connect()->prepare('CALL sp_user(6, NULL, NULL, NULL, :email, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);   
                $stmt->execute();
                header("location: ../Login.php?intento=3");
                exit();
            }
        $stmt = null;
        }

        public function traeData($email){
            $stmt = $this->connect()->prepare('CALL SP_LOGIN(2, NULL, ?, NULL)');
            $stmt->execute(array($email));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }
?>