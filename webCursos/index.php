<?php
    session_start();
    include "classes/dbh.php";
    include "classes/bringDataClass.php";

    $tempData = new bringDataClass();

    $dataCategory = $tempData->bringCategories(); 
    $dataMostRecent = $tempData->bringMostRecent();
    $dataBestSelling = $tempData->bringBestSelling();
    $dataBestRated = $tempData->bringBestRated();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <!-- Metadatos -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- Titulo -->
        <title>BDM | Cursos Online</title>
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
                                    <button class="btn btn-primary" type="button" style="background:#fff; color:#000; border:none;">Iniciar Sesion</button>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="registro.php">
                                    <button class="btn btn-primary" type="button" style="background:#6d28aa; border:none; color:white;">Registrate</button>
                                </a>
                            </li>            
                        </ul>
                    <?php
                        }
                    ?>           
                </div>
            </div>
        </nav>

        <div class="contenedor">
            <!-- Banner -->
            <div>
                <section class="py-4 py-xl-5">
                    <div class="container">
                        <div class="bg-dark border rounded border-0 border-dark overflow-hidden" style="background: rgb(255,255,255);">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="text-white p-4 p-md-5">
                                        <h2 class="fw-bold text-white mb-3">Aprendizaje que se adapta a tu vida</h2>
                                        <li class="mb-4">Desarrolla tus habilidades, con los cursos que se presentan en la plataforma. </li>
                                        <li class="mb-4">Aprende a tu ritmo. </li>
                                        <li class="mb-4">Empieza a vivir la experiencia. </li>
                                    </div>
                                </div>
                                <div class="col-md-6 order-first order-md-last" style="min-height: 250px;"><img class="w-100 h-100 fit-cover" src="assets/img/cursosonline.jpeg"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div>
                <div class="container">
                    <div><!--Más recientes-->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="text-align: center;">Cursos mas recientes</h1>
                            </div>
                        </div>
                        <div class="row" style="display:flex; flex-wrap:wrap; justify-content:space-evenly;">  
                            <?php         
                                foreach($dataMostRecent as $rowMostRecent){          
                            ?>
                                <div style="height:15%; width:15%; background-color:#f2f2f2; margin:1%; padding:1%; border-radius:5px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
                                    <a href="curso.php?idCourse=<?php echo($rowMostRecent["idCurso"])?>">
                                        <img src="data:image/jpeg/png;base64,<?php echo base64_encode($rowMostRecent['imagen'])?>" style="height:150px; width:150px; border-radius:5px;">
                                    </a>
                                    <div class="card-body">
                                        <a href="curso.php?idCourse=<?php echo($rowMostRecent["idCurso"])?>" style="text-decoration:none; font-weight:bold; color:#5d1b8f">
                                            <p class="card-title" style="font-size: 20px;"><?php echo($rowMostRecent["nombreCurso"])?></p>
                                        </a>       
                                    </div>
                                </div>
                            <?php
                                }          
                            ?>                 
                        </div>
                    </div>
                    <div><!--Mejor calificados-->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="text-align: center;">Cursos mejor calificados</h1>
                            </div>
                        </div>
                        <div class="row" style="display:flex; flex-wrap:wrap; justify-content:space-evenly;">  
                            <?php         
                                foreach($dataBestRated as $rowBestRated){          
                            ?>
                                <div style="height:15%; width:15%; background-color:#f2f2f2; margin:1%; padding:1%; border-radius:5px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
                                    <a href="curso.php?idCourse=<?php echo($rowBestRated["idCurso"])?>">
                                        <img src="data:image/jpeg/png;base64, <?php echo base64_encode($rowBestRated['imagen'])?>" style="height:150px; width:150px; border-radius:5px;">
                                    </a>
                                    <div class="card-body">
                                        <a href="curso.php?idCourse=<?php echo($rowBestRated["idCurso"])?>" style="text-decoration:none; font-weight:bold; color:#5d1b8f">
                                            <p class="card-title" style="font-size: 20px;"><?php echo($rowBestRated["nombreCurso"])?></p>
                                        </a>
                                    </div>
                                </div>
                            <?php
                                }          
                            ?>                 
                        </div>
                    </div>
                    <div><!--Más vendidos-->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="text-align: center;">Cursos mas vendidos</h1>
                            </div>
                        </div>
                        <div class="row" style="display:flex; flex-wrap:wrap; justify-content:space-evenly;">  
                            <?php         
                                foreach($dataBestSelling as $rowBestSelling){          
                            ?>
                                <div style="height:15%; width:15%; background-color:#f2f2f2; margin:1%; padding:1%; border-radius:5px; display:flex; flex-direction:column; justify-content:center; align-items:center;">
                                    <a href="curso.php?idCourse=<?php echo($rowBestSelling["idCurso"])?>">
                                        <img src="data:image/jpeg/png;base64,<?php echo base64_encode($rowBestSelling['imagen'])?>" style="height:150px; width:150px; border-radius:5px;">
                                    </a>
                                    <div class="card-body">
                                        <a href="curso.php?idCourse=<?php echo($rowBestSelling["idCurso"])?>" style="text-decoration:none; font-weight:bold; color:#5d1b8f">
                                            <p class="card-title" style="font-size: 20px;"><?php echo($rowBestSelling["nombreCurso"])?></p>
                                        </a>
                                    </div>
                                </div>
                            <?php
                                }          
                            ?>                 
                        </div>
                    </div>
                    <div><!--Categorías-->
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="text-align: center;">Categorías</h1>
                            </div>
                        </div>
                        <div class="row mt-4">  
                            <?php 
                                foreach($dataCategory as $rowCategory){          
                            ?>
                                <div id="toytiste" class="card" style="display:flex; align-items:center; justify-content:center; border-radius:5px; margin-bottom: 1%;">
                                    <a href="categoria.php?idCategory=<?php echo($rowCategory["idCategoria"])?>" style='text-decoration: none;font-weight: bold;color: #5d1b8f'>
                                        <h5 class="card-title"><?php echo($rowCategory["nombreCat"])?></h5>
                                    </a>
                                </div>
                            <?php
                                }          
                            ?>                 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center bg-dark footer" style="margin-top: 1%">
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