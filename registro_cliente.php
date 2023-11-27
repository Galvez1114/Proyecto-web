<?php
session_start();
$codigo = $_POST['codigo_captcha'];

if ($codigo === $_SESSION['valor_captcha_generado']) {
    $nombre = $_POST['nombre'];
    $ape = $_POST['apellido'];
    $email = $_POST['email'];
    $numeroDeTelefono = $_POST['numTelefono'];
    $pass = $_POST['pass'];
    $passHash = password_hash($pass, PASSWORD_DEFAULT);


    try {
        $dsn = "mysql:host=localhost;dbname=style_bd";
        $dbh = new PDO($dsn, 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $dbh->prepare("insert into clientes(nivel,nombre_cliente,apellido,email,num_telefono,pass) values (3,?,?,?,?,?)");

        $stm->bindPAram(1, $nombre);
        $stm->bindPAram(2, $ape);
        $stm->bindPAram(3, $email);
        $stm->bindPAram(4, $numeroDeTelefono);
        $stm->bindPAram(5, $passHash);


        $stm->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "Captcha incorrecto!";
    header("Location: registro.html");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Registro</title>
</head>

<body>

    <nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <a href="index.html" class="nav-item text-white h2 py-0 my-0 text-center text-decoration-none">Bienvenido a <span class="fw-bold">Style&Relax</span></a>
            </div>
            <div class="col-md-6 text-center mt-1 text-md-end">
                <a href="nosotros.html" class="btn btn-outline-light w-auto fs-3 py-0 border-0">Nosotros</a>
                <a href="contacto.html" class="btn btn-outline-light w-auto fs-3 py-0 border-0">Contacto</a>
            </div>
        </div>
    </nav>

    <h1 class="text-center">Ya puedes iniciar sesi&oacute;n</h1>
    <div class="d-flex flex-column mt-5">
        <a href="index.html" class="btn btn-primary text-center mx-auto">Volver al inicio</a>
    </div>

</body>

</html>