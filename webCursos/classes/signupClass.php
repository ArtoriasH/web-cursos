<?php

class signupClass extends Dbh{

    protected function setUser($pass, $rol, $imgContenido,$email, $nombre, $apeP, $apeM, $fechaN, $sex){
        $new_user = $this->connect()->prepare('CALL sp_user(0, NULL, :pass, :rol, :email, :imgContenido, :nombre, :apeP, :apeM, :fechaN, :sex, NULL)');
        $new_user->bindParam(':pass', $pass, PDO::PARAM_STR);
        $new_user->bindParam(':rol', $rol, PDO::PARAM_INT);
        $new_user->bindParam(':email', $email, PDO::PARAM_STR);
        $new_user->bindParam(':imgContenido', $imgContenido, PDO::PARAM_LOB);
        $new_user->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $new_user->bindParam(':apeP', $apeP, PDO::PARAM_STR);
        $new_user->bindParam(':apeM', $apeM, PDO::PARAM_STR);
        $new_user->bindParam(':fechaN', $fechaN, PDO::PARAM_STR);
        $new_user->bindParam(':sex', $sex, PDO::PARAM_INT);
        $new_user->execute();
    }

    protected function checkUser($email){
        $stmt = $this->connect()->prepare('SELECT idUser FROM Usuarios WHERE email = ?;');

        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: ../registrar.php?error=stmtfailed");
            return true;
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function updateUser($idUser, $pass, $imgContenido, $nombre, $apeP, $apeM, $fechaN){
        $update_user = $this->connect()->prepare('CALL sp_user(1, :idUser, :pass, NULL, NULL, :imgContenido, :nombre, :apeP, :apeM, :fechaN, NULL, NULL)');
        $update_user->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $update_user->bindParam(':pass', $pass, PDO::PARAM_STR);        
        $update_user->bindParam(':imgContenido', $imgContenido, PDO::PARAM_LOB);
        $update_user->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $update_user->bindParam(':apeP', $apeP, PDO::PARAM_STR);
        $update_user->bindParam(':apeM', $apeM, PDO::PARAM_STR);
        $update_user->bindParam(':fechaN', $fechaN, PDO::PARAM_STR);       
        $update_user->execute();
    }



    protected function updateUserSinImagen($idUser, $pass, $nombre, $apeP, $apeM, $fechaN){
        $update_user = $this->connect()->prepare('CALL sp_user(2, :idUser, :pass, NULL, NULL, NULL, :nombre, :apeP, :apeM, :fechaN, NULL, NULL)');
        $update_user->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $update_user->bindParam(':pass', $pass, PDO::PARAM_STR);        
        $update_user->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $update_user->bindParam(':apeP', $apeP, PDO::PARAM_STR);
        $update_user->bindParam(':apeM', $apeM, PDO::PARAM_STR);
        $update_user->bindParam(':fechaN', $fechaN, PDO::PARAM_STR);       
        $update_user->execute();
    }

    protected function deleteUserClass($idUser){
        $update_user = $this->connect()->prepare('CALL sp_user(3, :idUser, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $update_user->bindParam(':idUser', $idUser, PDO::PARAM_INT);             
        $update_user->execute();
    }

    protected function enableUserClass($idUser){
        $update_user = $this->connect()->prepare('CALL sp_user(7, :idUser, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $update_user->bindParam(':idUser', $idUser, PDO::PARAM_INT);             
        $update_user->execute();
    }

}
?>