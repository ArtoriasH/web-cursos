<?php
    include "../classes/dbh.php";

    if(isset($_POST['btn-login'])){//Login
        $email = $_POST['email'];
        $password = $_POST['password'];
        $intento = $_POST['intento'];

        include "../classes/loginClass.php";
        include "../classes/loginContr.php";

        $login = new loginContr($email, $password, $intento);

        //Manejamos errores y el registro del usuario
        $login->loginUser();
        $dataLogin = $login->sessionData();
        header("location: ../index.php");
        session_start();
        $_SESSION["id"]= $dataLogin["idUser"];
        $_SESSION["nombre"]= $dataLogin["nombre"];
        $_SESSION["tipo"]= $dataLogin["rol"];
    }

    if(isset($_POST['btn-signUp'])){//Alta usuario
        $nombre = $_POST['nombre'];
        $apeP = $_POST['apeP'];
        $apeM = $_POST['apeM'];
        $genero = $_POST['genero'];
        $fNacimiento = $_POST['fNacimiento'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];
        $revisar = getimagesize($_FILES["image"]["tmp_name"]);
        if($revisar !== false){            
            $imgContenido = (file_get_contents($_FILES['image']['tmp_name']));
        }else{
            echo "Por favor seleccione imagen a subir.";
        }
        
        include "../classes/signupClass.php";
        include "../classes/signupContr.php";
        $signup = new signupContr(NULL, $password, $imgContenido, $rol, $email, $nombre, $apeP, $apeM, $fNacimiento, $genero);
        if($signup->signupUser()){
                header("location: ../login.php?result=registroExitoso");
        }else{
                header("location: ../registro.php?error=0");
        }   
    }

    if(isset($_POST['btn-updateUser'])){//Actulizar usuario
        $idUser = $_POST['idUser'];
        $nombre = $_POST['nombre'];
        $apeP = $_POST['apeP'];
        $apeM = $_POST['apeM'];
        $fNacimiento = $_POST['fNacimiento'];
        $password = $_POST['password'];
        
        include "../classes/signupClass.php";
        include "../classes/signupContr.php";

        if(!$_FILES['image']['size'] == 0){
            $imgContenido = (file_get_contents($_FILES['image']['tmp_name']));
            $actualizarUser = new signupContr($idUser, $password, $imgContenido, NULL, NULL, $nombre, $apeP, $apeM, $fNacimiento, NULL);
            $actualizarUser->updateUserContr();
        }else{
            $actualizarUser = new signupContr($idUser, $password, NULL, NULL, NULL, $nombre, $apeP, $apeM, $fNacimiento, NULL);
            $actualizarUser->updateUserContrSinImagen();
        }

        header("location: ../perfil.php?result=cambioExitoso");
    }

    if(isset($_POST['btn-disable'])){//Deshabilitar usuario
        $idUser = $_POST['idUser'];

        include "../classes/signupClass.php";
        include "../classes/signupContr.php";

        $usuario = new signupContr($idUser, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $usuario -> deleteUserContr();
        header("location: ../menuAdm.php?idUser=".$idUser);
    }

    if(isset($_POST['btn-enable'])){//Habilitar usuario
        $idUser = $_POST['idUser'];

        include "../classes/signupClass.php";
        include "../classes/signupContr.php";

        $usuario = new signupContr($idUser, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
        $usuario -> enableUserContr();
        header("location: ../menuAdm.php");
    }

    if(isset($_POST['btn-crearCurso'])){//Alta curso
        $nombre = $_POST['nombre'];
        $contenidoP = $_POST['contenidoP'];
        $contenidoAd = $_POST['contenidoAd'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $instructor = $_POST['instructor'];
        $revisar = getimagesize($_FILES["image"]["tmp_name"]);
        if($revisar !== false){            
            $imgContenido = (file_get_contents($_FILES['image']['tmp_name']));
        }else{
            echo "Por favor seleccione imagen a subir.";
        }
        
        include "../classes/insertDataClass.php";
        include "../classes/cursoContr.php";

        $crearCurso = new cursoContr($nombre, $contenidoP, $contenidoAd, $descripcion, $precio, $instructor, $imgContenido, NULL, NULL, NULL, NULL, NULL);
        $crearCurso->addCourse();

        $contadorCat = $_POST['contadorCatPHP'];
        for($i = 1; $i <= $contadorCat; $i ++){
            $categoria = $_POST['categoria'.$i];
            $darCategoria = new cursoContr(NULL, NULL, NULL, NULL, NULL, NULL, NULL, $categoria, NULL, NULL, NULL, NULL);
            $darCategoria->asignCategoryContr();
        } 

        $contadorNivel = $_POST['contadorNivel'];
        for($i = 1; $i <= $contadorNivel; $i ++){
            $nombreNivel = $_POST['nombreNivel'.$i];
            $gratuito = $_POST['gratuito'.$i];
            $video = $_FILES['video'.$i]['tmp_name'];
            $videoContenido = (file_get_contents($video));
            $agregarNivel = new cursoContr(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $nombreNivel, $gratuito, $videoContenido, NULL);
            $agregarNivel->addLevelContr();

        } 
        header("location: ../index.php?result=CursoCreado");
    }

    if(isset($_POST['btnUpdatePrice'])){//Actualizar precio de un curso
        $idCurso = $_POST['idCurso'];
        $precio = $_POST['precio'];
        
        include "../classes/insertDataClass.php";;
        include "../classes/cursoContr.php";

        $updateCurso = new cursoContr(NULL, NULL, NULL, NULL, $precio, NULL, NULL, NULL, NULL, NULL, NULL, $idCurso);
        $updateCurso->updateCourseContr();

        header("location: ../curso.php?idCourse=" . $idCurso);
    }

    if(isset($_POST['btnDeleteCourse'])){//Deshabilitar curso
        $idCurso = $_POST['idCurso'];
        
        include "../classes/insertDataClass.php";;
        include "../classes/cursoContr.php";

        $updateCurso = new cursoContr(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $idCurso);
        $updateCurso->deleteCourseContr();

        header("location: ../curso.php?result=borrado&idCourse=" . $idCurso);
    }

    if(isset($_POST['nombreCategoria'])){//Alta categoría
        $nombreCategoria = $_POST['nombreCategoria'];
        $descripcionCategoria = $_POST['descripcionCategoria'];

        include "../classes/insertDataClass.php";
        include "../classes/categoriasContr.php";

        $categorias = new categoriasContr($nombreCategoria, $descripcionCategoria);
        $categorias -> addCategoryContr();
    }

    if(isset($_POST['btnComprar'])){//Hacer compra
        $idUser = $_POST['idUser'];
        $precioOriginal = $_POST['precioOriginal'];
        
        include "../classes/insertDataClass.php";
        include "../classes/adquirirCursoContr.php";

        if(isset($_POST['idCurso'])){
            $idCurso = $_POST['idCurso'];
            $compras = new adquirirCursoContr($idUser, $precioOriginal, $idCurso, NULL, NULL, NULL, NULL);
            $compras -> addSellContr();
        }

        if(isset($_POST['idNivel'])){
            $idNivel = $_POST['idNivel'];
            $compras = new adquirirCursoContr($idUser, $precioOriginal, NULL, $idNivel, NULL, NULL, NULL);
            $compras -> addSellContr();
        }

        include "../classes/bringDataClass.php";
        $tempData = new bringDataClass();
        $dataLastPurchase = $tempData->bringLastPurchase();
    
        header("location: ../metodoPago.php?idCompra=".$dataLastPurchase["IdCompra"]);
    }

    if(isset($_POST['btn-PaymentMethod'])){//Metodo de pago
        $idCompra = $_POST['idCompra'];
        
        include "../classes/insertDataClass.php";
        include "../classes/adquirirCursoContr.php";

        $updateMethod = new adquirirCursoContr(NULL, NULL, NULL, NULL, NULL, NULL, $idCompra);
        $updateMethod -> updateMethodContr();

        header("location: ../misCursos.php");
    }

    if(isset($_POST['btnUpdateProgress'])){//Actualizar progreso
        $idUser = $_POST['idUser'];
        $idCurso = $_POST['idCurso'];
        $idNivel = $_POST['idNivel'];
        
        include "../classes/insertDataClass.php";
        include "../classes/adquirirCursoContr.php";

        $updateProgress = new adquirirCursoContr($idUser, NULL, $idCurso, $idNivel, NULL, NULL, NULL);
        $updateProgress -> updateProgressContr();

        header("location: ../curso.php?idCourse=" . $idCurso);
    }

    if(isset($_POST['btnValorar'])){//Hacer valoracion
        $idUser = $_POST['idUser'];
        $idCurso = $_POST['idCurso'];
        $comentario = $_POST['comentario'];
        $valoracion = $_POST['valoracion'];
        
        include "../classes/insertDataClass.php";
        include "../classes/adquirirCursoContr.php";

        $valorar = new adquirirCursoContr($idUser, NULL, $idCurso, NULL, $comentario, $valoracion, NULL);
        $valorar -> valorarContr();

        header("location: ../curso.php?idCourse=" . $idCurso);
    }

    if(isset($_POST['btnStartChat'])){// Empezar un chat 
        $idAlumno = $_POST['idAlumno'];
        $idMaestro = $_POST['idMaestro'];
        
        include "../classes/insertDataClass.php";
        include "../classes/chatContr.php";

        $crearChat = new chatContr($idAlumno, $idMaestro, NULL, NULL);
        $crearChat -> crearChatContr();

        include "../classes/bringDataClass.php";
        $tempData = new bringDataClass();
        $dataExistingChat = $tempData->bringExistingChat($idAlumno, $idMaestro);//Nos traemos el id del chat para ponerlo en la url

        header("location: ../chat.php?idChat=".$dataExistingChat["idChat"]);
    }

    if(isset($_POST['btnSendMessage'])){// Mandar mensaje 
        $idRemitente = $_POST['remitente'];
        $idChat = $_POST['idChat'];
        $contenidoMsg = $_POST['contenidoMsg'];
        
        include "../classes/insertDataClass.php";
        include "../classes/chatContr.php";

        $mandarMsg = new chatContr($idRemitente, NULL, $idChat, $contenidoMsg);
        $mandarMsg -> sendMsgContr();

        header("location: ../chat.php?idChat=" . $idChat);
    }

    
    if(isset($_POST["btnSearchKWord"])){//Buscar por palabra
        $kWord = $_POST['kWord'];  

        header("location: ../busqueda.php?kWord=".$kWord);
    }

    if(isset($_POST["btnDarDiploma"])){//Se le da el diploma al estudiante
        $idVenta = $_POST['idVenta'];  

        include "../classes/insertDataClass.php";
        include "../classes/adquirirCursoContr.php";

        $diploma = new adquirirCursoContr(NULL, NULL, NULL, NULL, NULL, NULL, $idVenta);
        $diploma -> getCertificateContr();
        header("location: ../cursosCreados.php");
    }
?>