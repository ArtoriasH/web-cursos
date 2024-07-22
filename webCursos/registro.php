<script>
    function showPassFunction() {
        var x = document.getElementById("password");
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
        <title>Registro</title>
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets/img/libro.png">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/Bootstrap-Chat.css">
        <link rel="stylesheet" href="assets/css/Bootstrap-Payment-Form-.css">
        <!-- Ajax -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <!-- Styles -->
        <link rel="stylesheet" href="assets/css/Banner-Heading-Image-images.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
        <link rel="stylesheet" href="assets/css/Pretty-Search-Form-.css">
        <link rel="stylesheet" href="assets/css/Sidebar-Menu-sidebar.css">
        <link rel="stylesheet" href="assets/css/registro.css">
        <!-- BDM Styles -->
        <link rel="stylesheet" href="bdmStyle.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    </head>
    <body>
        <section class="py-4 py-xl-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto" style="font-family: 'Abril Fatface', serif;">
                        <h2>Registrate</h2>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-5">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background-color: #5d1b8f">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                    </svg>
                                </div>
                                <form name="registro" id="registro" method="post" action="includes/actions.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <input id="nombre" class="form-control" name="nombre" type="text" placeholder="Nombre" required>                                   
                                    </div>
                                    <div class="mb-3">
                                        <input id="apeP" class="form-control" name="apeP" type="text" placeholder="Apellido Paterno" required>
                                    </div>
                                    <div id="apeM" class="mb-3">
                                        <input class="form-control" name="apeM" type="text" placeholder="Apellido Materno" required>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select" name="genero" required>
                                            <optgroup label="Genero">
                                                <option value="0" selected="">Masculino</option>
                                                <option value="1">Femenino</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <small>Fecha de Nacimiento</small>
                                        <input class="form-control" name="fNacimiento" type="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <small>Foto de perfil</small>
                                        <input class="form-control" type="file" name="image" accept="image/png, image/jpg, image/jpeg" required>
                                    </div>
                                    <div class="mb-3">
                                        <input id="correo" class="form-control" name="email" type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="Correo" required>
                                        <?php 
                                            if(isset($_GET['error'])){
                                                if($_GET['error'] == 0){
                                                    echo "<p style='color: #bf0000;text-align: center;'>Este correo ya está tomado</p>";
                                                }
                                            }
                                        ?>
                                    </div>                                
                                    <div class="mb-3">
                                        <select class="form-select" name="rol" required>
                                            <optgroup label="Tipo de Usuario">
                                                <option value="1" selected="">Profesor</option>
                                                <option value="2">Alumno</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input id="password" class="form-control" type="password" name="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,24}$" required>
                                        <label>Mostrar contraseña</label>
                                        <input type="checkbox" onclick="showPassFunction()">
                                    </div>
                                    <div class="mb-3">
                                        <button id="guardar" class="btn btn-primary d-block w-100" name="btn-signUp" type="submit" style="background: #6d28aa;border: none;color: white; text-align: center;">
                                            Registro
                                        </button>
                                    </div>
                                    <p style='text-align: center;'>
                                        ¿Ya tienes cuenta? <a href="login.php" style='text-decoration: none;font-weight: bold;color: #5d1b8f'>Inicia sesión</a>
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
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    </body>
</html>