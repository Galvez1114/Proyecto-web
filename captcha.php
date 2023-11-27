<?php
session_start();

// Generar un string aleatorio para el CAPTCHA
$captcha_string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

// Almacenar el string en la variable de sesión para su validación posterior
$_SESSION['captcha'] = $captcha_string;

// Crear una imagen CAPTCHA
$captcha_image = imagecreatetruecolor(150, 50);
$background_color = imagecolorallocate($captcha_image, 255, 255, 255);
$text_color = imagecolorallocate($captcha_image, 0, 0, 0);

// Dibujar el string en la imagen
imagettftext($captcha_image, 25, 0, 10, 40, $text_color, './res/arial.ttf', $captcha_string);

// Enviar encabezados para indicar que la salida es una imagen PNG
header('Content-type: image/png');

// Mostrar la imagen PNG
imagepng($captcha_image);

// Liberar la memoria utilizada por la imagen
imagedestroy($captcha_image);
?>
