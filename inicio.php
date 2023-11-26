<?php
    $user = $_POST['usuario'];
    $pass = $_POST['pass'];
    $contador = 0;
    $nombre = "hola";


    try {
        $dsn = "mysql:host=localhost;dbname=taller";
        $dbh = new PDO($dsn,'root','');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = " SELECT COUNT(*)AS resultado FROM responsables";

       
        $contador = $dbh -> prepare($sql);
        $contador -> execute();
        if ($contador > 0) {
            $sql = "SELECT * from responsables where email = :login";
            $resultado = $dbh -> prepare($sql);
            $resultado -> execute(array(":login"=>$user));

            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                if(password_verify($pass,$registro['pass'])){
                    header("Location: agenda.html");
                    exit();
                }else{
                    echo"el usuario no existe";
                }
            }

        }
        else{

        }

       

       
        


    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>