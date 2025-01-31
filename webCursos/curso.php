<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php?login=0");
    }

    include "classes/dbh.php";
    include "classes/bringDataClass.php";

    $tempData = new bringDataClass();

    $dataCourse = $tempData->bringCourse($_GET['idCourse']);
    $dataCourseCategories = $tempData->bringCourseCategories($_GET['idCourse']);
    $dataLevels = $tempData->bringLevelsCourse($_GET['idCourse']);
    $dataReviewPermission = $tempData->bringReviewPermission($_SESSION['id'], $_GET['idCourse']);
    $dataPurchasedCourse = $tempData->purchasedCourse($_SESSION['id'], $_GET['idCourse']);
    $dataReviews = $tempData->bringReviews($_GET['idCourse']);
    $dataCourseRate = $tempData->bringCourseRate($_GET['idCourse']);
    $dataExistingChat = $tempData->bringExistingChat($_SESSION['id'], $dataCourse['instructor']);
    $dataExistingComment = $tempData->bringExistingComment($_SESSION['id'], $dataCourse['idCurso']);
   // $dataPurchasedCourseLevel = $tempData->bringPurchasedCourseLevel($_SESSION['id'], $dataCourse['idCurso']);
    $datacompletedCoursePerLevel = $tempData->bringcompletedCoursePerLevel($_SESSION['id'], $dataCourse['idCurso']);

    //print_r($datacompletedCoursePerLevel);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Metadatos -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- Titulo -->
        <title><?php echo $dataCourse["nombreCurso"]?></title>
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets/img/libro.png">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/Bootstrap-Chat.css">
        <link rel="stylesheet" href="assets/css/Bootstrap-Payment-Form-.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <!-- Styles -->
        <link rel="stylesheet" href="assets/css/Banner-Heading-Image-images.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
        <link rel="stylesheet" href="assets/css/Pretty-Search-Form-.css">
        <link rel="stylesheet" href="assets/css/Sidebar-Menu-sidebar.css">
        <link rel="stylesheet" href="assets/css/Sidebar-Menu.css">
        <!-- BDM Styles -->
        <link rel="stylesheet" href="bdmStyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    </head>
    <body>
        <!--NavBar-->
        <nav class="navbar navbar-light navbar-expand-md py-3" style="background: #c6aadb;">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                        <img src="assets/img/libro.png" width="50" alt="Logo de la pagina web">
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-toggler">                    
                    <ul class="navbar-nav">
                        <li class="nav-item" style="margin-right: 0px;margin-left: 10px;">
                            <form action="includes/actions.php" method="POST">
                            <input name="kWord" type="search" style="width: 750px;">
                            <button class="btn btn-primary" name="btnSearchKWord" type="submit" style="height: 30px;width: 38.5px;border-width: 0px;border-top-left-radius: 0px;border-top-right-radius: 20px;border-bottom-left-radius: 0px;border-bottom-right-radius: 20px;margin-top: -4px;margin-right: 0px;margin-left: -1px;background: #6d28aa;">
                                <i class="fas fa-search"></i>
                            </button>
                            </form>                            
                        </li>
                    </ul>
                    <?php 
                        if(isset($_SESSION['id'])){
                    ?>
                        <ul class="navbar-nav mx-auto"> 
                            <div class="nav-item dropdown">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <button class="btn btn-primary" type="button" style="background: #6d28aa;border: none;color: white;">
                                            <?php echo $_SESSION["nombre"]?>
                                        </button>
                                    </a>
                                </li>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="perfil.php">Editar Perfil</a>
                                    <?php
                                        if($_SESSION['tipo'] == 1){
                                            echo('<a class="dropdown-item" href="cursosCreados.php">Mis Cursos</a>');    
                                            echo('<a class="dropdown-item" href="cursosVendidos.php">Estadisticas de mis cursos</a>');                 
                                        }
                                        if($_SESSION['tipo'] == 2){
                                            echo('<a class="dropdown-item" href="misCursos.php">Mis Cursos</a>');                    
                                        }                
                                    ?>                     
                                    <a class="dropdown-item" href="mensajes.php">Mis mensajes</a> 
                                    <?php
                                        if($_SESSION['tipo'] == 1){
                                            echo('<a class="dropdown-item" href="crearCurso.php">Crear Curso</a>');                    
                                        }
                                        if($_SESSION['tipo'] == 0){
                                            echo('<a class="dropdown-item" href="menuAdm.php">Menu administrador</a> ');                    
                                        }                
                                    ?>                                                                
                                </div>
                            </div>                
                            <li class="nav-item">
                                <a class="nav-link" href="includes/logOut.php">
                                    <button class="btn btn-primary" type="button" style="background: #6d28aa;border: none;color: white;">Cerrar Sesion</button>
                                </a>
                            </li>           
                        </ul>
                    <?php
                        }
                        else{ 
                    ?>
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="login.php">
                                    <button class="btn btn-primary" type="button" style="background: rgb(255,255,255);color: rgb(0,0,0); border:none;">Iniciar Sesion</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registro.php">
                                    <button class="btn btn-primary" type="button" style="background: #6d28aa; border-color: black; color: white;">Registrate</button>
                                </a>
                            </li>            
                        </ul>
                    <?php
                        }
                    ?>           
                </div>
            </div>
        </nav>
        <!-- HERO -->
        <div class="contenedor">
            <?php
                if($dataCourse["estadoCurso"] == 1){
            ?>
                <div class="container" style="font-family: 'Abril Fatface', serif;display: block;"><!--Curso-->
                    <div class="row" style="margin-right: -140px;"><!--Datos del curso-->
                        <div class="col-md-8" style="margin-right: 0px; background: #000;"><!--Izquierda-->
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-center" style="color: #fff; font-weight: bold;">
                                        <?php echo $dataCourse["nombreCurso"]?>
                                    </h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h4 style="color: #fff;">
                                        Descripcion: <?php echo $dataCourse["descripcionCur"]?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h4 style="color: #fff;">
                                        Contenido Adicional: <?php echo $dataCourse["contenidoAd"]?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php
                                        if(!empty($dataCourseRate['rate'])){
                                            echo "<h4 style='color: #fff;'>Calificación: ". $dataCourseRate['rate']."</h4>";
                                        }
                                        else{
                                            echo "<h4 style='color: #fff;'>Este curso aún no ha recibido reviews</h4>";
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h4 style="color: #fff;">
                                        Instructor: <?php echo $dataCourse["nombre"] ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                        <h4 style="color: #fff;">
                                            Categoría(s): <?php foreach($dataCourseCategories as $rowsCourseCategories){
                                                echo "<a href='categoria.php?idCategory=".$rowsCourseCategories['idCategoria']."' style='text-decoration:none; color:#d0b1e6'>".$rowsCourseCategories['nombreCat']."</a> ";
                                                }?>
                                        </h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="background: #efefef; width:350px;"><!--Derecha-->
                            <div class="row">
                                <div class="col text-center">
                                    <img src="data:image/jpeg/png;base64,<?php echo base64_encode($dataCourse['imagen'])?>" width="250" height="250">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="background: #e4dbeb;">
                                    <h3 class="text-center">Precio: $<?php echo $dataCourse["precio"]?> MXN</h3>
                                </div>
                            </div>
                            <?php 
                                if($dataCourse['instructor'] == $_SESSION['id']){
                            ?>
                                <div class="row">
                                    <form action="includes/actions.php" method="POST">
                                        <input type="hidden" name="idCurso" value="<?php echo $dataCourse['idCurso']?>">
                                        <div class="row" style="display: flex; flex-direction: row; justify-content: center; padding:2px;">
                                            <input type="number" name="precio" min="0" style="width: 25%; height:50% ;margin-right:1%;" placeholder="Precio">
                                            <button class="btn btn-primary d-xl-flex" name="btnUpdatePrice" type="submit" style="width:37%; height:50%;background:#6d28aa; border:none; color:white; text-align:center; margin-right:1%;">
                                                Cambiar precio
                                            </button>
                                            <button class="btn btn-primary d-xl-flex" name="btnDeleteCourse" type="submit" style="width:31%; height:50%;background:#730826; border:none; color:white; text-align:center;">
                                                Borrar curso
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <?php
                                }
                                else{
                                    if(empty($dataPurchasedCourse) && empty($datacompletedCoursePerLevel)){
                                        if($dataCourse['contenidoP'] == 1 && $_SESSION["tipo"]==2){
                            ?>
                                        <div class="row d-xl-flex">
                                            <div class="col" style="display: flex; justify-content: center; padding:1%;">
                                                <a class="d-xxl-flex justify-content-xxl-center" href="<?php echo 'resumenCompra.php?idCourse='.$dataCourse['idCurso']?>" style="text-decoration: none;">
                                                    <button class="btn btn-primary d-xl-flex" type="button" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                                        Comprar
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                            <?php 
                                        }                                      
                                    }
                                else{
                                    if(empty($dataExistingChat)){
                            ?>
                                    <div class="col" style="display: flex; justify-content: center; padding:1%;">
                                        <form action="includes/actions.php" method="POST">
                                            <input type="hidden" name="idAlumno" value="<?php echo $_SESSION['id']?>">
                                            <input type="hidden" name="idMaestro" value="<?php echo $dataCourse['instructor']?>">
                                            <button class="btn btn-primary d-xl-flex" name="btnStartChat" type="submit" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                                Iniciar Chat
                                            </button>
                                        </form>
                                    </div>
                            <?php
                                    }else{
                            ?>
                                    <div class="col" style="display: flex; justify-content: center; padding:1%;">
                                        <a class="d-xxl-flex justify-content-xxl-center" href="<?php echo 'chat.php?idChat='.$dataExistingChat['idChat']?>" style="text-decoration: none;">
                                            <button class="btn btn-primary d-xl-flex" type="button" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                                Ir al chat
                                            </button>
                                        </a>
                                    </div>
                            <?php
                                    }
                                } 
                            }                
                            ?>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="display:flex; flex-direction: row"><!--Niveles del curso-->
                        <?php
                            $contadorNiveles = 0;
                            foreach($dataLevels as $rowsLevels){
                                $dataPurchasedLevel = $tempData->purchasedLevel($_SESSION['id'], $rowsLevels['idNivel']);
                                $contadorNiveles++; 
                        ?>
                                <div class="col-lg-8" style="border: solid 1px #c6aadb; border-radius: 5px; margin: 0.5% 0%; width: 100%; display: inline-block;">
                                    <?php
                                        if(empty($dataPurchasedCourse) || empty($dataPurchasedLevel)){
                                            if(!empty($dataPurchasedCourse)){?>
                                                <a href="<?php echo 'nivel.php?idNivel='.$rowsLevels['idNivel']?>" style="color: #5d1b8f; text-decoration:none; font-size:40px;">
                                                    <h3><?php echo $contadorNiveles. ". ".$rowsLevels['nombreNiv']?></h3>
                                                </a><?php
                                            }
                                            elseif(!empty($dataPurchasedLevel)){?>
                                                <a href="<?php echo 'nivel.php?idNivel='.$rowsLevels['idNivel']?>" style="color: #5d1b8f; text-decoration:none; font-size:40px;">
                                                    <h3><?php echo $contadorNiveles. ". ".$rowsLevels['nombreNiv']?></h3>
                                                </a><?php
                                            }else{
                                            echo "<h3>". $contadorNiveles. ". ".$rowsLevels['nombreNiv']."</h3>";
                                            }
                                        }
                                    ?>
                                </div>
                        <?php 
                                if($dataCourse['contenidoP'] == 0){
                                    if(empty($dataPurchasedLevel) && $_SESSION['tipo'] == 2){
                        ?>
                                        <div class="col-lg-8" style="width: 50%">                 
                                            <a href="<?php echo 'resumenCompra.php?idNivel='.$rowsLevels['idNivel']?>" style="color:#fff; text-align:center; text-decoration:none; ">
                                                <button class="btn btn-primary d-xl-flex" type="button" style="background:#6d28aa; border:none; border-radius:5px; height:35px;">
                                                    Comprar nivel
                                                </button>
                                            </a>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        ?>
                    </div> 
                </div>
                <div style="margin:1% 3%;"><!--Comentarios-->
                    <?php
                        if(!empty($dataReviews)){
                            echo "<h2>Comentarios</h2>";
                            foreach($dataReviews as $rowsReviews){
                    ?>
                            <div class="gray-container-wth-rows">
                                <div style="display:flex; width: 100%;">
                                    <p style="margin-right: 1%; font-weight: bold;"><?php echo $rowsReviews['nombre']?></p>
                                    <p style="font-size: 10px;"><?php echo $rowsReviews['fechaValor']?></p>
                                </div>
                                <p style="font-style: italic;"><?php echo $rowsReviews['comentario']?></p>
                                <p>Valoracion: <?php echo $rowsReviews['valoracion']?></p>
                            </div>
                    <?php
                            }
                        }
                    ?>
                </div>
                <div style="margin:1% 3%;"><!--Comentar-->
                    <?php
                    //if(!empty($dataPurchasedCourse) || !empty($datacompletedCoursePerLevel)){
                        if($_SESSION['tipo'] == 2  && empty($dataExistingComment)){         
                            if(!empty($dataReviewPermission)){            
                            if($dataReviewPermission['estadoCompleto'] == 1){
                    ?>
                            <h2>Deja tu comentario</h2>
                            <form action="includes/actions.php" method="POST">
                                <div style="display: flex; flex-direction: column">
                                    <textarea name="comentario" rows="5" cols="100" placeholder="Deja tu comentario"></textarea>
                                    <div>
                                        <label for="html">Valoración del 1 al 10:</label>
                                        <input type="number" name="valoracion" max="10" min="1">
                                    </div>
                                </div>
                                <input type="hidden" name="idUser" value="<?php echo $_SESSION['id']?>">
                                <input type="hidden" name="idCurso" value="<?php echo $dataCourse['idCurso']?>">
                                <button class="btn btn-primary d-xl-flex" name="btnValorar" type="submit" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                    Enviar
                                </button>
                            </form>
                    <?php
                            }
                        }
                        if(!empty($datacompletedCoursePerLevel)){            
                            if($datacompletedCoursePerLevel['estadoCompleto'] == 1){
                    ?>
                            <h2>Deja tu comentario</h2>
                            <form action="includes/actions.php" method="POST">
                                <div style="display: flex; flex-direction: column">
                                    <textarea name="comentario" rows="5" cols="100" placeholder="Deja tu comentario"></textarea>
                                    <div>
                                        <label for="html">Valoración del 1 al 10:</label>
                                        <input type="number" name="valoracion" max="10" min="1">
                                    </div>
                                </div>
                                <input type="hidden" name="idUser" value="<?php echo $_SESSION['id']?>">
                                <input type="hidden" name="idCurso" value="<?php echo $dataCourse['idCurso']?>">
                                <button class="btn btn-primary d-xl-flex" name="btnValorar" type="submit" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                    Enviar
                                </button>
                            </form>
                    <?php
                            }
                        }
                        }
                    //}
                    ?>
                </div>
            <?php
                }else{
                    echo"Este curso fue borrado";
                }
            ?> 
        </div>
            
        <!-- Footer -->
        <footer class="text-center bg-dark footer" style="margin-top:150px">
            <div class="container text-muted py-4 py-lg-5">
                <ul class="list-inline">
                    <li class="list-inline-item me-4"><a class="link-secondary" href="#">Web design</a></li>
                    <li class="list-inline-item me-4"><a class="link-secondary" href="#">Development</a></li>
                    <li class="list-inline-item"><a class="link-secondary" href="#">Hosting</a></li>
                </ul>
                <ul class="list-inline">
                    <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-facebook">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
                        </svg></li>
                    <li class="list-inline-item me-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-twitter">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
                        </svg></li>
                    <li class="list-inline-item"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-instagram">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
                        </svg></li>
                </ul>
                <p class="mb-0">Copyright © 2023 Brand</p>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/Sidebar-Menu-sidebar.js"></script>
    </body>
</html>