<?php
    $nombre = $_POST['nombre'];
    $ape = $_POST['apellido'];
    $nivel = 2;
    $email = $_POST['email'];
    $numeroDeTelefono = $_POST['numTelefono'];
    $area = $_POST['area'];
    $turno = $_POST['turno'];
    $pass = $_POST['pass'];
    $passHash = password_hash($pass , PASSWORD_DEFAULT);
    echo $pass, "<br>";
    echo $passHash, "<br>";

    try{
        $dsn = "mysql:host=localhost;dbname=style_bd";
        $dbh = new PDO($dsn,'root','');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $dbh -> prepare("insert into responsables(nivel,nombre_resp,apellidos,email,num_telefono,area,turno,pass) values (2,?,?,?,?,?,?,?)");
        
        $stm -> bindPAram(1,$nombre);
        $stm -> bindPAram(2,$ape);
        $stm -> bindPAram(3,$email);
        $stm -> bindPAram(4,$numeroDeTelefono);
        $stm -> bindPAram(5,$area);
        $stm -> bindPAram(6,$turno);
        $stm -> bindPAram(7,$passHash);

        $stm -> execute();

        echo "Se ha registrado correctamente :)";
        
        echo " <form action='index.html'>
        <input type='submit' value='Volver al inicio'>
            </form>";

    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
</body>
</html>