<script>
    function showPassFunction() {
        var x = document.getElementById("passInput");
        if (x.type === "password"){
            x.type = "text";
        }else{
            x.type = "password";
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Metadatos -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <!-- Titulo -->
        <title>Login</title>
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
        <section class="py-4 py-xl-5">
            <div class="container">
                <?php
                    if(isset($_GET["login"])){
                ?>
                    <div class="row mb-5">
                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                            <h3 style="color: #bf0000;">Primero debes de iniciar sesión</h3>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2 style="color: #000000;">Inicia sesión en tu cuenta</h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4" style="display: flex; justify-content: center;">
                        <div class="card mb-5">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background-color: #5d1b8f">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                    </svg>
                                </div>
                                <form class="needs-validation" data-disable-loader="true" method="post" action="includes/actions.php" novalidate>
                                    <?php 
                                        if(isset($_GET['intento'])){
                                            $intento = (int)$_GET['intento'] + 1;
                                            echo "<input name='intento' type='hidden' value='". $intento ."'>";
                                            if($_GET['intento'] == 3){
                                                echo "<p style='color: #bf0000;text-align: center;'>Cuenta desactivada</p>";
                                            }
                                        }
                                        else{
                                            $intento = 1;
                                            echo "<input name='intento' type='hidden' value='". $intento ."'>";
                                        }
                                    ?>
                                    <div class="mb-3 position-relative">
                                        <input name="email" class="form-control" type="text" placeholder="Email" required>
                                        <?php 
                                            if(isset($_GET['error'])){
                                                if($_GET['error'] == 'usuarioNoExiste'){
                                                    echo "<p style='color: #bf0000;text-align: center;'>Este correo no existe</p>";
                                                }
                                            }
                                        ?>
                                        <div class="valid-tooltip">Si contiene datos</div>
                                        <div class="invalid-tooltip"> Completa los datos</div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <input class="form-control" id="passInput" type="password" name="password" placeholder="Password" required>
                                        <label>Mostrar contraseña</label>
                                        <input type="checkbox" onclick="showPassFunction()">
                                        <?php 
                                            if(isset($_GET['error'])){
                                                if($_GET['error'] == 'incorrectPassword'){
                                                    echo "<p style='color: #bf0000;text-align: center;'>Constraseña incorrecta</p>";
                                                }
                                            }
                                        ?>
                                        <div class="valid-tooltip"> Si contiene datos</div>
                                        <div class="invalid-tooltip"> Completa los datos</div>
                                    </div>
                                    <div class="mb-3">
                                        <button name="btn-login" class="btn btn-primary d-block w-100" type="submit" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                            Login
                                        </button>
                                    </div>
                                    <p style='text-align: center;'>
                                        ¿No tienes cuenta? <a href="registro.php" style='text-decoration: none;font-weight: bold;color: #5d1b8f'>Registrate</a>
                                    </p>    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/Sidebar-Menu-sidebar.js"></script> 
        <script src="assets/js/validacionLogin.js"></script> 
    </body>
</html>