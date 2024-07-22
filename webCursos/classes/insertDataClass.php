<?php

class insertDataClass extends Dbh{ 
    protected function insertCourse($nombre, $contenidoP, $contenidoAd, $descripcion, $precio, $instructor, $imgContenido){
        $stmt = $this->connect()->prepare('CALL sp_curso(0, NULL, :nombre, :contenidoP, :contenidoAd, :imgContenido, :descripcion, NULL, :precio, :instructor, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':contenidoP', $contenidoP, PDO::PARAM_INT);        
        $stmt->bindParam(':contenidoAd', $contenidoAd, PDO::PARAM_STR);
        $stmt->bindParam(':imgContenido', $imgContenido, PDO::PARAM_LOB);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
        $stmt->bindParam(':instructor', $instructor, PDO::PARAM_INT);       
        $stmt->execute();
    }

    protected function addCategoryClass($nombreCat, $descripcionCat){//Alta categoria
        $stmt = $this->connect()->prepare('CALL sp_categoria(0, NULL, :nombreCat, :descripcionCat, NULL)');
        $stmt->bindParam(':nombreCat', $nombreCat, PDO::PARAM_STR); 
        $stmt->bindParam(':descripcionCat', $descripcionCat, PDO::PARAM_STR);
        $stmt->execute();
    }

    protected function asignCategoryClass($idCategory){//Dar categoría(s) a un curso
        $stmt = $this->connect()->prepare('CALL sp_curso(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, :idCategory, NULL, NULL, NULL, NULL, NULL)');
        $stmt->bindParam(':idCategory', $idCategory, PDO::PARAM_INT);
        $stmt->execute();
    }

    protected function addLevelClass($nombreNivel, $gratuito, $video){//Dar nivel(es) a un curso
        $stmt = $this->connect()->prepare('CALL sp_curso(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, :nombreNiv, :gratuito, :video, NULL, NULL)');
        $stmt->bindParam(':nombreNiv', $nombreNivel, PDO::PARAM_STR);
        $stmt->bindParam(':gratuito', $gratuito, PDO::PARAM_INT);
        $stmt->bindParam(':video', $video, PDO::PARAM_LOB);
        $stmt->execute();
    }

    protected function updateCourseClass($idCurso, $precio){//Actualizar precio de un curso
        $stmt = $this->connect()->prepare('CALL sp_curso(8, :idCurso, NULL, NULL, NULL, NULL, NULL, NULL, :precio, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
        $stmt->execute();
    }

    protected function deleteCourseClass($idCurso){//Deshabilitar curso
        $stmt = $this->connect()->prepare('CALL sp_curso(9, :idCurso, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $stmt->execute();
    }

    protected function addSellClass($idUser, $precioOriginal, $idCurso, $idNivel){
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(0, :idUser, :precioOriginal, :idCurso, :idNivel, NULL, NULL, NULL)');
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':precioOriginal', $precioOriginal, PDO::PARAM_INT);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);  
        $stmt->bindParam(':idNivel', $idNivel, PDO::PARAM_INT);      
        $stmt->execute();
    }

    protected function updateProgressClass($idUser, $idCurso, $idNivel){
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(1, :idUser, NULL, :idCurso, :idNivel, NULL, NULL, NULL)');
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);  
        $stmt->bindParam(':idNivel', $idNivel, PDO::PARAM_INT);      
        $stmt->execute();
    }

    protected function valorarClass($idUser, $idCurso, $comentario, $valoracion){
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(3, :idUser, NULL, :idCurso, NULL, :comentario, :valoracion, NULL)');
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);  
        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);   
        $stmt->bindParam(':valoracion', $valoracion, PDO::PARAM_INT);    
        $stmt->execute();
    }

    
    protected function crearChatClass($idAlumno, $idMaestro){
        $stmt = $this->connect()->prepare('CALL sp_chat(0, :idAlumno, :idMaestro, NULL, NULL)');
        $stmt->bindParam(':idAlumno', $idAlumno, PDO::PARAM_INT);
        $stmt->bindParam(':idMaestro', $idMaestro, PDO::PARAM_INT);   
        $stmt->execute();
    }

    protected function sendMsgClass($idRemitente, $idChat, $mensaje){
        $stmt = $this->connect()->prepare('CALL sp_chat(2, :idRemitente, NULL, :idChat, :mensaje)');
        $stmt->bindParam(':idRemitente', $idRemitente, PDO::PARAM_INT);
        $stmt->bindParam(':idChat', $idChat, PDO::PARAM_INT);  
        $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_LOB);  
        $stmt->execute();
    }

    protected function getCertificateClass($idVenta){
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(6, NULL, NULL, NULL, NULL, NULL, NULL, :idVenta)');
        $stmt->bindParam(':idVenta', $idVenta, PDO::PARAM_INT);
        $stmt->execute();
    }

    protected function updateMethodClass($idVenta){
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(9, NULL, NULL, NULL, NULL, NULL, NULL, :idVenta)');
        $stmt->bindParam(':idVenta', $idVenta, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>