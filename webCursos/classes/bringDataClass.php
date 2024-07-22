<?php
class bringDataClass extends Dbh{
    public function bringUser($idUser){//Consulta usuario
        $stmt = $this->connect()->prepare('CALL sp_user( 4, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringCategories(){//Consulta de todas las categorias
        $stmt = $this->connect()->prepare('CALL sp_categoria(1, NULL, NULL, NULL, NULL)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringCategory($idCat){//Consulta una sola categoria
        $stmt = $this->connect()->prepare('CALL sp_categoria(2, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idCat));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringSingleCategory($idCat){//Consulta de los cursos de una sola categoria
        $stmt = $this->connect()->prepare('CALL sp_categoria(3, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idCat));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringCourseCategories($idCourse){//Consulta las categorías de un curso
        $stmt = $this->connect()->prepare('CALL sp_categoria(4, NULL, NULL, NULL, ?)');
        $stmt->execute(array($idCourse));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringCourse($idCourse){//Consulta un curso
        $stmt = $this->connect()->prepare('CALL sp_curso(1, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringLevelsCourse($idCourse){//Consulta niveles de curso
        $stmt = $this->connect()->prepare('CALL sp_curso(4, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCourse));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringLevel($idNivel){//Consulta del nivel
        $stmt = $this->connect()->prepare('CALL sp_curso(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ?, NULL)');
        $stmt->execute(array($idNivel));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringCourseRate($idCourse){//Consulta la valoracion de un curso
        $stmt = $this->connect()->prepare('CALL sp_curso(7, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringUsers(){//Consulta usuarios
        $stmt = $this->connect()->prepare('CALL sp_user( 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringAllInstructorCourses($idUser){//Consulta usuarios
        $stmt = $this->connect()->prepare('CALL sp_user( 8, ?, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringMostRecent(){//consultar los cursos mas recientes
        $stmt = $this->connect()->prepare('CALL sp_home(0)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringBestSelling(){//consultar los cursos mas vendidos
        $stmt = $this->connect()->prepare('CALL sp_home(1)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function bringBestRated(){//consultar los cursos mejor calificados
        $stmt = $this->connect()->prepare('CALL sp_home(2)');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringStudentCourses($idUser){//Consulta cursos del estudiante
        $stmt = $this->connect()->prepare('CALL SP_cursosAlumno(0, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringStudentCompleteCourses($idUser){//Consulta cursos completos del estudiante
        $stmt = $this->connect()->prepare('CALL SP_cursosAlumno(1, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringStudentActiveCourses($idUser){//Consulta cursos activos del estudiante
        $stmt = $this->connect()->prepare('CALL SP_cursosAlumno(4, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringStudentCoursesDate($idUser, $dateFrom, $dateTo){//Consulta cursos del estudiante en base a una fecha
        $stmt = $this->connect()->prepare('CALL SP_cursosAlumno(2, ?, NULL, ?, ?)');
        $stmt->execute(array($idUser, $dateFrom, $dateTo));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringStudentCoursesCategory($idUser, $idCat){//Consulta cursos del estudiante en base a una categoria
        $stmt = $this->connect()->prepare('CALL SP_cursosAlumno(3, ?, ?, NULL, NULL)');
        $stmt->execute(array($idUser, $idCat));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringLastPurchase(){//Consulta si el curso esta completo
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array());
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringReviewPermission($idUser, $idCourse){//Consulta si el curso esta completo
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(2, ?, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function purchasedCourse($idUser, $idCourse){//Consulta si el curso esta comprado
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(4, ?, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function purchasedLevel($idUser, $idLevel){//Consulta si el nivel esta comprado
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(7, ?, NULL, NULL, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idLevel));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    public function bringcompletedCoursePerLevel($idUser, $idCourse){//Consulta si el curso comprado nivel por nivel esta completo
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(12, ?, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } 

    /*
    public function bringPurchasedCourseLevel($idUser, $idCourse){//Consulta si un curso/niveles ya esta comprado para comentar
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(11, ?, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } */

    public function bringReviews($idCourse){//Consulta los comentarios del curso
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(5, NULL, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCourse));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringExistingComment($idUser, $idCourse){//Consulta si un usuario ya comento
        $stmt = $this->connect()->prepare('CALL sp_adquirirCurso(10, ?, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser, $idCourse));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function bringExistingChat($idAlumno, $idMaestro){//Consulta si el chat entre 2 usuarios ya existe
        $stmt = $this->connect()->prepare('CALL sp_chat(5, ?, ?, NULL, NULL)');
        $stmt->execute(array($idAlumno, $idMaestro));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringChats($idUser){//Consulta los chats disponibles
        $stmt = $this->connect()->prepare('CALL sp_chat(3, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringMessages($idChat){//Consulta los mensajes de un chat
        $stmt = $this->connect()->prepare('CALL sp_chat(1, NULL, NULL, ?, NULL)');
        $stmt->execute(array($idChat));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringChat($idChat){//Consulta de los datos de un chat
        $stmt = $this->connect()->prepare('CALL sp_chat(4, NULL, NULL, ?, NULL)');
        $stmt->execute(array($idChat));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringSearch($kWord){//Busqueda por palabra, nombreInstructor y categoria
        $stmt = $this->connect()->prepare('CALL sp_search(0, ?, NULL, NULL)');
        $stmt->execute(array($kWord));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringSearchDateFilters($kWord, $dateFrom, $dateTo){//Busqueda por palabra, nombreInstructor, categoria y fecha
        $stmt = $this->connect()->prepare('CALL sp_search(1, ?, ?, ?)');
        $stmt->execute(array($kWord, $dateFrom, $dateTo));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringSoldCourses($idUser){// Traer datos del curso y cuantas personas lo cursan
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(0, ?, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringSoldActiveCourses($idUser){// Traer datos del curso y cuantas personas lo cursan ACTIVOS
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(1, ?, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringSoldCoursesDate($idUser, $dateFrom, $dateTo){// Traer datos del curso y cuantas personas lo cursan FECHA
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(2, ?, NULL, NULL, ?, ?, NULL)');
        $stmt->execute(array($idUser, $dateFrom, $dateTo));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function bringAvgLevel($idCurso){// Traer el nivel mas cursado de un curso
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(4, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCurso));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringCourseProfit($idCurso){// Traer el total de ganancia de un curso
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(5, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCurso));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringLevelProfit($idCurso){// Traer el total de ganancia de un curso de niveles
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(6, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCurso));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bringTotalProfitC($idUser){// Traer el total de ganancia Curso
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(7, ?, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringTotalProfitN($idUser){// Traer el total de ganancia Nivel
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(8, ?, NULL, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idUser));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringCourseStudents($idCurso){// Traer todos los alumnos de un curso
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(9, NULL, ?, NULL, NULL, NULL, NULL)');
        $stmt->execute(array($idCurso));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function bringOriginalLvlPrice($idAlumno, $idNivel){//Traer el precio original en el que se compró un nivel
        $stmt = $this->connect()->prepare('CALL sp_instructorCursos(10, ?, NULL, ?, NULL, NULL, NULL)');
        $stmt->execute(array($idAlumno, $idNivel));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    

    

    
}

?>