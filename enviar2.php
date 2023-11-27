<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Document</title>
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
                <!--Enlaces del header-->
                <a href="nosotros.html" class="btn btn-outline-light py-0 w-auto fs-3">Nosotros</a>
                <a href="contacto.html" class="btn btn-outline-light py-0 w-auto fs-3">Contacto</a>
            </div>
        </div>


    </nav>
    
<?php
/**********************************************
 *    Enviar correo NO utilizando Composer    *
 **********************************************/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Llamar PHPMailer a Mano
require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

//Crea un objeto PHPMailer;  `true` habilita excepciones
$mail = new PHPMailer(true);
$emailUser = $_POST['email'];

try {
    $dsn = "mysql:host=localhost;dbname=style_bd";
    $dbh = new PDO($dsn,'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "select count(*) from clientes where email = :login";
     // Preparar la consulta
     $stmt = $dbh->prepare($sql);
     $stmt->bindParam(':login', $emailUser, PDO::PARAM_STR);
     // Ejecutar la consulta
     $stmt->execute();
 
     // Obtener el resultado
     $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['count(*)'] > 0){
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $new_pass = substr(str_shuffle($permitted_chars), 3, 10);
            $pass_cifrada = password_hash($new_pass, PASSWORD_DEFAULT);

            // Consulta SQL DELETE para borrar el registro
            $sql = "update clientes set pass = :passCifrada where email = :registroId";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':passCifrada', $pass_cifrada, PDO::PARAM_STR);
            $stmt->bindParam(':registroId', $emailUser, PDO::PARAM_STR);
            $stmt->execute();


            try {
                //Configuracion del Servidor SMTP
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Muestra salida de depuración detallada
                $mail->isSMTP();                                            //Envia usando SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Configurar el servidor SMTP para enviar a través de él
                $mail->SMTPAuth   = true;                                   //Ahilita Autenticacion SMTP
                $mail->Username   = 'adrian.glvz11@gmail.com';                //nombre de usuario del servidor SMTPe
                $mail->Password   = 'qhyecniqsqwmjomk';                     //password del servidor SMTP
                $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS;   //Habilita TLS
                $mail->Port       = 587;                                    //Puerto TCP para conectarse; usar 587 si configuró `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Preparacion
                $mail->setFrom('adrian.glvz11@gmail.com', 'Style&Relax');       // Quien envia
                $mail->addAddress($emailUser, 'Usuario');     //Añade a quien envia correo
                //$mail->addAddress('ellen@example.com');                   //Mas nombres
                //$mail->addReplyTo('info@example.com', 'Information');     
                //$mail->addCC('cc@example.com');                           //Añde con copia
            
                //$mail->addAttachment('/var/tmp/file.tar.gz');             //Agrega Documento
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');        //Agrega documento
            
                //Contenido
                $mail->isHTML(true);                                        //Especifica que se envia el docuento en formato HTML
                $mail->Subject = 'Restablecimiento de credenciales';                               //Asunto
                $mail->Body    = 'Estimado cliente(a), su contrase&ntilde;a ha sido restablecida<br>
                Tu nueva contrase&ntilde;a es: <b>' . $new_pass . '</b>';       //Mensaje en HTML
                $mail->AltBody = 'Tu nueva contraseña es: '.$new_pass.' Usala para iniciar sesión';                              //Mensaje plano si no se acepta HTML
            
                $mail->send();                                              //Envia el correo
                echo '<h1 class="text-center">Tu contrase&ntilde; ha sido reestablecida, revisa tu correo</h1>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            


        }else{
            echo'<h1 class="text-center">El correo electronico no se encuentra registrado</h1>';
        }
    
    


} catch(PDOException $e){
    echo $e->getMessage();
}



?>

<div class="d-flex flex-column mt-5">
        <a href="index.html" class="btn btn-primary text-center mx-auto">Volver al inicio</a>
    </div>

</body>
</html>