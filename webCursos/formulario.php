<?php
$baseUrl = 'http://localhost/ProyectoFBDM-main';
session_start();
    include "classes/dbh.php";
    include "classes/bringDataClass.php";

    $tempData = new bringDataClass();

    if(isset($_GET['idCourse'])){
        $dataCourse = $tempData->bringCourse($_GET['idCourse']);
    }

    if(isset($_GET['idNivel'])){
        $dataLevel = $tempData->bringLevel($_GET['idNivel']);
    }
    //print_r($dataCourse);
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
</head>

<h1>Ejemplo <small>Formulario de pago</small></h1>

<!-- Para cambiar al entorno de producción usar: https://www.paypal.com/cgi-bin/webscr -->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="form_pay">

    <input type="hidden" value="">

    <!-- Valores requeridos -->
    <input type="hidden" name="business" value="vendedor@business.example.com">
    <input type="hidden" name="cmd" value="_xclick">

    <label for="item_name" class="form-label">item_name</label>
    <input type="text" name="item_name" id="" value="Curso" required=""><br>

    <label for="amount" class="form-label">amount</label>
    <input type="text" name="amount" id="" value="500.00" required=""><br>

    <input type="hidden" name="currency_code" value="MXN">

    <input type="hidden" name="quantity" id="" value="1" required=""><br>

    <!-- Valores opcionales -->
    <!-- En el siguiente enlace puedes encontrar una lista completa de Variables HTML para pagos estándar de PayPal. -->
    <!-- https://developer.paypal.com/docs/paypal-payments-standard/integration-guide/Appx-websitestandard-htmlvariables/ -->

    <input type="hidden" name="item_number" value="1">
    <!-- <input type="hidden" name="invoice" value="0012"> -->

    <input type="hidden" name="lc" value="es_Es">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="image_url" value="https://picsum.photos/150/150">
    <input type="hidden" name="return" value="<?= $baseUrl ?>/receptor.php">
    <input type="hidden" name="cancel_return" value="<?= $baseUrl ?>/index.php">

    <hr>

    <button type="submit">Pagar ahora con Paypal!</button>

</form>