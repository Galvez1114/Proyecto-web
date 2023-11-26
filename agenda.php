<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Agenda de citas</title>
</head>
<body>
    <nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <a href="index.html"
                    class="nav-item text-white h2 py-0 my-0 text-center text-decoration-none">Bienvenido a <span
                        class="fw-bold">Style&Relax</span></a>
            </div>
            <div class="col-md-6 text-center mt-1 text-md-end">
                <a href="nosotros.html" class="btn btn-outline-light w-auto fs-3 py-0 border-0">Nosotros</a>
                <a href="contacto.html" class="btn btn-outline-light w-auto fs-3 py-0 border-0">Contacto</a>
            </div>
        </div>
    </nav>

    <h1 class="text-center">Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
</body>
</html>