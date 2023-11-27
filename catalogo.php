<?php
session_start();
if (!$_SESSION['usuario']) {
    header("Location: index.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/validacion.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Inicio</title>
</head>

<body onload="sesion()">
    <nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <a href="index.html" class="nav-item text-white h2 py-0 my-0 text-center text-decoration-none">Bienvenido a <span class="fw-bold">Style&Relax</span></a>
            </div>
            <div class="col-md-6 text-center mt-1 text-md-end">
                <!--Enlaces del header-->
                <a href="cerrarSesion.php" class="btn btn-outline-light py-0 w-auto fs-3">Cerrar sesi&oacute;n</a>
            </div>
        </div>
    </nav>

    <h1 class="text-center">Bienvenido</h1>

    <div class="container">
        <form action="reservar.php" method="post">
            <button id="area" name="area" type="submit" value="barberia">Agendar cita en barberia</button>
        </form>

    </div>

    <footer class="bg-dark">
        <p class="text-white">&copy; Todos los derechos reservados 2023</p>
    </footer>
</body>

</html>