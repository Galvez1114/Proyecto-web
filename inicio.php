<?php
session_start();
$user = $_POST['usuario'];
$pass = $_POST['pass'];
$contador = 0;





try {
    $dsn = "mysql:host=localhost;dbname=style_bd";
    $dbh = new PDO($dsn, 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = " SELECT COUNT(*)AS resultado FROM responsables where email = :login";
    $resultado = $dbh->prepare($sql);
    $resultado->execute(array(":login" => $user));

    $resultado = $resultado->fetch(PDO::FETCH_ASSOC);


    if ($resultado['resultado'] > 0) {
        $sql = "SELECT * from responsables where email = :login";
        $resultado = $dbh->prepare($sql);
        $resultado->execute(array(":login" => $user));

        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($pass, $registro['pass'])) {
                #Si la contrasena es correcta, checar si es admin o responsable
                $_SESSION['usuario'] = $registro['nombre_resp'];
                if ($registro['nivel'] == 2) {
                    
                    header("Location: agenda.php");
                    exit();
                } else {
                    header("Location: admin.php");
                    exit();
                }
            } else {
               
            }
        }
    } 
    #si no esta en la tabla de responsables, determinamos que es un cliente
    else {
        $sql = "SELECT * from clientes where email = :login";
        $resultado = $dbh->prepare($sql);
        $resultado->execute(array(":login" => $user));
        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($pass, $registro['pass'])) {
                $_SESSION['usuario'] = $registro['nombre_cliente'];
                header("Location: catalogo.php");
                exit();
            } else {
                
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
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
    <title>Iniciar sesion</title>
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
    <h1 class="text-center">Revise sus credenciales</h1>
    <div class="d-flex flex-column mt-5">
        <a href="index.html" class="btn btn-primary text-center mx-auto">Volver al inicio </a>
    </div>
</body>
</html>
