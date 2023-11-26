<?php
session_start();
$user = $_POST['usuario'];
$pass = $_POST['pass'];
$contador = 0;
$nombre = "hola";




try {
    $dsn = "mysql:host=localhost;dbname=style_bd";
    $dbh = new PDO($dsn, 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = " SELECT COUNT(*)AS resultado FROM responsables";
    $stmt = $dbh->query($sql);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($resultado['resultado'] > 0) {
        $sql = "SELECT * from responsables where email = :login";
        $resultado = $dbh->prepare($sql);
        $resultado->execute(array(":login" => $user));

        while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($pass, $registro['pass'])) {
                #Si la contrasena es correcta, checar si es admin o responsable
                if ($registro['nivel'] == 2) {
                    $_SESSION['usuario'] = $registro['nombre_resp'];
                    header("Location: agenda.php");
                    exit();
                } else {
                    header("Location: admin.php");
                    exit();
                }
            } else {
                echo "el usuario no existe";
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
                header("Location: agenda.html");
                exit();
            } else {
                echo "el usuario no existe";
            }
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
